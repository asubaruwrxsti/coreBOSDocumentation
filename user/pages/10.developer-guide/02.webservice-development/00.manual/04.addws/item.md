---
title: 'Add web service end points'
metadata:
    description: 'Creating new services for those requirements where the existing services are just not enough'
    author: 'Joe Bordes'
content:
    items:
        - '@self.children'
    limit: 5
    order:
        by: date
        dir: desc
    pagination: true
    url_taxonomy_filters: true
taxonomy:
    category:
        - development
        - webservice
    tag:
        - add
---

This chapter will teach you to create new services for those requirements where the existing services are just not enough.

The steps are basically two:

- database changes to register your new method
- implement the method

===

### Database changes

All the available operations of the API are stored in the vtiger\_ws\_operation database table. There we will find how the service must be called and all the information as to where the real code that will be executed can be found. So we will have to add our new service to this list and tell coreBOS where it can find our new code when it is needed.

The columns are:

<table class="table table-striped">
<tbody>
<tr>
<td><strong>name</strong></td>
<td>Name of the operation. This is the name that will be the visible name used through the API</th>
</tr>
<tr>
<td><strong>handler_path</strong></td>
<td>Path where the new code to be executed can be found. All base services can be found in the include/Webservices but you can put your code in any directory you like as long as it is inside coreBOS structure</td>
</tr>
<tr>
<td><strong>handler_method</strong></td>
<td>The exact name of the function that will be called. In the script indicated in the previous column, we can have as much code as we need to, with many functions and full access to all of the coreBOS infrastructure, but only ONE function will be called for each service. This column indicates which one</td>
</tr>
<tr>
<td><strong>type</strong></td>
<td>GET or POST</td>
</tr>
<tr>
<td><strong>prelogin</strong></td>
<td>This is the unique identifier of the records in this table. It is obtained from the vtiger_ws_operation_seq database table, so we have to increment the value in that table first and then use the new value to create the service record for our new operation</td>
</tr>
</tbody>
</table>

Once we have the new method is registered we must define the parameters it is going to have. This is defined in the vtiger\_ws\_operation\_parameters where the parameters of each service are defined if they exist. This table has an operationid column that ties it to the service definition and then a name, type, and sequence for each parameter required.

That is the theory, but coreBOS has a much easier way of defining this structure. All you have to do is create an **operationInfo** array in a file inside build/wsChanges. You can see a lot of examples in this directory, [like this one](https://github.com/tsolucio/corebos/blob/master/build/wsChanges/setRelation.php):

```php
$operationInfo = array(
    'name'    => 'SetRelation',
    'include' => 'include/Webservices/SetRelation.php',
    'handler' => 'vtws_setrelation',
    'prelogin'=> 0,
    'type'    => 'POST',
    'parameters' => array(
        array('name' => 'relate_this_id','type' => 'String'),
        array('name' => 'with_these_ids','type' => 'encoded')
    )
);
```
coreBOS updater will detect the new file and register the web service method for us

### Method

Create the new code that implements the service in the file and path indicated in the vtiger\_ws\_operation table along with any base code modifications that are needed to support your service.

This totally depends on what you are trying to achieve and the only thing to add would be that whatever you return from this function will be set in the "result" web service response.

### Examples

coreBOS repository is all full of examples. You can pick any file in the wsChanges directory and study its commit. The [commit of setRelation above is here](https://github.com/tsolucio/corebos/commit/7ebb729ee4115e5ac36dd0fa73b2ed67d05f0bca).

As another example, we will create a service that returns the total sum invoiced to an account.

```php
$operationInfo = array(
    'name'    => 'invoicetotals',
    'include' => 'include/Webservices/InvoiceTotals.php',
    'handler' => 'vtws_invoicetotals',
    'prelogin'=> 0,
    'type'    => 'POST',
    'parameters' => array(
        array('name' => 'id','type' => 'String')
    )
);
```

This service just requires the script which contains the new service (InvoiceTotals.php) which can be seen in the next code box. No further changes are required.

```php
<?php
function vtws_invoicetotals($id, $user){
    global $log,$adb;
    $log->debug("Entering function vtws_invoicetotals");
    $webserviceObject = VtigerWebserviceObject::fromId($adb,$id);
    $handlerPath = $webserviceObject->getHandlerPath();
    $handlerClass = $webserviceObject->getHandlerClass();
    require_once $handlerPath;
    $handler = new $handlerClass($webserviceObject,$user,$adb,$log);
    $meta = $handler->getMeta();
    $entityName = $meta->getObjectEntityName($id);
    $types = vtws_listtypes(null, $user);
    if ($entityName == 'Accounts' && !in_array($entityName,$types['types'])) {
        // an accountid has been given we need permission to accounts
        throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to perform the operation is denied on $entityName");
    }
    if (!in_array('Invoice', $types['types'])){ // we need access to invoices also
        throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to perform the operation is denied on Invoice");
    }
    if ($meta->hasReadAccess()!==true) {
        throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to write is denied");
    }
    if ($entityName !== $webserviceObject->getEntityName()) {
        throw new WebServiceException(WebServiceErrorCode::$INVALIDID,"Id specified is incorrect");
    }
    if (!$meta->hasPermission(EntityMeta::$RETRIEVE,$id)) {
        throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to read given object is denied");
    }
    $idComponents = vtws_getIdComponents($id);
    if (!$meta->exists($idComponents[1])) {
        throw new WebServiceException(WebServiceErrorCode::$RECORDNOTFOUND,"Record you are trying to access is not found");
    }
    $ids = vtws_getIdComponents($id);
    $accountid = $ids[1];
    $itotrs=$adb->pquery(
        'select sum(subtotal) as stot, sum(total) as ttot
            from vtiger_invoice
            inner join vtiger_crmentity on crmid=invoiceid
            where deleted=0 and accountid=?',
        array($accountid)
    );
    $totals=array(
        'subtotal'=>$adb->query_result($itotrs,0,0),
        'total'=>$adb->query_result($itotrs,0,1)
    );
    VTWS_PreserveGlobal::flush();
    $log->debug("Leaving function vtws_invoicetotals");
    return $totals;
}
?>
```

This new service can be called from a client program like this:

```php
doInvoke('invoicetotals', array('id' => '11x74'), GET);
```

<br>
------------------------------------------------------------------------

[Next](../01.libraries)| Chapter 21: Client Libraries.

------------------------------------------------------------------------
---
title: 'Global Variables'
metadata:
    description: 'The Global Variables module permits us to customize the functionality of the application in a very easy way. '
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
        - adminmanual
    tag:
        - globalvariable
---

The Global Variables module permits us to customize the functionality of the application in a very easy way. The basic idea is that when we are programming something and need to establish a value or a decision, we create a global variable with a default value and use the result. So now any user can set the global variable to another value and effectively modify the program logic without having to modify the code. A really powerful and easy extension.

===

The order Global Variables use to return a value is:

-   First it looks for a GV marked as 'mandatory'.
-   If none is found, it'll look for one assigned to the role of the current user.
-   If none is found, it'll look for one assigned to the current user.
-   If none is found, it'll look for one assigned to the group of the current user.
-   Finally, it'll look for one that's marked as 'default'.
-   If no GV was set, the default system behaviour will take place.
-   Additionally the previous searches will take into considertion the checkbox 'In Module List'

## Example
Let's suppose I needed the invoice creation to leave the status of the related sales order alone. So I set my Global Variable up like this:

-   I select "SalesOrder_StatusOnInvoiceSave" from the "name" dropdown. That handles this specific case.
-   As a value I entered "DoNotChange", which is a special value the system checks for.
-   I checked the 'mandatory' box.
-   I chose "Module Functionality" from the 'Category' dropdown.

You could also set a different value if you do want the SalesOrder status to change, but not to "Approved".

## Fields

-   **Global Variable Name.** This is a list of existing variables. It is a select box with the accepted values.
-   **Value.** Is a string field that holds the actual value to be used for this variable. Each variable has its own possible values which are documented in the module. There is a special value accepted by all variables which is [Use Description]. Some variables have very long values, for example **Application_UserLoginIPs** can be a long string of values. To make maintaining these long values easier you can put the value in the description field instead of the value field by setting the value to [Use Description].
-   **User.** the user this variable is for
-   **Default.** This checkbox is the contrary to Mandatory. It permits the administrator to set a default value for all users but it can be overridden by any user who wants to have a different value. The record marked as Default will only be used if no other record is found
-  **Mandatory.** This checkbox forces the value of the variable for all users. If it is checked no other record for this variable will be used. It is designed for the administrator to be able to set a variable globally for all users. To accomplish this you must set the module to private sharing and assign the record to the admin user so it can't be modified by any user.
-   **Blocked:** this field is simply for grouping certain variables together, it has no logic nor process associated. The use case this field was created for was for the admin user to be able to hide it in all profiles or not permit editing of the field so he can use it to group certain important variables together. Once those variables are ticked we can easily create a filter or search on the field so we can find them quickly.

-   **Module and In Module List.** Variable values can be applied per module with these two fields. If the in module list field is checked then the defined value will be applied only to the modules selected in the module multi-picklist field
-   **Role.** Select the roles you want to apply this variable too. **If one or more roles are selected the Global variable MUST be assigned to a user in one of those roles. To help you with that coreBOS will automatically assign it to one if you haven't**
-  **Business Map.** When we look for business maps in the code we do that through the global variable module instead of going directly to the business map module. This way we permit any user to override the default selection and set a specific mapping for any case.
-   **Category.** simply for organization purposes, so you can group and filter your variable records

## Documentation

The list of variables is fully documented in the module itself. On the list view, there is a button to access the table, on the detail and edit view there is a block which contains the table with all the variables, their possible values and an explanation of what each is for.

## Test

On the list and detail view, you will find a **Test** action which will permit you to validate the result of any variable on any module for any user. This is very useful when you have a lot of records for the same variable and need to make sure that the right value will be returned in each case.

## Web service
External applications can get the values of global variables in the application using the **web service call: SearchGlobalVar**, which is a GET request with three parameters:

gvname: name of the global variable
defaultvalue: default value to be returned if not found
gvmodule: module to be searched on

You can see an [example of this call and try it out](https://github.com/tsolucio/coreBOSwsDevelopment/blob/master/testcode/500_GetGlobalVariable.php) using the [coreBOS web service developers' tool](https://github.com/tsolucio/coreBOSwsDevelopment).

This web service endpoint has a special use case to **retrieve business maps**. Since [business maps](../02.business-maps) are such a powerful configuration feature and the exact map to use for each user/module depends on the global variable module escalation rules, this web service method will recognize the prefix "**BusinessMapping_**" in the first gvname parameter. If the name has this prefix it understands that you are searching for a Business Map and will return the ID of the map along with the map itself in JSON format.

```
SearchGlobalVar('BusinessMapping_Accounts_FieldDependency', '', 'Accounts');
array(
  'id' => business map WSID,
  'map' => JSON string of the map,
);
```

## JavaScript
In the browser we have a **JavaScript promise** that sets the value obtained from the application like this:

```
var calendar_call_default_duration = 5; // define the variable and set it's default value
GlobalVariable_getVariable('Calendar_call_default_duration', 5, 'Calendar', gVTUserID).then(function(response) {
	var obj = JSON.parse(response);
	calendar_call_default_duration = obj.Calendar_call_default_duration;  // set value from application
}, function(error) {
	calendar_call_default_duration = 5; // set default value on error
});
// You MUST give this some time to execute, so do not use the value at this line, or
// execute your code inside the promise
```

## Create a new variable

Creating a new variable is a three step process

1.  call the global variable method with the new variable in your code
2.  add the new variable to the DefineGlobalVariables.php continuous changeset so it gets added to the picklist of valid variables
3.  add the definition of the new variable in the language file

This [commit is a good example of this process](https://github.com/tsolucio/corebos/commit/bffa964a4c3e8c658f3eb5a84900a8e0fc7c5865).

## More Information

[You can find some more information here](https://blog.corebos.org/blog/globalvariable)
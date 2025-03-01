---
title: 'coreBOS Multi-Currency Fields'
metadata:
    description: 'coreBOS Multi-Currency Fields'
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
        - field
    tag:
        - uitype
        - currency
---

coreBOS has support for multicurrency fields on any module.

This is accomplished with the uitype 71 fields. This is a currency field that will be saved in the base currency selected in the application and shown on screen in the currency selected by the current user.

===

There is also another way of accomplishing multicurrency which consists in having to manually program the conversion logic on screen. This method gives the programmer the basic infrastructure and leaves the rest of the logic to the specific needs of the module. This is how the four inventory modules do it. Let's see how that can be set up.

- the uitype of the currency fields must be 72, not 71. 72 are currency fields that will be saved as given, independent of the currency of the user, so any conversion must be done by the programmer
- you must create a field called **inventory\_currency** of type 117 that will save also the conversion rate of the selected currency in a field called **conversion\_rate** and that must be created directly in the main table of the module

So, in this case, coreBOS will permit you to select the different currencies defined in the application and will save the selected currency as well as the conversion rate of that currency with respect to the base currency. Leaving the programmer with the task of:

- converting the currency used in the record to the selected currency of the user
- dynamically changing any currency fields when the user changes the selected currency
- make sure the correct values are sent in to be saved

This way you can create any logic and design you may need for your module.

Next, I leave the necessary code to create the currency picklist and conversion rate field.

```php
// Turn on debugging level
$Vtiger_Utils_Log = true;
include_once 'vtlib/Vtiger/Module.php';
$modname = 'YourModule';
$module = Vtiger_Module::getInstance($modname);
if ($module) {
    $blockInstance = VTiger_Block::getInstance('YourBlock', $module);
    if ($blockInstance) {
        $field = new Vtiger_Field();
        $field->name = 'inventory_currency';
        $field->label= 'Currency';
        $field->table = $module->basetable;
        $field->column = 'currency_id'; // will be a reference to currency_info table
        $field->columntype = 'INT(11)';
        $field->uitype = 117;
        $field->displaytype = 1;
        $field->typeofdata = 'I~O';
        $field->presence = 0;
        $blockInstance->addField($field);
        $adb->query("ALTER TABLE ".$module->table_name." ADD `conversion_rate` DECIMAL(10,3) NOT NULL DEFAULT '1'");
        echo "<br><b>Added Field to $modname module.</b><br>";
    } else {
        echo "<b>Failed to find $modname block</b><br>";
    }
} else {
    echo "<b>Failed to find $modname module.</b><br>";
}
```

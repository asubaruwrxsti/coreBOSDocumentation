---
title: 'VTEntityData Objects'
metadata:
    description: 'VTEntityData Objects'
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
        
    tag:
        - VTE
        - entity
---
---

The VTEntityData object provides access to an entity object (a record in
the application). It implements (among others) the following methods

getModuleName
-------------

Returns the module name of the entity.

getId
-----

Returns id of the entity, this will return null if the id has not been
saved yet.

getData
-------

Returns the fields of the entity as an array where the field name is the
key and the field's value is the value.

isNew
-----

Returns true if new record is being created, false otherwise.

Example: Event handlers add/update distinction
```php 
    class MyModuleEventHandler extends VTEventHandler {
        function handleEvent($eventName, $data) {
            if ($data->isNew()) {
                // Creation of new record
            } else {
                // Editing existing record
            }
        }
    }
```
Modifying the fields of the entity object
-----------------------------------------

In certain events, for example, 'vtiger.entity.beforesave.modifiable' it
is possible to modify the entity, so that it gets saved. e.g, for an
VTEntityData object called *$data* you can change the field
*simple\_field* to the value 'value' using the following code.
```php
    $data->set('simple_field', 'value');
```
Now the entity will get saved with simple\_field saved as 'value'.

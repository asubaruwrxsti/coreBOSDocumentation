---
title: 'How to prepare modules for distribution'
metadata:
    description: 'How to prepare modules for distribution'
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
        - distribution
---

<div class="notices red"><strong>THIS DOCUMENTATION IS WRONG</strong>. It  is obsolete. We're working on it </div>

coreBOS (5.5 forward) is prepared to make installing and distributing your modules easy.

===

There are basically two approaches for this:

1. distribute your module as an individual package that can be installed on any system once it is up and running.
2. distribute your module as part of the whole system and have the administrator activate the module as needed.

The first step is to create the new module in an existing system, so install a coreBOS system on your development machine and let's get started.

### Create new module or extension

[You can find full details on how to create a coreBOS module or extension here.](../01.createvtlibmodule)

### Create module package

A coreBOS module package consists of a set of files that implement the functionality of the module and a manifest.xml file which details the necessary meta data and database changes that it needs. You can read more about this in other sections of the wiki.

Once your module is working as you like and you want to package it, follow these steps:

### 1.- File structure

You must have these files in place:

- modules/{ModuleName}
- modules/{ModuleName}/manifest.xml
- manifest.xml (this is a copy of the modules/{ModuleName}/manifest.xml file)
- composer.json (optional, this is for direct command line install [using composer](https://getcomposer.org/))
- cron/modules/{ModuleName} (**optional** only if needed)
- Smarty/templates/modules/{ModuleName} (**optional** only if needed)

The complete composer.json format supported is:

```php
{
    "name": "Package",
    "type": "object",
    "properties": {
        "name": {
            "type": "string",
            "description": "Package name, including 'vendor-name/' prefix."
        },
        "description": {
            "type": "string",
            "description": "Short package description."
        },
        "keywords": {
            "type": "array",
            "items": {
                "type": "string",
                "description": "A tag/keyword that this package relates to."
            }
        },
        "homepage": {
            "type": "string",
            "description": "Homepage URL for the project.",
            "format": "uri"
        },
        "version": {
            "type": "string",
            "description": "Package version, see https://getcomposer.org/doc/04-schema.md#version for more info on valid schemes."
        },
        "time": {
            "type": "string",
            "description": "Package release date, in 'YYYY-MM-DD', 'YYYY-MM-DD HH:MM:SS' or 'YYYY-MM-DDTHH:MM:SSZ' format."
        },
        "license": {
            "type": ["string", "array"],
            "description": "License name. Or an array of license names."
        },
        "extra": {
            "price": [number],
            "buyemail": [email],
            "buyurl": [uri],
            "distribution": ["Sale","Free","Subscription","Donationware"]
        },
        "authors": {
            "type": "array",
            "description": "List of authors that contributed to the package. This is typically the main maintainers, not the full list.",
            "items": {
                "type": "object",
                "additionalProperties": false,
                "required": [ "name"],
                "properties": {
                    "name": {
                        "type": "string",
                        "description": "Full name of the author."
                    },
                    "email": {
                        "type": "string",
                        "description": "Email address of the author.",
                        "format": "email"
                    },
                    "homepage": {
                        "type": "string",
                        "description": "Homepage URL for the author.",
                        "format": "uri"
                    },
                    "role": {
                        "type": "string",
                        "description": "Author's role in the project."
                    }
                }
            }
        },
        "support": {
            "type": "object",
            "properties": {
                "email": {
                    "type": "string",
                    "description": "Email address for support.",
                    "format": "email"
                },
                "issues": {
                    "type": "string",
                    "description": "URL to the issue tracker.",
                    "format": "uri"
                },
                "forum": {
                    "type": "string",
                    "description": "URL to the forum.",
                    "format": "uri"
                },
                "wiki": {
                    "type": "string",
                    "description": "URL to the wiki.",
                    "format": "uri"
                },
                "irc": {
                    "type": "string",
                    "description": "IRC channel for support, as irc://server/channel.",
                    "format": "uri"
                },
                "source": {
                    "type": "string",
                    "description": "URL to browse or download the sources.",
                    "format": "uri"
                },
                "docs": {
                    "type": "string",
                    "description": "URL to the documentation.",
                    "format": "uri"
                }
            }
        }
    }
}
```

where only the first ***name*** and ***type*** are mandatory.

### 2.- Package the module

There are different ways to achieve this.

### Linux shell access

If you have linux shell access you can easily obtain the zip package entering the build dirtectory and executing the pack script:

- cd build

#### Linux pack normal module

- ./pack.sh {ModuleName}

<div class="notices blue">For this to work you must add links to the main directories of your module inside the module's directory in build.</div>

#### Linux pack language extension

- ./pack\_lang.sh {LanguageCode} {LanguageName}

### Programed with Package Manager

You can add the next script to the root of your coreBOS install and execute it from the command line or the browser to get the package.

<div class="notices blue">The scripts below are the minimum code necessary to show the functionality, you should use the complete scripts in the build directory.</div>

These scripts are already prepared in the build directory, you simply have to copy to the root the one you want to use.

<div class="notices red">Do **NOT** leave these scripts in the root of production systems as anyone can download any module with them!</div>

#### Package getting meta data from database

<div class="notices blue">This is exactly the same as going to the **Module Manager** and pressing the export button.</div>

File in build/export\_package\_database.php

```php
<?php
// Turn on debugging level
$Vtiger_Utils_Log = false;
include_once('vtlib/Vtiger/Module.php');
$modulename = vtlib_purify($_REQUEST['modulename']);
$module = Vtiger_Module::getInstance($modulename);
$pkg = new Vtiger_Package();
$pkg->export($module,'',$modulename.'.zip',true);
?>
```

#### Package getting meta data from manifest.xml file

File in build/export\_package\_filesystem.php

```php
<?php
// Turn on debugging level
$Vtiger_Utils_Log = false;
include_once('vtlib/Vtiger/Module.php');

$modulename = vtlib_purify($_REQUEST['modulename']);
Vtiger_Package::packageFromFilesystem($modulename,false,true);
?>
```

#### Language Package getting meta data from manifest.xml file

File in build/export\_language\_filesystem.php

```php
<?php
// Turn on debugging level
$Vtiger_Utils_Log = false;
include_once('vtlib/Vtiger/Module.php');

$languagecode = vtlib_purify($_REQUEST['languagecode']);
$languagename = vtlib_purify($_REQUEST['languagename']);
Vtiger_Package::languageFromFilesystem($languagecode,$languagename,true);
?>
```

### 3.- Send package for distribution

- To have your new module installed by default when installing coreBOS, copy the package file to the **packages/mandatory** directory.
- To have your new module appear in the list of optional modules during the install of coreBOS, copy the package file to the **packages/optional** directory.
- To install the module in an already installed application load the package file through the **Module Manager** interface.

### Creating a Bundle Package

A bundle package is a file which contains 2 or more normal packages to be installed together in a certain order.

In order to construct these packages what we usually do is take all the steps above for each individual package and then manually create the manifest file and zip them all together.

In the build directory you can see how we have set this up for the Project bundle. Since we use links we can call the pack.sh script to get the bundle packaged.

### Comments and Tips

- Note how, by default we have all the modules packaged in the packages directory, but also ALL files copied in place. This way we can work on any module and simply create the package again when we are finished with the modifications.
- In line with the previous comment, we setup in the build directory the structure to work on the manifest file and link all the structure to the real files which are in their place.
- The previous situation leads to the all to common error of modifying files to fix or add something and forgetting to create the package again. To avoid this problem the install process will automatically create the package again right before it installs as long as all the necessary files are in place. This means that all files in the application are more important than files inside the package.
- Another common situation is where you already have an installed application and want to apply a set of modules and changes. In this case it is normal to create a central script that directs all the changes and at one point it installs the set of new modules. When this is done it is **very recommendable** to first create the package files again before installing to avoid the situation described before.

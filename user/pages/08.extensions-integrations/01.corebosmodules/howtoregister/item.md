---
title: 'How to Register your Module, Extension, Patch or Plugin'
metadata:
    description: 'Register to   your Module, Extension, Patch or Plugin'
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
        - course
    tag:
        - certification
---
---

To add your change to this documentation you must create a new wiki page inside the extensions directory with a specific format. Let's see the exact steps and formatting.

## 1.- Working on the documentation site

Follow [the steps indicated on the github documentation project to clone the wiki](https://github.com/tsolucio/coreBOSDocumentation/blob/master/README.md) and be able to prepare pull requests.

## 2.- Create a new page for your change

Access the url
```
http://your_server/your_wiki_clone/doku.php?id=en:extensions:extensions:your_change_name

```
where “your_change_name” is the name of your module or extension. Click on the “Create Page” link and add any content you want to the page. Usually this will be a description of the functionality and how to get it working or even how to purchase it.

## 3.- Add a title to the page.

Something like this:
```
====== Mass Document Import ======
```
this value will be used as the name of the change on the search grid.

## 4.- Add register data.

At the top of your new wiki page you must add this block of information:

```
---- dataentry ----
name : 
type : [module|extension|enhancement|perspective|patch]
description_wiki: 
keywords_tags : programming, coding, design, html
version : 
homepage_url : 
release_dt : 
license : 
price: [number]
buyemail_mail: [email]
buyurl_url: [uri]
distribution: [Sale|Free|Subscription|Donationware]
authorname :
authoremail_mail :
authorhomepage_url :
supportemail_mail :
supportissues_url :
supportforum_url :
supportwiki_url :
supportirc :
supportsource_url :
supportdocs_url :
----
```

This information will be recorded on the registration page so it can be searched.

**json2data.php**

If you have created a module or extension following the new perspective install format and it has a [composer.json file with the supported fields](http://localhost/coreBOSDocumentation/developer-guide/architecture-concepts/packagemodules#1-file-structure) you can use [the coreBOS documentation HelperScript json2data.php](https://github.com/tsolucio/corebos/blob/master/build/HelperScripts/json2data.php) to transform the composer.json file directly into the dokuwiki dataentry format above.

**module2wiki.php**

Additionally if you have standard module with the correct structure and files you can use [the coreBOS documentation HelperScript module2wiki.php](https://github.com/tsolucio/corebos/blob/master/build/HelperScripts/module2wiki.php) to get a full wiki page with all the information and fields of the module.

## 5.- Write any additional information.

You can use the rest of the page to write any additional information that may be useful to the person searching for extensions.

## 6.- Create a Pull Request.

We will review, comment and accept accordingly.
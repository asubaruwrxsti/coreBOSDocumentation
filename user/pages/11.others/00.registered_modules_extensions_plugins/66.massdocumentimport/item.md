---
title: 'Mass Document Import'
---

Mass Document Import
====================

![](description>vtiger CRM coreBOS extension that permits mass import of documents)
![](keywords>vtiger, vtigercrm, crm, corebos, spain, mass document import)  
---- dataentry ---- name : MassDocumentImport \# type : extension \#
description\_wiki : coreBOS extension that permits mass import of
documents \# keywords\_tags : import, documents, mass \# version : 1.0
\# homepage\_url :
<http://corebos.org/documentation/doku.php?id=en:extensions:extensions:massdocumentimport>
\# release\_dt : 2012-11-03 \# license : Vizsage \# price : 95€ \#
buyemail\_mail : info(at)tsolucio(dot)com \# buyurl\_url :
<http://evoshops.com/products-page/components-plugins-software/vtigercrm-mass-document-import/>
\# distribution : Sale \# authorname : JPL TSolucio, S.L. \#
authoremail\_mail : info(at)tsolucio(dot)com \# authorhomepage\_url :
<http://tsolucio.com> \# supportdocs\_url :
<http://corebos.org/documentation/doku.php?id=en:extensions:extensions:massdocumentimport>
\#

------------------------------------------------------------------------

  
===== How it works ===== This works like this:

-   It is a vtlib compatible extension, so it is installed via the
    **module manager** interface.
-   Once installed you must edit a configuration file to change a
    directory variable. This directory is where the documents must be
    copied and from where the extension will read them and import them.
-   When you access the extension you are greeted with an edit document
    screen that asks for a reference, user, folder and description. When
    Save is clicked the import process will read documents in from the
    established folder on the harddisk. Each document will have the
    format: **id\_filename.ext** We will search for **id** as **contact
    ID number**, if not found, we search for it as **account ID
    number**. We will insert a new document in the system assigned to
    the selected user, in the chosen folder, with the given title and
    description, associated to the contact/account if found and with the
    name filename.ext
-   If no account/contact is found the document is not imported.
-   If document is imported, it is eliminated from the directory

Obviously we can change the logic to associate to any other entity or by
any other field.

Price: **95 euros** you can make payment on our paypal account

Q & A
-----

??? Should I manually change the file name of the documents to import?

!!! Yes, you will have to change their names to adapt to the format
expected by the plugin. It currently expects to find the Contact or
Account ID number but we can adapt that if you already have your files
in some other format. For example, for a client here in Spain, where
each citizen has a unique ID card number we have a version that looks
for this number in a custom field of the contacts.

??? Do you think I can import 3000 documents in one upload?

!!! You should be able to import 3000 in one shot with no problem, but
it will all depend on the capacity and configuration of your server,
that is why the extension eliminates the files once imported. Thanks to
that feature, if it stops for any reason you just launch it again and it
will continue.

??? Example If i have a document called 12345.pdf and contact name Adam
Smith, what will be the file name of the document?

!!! Supposing that the contact Adam Smith has a Contact ID of: CON987,
then the file must be renamed to: CON987\_12345.pdf to be imported.

??? If I import all those files, can I still add more file to each
contact?

!!! Yes, of course, the imported documents are simply normal coreBOS
documents that will live along side all the others you may upload in
other ways before or after.

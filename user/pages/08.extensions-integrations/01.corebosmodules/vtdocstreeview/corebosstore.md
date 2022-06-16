---
title: 'Document tree view'
metadata:
    description: 'The main goal of the extension is to permit installations with a large number of documents to access a structured list view of the documents. By default the document list view shows a list of all folders with a set of documents it contains.'
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
        - extension
    tag:
        - module
---
---
The main goal of the extension is to permit installations with a large number of documents to access a structured list view of the documents. By default the document list view shows a list of all folders with a set of documents it contains. We have clients with over 34000 documents in over 400 folders. In this type of installation you cannot access the document list view. So we created a tree view that shows the list of folders without retrieving the documents within, when you click on a folder only the list of the documents contained in it are returned. With this setup we regain access to a structured view of the documents in our system.
On this new view we have implemented some of the functionality the current document list view has, at least the basic functionality. You can create folders, move documents between folders, add documents, download and edit, among others.
We have also added a different way of accessing the documents. Not only can we see the list of folders and documents, but we can see them by entity. So you can click on the Account folder and see a list of all the folders that contain at least one document associated to an account.

===

Some Screenshots
================
![](vtdoctreeview.png?width=100%)
![](docfolders.png?width=100%)
![](addfolder.png?width=100%)
![](doctypes.png?width=100%)
![](move_doc1.png?width=100%)
![](move_doc2.png?width=100%)
![](account_docview.png?width=100%)


---
title: 'Lead Conversion Options Explanation'
---

### Lead Conversion Options Explanation

??? I define a profile where I deactivate the top options of see and use
all and then all the modules except Accounts, Contacts and Leads.

Then I go to any Lead but the Convert Lead action is not there. Why?

I can only see the link if I activate see and use all, but then I also
see al the modules, which I do not want.

!!! I just tried and it worked correctly for me.

![](youtube>wFnoEiOtNDU)

The problem must be with some field the conversion needs.

I had a look at the code and it says that the "Convert Lead" action will
be visible when all these conditions are met:

-   the user has edit permission on Accounts, Contacts and Leads
-   the user must have conversion tool permission in his profile (see
    image below)
-   Accounts and Contacts modules are active
-   the Lead hasn't been converted previously
-   the field "Company" on the lead is not empty

<img src="/es/user/convertleadtoolpermission.png" class="align-center" width="800" />

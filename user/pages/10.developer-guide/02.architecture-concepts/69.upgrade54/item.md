---
title: 'vtiger CRM 5.4.0 to coreBOS 5.4.0 Changes'
---

vtiger CRM 5.4.0 to coreBOS 5.4.0 Changes
=========================================

Comments on important changes
-----------------------------

There are full details of the change on the ticket and some have their
own wiki page with an explanation, this is just a quick call of
attention.

### re-branding and adapting

We had to change the vtiger company references, for legal issues and
also to not confuse the user base, but in **our effort to convert this
project into a useful tool for many business** we went the extra mile
and did it in a way that you can easily change the name and logo of the
application in one place and get a customized installer with no
reference to coreBOS (or vtiger). We will continue to go down this path
making it easier both for the implementor and the final user of the
software.

In coreBOS 5.4 you can change the variables

    $coreBOS_app_name ='coreBOS';
    $coreBOS_app_url = 'http://corebos.org';

that are in the vtigerversion.php file and then change the logo in
include/install/images/app\_logo.png and the themes/images/favicon.ico
(just one in one place!) and you should not see any references to
coreBOS (we are not completely there yet)

### Global search direct access

With this enhancement if the global search only finds one record, it
will open that record in Detail View directly for you

### Report totals for inventory modules

**This one is important**; the sum of totals of invoice columns in
report is not the same as on the summary block

### Reporting on product lines of inventory modules

some important improvements there

### selected records on related list are lost on paging

This is related to the failing Mass Edit problem, whereas if you search
on the list view and then launch a mass action you really do it on all
the records not on the selected subset.

### set of minor bug fixes appeared along the last two years

You should have these if you are working with vtiger CRM 5.4:
~~issue:92~~ (most of our clients do)

### Event and Task workflows not respecting AM/PM selection

~~issue:86~~

### config-dev.inc.php: config.inc.php developer override

This is a "must have" if you are developing with coreBOS. thanks to this
include we can put the client's config.inc.php under version control and
still have each programmer working on the project install it on their
local computer for development as they can override any configuration
variable locally.

### protect some sensitive directories from web access

Interesting security enhancement

### On send PDF by email fill in email address by default

Interesting enhancement which supports B2C model also

### Duplicate Filter

Adds the functionality to duplicate (Save as) any filter

Full list of changes from GIT commits
-------------------------------------

<table>
<tbody>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/2e73ba9f1cc991bd665ccac367e3d89ec5c694b9">2e73ba9f1cc991bd665ccac367e3d89ec5c694b9</a></td>
<td>upgrade2coreBOS script</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/fac7ef3579fb4b684c5904406d985172462e05fd">fac7ef3579fb4b684c5904406d985172462e05fd</a></td>
<td>issue ~~issue:101~~: further rebranding: eliminate feedback, prepare help links for easy adapting, block application access on non supported PHP version</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/53e2dbbd7aa6c95a5c2b211407d729d168fb364a">53e2dbbd7aa6c95a5c2b211407d729d168fb364a</a></td>
<td>fixes ~~issue:111~~: lead module loses all actions if calendar is deactivated from user's profile</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/d353f13fc4d044bb8391b17f949aefde526001b3">d353f13fc4d044bb8391b17f949aefde526001b3</a></td>
<td>fixes ~~issue:110~~: flaw in vtws_getchallenge</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/1641f1cda5ce837af8bcdb94594829897c10b847">1641f1cda5ce837af8bcdb94594829897c10b847</a></td>
<td>security patch cve-2013-7326</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/b23d118101e0d2204f06ccbfb840a0e972cf43f0">b23d118101e0d2204f06ccbfb840a0e972cf43f0</a></td>
<td>translate salutation in listview</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/cabf5f2e95ad7c050933321596d7872e74e2dbea">cabf5f2e95ad7c050933321596d7872e74e2dbea</a></td>
<td>fixes ~~issue:107~~: if global search only finds one record &gt; go there directly</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/cd90acb6a28d34c235b1952a60afbd8009cb5031">cd90acb6a28d34c235b1952a60afbd8009cb5031</a></td>
<td>fixes ~~issue:106~~: Report totals for inventory modules as secondary are incorrect</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/088c954b88aacc4fc9f3df1572927c7993e523f6">088c954b88aacc4fc9f3df1572927c7993e523f6</a></td>
<td>Report Improvement: Thanks Libertus. CKEditor Quick Change error: Thanks Stefan Warnat</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/c3782614b1133b23a9b7d7d83e49bf6ee2d42eef">c3782614b1133b23a9b7d7d83e49bf6ee2d42eef</a></td>
<td>fixes ~~issue:104~~ vtigerCRM540_securitypatch with enhancements</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/319eccc8f6fac6517d98c40a52ee542b5f51c640">319eccc8f6fac6517d98c40a52ee542b5f51c640</a></td>
<td>fixes ~~issue:101~~: rebranding and cleanup adjustments</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/ee55cbbcf8253e230f05328a17edac9395822c09">ee55cbbcf8253e230f05328a17edac9395822c09</a></td>
<td>fixes ~~issue:102~~ fix copyright.html</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/5516c593e5d313e86e67884df0b2bd0d38c43db5">5516c593e5d313e86e67884df0b2bd0d38c43db5</a></td>
<td>git ignore</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/4b5b7883a10e676cd115b6f7eabb18995126a542">4b5b7883a10e676cd115b6f7eabb18995126a542</a></td>
<td>fixes ~~issue:101~~: working on rebranding, trying to make it as generic as possible so it will benefit everybody. code and file cleanup</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/73cc64b9688617357b50f95fbc235a3cf707c8af">73cc64b9688617357b50f95fbc235a3cf707c8af</a></td>
<td>issue ~~issue:101~~ working on it</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/bc375aa76ab7b77de755e3df1fc499d554e223d7">bc375aa76ab7b77de755e3df1fc499d554e223d7</a></td>
<td>fixes ~~issue:100~~: export query failing in new modules with uitype 10 fields</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/6c4172667ff300422679de781f1fb49ced233266">6c4172667ff300422679de781f1fb49ced233266</a></td>
<td>fixes ~~issue:99~~ Invoice shipping and handling field does not appear in reports</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/44d840bab871f0a0dda38763547ac73e63b7e1af">44d840bab871f0a0dda38763547ac73e63b7e1af</a></td>
<td>fixes ~~issue:98~~: Reporting on product lines of inventory modules</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/e6512b60e7dd5cf6bdc98281abb22b9c22b05a58">e6512b60e7dd5cf6bdc98281abb22b9c22b05a58</a></td>
<td>fixes ~~issue:97~~: selected records on related list are lost on paging</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/78c03e0ad3a6cd0f77cd72d7e06d3a08fa0655a8">78c03e0ad3a6cd0f77cd72d7e06d3a08fa0655a8</a></td>
<td>when emails is active and webmail isn't in profile, generation of cache files breaks</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/b2a54bf65eba4cd8f8bf32543f43a5c0bba86009">b2a54bf65eba4cd8f8bf32543f43a5c0bba86009</a></td>
<td>better comparison of imported data y trimming spaces</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/5f103dd794b357ed57c9b397113cd46bf2c742fa">5f103dd794b357ed57c9b397113cd46bf2c742fa</a></td>
<td>fixes ~~issue:96~~: Scheduled reports issues</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/7b2b85d7d323b72d47ec32af6d62234a7c4fbaeb">7b2b85d7d323b72d47ec32af6d62234a7c4fbaeb</a></td>
<td>fixes ~~issue:95~~: Calendar custom field fixes</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/7c81814407f41d9bdb6037d5429a5a6640d2ce4b">7c81814407f41d9bdb6037d5429a5a6640d2ce4b</a></td>
<td>fixes ~~issue:92~~: set of minor bug fixes appeared along the last two years</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/d1624357216ef830f371ab2fc8994629005e69b9">d1624357216ef830f371ab2fc8994629005e69b9</a></td>
<td>fixes ~~issue:94~~: Mass edit and mass actions in general do not respect search criteria</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/1f8e10ee43417ed63d39f80e5da77115ee1f1b82">1f8e10ee43417ed63d39f80e5da77115ee1f1b82</a></td>
<td>accept negative numbers on inventory modules and show them correctly</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/159a280bdf4cea068f2fc1447e2a4ac6e8a0deba">159a280bdf4cea068f2fc1447e2a4ac6e8a0deba</a></td>
<td>fixes ~~issue:93~~: Email workflow task: email not sent to all if one is empty</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/0821d44dfa6eebd6389b173f477676cbd36dd40f">0821d44dfa6eebd6389b173f477676cbd36dd40f</a></td>
<td>fixes ~~issue:92~~: set of minor bug fixes appeared along the last two years</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/ae4e8e0da8ca4503c982ae511a728723a5ff79bd">ae4e8e0da8ca4503c982ae511a728723a5ff79bd</a></td>
<td>delete picklist dependencies on picklist delete</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/f6304ebbdd38b97f61a2c7bcf7bebf57cfffb75d">f6304ebbdd38b97f61a2c7bcf7bebf57cfffb75d</a></td>
<td>better aliasing in querys with many multiple joins to the same table</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/46ee92b5dfb336a9e4ab7657439eb5049ba3549a">46ee92b5dfb336a9e4ab7657439eb5049ba3549a</a></td>
<td>fixes ~~issue:91~~ accept slash bar in module numbering prefix</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/90df4add1f9b5f7d689a02453c4a47f5b680b020">90df4add1f9b5f7d689a02453c4a47f5b680b020</a></td>
<td>Fix wrong tax rendering in Products when the field is readonly</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/8cfc3f861bc8c9e50532a7d484aadfe6f174cb1d">8cfc3f861bc8c9e50532a7d484aadfe6f174cb1d</a></td>
<td>fixes ~~issue:90~~ javascript error loading empty file in popup</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/3b39e83ccce1dfb58831cf159b0869ced49a6f1e">3b39e83ccce1dfb58831cf159b0869ced49a6f1e</a></td>
<td>fixes ~~issue:89~~ Translation enhancements and fixes</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/a75e8bb33227de570d1e2a485aaaab4b3eb4f56d">a75e8bb33227de570d1e2a485aaaab4b3eb4f56d</a></td>
<td>fixes ~~issue:88~~ Lead Convert Field Mapping header formatting and adds translation fix</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/21a33c071777a312ca6ce11e4b13889994dc52a4">21a33c071777a312ca6ce11e4b13889994dc52a4</a></td>
<td>OpenOffice, LibreOffice + Rich Text Format merge feature</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/fda45199a75ee714637b183b0b09cb67092debd9">fda45199a75ee714637b183b0b09cb67092debd9</a></td>
<td>fixes ~~issue:86~~ Event and Task workflows not respecting AM/PM selection</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/0f580ee7251d9399f9c0337ffb3af0798fc143ba">0f580ee7251d9399f9c0337ffb3af0798fc143ba</a></td>
<td>config-dev.inc.php: config.inc.php developer override</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/af341ecfb7cb36672c2336941765ce9a88612f50">af341ecfb7cb36672c2336941765ce9a88612f50</a></td>
<td>minor CSS errors. Thanks John</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/a6c428820de5e3986e7244a5eb12b0aa753463a0">a6c428820de5e3986e7244a5eb12b0aa753463a0</a></td>
<td>fixes ~~issue:85~~ kcfinder_vulnerability</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/77ef404e95bfbe99592e920a3d38ff49f53f3146">77ef404e95bfbe99592e920a3d38ff49f53f3146</a></td>
<td>fixes ~~issue:84~~ getReturnPath</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/e2bad8614b705fc1779bbe6a0c3ab83c404b6b32">e2bad8614b705fc1779bbe6a0c3ab83c404b6b32</a></td>
<td>fixes ~~issue:83~~ security fixes in soap interface (CVE: 2013-3214)</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/2d1555d9f18969cf951a7bd9007cf5374ea68bd1">2d1555d9f18969cf951a7bd9007cf5374ea68bd1</a></td>
<td>fixes ~~issue:82~~ protect some sensitive directories from web access</td>
</tr>
<tr class="even">
<td><a href="https://github.com/tsolucio/corebos/commit/0de288e5a8f736fb4752e262846c84a0de8afc6b">0de288e5a8f736fb4752e262846c84a0de8afc6b</a></td>
<td>fixes ~~issue:81~~ On send PDF by email fill in email address by default</td>
</tr>
<tr class="odd">
<td><a href="https://github.com/tsolucio/corebos/commit/29129b89832b739ee060a79e28f65424dd8d2fd0">29129b89832b739ee060a79e28f65424dd8d2fd0</a></td>
<td>resolved ~~issue:80~~ Duplicate Filter</td>
</tr>
</tbody>
</table>

Full list of changes from my notes as I applied them
----------------------------------------------------

-   many translation and non-english enhancements
-   workflow and mass edit form POST for workflows/mass editions with
    many conditions/records
-   Lead Convert Field Mapping header formatting
-   SMS Status notification in non english language
-   Duplicate Filters (Save as)
-   minor bug fixes
-   uitype 10 fields tooltip support
-   Fix wrong tax rendering in Products when the field is readonly
-   campaign field on potential fix
-   button links on header icons to make navigation easier
-   mass edit search error
-   keep Select On Campaign Related Lists pagination
-   security deny all access to backup, schema and log directory from
    web
-   getReturnPath patch
-   getListButtons with module permission (Alan Lord)
-   better aliasing in querys with many multiple joins to the same table
-   negative values in inventory modules and better calculations to
    avoid errors
-   better formatting on detail view edit
-   email validation
-   better More Infor positioning to make it easier to access
-   compile {HANDLER} variable in inventory notification templates
-   vtiger \#7414: Import of Opportunities - Creates duplicate Contacts
-   enhance global search on HelpDesk related field
-   fix error calculating tab permissions when WebMail is deactivated
-   vtlib\_purifyForSql() function for enhanced security
-   more flexible sequence numbering prefix validation to accept numbers
    (year)
-   avoid repeated fields on calendar for users in various profiles
-   default values for calendar fields
-   kcfinder security patch
-   transfer Account Campaign Related Records when converting to lead
-   fix restricted account export on memberof
-   vtiger \#7595: Daylight saving time display problem in calendar
-   fix calendar Save redirect error
-   error exporting contact birthday on filter
-   custom field support in HelpDesk email
-   reporting enhancements on inventory product lines and numbers
-   scheduled reporting fixes: non-english character support
-   eliminate picklist dependencies when deleting picklist
-   tooltip on helpdesk fix
-   incorrect block for s\_h\_amount field produces incorrect reporting
-   Delete user extension in asterisk on user delete
-   Fix Workflow Time Fields (AM/PM always incorrect)
-   workflow email task with various variable email fields fix
-   soap: securitry and bug fixes
-   css fixes
-   vtlib new module export query duplicate table fix
-   config-dev for distributed programming
-   $logo$ email template variable support in Mail Manager

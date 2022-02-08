---
title: 'Help Desk:: Trouble Tickets'
---

Help Desk:: Trouble Tickets
===========================

~~QNA~~

??? Is it possible to make coreBOS work using "block hours" or "term
contracts"?

!!!A **block hours contract** is if they were to purchase 10 hours of
work up front. For every hour (e.g. hour of work on a trouble ticket) it
would take off the appropriate number of hours of the block hours that
were purchased.

To accomplish this the recommended approach is to create a **Service
Contract** with **Tracking Units** of type hours and with **Total
Units** set to 10 hours. Then each time a new trouble ticket is created
it must be related to the Service Contract (create through service
contract related list). When you close the ticket, indicate the total
number of hours used (or accumulate them with the Time Control module).
The field **Used Units** will automatically get filled in when you close
the ticket and that will update the rest of the fields on the service
contract like: progress, Actual Duration (in Days), end date and even
the status will be changed to closed. The only missing piece is to
launch an event that you could capture in workflows to send an email or
take some action (we are working on that), so you currently have to
manually filter the contracts to see which ones have expired.

!!! A **term contract** would be if the customer were on a 365 day
contract and it would automatically deduct a day off of the contract
until the 365 days had been completed.

This is a flat rate contract and can easily be accomplished with
recurring sales orders. You create a sales order when the client
contracts your service, you establish a recurring period depending on
the duration of the contract, when the time is up a new invoice will be
created, which is all you need to control.

You can see below an example setup for a **one year contract billed
monthly**:

<img src="/en/corebos/oneyearcontractbilledmonthly.png" class="align-center" width="830" />

This setup will create 11 invoices starting on 1st of November and
ending on 1st of September. You have to create the first one manually.

??? Is there a way that the block hours accepts decimal e.g like
1.7hours?﻿

!!!I just did a test and all I had to do to get it working with decimals
was change the typeofdata of the ticket field. It is set to integer so
it won't accept decimal values.

This is the query I used:

    UPDATE `vtiger_field`
     SET `uitype` = '7',`typeofdata` = 'N~O'
     WHERE `vtiger_field`.`fieldname` = 'hours' and tabid=13;

It would be better to change the type of the hours field in tickets from
varchar to decimal but it works the same.

&lt;WRAP center round info 60%&gt; This has been incorporated as default
behavior in coreBOS &lt;/WRAP&gt;

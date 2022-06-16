---
title: 'Accounting and Payment Module'
metadata:
    description: 'he goal of this extension is to be able to register any incoming or outgoing payment made by our company and associate that payment with other entities in the coreBOS application. '
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
        - adminmanuals
        - module
    tag:
        - accounting
        - payment
        
---
---

The goal of this extension is to be able to register any incoming or
outgoing payment made by our company and associate that payment with
other entities in the coreBOS application. The extension permits to
register payments that we will receive or will have to make in the
future so it is easy to create a report on payments forecast. With a
little effort we could calculate cash-flow or even the money in the cash
register at the end of the day.

This module permits us to register payments made against any of the
following entities, among others:

    *Invoice
    *PO
    *SO
    *Quote
    *Campaigns
    *Potentials
    *Trouble Ticket
    *Projects and Project Tasks
    *Assets
    *Products
    *Services
    *Service Contracts

by an Account, Contact, Vendor or Lead

The information fields that can be saved are:

    ***Assigned user**
    ***Reference**: free text for payment reference
    ***Date**: date payment is registered in the system
    ***Due date**: date we should get paid or pay
    ***Paid**: check box indicating if payment is done or not. Used for filtering and reporting
    ***Credit**: check box to indicate if we are receiving or paying (debit)
    ***Payment mode**: dropdown selectbox (Cash, Check, Visa,...)
    ***Payment category**: dropdown selectbox, basically open for unforeseen usage but could be very useful for filling up with accounting groups for ledger control
    ***Amount** paid/received: how much we are given or how much we are giving
    ***Cost** how much does it cost us to deliver this service
    ***Benefit**: is automatically calculated. Useful for reporting.
    ***Related User**: Used to assign the money movement to a user. Very useful for calculating commissions.
    ***Description**: free text for comments

You can use coreBOS's reporting engine to get reports on this module.  
The module is vtlib compatible and respects the normal coreBOS features
as role permission control, custom fields, picklist editing,
import/export, ...

Some of the many features that can be added from this starting point
could be:

    *prepayments are accepted and automatically inserted when creating a SO or Invoice (for example)
    *balance due is automatically calculated and printed on PDF
    *relation of payments made on SO or Invoice show up on their "More Information" tab
    *...

Without these enhancements you would have to create a new payment each
time a payment is made. The enhancements I propose are just to make
workflow easier and are very dependent on how each company works, the
payment module "as is" is already very useful if you need to control the
money moving around in your company.

The module has a basic **Payment History** tab where information about
the changes can be consulted.

We also have this module integrated into our [business intelligence integration](http://bievolutivo.com/) for special reporting to get
weekly, monthly and yearly ratios of the money in the company. Among
others, like OLAP navigation of the payments.

We also have a simple patch that enhances the module with capability to
easily support **partial payments**. We add a few fields on the invoice
and have the payment module automatically fill in these fields on each
payment. We add an amount paid and an amount due, as payments associated
to the invoice are marked paid these fields get filled in, so you can
see the pending and received amounts easily, and since they are normal
fields you can report on them directly in coreBOS reporting system.

The **partial payment** workflow would be something like this: you
create an invoice for the total amount, you create the agreed payments,
for example, 30% on the day of creation, 30% in 30 days and 40% in 60
days. You mark the first payment as paid and the others are pending. The
amount due on the invoice shows 70% of the total. With this simple
scheme you can report on pending payments on any dates, or on payments
due, or on pending payments, ...

**Total and Pending Payment control on Accounts and Contacts** adds
three new fields on the module that sum the total amount of payments
made, pending and the balance due.

### Status changes of related modules

When the sum of amounts of payment records related to a SalesOrder,
PurchaseOrder or Invoice are equal to the total of the record, the
status will be changed and workflows launched.

You can define which status you want using the next global variables:

-   CobroPago\_Invoice\_Status\_OnPaid -&gt; default value is 'Paid'
-   CobroPago\_PurchaseOrder\_Status\_OnPaid -&gt; default value is
    'Received Shipment'
-   CobroPago\_SalesOrder\_Status\_OnPaid -&gt; default value is
    'Delivered'

<div class="notices blue"> You can deactivate the status change
by setting the global variable to 'DoNotChange' </div>

### Block Payment Record

As an additional feature, this version blocks paid payments. If a
payment is marked paid it cannot be edited. This behaviour can be
changed through the $Block\_paid variable in
modules/CobroPago/bluepay\_config.php

Prices
------

-   Payment module: free, open source, donations are very necessary,
    please consider maintaining our effort
-   Partial Payment control on invoices and purchase orders costs 45
    euros.
-   Total and Pending Payment control on accounts, contacts and vendors
    costs 45 euros.

<div class="notices blue"> Both paid enhancements are included
in our subscription package. </div>

Our paypal account: paypal (at) tsolucio (dot) com

Thank you

Some demos
----------

**Demo of Total and Pending Payment control on accounts**

[plugin:youtube](https://youtu.be/kPNFB8PL87w)

Automatic Partial Payment with coreBOS Workflows
------------------------------------------------

coreBOS 5.4.0 has introduced a new workflow functionality: **Creation of
Entities**. With this functionality we can create new records in a
module when an event is launched in another related module. For example,
we can create payment records when we create an invoice automatically.

This is a very powerful feature in many modules but has special
relevance in conjunction with the partial payment extension in our
module. For example, we could add a picklist of payment methods to our
invoice and have all the payments directly created for us depending on
the method. Let's suppose we have a payment method of 30% on creation,
30% after 45 days and 40% after 75 days. We could create a workflow that
automatically created the payments for us using the workflow system.

Here are a few screen shots of how that would look (more or less):

![](cypwf01.png?width=100%)

![](cypwf02.png?width=100%)

![](cypwf03.png?width=100%)


ax Accounting to TSolucio Payment Control
-----------------------------------------

We have created a simple process to copy all your payment information
from ax Accounting to our payment control module.

Both modules are very similar in functionality, but not in the form of
implementing that functionality. We think our modules is much more
inline with coreBOS philosophy. This makes the code easier to maintain
and presents an inexistent learning curve for the users as they already
know how to use coreBOS. It also means that it is less eye-catching as
it is less colorful (as coreBOS itself).

In any case both modules solve the problem and this process we give away
here is mostly for those people who want to move away from axAccouting
for whatever reason. Since the modules are not identical I will try to
explain some of the sacrifices that need to be accepted.

The main change is in the way partial payments are handled. In
axAccounting you create one payment record which presents the whole of
the amount to be collected and then add partial payments to it. The way
I see it there is no other module in coreBOS that works like this, at
most invoices have a similar (master-detail) relation and we already
know how hard it is to customize that module, so this makes their module
harder to maintain, with a lot of special code to handle that new way of
working, this also breaks the user experience. I don't know if their
user experience is more user friendly or not, but it has nothing to do
with the way all the rest of the application works, so there are
additional questions asked and more support needed.

The way we approached partial payments is that the full amount to be
collected is reflected on the sales order or invoice, then each payment
record you associated to the invoice represents a partial payment, you
establish it's relation as you do with any other module, since each
record is just a normal record, related lists, filters, reporting, ...
all follow the vtieger crm way.

So the migration process we have created will actually migrate the
partial payment records contained inside the axAccounting payment
records, not the main full amount record. Obviously most of the
information there will be copied to payment control records as we strive
to not lose any information. In other words we will flatten the existing
structure, relating each partial payment directly to it's SO or invoice.

We add a currency picklist to the payment records and copy the
information into it but this **does not** make the payment module
multi-currency. There are many more things to contemplate in making the
module multi-currency then adding a picklist. We simply do not lose the
information.

We also add a new auto-numeric reference field and create the necessary
custom fields for the migration.

Finally there is one last thing to consider.

The rest of the fields are already equivalent and will simply be copied.

We have left out the special graphical reporting screen which can
probably be obtained in 5.4.0 with the native reporting and graphic
support, and also the mass partial payment creation feature which,
hopefully we will implement some day.

FAQ
---

<div class="notices blue"> <h2>Where is the download link?</h2>

It is available from coreBOS 5.6 forward. You can get it on GitHub </div>

<div class="notices blue"> <h2>Is it related to Invoice/Account/YourModule? </h2>

By default it is NOT
related to any other module as the relations and other actions depend on
the necessities of each user. We have a script to establish the
relations.</div>

<div class="notices blue"> <h2>How does it work?</h2>
</div>

<div class="notices blue"> <h2>When the invoice is created… does it show how much the customer owe… then when payment is made does it subtract the amount to invoice?</h2>
</div>

<div class="notices blue"> <h2>Then does it show customer total amount owing?</h2>

The payment module only registers payments, in or out, you have to manually add the payments in the module.
For example, you create an invoice, then you go to the payments module and add a payment, a client pays a partial sum of an invoice, you go to the payment module and add a payment (in), you receive an order and pay the shipping company so yo go to the payment module and register the payment (out).

If you register all the payments and relate them to the account and invoice/SO, then you can obtain reports on the amounts paid and received.

That is what you can see on the demo and what the payment module is for.

Now from this starting point we can adapt the module to your companies needs.

If you want to automatically create a due payment every time an invoice is created we have to add this. If you want to be able to go to the "more information" tab on any account and see a relation of all his payments, we have to add this in, etc….

So our payment module gives you a starting point from which to register all payments, from there we can help you make things easier by customizing some processes.</div>

<div class="notices blue"> <h2>Will I be able to create a deposit invoice and after that a final invoice which would include the deposit payment and how much is due?</h2>

This is similar to the question above. This module gives you a starting point from which you can adapt to your company, the exact same philosophy we follow with the whole coreBOS application.

In this case I would not recommend creating two invoice for the same concept. What we usually do to follow partial payments is add some process to the invoice. Each time a payment is registered against an invoice we update a new custom field called "Amount Due", once you have this field you can report and easily obtain invoices with some pending amount. We then add some more process and change the status of the invoice to Paid once the amount due falls to zero. So our "most used" implementation creates invoices as you usually do in coreBOS and then the payments module registers the payments made to control the pending invoices and their state.

Although this is what I would recommend and seems to be the easiest way to use the module we can adapt it to your specific business process needs in any way you may see fit.

This implementation <strong>IS NOT</strong> included in the base module.</div>

<div class="notices blue"> <h2>I need to implement a payment module but am a little lost with your different pricing and what it does. I need a full real payment module. If you can't get partial payments, if you can't link the payment to invoice, if you can't flag an invoice as paid, partially paid, if you can't send automatic reminders by gathering all unpaid invoices etc.... then the payment module is a gadget and can't use it. Can you help me figure out what the module does and DOES NOT?</h2>

I understand, thing is that since this is open source we get many requests for just a basic starting point on which others construct their own needs, so the gadget is useful to some. Also since, the other features require code modifications it makes distributing the solution a bit more complex so we try to avoid that.

In any case, as to your request, you need all three options: the module, the relations of this new module and the partial payment control.

With all three you will be able to manage partial payments, linked to invoices and other entities, you can already flag an invoice as paid or partially paid as these are just states that you create on the invoice, to send reminders isn't really something associated to the payment module but directly to the invoices, you can use the workflow extension to send the reminders, although that is limited, but gathering a list of unpaid invoices based on date is easy with a filter or report, sending reminders is a bit more difficult, but we can discuss a solution if necessary.</div>

<div class="notices blue"> <h2>Is it multilingual ( French and English)?</h2>

English, Spanish and French, among others are supported at the moment</div>

<div class="notices blue"> <h2>Is it multi-currency?</h2>

It is NOT multi-currency. </div>


<div class="notices blue"> <h2>Is it platform independent (or Linux or Windows or both)?</h2>

It is platform independent, but works better in linux :-) </div>

<div class="notices blue"> <h2>What is the difference between the two extensions being sold?</h2>

It is platform independent, but works better in linux :-) </div>

<div class="notices blue"> <h2>Is it platform independent (or Linux or Windows or both)?</h2>

The payment module that you can download is not integrated with other modules automatically, that is, if you create an invoice, and you associate a partial payment, this fact is not reflected on the invoice. Obviously, you can go to the more information tab and see the payments, but there will be no change in the fields of the invoice. The extension of partial payments, adds some new fields on the invoice representing the amounts paid and the amount due automatically, or if you make a payment associated with an invoice, it automatically updates the amount paid and the balance, and if the outstanding amount is 0 it will change the status of the invoice to paid. This greatly facilitates the reporting of outstanding amounts.

The other extensions is similar, it adds some fields to the account where totals and pending amounts are registered, independently of the invoices or amounts pending to be paid. These calculations are done automatically when payment records are created/edited.

Both are independent, and can be acquired separately </div>

<div class="notices blue"> <h2>We have already installed the payment module. However I'm not sure how can I generate multiple invoices, eg: <br>
- first invoice: 30% of the amount<br>
- 2nd invoice: 30% of the amount<br>
- final invoice: 40% balance</h2>

Payment control is not for generating various invoices. The idea is that you generate one invoice for the full amount and receive partial payments until the invoice is fully paid. The extension controls the amounts paid and due on the invoice. You can then create special PDF outputs for invoices with pending amounts and fully paid ones.

Obviously you can create the three invoices and associate a payment to each one. As you mark the payments as paid the invoices will change their status so you can easily control the pending ones also with this system.

We have some clients that do this: create the first invoice and associate the three payments. The first payment cancels the first invoice. The other two payments are pending and related to the first invoice. When time comes to create the second invoice, they create the invoice and associate the second payment to this one.</div>

<div class="notices blue"> <h2>Are the payment records shown on the PDF?</h2>

No, this must be programmed either in the PDF of coreBOS or using PDFMaker functions. Using PDFMaker, you can generate a PDF for each payment or you can create a custom function that includes all the Payments directly in the PDF of the invoice in the format you need. We have created several of these functions for different customers with their specific formats so it should be easy for us to create one to cover your requirements quickly.</div>

<div class="notices blue"> <h2>Account/Contact and related to fields lists everything in the database. Would it be possible to restrict it based on the other field (account/contact restricted based on the related to and vice versa)?</h2>

This is hard to do in coreBOS, what we have done is implement a "usual" use case. Try going to the related list of an invoice and adding a payment, you will see that most of the fields are filled in for you. This happens with sales order also (at least). The idea is that you create an invoice and once you are on that invoice you go to it's related list and create the payments from there. </div>
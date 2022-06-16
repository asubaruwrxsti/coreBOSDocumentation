---
title: 'coreBOS Product/Price Enhancements'
metadata:
    description: 'coreBOS Product/Price Enhancements'
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
        - google
        - integration
    tag:
        - contacts
---
---
Entity Relation
---------------

-  [Entity Relation Diagram](https://discussions.corebos.org/documentation/lib/exe/fetch.php?media=en:devel:cbproductpriceer.pdf)
-  [Entity Relation Diagram](cbproductpriceer.odg) 

Services
--------

Given a Sales Product, we can call these methods:

-   **getCategory** ($date='\*',$primary='\*'): array of categories the
    product belongs to on the given date, if primary is given then only
    primary categories will be returned
-   **getFeatures** ($date='\*', $available='\*', $default='\*',
    $accid=0, $availablegeobid=0, $pricegeobid=0, $rotacion=0,
    $currencyid=1, $oferta=0): array of all the features of the product
    that fulfill the given parameters
-   **getPriceDetails** ($date='\*',$accid=0,$geobid=0,$apply='\*',
    $context): this is the main price retrieval service, it will return
    any price type ($apply) and will also apply a coreBOS rule that can
    be selected on the price record itself. The $context array will be
    passed into the rule along with the information of the price
    -   **getBasePrice** ($date='\*',$accid=0,$geobid=0, $context):
        calls getPriceDetails with apply=Base
    -   **getCost** ($date='\*',$accid=0,$geobid=0, $context): calls
        getPriceDetails with apply=Cost
    -   **getSurcharge** ($date='\*',$accid=0,$geobid=0, $context):
        calls getPriceDetails with apply=Surcharge
    -   **getMaterial** ($date='\*',$accid=0,$geobid=0, $context): calls
        getPriceDetails with apply=Material
    -   **getDiscount** ($date = '\*', $accid = 0, $geobid = 0, $context
        = false): calls getPriceDetails with apply=Discount
-   **getPriceInformation**
    ($date='\*',$accid=0,$geobid=0,$apply='\*',$currencyid=1,
    $context=false): calls getPriceDetails for all the possible types
    and returns the results

Feature:

-   **getInteractions** ($spid): returns all interactions the given
    Sales Product has
-   **getPriceDetails**
    ($date='\*',$accid=0,$geobid=0,$apply='\*',$productcontext=0)
    -   **getBasePrice**
        ($date='\*',$accid=0,$geobid=0,$productcontext=0)
    -   **getCost** ($date='\*',$accid=0,$geobid=0,$productcontext=0)
    -   **getMaterial**
        ($date='\*',$accid=0,$geobid=0,$productcontext=0)
    -   **getSurcharge**
        ($date='\*',$accid=0,$geobid=0,$productcontext=0)
    -   **getDiscount**
        ($date='\*',$accid=0,$geobid=0,$productcontext=0)
-   **getPriceInformation**
    ($date='\*',$accid=0,$geobid=0,$apply='\*',$currencyid=1,$productcontext=0)

<div class="notices blue">
read Sales Product definitions of the
methods</div>

Product Association

-   **getRelation**
    ($fromProduct='\*',$toProduct='\*',$fromDate='\*',$toDate='\*',$relationType='\*')

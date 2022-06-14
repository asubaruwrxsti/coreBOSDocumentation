---
title: 'How to add an action button to a module::payment gateway'
metadata:
    description: 'How to add an action button to a module::payment gateway'
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
        - coreBos
    tag:
        - portal
---
---
A common request is to add a button on the list and detail view of the records for a module.

In this tutorial I will show how to add a “Pay Now” button for the [coreBOS Payment Module](http://localhost/coreBOSDocumentation/user-manual/coreboscyp).

If you just want the code, [here is the patch](https://discussions.corebos.org/documentation/lib/exe/fetch.php?media=devel:patches:coreboscp_addpaynowbutontocyp.patch).

## Step 1: Icon and label

Our first step is to add an image for the icons and the translation of the label. I picked this icon: ![](pay.png?width=3%) . It has to be 16 by 16 pixels and copied into the *images/icons/fugue/16* directory.

For the translation I picked the label “paycyp” and added it to the English and Spanish translation files:

```
diff --git a/protected/messages/en/core.xml b/protected/messages/en/core.xml
index 3a3bf17..7bbd3dc 100644
--- a/protected/messages/en/core.xml
+++ b/protected/messages/en/core.xml
@@ -192,4 +192,5 @@
 	<entry id="impuestos">Taxes</entry>
 	<entry id="customerPortalNotConfigured">Customer Portal is not correctly configured.&lt;br/&gt;Please contact your application administrator.</entry>
 	<entry id="customerPortalPageNotFound">The requested page could not be found in the Customer Portal.&lt;br/&gt;Review the URL or contact your application administrator with the steps to reproduce the error.</entry>
+	<entry id="paycyp">Pay</entry>
 </category>
diff --git a/protected/messages/es_es/core.xml b/protected/messages/es_es/core.xml
index 16bfb10..3dfb4af 100644
--- a/protected/messages/es_es/core.xml
+++ b/protected/messages/es_es/core.xml
@@ -192,4 +192,5 @@
   <entry id="impuestos">Impuestos</entry>
   <entry id="customerPortalNotConfigured">El Portal del Cliente no está correctamente configurado.&lt;br/&gt;Por favor avisa al administrador de la aplicación.</entry>
   <entry id="customerPortalPageNotFound">La página solicitada no se ha encontrado en el Portal del Cliente.&lt;br/&gt;Revisa la URL o informa al administrador de la aplicación con los pasos para reproducir el error.</entry>
+  <entry id="paycyp">Pagar</entry>
 </category>
```
## Step 2: Add icon to list view

We have a special class that takes care of painting the buttons on the list view. It is *protected/components/vtyiicpngButtonColumn.php*. This class is consulted for each record line on the grid and decides if the icon should be shown or not. So we have to add our new action to this class and tell it to show the icon for the payment module. This can be seen here:
```
diff --git a/protected/components/vtyiicpngButtonColumn.php b/protected/components/vtyiicpngButtonColumn.php
index 30a260a..ad39f14 100644
--- a/protected/components/vtyiicpngButtonColumn.php
+++ b/protected/components/vtyiicpngButtonColumn.php
@@ -55,6 +55,10 @@ class vtyiicpngButtonColumn extends CButtonColumn
 				$mod = $data->getModule();
 				$ret = $moduleAccessInformation[$mod]['retrieveable'] && in_array($mod,array('Invoice','Quotes','SalesOrder','PurchaseOrder'));
 				break;
+			case 'pay':
+				$mod = $data->getModule();
+				$ret = $moduleAccessInformation[$mod]['retrieveable'] && $mod == 'CobroPago';
+				break;
 			default:
 				$ret = true;
 				break;
```

**Note**: that this class checks if the module is CobroPago for the pay button, so we could easily add also a check to see if the current record is paid or not.

Now that the class will check if the icon should be shown or not we have to add it to the list view:

```
diff --git a/protected/views/vtentity/admin.php b/protected/views/vtentity/admin.php
index 5afc7e7..8433dad 100644
--- a/protected/views/vtentity/admin.php
+++ b/protected/views/vtentity/admin.php
@@ -55,7 +55,7 @@ $('.search-form form').submit(function(){
 		$model->gridViewColumns(),// $model->getDetailGridFields($lvfields,$lvlinkfields), this worked in ENTITY
 		array(array(
 			'class'=>'vtyiicpngButtonColumn',
-			'template'=>'{view}{update}{delete}{dlpdf}', //{related}',               
+			'template'=>'{view}{update}{delete}{dlpdf}{pay}', //{related}',
 			'header'=>CHtml::dropDownList('pageSize',
 				$pageSize,
 				array(5=>5,10=>10,20=>20,30=>30,50=>50,100=>100),
@@ -77,6 +77,11 @@ $('.search-form form').submit(function(){
 					'imageUrl'=>ICONPATH . '/16/pdf_icon_16.gif',
 					'url'=>'"javascript: filedownload.download(\''.yii::app()->baseUrl.'/index.php/'.$modelURL.'/downloadpdf/".$data["'.$model->entityidField."\"].\"','')\"",
 				),
+				'pay' => array (
+					'label'=>Yii::t('core', 'paycyp'),
+					'imageUrl'=>ICONPATH . '/16/pay.png',
+					'url'=>'"javascript: sendtopaygateway(\'".$data["'.$model->entityidField."\"].\"')\"",
+				),
 			),
 		/*
 			'buttons'=>array(
```

As can be seen we add the {pay} place holder in the action template and then add an action entry that will define how to show the icon on screen where we use the icon, the label and add the action we want executed on click: in this case *sendtopaygateway*

## Step 3: Add button to detail view

For this we follow a similar process as for the list view; we add the button for all detail views and then add some code to decide if the button should be shown or not. So first we put the button:

```
diff --git a/protected/views/layouts/_tableMenu.php b/protected/views/layouts/_tableMenu.php
index a15c387..0499af3 100644
--- a/protected/views/layouts/_tableMenu.php
+++ b/protected/views/layouts/_tableMenu.php
@@ -88,6 +88,19 @@
 				'visible' => $this->viewButtonDownloadPDF && in_array($this->entity,array('Invoice','Quotes','SalesOrder','PurchaseOrder','Documents')),
 			),
 			array(
+				'label' => Yii::t('core','paycyp'),
+				'icon' => 'pay',
+				'link' => array(
+					'url' => 'javascript:void(0)',
+					'htmlOptions' => array(
+						'class'=>'icon',
+						'id' => 'paycyp-button',
+						'onclick'=>'javascript: sendtopaygateway($("#entityidValue").val());return false;'
+					),
+				),
+				'visible' => $this->viewButtonPayCyP && $this->entity=='CobroPago',
+			),
+			array(
 				'label' => Yii::t('core','export'),
 				'icon' => 'export',
 				'link' => array(
```

As can be seen we define the button with an array which uses the label, the icon and then defines the action to be launched. Finally there is a visible condition which checks if the button should be shown or not. This condition uses a main class property to force the visibility or not and then an additional condition to check for the correct module.

In the next piece of code we define the necessary variables.

```
diff --git a/protected/controllers/VtentityController.php b/protected/controllers/VtentityController.php
index 32b6ac2..a2ba830 100644
--- a/protected/controllers/VtentityController.php
+++ b/protected/controllers/VtentityController.php
@@ -41,6 +41,7 @@ class VtentityController extends Controller
 	public $viewButtonCreate=false;
 	public $viewButtonSearch=false;
 	public $viewButtonDownloadPDF=false;
+	public $viewButtonPayCyP=false;
 
 	public function __construct($id,$module)
 	{
@@ -345,6 +346,7 @@ class VtentityController extends Controller
 		$this->setCRUDpermissions($model->getModule());
 		$this->viewButtonSearch=false;
 		$this->viewButtonDownloadPDF=true;
+		$this->viewButtonPayCyP=true;
 		$dataProvider=$model->search($pos);
 		$this->render('//vtentity/index',array(
 			'dataProvider'=>$dataProvider,
@@ -402,6 +404,7 @@ class VtentityController extends Controller
 			if ($model->getAttribute('filelocationtype') == 'E')
 				$this->viewButtonDownloadPDF=false;
 		}
+		$this->viewButtonPayCyP=true;
 		$this->render('//vtentity/view',array(
 			'model'=>$model,
 		));
```

## Step 4: Add action code

In this case I set up the action to launch a javascript function called *sendtopaygateway* so we can add this code to any of our loaded javascript libraries and do our magic there. I decided to put it in *main.js*

```
diff --git a/js/main.js b/js/main.js
index 821058c..7d31eec 100644
--- a/js/main.js
+++ b/js/main.js
@@ -192,3 +192,25 @@ var filedownload = {
 		
 	}
 };
+
+function sendtopaygateway(cypid) {
+	// create form with data values and send
+       var url = 'https://your.corebos.tld/Payment.php';
+       var data = {
+               'cpid': cypid,
+               'returnUrl': 'https://your.coreboscp.tld/index.php#site/ThankYouForPayment.php',
+               'cancelUrl': 'https://your.coreboscp.tld/index.php#site/ErrorInPayment.php'
+	};
+	var form = $('<form id="paypal-form" action="' + url + '" method="POST"></form');
+	
+	for(x in data){
+		form.append('<input type="hidden" name="'+x+'" value="'+data[x]+'" />');
+	}
+	
+	// append form
+	$('body').append(form);
+	
+	// submit form
+	$('#paypal-form').submit();
+
+}
\ No newline at end of file
```

And that should be all you need to get your new button.
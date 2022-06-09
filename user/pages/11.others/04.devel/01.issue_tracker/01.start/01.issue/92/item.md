---
title: '92: set of minor bug fixes appeared along the last two years'
metadata:
    description: '92: set of minor bug fixes appeared along the last two years'
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
        - documentation
    tag:
        - issue
---

Issue Reference in Tracker: ~issue:92~

## Detailed Explanation

The commit has the full details of all the changes but some of the changes are made in packaged modules, so those changes aren't directly visible in the patch and are only useful for new installs, in our effort to help existing installation I detail below the changes made to packaged files.

## Tooltip does not work with HelpDesk Title field

```
Index: modules/Tooltip/ComputeTooltip.php
===================================================================
--- modules/Tooltip/ComputeTooltip.php	(revisión: 280)
+++ modules/Tooltip/ComputeTooltip.php	(revisión: 914)
@@ -15,10 +15,12 @@
 
 global $current_user,$log;
 
-$modname = $_REQUEST['modname'];
-$id = $_REQUEST['id'];
-$fieldname = $_REQUEST['fieldname'];
+$modname = vtlib_purify($_REQUEST['modname']);
+$id = vtlib_purify($_REQUEST['id']);
+$fieldname = vtlib_purify($_REQUEST['fieldname']);
 $tabid = getTabid($modname);
+if($tabid == '13' && $fieldname == 'title')
+	$fieldname = 'ticket_title';
 $result = ToolTipExists($fieldname,$tabid);
 if($result !== false){
 //get tooltip information
@@ -28,6 +30,7 @@
 	$sql = "select * from $modname where id ='$id';";
 	$result = vtws_query($sql, $current_user);
 	if(empty($result)){
+		echo getTranslatedString('LBL_RECORD_NOT_FOUND');
 		exit(0);
 	}
 	$result = vttooltip_processResult($result, $descObject);
```

## SMS Status notifier does not work in non-english language
```
Index: Smarty/templates/modules/SMSNotifier/DetailView.tpl
===================================================================
--- Smarty/templates/modules/SMSNotifier/DetailView.tpl	(revisión: 284)
+++ Smarty/templates/modules/SMSNotifier/DetailView.tpl	(revisión: 285)
@@ -330,11 +330,19 @@
 {/if}
 							</table>
 {if $header neq 'Comments'}
+              {if $header eq $MOD.StatusInformation}
+              {if $BLOCKINITIALSTATUS[$header] eq 1}
+							<div style="width:auto;display:block;" id="tblStatusInformation" >
+							{else}
+							<div style="width:auto;display:none;" id="tblStatusInformation" >
+							{/if}
+							{else}
 							{if $BLOCKINITIALSTATUS[$header] eq 1}
 							<div style="width:auto;display:block;" id="tbl{$header|replace:' ':''}" >
 							{else}
 							<div style="width:auto;display:none;" id="tbl{$header|replace:' ':''}" >
 							{/if}
+							{/if}
 							<table border=0 cellspacing=0 cellpadding=0 width="100%" class="small">
 						   {foreach item=detail from=$detail}
 						     <tr style="height:25px">
```

## Eliminate fatal log message in Cron

```
Index: modules/CronTasks/CronSequence.php
===================================================================
--- modules/CronTasks/CronSequence.php	(revisión: 656)
+++ modules/CronTasks/CronSequence.php	(revisión: 657)
@@ -11,7 +11,6 @@
 
 $id = $_REQUEST['record'];
 $move  = $_REQUEST['move'];
-$log->fatal("$id,$move");
 
 if($move == 'Down'){
 	$sequence = $adb->pquery("SELECT sequence FROM vtiger_cron_task WHERE id = ?", array($id));
```

## Always merge the logo in email templates that contain the $logo$ template variable

```
Index: modules/MailManager/src/controllers/MailController.php
===================================================================
--- modules/MailManager/src/controllers/MailController.php      (revisión: 7076)
+++ modules/MailManager/src/controllers/MailController.php      (copia de trabajo)
@@ -144,6 +144,14 @@
                                                $description = $body;
                                        }
 
+                                       $pos = strpos($description, '$logo$');
+                                       if ($pos !== false)
+                                       {
+       
+                                               $description =str_replace('$logo$','<img src="cid:logo" />',$description);
+                                               $logo=1;
+                                       }
+
                                        $fromEmail = $connector->getFromEmailAddress();
                                        $userFullName = getFullNameFromArray('Users', $current_user->column_fields);
                                        $userId = $current_user->id;
@@ -164,6 +172,15 @@
                
                                        $attachments = $connector->getAttachmentDetails($emailId);
 
+                                       if($logo){
+                                           $logo_attach = array(
+                                                                'name' => 'logo',
+                                                                'path' => 'themes/images/',
+                                                                'attachment' => 'logo_mail.jpg',
+                                                               );
+                                           $mailer->AddEmbeddedImage($logo_attach['path'].$logo_attach['attachment'],$logo_attach['name'],$logo_attach['name'].'jpg','base64','image/jpg');
+                                       }
+
                                        $mailer->AddAddress($to);
                                        foreach($ccs as $cc) $mailer->AddCC($cc);
                                        foreach($bccs as $bcc)$mailer->AddBCC($bcc);
```
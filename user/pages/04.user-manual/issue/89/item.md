---
title: '89: Translation enhancements and fixes'
metadata:
    description: '89: Translation enhancements and fixes'
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

## Detailed Explanation

The commit has the full details of all the changes but some of the changes are made in packaged modules, so those changes aren't directly visible in the patch and are only useful for new installs, in our effort to help existing installation I detail below the changes made to packaged files.

```
Index: Smarty/templates/modules/ModTracker/BasicSettingsContents.tpl
===================================================================
--- Smarty/templates/modules/ModTracker/BasicSettingsContents.tpl       (revisión: 7076)
+++ Smarty/templates/modules/ModTracker/BasicSettingsContents.tpl       (copia de trabajo)
@@ -16,17 +16,17 @@
     </tr>
     {foreach item=module from=$INFOMODULES}
     <tr onmouseover="this.className='prvPrfHoverOn'" onmouseout="this.className='prvPrfHoverOff'">
-        <td class="listTableRow small" width="50%">{$module.name|@getTranslatedString}</td>
+        <td class="listTableRow small" width="50%">{$module.name|@getTranslatedString:$module.name}</td>
         <td class="listTableRow cellText small"  align="center">
         <div id="status" style="position:absolute;left:850px;top:5px;height:27px;white-space:nowrap;display:none"><img src="themes/softed/images/status.gif"></div>
 
         {if $module.visible eq '1'}
                        <a href="javascript:void(0);" onclick="toggleModule_mod('{$module.tabid}', 'module_disable');">
-                        <img src="{'enabled.gif'|@vtiger_imageurl:$THEME}" border="0" align="absmiddle" alt="{$MOD.LBL_DISABLE} {$module.name}" title="{$MOD.LBL_DISABLE} {$module.name|@getTranslatedString}">
+                        <img src="{'enabled.gif'|@vtiger_imageurl:$THEME}" border="0" align="absmiddle" alt="{$MOD.LBL_DISABLE} {$module.name}" title="{$MOD.LBL_DISABLE} {$module.name|@getTranslatedString:$module.name}">
                        </a>
                {else}
                        <a href="javascript:void(0);" onclick="toggleModule_mod('{$module.tabid}', 'module_enable');">
-                       <img src="{'disabled.gif'|@vtiger_imageurl:$THEME}" border="0" align="absmiddle" alt="{$MOD.LBL_ENABLE} {$module.name}" title="{$MOD.LBL_ENABLE} {$module.name|@getTranslatedString}">
+                       <img src="{'disabled.gif'|@vtiger_imageurl:$THEME}" border="0" align="absmiddle" alt="{$MOD.LBL_ENABLE} {$module.name}" title="{$MOD.LBL_ENABLE} {$module.name|@getTranslatedString:$module.name}">
                        </a>
                {/if}

```
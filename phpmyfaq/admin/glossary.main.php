<?php
/**
* $Id: glossary.main.php,v 1.4 2005-09-18 19:57:00 thorstenr Exp $
*
* The main glossary index file
*
* @author       Thorsten Rinne <thorsten@phpmyfaq.de>
* @since        2005-09-15
* @copyright    (c) 2005 phpMyFAQ Team
* 
* The contents of this file are subject to the Mozilla Public License
* Version 1.1 (the "License"); you may not use this file except in
* compliance with the License. You may obtain a copy of the License at
* http://www.mozilla.org/MPL/
* 
* Software distributed under the License is distributed on an "AS IS"
* basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
* License for the specific language governing rights and limitations
* under the License.
*/

print sprintf('<h2>%s</h2>', $PMF_LANG['ad_menu_glossary']);

if ($permission['addglossary'] || $permission['editglossary'] || $permission['delglossary']) {

    require_once('../inc/glossary.php');
    $glossary = new PMF_Glossary($db, $LANGCODE);
    $glossaryItems = $glossary->getAllGlossaryItems();
    
    print '<table class="list">';
    print sprintf("<tr><th class=\"list\">%s</th><th class=\"list\">%s</th><th>&nbsp;</th></tr>", $PMF_LANG['ad_glossary_item'], $PMF_LANG['ad_glossary_definition']);
    
    foreach ($glossaryItems as $items) {
    	print '<tr>';
    	print sprintf('<td class="list"><a href="%s%d">%s</a></td>', $linkext.'&amp;aktion=editglossary&amp;id=', $items['id'], $items['item']);
    	print sprintf('<td class="list">%s</td>', $items['definition']);
    	print sprintf('<td class="list"><a href="%s%d"><img src="images/delete.gif" width="17" height="18" alt="%s" title="%s" border="0" /></a></td>', $linkext.'&amp;aktion=deleteglossary&amp;id=', $items['id'], $PMF_LANG['ad_user_del_3'], $PMF_LANG['ad_user_del_3']);
    	print '</tr>';
    }
    print '</table>';
    
    print sprintf('<p>[ <a href="%s&amp;aktion=addglossary">%s</a> ]</p>', $_SERVER['PHP_SELF'].$linkext, $PMF_LANG['ad_glossary_add']);
    
} else {
    print $PMF_LANG["err_NotAuth"];
}
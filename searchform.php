<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Search Form Template
 *
 * @link           http://codex.wordpress.org/Function_Reference/get_search_form
 */
?>
<div class="service-nav-search">
    <form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
        <input type="text" class="field" name="s" id="tx-indexedsearch-searchbox-sword" placeholder="<?php if (ICL_LANGUAGE_CODE == 'fr'): { esc_attr_e('Chercher &hellip;', 'gconverter'); 
        } elseif (ICL_LANGUAGE_CODE == 'it'): {
        	esc_attr_e('Cerca &hellip;', 'gconverter'); 
       	} elseif (ICL_LANGUAGE_CODE == 'de'): {
       		esc_attr_e('Suchen &hellip;', 'gconverter'); 
       	} else: {
esc_attr_e('search &hellip;', 'gconverter'); 
	
        } endif;	?>" />
        <input type="submit" class="submit" name="submit" id="search-button" value="&nbsp;" />
    </form>
</div>
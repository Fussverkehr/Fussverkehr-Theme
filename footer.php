<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        gConverter 
 * @filesource     wp-content/themes/gconverter/footer.php
 */
?>
<?php if (!is_home()) { ?>
    </div><!-- end of main-container -->
<?php } ?>
<div id="footer">
    <?php get_sidebar('footerx'); ?>
</div>
</div><!-- end of wrapper -->
<?php wp_footer(); ?>
</body>
</html>
<?php


function gconverter_cmbi_a_render_variable_box($post) {
    
    $existing_var1 = get_post_meta($post->ID,'_gc_cmbi_a_var1', true);
    
	?>
    
    <label for="_gc_cmbi_a_var1">Var1 Label:</label> <input type="text" name="_gc_cmbi_a_var1" id="_gc_cmbi_a_var1" value="<?php echo $existing_var1 ?>" />
    
	<?php
	$status_message = get_post_meta($post->ID,'_gc_cmbi_a_var1_feedback', true);
    if($status_message) {
        echo '<div class="upload_status_message">';
            echo $status_message;
        echo '</div>';
    }
    echo '<input type="hidden" name="gc_cmbi_a_manual_save_flag" value="true" />';
}


function gconverter_cmbi_a_setup_meta_boxes() {
    add_meta_box('gc_cmbi_a_var1_box', 'Theme Options - Logo and link color', 'gconverter_cmbi_a_render_variable_box', 'post', 'normal', 'high');
	add_meta_box('gc_cmbi_a_var1_box', 'Theme Options - Logo and link color', 'gconverter_cmbi_a_render_variable_box', 'page', 'normal', 'high');
}
add_action('admin_init','gconverter_cmbi_a_setup_meta_boxes');


function gconverter_cmbi_a_update_post($post_id, $post) {
    $post_type = $post->post_type;
    if($post_id && isset($_POST['gc_cmbi_a_manual_save_flag'])) { 
        switch($post_type) {
            case 'post':
			case 'page':
                    $gc_var1 = $_POST['_gc_cmbi_a_var1'];
                    update_post_meta( $post_id, '_gc_cmbi_a_var1', $gc_var1 );
					$var1_feedback = false;
                	update_post_meta($post_id,'_gc_cmbi_a_var1_feedback',$var1_feedback);
            break;
            default:
        } // End switch
    return;
} // End if manual save flag
    return;
}
add_action('save_post','gconverter_cmbi_a_update_post', 1, 2);
add_action('save_page','gconverter_cmbi_a_update_post', 1, 2);

?>
<?php
include_once("custom-fields.php");

// We don't need that. Please write up to date jQuery.
add_action('wp_default_scripts', function($scripts) {
    if (!empty( $scripts->registered['jquery'])) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff($jquery_dependencies, array('jquery-migrate'));
    }
});

// import parent's style.css
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// import custom javascripts
add_action( 'admin_enqueue_scripts', 'include_custom_js' );
function include_custom_js(){
    wp_register_script("multi_select", "/wp-content/themes/twentysixteen-child/multi-select.js", array(), NULL);
    wp_enqueue_script("multi_select");
}


/*-----------------------------------------------------------------------------------*/
/* Custom Return Data */
/*-----------------------------------------------------------------------------------*/
function student_data_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$student = get_fields( $post );

	if ($student == false) {
		return;
	}

  $_data = $student;

  if ($_data["hero_image_video"] == "Image"){
    $_data["hero_image"] = $student["hero_image"]["url"];
    if ($student["hero_image"]["sizes"]["medium"]){
      $_data["hero_image_medium"] = $student["hero_image"]["sizes"]["medium_large"];
    }else{
      $_data["hero_image_medium"] = $student["hero_image"]["url"];
    }
  }
  if ($_data["image_video_1"] == "Image"){
    $_data["image_1"] = $student["image_1"]["url"];
    if ($student["image_1"]["sizes"]["medium"]){
      $_data["image_1_medium"] = $student["image_1"]["sizes"]["medium_large"];
    }else{
      $_data["image_1_medium"] = $student["image_1"]["url"];
    }
  }
  if ($_data["image_video_2"] == "Image"){
    $_data["image_2"] = $student["image_2"]["url"];
    if ($student["image_2"]["sizes"]["medium"]){
      $_data["image_2_medium"] = $student["image_2"]["sizes"]["medium_large"];
    }else{
      $_data["image_2_medium"] = $student["image_2"]["url"];
    }
  }

  if ($_data["hero_image"] === false){
    unset($_data["hero_image"]);
  }
  if ($_data["image_1"] === false){
    unset($_data["hero_image"]);
  }
  if ($_data["image_2"] === false){
    unset($_data["hero_image"]);
  }


  // For CV upload which we are not using
	// $attachment = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);
	// if ($attachment['url']){
	// 	$_data['cv'] = $attachment['url'];
	// }

	$_data['id'] = $student['student_number'];

  // Parse other field into tags
	$other_tags = explode(",", $_data['other:']);
	foreach ($other_tags as &$value) {
	    $value = trim($value);
	}
	$_data['tags'] = array_merge($_data['tags'], $other_tags);

  for ($i; $i<count($_data['tags']); $i++){
    if ($_data['tags'][$i] == ""){
      unset($_data['tags'][$i]);
    }
  }

	unset($_data['other:']);
	return $_data;
}
add_filter( 'rest_prepare_student_info', 'student_data_prepare_post', 10, 3 );


/*-----------------------------------------------------------------------------------*/
/* Custom Post Type */
/*-----------------------------------------------------------------------------------*/

// Create the student_info post type
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'student_info',
    array(
      'labels' => array(
        'name' => __( 'Info' ),
        'singular_name' => __( 'Info' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true
    )
  );
  remove_post_type_support( 'student_info', 'editor' );
  remove_post_type_support( 'student_info', 'title' );
}

// Create the CV PDF upload field
// add_action( 'add_meta_boxes', 'add_cv_upload_field' );
// function add_cv_upload_field() {
//     // Define the custom attachment for posts
//     add_meta_box(
//         'wp_custom_attachment',
//         'CV',
//         'student_cv_upload',
//         'student_info',
//         'normal'
//     );
// }
// function student_cv_upload() {
//     wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');

//     $html = '<p class="description">';
//         $html .= 'Upload your CV here. Please upload only PDF files of size <2MB.';
//     $html .= '</p>';
//     $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" />';

//     echo $html;
// }
// function save_custom_meta_data($id) {
//     /* --- security verification --- */
//     if(!wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {
//       return $id;
//     }

//     if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
//       return $id;
//     }

//     if('page' == $_POST['post_type']) {
//       if(!current_user_can('edit_page', $id)) {
//         return $id;
//       }
//     } else {
//         if(!current_user_can('edit_page', $id)) {
//             return $id;
//         }
//     }

//     /* - end security verification - */

//     // Make sure the file array isn't empty
//     if(!empty($_FILES['wp_custom_attachment']['name'])) {
//         // Setup the array of supported file types. In this case, it's just PDF.
//         $supported_types = array('application/pdf');

//         // Get the file type of the upload
//         $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
//         $uploaded_type = $arr_file_type['type'];

//         // Check if the type is supported. If not, throw an error.
//         if(in_array($uploaded_type, $supported_types)) {

//             // Use the WordPress API to upload the file
//             $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));

//             // Throw error if there is one, else add metadata to post
//             if(isset($upload['error']) && $upload['error'] != 0) {
//                 wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
//             } else {
//                 add_post_meta($id, 'wp_custom_attachment', $upload);
//                 update_post_meta($id, 'wp_custom_attachment', $upload);
//             }
//         } else {
//             wp_die("The file type that you've uploaded is not a PDF.");
//         }
//     }
// }
// add_action('save_post', 'save_custom_meta_data');
// function post_edit_form_tag( ) {
//    echo ' enctype="multipart/form-data"';
// }
// add_action( 'post_edit_form_tag' , 'post_edit_form_tag' );



/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/

function remove_admin_menu_items() {
	$remove_menu_items = array(__('Links'),__('Posts'),__('Comments'),__('Pages'));
	global $menu;
	end ($menu);
	while (prev($menu)){
		$item = explode(' ',$menu[key($menu)][0]);
		if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
		unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_admin_menu_items');

function my_pre_save_post( $post_id ) {
  if ( $post_id != 'new' ) {
    return $post_id;
    }
    $post = array(
        'post_status' => 'draft',
        'post_title' => $_POST['fields']['name'],
        'post_type' => 'student_info'
    );
    $post_id = wp_insert_post($post);
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );
    return $post_id;
}
add_filter('acf/pre_save_post' , 'my_pre_save_post' );


function jb_update_postdata( $value, $post_id, $field ) {
  $title = get_field('cities', $post_id). ' ' . $value;

  $slug = sanitize_title( $title );

  $postdata = array(
       'ID'          => $post_id,
       'post_title'  => $title,
       'post_type'   => 'student_info',
       'post_name'   => $slug
    );

  wp_update_post( $postdata );

  return $value;

}
add_filter('acf/update_value/name=name', 'jb_update_postdata', 10, 3);


/*-----------------------------------------------------------------------------------*/
/* Don't ask me what this do */
/*-----------------------------------------------------------------------------------*/
add_filter( 'wpmu_signup_user_notification', '__return_false' );
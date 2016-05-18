<?php
// Custom return data
function student_data_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$student = get_fields( $post );

	if ($student == false) {
		return;
	}

	$id = $_data['slug'];

	$_data = $student;
	$_data['id'] = $id;

	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_student_info', 'student_data_prepare_post', 10, 3 );


// Custom Post Type
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


// Unique post ID
// function change_info_default_title( $data, $postarr ) {
// 	global $current_user;
// 	get_currentuserinfo();

// 	$hashraw = $current_user->user_email . $current_user->user_login;
// 	$hash = hash('md5', $hashraw);
//     $data['post_title'] = $hash;

//     // return $post_title;
//     return $data;
// }
// add_filter( 'wp_insert_post_data', 'change_info_default_title', 10, 2 );
<?php
function monalisa_import_files() {
  return array(
  
    array(
      'import_file_name'             => esc_html__('Demo Import'  , 'monalisa'),
      'categories'                   => array( 'monalisa Category' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . '/inc/demo/demo-content.xml',
	  'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/inc/demo/widget.wie',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . '/inc/demo/redux.json',
          'option_name' => 'monalisa',
        ),
      ),
      'import_preview_image_url'     => trailingslashit(get_template_directory()) . 'screenshot.png',
      'import_notice'                => esc_html__( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'monalisa' ),
      'preview_url'                  => '',
    ),      
	

  );
  
    
}
add_filter( 'pt-ocdi/import_files', 'monalisa_import_files' );




function monalisa_after_import_files() {

	//Set Menu
	$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
	set_theme_mod( 'nav_menu_locations' , array( 
		  'menu-1' => $main_menu->term_id, 
		 ) 
	);
    
// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

	
       //Import Revolution Slider
       if ( class_exists( 'RevSlider' ) ) {
           $slider_array = array(
				get_template_directory()."/inc/demo/home_slider.zip",
              );

           $slider = new RevSlider();
       
           foreach($slider_array as $filepath){
             $slider->importSliderFromPost(true,true,$filepath);  
           }
       
           echo ' Slider processed';
      }
   
	
}

add_filter( 'pt-ocdi/after_import', 'monalisa_after_import_files' );
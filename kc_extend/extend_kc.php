<?php
 
add_action('init', 'monalisa_kc_active', 99 );
 
function monalisa_kc_active() {
 
	if (function_exists('kc_add_map')) 
		
	{ 
	
	    kc_add_map(
	        array(

	            'shortcode_importer' => array(
	                'name' => esc_html__('Shortcode Importer', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',
	                'params' => array(
	                
	                    array(
                        'name' => 'enter_shortcode',
                        'label' => esc_html__( 'Enter Shortcode', 'monalisa' ),
                        'type' => 'textarea',
                        'admin_label' => true,
						),	    	                             


	                )
	            ),  // End of elemnt kc_icon 

	        ) 
			
			
	    ); // End add map	  
		
	    kc_add_map(
	        array(

	            'about_us_area' => array(
	                'name' => esc_html__('About Us Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',
	                'params' => array(
	                
	                    array(
	                        'name' => 'about_section_img',
	                        'label' => esc_html__( 'Section Image', 'monalisa' ),
	                        'type' => 'attach_image',
	                        'admin_label' => true,
						),	                   

						array(
	                        'name' => 'about_title',
	                        'label' => esc_html__( 'Section Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'About our <span>Monalisa</span>',
						),							
						
						array(
	                        'name' => 'about_content',
	                        'label' => esc_html__( 'Section SubTitle', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi perferendis magnam ea necessitatibus, officiis voluptas odit! Aperiam omnis, cupiditate laudantium velit nostrum, exercitationem accusamus, possimus soluta illo.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi perferendis magnam ea necessitatibus, officiis voluptas odit.</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi perferendis magnam ea necessitatibus, officiis voluptas odit! Aperiam omnis, cupiditate laudantium velit nostrum.</p>',
						),						
											

	                )
	            ),  // End of elemnt kc_icon 

	        ) 
			
			
	    ); // End add map	    
		
		kc_add_map(
	        array(

	            'why_choose_us_area' => array(
	                'name' => esc_html__('Why Choice Us Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',
					'nested'		=> true,
	                'params' => array(

	                    array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Section Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Why Choose <span>Monalisa</span>',
						),		                    
						
						array(
	                        'name' => 'section_content',
	                        'label' => esc_html__( 'Section Content', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',
						),							
						
						array(
	                        'name' => 'section_image',
	                        'label' => esc_html__( 'Upload Section Image', 'monalisa' ),
	                        'type' => 'attach_image',
	                        'admin_label' => true,
						),	 						

	                )
	            ),  // End of elemnt kc_icon 

	        ) 
			
			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'why_choose_us_item' => array(
	                'name' => esc_html__('Child of  Why Choose Us', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',
	                'params' => array(

	                    array(
	                        'name' => 'choose_icon',
	                        'label' => esc_html__( 'Section Icon', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => 'fa fa-lemon-o',
						),		                    
						
						array(
	                        'name' => 'choose_title',
	                        'label' => esc_html__( 'Section Title', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => 'Xoss Environment',
						),							
						
						array(
	                        'name' => 'choose_content',
	                        'label' => esc_html__( 'Section Content', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras interdum ante vel aliquet euismod.',
						),	 						
												   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 
			
			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'counter_area' => array(
	                'name' => esc_html__('Counter Area', 'monalisa'),
	                'icon' => 'sl-rocket',
					'nested'		=> true,
	                'category' => 'Monalisa Shortcodes',
	                'params' => array(

	                    array(
	                        'name' => 'counter_bg',
	                        'label' => esc_html__( 'Upload Section Image', 'monalisa' ),
	                        'type' => 'attach_image',
	                        'admin_label' => true,
						),		                    
                   						   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 
			
			
	    ); // End add map				
		
		kc_add_map(
	        array(

	            'counter_item_area' => array(
	                'name' => esc_html__('Item of Counter Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',
	                'params' => array(

	                    array(
	                        'name' => 'counter_number',
	                        'label' => esc_html__( 'Counter Number', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
	                        'value' => '140',
						),		                

						array(
	                        'name' => 'counter_text',
	                        'label' => esc_html__( 'Counter Text', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
	                        'value' => 'Awards won',
						),		                    
                   
						 						
												   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 
			
			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'gallery_area' => array(
	                'name' => esc_html__('Gallery Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',
	                'params' => array(

	                    array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Section Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Monalisa <span>Gallery</span>',
						),			                   

						array(
	                        'name' => 'section_content',
	                        'label' => esc_html__( 'Section Content', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',
						),							
						array(
	                        'name' => 'section_btn_text',
	                        'label' => esc_html__( 'Section Button Text', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => 'See More Projects',
						),							
						
						array(
	                        'name' => 'section_btn_link',
	                        'label' => esc_html__( 'Section Button Link', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => '#',
						),		                    
												
												   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'offer_area' => array(
	                'name' => esc_html__('Offer Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',
	                'params' => array(

	                    array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Section Title', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => 'Get your special offer today',
						),			                   

						array(
	                        'name' => 'section_content',
	                        'label' => esc_html__( 'Section SubTitle', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet. when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
						),							
						
						array(
	                        'name' => 'section_btn_text',
	                        'label' => esc_html__( 'Button Text', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => 'Make an appointment',
						),							
						
						array(
	                        'name' => 'section_btn_link',
	                        'label' => esc_html__( 'Button Link', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => '#',
						),							

				
												   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
	
		
		kc_add_map(
	        array(

	            'opening_hour_area' => array(
	                'name' => esc_html__('Opening Hour Area', 'monalisa'),
	                'icon' => 'sl-rocket',
					'nested'		=> true,
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(
						array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Section Title', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => 'Monalisa Open Hours',
						),								
						
						array(
	                        'name' => 'section_content',
	                        'label' => esc_html__( 'Section Content', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation.',
						),								
								   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'opening_hour_item' => array(
	                'name' => esc_html__('Child of Opening Hour Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(						
						
						array(
	                        'name' => 'oh_day',
	                        'label' => esc_html__( 'Day', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => 'Monday-Friday',
						),								
						
						array(
	                        'name' => 'oh_time',
	                        'label' => esc_html__( 'Time', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => '8.00AM - 5.00PM',
						),			   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'feature_area' => array(
	                'name' => esc_html__('Features Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
						
						array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Monalisa <span>Features</span>',
						),					

						array(
	                        'name' => 'section_subtitle',
	                        'label' => esc_html__( 'Content', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',
						),							
						
						array(
	                        'name' => 'section_number_post',
	                        'label' => esc_html__( 'Number of Post', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,
							'value' => '3',
						),							
													
		   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'team_area' => array(
	                'name' => esc_html__('Team Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
						
						array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,
							'value' => 'Monalisa <span>Lovely</span> Team',
						),							
						
						array(
	                        'name' => 'section_subtitle',
	                        'label' => esc_html__( 'Content', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',			
						),						
						
						array(
	                        'name' => 'section_number_post',
	                        'label' => esc_html__( 'Number of Post', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => '4',			
						),								
		   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map		
		
		kc_add_map(
	        array(

	            'video_area' => array(
	                'name' => esc_html__('Video Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
						
						array(
	                        'name' => 'vid_bg',
	                        'label' => esc_html__( 'Upload Image', 'monalisa' ),
	                        'type' => 'attach_image',
	                        'admin_label' => true,
						),							
						
						array(
	                        'name' => 'vid_title',
	                        'label' => esc_html__( 'Title', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => 'How it works',			
						),						
						
						array(
	                        'name' => 'vid_url',
	                        'label' => esc_html__( 'Video Url', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => 'https://www.youtube.com/embed/vR9mzDjmS7M',			
						),								
		   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map		
		
		kc_add_map(
	        array(

	            'pricing_area' => array(
	                'name' => esc_html__('Pricing Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
											
						
						array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Monalisa <span>Pricing</span>',			
						),						
						
						array(
	                        'name' => 'section_subtitle',
	                        'label' => esc_html__( 'Sub Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',			
						),						
						
						array(
	                        'name' => 'section_number_post',
	                        'label' => esc_html__( 'Number of Post', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => '3',			
						),								
		   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'testimonials_area' => array(
	                'name' => esc_html__('Testimonials Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
											
						
						array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Our <span>Clients</span> Say',			
						),						
						
						array(
	                        'name' => 'section_subtitle',
	                        'label' => esc_html__( 'Sub Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',			
						),						
							
		   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'blog_area' => array(
	                'name' => esc_html__('Blog Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
											
						
						array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Fresh <span>News</span>',			
						),						
						
						array(
	                        'name' => 'section_subtitle',
	                        'label' => esc_html__( 'Sub Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',			
						),						

						array(
	                        'name' => 'number_of_post',
	                        'label' => esc_html__( 'Number of Post', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => '2',			
						),						
							
		   
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map		
		
		kc_add_map(
	        array(

	            'clients_area' => array(
	                'name' => esc_html__('Clients Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
											

	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'contact_us_area' => array(
	                'name' => esc_html__('Contact Us Area', 'monalisa'),
	                'icon' => 'sl-rocket',
					'nested'		=> true,
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
											
						array(
	                        'name' => 'section_title',
	                        'label' => esc_html__( 'Section Title', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Get in <span>Touch</span>',			
						),						

						array(
	                        'name' => 'section_subtitle',
	                        'label' => esc_html__( 'Section Content', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru exercit ation Lorem ipsum dolor sit amet.',			
						),						

						array(
	                        'name' => 'cont7_shortcode_id',
	                        'label' => esc_html__( 'Contact Form7 Shortcode ID', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                   ),	
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'contact_info' => array(
	                'name' => esc_html__('Contact Info', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
											
						array(
	                        'name' => 'cont_icon',
	                        'label' => esc_html__( 'Icon', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'fa fa-envelope',			
						),						

						array(
	                        'name' => 'cont_title',
	                        'label' => esc_html__( 'Title', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => 'Email Address',			
						),						

						array(
	                        'name' => 'cont_info',
	                        'label' => esc_html__( 'Contact Info', 'monalisa' ),
	                        'type' => 'textarea',
	                        'admin_label' => true,			
	                        'value' => 'info@monalisa.com<br>admin@monalisa.com',			
	                   ),	
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map			
		
		kc_add_map(
	        array(

	            'google_map' => array(
	                'name' => esc_html__('Google Map Area', 'monalisa'),
	                'icon' => 'sl-rocket',
	                'category' => 'Monalisa Shortcodes',			
	                'params' => array(							
											
						array(
	                        'name' => 'cont_api_key',
	                        'label' => esc_html__( 'API Key', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => 'AIzaSyDwIQh7LGryQdDDi-A603lR8NqiF3R_ycA',			
						),						

						array(
	                        'name' => 'cont_latitude',
	                        'label' => esc_html__( 'Latitude', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => '40.7127837',			
						),						

						array(
	                        'name' => 'cont_longitude',
	                        'label' => esc_html__( 'Longitude', 'monalisa' ),
	                        'type' => 'text',
	                        'admin_label' => true,			
	                        'value' => '-74.00594130000002',			
	                   ),	
	                )
	            ),  // End of elemnt kc_icon 

	        ) 			
	    ); // End add map				
		

	
	} // End if

}  
 

<?php
    // Create "VC Testimonials" Post Type and Custom Taxonomies
	if ($this->TS_VCSC_CustomPostTypesTestimonial == "true") {
		function TS_VCSC_Testimonials_Post_Type() {
			$labels = array(
				'name'                  	=> __( 'Testimonials', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Testimonial', 'ts_visual_composer_extend' ),
				'add_new'               	=> __( 'Add New', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Testimonial', 'ts_visual_composer_extend' ),
				'edit_item'             	=> __( 'Edit Testimonial', 'ts_visual_composer_extend' ),
				'new_item'              	=> __( 'New Testimonial', 'ts_visual_composer_extend' ),
				'view_item'             	=> __( 'View Testimonial', 'ts_visual_composer_extend' ),
				'search_items'          	=> __( 'Search Testimonials', 'ts_visual_composer_extend' ),
				'not_found'             	=> __( 'No Testimonial(s) found', 'ts_visual_composer_extend' ),
				'not_found_in_trash'    	=> __( 'No Testimonial(s) found in the Trash', 'ts_visual_composer_extend' ), 
				'parent_item_colon'     	=> '',
				'menu_name'             	=> 'VC Testimonials'
			);
			$args = array(
				'labels'                	=> $labels,
				'description'           	=> __( 'Add Testimonials to be used with the Visual Composer Extensions plugin.', 'ts_visual_composer_extend' ),
				'public'                	=> false,
				'menu_icon' 				=> TS_VCSC_GetResourceURL("css/other/ts_testimonial_admin.png"),
				'rewrite'               	=> true,
				'exclude_from_search'		=> true,
				'publicly_queryable'    	=> false,
				'show_ui'               	=> true,
				'show_in_menu'          	=> true, 
				'query_var'             	=> true,
				'rewrite'               	=> true,
				'capability_type'       	=> 'post',
				'has_archive'           	=> false, 
				'hierarchical'          	=> false,
				'menu_position'         	=> 5,
				'supports'              	=> array('title', 'editor', 'thumbnail'),
			);
			register_post_type('ts_testimonials', $args);
			
			$labels = array(
				'name'                  	=> __( 'Categories', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Category', 'ts_visual_composer_extend' ),
				'search_items'          	=> __( 'Search in Categories', 'ts_visual_composer_extend' ),
				'all_items'             	=> __( 'Categories', 'ts_visual_composer_extend' ),
				'parent_item'           	=> __( 'Parent Category', 'ts_visual_composer_extend' ),
				'parent_item_colon'     	=> __( 'Parent Category:', 'ts_visual_composer_extend' ),
				'edit_item'             	=> __( 'Edit Category', 'ts_visual_composer_extend' ), 
				'update_item'           	=> __( 'Update Category', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Category', 'ts_visual_composer_extend' ),
				'new_item_name'         	=> __( 'New Category', 'ts_visual_composer_extend' ),
				'menu_name'             	=> __( 'Categories', 'ts_visual_composer_extend' )
			);
			
			register_taxonomy(
				'ts_testimonials_category',
				array('ts_testimonials'),
				array(
					'hierarchical'          => true,
					'public'                => false,
					'labels'                => $labels,
					'show_ui'               => true,
					'rewrite'               => true,
					'show_admin_column'		=> true,
				)
			);
			
			new TS_VCSC_Tax_CTP_Filter(array('ts_testimonials' => array('ts_testimonials_category')));
		}
		add_action('init', 'TS_VCSC_Testimonials_Post_Type');
	}
	
    // Create "VC Team" Post Type and Custom Taxonomies
	if ($this->TS_VCSC_CustomPostTypesTeam == "true") {
		function TS_VCSC_Team_Post_Type() {
			$labels = array(
				'name'                  	=> __( 'Members', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Team Member', 'ts_visual_composer_extend' ),
				'add_new'               	=> __( 'Add New', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Teammate', 'ts_visual_composer_extend'  ),
				'edit_item'             	=> __( 'Edit Teammate', 'ts_visual_composer_extend'  ),
				'new_item'              	=> __( 'New Teammate', 'ts_visual_composer_extend'  ),
				'view_item'             	=> __( 'View Teammate', 'ts_visual_composer_extend'  ),
				'search_items'          	=> __( 'Search Teammates', 'ts_visual_composer_extend'  ),
				'not_found'             	=> __( 'No Teammate(s) found', 'ts_visual_composer_extend'  ),
				'not_found_in_trash'    	=> __( 'No Teammate(s) found in the Trash', 'ts_visual_composer_extend'  ), 
				'parent_item_colon'     	=> '',
				'menu_name'             	=> 'VC Team'
			);
			$args = array(
				'labels'                	=> $labels,
				'description'           	=> __( 'Add Team Information to be used with the Visual Composer Extensions plugin.', 'ts_visual_composer_extend' ),
				'public'                	=> false,
				'menu_icon' 				=> TS_VCSC_GetResourceURL("css/other/ts_team_admin.png"),
				'rewrite'               	=> true,
				'exclude_from_search'		=> true,
				'publicly_queryable'    	=> false,
				'show_ui'               	=> true,
				'show_in_menu'          	=> true, 
				'query_var'             	=> true,
				'rewrite'               	=> true,
				'capability_type'       	=> 'post',
				'has_archive'           	=> false, 
				'hierarchical'          	=> false,
				'menu_position'         	=> 5,
				'supports'              	=> array('title', 'editor', 'thumbnail'),
			);
			register_post_type('ts_team', $args);
			
			$labels = array(
				'name'                  	=> __( 'Team / Group', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Team / Group', 'ts_visual_composer_extend' ),
				'search_items'          	=> __( 'Search in Teams / Groups', 'ts_visual_composer_extend' ),
				'all_items'             	=> __( 'Teams / Groups', 'ts_visual_composer_extend' ),
				'parent_item'           	=> __( 'Parent Team / Group', 'ts_visual_composer_extend' ),
				'parent_item_colon'     	=> __( 'Parent Team / Group:', 'ts_visual_composer_extend' ),
				'edit_item'             	=> __( 'Edit Team / Group', 'ts_visual_composer_extend' ), 
				'update_item'           	=> __( 'Update Team / Group', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Team / Group', 'ts_visual_composer_extend' ),
				'new_item_name'         	=> __( 'New Team / Group Name', 'ts_visual_composer_extend' ),
				'menu_name'             	=> __( 'Teams / Groups', 'ts_visual_composer_extend' )
			);
			
			register_taxonomy(
				'ts_team_category',
				array('ts_team'),
				array(
					'hierarchical'          => true,
					'public'                => false,
					'labels'                => $labels,
					'show_ui'               => true,
					'rewrite'               => true,
					'show_admin_column'		=> true,
				)
			);
			
			new TS_VCSC_Tax_CTP_Filter(array('ts_team' => array('ts_team_category')));
		}
		add_action('init', 'TS_VCSC_Team_Post_Type');
	}

    // Create "VC Logos" Post Type and Custom Taxonomies
	if ($this->TS_VCSC_CustomPostTypesLogo == "true") {
		function TS_VCSC_Logos_Post_Type() {
			$labels = array(
				'name'                  	=> __( 'Logos', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Logo', 'ts_visual_composer_extend' ),
				'add_new'               	=> __( 'Add New', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Logo', 'ts_visual_composer_extend'  ),
				'edit_item'             	=> __( 'Edit Logo', 'ts_visual_composer_extend'  ),
				'new_item'              	=> __( 'New Logo', 'ts_visual_composer_extend'  ),
				'view_item'             	=> __( 'View Logo', 'ts_visual_composer_extend'  ),
				'search_items'          	=> __( 'Search Logos', 'ts_visual_composer_extend'  ),
				'not_found'             	=> __( 'No Logo(s) found', 'ts_visual_composer_extend'  ),
				'not_found_in_trash'    	=> __( 'No Logo(s) found in the Trash', 'ts_visual_composer_extend'  ), 
				'parent_item_colon'     	=> '',
				'menu_name'             	=> 'VC Logos'
			);
			$args = array(
				'labels'                	=> $labels,
				'description'           	=> __( 'Add Logos to be used with the Visual Composer Extensions plugin.', 'ts_visual_composer_extend' ),
				'public'                	=> false,
				'menu_icon' 				=> TS_VCSC_GetResourceURL("css/other/ts_logo_admin.png"),
				'rewrite'               	=> true,
				'exclude_from_search'		=> true,
				'publicly_queryable'    	=> false,
				'show_ui'               	=> true,
				'show_in_menu'          	=> true, 
				'query_var'             	=> true,
				'rewrite'               	=> true,
				'capability_type'       	=> 'post',
				'has_archive'           	=> false, 
				'hierarchical'          	=> false,
				'menu_position'         	=> 5,
				'supports'              	=> array('title', 'thumbnail'),
			);
			register_post_type('ts_logos', $args);
			
			$labels = array(
				'name'                  	=> __( 'Categories', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Category', 'ts_visual_composer_extend' ),
				'search_items'          	=> __( 'Search in Categories', 'ts_visual_composer_extend' ),
				'all_items'             	=> __( 'Categories', 'ts_visual_composer_extend' ),
				'parent_item'           	=> __( 'Parent Category', 'ts_visual_composer_extend' ),
				'parent_item_colon'     	=> __( 'Parent Category:', 'ts_visual_composer_extend' ),
				'edit_item'             	=> __( 'Edit Category', 'ts_visual_composer_extend' ), 
				'update_item'           	=> __( 'Update Category', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Category', 'ts_visual_composer_extend' ),
				'new_item_name'         	=> __( 'New Category', 'ts_visual_composer_extend' ),
				'menu_name'             	=> __( 'Categories', 'ts_visual_composer_extend' )
			);
			
			register_taxonomy(
				'ts_logos_category',
				array('ts_logos'),
				array(
					'hierarchical'          => true,
					'public'                => false,
					'labels'                => $labels,
					'show_ui'               => true,
					'rewrite'               => true,
					'show_admin_column'		=> true,
				)
			);
			
			new TS_VCSC_Tax_CTP_Filter(array('ts_logos' => array('ts_logos_category')));
		}
		add_action('init', 'TS_VCSC_Logos_Post_Type');
	}
	
    // Create "VC Skillsets" Post Type and Custom Taxonomies
	if ($this->TS_VCSC_CustomPostTypesSkillset == "true") {
		function TS_VCSC_Skillsets_Post_Type() {
			$labels = array(
				'name'                  	=> __( 'Skillsets', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Skillset', 'ts_visual_composer_extend' ),
				'add_new'               	=> __( 'Add New', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Skillset', 'ts_visual_composer_extend'  ),
				'edit_item'             	=> __( 'Edit Skillset', 'ts_visual_composer_extend'  ),
				'new_item'              	=> __( 'New Skillset', 'ts_visual_composer_extend'  ),
				'view_item'             	=> __( 'View Skillset', 'ts_visual_composer_extend'  ),
				'search_items'          	=> __( 'Search Skillsets', 'ts_visual_composer_extend'  ),
				'not_found'             	=> __( 'No Skillset(s) found', 'ts_visual_composer_extend'  ),
				'not_found_in_trash'    	=> __( 'No Skillset(s) found in the Trash', 'ts_visual_composer_extend'  ), 
				'parent_item_colon'     	=> '',
				'menu_name'             	=> 'VC Skillsets'
			);
			$args = array(
				'labels'                	=> $labels,
				'description'           	=> __( 'Add Skillsets to be used with the Visual Composer Extensions plugin.', 'ts_visual_composer_extend' ),
				'public'                	=> false,
				'menu_icon' 				=> TS_VCSC_GetResourceURL("css/other/ts_skillset_admin.png"),
				'rewrite'               	=> true,
				'exclude_from_search'		=> true,
				'publicly_queryable'    	=> false,
				'show_ui'               	=> true,
				'show_in_menu'          	=> true, 
				'query_var'             	=> true,
				'rewrite'               	=> true,
				'capability_type'       	=> 'post',
				'has_archive'           	=> false, 
				'hierarchical'          	=> false,
				'menu_position'         	=> 5,
				'supports'              	=> array('title'),
			);
			register_post_type('ts_skillsets', $args);
			
			$labels = array(
				'name'                  	=> __( 'Categories', 'ts_visual_composer_extend' ),
				'singular_name'         	=> __( 'Category', 'ts_visual_composer_extend' ),
				'search_items'          	=> __( 'Search in Categories', 'ts_visual_composer_extend' ),
				'all_items'             	=> __( 'Categories', 'ts_visual_composer_extend' ),
				'parent_item'           	=> __( 'Parent Category', 'ts_visual_composer_extend' ),
				'parent_item_colon'     	=> __( 'Parent Category:', 'ts_visual_composer_extend' ),
				'edit_item'             	=> __( 'Edit Category', 'ts_visual_composer_extend' ), 
				'update_item'           	=> __( 'Update Category', 'ts_visual_composer_extend' ),
				'add_new_item'          	=> __( 'Add New Category', 'ts_visual_composer_extend' ),
				'new_item_name'         	=> __( 'New Category', 'ts_visual_composer_extend' ),
				'menu_name'             	=> __( 'Categories', 'ts_visual_composer_extend' )
			);
			
			register_taxonomy(
				'ts_skillsets_category',
				array('ts_skillsets'),
				array(
					'hierarchical'          => true,
					'public'                => false,
					'labels'                => $labels,
					'show_ui'               => true,
					'rewrite'               => true,
					'show_admin_column'		=> true,
				)
			);
			
			new TS_VCSC_Tax_CTP_Filter(array('ts_skillsets' => array('ts_skillsets_category')));
		}
		add_action('init', 'TS_VCSC_Skillsets_Post_Type');
	}
?>
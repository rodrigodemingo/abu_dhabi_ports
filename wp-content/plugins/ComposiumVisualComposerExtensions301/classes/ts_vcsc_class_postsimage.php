<?php
if (!class_exists('TS_Postsimage')){
	class TS_Postsimage {
		function __construct() {
			global $VISUAL_COMPOSER_EXTENSIONS;
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
				add_action('init',                                  	array($this, 'TS_VCSC_Add_Posts_Image_Elements'), 9999999);
			} else {
				add_action('admin_init',		                    	array($this, 'TS_VCSC_Add_Posts_Image_Elements'), 9999999);
			}
            add_shortcode('TS_VCSC_Posts_Image_Grid_Standalone',		array($this, 'TS_VCSC_Posts_Image_Grid_Standalone'));
		}
        
        // Standalone Posts Ticker
        function TS_VCSC_Posts_Image_Grid_Standalone ($atts, $content = null) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            ob_start();

			wp_enqueue_script('ts-extend-hammer');
			wp_enqueue_script('ts-extend-nacho');
			wp_enqueue_style('ts-extend-nacho');			
			wp_enqueue_style('ts-font-ecommerce');
	
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
				wp_enqueue_style('ts-extend-simptip');
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
			}
            
            extract( shortcode_atts( array(
				'post_type'						=> 'post',			
				'limit_posts'					=> 'true',
				'limit_by'						=> 'category',							// post_tag, cust_tax
				'limit_term'					=> '',				
				'filter_by'						=> 'category', 							// post_tag, cust_tax
				'posts_limit'					=> 25,
				
				'content_images'				=> '',
				'content_images_titles'			=> '',
				'content_images_links'			=> '',
				'content_images_groups'			=> '',
				'content_images_size'			=> 'medium',
				
				'filters_available'				=> 'Available Groups',
				'filters_selected'				=> 'Filtered Groups',
				'filters_nogroups'				=> 'No Groups',
				'filters_toggle'				=> 'Toggle Filter',
				'filters_toggle_style'			=> '',
				'filters_showall'				=> 'Show All',
				'filters_showall_style'			=> '',
			
				'data_grid_invalid'				=> 'false',
				'data_grid_target'				=> '_blank',
				'data_grid_breaks'				=> '240,480,720,960',
				'data_grid_space'				=> 2,
				'data_grid_order'				=> 'false',
				'data_grid_always'				=> 'true',
				
				'fullwidth'						=> 'false',
				'breakouts'						=> 6,
				
                'margin_top'					=> 0,
                'margin_bottom'					=> 0,
                'el_id' 						=> '',
                'el_class'              		=> '',
				'css'							=> '',
            ), $atts ));

			$output								= '';
			
			// Check for Front End Editor
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
				$grid_class						= 'ts-image-link-grid-edit';
				$grid_message					= '<div class="ts-composer-frontedit-message">' . __( 'The grid is currently viewed in front-end edit mode; grid and filter features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
				$image_style					= 'width: 20%; height: 100%; display: inline-block; margin: 0; padding: 0;';
				$grid_style						= 'height: 100%;';
				$frontend_edit					= 'true';
			} else {
				$grid_class						= 'ts-image-link-grid';
				$image_style					= '';
				$grid_style						= '';
				$grid_message					= '';
				$frontend_edit					= 'false';
			}
			
			$randomizer							= mt_rand(999999, 9999999);
		
			if (!empty($el_id)) {
				$modal_id						= $el_id;
			} else {
				$modal_id						= 'ts-vcsc-posts-link-grid-' . $randomizer;
			}
				
			$valid_images 						= 0;
			if (!empty($data_grid_breaks)) {
				$data_grid_breaks 				= str_replace(' ', '', $data_grid_breaks);
				$count_columns					= substr_count($data_grid_breaks, ",") + 1;
			} else {
				$count_columns					= 0;
			}
			$i 									= -1;
			$b									= 0;
			$output 							= '';
			
			if ($filters_toggle_style != '') {
				wp_enqueue_style('ts-extend-buttonsflat');
			}
			wp_enqueue_style('ts-extend-multiselect');
			wp_enqueue_script('ts-extend-multiselect');
			
			$limit_term 						= str_replace(' ', '', $limit_term);

			if ($limit_by == 'category') {
				$limit_tax 				= 'category';
			} else if ($limit_by == 'post_tag') {
				$limit_tax 				= 'post_tag';
			} else if ($limit_by == 'cust_tax') {
				$limit_tax 				= '';
			}

			$filter_tax 				= '';
			
			// - set the taxonomy for the filter menu -
			if ($filter_by == 'category') {
				$menu_tax 				= 'category';
			} else if ($filter_by == 'post_tag') {
				$menu_tax 				= 'post_tag';
			} else if ($filter_by == 'cust_tax') {
				$menu_tax 				= $filter_tax; 
			}

			// Set the WP Query Arguments
			$args = array(
				'post_type' 			=> $post_type,
				'posts_per_page' 		=> '-1'
			);
			if ($limit_posts == 'true' && taxonomy_exists($limit_tax)) {
				$limited_terms 			= explode(',', $limit_term);
				$args['tax_query'] = array(
					array (
						'taxonomy' 		=> $limit_tax,
						'field' 		=> 'slug',
						'terms' 		=> $limited_terms,
						'operator' 		=> 'NOT IN'
					)
				);
			}
			$isoposts = new WP_Query($args);
			
			if (function_exists('vc_shortcode_custom_css_class')) {
				$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-image-link-grid-frame ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Posts_Image_Grid_Standalone', $atts);
			} else {
				$css_class 	= 'ts-image-link-grid-frame ' . $el_class;
			}

			$fullwidth_allow			= "true";
			$postCounter 				= 0;
			$modal_gallery				= '';
			
			// Front-Edit Message
			if ($frontend_edit == "true") {
				$modal_gallery .= $grid_message;
				if (post_type_exists($post_type) && $isoposts->have_posts()) { 
					while ($isoposts->have_posts() ) :
						$isoposts->the_post();
						$matched_terms						= 0;
						$post_thumbnail						= get_the_post_thumbnail();
						if (($matched_terms == 0) && (($post_thumbnail != '') || ($data_grid_invalid == "false"))) {
							$postCounter++;
							if ($postCounter < $posts_limit + 1) {
								if ('' != $post_thumbnail) { 
									$grid_image				= wp_get_attachment_image_src(get_post_thumbnail_id(), $content_images_size);
									$modal_image			= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
									$grid_image				= $grid_image[0];
									$modal_image			= $modal_image[0];
								} else {
									$grid_image				= TS_VCSC_GetResourceURL('images/defaults/no_featured.png');
									$modal_image			= TS_VCSC_GetResourceURL('images/defaults/no_featured.png');
								}
								$categories					= array();
								if (taxonomy_exists($menu_tax)) {
									foreach(get_the_terms($isoposts->post->ID, $menu_tax) as $term) array_push($categories, $term->name);
									$categories 			= implode($categories, ',');
								}									
								$valid_images++;
								$modal_gallery .= '<a style="' . $image_style . '" href="' . get_permalink() . '" target="_blank" title="' . get_the_title() . '">';
									$modal_gallery .= '<img id="ts-image-link-picture-' . $randomizer . '-' . $i .'" class="ts-image-link-picture" src="' . $grid_image . '" rel="link-group-' . $randomizer . '" data-include="true" data-image="' . $modal_image . '" width="100%" height="auto" title="' . get_the_title() . '" data-groups="' . $categories . '" data-target="' . $data_grid_target . '" data-link="' . get_permalink() . '">';
								$modal_gallery	.= '</a>';
								$categories					= array();
							}
						}
					endwhile;
					wp_reset_postdata();
					wp_reset_query();
				} else {
					$modal_gallery .= '<p>Nothing found. Please check back soon!</p>';
				}
			} else {
				if (post_type_exists($post_type) && $isoposts->have_posts()) { 
					while ($isoposts->have_posts() ) : $isoposts->the_post();
						$matched_terms						= 0;
						$post_thumbnail						= get_the_post_thumbnail();
						if (($matched_terms == 0) && (($post_thumbnail != '') || ($data_grid_invalid == "false"))) {
							$postCounter++;
							if ($postCounter < $posts_limit + 1) {
								if ('' != $post_thumbnail) { 
									$grid_image				= wp_get_attachment_image_src(get_post_thumbnail_id(), $content_images_size);
									$modal_image			= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
									$grid_image				= $grid_image[0];
									$modal_image			= $modal_image[0];
								} else {
									$grid_image				= TS_VCSC_GetResourceURL('images/defaults/no_featured.png');
									$modal_image			= TS_VCSC_GetResourceURL('images/defaults/no_featured.png');
								}
								$categories					= array();
								if (taxonomy_exists($menu_tax)) {
									foreach(get_the_terms($isoposts->post->ID, $menu_tax) as $term) array_push($categories, $term->name);
									$categories 			= implode($categories, ',');
								}									
								$valid_images++;
								$modal_gallery .= '<img id="ts-image-link-picture-' . $randomizer . '-' . $i .'" class="ts-image-link-picture" src="' . $grid_image . '" rel="link-group-' . $randomizer . '" data-include="true" data-image="' . $modal_image . '" width="100%" height="auto" title="' . get_the_title() . '" data-groups="' . $categories . '" data-target="' . $data_grid_target . '" data-link="' . get_permalink() . '">';
								$categories					= array();
							}
						}
					endwhile;
					wp_reset_postdata();
					wp_reset_query();
				} else {
					$modal_gallery .= '<p>Nothing found. Please check back soon!</p>';
				}
			}
		
			if ($valid_images < $count_columns) {
				$data_grid_string	= explode(',', $data_grid_breaks);
				$data_grid_breaks	= array();
				foreach ($data_grid_string as $single_break) {
					$b++;
					if ($b <= $valid_images) {
						array_push($data_grid_breaks, $single_break);
					} else {
						break;
					}
				}
				$data_grid_breaks	= implode(",", $data_grid_breaks);
			} else {
				$data_grid_breaks 	= $data_grid_breaks;
			}
			
			$output .= '<div id="' . $modal_id . '-frame" class="' . $grid_class . ' ' . $css_class . ' ' . (($fullwidth == "true" && $fullwidth_allow == "true") ? "ts-lightbox-nacho-full-frame" : "") . '" data-random="' . $randomizer . '" data-grid="' . $data_grid_breaks . '" data-margin="' . $data_grid_space . '" data-always="' . $data_grid_always . '" data-order="' . $data_grid_order . '" data-break-parents="' . $breakouts . '" data-inline="' . $frontend_edit . '" data-gridfilter="true" data-gridavailable="' . $filters_available . '" data-gridselected="' . $filters_selected . '" data-gridnogroups="' . $filters_nogroups . '" data-gridtoggle="' . $filters_toggle . '" data-gridtogglestyle="' . $filters_toggle_style . '" data-gridshowall="' . $filters_showall . '" data-gridshowallstyle="' . $filters_showall_style . '" style="margin-top: '  . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; position: relative;">';
				$output .= '<div id="nch-lb-grid-' . $randomizer . '" class="nch-lb-grid" data-filter="nch-lb-filter-' . $randomizer . '" style="' . $grid_style . '" data-toggle="nch-lb-toggle-' . $randomizer . '" data-random="' . $randomizer . '">';
				$output .= $modal_gallery;
				$output .= '</div>';
			$output .= '</div>';
			
			echo $output;
			
            $myvariable = ob_get_clean();
            return $myvariable;
        }
    
        // Add Image Posts Elements
        function TS_VCSC_Add_Posts_Image_Elements() {
            global $VISUAL_COMPOSER_EXTENSIONS;
            // Add Standalone Posts Image Grid
            if (function_exists('vc_map')) {
                vc_map( array(
                    "name"                              => __( "TS Posts Image Grid", "ts_visual_composer_extend" ),
                    "base"                              => "TS_VCSC_Posts_Image_Grid_Standalone",
                    "icon" 	                            => "icon-wpb-ts_vcsc_posts_image_grid",
					"class"                     		=> "ts_vcsc_main_posts_ticker",
                    "category"                          => __( 'VC Extensions', "ts_visual_composer_extend" ),
                    "description"                       => __("Place a Posts Image Grid element", "ts_visual_composer_extend"),
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
                    "params"                            => array(
                        // Posts Ticker Settings
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "ts_visual_composer_extend" ),
                            "param_name"                => "seperator_1",
                            "value"                     => "",
							"seperator"					=> "Content Settings",
                            "description"               => __( "", "ts_visual_composer_extend" ),
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Exclude Categories", "ts_visual_composer_extend" ),
                            "param_name"                => "limit_posts",
                            "value"                     => "false",
                            "on"					    => __( 'Yes', "ts_visual_composer_extend" ),
                            "off"					    => __( 'No', "ts_visual_composer_extend" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "admin_label"		        => true,
                            "description"               => __( "Switch the toggle if you want to exclude some post categories for the element.", "ts_visual_composer_extend" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"                      => "standardpostcat",
                            "heading"                   => __( "Select Excluded Categories", "ts_visual_composer_extend" ),
                            "param_name"                => "limit_term",
                            "posttype"                  => "post",
                            "posttaxonomy"              => "ts_logos_category",
							"taxonomy"              	=> "ts_logos_category",
							"postsingle"				=> "Post",
							"postplural"				=> "Posts",
							"postclass"					=> "post",
                            "value"                     => "",
							"admin_label"		        => true,
                            "description"               => __( "Please select the categories you want to use or exclude for the element.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "limit_posts", "value" 	=> "true"),
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Total Number of Posts", "ts_visual_composer_extend" ),
                            "param_name"                => "posts_limit",
                            "value"                     => "25",
                            "min"                       => "1",
                            "max"                       => "100",
                            "step"                      => "1",
                            "unit"                      => '',
							"admin_label"		        => true,
                            "description"               => __( "Select the total number of posts to be retrieved from WordPress.", "ts_visual_composer_extend" ),
                        ),						
						array(
							"type"              		=> "switch",
							"heading"			    	=> __( "Exclude Non-Image Posts", "ts_visual_composer_extend" ),
							"param_name"		    	=> "data_grid_invalid",
							"value"				    	=> "false",
							"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"						=> __( 'No', "ts_visual_composer_extend" ),
							"style"						=> "select",
							"design"					=> "toggle-light",
							"description"		    	=> __( "Switch the toggle to automatically exclude posts without a featured image.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "switch",
							"heading"			    	=> __( "Always Show Post Title", "ts_visual_composer_extend" ),
							"param_name"		    	=> "data_grid_always",
							"value"				    	=> "true",
							"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"						=> __( 'No', "ts_visual_composer_extend" ),
							"style"						=> "select",
							"design"					=> "toggle-light",
							"description"		    	=> __( "Switch the toggle to always show the post title with the post image.", "ts_visual_composer_extend" ),
						),		
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Link Target", "ts_visual_composer_extend" ),
							"param_name"        		=> "data_grid_target",
							"value"             		=> array(
								__( "New Window", "ts_visual_composer_extend" )                     		=> "_blank",
								__( "Same Window", "ts_visual_composer_extend" )                    		=> "_parent",
							),
							"description"       		=> __( "Select how the links should be opened.", "ts_visual_composer_extend" ),
						),
						// Grid Settings
						array(
							"type"                  	=> "seperator",
							"heading"               	=> __( "", "ts_visual_composer_extend" ),
							"param_name"            	=> "seperator_5",
							"value"						=> "",
							"seperator"					=> "Grid Settings",
							"description"           	=> __( "", "ts_visual_composer_extend" ),
							"group" 					=> "Grid Settings",
						),
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Grid Break Points", "ts_visual_composer_extend" ),
							"param_name"            	=> "data_grid_breaks",
							"value"                 	=> "240,480,720,960",
							"description"           	=> __( "Define the break points (columns) for the grid based on available screen size; seperate by comma.", "ts_visual_composer_extend" ),
							"admin_label"           	=> true,
							"group" 					=> "Grid Settings"
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Grid Space", "ts_visual_composer_extend" ),
							"param_name"            	=> "data_grid_space",
							"value"                 	=> "2",
							"min"                   	=> "0",
							"max"                   	=> "20",
							"step"                  	=> "1",
							"unit"                  	=> 'px',
							"description"           	=> __( "Define the space between images in grid.", "ts_visual_composer_extend" ),
							"admin_label"           	=> true,
							"group" 					=> "Grid Settings"
						),
						array(
							"type"              		=> "switch",
							"heading"			    	=> __( "Maintain Posts Order", "ts_visual_composer_extend" ),
							"param_name"		    	=> "data_grid_order",
							"value"				    	=> "false",
							"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"						=> __( 'No', "ts_visual_composer_extend" ),
							"style"						=> "select",
							"design"					=> "toggle-light",
							"description"		    	=> __( "Switch the toggle to keep original posts order in grid; it is adviced to have the plugin determine order for best layout.", "ts_visual_composer_extend" ),
							"group" 					=> "Grid Settings"
						),
						array(
							"type"              		=> "switch",
							"heading"               	=> __( "Make Grid Full-Width", "ts_visual_composer_extend" ),
							"param_name"            	=> "fullwidth",
							"value"                 	=> "false",
							"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"						=> __( 'No', "ts_visual_composer_extend" ),
							"style"						=> "select",
							"design"					=> "toggle-light",
							"description"           	=> __( "Switch the toggle if you want to attempt showing the gallery in full width (will not work with all themes).", "ts_visual_composer_extend" ),
							"admin_label"           	=> true,
							"group" 					=> "Grid Settings"
						),
						array(
							"type"                 	 	=> "nouislider",
							"heading"               	=> __( "Full Grid Breakouts", "ts_visual_composer_extend" ),
							"param_name"            	=> "breakouts",
							"value"                 	=> "6",
							"min"                   	=> "0",
							"max"                   	=> "99",
							"step"                  	=> "1",
							"unit"                  	=> '',
							"description"           	=> __( "Define the number of parent containers the gallery should attempt to break away from.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "fullwidth", 'value' => 'true' ),
							"group" 					=> "Grid Settings"
						),				
						// Filter Settings
						array(
							"type"                  	=> "seperator",
							"heading"               	=> __( "", "ts_visual_composer_extend" ),
							"param_name"            	=> "seperator_6",
							"value"						=> "",
							"seperator"					=> "Filter Settings",
							"description"           	=> __( "", "ts_visual_composer_extend" ),
							"group" 					=> "Filter Settings",
						),
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Filter Toggle: Text", "ts_visual_composer_extend" ),
							"param_name"            	=> "filters_toggle",
							"value"                 	=> "Toggle Filter",
							"description"           	=> __( "Enter a text to be used for the filter button.", "ts_visual_composer_extend" ),
							"dependency"            	=> "",
							"group" 					=> "Filter Settings",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __( "Filter Toggle: Style", "ts_visual_composer_extend" ),
							"param_name"            	=> "filters_toggle_style",
							"width"                 	=> 150,
							"value"                 	=> array(
								__( 'No Style', "ts_visual_composer_extend" )				=> "",
								__( 'Sun Flower Flat', "ts_visual_composer_extend" )		=> "ts-color-button-sun-flower",
								__( 'Orange Flat', "ts_visual_composer_extend" )			=> "ts-color-button-orange-flat",
								__( 'Carot Flat', "ts_visual_composer_extend" )     		=> "ts-color-button-carrot-flat",
								__( 'Pumpkin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-pumpkin-flat",
								__( 'Alizarin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-alizarin-flat",
								__( 'Pomegranate Flat', "ts_visual_composer_extend" )		=> "ts-color-button-pomegranate-flat",
								__( 'Turquoise Flat', "ts_visual_composer_extend" )			=> "ts-color-button-turquoise-flat",
								__( 'Green Sea Flat', "ts_visual_composer_extend" )			=> "ts-color-button-green-sea-flat",
								__( 'Emerald Flat', "ts_visual_composer_extend" )			=> "ts-color-button-emerald-flat",
								__( 'Nephritis Flat', "ts_visual_composer_extend" )			=> "ts-color-button-nephritis-flat",
								__( 'Peter River Flat', "ts_visual_composer_extend" )		=> "ts-color-button-peter-river-flat",
								__( 'Belize Hole Flat', "ts_visual_composer_extend" )		=> "ts-color-button-belize-hole-flat",
								__( 'Amethyst Flat', "ts_visual_composer_extend" )			=> "ts-color-button-amethyst-flat",
								__( 'Wisteria Flat', "ts_visual_composer_extend" )			=> "ts-color-button-wisteria-flat",
								__( 'Wet Asphalt Flat', "ts_visual_composer_extend" )		=> "ts-color-button-wet-asphalt-flat",
								__( 'Midnight Blue Flat', "ts_visual_composer_extend" )		=> "ts-color-button-midnight-blue-flat",
								__( 'Clouds Flat', "ts_visual_composer_extend" )			=> "ts-color-button-clouds-flat",
								__( 'Silver Flat', "ts_visual_composer_extend" )			=> "ts-color-button-silver-flat",
								__( 'Concrete Flat', "ts_visual_composer_extend" )			=> "ts-color-button-concrete-flat",
								__( 'Asbestos Flat', "ts_visual_composer_extend" )			=> "ts-color-button-asbestos-flat",
								__( 'Graphite Flat', "ts_visual_composer_extend" )			=> "ts-color-button-graphite-flat",
							),
							"description"           	=> __( "Select the color scheme for the filter button.", "ts_visual_composer_extend" ),
							"dependency"            	=> "",
							"group" 					=> "Filter Settings",
						),						
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Show All Toggle: Text", "ts_visual_composer_extend" ),
							"param_name"            	=> "filters_showall",
							"value"                 	=> "Show All",
							"description"          	 	=> __( "Enter a text to be used for the show all button.", "ts_visual_composer_extend" ),
							"dependency"            	=> "",
							"group" 					=> "Filter Settings",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __( "Show All Toggle: Style", "ts_visual_composer_extend" ),
							"param_name"            	=> "filters_showall_style",
							"width"                 	=> 150,
							"value"                 	=> array(
								__( 'No Style', "ts_visual_composer_extend" )				=> "",
								__( 'Sun Flower Flat', "ts_visual_composer_extend" )		=> "ts-color-button-sun-flower",
								__( 'Orange Flat', "ts_visual_composer_extend" )			=> "ts-color-button-orange-flat",
								__( 'Carot Flat', "ts_visual_composer_extend" )     		=> "ts-color-button-carrot-flat",
								__( 'Pumpkin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-pumpkin-flat",
								__( 'Alizarin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-alizarin-flat",
								__( 'Pomegranate Flat', "ts_visual_composer_extend" )		=> "ts-color-button-pomegranate-flat",
								__( 'Turquoise Flat', "ts_visual_composer_extend" )			=> "ts-color-button-turquoise-flat",
								__( 'Green Sea Flat', "ts_visual_composer_extend" )			=> "ts-color-button-green-sea-flat",
								__( 'Emerald Flat', "ts_visual_composer_extend" )			=> "ts-color-button-emerald-flat",
								__( 'Nephritis Flat', "ts_visual_composer_extend" )			=> "ts-color-button-nephritis-flat",
								__( 'Peter River Flat', "ts_visual_composer_extend" )		=> "ts-color-button-peter-river-flat",
								__( 'Belize Hole Flat', "ts_visual_composer_extend" )		=> "ts-color-button-belize-hole-flat",
								__( 'Amethyst Flat', "ts_visual_composer_extend" )			=> "ts-color-button-amethyst-flat",
								__( 'Wisteria Flat', "ts_visual_composer_extend" )			=> "ts-color-button-wisteria-flat",
								__( 'Wet Asphalt Flat', "ts_visual_composer_extend" )		=> "ts-color-button-wet-asphalt-flat",
								__( 'Midnight Blue Flat', "ts_visual_composer_extend" )		=> "ts-color-button-midnight-blue-flat",
								__( 'Clouds Flat', "ts_visual_composer_extend" )			=> "ts-color-button-clouds-flat",
								__( 'Silver Flat', "ts_visual_composer_extend" )			=> "ts-color-button-silver-flat",
								__( 'Concrete Flat', "ts_visual_composer_extend" )			=> "ts-color-button-concrete-flat",
								__( 'Asbestos Flat', "ts_visual_composer_extend" )			=> "ts-color-button-asbestos-flat",
								__( 'Graphite Flat', "ts_visual_composer_extend" )			=> "ts-color-button-graphite-flat",
							),
							"description"           	=> __( "Select the color scheme for the show all button.", "ts_visual_composer_extend" ),
							"dependency"            	=> "",
							"group" 					=> "Filter Settings",
						),	
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Text: Available Groups", "ts_visual_composer_extend" ),
							"param_name"            	=> "filters_available",
							"value"                 	=> "Available Groups",
							"description"           	=> __( "Enter a text to be used a header for the section with the available groups.", "ts_visual_composer_extend" ),
							"dependency"           	 	=> "",
							"group" 					=> "Filter Settings",
						),
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Text: Selected Groups", "ts_visual_composer_extend" ),
							"param_name"            	=> "filters_selected",
							"value"                 	=> "Filtered Groups",
							"description"           	=> __( "Enter a text to be used a header for the section with the selected groups.", "ts_visual_composer_extend" ),
							"dependency"            	=> "",
							"group" 					=> "Filter Settings",
						),
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Text: Ungrouped Images", "ts_visual_composer_extend" ),
							"param_name"            	=> "filters_nogroups",
							"value"                 	=> "No Groups",
							"description"           	=> __( "Enter a text to be used to group images without any other groups applied to it.", "ts_visual_composer_extend" ),
							"dependency"            	=> "",
							"group" 					=> "Filter Settings",
						),
                        // Other Settings
                        array(
                            "type"						=> "seperator",
                            "heading"                   => __( "", "ts_visual_composer_extend" ),
                            "param_name"                => "seperator_6",
                            "value"                     => "",
							"seperator"					=> "Other Settings",
                            "description"               => __( "", "ts_visual_composer_extend" ),
                            "group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin: Top", "ts_visual_composer_extend" ),
                            "param_name"                => "margin_top",
                            "value"                     => "0",
                            "min"                       => "-50",
                            "max"                       => "500",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
                            "group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin: Bottom", "ts_visual_composer_extend" ),
                            "param_name"                => "margin_bottom",
                            "value"                     => "0",
                            "min"                       => "-50",
                            "max"                       => "500",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
                            "group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Define ID Name", "ts_visual_composer_extend" ),
                            "param_name"                => "el_id",
                            "value"                     => "",
                            "description"               => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
                            "group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Extra Class Name", "ts_visual_composer_extend" ),
                            "param_name"                => "el_class",
                            "value"                     => "",
                            "description"               => __( "Enter a class name for the element.", "ts_visual_composer_extend" ),
                            "group" 			        => "Other Settings",
                        ),
                        // Load Custom CSS/JS File
                        array(
                            "type"                      => "load_file",
                            "heading"                   => __( "", "ts_visual_composer_extend" ),
                            "param_name"                => "el_file1",
                            "value"                     => "",
                            "file_type"                 => "js",
							"file_id"         			=> "ts-extend-element",
                            "file_path"                 => "js/ts-visual-composer-extend-element.min.js",
                            "description"               => __( "", "ts_visual_composer_extend" )
                        ),
						array(
							"type"              		=> "load_file",
							"heading"           		=> __( "", "ts_visual_composer_extend" ),
							"param_name"        		=> "el_file2",
							"value"             		=> "Animation Files",
							"file_type"         		=> "css",
							"file_id"         			=> "ts-extend-animations",
							"file_path"         		=> "css/ts-visual-composer-extend-animations.min.css",
							"description"       		=> __( "", "ts_visual_composer_extend" )
						),
                    ))
                );
            }
        }
	}
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_TS_VCSC_Posts_Image_Grid_Standalone extends WPBakeryShortCode {
		public function singleParamHtmlHolder($param, $value, $settings = Array(), $atts = Array()) {
			$output 		= '';
			// Compatibility fixes
			$old_names 		= array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
			$new_names 		= array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
			$value 			= str_ireplace($old_names, $new_names, $value);
			//$value 		= __($value, "ts_visual_composer_extend");
			//
			$param_name 	= isset($param['param_name']) ? $param['param_name'] : '';
			$heading 		= isset($param['heading']) ? $param['heading'] : '';
			$type 			= isset($param['type']) ? $param['type'] : '';
			$class 			= isset($param['class']) ? $param['class'] : '';

            if (isset($param['holder']) === true && in_array($param['holder'], array('div', 'span', 'p'))) {
                $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
            } else if (isset($param['holder']) === true && $param['holder'] == 'input') {
                $output .= '<'.$param['holder'].' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'">';
            } else if (isset($param['holder']) === true && in_array($param['holder'], array('img', 'iframe'))) {
				$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="'.$value.'">';
			} else if (isset($param['holder']) === true && $param['holder'] == 'imagelist') {
				$images_ids = empty($value) ? array() : explode(',', trim($value));
				$output .= '<ul class="attachment-thumbnails'.(empty($images_ids) ? ' image-exists' : '' ).'" data-name="' . $param_name . '">';
					foreach($images_ids as $image) {
						$img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ));
						$output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
					}
				$output .= '</ul>';
				$output .= '<a href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '" style="margin-bottom: 10px;">' . __( 'Add or Remove Featured Media', "ts_visual_composer_extend" ) . '</a>';
            }
			
            if (isset($param['admin_label']) && $param['admin_label'] === true) {
                $output .= '<span style="width: 100%; display: block;" class="vc_admin_label admin_label_'.$param['param_name'].(empty($value) ? ' hidden-label' : '').'"><label>'. $param['heading'] .'</label>: '.$value.'</span>';
            }

			return $output;
		}
	};
}

// Initialize "TS Poststicker" Class
if (class_exists('TS_Postsimage')) {
	$TS_Postsimage = new TS_Postsimage;
}
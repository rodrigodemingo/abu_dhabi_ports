<?php
if (!class_exists('TS_Lightbox_Galleries')){
	class TS_Lightbox_Galleries {
		function __construct() {
			global $VISUAL_COMPOSER_EXTENSIONS;
            if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
                add_action('init',                              		array($this, 'TS_VCSC_Add_Lightbox_Gallery_Elements'), 9999999);
            } else {
                add_action('admin_init',		                		array($this, 'TS_VCSC_Add_Lightbox_Gallery_Elements'), 9999999);
            }
			add_shortcode('TS_VCSC_Lightbox_Gallery',          			array($this, 'TS_VCSC_Lightbox_Gallery_Standalone'));
		}
        
		// Standalone Lightbox Gallery
		function TS_VCSC_Lightbox_Gallery_Standalone ($atts, $content = null) {
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
				'content_style'				=> 'grid',
				'content_title'				=> '',
				'content_trigger_image'		=> '',
				'content_trigger_title'		=> '',
	
				'content_images'			=> '',
				'content_images_titles'		=> '',
				'content_images_groups'		=> '',
				'content_images_size'		=> 'medium',
				
				'filters_available'			=> 'Available Groups',
				'filters_selected'			=> 'Filtered Groups',
				'filters_nogroups'			=> 'No Groups',
				'filters_toggle'			=> 'Toggle Filter',
				'filters_toggle_style'		=> '',
				'filters_showall'			=> 'Show All',
				'filters_showall_style'		=> '',
				
				'trigger_grayscale'			=> 'false',
				
				'thumbnail_position'		=> 'bottom',
				'thumbnail_height'			=> 100,
				
				'lightbox_size'				=> 'full',
				'lightbox_effect'			=> 'random',
				'lightbox_pageload'			=> 'false',
				'lightbox_autooption'		=> 'true',
				'lightbox_autoplay'			=> 'false',
				'lightbox_speed'			=> 5000,
				'lightbox_social'			=> 'true',
				
				'lightbox_backlight'		=> 'auto',
				'lightbox_backlight_auto'	=> 'true',
				'lightbox_backlight_color'	=> '#ffffff',
				
				'data_grid_breaks'			=> '240,480,720,960',
				'data_grid_space'			=> 2,
				'data_grid_order'			=> 'false',
				'data_grid_shuffle'			=> 'false',
				'data_grid_limit'			=> 0,
				
				'fullwidth'					=> 'false',
				'breakouts'					=> 6,
	
				'number_images'				=> 1,
				'auto_height'				=> 'true',
				'page_rtl'					=> 'false',
				'auto_play'					=> 'false',
				'show_playpause'			=> 'true',
				'slide_show'				=> 'false',
				'show_bar'					=> 'true',
				'bar_color'					=> '#dd3333',
				'show_speed'				=> 5000,
				'stop_hover'				=> 'true',
				'show_navigation'			=> 'true',
				'dot_navigation'			=> 'true',
				'page_numbers'				=> 'false',
				'items_loop'				=> 'false',				
				'animation_in'				=> 'ts-viewport-css-flipInX',
				'animation_out'				=> 'ts-viewport-css-slideOutDown',
				'animation_mobile'			=> 'false',
				
				'flex_animation'			=> 'slide',
				'flex_margin'				=> 0,
				'flex_border_width'			=> 5,				
				'flex_breaks_thumbs'		=> '200,400,600,800,1000,1200,1400,1600,1800',
				'flex_breaks_single'		=> '240,480,720,960,1280,1600,1980',
				
				'flex_border_color'			=> "#ffffff",
				'flex_background'			=> "#ffffff",
				
				'flex_tooltipthumbs'		=> "false",				
				'slice_tooltipthumbs'		=> "none",
				'tooltipster_position'		=> 'ts-simptip-position-top',
				'tooltipster_offsetx'		=> 0,
				'tooltipster_offsety'		=> 0,
				
				'margin_top'				=> 0,
				'margin_bottom'				=> 0,
				'el_id'						=> '',
				'el_class'					=> '',
				'css'						=> '',
			), $atts ));
	
			$randomizer						= mt_rand(999999, 9999999);
		
			if (!empty($el_id)) {
				$modal_id					= $el_id;
				$nacho_group				= 'nachogroup' . $randomizer;
			} else {
				$modal_id					= 'ts-vcsc-image-gallery-' . $randomizer;
				$nacho_group				= 'nachogroup' . $randomizer;
			}
			
			if (($tooltipster_position == "ts-simptip-position-top") || ($tooltipster_position == "top")) {
				$tooltipster_position		= "top";
			}
			if (($tooltipster_position == "ts-simptip-position-left") || ($tooltipster_position == "left")) {
				$tooltipster_position		= "left";
			}
			if (($tooltipster_position == "ts-simptip-position-right") || ($tooltipster_position == "right")) {
				$tooltipster_position		= "right";
			}
			if (($tooltipster_position == "ts-simptip-position-bottom") || ($tooltipster_position == "bottom")) {
				$tooltipster_position		= "bottom";
			}
			
			// Check for Front End Editor
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
				$slider_class				= 'owl-carousel2-edit';
				$flex_class					= 'flex-carousel-edit';
				$nivo_class					= 'nivo-carousel-edit';
				$slider_message				= '<div class="ts-composer-frontedit-message">' . __( 'The slider is currently viewed in front-end edit mode; (some) slider features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
				$slider_style				= 'width: ' . (100 / $number_images) . '%; height: 100%; float: left; margin: 0; padding: 0;';
				$grid_class					= 'ts-lightbox-gallery-edit';
				$grid_message				= '<div class="ts-composer-frontedit-message">' . __( 'The grid is currently viewed in front-end edit mode; grid and filter features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
				$grid_style					= 'width: 20%; height: 100%; display: inline-block; margin: 0; padding: 0;';
				$frontend_edit				= 'true';
			} else {
				$slider_class				= 'ts-owlslider-parent owl-carousel2';
				$flex_class					= 'ts-flexslider-parent flex-carousel';
				$nivo_class					= 'ts-nivoslider-parent nivo-carousel nivoSlider';
				$slider_message				= '';
				$slider_style				= '';
				$grid_class					= 'ts-lightbox-gallery-grid';
				$grid_style					= '';
				$grid_message				= '';
				$frontend_edit				= 'false';
			}
			
			// Content: Gallery
			$modal_gallery					= '';
			if (!empty($content_images)) {
				$count_images 				= substr_count($content_images, ",") + 1;
			} else {
				$count_images				= 0;
			}
			if ($data_grid_limit > $count_images) {
				$data_grid_limit			= 0;
			}
			if (!empty($data_grid_breaks)) {
				$data_grid_breaks 			= str_replace(' ', '', $data_grid_breaks);
				$count_columns				= substr_count($data_grid_breaks, ",") + 1;
			} else {
				$count_columns				= 0;
			}
			
			$content_images 				= explode(',', $content_images);
			$content_images_titles			= explode(',', $content_images_titles);
			$content_images_groups			= explode(',', $content_images_groups);
			if (strtolower($content_style) == "grid") {
				$content_combined 			= array_map(function($p, $t, $g) {
					return array('image' => $p, 'title' => (!empty($t) ? $t : ""), 'groups' => (!empty($g) ? $g : "")); 
				}, $content_images, $content_images_titles, $content_images_groups);
				if (($data_grid_shuffle == "true") && ($data_grid_order == "false")) {
					shuffle($content_combined);
				}
			} else {
				$content_combined			= array();
			}
			$i 								= -1;
			$k								= -1;
			$b								= 0;
			$output 						= '';
			
			if ($content_images_groups != '') {
				if ($filters_toggle_style != '') {
					wp_enqueue_style('ts-extend-buttonsflat');
				}
				wp_enqueue_style('ts-extend-multiselect');
				wp_enqueue_script('ts-extend-multiselect');
			}
			
			$content_style 					= strtolower($content_style);
	
			if ($data_grid_limit != 0) {
				$nachoLength				= $data_grid_limit - 1;
			} else {
				$nachoLength 				= count($content_images) - 1;
			}
			if (!empty($content)) {
				$nacho_info 				= 'data-info="' . $nacho_group . '-info"';
			} else {
				$nacho_info					= '';
			}
			if ($lightbox_backlight != "auto") {
				if ($lightbox_backlight == "custom") {
					$nacho_color			= 'data-color="' . $lightbox_backlight_color . '"';
				} else if ($lightbox_backlight == "hideit") {
					$nacho_color			= 'data-color="#000000"';
				}
			} else {
				$nacho_color				= '';
			}
			
			if (function_exists('vc_shortcode_custom_css_class')) {
				$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-lightbox-nacho-frame ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Lightbox_Gallery', $atts);
			} else {
				$css_class 	= 'ts-lightbox-nacho-frame ' . $el_class;
			}
			
			// Auto-Grid Layout
			if (strtolower($content_style) == "grid") {
				$fullwidth_allow			= "true";
				// Front-Edit Message
				if ($frontend_edit == "true") {
					$modal_gallery .= $grid_message;
				}				
				$modal_gallery .= '<div id="' . $modal_id . '-grid" class="' . $grid_class . '">';
					foreach($content_combined as $image => $meta ) {
						$i++;
						if (($data_grid_limit != 0) && ($i > ($data_grid_limit - 1))) {
							$i					= ($data_grid_limit - 1);
							break;
						}
						$modal_image			= wp_get_attachment_image_src($meta['image'], $lightbox_size);
						$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
						$modal_thumb			= preg_replace('/[^\d]/', '', $meta['image']);
						$modal_thumb			= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nch-lb-makegrid' ));
						if ($i == $nachoLength) {
							if (($count_images < $count_columns) || (($data_grid_limit != 0) && ($data_grid_limit < $count_columns))) {
								$data_grid_string	= explode(',', $data_grid_breaks);
								$data_grid_breaks	= array();
								if (($data_grid_limit != 0) && ($data_grid_limit < $count_columns)) {
									foreach ($data_grid_string as $single_break) {
										$b++;
										if ($b <= $data_grid_limit) {
											array_push($data_grid_breaks, $single_break);
										} else {
											break;
										}
									}
								} else {
									foreach ($data_grid_string as $single_break) {
										$b++;
										if ($b <= $count_images) {
											array_push($data_grid_breaks, $single_break);
										} else {
											break;
										}
									}
								}
								$data_grid_breaks	= implode(",", $data_grid_breaks);
							} else {
								$data_grid_breaks 	= $data_grid_breaks;
							}
							if ($frontend_edit == "false") {
								$modal_gallery .= '<a style="' . $grid_style . '" id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-random="' . $randomizer . '" data-include="true" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . ' data-captions="true" data-grid="' . $data_grid_breaks . '" data-gridspace="' . $data_grid_space . '" data-gridorder="' . $data_grid_order . '" data-gridfilter="true" data-gridavailable="' . $filters_available . '" data-gridselected="' . $filters_selected . '" data-gridnogroups="' . $filters_nogroups . '" data-gridtoggle="' . $filters_toggle . '" data-gridtogglestyle="' . $filters_toggle_style . '" data-gridshowall="' . $filters_showall . '" data-gridshowallstyle="' . $filters_showall_style . '">';
							} else {								
								$modal_gallery .= '<a style="' . $grid_style . '" id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-include="true" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
							}
								$modal_gallery .= $modal_thumb['thumbnail'];
							$modal_gallery .= '</a>';
						} else {
							$modal_gallery .= '<a style="' . $grid_style . '" id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-include="true" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
								$modal_gallery .= $modal_thumb['thumbnail'];
							$modal_gallery .= '</a>';
						}
					}					
				$modal_gallery .= '</div>';
				if ($data_grid_limit != 0) {
					foreach($content_combined as $image => $meta ) {						
						$k++;
						if ($k > ($data_grid_limit - 1)) {
							$modal_image		= wp_get_attachment_image_src($meta['image'], $lightbox_size);
							$image_extension	= pathinfo($modal_image[0], PATHINFO_EXTENSION);
							$modal_thumb		= preg_replace('/[^\d]/', '', $meta['image']);
							$modal_thumb		= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nch-lb-nogrid' ));
							$modal_gallery .= '<a style="display: none; ' . $grid_style . '" id="' . $nacho_group . '-' . $k .'" href="' . $modal_image[0] . '" data-include="false" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" class="nch-lightbox-media nofancybox nch-lb-nogrid" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
								$modal_gallery .= $modal_thumb['thumbnail'];
							$modal_gallery .= '</a>';
						}
					}
				}
				if ($frontend_edit == "false") {					
					$modal_gallery .= '<script type="text/javascript">';
						$modal_gallery .= 'jQuery(window).load(function(){';
							/*$modal_gallery .= 'jQuery("#' . $modal_id . '-frame a").nchgrid({';
								$modal_gallery .= 'order:		' . $data_grid_order . ',';
							$modal_gallery .= '});';*/
							if ($lightbox_pageload == "true") {
								$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
							}
						$modal_gallery .= '});';
					$modal_gallery .= '</script>';
				}
			}
			// First Image Only Layout
			if (strtolower($content_style) == "first") {
				$fullwidth_allow			= "false";
				foreach ($content_images as $single_image) {
					$i++;
					$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
					$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
					$modal_thumb			= preg_replace('/[^\d]/', '', $single_image);
					if ($i == 0) {
						$modal_thumb		= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nachocover' ));
					} else {
						$modal_thumb		= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nachohidden' ));
					}
					if (($i == 0) || ($nachoLength == 0)) {
						$modal_gallery .= '<div class="nchgrid-item nchgrid-tile nch-lightbox-trigger ' . ($trigger_grayscale == "true" ? "nch-lightbox-trigger-grayscale" : "") . '" style="">';
							$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
								$modal_gallery .= $modal_thumb['thumbnail'];
								$modal_gallery .= '<div class="nchgrid-caption"></div>';
								if (!empty($content_images_titles[$i])) {
									$modal_gallery .= '<div class="nchgrid-caption-text">' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '</div>';
								}
							$modal_gallery .= '</a>';
						$modal_gallery .= '</div>';
					} else if ($i == $nachoLength) {
						$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
							if ($thumbnail_position != "0") {
								$modal_gallery .= $modal_thumb['thumbnail'];
							} else {
								$modal_gallery .= 'Lightbox Image #' . ($i + 1);
							}
						$modal_gallery .= '</a>';
					} else {
						$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
							if ($thumbnail_position != "0") {
								$modal_gallery .= $modal_thumb['thumbnail'];
							} else {
								$modal_gallery .= 'Lightbox Image #' . ($i + 1);
							}
						$modal_gallery .= '</a>';
					}
				}
				$modal_gallery .= '<script type="text/javascript">';
					$modal_gallery .= 'jQuery(window).load(function(){';
						if ($lightbox_pageload == "true") {
							$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
						}
					$modal_gallery .= '});';
				$modal_gallery .= '</script>';
			}
			// Custom Image Layout
			if (strtolower($content_style) == "image") {
				$fullwidth_allow			= "false";
				if (!empty($content_trigger_image)) {
					$trigger_thumb 					= wp_get_attachment_image_src($content_trigger_image, 'large');
					$modal_gallery .= '<div class="nchgrid-item nchgrid-tile nch-lightbox-trigger ' . ($trigger_grayscale == "true" ? "nch-lightbox-trigger-grayscale" : "") . '" style="">';
						$modal_gallery .= '<a href="#" class="nch-lightbox-trigger nofancybox" data-title="' . (!empty($content_trigger_title) ? $content_trigger_title : "") . '" data-group="' . $nacho_group . '">';
							$modal_gallery .= '<img src="' . $trigger_thumb[0] . '" alt="" title="" style="">';
							$modal_gallery .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_trigger_title)) {
								$modal_gallery .= '<div class="nchgrid-caption-text">' . (!empty($content_trigger_title) ? $content_trigger_title : "") . '</div>';
							}
						$modal_gallery .= '</a>';
					$modal_gallery .= '</div>';					
					foreach ($content_images as $single_image) {
						$i++;
						$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
						$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
						$modal_thumb			= preg_replace('/[^\d]/', '', $single_image);
						$modal_thumb			= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nachohidden' ));
						if ($i == $nachoLength) {
							$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
								if ($thumbnail_position != "0") {
									$modal_gallery .= $modal_thumb['thumbnail'];
								} else {
									$modal_gallery .= 'Lightbox Image #' . ($i + 1);
								}
							$modal_gallery .= '</a>';
						} else {
							$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
								if ($thumbnail_position != "0") {
									$modal_gallery .= $modal_thumb['thumbnail'];
								} else {
									$modal_gallery .= 'Lightbox Image #' . ($i + 1);
								}
							$modal_gallery .= '</a>';
						}
					}
					$modal_gallery .= '<script type="text/javascript">';
						$modal_gallery .= 'jQuery(window).load(function(){';
							if ($lightbox_pageload == "true") {
								$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
							}
						$modal_gallery .= '});';
					$modal_gallery .= '</script>';
				}
			}
			// Owl Slider Layout
			if (strtolower($content_style) == "slider") {
				wp_enqueue_style('ts-extend-owlcarousel2');
				wp_enqueue_script('ts-extend-owlcarousel2');
				$fullwidth_allow			= "true";
				$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '-container" class="ts-lightbox-gallery-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					// Front-Edit Message
					if ($frontend_edit == "true") {
						$modal_gallery .= $slider_message;
					}				
					// Add Progressbar
					if (($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) {
						$modal_gallery .= '<div id="ts-owlslider-progressbar-' . $randomizer . '" class="ts-owlslider-progressbar-holder" style=""><div class="ts-owlslider-progressbar" style="background: ' . $bar_color . '; height: 100%; width: 0%;"></div></div>';
					}
					// Add Navigation Controls
					if ($frontend_edit == "false") {
						$modal_gallery .= '<div id="ts-owlslider-controls-' . $randomizer . '" class="ts-owlslider-controls" style="' . (((($auto_play == "true") && ($show_playpause == "true")) || ($show_navigation == "true")) ? "display: block;" : "display: none;") . '">';
							$modal_gallery .= '<div id="ts-owlslider-controls-next-' . $randomizer . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-next"><span class="ts-ecommerce-arrowright5"></span></div>';
							$modal_gallery .= '<div id="ts-owlslider-controls-prev-' . $randomizer . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-prev"><span class="ts-ecommerce-arrowleft5"></span></div>';
							if (($auto_play == "true") && ($show_playpause == "true")) {
								$modal_gallery .= '<div id="ts-owlslider-controls-play-' . $randomizer . '" class="ts-owlslider-controls-play active"><span class="ts-ecommerce-pause"></span></div>';
							}
						$modal_gallery .= '</div>';
					}
					// Add Slider
					$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '" class="' . $slider_class . ' ts-lightbox-gallery-slider" data-id="' . $randomizer . '" data-items="' . $number_images . '" data-rtl="' . $page_rtl . '" data-loop="' . $items_loop . '" data-navigation="' . $show_navigation . '" data-dots="' . $dot_navigation . '" data-mobile="' . $animation_mobile . '" data-animationin="' . $animation_in . '" data-animationout="' . $animation_out . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
						foreach ($content_images as $single_image) {
							$i++;
							$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
							$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
							if ($i == $nachoLength) {
								$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
								$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="' . $slider_style . '">';
									$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
										$modal_gallery .= '<img src="' . $modal_image[0] . '" style="">';
										$modal_gallery .= '<div class="nchgrid-caption"></div>';
										if (!empty($content_images_titles[$i])) {
											$modal_gallery .= '<div class="nchgrid-caption-text">' . $content_images_titles[$i] . '</div>';
										}
									$modal_gallery .= '</a>';
								$modal_gallery .= '</div>';
							} else {
								$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="' . $slider_style . '">';
									$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
										$modal_gallery .= '<img src="' . $modal_image[0] . '" style="">';
										$modal_gallery .= '<div class="nchgrid-caption"></div>';
										if (!empty($content_images_titles[$i])) {
											$modal_gallery .= '<div class="nchgrid-caption-text">' . $content_images_titles[$i] . '</div>';
										}
									$modal_gallery .= '</a>';
								$modal_gallery .= '</div>';
							}
						}
					$modal_gallery .= '</div>';
				$modal_gallery .= '</div>';
				$modal_gallery .= '<script type="text/javascript">';
					$modal_gallery .= 'jQuery(window).load(function(){';
						if ($lightbox_pageload == "true") {
							$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
						}
					$modal_gallery .= '});';
				$modal_gallery .= '</script>';
			}
			// Flex Slider Layout
			if ((strtolower($content_style) == "flexthumb") || (strtolower($content_style) == "flexsingle")) {
				wp_enqueue_style('ts-extend-tooltipster');
				wp_enqueue_script('ts-extend-tooltipster');	
				//wp_enqueue_script('jquery-easing');
				//wp_enqueue_script('ts-extend-mousewheel');
				wp_enqueue_style('ts-extend-flexslider2');
				wp_enqueue_script('ts-extend-flexslider2');
				$fullwidth_allow			= "true";
				if ((strtolower($content_style) == "flexsingle") && ($flex_animation == "fade")) {
					$number_images 			= 1;
					$flex_margin 			= 0;
				}
				$modal_gallery .= '<div id="ts-lightbox-gallery-flexslider-' . $randomizer . '-container" class="ts-flexslider-container ts-lightbox-flexslider-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-main="ts-lightbox-flexslider-main-' . $randomizer . '" data-frontend="' . $frontend_edit . '" data-id="' . $randomizer . '" data-count="' . (count($content_images)) . '" data-combo="' . ((strtolower($content_style) == "flexthumb") ? "true" : "false") . '" data-thumbs="ts-lightbox-flexslider-thumbs-' . $randomizer . '" data-images="' . $number_images . '" data-margin="' . $flex_margin . '" data-rtl="' . $page_rtl . '" data-navigation="' . $dot_navigation . '" data-animation="' . $flex_animation . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
					// Front-Edit Message
					if ($frontend_edit == "true") {
						$modal_gallery .= $slider_message;
					}
					// Add Progressbar
					if (($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) {
						$modal_gallery .= '<div id="ts-flexslider-progressbar-container-' . $randomizer . '" class="ts-flexslider-progressbar-container" style="width: 100%; height: 100%; background: #ededed;"><div id="ts-flexslider-progressbar-' . $randomizer . '" class="ts-flexslider-progressbar" style="background: ' . $bar_color . '; height: 10px;"></div></div>';
					}
					// Add Slider (Main)
					$modal_gallery .= '<div id="ts-lightbox-flexslider-main-' . $randomizer . '" class="' . $flex_class . ' ts-lightbox-gallery-flexslider ts-lightbox-gallery-flexslider-main" style="margin-bottom: ' . ((($frontend_edit == "false") && (strtolower($content_style) == "flexsingle")) ? 40: 0) . 'px; border: ' . $flex_border_width . 'px solid ' . $flex_border_color . '; background: ' . $flex_background . ';" data-id="' . $randomizer . '" data-breaks="' . $flex_breaks_single . '">';
						$modal_gallery .= '<ul class="slides">';
							foreach ($content_images as $single_image) {
								$i++;
								$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
								$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
								if ($i == $nachoLength) {
									$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
									$modal_gallery .= '<li data-counter="' . ($i + 1) . '" style="' . ((strtolower($content_style) == "flexthumb") ? "margin: 0;" : "margin: 0px " . ((($number_images == 1) || ($page_rtl == "true")) ? 0 : $flex_margin) . "px 0px " . ((($number_images == 1) || ($page_rtl == "false")) ? 0 : $flex_margin) . "px;") . '"><div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="' . $slider_style . '">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
											$modal_gallery .= '<img src="' . $modal_image[0] . '" style="">';
											$modal_gallery .= '<div class="nchgrid-caption"></div>';
											if (!empty($content_images_titles[$i])) {
												$modal_gallery .= '<div class="nchgrid-caption-text">' . $content_images_titles[$i] . '</div>';
											}
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div></li>';
								} else {
									$modal_gallery .= '<li data-counter="' . ($i + 1) . '" style="' . ((strtolower($content_style) == "flexthumb") ? "margin: 0;" : "margin: 0px " . ((($number_images == 1) || ($page_rtl == "true")) ? 0 : $flex_margin) . "px 0px " . ((($number_images == 1) || ($page_rtl == "false")) ? 0 : $flex_margin) . "px;") . '"><div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="' . $slider_style . '">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
											$modal_gallery .= '<img src="' . $modal_image[0] . '" style="">';
											$modal_gallery .= '<div class="nchgrid-caption"></div>';
											if (!empty($content_images_titles[$i])) {
												$modal_gallery .= '<div class="nchgrid-caption-text">' . $content_images_titles[$i] . '</div>';
											}
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div></li>';
								}
							}
						$modal_gallery .= '</ul>';
						// Add Play/Pause Control
						if (($auto_play == "true") && ($show_playpause == "true")) {
							$modal_gallery .= '<div id="ts-flexslider-controls-' . $randomizer . '" class="ts-flexslider-controls" style="display: none;">';
								$modal_gallery .= '<div id="ts-flexslider-controls-play-' . $randomizer . '" class="ts-flexslider-controls-play active"><span class="ts-ecommerce-pause"></span></div>';
							$modal_gallery .= '</div>';
						}
					$modal_gallery .= '</div>';
					// Add Slider (Thumbs)
					if (($frontend_edit == "false") && (strtolower($content_style) == "flexthumb")) {
						$modal_gallery .= '<div id="ts-lightbox-flexslider-thumbs-' . $randomizer . '" class="' . $flex_class . ' ts-lightbox-gallery-flexslider ts-lightbox-gallery-flexslider-thumbs" style="margin-bottom: ' . ($dot_navigation == "true" ? 40 : 0) . 'px; border: ' . $flex_border_width . 'px solid ' . $flex_border_color . '; background: ' . $flex_background . '; margin-top: ' . ($flex_border_width == 0 ? 5: 0) . 'px;" data-id="' . $randomizer . '" data-breaks="' . $flex_breaks_thumbs . '">';
							$modal_gallery .= '<ul class="slides">';
								$i 							= -1;
								foreach ($content_images as $single_image) {
									$i++;
									$modal_image			= wp_get_attachment_image_src($single_image, $content_images_size);
									$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
									if ((!empty($content_images_titles[$i])) && ($flex_tooltipthumbs == "true")) {
										$thumb_tooltipclasses	= 'ts-has-tooltipster-tooltip';
										$thumb_tooltipcontent 	= 'data-tooltipster-title="" data-tooltipster-text="' . $content_images_titles[$i] . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="tooltipster-black" data-tooltipster-animation="swing" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
									} else {
										$thumb_tooltipclasses	= "";
										$thumb_tooltipcontent	= "";
									}									
									$modal_gallery .= '<li class="' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . ' style="cursor: pointer; margin: 0 ' . $flex_margin . 'px 0 0;">';
										$modal_gallery .= '<img src="' . $modal_image[0] . '" style="">';
									$modal_gallery .= '</li>';
								}
							$modal_gallery .= '</ul>';
						$modal_gallery .= '</div>';
					}
				$modal_gallery .= '</div>';
				$modal_gallery .= '<script type="text/javascript">';
					$modal_gallery .= 'jQuery(window).load(function(){';
						if ($lightbox_pageload == "true") {
							$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
						}
					$modal_gallery .= '});';
				$modal_gallery .= '</script>';
			}			
			// Nivo Slider Layout
			if (strtolower($content_style) == "nivoslider") {
				wp_enqueue_style('ts-extend-nivoslider');
				wp_enqueue_script('ts-extend-nivoslider');
				$fullwidth_allow			= "true";
				$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '-container" class="ts-nivoslider-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					// Front-Edit Message
					if ($frontend_edit == "true") {
						$modal_gallery .= $slider_message;
					}				
					// Add Progressbar
					if (($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) {
						$modal_gallery .= '<div id="ts-nivoslider-progressbar-container-' . $randomizer . '" class="ts-nivoslider-progressbar-container" style=""><div id="ts-nivoslider-progressbar-' . $randomizer . '" class="ts-nivoslider-progressbar" style="background: ' . $bar_color . ';"></div></div>';
					}
					// Add Play/Pause Control
					if (($auto_play == "true") && ($show_playpause == "true")) {	
						$modal_gallery .= '<div id="ts-nivoslider-controls-options-' . $randomizer . '" class="ts-nivoslider-controls-options" style="' . ((($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) ? "top: 0px;" : "") . '">';
							$modal_gallery .= '<span id="ts-nivoslider-controls-play-' . $randomizer . '" class="ts-nivoslider-controls-play" style="' . ($auto_play == "true" ? "display: none;" : "") . '"></span>';
							$modal_gallery .= '<span id="ts-nivoslider-controls-pause-' . $randomizer . '" class="ts-nivoslider-controls-pause" style=""></span>';
						$modal_gallery .= '</div>';
					}
					// Add Slider
					$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '" class="' . $nivo_class . ' ts-lightbox-gallery-slider" style="' . ((($auto_play == "true") && ($show_bar == "true")) ? "margin-top: 10px;" : "") . '" data-id="' . $randomizer . '" data-items="' . $number_images . '" data-rtl="' . $page_rtl . '" data-navigation="' . $dot_navigation . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
						foreach ($content_images as $single_image) {
							$i++;
							$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
							$thumb_image			= wp_get_attachment_image_src($single_image, "thumbnail");
							$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
							if ($i == $nachoLength) {
								$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
								$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-thumb="' . $thumb_image[0] . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
									$modal_gallery .= '<img src="' . $modal_image[0] . '" style="" data-transition-left="slideInLeft" data-transition-right="slideInRight" data-thumb="' . $thumb_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" >';
								$modal_gallery .= '</a>';								
							} else {
								$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-thumb="' . $thumb_image[0] . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
									$modal_gallery .= '<img src="' . $modal_image[0] . '" style="" data-transition-left="slideInLeft" data-transition-right="slideInRight" data-thumb="' . $thumb_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" >';
								$modal_gallery .= '</a>';
								
							}
						}
					$modal_gallery .= '</div>';
				$modal_gallery .= '</div>';
				$modal_gallery .= '<script type="text/javascript">';
					$modal_gallery .= 'jQuery(window).load(function(){';
						if ($lightbox_pageload == "true") {
							$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
						}
					$modal_gallery .= '});';
				$modal_gallery .= '</script>';
			}
			// SliceBox Layout
			if (strtolower($content_style) == "slicebox") {
				if ($frontend_edit == "true") {
					$auto_play 				= "false";
				} else {
					wp_enqueue_style('ts-extend-tooltipster');
					wp_enqueue_script('ts-extend-tooltipster');	
				}
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndModernizr == "true") {
					wp_enqueue_script('ts-extend-modernizr');
				}
				wp_enqueue_style('ts-extend-slicebox');
				wp_enqueue_script('ts-extend-slicebox');
				$fullwidth_allow			= "false";
				$modal_gallery .= '<div id="ts-lightbox-gallery-slicebox-' . $randomizer . '" class="ts-lightbox-gallery-slicebox" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-frontend="' . $frontend_edit . '" data-id="' . $randomizer . '" data-count="' . (count($content_images)) . '" data-images="' . $number_images . '" data-rtl="' . $page_rtl . '" data-navigation="' . $dot_navigation . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
					// Front-Edit Message
					if ($frontend_edit == "true") {
						$modal_gallery .= $slider_message;
					}
					// Add Progressbar
					if (($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) {
						$modal_gallery .= '<div id="ts-slicebox-progressbar-container-' . $randomizer . '" class="ts-slicebox-progressbar-container" style="width: 100%; height: 100%; background: #ededed;"><div id="ts-slicebox-progressbar-' . $randomizer . '" class="ts-slicebox-progressbar" style="background: ' . $bar_color . '; height: 10px; max-width: 100%;"></div></div>';
					}
					// Add Slider
					$modal_gallery .= '<ul class="sb-slider ts-lightbox-gallery-slicebox-slider" style="margin: 0 auto;">';
						foreach ($content_images as $single_image) {
							$i++;
							$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
							$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
							if ($i == $nachoLength) {
								$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
								$modal_gallery .= '<li data-counter="' . ($i + 1) . '">';
									$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" target="_blank" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
											$modal_gallery .= '<img src="' . $modal_image[0] . '" style="" data-width="' . $modal_image[1] . '" data-height="' . $modal_image[2] . '" data-ratio="' . ($modal_image[1] / $modal_image[2]) . '" data-stack="">';
											$modal_gallery .= '<div class="nchgrid-caption"></div>';
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div>';
									if (!empty($content_images_titles[$i])) {
										$modal_gallery .= '<div class="sb-description">' . $content_images_titles[$i] . '</div>';
									}
								$modal_gallery .= '</li>';
							} else {
								$modal_gallery .= '<li>';
									$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" target="_blank" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
											$modal_gallery .= '<img src="' . $modal_image[0] . '" style="" data-width="' . $modal_image[1] . '" data-height="' . $modal_image[2] . '" data-ratio="' . ($modal_image[1] / $modal_image[2]) . '" data-stack="">';
											$modal_gallery .= '<div class="nchgrid-caption"></div>';
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div>';
									if (!empty($content_images_titles[$i])) {
										$modal_gallery .= '<div class="sb-description">' . $content_images_titles[$i] . '</div>';
									}
								$modal_gallery .= '</li>';
							}
						}
					$modal_gallery .= '</ul>';
					// Add Autoplay Controls
					if (($auto_play == "true") && ($show_playpause == "true")) {	
						$modal_gallery .= '<div id="nav-options" class="ts-slicebox-controls-options nav-options" style="' . ((($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) ? "top: 10px;" : "") . '">';
							$modal_gallery .= '<span class="ts-slicebox-controls-play" style="' . ($auto_play == "true" ? "display: none;" : "") . '"></span>';
							$modal_gallery .= '<span class="ts-slicebox-controls-pause" style=""></span>';
						$modal_gallery .= '</div>';
					}
					// Add Next / Prev Navigation
					$modal_gallery .= '<div id="nav-arrows" class="ts-slicebox-controls-arrows nav-arrows">';
						$modal_gallery .= '<a class="ts-slicebox-controls-next" href="#"></a>';
						$modal_gallery .= '<a class="ts-slicebox-controls-prev" href="#"></a>';
					$modal_gallery .= '</div>';
					// Add Navigation Dots
					if ($dot_navigation == "true") {
						$modal_gallery .= '<div id="nav-dots" class="ts-slicebox-controls-dots nav-dots">';
							$i 							= -1;
							foreach ($content_images as $single_image) {
								$i++;
								if ($frontend_edit == "true") {
									$thumb_tooltipclasses	= '';
									$thumb_tooltipcontent	= '';
								} else {
									if ($slice_tooltipthumbs == "image") {
										$modal_image			= wp_get_attachment_image_src($single_image, "thumbnail");
										$thumb_tooltipclasses	= 'ts-has-tooltipster-tooltip';
										$thumb_tooltipcontent 	= 'data-tooltipster-image="' . $modal_image[0] . '" data-tooltipster-title="" data-tooltipster-text="" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="tooltipster-black tooltipster-image" data-tooltipster-animation="swing" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
									} else if (($slice_tooltipthumbs == "title") && (!empty($content_images_titles[$i]))) {
										$thumb_tooltipclasses	= 'ts-has-tooltipster-tooltip';
										$thumb_tooltipcontent 	= 'data-tooltipster-image="" data-tooltipster-title="" data-tooltipster-text="' . $content_images_titles[$i] . '" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="tooltipster-black" data-tooltipster-animation="swing" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
									} else {
										$thumb_tooltipclasses	= '';
										$thumb_tooltipcontent	= '';
									}
								}
								if ($i == 0) {
									$modal_gallery .= '<span class="nav-dot-current ts-slicebox-controls-dots ' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . '></span>';
								} else {
									$modal_gallery .= '<span class="ts-slicebox-controls-dots ' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . '></span>';
								}
							}
						$modal_gallery .= '</div>';
					}
				$modal_gallery .= '</div>';
				$modal_gallery .= '<script type="text/javascript">';
					$modal_gallery .= 'jQuery(window).load(function(){';
						if ($lightbox_pageload == "true") {
							$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
						}
					$modal_gallery .= '});';
				$modal_gallery .= '</script>';
			}			
			// Stack Layout
			if (strtolower($content_style) == "stack") {
				wp_enqueue_style('ts-extend-stackslider');
				wp_enqueue_script('ts-extend-stackslider');
				$fullwidth_allow			= "false";
				$modal_gallery .= '<ul id="ts-lightbox-gallery-stack-' . $randomizer . '" class="ts-lightbox-gallery-stack">';
					foreach ($content_images as $single_image) {
						$i++;
						$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
						$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
						if ($i == $nachoLength) {
							$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
							$modal_gallery .= '<li>';
								$modal_gallery .= '<div class="st-item">';
									$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" target="_blank" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
											$modal_gallery .= '<img src="' . $modal_image[0] . '" style="" data-width="' . $modal_image[1] . '" data-height="' . $modal_image[2] . '" data-ratio="' . ($modal_image[1] / $modal_image[2]) . '" data-stack="">';
											$modal_gallery .= '<div class="nchgrid-caption"></div>';
											if (!empty($content_images_titles[$i])) {
												$modal_gallery .= '<div class="nchgrid-caption-text">' . $content_images_titles[$i] . '</div>';
											}
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div>';
								$modal_gallery .= '</div>';
								if (!empty($content_images_titles[$i])) {
									$modal_gallery .= '<div class="st-title">' . $content_images_titles[$i] . '</div>';
								} else {
									$modal_gallery .= '<div class="st-title"></div>';
								}
							$modal_gallery .= '</li>';
						} else {
							$modal_gallery .= '<li>';
								$modal_gallery .= '<div class="st-item">';
									$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-image" style="">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" target="_blank" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox-media ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
											$modal_gallery .= '<img src="' . $modal_image[0] . '" style="" data-width="' . $modal_image[1] . '" data-height="' . $modal_image[2] . '" data-ratio="' . ($modal_image[1] / $modal_image[2]) . '" data-stack="">';
											$modal_gallery .= '<div class="nchgrid-caption"></div>';
											if (!empty($content_images_titles[$i])) {
												$modal_gallery .= '<div class="nchgrid-caption-text">' . $content_images_titles[$i] . '</div>';
											}
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div>';
								$modal_gallery .= '</div>';
								if (!empty($content_images_titles[$i])) {
									$modal_gallery .= '<div class="st-title">' . $content_images_titles[$i] . '</div>';
								} else {
									$modal_gallery .= '<div class="st-title"></div>';
								}
							$modal_gallery .= '</li>';
						}
					}
				$modal_gallery .= '</ul>';
				$modal_gallery .= '<script type="text/javascript">';
					$modal_gallery .= 'jQuery(window).load(function(){';
						if ($lightbox_pageload == "true") {
							$modal_gallery .= 'jQuery(".' . $nacho_group . '").nchlightbox("open");';
						}
					$modal_gallery .= '});';
				$modal_gallery .= '</script>';
			}
			
			$output .= '<div id="' . $modal_id . '-frame" class="' . $css_class . ' ' . (($fullwidth == "true" && $fullwidth_allow == "true") ? "ts-lightbox-nacho-full-frame" : "") . '" data-style="' . $content_style . '" data-break-parents="' . $breakouts . '" data-inline="' . $frontend_edit . '" style="margin-top: '  . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; position: relative;">';
				if (!empty($content_title)) {
					$output .= '<div id="' . $nacho_group . '-title" class="ts-lightbox-nacho-title">' . $content_title. '</div>';
				}
				if (!empty($content)) {
					$output .= '<div id="' . $nacho_group . '-info" class="ts-lightbox-nacho-info nch-hide-if-javascript">';
						if (function_exists('wpb_js_remove_wpautop')){
							$output .= wpb_js_remove_wpautop(do_shortcode($content), true);
						} else {
							$output .= do_shortcode($content);
						}
					$output .= '</div>';
				}
				$output .= $modal_gallery;
			$output .= '</div>';
	
			echo $output;
		
			$myvariable = ob_get_clean();
			return $myvariable;
		}
		
		// Add Lightbox Gallery Elements
        function TS_VCSC_Add_Lightbox_Gallery_Elements() {
			global $VISUAL_COMPOSER_EXTENSIONS;
			if (function_exists('vc_map')) {
				vc_map( array(
					"name"                          => __( "TS Lightbox Gallery", "ts_visual_composer_extend" ),
					"base"                          => "TS_VCSC_Lightbox_Gallery",
					"icon" 	                        => "icon-wpb-ts_vcsc_lightbox_gallery",
					"class"                         => "ts_vcsc_main_lightbox_gallery",
					"category"                      => __( 'VC Extensions', "ts_visual_composer_extend" ),
					"description"                   => __("Place multiple images in a lightbox gallery", "ts_visual_composer_extend"),
					"admin_enqueue_js"              => "",
					"admin_enqueue_css"             => "",
					"params"                        => array(
						// Gallery Content
						array(
							"type"                  => "seperator",
							"heading"               => __( "", "ts_visual_composer_extend" ),
							"param_name"            => "seperator_1",
							"value"					=> "",
							"seperator"				=> "Gallery Content",
							"description"           => __( "", "ts_visual_composer_extend" )
						),
						array(
							"type"                  => "attach_images",
							"heading"               => __( "Select Images", "ts_visual_composer_extend" ),
							"holder"				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "imagelist" : ""),
							"param_name"            => "content_images",
							"value"                 => "",
							"admin_label"           => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
							"description"           => __( "Select the images for your gallery overlay; move images to arrange order in which to display.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_type", 'value' => 'gallery' )
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Preview Image Source", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_size",
							"width"                 => 150,
							"value"                 => array(
								__( 'Medium Size Image', "ts_visual_composer_extend" )		=> "medium",
								__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
								__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
							),
							"admin_label"           => true,
							"description"           => __( "Select which image size based on WordPress settings should be used for the preview image.", "ts_visual_composer_extend" ),
							"dependency"            => ""
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Lightbox Image Source", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_size",
							"width"                 => 150,
							"value"                 => array(
								__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
								__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
								__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
							),
							"admin_label"           => true,
							"description"           => __( "Select which image size based on WordPress settings should be used for the lightbox image.", "ts_visual_composer_extend" ),
							"dependency"            => ""
						),
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "Image Titles", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_titles",
							"value"                 => "",
							"description"           => __( "Enter titles for images; seperate individual images by line break; use an empty line for image without title.", "ts_visual_composer_extend" ),
							"dependency"            => ""
						),
						// Gallery Info
						array(
							"type"                  => "seperator",
							"heading"               => __( "", "ts_visual_composer_extend" ),
							"param_name"            => "seperator_2",
							"value"					=> "",
							"seperator"				=> "Info Settings",
							"description"           => __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Gallery Info",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Gallery Title", "ts_visual_composer_extend" ),
							"param_name"            => "content_title",
							"value"                 => "",
							"admin_label"           => true,
							"description"           => __( "Enter a title for the gallery itself; leave empty if you don't want to show a title.", "ts_visual_composer_extend" ),
							"group" 				=> "Gallery Info",
						),
						array(
							"type"		            => "textarea_html",
							"class"		            => "",
							"heading"               => __( "Gallery Description", "ts_visual_composer_extend" ),
							"param_name"            => "content",
							"value"                 => "",
							"admin_label"           => false,
							"description"           => __( "Create a detailed description / summary for the gallery.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Gallery Info",
						),
						// Display Settings
						array(
							"type"                  => "seperator",
							"heading"               => __( "", "ts_visual_composer_extend" ),
							"param_name"            => "seperator_3",
							"value"					=> "",
							"seperator"				=> "Layout Settings",
							"description"           => __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Display Style", "ts_visual_composer_extend" ),
							"param_name"            => "content_style",
							"width"                 => 150,
							"value"                 => array(
								__( 'Auto Grid of all Images', "ts_visual_composer_extend" )					=> "Grid",
								__( 'First Image Only', "ts_visual_composer_extend" )							=> "First",
								__( 'Single Custom Image', "ts_visual_composer_extend" )						=> "Image",
								__( 'Owl Image Slider', "ts_visual_composer_extend" )							=> "Slider",
								__( 'Flex Image Slider (With Thumbnails)', "ts_visual_composer_extend" )		=> "FlexThumb",
								__( 'Flex Image Slider (No Thumbnails)', "ts_visual_composer_extend" )			=> "FlexSingle",
								__( 'NivoSlider', "ts_visual_composer_extend" )									=> "NivoSlider",
								__( 'SliceBox Slider', "ts_visual_composer_extend" )							=> "SliceBox",
								__( 'Image Stack', "ts_visual_composer_extend" )								=> "Stack",
							),
							"admin_label"           => true,
							"description"           => __( "Select how the lightbox should be previewed on your page.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Layout"
						),						
						array(
							"type"              	=> "switch",
							"heading"               => __( "Apply Grayscale Effect", "ts_visual_composer_extend" ),
							"param_name"            => "trigger_grayscale",
							"value"                 => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"           => __( "Switch the toggle if you want to apply a grayscale effect to the trigger image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('First', 'Image') ),
							"group" 				=> "Layout"
						),						
						array(
							"type"              	=> "switch",
							"heading"               => __( "Make Gallery Full-Width", "ts_visual_composer_extend" ),
							"param_name"            => "fullwidth",
							"value"                 => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"           => __( "Switch the toggle if you want to attempt showing the gallery in full width (will not work with all themes).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Slider', 'FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Full Gallery Breakouts", "ts_visual_composer_extend" ),
							"param_name"            => "breakouts",
							"value"                 => "6",
							"min"                   => "0",
							"max"                   => "99",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the number of parent containers the gallery should attempt to break away from.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "fullwidth", 'value' => 'true' ),
							"group" 				=> "Layout"
						),						
						// Image Settings
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Select Image", "ts_visual_composer_extend" ),
							"param_name"            => "content_trigger_image",
							"value"                 => "",
							"description"           => __( "Select the trigger image for lightbox gallery.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Image' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Enter TITLE Attribute", "ts_visual_composer_extend" ),
							"param_name"            => "content_trigger_title",
							"value"                 => "",
							"description"           => __( "Enter a title for the image that triggers the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Image' ),
							"group" 				=> "Layout"
						),
						// Grid Settings
						array(
							"type"                  => "textfield",
							"heading"               => __( "Grid Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "data_grid_breaks",
							"value"                 => "240,480,720,960",
							"description"           => __( "Define the break points (columns) for the grid based on available screen size; seperate by comma.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Grid' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Grid Space", "ts_visual_composer_extend" ),
							"param_name"            => "data_grid_space",
							"value"                 => "2",
							"min"                   => "0",
							"max"                   => "20",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the space between images in grid.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Grid' ),
							"group" 				=> "Layout"
						),
						array(
							"type"              	=> "switch",
							"heading"			    => __( "Maintain Image Order", "ts_visual_composer_extend" ),
							"param_name"		    => "data_grid_order",
							"value"				    => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"		    => __( "Switch the toggle to keep original image order in grid; it is adviced to have the plugin determine order for best layout.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Grid' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"              	=> "switch",
							"heading"			    => __( "Shuffle Images", "ts_visual_composer_extend" ),
							"param_name"		    => "data_grid_shuffle",
							"value"				    => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"		    => __( "Switch the toggle to randomly shuffle the image order if possible.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "data_grid_order", 'value' => 'false' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Grid Limit", "ts_visual_composer_extend" ),
							"param_name"            => "data_grid_limit",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "50",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the number of images to be included in the grid; set to '0' (Zero) to include all images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Grid' ),
							"group" 				=> "Layout"
						),
						// Slider Settings
						array(
							"type"					=> "css3animations",
							"class"					=> "",
							"heading"				=> __("In-Animation Type", "ts_visual_composer_extend"),
							"param_name"			=> "animation_in",
							"standard"				=> "false",
							"prefix"				=> "ts-viewport-css-",
							"connector"				=> "css3animations_in",
							"default"				=> "flipInX",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the CSS3 in-animation you want to apply to the slider.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
                            "group" 			    => "Layout"
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "In-Animation Type", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_in",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __( "", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
                            "group"					=> "Layout"
						),						
						array(
							"type"					=> "css3animations",
							"class"					=> "",
							"heading"				=> __("Out-Animation Type", "ts_visual_composer_extend"),
							"param_name"			=> "animation_out",
							"standard"				=> "false",
							"prefix"				=> "ts-viewport-css-",
							"connector"				=> "css3animations_out",
							"default"				=> "slideOutDown",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the CSS3 out-animation you want to apply to the slider.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
                            "group"					=> "Layout"
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "Out-Animation Type", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_out",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __( "", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
                            "group"					=> "Layout"
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Animation Type", "ts_visual_composer_extend" ),
							"param_name"            => "flex_animation",
							"width"                 => 150,
							"value"                 => array(
								__( 'Slide', "ts_visual_composer_extend" )				=> "slide",
								__( 'Fade', "ts_visual_composer_extend" )				=> "fade",
							),
							"description"           => __( "Select how the Flexslider should animate between the slides. A 'Fade' transition will set the slider to one item per slide.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),						
                        array(
                            "type"					=> "switch",
                            "heading"				=> __( "Animate on Mobile", "ts_visual_composer_extend" ),
                            "param_name"			=> "animation_mobile",
                            "value"					=> "false",
                            "on"					=> __( 'Yes', "ts_visual_composer_extend" ),
                            "off"					=> __( 'No', "ts_visual_composer_extend" ),
                            "style"					=> "select",
                            "design"				=> "toggle-light",
                            "description"			=> __( "Switch the toggle if you want to show the CSS3 animations on mobile devices.", "ts_visual_composer_extend" ),
                            "dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
                            "group"					=> "Layout"
                        ),
						array(
							"type"					=> "switch",
							"heading"				=> __( "Auto-Height", "ts_visual_composer_extend" ),
							"param_name"			=> "auto_height",
							"value"					=> "true",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"			=> __( "Switch the toggle if you want the slider to auto-adjust its height.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch",
							"heading"				=> __( "RTL Page", "ts_visual_composer_extend" ),
							"param_name"			=> "page_rtl",
							"value"					=> "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"			=> __( "Switch the toggle if the slider is used on a page with RTL (Right-To-Left) alignment.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "textfield",
							"heading"               => __( "Grid Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "flex_breaks_thumbs",
							"value"                 => "200,400,600,800,1000,1200,1400,1600,1800",
							"description"           => __( "Define the break points (to determine item count per slide) for the slider based on available screen size; seperate by comma.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexThumb' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Grid Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "flex_breaks_single",
							"value"                 => "240,480,720,960,1280,1600,1980",
							"description"           => __( "Define the break points (to determine item count per slide) for the slider based on available screen size; seperate by comma.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexSingle' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Max. Number of Images", "ts_visual_composer_extend" ),
							"param_name"			=> "number_images",
							"value"					=> "1",
							"min"					=> "1",
							"max"					=> "10",
							"step"					=> "1",
							"unit"					=> '',
							"description"			=> __( "Define the maximum number of images per slide.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexSingle') ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Image Spacing", "ts_visual_composer_extend" ),
							"param_name"			=> "flex_margin",
							"value"					=> "0",
							"min"					=> "0",
							"max"					=> "10",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the spacing between the images in the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"              	=> "switch",
							"heading"				=> __( "Auto-Play", "ts_visual_composer_extend" ),
							"param_name"			=> "auto_play",
							"value"					=> "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"admin_label"           => true,
							"description"			=> __( "Switch the toggle if you want the auto-play the slider on page load.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexThumb', 'FlexSingle', 'SliceBox', 'NivoSlider') ),
							"group" 				=> "Layout"
						),
                        array(
                            "type"					=> "switch",
                            "heading"				=> __( "Show Play / Pause", "ts_visual_composer_extend" ),
                            "param_name"			=> "show_playpause",
                            "value"					=> "true",
                            "on"					=> __( 'Yes', "ts_visual_composer_extend" ),
                            "off"					=> __( 'No', "ts_visual_composer_extend" ),
                            "style"					=> "select",
                            "design"				=> "toggle-light",
                            "description"			=> __( "Switch the toggle if you want to show a play / pause button to control the autoplay.", "ts_visual_composer_extend" ),
                            "dependency" 			=> array("element" 	=> "auto_play", "value" => "true"),
                        ),
						array(
							"type"					=> "switch",
							"heading"				=> __( "Show Progressbar", "ts_visual_composer_extend" ),
							"param_name"			=> "show_bar",
							"value"					=> "true",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"			=> __( "Switch the toggle if you want to show a progressbar during auto-play.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "auto_play", 'value' => 'true' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "colorpicker",
							"heading"				=> __( "Progressbar Color", "ts_visual_composer_extend" ),
							"param_name"			=> "bar_color",
							"value"					=> "#dd3333",
							"description"			=> __( "Define the color of the animated progressbar.", "ts_visual_composer_extend" ),
							"dependency"			=> array("element" 	=> "show_bar", "value" => "true"),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Auto-Play Speed", "ts_visual_composer_extend" ),
							"param_name"			=> "show_speed",
							"value"					=> "5000",
							"min"					=> "1000",
							"max"					=> "20000",
							"step"					=> "100",
							"unit"					=> 'ms',
							"description"			=> __( "Define the speed used to auto-play the slider.", "ts_visual_composer_extend" ),
							"dependency"			=> array("element" 	=> "auto_play", "value" => "true"),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch",
							"heading"				=> __( "Stop on Hover", "ts_visual_composer_extend" ),
							"param_name"			=> "stop_hover",
							"value"					=> "true",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"			=> __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "auto_play", 'value' => 'true' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch",
							"heading"				=> __( "Show Top Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "show_navigation",
							"value"					=> "true",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"			=> __( "Switch the toggle if you want to show a left/right navigation buttons for the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch",
							"heading"				=> __( "Show Dot Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "dot_navigation",
							"value"					=> "true",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"			=> __( "Switch the toggle if you want to show dot navigation buttons below the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexThumb', 'FlexSingle', 'NivoSlider', 'SliceBox') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Border Width", "ts_visual_composer_extend" ),
							"param_name"            => "flex_border_width",
							"value"                 => "5",
							"min"                   => "0",
							"max"                   => "20",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the border width around the slider; set to 0 (zero) to remove border.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "colorpicker",
							"heading"               => __( "Border Color", "ts_visual_composer_extend" ),
							"param_name"            => "flex_border_color",
							"value"                 => "#ffffff",
							"description"           => __( "Define the color for the border around the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "colorpicker",
							"heading"               => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"            => "flex_background",
							"value"                 => "#ffffff",
							"description"           => __( "Define the background color for the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						// Filter Settings
						array(
							"type"                  => "seperator",
							"heading"               => __( "", "ts_visual_composer_extend" ),
							"param_name"            => "seperator_4",
							"value"					=> "",
							"seperator"				=> "Filter Settings",
							"description"           => __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Filter",
						),
						array(
							"type"              	=> "messenger",
							"heading"           	=> __( "", "ts_visual_composer_extend" ),
							"param_name"        	=> "messenger",
							"color"					=> "#AD0000",
							"weight"				=> "normal",
							"size"					=> "14",
							"value"					=> "",
							"message"            	=> __( "The following filter settings apply only if the gallery is set to 'Auto Grid' layout.", "ts_visual_composer_extend" ),
							"description"       	=> __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Filter"
						),
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "Image Groups", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_groups",
							"value"                 => "",
							"description"           => __( "Enter groups or categories for images; seperate multiple groups for one image with '/' and individual images by line break; use an empty line for image without group.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Filter Toggle: Text", "ts_visual_composer_extend" ),
							"param_name"            => "filters_toggle",
							"value"                 => "Toggle Filter",
							"description"           => __( "Enter a text to be used for the filter button.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Filter Toggle: Style", "ts_visual_composer_extend" ),
							"param_name"            => "filters_toggle_style",
							"width"                 => 150,
							"value"                 => array(
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
							"description"           => __( "Select the color scheme for the filter button.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),						
						array(
							"type"                  => "textfield",
							"heading"               => __( "Show All Toggle: Text", "ts_visual_composer_extend" ),
							"param_name"            => "filters_showall",
							"value"                 => "Show All",
							"description"           => __( "Enter a text to be used for the show all button.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Show All Toggle: Style", "ts_visual_composer_extend" ),
							"param_name"            => "filters_showall_style",
							"width"                 => 150,
							"value"                 => array(
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
							"description"           => __( "Select the color scheme for the show all button.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),	
						array(
							"type"                  => "textfield",
							"heading"               => __( "Text: Available Groups", "ts_visual_composer_extend" ),
							"param_name"            => "filters_available",
							"value"                 => "Available Groups",
							"description"           => __( "Enter a text to be used a header for the section with the available groups.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Text: Selected Groups", "ts_visual_composer_extend" ),
							"param_name"            => "filters_selected",
							"value"                 => "Filtered Groups",
							"description"           => __( "Enter a text to be used a header for the section with the selected groups.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Text: Ungrouped Images", "ts_visual_composer_extend" ),
							"param_name"            => "filters_nogroups",
							"value"                 => "No Groups",
							"description"           => __( "Enter a text to be used to group images without any other groups applied to it.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Filter",
						),						
						// Lightbox Settings
						array(
							"type"                  => "seperator",
							"heading"               => __( "", "ts_visual_composer_extend" ),
							"param_name"            => "seperator_5",
							"value"					=> "",
							"seperator"				=> "Lightbox Settings",
							"description"           => __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch",
							"heading"			    => __( "Open on Pageload", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_pageload",
							"value"				    => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"		    => __( "Switch the toggle if you want automatically open the lightbox gallery on page load.", "ts_visual_composer_extend" ),
							"dependency"        	=> "",
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Thumbnail Position", "ts_visual_composer_extend" ),
							"param_name"            => "thumbnail_position",
							"width"                 => 150,
							"value"                 => array(
								__( 'Bottom', "ts_visual_composer_extend" )       => "bottom",
								__( 'Top', "ts_visual_composer_extend" )          => "top",
								__( 'Left', "ts_visual_composer_extend" )         => "left",
								__( 'Right', "ts_visual_composer_extend" )        => "right",
								__( 'None', "ts_visual_composer_extend" )         => "0",
							),
							"admin_label"           => true,
							"description"           => __( "Select the position of the thumbnails in the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Thumbnail Height", "ts_visual_composer_extend" ),
							"param_name"            => "thumbnail_height",
							"value"                 => "100",
							"min"                   => "50",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the height of the thumbnails in the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "thumbnail_position", 'value' => array('bottom', 'top', 'left', 'right') ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Transition Effect", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_effect",
							"width"                 => 150,
							"value"                 => array(
								__( 'Random', "ts_visual_composer_extend" )       	=> "random",
								__( 'Swipe', "ts_visual_composer_extend" )        	=> "swipe",
								__( 'Fade & Swipe', "ts_visual_composer_extend" )	=> "fade",
								__( 'Scale', "ts_visual_composer_extend" )        	=> "scale",
								__( 'Slide Up', "ts_visual_composer_extend" )     	=> "slideUp",
								__( 'Slide Down', "ts_visual_composer_extend" )   	=> "slideDown",
								__( 'Flip', "ts_visual_composer_extend" )         	=> "flip",
								__( 'Skew', "ts_visual_composer_extend" )         	=> "skew",
								__( 'Bounce Up', "ts_visual_composer_extend" )    	=> "bounceUp",
								__( 'Bounce Down', "ts_visual_composer_extend" )  	=> "bounceDown",
								__( 'Break In', "ts_visual_composer_extend" )     	=> "breakIn",
								__( 'Rotate In', "ts_visual_composer_extend" )    	=> "rotateIn",
								__( 'Rotate Out', "ts_visual_composer_extend" )   	=> "rotateOut",
								__( 'Hang Left', "ts_visual_composer_extend" )    	=> "hangLeft",
								__( 'Hang Right', "ts_visual_composer_extend" )   	=> "hangRight",
								__( 'Cycle Up', "ts_visual_composer_extend" )     	=> "cicleUp",
								__( 'Cycle Down', "ts_visual_composer_extend" )   	=> "cicleDown",
								__( 'Zoom In', "ts_visual_composer_extend" )      	=> "zoomIn",
								__( 'Throw In', "ts_visual_composer_extend" )     	=> "throwIn",
								__( 'Fall', "ts_visual_composer_extend" )         	=> "fall",
								__( 'Jump', "ts_visual_composer_extend" )         	=> "jump",
							),
							"admin_label"           => true,
							"description"           => __( "Select the transition effect to be used for each image in the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch",
							"heading"			    => __( "Autoplay Option", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_autooption",
							"value"				    => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"		    => __( "Switch the toggle if you want to provide an autoplay option for the lightbox.", "ts_visual_composer_extend" ),
							"dependency"        	=> "",
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch",
							"heading"			    => __( "Start Autoplay", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_autoplay",
							"value"				    => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"		    => __( "Switch the toggle if you want to automatically start the autoplay once the lightbox is opened the first time.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "lightbox_autooption", 'value' => 'true' ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Autoplay Speed", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_speed",
							"value"                 => "5000",
							"min"                   => "1000",
							"max"                   => "20000",
							"step"                  => "100",
							"unit"                  => 'ms',
							"description"           => __( "Define the speed at which autoplay should rotate between images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "lightbox_autooption", 'value' => 'true' ),
							"group" 				=> "Lightbox",
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Backlight Effect", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_backlight",
							"width"                 => 150,
							"value"                 => array(
								__( 'Auto Color', "ts_visual_composer_extend" )       											=> "auto",
								__( 'Custom Color', "ts_visual_composer_extend" )     											=> "custom",
								__( 'No Backlight (only for simple Black Lightbox Overlay)', "ts_visual_composer_extend" )     	=> "hideit",
							),
							"admin_label"           => true,
							"description"           => __( "Select the backlight effect for the gallery images.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "colorpicker",
							"heading"               => __( "Custom Backlight Color", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_backlight_color",
							"value"                 => "#ffffff",
							"description"           => __( "Define the backlight color for the gallery images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "lightbox_backlight", 'value' => 'custom' ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch",
							"heading"			    => __( "Social Share Buttons", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_social",
							"value"				    => "true",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"		    => __( "Switch the toggle if you want show social share buttons with deeplinking for each image.", "ts_visual_composer_extend" ),
							"dependency"        	=> "",
							"group" 				=> "Lightbox",
						),
						// Tooltip Settings
						array(
							"type"                  => "seperator",
							"heading"               => __( "", "ts_visual_composer_extend" ),
							"param_name"            => "seperator_6",
							"value"					=> "",
							"seperator"				=> "Tooltip Settings",
							"description"           => __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip",
						),
						array(
							"type"              	=> "messenger",
							"heading"           	=> __( "", "ts_visual_composer_extend" ),
							"param_name"        	=> "messenger",
							"color"					=> "#AD0000",
							"weight"				=> "normal",
							"size"					=> "14",
							"value"					=> "",
							"message"            	=> __( "The following tooltip settings apply only if the gallery can utilize tooltips.", "ts_visual_composer_extend" ),
							"description"       	=> __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"              	=> "switch",
							"heading"			    => __( "Thumbnail Tooltip", "ts_visual_composer_extend" ),
							"param_name"		    => "flex_tooltipthumbs",
							"value"				    => "false",
							"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
							"off"					=> __( 'No', "ts_visual_composer_extend" ),
							"style"					=> "select",
							"design"				=> "toggle-light",
							"description"		    => __( "Switch the toggle if you want show a title tooltip with the thumbnail images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexThumb' ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Navigation Dots Tooltip", "ts_visual_composer_extend" ),
							"param_name"            => "slice_tooltipthumbs",
							"width"                 => 150,
							"value"                 => array(
								__( 'None', "ts_visual_composer_extend" )					=> "none",
								__( 'Image Title', "ts_visual_composer_extend" )			=> "title",
								__( 'Image Thumbnail', "ts_visual_composer_extend" )		=> "image",
							),
							"description"           => __( "Select which kind of tooltip should be assigned to the navigation dots.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "dot_navigation", 'value' => 'true' ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"				    => "dropdown",
							"class"				    => "",
							"heading"			    => __( "Tooltip Position", "ts_visual_composer_extend" ),
							"param_name"		    => "tooltipster_position",
							"value"                 => array(
								__("Top", "ts_visual_composer_extend")                    	=> "ts-simptip-position-top",
								__("Bottom", "ts_visual_composer_extend")                 	=> "ts-simptip-position-bottom",
								//__("Left", "ts_visual_composer_extend")                   => "ts-simptip-position-left",
								//__("Right", "ts_visual_composer_extend")                 	=> "ts-simptip-position-right",
							),
							"description"		    => __( "Select the tooltip position in relation to the trigger.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Tooltip"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Tooltip X-Offset", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltipster_offsetx",
							"value"					=> "0",
							"min"					=> "-100",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define an optional X-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Tooltip"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Tooltip Y-Offset", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltipster_offsety",
							"value"					=> "0",
							"min"					=> "-100",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define an optional Y-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"dependency"            => "",
							"group" 				=> "Tooltip"
						),
						// Other Settings
						array(
							"type"                  => "seperator",
							"heading"               => __( "", "ts_visual_composer_extend" ),
							"param_name"            => "seperator_7",
							"value"					=> "",
							"seperator"				=> "Other Settings",
							"description"           => __( "", "ts_visual_composer_extend" ),
							"group" 				=> "Other",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"            => "margin_top",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
							"group" 				=> "Other",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Margin: Bottom", "ts_visual_composer_extend" ),
							"param_name"            => "margin_bottom",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
							"group" 				=> "Other",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Define ID Name", "ts_visual_composer_extend" ),
							"param_name"            => "el_id",
							"value"                 => "",
							"description"           => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
							"group" 				=> "Other",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Extra Class Name", "ts_visual_composer_extend" ),
							"param_name"            => "el_class",
							"value"                 => "",
							"description"           => __( "Enter a class name for the element.", "ts_visual_composer_extend" ),
							"group" 				=> "Other",
						),
						// Load Custom CSS/JS File
                        array(
                            "type"					=> "load_file",
                            "heading"				=> __( "", "ts_visual_composer_extend" ),
                            "param_name"			=> "el_file1",
                            "value"					=> "",
                            "file_type"				=> "js",
							"file_id"				=> "ts-extend-element",
                            "file_path"				=> "js/ts-visual-composer-extend-element.min.js",
                            "description"			=> __( "", "ts_visual_composer_extend" )
                        ),
						array(
							"type"					=> "load_file",
							"heading"				=> __( "", "ts_visual_composer_extend" ),
							"param_name"			=> "el_file2",
							"value"					=> "Animation Files",
							"file_type"				=> "css",
							"file_id"				=> "ts-extend-animations",
							"file_path"				=> "css/ts-visual-composer-extend-animations.min.css",
							"description"			=> __( "", "ts_visual_composer_extend" )
						),
					))
				);
			}
		}
	}
}
// Register Container and Child Shortcode with Visual Composer
if (!class_exists('WPBakeryShortCode')) {
	//require_once "{PATH_TO_JS_COMPOSER}/include/classes/shortcodes/shortcodes.php";
}
if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_TS_VCSC_Lightbox_Gallery extends WPBakeryShortCode {
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

            if (isset($param['holder']) === true && in_array($param['holder'], array('div', 'span', 'p', 'pre', 'code'))) {
                $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
            } else if (isset($param['holder']) === true && $param['holder'] == 'input') {
                $output .= '<'.$param['holder'].' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'">';
            } else if (isset($param['holder']) === true && in_array($param['holder'], array('img', 'iframe'))) {
				if (!empty($value)) {
					$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="'.$value.'">';
				}
			} else if (isset($param['holder']) === true && $param['holder'] == 'imagelist') {
				$images_ids = empty($value) ? array() : explode(',', trim($value));
				$output .= '<ul style="margin-top: 5px;" class="attachment-thumbnails'.(empty($images_ids) ? ' image-exists' : '' ).'" data-name="' . $param_name . '">';
					foreach($images_ids as $image) {
						$img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ));
						$output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
					}
				$output .= '</ul>';
				$output .= '<a style="max-width: 100%; display: block;" href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '" style="margin-bottom: 10px;">' . __( 'Add or Remove Image(s)', "ts_visual_composer_extend" ) . '</a>';
            }
			
            if (isset($param['admin_label']) && $param['admin_label'] === true) {
                $output .= '<span style="max-width: 100%; display: block;" class="vc_admin_label admin_label_'.$param['param_name'].(empty($value) ? ' hidden-label' : '').'"><label>'. $param['heading'] . '</label>: '.$value.'</span>';
            }

			return $output;
		}
	}
}
// Initialize "TS Teaser Blocks" Class
if (class_exists('TS_Lightbox_Galleries')) {
	$TS_Lightbox_Galleries = new TS_Lightbox_Galleries;
}
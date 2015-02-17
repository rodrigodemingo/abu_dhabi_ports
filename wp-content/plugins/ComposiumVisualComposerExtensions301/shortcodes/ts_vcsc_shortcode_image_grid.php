<?php
	add_shortcode('TS_VCSC_Image_Link_Grid', 'TS_VCSC_Image_Link_Grid_Function');
	function TS_VCSC_Image_Link_Grid_Function ($atts) {
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
			'content_images'			=> '',
			'content_images_titles'		=> '',
			'content_images_links'		=> '',
			'content_images_groups'		=> '',
			'content_images_size'		=> 'medium',
			
			'filters_available'			=> 'Available Groups',
			'filters_selected'			=> 'Filtered Groups',
			'filters_nogroups'			=> 'No Groups',
			'filters_toggle'			=> 'Toggle Filter',
			'filters_toggle_style'		=> '',
			'filters_showall'			=> 'Show All',
			'filters_showall_style'		=> '',
		
			'data_grid_invalid'			=> 'exclude',
			'data_grid_target'			=> '_blank',
			'data_grid_breaks'			=> '240,480,720,960',
			'data_grid_space'			=> 2,
			'data_grid_order'			=> 'false',
			'data_grid_always'			=> 'true',
			
			'fullwidth'					=> 'false',
			'breakouts'					=> 6,
			
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id'						=> '',
			'el_class'					=> '',
			'css'						=> '',
		), $atts ));
		
		$output 						= '';
		
		// Check for Front End Editor
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
			$grid_class					= 'ts-image-link-grid-edit';
			$grid_message				= '<div class="ts-composer-frontedit-message">' . __( 'The grid is currently viewed in front-end edit mode; grid and filter features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
			$image_style				= 'width: 20%; height: 100%; display: inline-block; margin: 0; padding: 0;';
			$grid_style					= 'height: 100%;';
			$frontend_edit				= 'true';
		} else {
			$grid_class					= 'ts-image-link-grid';
			$image_style				= '';
			$grid_style					= '';
			$grid_message				= '';
			$frontend_edit				= 'false';
		}
		
		$randomizer						= mt_rand(999999, 9999999);
	
		if (!empty($el_id)) {
			$modal_id					= $el_id;
		} else {
			$modal_id					= 'ts-vcsc-image-link-grid-' . $randomizer;
		}
			
		// Content: Gallery
		$modal_gallery					= '';
		if (!empty($content_images)) {
			$count_images 				= substr_count($content_images, ",") + 1;
		} else {
			$count_images				= 0;
		}
		$valid_images 					= 0;
		if (!empty($data_grid_breaks)) {
			$data_grid_breaks 			= str_replace(' ', '', $data_grid_breaks);
			$count_columns				= substr_count($data_grid_breaks, ",") + 1;
		} else {
			$count_columns				= 0;
		}
		$content_images 				= explode(',', $content_images);
		$content_images_titles			= explode(',', $content_images_titles);
		$content_images_links			= explode(',', $content_images_links);
		$content_images_groups			= explode(',', $content_images_groups);
		$i 								= -1;
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
		$nachoLength 					= count($content_images) - 1;
		$nacho_info						= '';
		$nacho_color					= '';
		
		if ($content_images_groups != '') {
			if ($filters_toggle_style != '') {
				wp_enqueue_style('ts-extend-buttonsflat');
			}
			wp_enqueue_style('ts-extend-multiselect');
			wp_enqueue_script('ts-extend-multiselect');
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-image-link-grid-frame ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Image_Link_Grid', $atts);
		} else {
			$css_class 	= 'ts-image-link-grid-frame ' . $el_class;
		}
		
		$fullwidth_allow			= "true";
		// Front-Edit Message
		if ($frontend_edit == "true") {
			$modal_gallery .= $grid_message;
			foreach ($content_images as $single_image) {
				$i++;
				$grid_image				= wp_get_attachment_image_src($single_image, $content_images_size);
				if ((!empty($content_images_links[$i])) || ($data_grid_invalid != "exclude")) {
					$valid_images++;
					$modal_gallery .= '<a style="' . $image_style . '" href="' . (!empty($content_images_links[$i]) ? $content_images_links[$i] : "#") . '" target="_blank" title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '">';
						$modal_gallery .= '<img id="ts-image-link-picture-' . $randomizer . '-' . $i .'" class="ts-image-link-picture" src="' . $grid_image[0] . '" data-include="true" style="width: 100%; height: auto;">';
					$modal_gallery .= '</a>';
				}
			}
		} else {
			foreach ($content_images as $single_image) {
				$i++;
				$grid_image				= wp_get_attachment_image_src($single_image, $content_images_size);
				$modal_image			= wp_get_attachment_image_src($single_image, 'full');
				if ((!empty($content_images_links[$i])) || ($data_grid_invalid != "exclude")) {
					$valid_images++;
					$modal_gallery .= '<img id="ts-image-link-picture-' . $randomizer . '-' . $i .'" class="ts-image-link-picture" src="' . $grid_image[0] . '" rel="link-group-' . $randomizer . '" data-include="true" data-image="' . (($data_grid_invalid == "lightbox") ? $modal_image[0] : '') . '" width="' . $grid_image[1] . '" height="' . $grid_image[2] . '" title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" data-groups="' . (!empty($content_images_groups[$i]) ? (str_replace('/', ',', $content_images_groups[$i])) : "") . '" data-target="' . $data_grid_target . '" data-link="' . (!empty($content_images_links[$i]) ? $content_images_links[$i] : "") . '">';
				}
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
?>
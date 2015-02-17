<?php
	add_shortcode('TS-VCSC-Image-Switch', 'TS_VCSC_Image_Switch_Function');
	function TS_VCSC_Image_Switch_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-simptip');
			wp_enqueue_style('ts-extend-animations');
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
		
		extract( shortcode_atts( array(
			'image_start'					=> '',
			'image_end'						=> '',
			'image_responsive'				=> 'true',
			'image_height'					=> 'height: 100%;',
			'image_width_percent'			=> 100,
			'image_width'					=> 300,
			//'image_height'				=> 200,
			'image_position'				=> 'ts-imagefloat-center',
			'attribute_alt_start'			=> 'false',
			'attribute_alt_value_start'		=> '',
			'attribute_alt_end'				=> 'false',
			'attribute_alt_value_end'		=> '',
			'switch_type'					=> 'ts-imageswitch-flip',
			'switch_trigger_flip'			=> 'ts-trigger-click',
			'switch_trigger_fade'			=> 'ts-trigger-hover',
			'switch_handle_show'			=> 'true',
			'switch_handle_center'			=> 'true',
			'switch_handle_color'			=> '#0094FF',			
			'switch_click'					=> 'true',
			'switch_link'					=> '',
			
			'switch_overlay'				=> '',
			'overlay_remove'				=> 'false',
			'overlay_text'					=> '',
			'overlay_color'					=> '#ffffff',
			'overlay_image'					=> '',
			
			'tooltip_css'					=> 'false',
			'tooltip_content'				=> '',
			'tooltip_position'				=> 'ts-simptip-position-top',
			'tooltip_style'					=> '',
			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id' 						=> '',
			'el_class'                  	=> '',
			'css'							=> '',
		), $atts ));
	
		$switch_image_start 				= wp_get_attachment_image_src($image_start, 'full');
		$switch_image_end 					= wp_get_attachment_image_src($image_end, 'full');		
		
		$switch_margin 						= 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
		
		$randomizer							= mt_rand(999999, 9999999);
		
		$output 							= "";
		
		if (!empty($el_id)) {
			$switch_image_id				= $el_id;
		} else {
			$switch_image_id				= 'ts-vcsc-image-switch-' . $randomizer;
		}
	
		// Handle Adjust
		if ($switch_type == "ts-imageswitch-slide") {
			$switch_handle_adjust 			= "left: 50%;";
			$switch_image 					= "right: 50%;";
		} else {
			$switch_handle_adjust 			= "";
			$switch_image					= "";
		}
	
		// Tooltip
		if ($tooltip_css == "true") {
			if (strlen($tooltip_content) != 0) {
				$switch_tooltipclasses		= " ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
				$switch_tooltipcontent		= ' data-tstooltip="' . $tooltip_content . '"';
			} else {
				$switch_tooltipclasses		= "";
				$switch_tooltipcontent		= "";
			}
		} else {
			$switch_tooltipclasses			= "";
			if (strlen($tooltip_content) != 0) {
				$switch_tooltipcontent		= ' title="' . $tooltip_content . '"';
			} else {
				$switch_tooltipcontent		= "";
			}
		}
		
		// Handle Padding
		if ($switch_handle_show == "true") {
			$switch_padding					= "padding-bottom: 25px;";
		} else {
			$switch_padding					= "";
		}
		
		// Trigger
		if ($switch_type == "ts-imageswitch-flip") {
			$switch_trigger 				= $switch_trigger_flip;
		} else if ($switch_type == "ts-imageswitch-slide") {
			$switch_trigger 				= "ts-trigger-slide";
		} else if ($switch_type == "ts-imageswitch-fade") {
			$switch_trigger 				= $switch_trigger_fade;
		}
		
		// Handle Icon
		if ($switch_trigger == "ts-trigger-click") {
			$switch_handle_icon				= 'handle_click';
		} else if ($switch_trigger == "ts-trigger-hover") {
			$switch_handle_icon				= 'handle_hover';
		} else if ($switch_trigger == "ts-trigger-slide") {
			$switch_handle_icon				= 'handle_slide';
		}
		
		$image_extension_start				= pathinfo($switch_image_start[0], PATHINFO_EXTENSION);
		$image_extension_end				= pathinfo($switch_image_end[0], PATHINFO_EXTENSION);
		
		if ($attribute_alt_start == "true") {
			$alt_attribute_start			= $attribute_alt_value_start;
		} else {
			$alt_attribute_start			= basename($switch_image_start[0], "." . $image_extension_start);
		}
		
		if ($attribute_alt_end == "true") {
			$alt_attribute_end				= $attribute_alt_value_end;
		} else {
			$alt_attribute_end				= basename($switch_image_end[0], "." . $image_extension_end);
		}
		
		// Link
		if (($switch_click == "false") && ($switch_link != '')){
			$link 							= ($switch_link == '||') ? '' : $switch_link;
			$link 							= vc_build_link($switch_link);
			$a_href							= $link['url'];
			$a_title 						= $link['title'];
			$a_target 						= $link['target'];
			$linkswitch_id					= $switch_image_id . "-link";
			$linkswitch_start				= '<a id="' . $linkswitch_id . '" class="ts-imageswitch-link" style="margin: 0; padding: 0;" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" data-random="' . $randomizer . '">';
			$linkswitch_end					= '</a>';
		} else {
			$linkswitch_id					= '';
			$linkswitch_start				= '';
			$linkswitch_end					= '';
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-imageswitch ' . $switch_type . ' ' . $switch_trigger . ' ' . $image_position . $switch_tooltipclasses . ' ts-imageswitch-before ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Image-Switch', $atts);
		} else {
			$css_class	= 'ts-imageswitch ' . $switch_type . ' ' . $switch_trigger . ' ' . $image_position . $switch_tooltipclasses . ' ts-imageswitch-before ' . $el_class;
		}
		
		if ($image_responsive == "true") {
			$output .= $linkswitch_start;
				$output .= '<div id="' . $switch_image_id . '" data-trigger="' . $switch_trigger . '" class="' . $css_class . '" ' . $switch_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; width: ' . $image_width_percent . '%;">';
					$output .= '<div id="' . $switch_image_id . '-counter" class="ts-switch-wrapper " style="width: ' . $image_width_percent . '%; ' . $image_height . '">';
						$output .= '<div style="' . $switch_padding . '" data-link="' . $linkswitch_id . '">';
							$output .= '<ol class="ts-imageswitch-items" style="padding: 0px;">';
								$output .= '<li class="ts-imageswitch__before ' . ($switch_type == "ts-imageswitch-fade" ? "active" : "") . '" style="' . $image_height . '">';
									$output .= '<img src="' . $switch_image_start[0] . '" alt="' . $alt_attribute_start . '" style="width: ' . $image_width_percent . '%; height: auto;" data-status="Before">';
								$output .= '</li>';
								$output .= '<li class="ts-imageswitch__after" style="' . $switch_handle_adjust . '" style="' . $image_height . '">';
									$output .= '<img src="' . $switch_image_end[0] . '" alt="' . $alt_attribute_end . '" style="width: ' . $image_width_percent . '%; height: auto;" data-status="After" style="' . $switch_image . '">';
								$output .= '</li>';
							$output .= '</ol>';
							if (($switch_overlay == "text") && ($overlay_text != '')) {
								$output .= '<div id="ts-imageswitch-overlay-' . $randomizer . '" class="ts-imageswitch-overlay" data-remove="' . $overlay_remove . '"><div class="ts-imageswitch-overlay-text" style="color: ' . $overlay_color . ';">' . $overlay_text . '</div></div>';
							} else if (($switch_overlay == "image") && ($overlay_image != '')) {
								$switch_image_overlay = wp_get_attachment_image_src($overlay_image, 'full');
								$output .= '<div id="ts-imageswitch-overlay-' . $randomizer . '" class="ts-imageswitch-overlay" data-remove="' . $overlay_remove . '"><img class="ts-imageswitch-overlay-image" src="' . $switch_image_overlay[0] . '"></div>';
							}
							if ($switch_handle_show == "true") {
								if ($switch_type == "ts-imageswitch-slide") {
									$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
								} else {
									$output .= '<div class="ts-imageswitch__handle" style="' . $switch_handle_adjust . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
								}
								$output .= '</div>';
							} else if ($switch_type == "ts-imageswitch-slide") {
								$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"></div>';
							}
						$output .= '</div>';
					$output .= '</div>';				
				$output .= '</div>';
			$output .= $linkswitch_end;
		} else {
			$output .= $linkswitch_start;
				$output .= '<div id="' . $switch_image_id . '" data-trigger="' . $switch_trigger . '" class="' . $css_class . '" ' . $switch_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; width: ' . $image_width . 'px;">';
					$output .= '<div id="' . $switch_image_id . '-counter" class="ts-switch-wrapper " style="width: ' . $image_width . 'px; ' . $image_height . '">';
						$output .= '<div style="' . $switch_padding . '" data-link="' . $linkswitch_id . '">';
							$output .= '<ol class="ts-imageswitch-items" style="padding: 0px;">';
								$output .= '<li class="ts-imageswitch__before ' . ($switch_type == "ts-imageswitch-fade" ? "active" : "") . '" style="' . $image_height . '">';
									$output .= '<img src="' . $switch_image_start[0] . '" alt="' . $alt_attribute_start . '" style="width: ' . $image_width . 'px; height: auto;" data-status="Before">';
								$output .= '</li>';
								$output .= '<li class="ts-imageswitch__after" style="' . $switch_handle_adjust . '" style="' . $image_height . '">';
									$output .= '<img src="' . $switch_image_end[0] . '" alt="' . $alt_attribute_end . '" style="width: ' . $image_width . 'px; height: auto;" data-status="After" style="' . $switch_image . '">';
								$output .= '</li>';
							$output .= '</ol>';
							if (($switch_overlay == "text") && ($overlay_text != '')) {
								$output .= '<div id="ts-imageswitch-overlay-' . $randomizer . '" class="ts-imageswitch-overlay" data-remove="' . $overlay_remove . '"><div class="ts-imageswitch-overlay-text" style="color: ' . $overlay_color . ';">' . $overlay_text . '</div></div>';
							} else if (($switch_overlay == "image") && ($overlay_image != '')) {
								$switch_image_overlay = wp_get_attachment_image_src($overlay_image, 'full');
								$output .= '<div id="ts-imageswitch-overlay-' . $randomizer . '" class="ts-imageswitch-overlay" data-remove="' . $overlay_remove . '"><img class="ts-imageswitch-overlay-image" src="' . $switch_image_overlay[0] . '"></div>';
							}
							if ($switch_handle_show == "true") {
								if ($switch_type == "ts-imageswitch-slide") {
									$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
								} else {
									$output .= '<div class="ts-imageswitch__handle" style="' . $switch_handle_adjust . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
								}
								$output .= '</div>';
							} else if ($switch_type == "ts-imageswitch-slide") {
								$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"></div>';
							}
						$output .= '</div>';
					$output .= '</div>';				
				$output .= '</div>';
			$output .= $linkswitch_end;
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
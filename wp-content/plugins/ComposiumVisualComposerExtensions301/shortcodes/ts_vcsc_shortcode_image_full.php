<?php
	add_shortcode('TS_VCSC_Image_Full', 'TS_VCSC_Image_Full_Function');
	function TS_VCSC_Image_Full_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-animations');
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
		
		extract( shortcode_atts( array(
			'image'						=> '',
			'attribute_alt'				=> 'false',
			'attribute_alt_value'		=> '',
			'break_parents'				=> 0,
			'zindex'					=> 0,
			
			'blur_strength'				=> '',
			'raster_use'				=> 'false',
			'raster_type'				=> '',
			
			'overlay_use'				=> 'false',
			'overlay_color'				=> 'rgba(30,115,190,0.25)',
			
			'svg_top_on'				=> 'false',
			'svg_top_style'				=> '1',
			'svg_top_height'			=> 100,
			'svg_top_flip'				=> 'false',
			'svg_top_position'			=> 0,
			'svg_top_color1'			=> '#ffffff',
			'svg_top_color2'			=> '#ededed',
			
			'svg_bottom_on'				=> 'false',
			'svg_bottom_style'			=> '1',
			'svg_bottom_height'			=> 100,
			'svg_bottom_flip'			=> 'false',
			'svg_bottom_position'		=> 0,
			'svg_bottom_color1'			=> '#ffffff',
			'svg_bottom_color2'			=> '#ededed',
			
			'movement_x_allow'			=> 'false',
			'movement_x_ratio'			=> 20,
			'movement_y_allow'			=> 'false',
			'movement_y_ratio'			=> 20,
			
			'margin_left'				=> 0,
			'margin_right'				=> 0,
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id' 					=> '',
			'el_class'                  => '',
			'css'						=> '',
		), $atts ));
		
		$randomizer						= mt_rand(999999, 9999999);
	
		// Check for Front End Editor
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
			$editor_frontend			= "true";
		} else {
			$editor_frontend			= "false";
		}
	
		$full_margin = 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
		
		$output = "";
		
		if (!empty($el_id)) {
			$full_image_id				= $el_id;
		} else {
			$full_image_id				= 'ts-vcsc-image-full-' . $randomizer;
		}
		
		// CSS3 Blur Effect
		if ($blur_strength != '') {
			$blur_class					= "ts-background-blur " . $blur_strength;
			if ($blur_strength == "ts-background-blur-small") {
				$blur_factor			= 2;
			} else if ($blur_strength == "ts-background-blur-medium") {
				$blur_factor			= 5;
			} else if ($blur_strength == "ts-background-blur-strong") {
				$blur_factor			= 8;
			}
		} else {
			$blur_class					= "";
			$blur_factor				= 0;
		}
		
		// Raster (Noise) Overlay
		if (($raster_use == "true") && ($raster_type != '')) {
			$raster_content				= '<div class="ts-background-raster" style="background-image: url(' . $raster_type . ');"></div>';
		} else {
			$raster_content				= '';
		}
		
		// Color Overlay
		if ($overlay_use == "true") {
			$overlay_content			= '<div class="ts-background-overlay" style="background: ' . $overlay_color . ';"></div>';
		} else {
			$overlay_content			= '';
		}
		
		// SVG Shape Overlays
		$svg_enabled					= 'false';
		if ($svg_top_on == "true") {
			$svg_top_content			= '<div id="ts-background-separator-top-' . $randomizer . '" class="ts-background-separator ts-background-separator-top' . ($svg_top_flip == "true" ? "-flip" : "") . '" style="z-index: 99; height: ' . $svg_top_height . 'px; top: ' . $svg_top_position . 'px;">' . TS_VCSC_GetRowSeparator($svg_top_style, $svg_top_color1, $svg_top_color2, $svg_top_height) . '</div>';
			$svg_enabled				= 'true';
		} else {
			$svg_top_content			= '';
		}
		if ($svg_bottom_on == "true") {
			$svg_bottom_content			= '<div id="ts-background-separator-bottom-' . $randomizer . '" class="ts-background-separator ts-background-separator-bottom' . ($svg_bottom_flip == "true" ? "-flip" : "") . '" style="z-index: 99; height: ' . $svg_bottom_height . 'px; bottom: ' . $svg_bottom_position . 'px;">' . TS_VCSC_GetRowSeparator($svg_bottom_style, $svg_bottom_color1, $svg_bottom_color2, $svg_bottom_height) . '</div>';
			$svg_enabled				= 'true';
		} else {
			$svg_bottom_content			= '';
		}
		
		// Movement Effect
		if (($movement_x_allow == "true") || ($movement_x_allow == "true")) {
			wp_enqueue_script('ts-extend-parallaxify');
			$movement_class				= 'ts-image-full-movement';
		} else {
			$movement_class				= '';
		}
		
		$full_image						= wp_get_attachment_image_src($image, 'full');

		$image_extension 				= pathinfo($full_image[0], PATHINFO_EXTENSION);
		
		if ($attribute_alt == "true") {
			$alt_attribute				= $attribute_alt_value;
		} else {
			$alt_attribute				= basename($full_image[0], "." . $image_extension);
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Image_Full', $atts);
		} else {
			$css_class	= '';
		}
		
		$breakouts_data					= 'data-blur="' . $blur_factor . '" data-inline="' . $editor_frontend . '" data-index="' . $zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-image="' . $full_image[0] . '" data-break-parents="' . esc_attr( $break_parents ) . '"';
		$movement_data					= 'data-allowx="' . $movement_x_allow . '" data-movex="' . $movement_x_ratio . '" data-allowy="' . $movement_y_allow . '" data-movey="' . $movement_y_ratio . '"';
		
		$output .= '<div class="ts-image-full-container" style="width: 100%; height: 100%; position: relative;">';
			$output						.= $svg_top_content;
			$output .= '<div id="' . $full_image_id . '" class="ts-image-full-frame ' . $el_class . ' ' . $css_class . ' ' . $blur_class . ' ' . $movement_class . '" style="width: 100%; height: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-svgshape="' . $svg_enabled . '" data-random="' . $randomizer . '" ' . $breakouts_data . ' ' . $movement_data . '>';
				$output 				.= '<img class="ts-imagefull" src="' . $full_image[0] . '" alt="' . $alt_attribute . '" style="width: 100%; height: auto;"/>';
				//$output				.= $svg_top_content;
				$output					.= $overlay_content;
				$output					.= $raster_content;
				//$output				.= $svg_bottom_content;
			$output .= '</div>';
			$output						.= $svg_bottom_content;
		$output .= '</div>';

		echo $output;

		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
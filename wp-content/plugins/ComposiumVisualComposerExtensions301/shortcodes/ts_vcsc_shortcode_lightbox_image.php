<?php
	add_shortcode('TS-VCSC-Lightbox-Image', 'TS_VCSC_Lightbox_Image_Function');
	//add_shortcode('TS_VCSC_Lightbox_Image', 'TS_VCSC_Lightbox_Image_Function');
	function TS_VCSC_Lightbox_Image_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		wp_enqueue_script('ts-extend-hammer');
		wp_enqueue_script('ts-extend-nacho');
		wp_enqueue_style('ts-extend-nacho');
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-simptip');
			wp_enqueue_style('ts-extend-animations');
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
		
		extract( shortcode_atts( array(
			'content_title'					=> '',
			'content_image'					=> '',
			'content_image_responsive'		=> 'true',
			'content_image_height'			=> 'height: 100%;',
			'content_image_width_r'			=> 100,
			'content_image_width_f'			=> 300,
			'content_image_size'			=> 'medium',

			'attribute_alt'					=> 'false',
			'attribute_alt_value'			=> '',
			
			'lightbox_group'				=> 'true',
			'lightbox_group_name'			=> '',
			'lightbox_size'					=> 'full',
			'lightbox_effect'				=> 'random',
			'lightbox_speed'				=> 5000,
			'lightbox_social'				=> 'true',
			'lightbox_backlight'			=> 'auto',
			'lightbox_backlight_color'		=> '#ffffff',

			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id'							=> '',
			'el_class'						=> '',
			'css'							=> '',
		), $atts ));
	
		if (!empty($el_id)) {
			$modal_id						= $el_id;
		} else {
			$modal_id						= 'ts-vcsc-lightbox-image-' . mt_rand(999999, 9999999);
		}
		
		$output								= '';

		if (!empty($content_image)) {
			$modal_image 					= wp_get_attachment_image_src($content_image, $lightbox_size);
			$modal_thumb 					= wp_get_attachment_image_src($content_image, $content_image_size);
		}

		if ($lightbox_backlight == "auto") {
			$nacho_color					= '';
		} else if ($lightbox_backlight == "custom") {
			$nacho_color					= 'data-color="' . $lightbox_backlight_color . '"';
		} else if ($lightbox_backlight == "hideit") {
			$nacho_color					= 'data-color="#000000"';
		}
		
		if ($content_image_responsive == "true") {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_r . '%; ' . $content_image_height;
		} else {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_f . 'px; ' . $content_image_height;
		}
		
		$image_extension 					= pathinfo($modal_image[0], PATHINFO_EXTENSION);
		
		if ($attribute_alt == "true") {
			$alt_attribute					= $attribute_alt_value;
		} else {
			$alt_attribute					= basename($modal_image[0], "." . $image_extension);
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'nchgrid-item nchgrid-tile nch-lightbox-image ' . $modal_id . '-parent ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Lightbox-Image', $atts);
		} else {
			$css_class	= 'nchgrid-item nchgrid-tile nch-lightbox-image ' . $modal_id . '-parent ' . $el_class;
		}
		
		$output .= '<div id="' . $modal_id . '" class="' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
			$output .= '<a href="' . $modal_image[0] . '" class="nch-lightbox-media nofancybox" data-title="' . $content_title . '" rel="' . ($lightbox_group == "true" ? "nachogroup" : $lightbox_group_name) . '" data-effect="' . $lightbox_effect . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
				$output .= '<img src="' . $modal_thumb[0] . '" alt="' . $alt_attribute . '" title="" style="display: block; ' . $image_dimensions . '">';
				$output .= '<div class="nchgrid-caption"></div>';
				if (!empty($content_title)) {
					$output .= '<div class="nchgrid-caption-text">' . $content_title . '</div>';
				}
			$output .= '</a>';
		$output .= '</div>';
		
		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_TS_VCSC_Lightbox_Image extends WPBakeryShortCode {};
	}
?>
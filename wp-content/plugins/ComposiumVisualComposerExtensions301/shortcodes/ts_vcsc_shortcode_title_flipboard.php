<?php
	add_shortcode('TS_VCSC_Title_Flipboard', 'TS_VCSC_Title_Flipboard_Function');
	function TS_VCSC_Title_Flipboard_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndWaypoints == "true") {
			if (wp_script_is('waypoints', $list = 'registered')) {
				wp_enqueue_script('waypoints');
			} else {
				wp_enqueue_script('ts-extend-waypoints');
			}
		}
		wp_enqueue_script('ts-extend-flipflap');
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
	
		extract( shortcode_atts( array(
			'title'						=> '',
			'size'						=> 'large',
			'speed'						=> 3,
			'restart'					=> 'false',
			'mobile'					=> 'false',
			'wrapper'					=> 'h1',
			'viewport'					=> 'false',
			'delay'						=> 0,
			'margin_top'                => 20,
			'margin_bottom'             => 20,
			'el_id' 					=> '',
			'el_class'                  => '',
			'css'						=> '',
		), $atts ));
		
		$output							= '';

		$title 							= preg_replace('/[^ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz 0123456789.,!?#@()+-=\s]/', '', $title);
		
		// Flipboard Size
		if ($size == 'large') {
			$char_height				= 100;
			$char_width					= 50;
		} else if ($size == 'medium') {
			$char_height				= 70;
			$char_width					= 35;
		} else if ($size == 'small') {
			$char_height				= 40;
			$char_width					= 20;
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Title_Flipboard', $atts);
		} else {
			$css_class	= '';
		}
	
		$output .= '<div class="ts-splitflap-container clearFixMe ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
				$output .= '<img class="ts-splitflap-image" src="' . TS_VCSC_GetResourceURL('images/other/ts_flipboard_title.png') . '">';
				$output .= '<div class="ts-splitflap-info">' . __( "Title Text", "ts_visual_composer_extend" ) . ': ' . $title . '</div>';
				$output .= '<div class="ts-splitflap-info">' . __( "Flipboard Size", "ts_visual_composer_extend" ) . ': ' . $size . '</div>';
				$output .= '<div class="ts-splitflap-info">' . __( "Trigger on Viewport", "ts_visual_composer_extend" ) . ': ' . $viewport . '</div>';
			} else {
				$output .= '<div class="ts-splitflap-wrapper" data-frontend="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-restart="' . $restart . '" data-mobile="' . $mobile . '" data-wrapper="' . $wrapper . '" data-text="' . strtoupper($title) . '" data-speed="' . $speed . '" data-size="' . $size . '" data-height="' . $char_height . '" data-width="' . $char_width . '" data-image="' . TS_VCSC_GetResourceURL('images/other/ts_flipflap_chars_' . $size . '.png') . '" data-viewport="' . $viewport . '" data-delay="' . $delay . '">';
					$output .= '' . $title . '';
				$output .= '</div>';
			}
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
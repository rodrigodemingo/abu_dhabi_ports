<?php
	add_shortcode('TS_VCSC_Title_Typed', 'TS_VCSC_Title_Typed_Function');
	function TS_VCSC_Title_Typed_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndWaypoints == "true") {
			if (wp_script_is('waypoints', $list = 'registered')) {
				wp_enqueue_script('waypoints');
			} else {
				wp_enqueue_script('ts-extend-waypoints');
			}
		}
		wp_enqueue_script('ts-extend-typed');
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {			
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
	
		extract( shortcode_atts( array(
			'title_lines'				=> 'false',
			'fixed_addition'			=> 'false',
			'fixed_string'				=> '',
			'fixed_color'				=> '#000000',
			'title_strings'				=> '',
			'whitespace'				=> 'pre',
			'padding'					=> 15,
			'showall'					=> 'false',
			'font_size'					=> 36,
			'font_color'				=> '#000000',
			'font_weight'				=> 'inherit',
			'font_align'				=> 'center',
			'font_theme'				=> 'true',
			'font_family'				=> '',
			'font_type'					=> '',
			'viewport'					=> 'true',
			'startdelay'				=> 0,
			'typespeed'					=> 10,
			'backdelay'					=> 500,
			'backspeed'					=> 10,
			'loop'						=> 'false',
			'loopcount'					=> 0,
			'showcursor'				=> 'true',
			'removecursor'				=> 'false',
			'mobile'					=> 'false',
			'wrapper'					=> 'h1',
			'title_mobile'				=> '',
			'margin_top'                => 0,
			'margin_bottom'             => 0,
			'el_id' 					=> '',
			'el_class'                  => '',
			'css'						=> '',
		), $atts ));
		
		$output = $notice = $visible = '';
		
		// Check for Front End Editor
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
			$editor_frontend			= "true";
		} else {
			$editor_frontend			= "false";
		}
		
		if (!empty($el_id)) {
			$typewriter_id				= $el_id;
		} else {
			$typewriter_id				= 'ts-vcsc-title-typed-' . mt_rand(999999, 9999999);
		}
		
		if ($font_theme == "false") {
			$output 					.= TS_VCSC_GetFontFamily($typewriter_id, $font_family, $font_type);
		}
		
		if ($title_lines == "true") {
			$title_class				= 'ts-title-typed-style1';
		} else {
			$title_class				= '';
		}
		
		if ($title_mobile != '') {
			$title_mobile				= $title_mobile;
		} else {
			if ($fixed_addition == "true") {
				$title_mobile			= $fixed_string . $title_strings;
			} else {
				$title_mobile			= $title_strings;
			}
		}
		
		$style_setting					= 'font-size: ' . $font_size . 'px; line-height: ' . $font_size . 'px; letter-spacing: 0px; font-weight: ' . $font_weight . '; text-align: ' . $font_align . '; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Title_Typed', $atts);
		} else {
			$css_class	= '';
		}
	
		$output .= '<div id="' . $typewriter_id . '" class="ts-title-typed-container ' . $css_class . ' ' . $title_class . '" style="width: 100%; ' . $style_setting . '" data-frontend="' . $editor_frontend . '" data-mobile="' . $mobile . '" data-wrapper="' . $wrapper . '" data-title="' . $title_mobile . '" data-viewport="' . $viewport . '" data-strings="' . $title_strings . '" data-pretext="' . $fixed_string . '" data-showall="' . $showall . '" data-showcursor="' . $showcursor . '" data-removecursor="' . $removecursor . '" data-loop="' . $loop . '" data-loopcount="' . ($loopcount == 0 ? "false" : $loopcount) . '" data-startdelay="' . $startdelay . '" data-backdelay="' . $backdelay . '" data-typespeed="' . $typespeed . '" data-backspeed="' . $backspeed . '">';
			$output .= '<div class="ts-title-typed-holder" style="padding: 0 ' . $padding . 'px;">';
				if ($fixed_addition == "true") {
					$output .= '<span class="ts-title-typed-pretext" style="color: ' . $fixed_color . '; white-space: ' . $whitespace . ';">' . $fixed_string . '</span>';
				}
				$output .= '<span class="ts-title-typed-string" style="color: ' . $font_color . '; white-space: ' . $whitespace . ';"></span>';
			$output .= '</div>';
		$output .= '</div>';		
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
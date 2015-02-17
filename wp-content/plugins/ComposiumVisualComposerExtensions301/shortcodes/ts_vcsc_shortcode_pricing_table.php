<?php
	add_shortcode('TS-VCSC-Pricing-Table', 'TS_VCSC_Pricing_Table_Function');
	function TS_VCSC_Pricing_Table_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-simptip');
			wp_enqueue_style('ts-extend-animations');
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
		
		extract( shortcode_atts( array(
			'style'						=> "1",
			'featured'					=> 'false',
			'featured_text'				=> 'Recommended',
			'plan'						=> 'Basic',
			'plan_color_active'			=> '3b86b0',
			'plan_color_inactive'		=> 'e5e5e5',
			'cost'						=> '$20',
			'per'						=> '',
			'cost_color'				=> 'f7f7f7',
			'content_color'				=> 'ffffff',
			'link_type'					=> 'default',
			'button_url'				=> '',
			'button_text'				=> 'Purchase',
			'button_target'				=> '_parent',
			'button_custom'				=> '',
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id'						=> '',
			'el_class'					=> '',
			'css'						=> '',
		), $atts ) );
		
		$class							= '';
		
		if (!empty($el_id)) {
			$pricetable_id				= $el_id;
		} else {
			$pricetable_id				= 'ts-vcsc-pricing-table-' . mt_rand(999999, 9999999);
		}
		
		$featured_pricing 				= ($featured == 'true') ? ' featured' : NULL;
		$border_radius_style 			= '';
		$margin_settings				= 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
	
		$output 						= '';
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Pricing-Table', $atts);
		} else {
			$css_class	= '';
		}
		
		if ($style == "1"){
			$output .= '<div id="' . $pricetable_id . '" class="ts-pricing style1 clearFixMe' . $featured_pricing . ' ' . $class . ' ' . $css_class . '" style="' . $margin_settings . '">';
				$output .= '<div class="ts-pricing-header" >';
					$output .= '<h5>' . $plan . '</h5>';
				$output .= '</div>';
				$output .= '<div class="ts-pricing-cost clr">';
					$output .= '<div class="ts-pricing-amount">'. $cost .'</div><div class="ts-pricing-per">'. $per .'</div>';
				$output .= '</div>';
				$output .= '<div class="ts-pricing-content">';
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= ''. wpb_js_remove_wpautop($content, true). '';
					} else {
						$output .= ''. $content. '';
					}
				$output .= '</div>';
				if (($link_type == "default") && (!empty($button_url))) {
					$output .= '<div class="ts-pricing-link"><a href="'. $button_url .'" target="'. $button_target .'" '. $border_radius_style .' class="ts-pricing-button">'. $button_text .'</a></div>';
				} else if (($link_type == "custom") && (!empty($button_custom))) {
					$output .= '<div class="ts-pricing-link">' . rawurldecode(base64_decode(strip_tags($button_custom))) . '</div>';
				}
			$output .= '</div>';
		}
		if ($style == "2"){
			if (($link_type == "default") && (!empty($button_url))) {
				$margin_adjust = '';
			} else if (($link_type == "custom") && (!empty($button_custom))) {
				$margin_adjust = '';
			} else {
				$margin_adjust = 'margin-top: 60px;';
			}			
			$output .= '<div id="' . $pricetable_id . '" class="ts-pricing style2 clearFixMe ' . $class . ' ' . $css_class . '" style="' . $margin_settings . '">';
				$output .= '<div class="plan' . $featured_pricing . '">';
					$output .= '<h3>';
					$output .= '' . $plan . '<span>' . $cost . '</span>';
					$output .= '</h3>';
					if (($link_type == "default") && (!empty($button_url))) {
						$output .= '<div class="ts-pricing-link" style="margin: 60px auto 0 auto !important;"><a class="signup" href="' . $button_url . '" target="'. $button_target .'">' . $button_text . '</a></div>';
					} else if (($link_type == "custom") && (!empty($button_custom))) {
						$output .= '<div class="ts-pricing-link" style="margin: 60px auto 0 auto !important;">' . rawurldecode(base64_decode(strip_tags($button_custom))) . '</div>';
					}
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= '<div style="' . $margin_adjust . '">'. wpb_js_remove_wpautop($content, true). '</div>';
					} else {
						$output .= '<div style="' . $margin_adjust . '">'. $content. '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		if ($style == "3"){
			$output .= '<div id="' . $pricetable_id . '" class="ts-pricing style3 clearFixMe ' . $class . ' ' . $css_class . '" style="' . $margin_settings . '">';
				$output .= '<div class="plan' . ($featured == "true" ? " plan-highlight" : "") . '">';
					if ($featured == "true") {
						$output .= '<div class="plan-recommended">' . $featured_text . '</div>';
					}
					$output .= '<h3 class="plan-title">' . $plan . '</h3>';
					$output .= '<div class="plan-price">'. $cost .'<span class="plan-unit">'. $per .'</span></div>';
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= ''. wpb_js_remove_wpautop($content, true). '';
					} else {
						$output .= ''. $content. '';
					}
					if (($link_type == "default") && (!empty($button_url))) {
						$output .= '<div class="ts-pricing-link"><a href="' . $button_url . '" class="plan-button" target="'. $button_target .'">' . $button_text . '</a></div>';
					} else if (($link_type == "custom") && (!empty($button_custom))) {
						$output .= '<div class="ts-pricing-link">' . rawurldecode(base64_decode(strip_tags($button_custom))) . '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		if ($style == "4"){
			$output .= '<div id="' . $pricetable_id . '" class="ts-pricing style4 clearFixMe ' . $class . ' ' . $css_class . '" style="' . $margin_settings . '">';
				$output .= '<div class="plan ' . ($featured == "true" ? "plan-tall" : "") . '">';
					$output .= '<h2 class="plan-title">' . $plan . '</h2>';
					$output .= '<div class="plan-price">'. $cost .'<span>'. $per .'</span></div>';
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= ''. wpb_js_remove_wpautop($content, true). '';
					} else {
						$output .= ''. $content. '';
					}
					if (($link_type == "default") && (!empty($button_url))) {
						$output .= '<div class="ts-pricing-link"><a href="' . $button_url . '" class="plan-button" target="'. $button_target .'">' . $button_text . '</a></div>';
					} else if (($link_type == "custom") && (!empty($button_custom))) {
						$output .= '<div class="ts-pricing-link">' . rawurldecode(base64_decode(strip_tags($button_custom))) . '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		if ($style == "5"){
			$output .= '<div id="' . $pricetable_id . '" class="ts-pricing style5 clearFixMe ' . $class . ' ' . $css_class . '" style="' . $margin_settings . '">';
				$output .= '<div class="pricing-table' . $featured_pricing . '">';
					$output .= '<div class="pricing-table-header">';
						$output .= '<h1>' . $plan . '</h1>';
					$output .= '</div>';
					$output .= '<div class="pricing-table-content">';
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= ''. wpb_js_remove_wpautop($content, true). '';
						} else {
							$output .= ''. $content. '';
						}
					$output .= '</div>';
					$output .= '<div class="pricing-table-footer">';
						$output .= '<h2>'. $cost .'</h2>';
						$output .= '<p>'. $per .'</p>';
						if (($link_type == "default") && (!empty($button_url))) {
							$output .= '<div class="ts-pricing-link"><a href="' . $button_url . '" class="plan-button" target="'. $button_target .'">' . $button_text . '</a></div>';
						} else if (($link_type == "custom") && (!empty($button_custom))) {
							$output .= '<div class="ts-pricing-link">' . rawurldecode(base64_decode(strip_tags($button_custom))) . '</div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>

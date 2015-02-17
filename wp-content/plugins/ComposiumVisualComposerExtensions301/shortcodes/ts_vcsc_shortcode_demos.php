<?php
	// Shortcode to Build Icon Preview for Specific Font
	add_shortcode('TS_VCSC_Icon_Preview', 'TS_VCSC_Icon_Font_Preview');
	function TS_VCSC_Icon_Font_Preview ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		wp_enqueue_style('ts-extend-tooltipster');
		wp_enqueue_script('ts-extend-tooltipster');	
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-animations');
			wp_enqueue_style('ts-visual-composer-extend-front');
		}
		
		extract(shortcode_atts(array(
			'font' 						=> 'Awesome',
			'size'           			=> 16,
			
			'color'						=> '#000000',
			'background'				=> '',
	
			'animation'					=> '',
		), $atts));
		
		// Load CSS for Selected Font
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
			if (($iconfont != "Custom") && ($iconfont == $font)) {
				wp_enqueue_style('ts-font-' . strtolower($iconfont));
			}
			if ($iconfont == "Dashicons") {
				wp_enqueue_style('dashicons');
			}
		}
		
		// Rebuild Font Data Array in Case Font is Disabled
		update_option('ts_vcsc_extend_settings_tinymceFontsAll', 1);
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconFontArrays();
		update_option('ts_vcsc_extend_settings_tinymceFontsAll', 0);
		
		// Define Size for Element
		if ($size != 16) {
			$icon_size					= "height:" . $size . "px; width:" . $size . "px; line-height:" . $size . "px; font-size:" . $size . "px; ";
		} else {
			$icon_size					= "";
		}
		
		// Define Color for Element
		if ($color != "#000000") {
			$icon_color					= "color: " . $color . "; ";
		} else {
			$icon_color					= "";
		}
		
		// Define Background for Element
		if (strlen($background) > 0) {
			$icon_background 			= " background-color: " . $background . "; ";
		} else {
			$icon_background			= "";
		}
	
		// Define Class for Animation
		if (strlen($animation) > 0) {
			$icon_animation				= $animation;
		} else {
			$icon_animation				= "";
		}
		
		// Tooltip Settings
		$tooltip_settings 				= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-image="" data-tooltipster-position="top" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="tooltipster-black" data-tooltipster-animation="swing" data-tooltipster-trigger="hover" data-tooltipster-offsetx="0" data-tooltipster-offsety="0"';
		
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
			if (($iconfont != "Custom") && ($iconfont == $font) && ($iconfont != "Dashicons")){
				$output = '';
				$output .= '<div id="ts-vcsc-extend-preview-' . $iconfont . '" class="ts-vcsc-extend-preview" data-font="' . $Icon_Font . '">';
					$output .= '<div id="ts-vcsc-extend-preview-list-' . $Icon_Font . '" class="ts-vcsc-extend-preview-list" data-font="' . $Icon_Font . '">';
						$icon_counter = 0;
						foreach ($VISUAL_COMPOSER_EXTENSIONS->{'TS_VCSC_Icons_Compliant_' . $iconfont . ''} as $group => $icons) {
							if (!is_array($icons) || !is_array(current($icons))) {
								$class_key = key($icons);
								$output .= '<div class="ts-vcsc-icon-preview ts-has-tooltipster-tooltip" style="position: relative; display: inline-block;" data-tooltipster-text="' . esc_attr($class_key) . '" ' . $tooltip_settings . ' data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($icons)) . '" data-font="' . strtolower($font) . '" data-count="' . $icon_counter . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i class="ts-font-icon ts-font-icon ' . esc_attr($class_key) . ' ' . $icon_animation . '" style="' . $icon_size . $icon_color . $icon_background . ' "></i></span></div>';
								$icon_counter = $icon_counter + 1;
							} else {
								foreach ($icons as $key => $label) {
									$class_key = key($label);
									$output .= '<div class="ts-vcsc-icon-preview ts-has-tooltipster-tooltip" style="position: relative; display: inline-block;" data-tooltipster-text="' . esc_attr($class_key) . '" ' . $tooltip_settings . ' data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($label)) . '" data-font="' . strtolower($font) . '" data-count="' . $icon_counter . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i class="ts-font-icon ts-font-icon ' . esc_attr($class_key) . ' ' . $icon_animation . '" style="' . $icon_size . $icon_color . $icon_background . ' "></i></span></div>';
									$icon_counter = $icon_counter + 1;
								}
							}							
						}
					$output .= '</div>';
				$output .= '</div>';
			} else if (($iconfont != "Custom") && ($iconfont == $font) && ($iconfont == "Dashicons")){
				$output = '';
				$output .= '<div id="ts-vcsc-extend-preview-' . $iconfont . '" class="ts-vcsc-extend-preview" data-font="' . $Icon_Font . '">';
					$output .= '<div id="ts-vcsc-extend-preview-list-' . $Icon_Font . '" class="ts-vcsc-extend-preview-list" data-font="' . $Icon_Font . '">';
						$icon_counter = 0;
						foreach ($VISUAL_COMPOSER_EXTENSIONS->{'TS_VCSC_Icons_Compliant_' . $iconfont . ''} as $group => $icons) {
							if (!is_array($icons) || !is_array(current($icons))) {
								$class_key = key($icons);
								$output .= '<div class="ts-vcsc-icon-preview ts-has-tooltipster-tooltip" style="position: relative; display: inline-block;" data-tooltipster-text="' . esc_attr($class_key) . '" ' . $tooltip_settings . ' data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($icons)) . '" data-font="' . strtolower($font) . '" data-count="' . $icon_counter . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i class="ts-font-icon ts-font-icon ' . esc_attr($class_key) . ' ' . $icon_animation . '" style="' . $icon_size . $icon_color . $icon_background . ' "></i></span></div>';
								$icon_counter = $icon_counter + 1;
							} else {
								foreach ($icons as $key => $label) {
									$class_key = key($label);
									$output .= '<div class="ts-vcsc-icon-preview ts-has-tooltipster-tooltip" style="position: relative; display: inline-block;" data-tooltipster-text="' . esc_attr($class_key) . '" ' . $tooltip_settings . ' data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($label)) . '" data-font="' . strtolower($font) . '" data-count="' . $icon_counter . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i class="ts-font-icon ts-font-icon ' . esc_attr($class_key) . ' ' . $icon_animation . '" style="' . $icon_size . $icon_color . $icon_background . ' "></i></span></div>';
									$icon_counter = $icon_counter + 1;
								}
							}							
						}
					$output .= '</div>';
				$output .= '</div>';
			}
		}

		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Shortcode to get Icon Count for Specific Font
	add_shortcode('TS_VCSC_Icon_Font_IconCount', 'TS_VCSC_Icon_Font_IconCount');
	function TS_VCSC_Icon_Font_IconCount ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();		
		extract(shortcode_atts(array(
			'font' 						=> 'Awesome',
		), $atts));		
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icon_Font_Settings as $Icon_Font => $iconfont) {
			if (($iconfont['setting'] != "Custom") && ($iconfont['setting'] == $font)) {
				echo $iconfont['count'];
			}
		}		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Shortcode to get Total Number of all Icons
	add_shortcode('TS_VCSC_Icon_Font_IconsTotal', 'TS_VCSC_Icon_Font_IconsTotal');
	function TS_VCSC_Icon_Font_IconsTotal ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();		
		extract(shortcode_atts(array(), $atts));		
		if (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') {
			echo $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Total_Icon_Count - $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_tinymceCustomCount;
		} else {
			echo $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Total_Icon_Count;
		}		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Shortcode to get Share of Icons in Specific Font in Relation to all Icons
	add_shortcode('TS_VCSC_Icon_Font_IconShare', 'TS_VCSC_Icon_Font_IconShare');
	function TS_VCSC_Icon_Font_IconShare ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();		
		extract(shortcode_atts(array(
			'font' 						=> 'Awesome',
		), $atts));		
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icon_Font_Settings as $Icon_Font => $iconfont) {
			if (($iconfont['setting'] != "Custom") && ($iconfont['setting'] == $font)) {
				if (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') {
					echo $iconfont['count'] / ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Total_Icon_Count - $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_tinymceCustomCount);
				} else {
					echo $iconfont['count'] / $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Total_Icon_Count;
				}
			}
		}		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Shortcode to get Total Number of all Fonts
	add_shortcode('TS_VCSC_Icon_Font_FontCount', 'TS_VCSC_Icon_Font_FontCount');
	function TS_VCSC_Icon_Font_FontCount ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();		
		extract(shortcode_atts(array(), $atts));		
		if (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') {
			echo count($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts);
		} else {
			echo count($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts) - 1;
		}		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Shortcode to Build Table with CSS3 Animations Preview
	add_shortcode('TS_VCSC_Icon_Animations', 'TS_VCSC_Icon_Font_Animations');
	function TS_VCSC_Icon_Font_Animations ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-simptip');
			wp_enqueue_style('ts-extend-animations');
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
		
		extract(shortcode_atts(array(
			'font' 						=> 'Awesome',
			'size'           			=> 16,
			
			'color'						=> '#000000',
			'background'				=> '',
	
			'animationtype'				=> 'Default',
		), $atts));
		
		// Load CSS for Selected Font
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
			if (($iconfont != "Custom") && ($iconfont == $font)) {
				wp_enqueue_style('ts-font-' . strtolower($iconfont));
			}
		}
		
		// Rebuild Font Data Array in Case Font is Disabled
		update_option('ts_vcsc_extend_settings_tinymceFontsAll', 1);
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconFontArrays();
		update_option('ts_vcsc_extend_settings_tinymceFontsAll', 0);
		
		// Define Size for Element
		if ($size != 16) {
			$icon_size					= "height:" . $size . "px; width:" . $size . "px; line-height:" . $size . "px; font-size:" . $size . "px; ";
		} else {
			$icon_size					= "";
		}
		
		// Define Color for Element
		if ($color != "#000000") {
			$icon_color					= "color: " . $color . "; ";
		} else {
			$icon_color					= "";
		}
		
		// Define Background for Element
		if (strlen($background) > 0) {
			$icon_background 			= " background-color: " . $background . "; ";
		} else {
			$icon_background			= "";
		}
	
		// Define Animation Array
		$animationloop 	= array();
		$animationname 	= array();
		$animationgroup = array();
		if (strlen($animationtype) > 0) {
			if ($animationtype == "Hover") {
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Animations_Array as $Animation_Class => $animations) {
					if (($Animation_Class) && ($animations['group'] != "Standard Visual Composer")) {
						$animationloop[] 	= "ts-hover-css-" . $animations['class'];
						$animationname[] 	= $Animation_Class;
						$animationgroup[]	= $animations['group'];
					}
				}
			} else if ($animationtype == "Default") {
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Animations_Array as $Animation_Class => $animations) {
					if (($Animation_Class) && ($animations['group'] != "Standard Visual Composer")) {
						$animationloop[] 	= "ts-infinite-css-" . $animations['class'];
						$animationname[] 	= $Animation_Class;
						$animationgroup[]	= $animations['group'];
					}
				}
			} else if ($animationtype == "Viewport") {
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Animations_Array as $Animation_Class => $animations) {
					if (($Animation_Class) && ($animations['group'] != "Standard Visual Composer")) {
						$animationloop[] 	= "ts-viewport-css-" . $animations['class'];
						$animationname[] 	= $Animation_Class;
						$animationgroup[]	= $animations['group'];
					}
				}
			}
		}
		$animationcount = count($animationloop) - 1;
		
		$output = '';
		$output .= '<div id="ts-vcsc-extend-preview-' . $font . '" class="ts-vcsc-extend-preview" data-font="' . $font . '">';
			$output .= '<div id="ts-vcsc-extend-preview-list-' . $font . '" class="ts-vcsc-extend-preview-list" data-font="' . $font . '">';
				$outputcount = 1;
				$output .= '<table class="ts-vcsc-icon-animations" style="width: 100%;">';
				$output .= '<thead>';
				$output .= '<tr><th>#</th><th>Animation Name</th><th>Default (Class Name)</th><th>Hover (Class Name)</th><th>Viewport (Class Name)</th><th>Animation Effect</th></tr>';
				$output .= '</thead>';
				$output .= '<tbody>';
					$effectgroups	= array();
					foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
						if (($iconfont != "Custom") && ($iconfont == $font)){
							foreach ($VISUAL_COMPOSER_EXTENSIONS->{'TS_VCSC_Icons_Compliant_' . $iconfont . ''} as $group => $icons) {
								if (!is_array($icons) || !is_array(current($icons))) {
									$class_key = key($icons);
									if ($outputcount <= $animationcount) {
										if (!in_array($animationgroup[$outputcount], $effectgroups)) {
											array_push($effectgroups, $animationgroup[$outputcount]);
											$output .= '<tr style="background: #ededed;"><td colspan="6" style="font-size: 12px; font-weight: bold; text-align: center;">' . $animationgroup[$outputcount] . '</td></tr>';
										}									
										$output .= '<tr>';
										$output .= '<td>' . $outputcount . '</td>';
										$output .= '<td style="font-size: 14px; font-weight: bold;">' . $animationname[$outputcount] . '</td>';
										if ($animationtype == "Hover") {
											$output .= '<td>' . str_replace("hover", "infinite", $animationloop[$outputcount]) . '</td>';
											$output .= '<td>' . $animationloop[$outputcount] . '</td>';
											$output .= '<td>' . str_replace("hover", "viewport", $animationloop[$outputcount]) . '</td>';
										} else if ($animationtype == "Default") {
											$output .= '<td>' . $animationloop[$outputcount] . '</td>';
											$output .= '<td>' . str_replace("infinite", "hover", $animationloop[$outputcount]) . '</td>';
											$output .= '<td>' . str_replace("infinite", "viewport", $animationloop[$outputcount]) . '</td>';
										} else if ($animationtype == "Viewport") {
											$output .= '<td>' . str_replace("viewport", "infinite", $animationloop[$outputcount]) . '</td>';
											$output .= '<td>' . str_replace("viewport", "hover", $animationloop[$outputcount]) . '</td>';
											$output .= '<td>' . $animationloop[$outputcount] . '</td>';
										}
										if ($animationtype == "Viewport") {
											$output .= '<td><div class="ts-vcsc-icon-preview" data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($icons)) . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="' . $animationloop[$outputcount] . '" class="ts-font-icon ' . esc_attr($class_key) . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . esc_attr($class_key) . '"></i></span></div></td>';
										} else if ($animationtype == "Default") {
											$output .= '<td><div class="ts-vcsc-icon-preview" data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($icons)) . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="" class="ts-font-icon ' . esc_attr($class_key) . ' ' . $animationloop[$outputcount] . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . esc_attr($class_key) . '"></i></span></div></td>';
										} else if ($animationtype == "Hover") {
											$output .= '<td><div class="ts-vcsc-icon-preview" data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($icons)) . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="" class="ts-font-icon ' . esc_attr($class_key) . ' ' . $animationloop[$outputcount] . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . esc_attr($class_key) . '"></i></span></div></td>';
										}
									} else {
										break;
									}
									$outputcount = $outputcount + 1;
								} else {
									foreach ($icons as $key => $label) {
										$class_key = key($label);
										if ($outputcount <= $animationcount) {
											if (!in_array($animationgroup[$outputcount], $effectgroups)) {
												array_push($effectgroups, $animationgroup[$outputcount]);
												$output .= '<tr style="background: #ededed;"><td colspan="6" style="font-size: 12px; font-weight: bold; text-align: center;">' . $animationgroup[$outputcount] . '</td></tr>';
											}									
											$output .= '<tr>';
											$output .= '<td>' . $outputcount . '</td>';
											$output .= '<td style="font-size: 14px; font-weight: bold;">' . $animationname[$outputcount] . '</td>';
											if ($animationtype == "Hover") {
												$output .= '<td>' . str_replace("hover", "infinite", $animationloop[$outputcount]) . '</td>';
												$output .= '<td>' . $animationloop[$outputcount] . '</td>';
												$output .= '<td>' . str_replace("hover", "viewport", $animationloop[$outputcount]) . '</td>';
											} else if ($animationtype == "Default") {
												$output .= '<td>' . $animationloop[$outputcount] . '</td>';
												$output .= '<td>' . str_replace("infinite", "hover", $animationloop[$outputcount]) . '</td>';
												$output .= '<td>' . str_replace("infinite", "viewport", $animationloop[$outputcount]) . '</td>';
											} else if ($animationtype == "Viewport") {
												$output .= '<td>' . str_replace("viewport", "infinite", $animationloop[$outputcount]) . '</td>';
												$output .= '<td>' . str_replace("viewport", "hover", $animationloop[$outputcount]) . '</td>';
												$output .= '<td>' . $animationloop[$outputcount] . '</td>';
											}
											if ($animationtype == "Viewport") {
												$output .= '<td><div class="ts-vcsc-icon-preview" data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($label)) . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="' . $animationloop[$outputcount] . '" class="ts-font-icon ' . esc_attr($class_key) . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . esc_attr($class_key) . '"></i></span></div></td>';
											} else if ($animationtype == "Default") {
												$output .= '<td><div class="ts-vcsc-icon-preview" data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($label)) . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="" class="ts-font-icon ' . esc_attr($class_key) . ' ' . $animationloop[$outputcount] . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . esc_attr($class_key) . '"></i></span></div></td>';
											} else if ($animationtype == "Hover") {
												$output .= '<td><div class="ts-vcsc-icon-preview" data-name="' . esc_attr($class_key) . '" data-code="' . esc_html(current($label)) . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . esc_attr($class_key) . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="" class="ts-font-icon ' . esc_attr($class_key) . ' ' . $animationloop[$outputcount] . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . esc_attr($class_key) . '"></i></span></div></td>';
											}
										} else {
											break;
										}
										$outputcount = $outputcount + 1;
									}
								}
							}
						}
					}
				$output .= '</tbody>';
				$output .= '</table>';
			$output .= '</div>';
		$output .= '</div>';

		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Shortcode to generate System Information Overview
	add_shortcode('TS_VCSC_System_Information', 'TS_VCSC_System_Information');
	function TS_VCSC_System_Information ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		global $VISUAL_COMPOSER_EXTENSIONS;
		global $wpdb, $edd_options;
		
		wp_enqueue_style('dashicons');
		wp_enqueue_style('ts-visual-composer-extend-demos');
		wp_enqueue_script('ts-visual-composer-extend-demos');	
		
		if (!class_exists('Browser')) {
			require_once $VISUAL_COMPOSER_EXTENSIONS->detector_dir . 'ts_browser_detect.php';
		}
		$browser = new Browser();
		if (get_bloginfo('version') < '3.4') {
			$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
			$theme      = $theme_data['Name'] . ' ' . $theme_data['Version'];
		} else {
			$theme_data = wp_get_theme();
			$theme      = $theme_data->Name . ' ' . $theme_data->Version;
		}
		echo '<div class="ts-vcsc-system-information-wrap wrap" style="width: 100%;">';	
			echo '<div class="ts-vcsc-settings-group-header">';
				echo '<div class="display_header">';
					echo '<h2><span class="dashicons dashicons-desktop"></span>Visual Composer Extensions - System Information</h2>';
				echo '</div>';
				echo '<div class="clear"></div>';
			echo '</div>';	
			echo '<div class="ts-vcsc-system-information-main">';
				// Basic WordPress Info			
				echo '<div class="ts-vcsc-section-main">';
					echo '<div class="ts-vcsc-section-title ts-vcsc-section-hide"><i class="dashicons-wordpress"></i>Basic WordPress Info</div>';
					echo '<div class="ts-vcsc-section-content slideFade" style="display: none;">';
						echo '<table class="ts-vcsc-system-information-table" style="width: 100%;">';
							echo '<tr><td>WordPress Version:</td><td>' . get_bloginfo('version') . '</td></tr>';
							echo '<tr><td>Multisite:</td><td>' . (is_multisite() ? 'Yes' . "\n" : 'No' . "\n") . '</td></tr>';
							echo '<tr><td>Site URL:</td><td>' . site_url() . '</td></tr>';
							echo '<tr><td>Home URL:</td><td>' . home_url() . '</td></tr>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
				// General Info			
				echo '<div class="ts-vcsc-section-main">';
					echo '<div class="ts-vcsc-section-title ts-vcsc-section-hide"><i class="dashicons-info"></i>General Info</div>';
					echo '<div class="ts-vcsc-section-content slideFade" style="display: none;">';
						echo '<table class="ts-vcsc-system-information-table" style="width: 100%;">';
							echo '<tr><td>PHP Version:</td><td>' . PHP_VERSION . '</td></tr>';
							echo '<tr><td>MySQL Version:</td><td>' . mysql_get_server_info() . '</td></tr>';
							echo '<tr><td>Web Server Info:</td><td>' . $_SERVER['SERVER_SOFTWARE'] . '</td></tr>';
							echo '<tr><td>Browser:</td><td>' . $browser . '</td></tr>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
				// Memory Info			
				echo '<div class="ts-vcsc-section-main">';
					echo '<div class="ts-vcsc-section-title ts-vcsc-section-hide"><i class="dashicons-align-none"></i>Memory Info</div>';
					echo '<div class="ts-vcsc-section-content slideFade" style="display: none;">';
						echo '<table class="ts-vcsc-system-information-table" style="width: 100%;">';
							echo '<tr><td>WordPress Memory Limit:</td><td>' . (TS_VCSC_LetToNumber(WP_MEMORY_LIMIT)/(1024)) . 'MB</td></tr>';
							echo '<tr><td>PHP Memory Limit:</td><td>' . ini_get('memory_limit') . 'B</td></tr>';
							$memoryusage 		= TS_VCSC_Memory_Usage();
							echo '<tr><td>PHP Current Memory:</td><td>' . ($memoryusage) . ' MB</td></tr>';
							$memoryutilization 	= (number_format((($memoryusage / ini_get('memory_limit')) * 100), 2, '.', ''));
							echo '<tr><td>PHP Memory Utilization:</td><td>' . $memoryutilization . '%</td></tr>';
							$peakmemory = (number_format(memory_get_peak_usage(false)/1024/1024, 2, '.', ''));
							echo '<tr><td>PHP Peak Memory:</td><td>' . $peakmemory . ' MB</td></tr>';
							echo '<tr><td>PHP Max. Upload Size:</td><td>' . ini_get('upload_max_filesize') . '</td></tr>';
							echo '<tr><td>PHP Max. Post Size:</td><td>' . ini_get('post_max_size') . '</td></tr>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
				// Theme Info			
				echo '<div class="ts-vcsc-section-main">';
					echo '<div class="ts-vcsc-section-title ts-vcsc-section-hide"><i class="dashicons-art"></i>Active Theme Info</div>';
					echo '<div class="ts-vcsc-section-content slideFade" style="display: none;">';
						echo '<table class="ts-vcsc-system-information-table" style="width: 100%;">';
							echo '<tr><td>Active Theme:</td><td>' . $theme . '</td></tr>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
				// Plugin Info			
				echo '<div class="ts-vcsc-section-main">';
					echo '<div class="ts-vcsc-section-title ts-vcsc-section-hide"><i class="dashicons-admin-plugins"></i>Active Plugins Info</div>';
					echo '<div class="ts-vcsc-section-content slideFade" style="display: none;">';
						echo '<table class="ts-vcsc-system-information-table" style="width: 100%;">';
							echo '<tr>';
								echo '<td>Subsite Plugins:</td>';
								$plugins 					= get_plugins();
								$active_plugins 			= get_option('active_plugins', array());
								$wpbakery					= 'No';
								$vcextensions				= 'Not Activated';
								echo '<td><ul>';
								foreach ($plugins as $plugin_path => $plugin) {
									// If the plugin isn't active, don't show it.
									if (!in_array($plugin_path, $active_plugins)) {
										continue;
									} else {
										if (stripos($plugin['Name'], 'WPBakery') !== false) {
											$wpbakery		= 'Yes';
										} else if (stripos($plugin['TextDomain'], 'ts_visual_composer_extend') !== false) {
											$vcextensions	= 'v' . $plugin['Version'];
										}
										echo '<li>' . $plugin['Name'] . ' v' . $plugin['Version'] . "</li>";
									}
								}
								echo '</ul></td>';
							echo '</tr>';	
							if (is_multisite()) {
								echo '<tr><td colspan="2" style="height: 20px;"></td></tr>';
								echo '<tr>';
									echo '<td>Network Plugins:</td>';
									$plugins 			= wp_get_active_network_plugins();
									$active_plugins 	= get_site_option( 'active_sitewide_plugins', array() );
								echo '<td><ul>';
								foreach ($plugins as $plugin_path) {
									$plugin_base 		= plugin_basename($plugin_path);				
									// If the plugin isn't active, don't show it.
									if (!array_key_exists( $plugin_base, $active_plugins)) {
										continue;
									}				
									$plugin 			= get_plugin_data($plugin_path);				
									echo '<li>' . $plugin['Name'] . ' v' . $plugin['Version'] . "</li>";
								}
								echo '</ul></td>';			
							};
						echo '</table>';
					echo '</div>';
				echo '</div>';
				// Visual Composer Extensions Info			
				echo '<div class="ts-vcsc-section-main">';
					echo '<div class="ts-vcsc-section-title ts-vcsc-section-hide"><i class="dashicons-nametag"></i>Composium - Visual Composer Extensions Info</div>';
					echo '<div class="ts-vcsc-section-content slideFade" style="display: none;">';
						echo '<table class="ts-vcsc-system-information-table" style="width: 100%;">';
							if (defined('WPB_VC_VERSION')){
								echo '<tr><td>Visual Composer:</td><td>v' . WPB_VC_VERSION . '</td></tr>';
							}
							echo '<tr><td>Standalone Visual Composer:</td><td>' . $wpbakery . '</td></tr>';
							echo '<tr><td>Visual Composer Extensions:</td><td>' . $vcextensions . '</td></tr>';					
							if (is_multisite()) {
								echo '<tr><td>Network Activated:</td><td>' . (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") ? "Yes" : "No") . '</td></tr>';
							}
							echo '<tr><td>Available / Active Elements:</td><td>' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CountTotalElements . ' / ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CountActiveElements . '</td></tr>';
							if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorIconFontsInternal == "true") {
								$TS_VCSC_TotalIconFontsInstalled = (count($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts) + count($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Composer_Icon_Fonts));
							} else {
								$TS_VCSC_TotalIconFontsInstalled = count($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts);
							}	
							if (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') {
								echo '<tr><td>Available / Active Icon Fonts:</td><td>' . $TS_VCSC_TotalIconFontsInstalled . ' / ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Fonts . '</td></tr>';
							} else {
								echo '<tr><td>Available / Active Icon Fonts:</td><td>' . ($TS_VCSC_TotalIconFontsInstalled - 1) . ' / ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Fonts . '</td></tr>';
							}							
							echo '<tr><td>Available / Active Icons:</td><td>' . number_format($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Total_Icon_Count) . ' / ' . number_format($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Count) . '</td></tr>';
							echo '<tr><td>"Iconicum - WordPress Icon Fonts":</td><td>' . ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconicumStandard == "false") && (get_option('ts_vcsc_extend_settings_useIconGenerator', 0) == 1)) ? "Enabled" : "Disabled") . '</td></tr>';
							echo '<tr><td>"WooCommerce":</td><td>' . (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_WooCommerceActive == "true") ? "Active" : "Inactive") . '</td></tr>';
							echo '<tr><td>"bbPress":</td><td>' . (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_bbPressActive == "true") ? "Active" : "Inactive") . '</td></tr>';
							echo '<tr><td>Custom Post Types:</td><td>' . ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesLoaded == "true" ? "Active" : "Inactive") . '</td></tr>';
							echo '<tr><td>Extended Row Options:</td><td>' . ((get_option('ts_vcsc_extend_settings_additionsRows', 0) == 1) ? "Active" : "Inactive") . '</td></tr>';
							echo '<tr><td>Extended Column Options:</td><td>' . ((get_option('ts_vcsc_extend_settings_additionsColumns', 0) == 1) ? "Active" : "Inactive") . '</td></tr>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
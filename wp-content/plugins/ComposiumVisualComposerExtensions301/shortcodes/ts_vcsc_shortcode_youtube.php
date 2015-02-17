<?php
	add_shortcode('TS-VCSC-Youtube', 'TS_VCSC_Youtube_Function');
	function TS_VCSC_Youtube_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		wp_enqueue_script('ts-extend-hammer');
		wp_enqueue_script('ts-extend-nacho');
		wp_enqueue_style('ts-extend-nacho');
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-animations');
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
		
		extract( shortcode_atts( array(
			'content_type'					=> 'video',
			'content_youtube'				=> '',
			'content_playlist'				=> '',
			'content_search'				=> '',
			'content_combination'			=> '',
			'content_uploads'				=> '',
			'content_lightbox'				=> 'false',
			
			'content_image_responsive'		=> 'true',
			'content_image_height'			=> 'height: 100%;',
			'content_image_width_r'			=> 100,
			'content_image_width_f'			=> 300,
			'content_image_size'			=> 'large',
			
			'video_related'					=> 'false',
			'video_start'					=> 0,
			'video_end'						=> 0,
			
			'lightbox_group_name'			=> 'nachogroup',
			'lightbox_size'					=> 'full',
			'lightbox_effect'				=> 'random',
			'lightbox_speed'				=> 5000,
			'lightbox_social'				=> 'true',
			'lightbox_play'					=> 'false',
			'lightbox_backlight_auto'		=> 'true',
			'lightbox_backlight_color'		=> '#ffffff',			
			
			'content_youtube_start'			=> '',
			'content_youtube_end'			=> '',			
			'content_youtube_trigger'		=> 'preview',
			'content_youtube_title'			=> '',
			'content_youtube_subtitle'		=> '',
			'content_youtube_image'			=> '',
			'content_youtube_image_simple'	=> 'false',
			'content_youtube_icon'			=> '',
			'content_youtube_iconsize'		=> 30,
			'content_youtube_iconcolor' 	=> '#cccccc',
			'content_youtube_button'		=> '',
			'content_youtube_buttonstyle'	=> 'style1',
			'content_youtube_buttontext'	=> '',
			'content_youtube_text'			=> '',
			'content_raw'					=> '',
			
			'content_tooltip_html'			=> 'false',
			'content_tooltip_content'		=> '',
			'content_tooltip_encoded'		=> '',
			'content_tooltip_position'		=> 'ts-simptip-position-top',
			'content_tooltip_style'			=> '',
			'tooltipster_offsetx'			=> 0,
			'tooltipster_offsety'			=> 0,
			
			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id'							=> '',
			'el_class'						=> '',
			'css'							=> '',
		), $atts ));
	
		if (!empty($el_id)) {
			$modal_id						= $el_id;
		} else {
			$modal_id						= 'ts-vcsc-youtube-' . mt_rand(999999, 9999999);
		}

		// Tooltip
		if (($content_tooltip_position == "ts-simptip-position-top") || ($content_tooltip_position == "top")) {
			$content_tooltip_position		= "top";
		}
		if (($content_tooltip_position == "ts-simptip-position-left") || ($content_tooltip_position == "left")) {
			$content_tooltip_position		= "left";
		}
		if (($content_tooltip_position == "ts-simptip-position-right") || ($content_tooltip_position == "right")) {
			$content_tooltip_position		= "right";
		}
		if (($content_tooltip_position == "ts-simptip-position-bottom") || ($content_tooltip_position == "bottom")) {
			$content_tooltip_position		= "bottom";
		}
		if (($content_tooltip_style == "") || ($content_tooltip_style == "ts-simptip-style-black") || ($content_tooltip_style == "tooltipster-black")) {
			$content_tooltip_style			= "tooltipster-black";
		}
		if (($content_tooltip_style == "ts-simptip-style-gray") || ($content_tooltip_style == "tooltipster-gray")) {
			$content_tooltip_style			= "tooltipster-gray";
		}
		if (($content_tooltip_style == "ts-simptip-style-green") || ($content_tooltip_style == "tooltipster-green")) {
			$content_tooltip_style			= "tooltipster-green";
		}
		if (($content_tooltip_style == "ts-simptip-style-blue") || ($content_tooltip_style == "tooltipster-blue")) {
			$content_tooltip_style			= "tooltipster-blue";
		}
		if (($content_tooltip_style == "ts-simptip-style-red") || ($content_tooltip_style == "tooltipster-red")) {
			$content_tooltip_style			= "tooltipster-red";
		}
		if (($content_tooltip_style == "ts-simptip-style-orange") || ($content_tooltip_style == "tooltipster-orange")) {
			$content_tooltip_style			= "tooltipster-orange";
		}
		if (($content_tooltip_style == "ts-simptip-style-yellow") || ($content_tooltip_style == "tooltipster-yellow")) {
			$content_tooltip_style			= "tooltipster-yellow";
		}
		if (($content_tooltip_style == "ts-simptip-style-purple") || ($content_tooltip_style == "tooltipster-purple")) {
			$content_tooltip_style			= "tooltipster-purple";
		}
		if (($content_tooltip_style == "ts-simptip-style-pink") || ($content_tooltip_style == "tooltipster-pink")) {
			$content_tooltip_style			= "tooltipster-pink";
		}
		if (($content_tooltip_style == "ts-simptip-style-white") || ($content_tooltip_style == "tooltipster-white")) {
			$content_tooltip_style			= "tooltipster-white";
		}
		if ($content_tooltip_html == "false") {
			if (strlen($content_tooltip_content) != 0) {
				wp_enqueue_style('ts-extend-tooltipster');
				wp_enqueue_script('ts-extend-tooltipster');	
				$youtube_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$youtube_tooltipcontent 	= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($content_tooltip_content) . '" data-tooltipster-image="" data-tooltipster-position="' . $content_tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $content_tooltip_style . '" data-tooltipster-animation="swing" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$youtube_tooltipclasses		= "";
				$youtube_tooltipcontent		= "";
			}
		} else {
			if (strlen($content_tooltip_encoded) != 0) {
				wp_enqueue_style('ts-extend-tooltipster');
				wp_enqueue_script('ts-extend-tooltipster');	
				$youtube_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$youtube_tooltipcontent 	= 'data-tooltipster-html="true" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($content_tooltip_encoded) . '" data-tooltipster-image="" data-tooltipster-position="' . $content_tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $content_tooltip_style . '" data-tooltipster-animation="swing" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$youtube_tooltipclasses		= "";
				$youtube_tooltipcontent		= "";
			}
		}
		
		if ($lightbox_backlight_auto == "false") {
			$nacho_color					= 'data-backlight="' . $lightbox_backlight_color . '"';
		} else {
			$nacho_color					= '';
		}
		
		if ($content_image_responsive == "true") {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_r . '%; ' . $content_image_height . '';
		} else {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_f . 'px; ' . $content_image_height . '';
		}
		
		if ($lightbox_play == "true") {
			$video_autoplay					= ($content_type == 'video' ? '?autoplay=1' : '&autoplay=1');
		} else {
			$video_autoplay					= ($content_type == 'video' ? '?autoplay=0' : '&autoplay=0');
		}
		if ($video_related == "true") {
			$videos_related					= '&rel=1';
		} else {
			$videos_related					= '&rel=0';
		}
		if ($video_start > 0) {
			$videos_start					= '&start=' . $video_start;
		} else {
			$videos_start					= '';
		}
		if (($video_end > 0) && ($video_end > $video_start)) {
			$videos_end						= '&end=' . $video_end;
		} else {
			$videos_end						= '';
		}
		if ($content_type != 'video') {
			$content_youtube				= '#';
		}		
		$output								= '';

		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Youtube', $atts);
		} else {
			$css_class	= '';
		}
		
		// YouTube Video in Lightbox
		if ($content_lightbox == "true") {
			if ($content_type == 'combination') {
				$videos 					= explode(",", str_replace(' ', '', $content_combination));
				$count 						= count($videos);
				if ($count == 1) {
					$first 					= $content_combination;
					$other 					= '';
				} else if ($count > 1){
					$first 					= $videos[0];
					array_shift($videos);
					$other 					= implode(",", $videos);
				}
			} else {
				$first						= '';
				$other						= '';
			}
			$playlistdata					= 'data-contenttype="' . $content_type . '" data-listid="' . ($content_type == 'playlist' ? TS_VCSC_PlaylistID_Youtube($content_playlist) : '') . '" data-userid="' . ($content_type == 'uploads' ? $content_uploads : '') . '" data-videofirst="' . $first . '" data-videosother="' . $other . '" data-search="' . ($content_type == 'searchterm' ? str_replace(' ', '', $content_search) : '') . '"';
			if (($content_youtube_trigger == "preview") || ($content_youtube_trigger == "coverfirst")) {
				if ((preg_match('~((http|https|ftp|ftps)://|www.)(.+?)~', $content_youtube)) && ($content_youtube_trigger == "preview")) {
					$content_youtube		= $content_youtube;
				} else if (($content_youtube_trigger == "preview") && ($content_youtube_trigger == "preview")) {
					$content_youtube		= 'https://www.youtube.com/watch?v=' . $content_youtube;
				} else if (($content_youtube_trigger == "coverfirst") && ($content_type == 'combination')) {
					$content_youtube		= 'https://www.youtube.com/watch?v=' . $first;
				} else {
					$content_youtube		= '#';
				}
				if ($content_youtube != '#') {
					$modal_image 			= TS_VCSC_VideoImage_Youtube($content_youtube);
				} else {
					$modal_image 			= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				}
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}
			}			
			if ($content_youtube_trigger == "playcover") {
				if (($content_playlist != '') && ($content_type == 'playlist')) {
					$xmlfeed 				= (TS_VCSC_PlaylistImage_Youtube('http://gdata.youtube.com/feeds/api/playlists/' . TS_VCSC_PlaylistID_Youtube($content_playlist) . '', true));
				} else {
					$xmlfeed 				= array();
				}
				if ($xmlfeed != '') {
					if (isset($xmlfeed['FEED']['MEDIA:GROUP']['MEDIA:THUMBNAIL'][2]['URL'])) {
						$modal_image 		= $xmlfeed['FEED']['MEDIA:GROUP']['MEDIA:THUMBNAIL'][2]['URL'];
					} else if (isset($xmlfeed['FEED']['MEDIA:GROUP']['MEDIA:THUMBNAIL'][1]['URL'])) {
						$modal_image 		= $xmlfeed['FEED']['MEDIA:GROUP']['MEDIA:THUMBNAIL'][1]['URL'];
					} else if (isset($xmlfeed['FEED']['MEDIA:GROUP']['MEDIA:THUMBNAIL'][0]['URL'])) {
						$modal_image 		= $xmlfeed['FEED']['MEDIA:GROUP']['MEDIA:THUMBNAIL'][0]['URL'];
					} else {
						$modal_image 		= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
					}
				} else {
					$modal_image 			= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				}
				$content_youtube			= '#';
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}			
			}
			if ($content_youtube_trigger == "usercover") {
				if (($content_uploads != '') && ($content_type == 'uploads')) {
					$xmlfeed 				= (TS_VCSC_PlaylistImage_Youtube('http://gdata.youtube.com/feeds/api/users/' . $content_uploads . '?fields=yt:username,media:thumbnail', true));
				} else {
					$xmlfeed				= array();
				}
				if ($xmlfeed != '') {
					if (isset($xmlfeed['ENTRY']['MEDIA:THUMBNAIL']['URL'])) {
						$modal_image 		= $xmlfeed['ENTRY']['MEDIA:THUMBNAIL']['URL'];
					} else {
						$modal_image 		= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
					}
				} else {
					$modal_image 			= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				}
				$content_youtube			= '#';
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}			
			}
			if ($content_youtube_trigger == "default") {
				$modal_image = TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}
			}
			if ($content_youtube_trigger == "image") {
				$modal_image = wp_get_attachment_image_src($content_youtube_image, 'large');
				$modal_image = $modal_image[0];
				if ($content_youtube_image_simple == "false") {
					if ($youtube_tooltipcontent != '') {
						$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
							$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="width: 100%; height: 100%;">';
					} else {
							$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
					}
							$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
								$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
								$output .= '<div class="nchgrid-caption"></div>';
								if (!empty($content_youtube_title)) {
									$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
								}
							$output .= '</a>';
						$output .= '</div>';
					if ($youtube_tooltipcontent != '') {
						$output .= '</div>';
					}
				} else {
					$output .= '<a href="' . $content_youtube . '" class="' . $modal_id . '-parent nch-holder nch-lightbox-media ' . $youtube_tooltipclasses . ' ' . $css_class . '" ' . $youtube_tooltipcontent . ' style="' . $parent_dimensions . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-title="' . $content_youtube_title . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<img class="" src="' . $modal_image . '" style="display: block; ' . $image_dimensions . '">';
					$output .= '</a>';
				}
			}
			if ($content_youtube_trigger == "icon") {
				$icon_style = 'color: ' . $content_youtube_iconcolor . '; width:' . $content_youtube_iconsize . 'px; height:' . $content_youtube_iconsize . 'px; font-size:' . $content_youtube_iconsize . 'px; line-height:' . $content_youtube_iconsize . 'px;';
				$output .= '<div id="' . $modal_id . '" style="" class="' . $modal_id . '-parent nch-holder ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-center ' . $el_class . ' ' . $css_class . ' ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a class="ts-font-icons-link nch-lightbox-media" href="' . $content_youtube . '" target="_blank" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<i class="ts-font-icon ' . $content_youtube_icon . '" style="' . $icon_style . '"></i>';
					$output .= '</a>';
				$output .= '</div>';
			}
			if ($content_youtube_trigger == "winged") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<div class="ts-lightbox-button-1 clearFixMe">';
						$output .= '<div class="top">' . $content_youtube_title . '</div>';
						$output .= '<div class="bottom">' . $content_youtube_subtitle . '</div>';
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media icon" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="youtube">' . $content_youtube_buttontext . '</span></a>';
					$output .= '</div>';
				$output .= '</div>';
			}
			if ($content_youtube_trigger == "simple") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $youtube_tooltipclasses . ' ' . $css_class . '" ' . $youtube_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_youtube . '" class="ts-lightbox-button-2 icon nch-lightbox" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="youtube">' . $content_youtube_buttontext . '</span></a>';
				$output .= '</div>';
			}
			if ($content_youtube_trigger == "text") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . ' target="_blank">' . $content_youtube_text . '</a>';
				$output .= '</div>';
			}
			if ($content_youtube_trigger == "custom") {
				if ($content_raw != "") {
					$content_raw =  rawurldecode(base64_decode(strip_tags($content_raw)));
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox-media ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . 'style="" target="_blank">';
							$output .= $content_raw;
						$output .= '</a>';
					$output .= '</div>';
				}
			}
		}
		// Single Video in iFrame
		if (($content_type == "video") && ($content_lightbox == "false")) {
			$modal_image = TS_VCSC_VideoID_Youtube($content_youtube);
			$output .= '<div id="' . $modal_id . '" class="ts-video-container ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . '>';
				$output .= '<iframe width="100%" height="auto" src="//www.youtube.com/embed/' . $modal_image . $video_autoplay . $videos_start . $videos_end . $videos_related . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$output .= '</div>';
		}
		// Defined Playlist in iFrame
		if (($content_type == "playlist") && ($content_lightbox == "false")) {
			$output .= '<div id="' . $modal_id . '" class="ts-video-container">';
				$output .= '<iframe width="100%" height="auto" src="//www.youtube.com/embed?listType=playlist&list=' . TS_VCSC_PlaylistID_Youtube($content_playlist) . '&showinfo=1&' . $video_autoplay . $videos_related . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$output .= '</div>';
		}
		// Search Playlist in iFrame
		if (($content_type == "searchterm") && ($content_lightbox == "false")) {
			$output .= '<div id="' . $modal_id . '" class="ts-video-container">';
				$output .= '<iframe width="100%" height="auto" src="//www.youtube.com/embed?listType=search&list=' . str_replace(' ', '', $content_search) . '&showinfo=1' . $video_autoplay . $videos_related . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$output .= '</div>';
		}
		// Individual Videos Playlist in iFrame
		if (($content_type == "combination") && ($content_lightbox == "false")) {
			$videos 	= explode(",", str_replace(' ', '', $content_combination));
			$count 		= count($videos);
			if ($count == 1) {
				$iframe = '<iframe width="100%" height="auto" src="//www.youtube.com/embed/' . $content_combination . $video_autoplay . $videos_related . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			} else if ($count > 1){
				$first = $videos[0];
				array_shift($videos);
				$other = implode(",", $videos);
				$iframe = '<iframe width="100%" height="auto" src="//www.youtube.com/embed/' . $first . '?playlist=' . $other . '&showinfo=1' . $video_autoplay . $videos_related . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			}
			$output .= '<div id="' . $modal_id . '" class="ts-video-container">';
				$output .= $iframe;
			$output .= '</div>';
		}
		// Playlist from User Uploads in iFrame
		if (($content_type == "uploads") && ($content_lightbox == "false")) {
			$output .= '<div id="' . $modal_id . '" class="ts-video-container">';
				$output .= '<iframe width="100%" height="auto" src="//www.youtube.com/embed?listType=user_uploads&list=' . $content_uploads . '&showinfo=1' . $video_autoplay . $videos_related . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$output .= '</div>';
		}

		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
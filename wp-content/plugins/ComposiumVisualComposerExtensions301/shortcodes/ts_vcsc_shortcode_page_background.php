<?php
	add_shortcode('TS_VCSC_Page_Background', 'TS_VCSC_Page_Background_Function');
	function TS_VCSC_Page_Background_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
			$frontend					= "true";
		} else {
			$frontend					= "false";
		}
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}
		
		extract( shortcode_atts( array(
			'type'						=> 'image',
			'video_youtube'				=> '',
			'video_mute'				=> 'true',
			'video_loop'				=> 'false',
			'video_start'				=> 'false',
			'video_stop'				=> 'true',
			'video_controls'			=> 'true',
			'video_raster'				=> 'false',
			
			'video_mp4'					=> '',
			'video_ogv'					=> '',
			'video_webm'				=> '',
			'video_image'				=> '',
			
			'fixed_image'				=> '',
			
			'raster_use'				=> 'false',
			'raster_type'				=> '',
			
			'overlay_use'				=> 'false',
			'overlay_color'				=> 'rgba(30,115,190,0.25)',
			'overlay_opacity'			=> 25,
			
			'el_id' 					=> '',
			'el_class'                  => '',
			'css'						=> '',
		), $atts ));
		
		if (!empty($el_id)) {
			$background_id				= $el_id;
		} else {
			$background_id				= 'ts-vcsc-pageback-' . mt_rand(999999, 9999999);
		}
		
		if ($type == "youtube") {
			wp_enqueue_style('ts-extend-ytplayer');
			wp_enqueue_script('ts-extend-ytplayer');
		} else if ($type == "video") {
			wp_enqueue_style('ts-font-mediaplayer');
			wp_enqueue_style('ts-extend-wallpaper');
			wp_enqueue_script('ts-extend-wallpaper');
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Page_Background', $atts);
		} else {
			$css_class	= '';
		}

		if ($type == "image") {
			$image_path 				= wp_get_attachment_image_src($fixed_image, 'full');
			$image_path					= $image_path[0];
			if (($raster_use == "true") && ($raster_type != '')) {
				$raster_content			= '<div class="ts-background-raster" style="background-image: url(' . $raster_type . ');"></div>';
			} else {
				$raster_content			= '';
			}
			if (($overlay_use == "true") && ($overlay_color != '')) {
				$overlay_content		= '<div class="ts-background-overlay" style="background: ' . $overlay_color . ';"></div>';
			} else {
				$overlay_content		= '';
			}			
			if ($frontend == "true") {
				$output = '<div id="' . $background_id . '" class="ts-pageback-image-edit ' . $css_class . ' ' . $el_class . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-image="' . $image_path . '" data-controls="' . $video_controls . '" data-raster="' . $video_raster . '">';
					$output .= '<img class="ts-background-image-holder-edit" src="' . $image_path . '">';
					$output .= '<div class="ts-pageback-title">TS Page Background</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "Background Type", "ts_visual_composer_extend" ) . ': ' . __( "Fixed Image", "ts_visual_composer_extend" ) . '</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "Background Image", "ts_visual_composer_extend" ) . ': ' . $fixed_image . '</div>';
				$output .= '</div>';
			} else {
				$output = '<div id="' . $background_id . '" class="ts-pageback-image ' . $css_class . ' ' . $el_class . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-image="' . $image_path . '" data-controls="' . $video_controls . '" data-raster="' . $video_raster . '">';
					$output .= '<img class="ts-background-image-holder" src="' . $image_path . '">';
					$output .= $overlay_content;
					$output .= $raster_content;
				$output .= '</div>';
			}
		} else if ($type == "youtube") {
			if (preg_match('~((http|https|ftp|ftps)://|www.)(.+?)~', $video_youtube)) {
				$content_youtube		= $video_youtube;
			} else {
				$content_youtube		= 'https://www.youtube.com/watch?v=' . $video_youtube;
			}
			$youtube_image 				= TS_VCSC_VideoImage_Youtube($content_youtube);
			if ($frontend == "true") {
				$output = '<div id="' . $background_id . '" class="ts-pageback-image-edit ' . $css_class . ' ' . $el_class . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-raster="' . $raster_type . '" data-overlay="' . $overlay_color . '" data-image="' . $youtube_image . '" data-controls="' . $video_controls . '" data-raster="' . $video_raster . '">';
					if ($youtube_image != '') {
						$output .= '<img class="ts-background-image-holder-edit" src="' . $youtube_image . '">';
					}
					$output .= '<div class="ts-pageback-title">TS Page Background</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "Background Type", "ts_visual_composer_extend" ) . ': ' . __( "YouTube Video", "ts_visual_composer_extend" ) . '</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "YouTube Video ID", "ts_visual_composer_extend" ) . ': ' . $video_youtube . '</div>';
				$output .= '</div>';
			} else {
				$output = '<div id="' . $background_id . '" class="ts-pageback-youtube ' . $css_class . ' ' . $el_class . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-image="' . $youtube_image . '" data-video="' . $video_youtube . '" data-controls="' . $video_controls . '" data-start="' . $video_start . '" data-raster="' . $video_raster . '" data-mute="' . $video_mute . '" data-loop="' . $video_loop . '"></div>';
			}
		} else if ($type == "video") {
			if ($video_image != '') {
				$image_path 			= wp_get_attachment_image_src($video_image, 'full');
				$image_path				= $image_path[0];
			} else {
				$image_path				= '';
			}
			if ($frontend == "true") {
				$output = '<div id="' . $background_id . '" class="ts-pageback-image-edit ' . $css_class . ' ' . $el_class . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-raster="' . $raster_type . '" data-overlay="' . $overlay_color . '" data-image="' . $image_path . '" data-controls="' . $video_controls . '" data-raster="' . $video_raster . '">';
					if ($image_path != '') {
						$output .= '<img class="ts-background-image-holder-edit" src="' . $image_path . '">';
					}
					$output .= '<div class="ts-pageback-title">TS Page Background</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "Background Type", "ts_visual_composer_extend" ) . ': ' . __( "Selfhosted Video", "ts_visual_composer_extend" ) . '</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "MP4 Video", "ts_visual_composer_extend" ) . ': ' . $video_mp4 . '</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "WEBM Video", "ts_visual_composer_extend" ) . ': ' . $video_webm . '</div>';
					$output .= '<div class="ts-pageback-notes">' . __( "OGV Video", "ts_visual_composer_extend" ) . ': ' . $video_ogv . '</div>';
				$output .= '</div>';
			} else {
				$output = '<div id="' . $background_id . '" class="ts-pageback-video ' . $css_class . ' ' . $el_class . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-raster="' . ((($raster_use == "true") && ($raster_type != '')) ? $raster_type : "") . '" data-overlay="' . ((($overlay_use == "true") && ($overlay_color != '')) ? $overlay_color : "") . '" data-mp4="' . $video_mp4 . '" data-ogv="' . $video_ogv . '" data-webm="' . $video_webm . '" data-image="' . $image_path . '" data-controls="' . $video_controls . '" data-start="' . $video_start . '" data-raster="' . $video_raster . '" data-mute="' . $video_mute . '" data-loop="' . $video_loop . '">';
					$output .= '<div class="ts-background-video-holder"></div>';
				$output .= '</div>';
			}
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_TS_VCSC_Page_Background extends WPBakeryShortCode {};
	}
?>
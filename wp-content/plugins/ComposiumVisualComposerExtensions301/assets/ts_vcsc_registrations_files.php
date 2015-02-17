<?php
    global $VISUAL_COMPOSER_EXTENSIONS;
    $url = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
    // Check if files should be loaded in HEAD or BODY
    if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) 	        { $FOOTER = true; } else { $FOOTER = false; }

    // Internal Files
    // --------------
    // Front-End Files
    wp_register_style('ts-visual-composer-extend-front',						$url.'css/ts-visual-composer-extend-front.min.css', null, false, 'all');
    wp_register_script('ts-visual-composer-extend-front',						$url.'js/ts-visual-composer-extend-front.min.js', array('jquery'), false, $FOOTER);			
    wp_register_style('ts-visual-composer-extend-demos',						$url.'css/ts-visual-composer-extend-demos.min.css', null, false, 'all');
    wp_register_script('ts-visual-composer-extend-demos',						$url.'js/ts-visual-composer-extend-demos.min.js', array('jquery'), false, $FOOTER);
    // General Animations Files
    wp_register_style('ts-extend-animations',                 					$url.'css/ts-visual-composer-extend-animations.min.css', null, false, 'all');
    // General Settings Files
    wp_register_style('ts-vcsc-extend',                              			$url.'css/ts-visual-composer-extend-settings.min.css', null, false, 'all');
    wp_register_script('ts-vcsc-extend', 										$url.'js/ts-visual-composer-extend-settings.min.js', array('jquery'), false, true);
    // Post Type Settings Files
    wp_register_script('ts-extend-posttypes', 									$url.'js/ts-visual-composer-extend-posttypes.min.js', array('jquery'), false, true);
    wp_register_style('ts-extend-posttypes',									$url.'css/ts-visual-composer-extend-posttypes.min.css', null, false, 'all');
    // Plugin Admin Files
    wp_register_style('ts-visual-composer-extend-admin',             			$url.'css/ts-visual-composer-extend-admin.min.css', null, false, 'all');
    wp_register_script('ts-visual-composer-extend-admin',            			$url.'js/ts-visual-composer-extend-admin.min.js', array('jquery'), false, true);
    // Iconicum Generator Files
    wp_register_style('ts-visual-composer-extend-generator',					$url.'css/ts-visual-composer-extend-generator.min.css', null, false, 'all');
    wp_register_script('ts-visual-composer-extend-generator',					$url.'js/ts-visual-composer-extend-generator.min.js', array('wp-color-picker'), false, true);
    // Textillate Animations Files
    wp_register_style('ts-extend-textillate',                 					$url.'css/ts-visual-composer-extend-textillate.min.css', null, false, 'all');
    // E-Commerce Font
    wp_register_style('ts-font-ecommerce',                 						$url.'css/ts-font-ecommerce.css', null, false, 'all');
    // Teammate Font
    wp_register_style('ts-font-teammates',                 						$url.'css/ts-font-teammates.css', null, false, 'all');
    // Mediaplayer Font
    wp_register_style('ts-font-mediaplayer',                 					$url.'css/ts-font-mediaplayer.css', null, false, 'all');
    // Icon Font Files
    foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
        if ($iconfont != "Custom") {
            wp_register_style('ts-font-' . strtolower($iconfont),				$url.'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
        } else if ($iconfont == "Custom") {
            $Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
            wp_register_style('ts-font-' . strtolower($iconfont) . 'vcsc', 		$Custom_Font_CSS, null, false, 'all');
        }
    }
    
    // 3rd Party Files
    // ---------------
    // Lightbox
    wp_register_style('ts-extend-nacho',										$url.'css/jquery.vcsc.nchlightbox.min.css', null, false, 'all');
    wp_register_script('ts-extend-hammer', 										$url.'js/jquery.vcsc.hammer.min.js', array('jquery'), false, $FOOTER);
    wp_register_script('ts-extend-nacho', 										$url.'js/jquery.vcsc.nchlightbox.min.js', array('jquery'), false, $FOOTER);
    // Textillate
    wp_register_script('ts-extend-textillate',									$url.'js/jquery.vcsc.textillate.min.js', array('jquery'), false, $FOOTER);
    // Simptip Tooltips
    wp_register_style('ts-extend-simptip',                 						$url.'css/jquery.vcsc.simptip.min.css', null, false, 'all');
    // Hint Tooltips
    wp_register_style('ts-extend-hint',                 						$url.'css/jquery.vcsc.hint.min.css', null, false, 'all');
    // iHover Effects
    wp_register_style('ts-extend-ihover',                 						$url.'css/jquery.vcsc.ihover.min.css', null, false, 'all');
    wp_register_script('ts-extend-ihover',										$url.'js/jquery.vcsc.ihover.min.js', array('jquery'), false, $FOOTER);
    // Google Charts API
    wp_register_script('ts-extend-google-charts',								'https://www.google.com/jsapi', array('jquery'), false, false);
    // Google Maps API
    wp_register_script('ts-extend-mapapi-none',									'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places', false, false, false);
    wp_register_script('ts-extend-mapapi-geo',									'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places', false, false, false);
    // Custom Google Map Scripts
    wp_register_script('ts-extend-infobox', 									$url.'js/jquery.vcsc.infobox.min.js', array('jquery'), false, $FOOTER);
    wp_register_script('ts-extend-googlemap', 									$url.'js/jquery.vcsc.googlemap.min.js', array('jquery'), false, $FOOTER);
    // Modernizr
    wp_register_script('ts-extend-modernizr',                					$url.'js/jquery.vcsc.modernizr.min.js', array('jquery'), false, false);
    // Waypoints
    wp_register_script('ts-extend-waypoints',									$url.'js/jquery.vcsc.waypoints.min.js', array('jquery'), false, $FOOTER);	
    // Tooltipster Tooltips
    wp_register_style('ts-extend-tooltipster',                 					$url.'css/jquery.vcsc.tooltipster.min.css', null, false, 'all');
    wp_register_script('ts-extend-tooltipster',									$url.'js/jquery.vcsc.tooltipster.min.js', array('jquery'), false, $FOOTER);			
    // YouTube Player
    wp_register_style('ts-extend-ytplayer',										$url.'css/jquery.vcsc.mb.ytplayer.min.css', null, false, 'all');
    wp_register_script('ts-extend-ytplayer',									$url.'js/jquery.vcsc.mb.ytplayer.min.js', array('jquery'), false, false);
    // CountUp Counter
    wp_register_script('ts-extend-countup',										$url.'js/jquery.vcsc.countup.min.js', array('jquery'), false, $FOOTER);
    // CountTo Counter
    wp_register_script('ts-extend-countto',										$url.'js/jquery.vcsc.countto.min.js', array('jquery'), false, $FOOTER);
    // Circliful Counter
    wp_register_script('ts-extend-circliful', 									$url.'js/jquery.vcsc.circliful.min.js', array('jquery'), false, $FOOTER);
    // Countdown Script
    wp_register_style('ts-extend-countdown',									$url.'css/jquery.vcsc.counteverest.min.css', null, false, 'all');
    wp_register_script('ts-extend-countdown',									$url.'js/jquery.vcsc.counteverest.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-font-roboto',									'http://fonts.googleapis.com/css?family=Roboto:400', null, false, 'all');
    wp_register_style('ts-extend-font-unica',									'http://fonts.googleapis.com/css?family=Unica+One', null, false, 'all');
    // Buttons CSS
    wp_register_style('ts-extend-buttons',                 						$url.'css/jquery.vcsc.buttons.min.css', null, false, 'all');
    // Buttons Flat CSS
    wp_register_style('ts-extend-buttonsflat',                 					$url.'css/jquery.vcsc.buttons.flat.min.css', null, false, 'all');
    // Buttons Dual CSS
    wp_register_style('ts-extend-buttonsdual',                 					$url.'css/jquery.vcsc.buttons.dual.min.css', null, false, 'all');
    // Badonkatrunc Shortener
    wp_register_script('ts-extend-badonkatrunc',								$url.'js/jquery.vcsc.badonkatrunc.min.js', array('jquery'), false, $FOOTER);
    // QR-Code Maker
    wp_register_script('ts-extend-qrcode',										$url.'js/jquery.vcsc.qrcode.min.js', array('jquery'), false, $FOOTER);
    // Image Adipoli
    wp_register_script('ts-extend-adipoli', 									$url.'js/jquery.vcsc.adipoli.min.js', array('jquery'), false, $FOOTER);
    // Amaran Popup
    wp_register_style('ts-extend-amaran',				        				$url.'css/jquery.vcsc.amaran.min.css', null, false, 'all');
    wp_register_script('ts-extend-amaran',			            				$url.'js/jquery.vcsc.amaran.min.js', array('jquery'), false, $FOOTER);
    // Image Caman
    wp_register_script('ts-extend-caman', 										$url.'js/jquery.vcsc.caman.full.min.js', array('jquery'), false, $FOOTER);
    // Owl Carousel 2
    wp_register_style('ts-extend-owlcarousel2',				        			$url.'css/jquery.vcsc.owl.carousel.min.css', null, false, 'all');
    wp_register_script('ts-extend-owlcarousel2',			            		$url.'js/jquery.vcsc.owl.carousel.min.js', array('jquery'), false, $FOOTER);			
    // Flex Slider 2
    wp_register_style('ts-extend-flexslider2',				        			$url.'css/jquery.vcsc.flexslider.min.css', null, false, 'all');
    wp_register_script('ts-extend-flexslider2',			            			$url.'js/jquery.vcsc.flexslider.min.js', array('jquery'), false, $FOOTER);
    // Nivo Slider
    wp_register_style('ts-extend-nivoslider',				        			$url.'css/jquery.vcsc.nivoslider.min.css', null, false, 'all');	
    wp_register_script('ts-extend-nivoslider',			            			$url.'js/jquery.vcsc.nivoslider.min.js', array('jquery'), false, $FOOTER);
    // SliceBox Slider
    wp_register_style('ts-extend-slicebox',				        				$url.'css/jquery.vcsc.slicebox.min.css', null, false, 'all');
    wp_register_script('ts-extend-slicebox',			            			$url.'js/jquery.vcsc.slicebox.min.js', array('jquery'), false, $FOOTER);
    // Stack Slider
    wp_register_style('ts-extend-stackslider',				        			$url.'css/jquery.vcsc.stackslider.min.css', null, false, 'all');
    wp_register_script('ts-extend-stackslider',			            			$url.'js/jquery.vcsc.stackslider.min.js', array('jquery'), false, $FOOTER);
    // DropDown Script
    wp_register_style('ts-extend-dropdown', 									$url.'css/jquery.vcsc.dropdown.min.css', null, false, 'all');
    wp_register_script('ts-extend-dropdown', 									$url.'js/jquery.vcsc.dropdown.min.js', array('jquery'), false, true);
    // Isotope Script
    wp_register_script('ts-extend-isotope',										$url.'js/jquery.vcsc.isotope.min.js', array('jquery'), false, $FOOTER);
    // Parallaxify Script
    wp_register_script('ts-extend-parallaxify',									$url.'js/jquery.vcsc.parallaxify.min.js', array('jquery'), false, $FOOTER);
    // NewsTicker
    wp_register_script('ts-extend-newsticker',			            			$url.'js/jquery.vcsc.newsticker.min.js', array('jquery'), false, $FOOTER);
    // vTicker
    wp_register_script('ts-extend-vticker',			            				$url.'js/jquery.vcsc.vticker.min.js', array('jquery'), false, $FOOTER);
    // Typed
    wp_register_script('ts-extend-typed',			            				$url.'js/jquery.vcsc.typed.min.js', array('jquery'), false, $FOOTER);
    // Raphaël
    wp_register_script('ts-extend-raphael',			            				$url.'js/jquery.vcsc.raphael.min.js', array('jquery'), false, $FOOTER);
    // Mousewheel
    wp_register_script('ts-extend-mousewheel',			            			$url.'js/jquery.vcsc.mousewheel.min.js', array('jquery'), false, $FOOTER);
    // Snap SVG
    wp_register_script('ts-extend-snapsvg',			            				$url.'js/jquery.vcsc.snap.svg.min.js', array('jquery'), false, $FOOTER);
    // iPresenter Script
    wp_register_style('ts-extend-ipresenter', 									$url.'css/jquery.vcsc.ipresenter.min.css', null, false, 'all');
    wp_register_script('ts-extend-ipresenter', 									$url.'js/jquery.vcsc.ipresenter.min.js', array('jquery'), false, true);
    // Image Hover Effects
    wp_register_style('ts-extend-hovereffects', 								$url.'css/jquery.vcsc.hovereffects.min.css', null, false, 'all');
    // Zoomer Script
    wp_register_style('ts-extend-zoomer', 										$url.'css/jquery.vcsc.zoomer.min.css', null, false, 'all');
    wp_register_script('ts-extend-zoomer', 										$url.'js/jquery.vcsc.zoomer.min.js', array('jquery'), false, true);
    // Wallpaper Script
    wp_register_style('ts-extend-wallpaper', 									$url.'css/jquery.vcsc.wallpaper.min.css', null, false, 'all');
    wp_register_script('ts-extend-wallpaper', 									$url.'js/jquery.vcsc.wallpaper.min.js', array('jquery'), false, true);
    // Flipboard Title
    wp_register_script('ts-extend-flipflap',			            			$url.'js/jquery.vcsc.flipflap.min.js', array('jquery'), false, $FOOTER);
    
    // Back-End Files
    // --------------
    // NoUiSlider
    wp_register_style('ts-extend-nouislider',									$url.'css/jquery.vcsc.nouislider.min.css', null, false, 'all');
    wp_register_script('ts-extend-nouislider',									$url.'js/jquery.vcsc.nouislider.min.js', array('jquery'), false, true);
    // MultiSelect
    wp_register_style('ts-extend-multiselect',									$url.'css/jquery.vcsc.multi.select.min.css', null, false, 'all');
    wp_register_script('ts-extend-multiselect',									$url.'js/jquery.vcsc.multi.select.min.js', array('jquery'), false, true);
    // Toggles / Switch
    wp_register_script('ts-extend-toggles',										$url.'js/jquery.vcsc.toggles.min.js', array('jquery'), false, true);
    // Freewall
    wp_register_script('ts-extend-freewall', 									$url.'js/jquery.vcsc.freewall.min.js', array('jquery'), false, true);
    // Date & Time Picker
    wp_register_script('ts-extend-picker',										$url.'js/jquery.vcsc.datetimepicker.min.js', array('jquery'), false, true);
    // Lightbox Me
    wp_register_script('ts-extend-lightboxme',									$url.'js/jquery.vcsc.lightboxme.min.js', array('jquery', 'wp-color-picker'), false, true);
    // ZeroClipboard
    wp_register_script('ts-extend-zclip',										$url.'js/jquery.vcsc.zeroclipboard.min.js', array('jquery'), false, true);
    // Rainbow Syntax
    wp_register_script('ts-extend-rainbow',										$url.'js/jquery.vcsc.rainbow.min.js', array('jquery'), false, true);
    // Messi Popup
    wp_register_style('ts-extend-messi', 				        				$url.'css/jquery.vcsc.messi.min.css', null, false, 'all');
    wp_register_script('ts-extend-messi',                            			$url.'js/jquery.vcsc.messi.min.js', array('jquery'), false, true);
    // DragSort
    wp_register_script('ts-extend-dragsort',									$url.'js/jquery.vcsc.dragsort.min.js', array('jquery'), false, true);
    // ToTop Scroller
    wp_register_style('ts-extend-uitotop', 										$url.'css/jquery.vcsc.ui.totop.min.css', null, false, 'all');
    wp_register_script('ts-extend-uitotop', 									$url.'js/jquery.vcsc.ui.totop.min.js', array('jquery'), false, true);
    // jQuery Easing
    wp_register_script('jquery-easing', 										$url.'js/jquery.vcsc.easing.min.js', array('jquery'), false, true);
    // Select 2
    wp_register_style('ts-extend-select2',										$url.'css/jquery.vcsc.select2.min.css', null, false, 'all');
    wp_register_script('ts-extend-select2',										$url.'js/jquery.vcsc.select2.min.js', array('jquery'), false, true);
    // Validation Engine
    wp_register_script('validation-engine', 									$url.'js/jquery.vcsc.validationengine.min.js', array('jquery'), false, true);
    wp_register_style('validation-engine',										$url.'css/jquery.vcsc.validationengine.min.css', null, false, 'all');
    wp_register_script('validation-engine-en', 									$url.'js/jquery.vcsc.validationengine.en.min.js', array('jquery'), false, true);
    
    // Visual Composer Backbone
    wp_register_script('ts-vcsc-backend-rows',									$url.'js/backend/ts-vcsc-backend-rows.min.js', array('jquery'), false, true);
    wp_register_script('ts-vcsc-backend-other',									$url.'js/backend/ts-vcsc-backend-other.min.js', array('jquery'), false, true);
    // Visual Composer Styling
    if (defined('WPB_VC_VERSION')){
        if (TS_VCSC_VersionCompare(WPB_VC_VERSION, '4.3.0') >= 0) {
            wp_register_style('ts-visual-composer-extend-composer',				$url.'css/ts-visual-composer-extend-composer-new.min.css', null, false, 'all');
        } else {
            wp_register_style('ts-visual-composer-extend-composer',				$url.'css/ts-visual-composer-extend-composer-old.min.css', null, false, 'all');
        }
    } else {
        wp_register_style('ts-visual-composer-extend-composer',					$url.'css/ts-visual-composer-extend-composer-old.min.css', null, false, 'all');
    }
    wp_register_style('ts-visual-composer-extend-preview',						$url.'css/ts-visual-composer-extend-preview.min.css', null, false, 'all');
?>
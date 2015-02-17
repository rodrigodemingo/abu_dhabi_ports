<?php
    if (function_exists('vc_map')) {
		global $VISUAL_COMPOSER_EXTENSIONS;
        vc_map( array(
            "name"                          => __( "TS Lightbox Image", "ts_visual_composer_extend" ),
            "base"                          => "TS-VCSC-Lightbox-Image",
            "icon" 	                        => "icon-wpb-ts_vcsc_lightbox_image",
            "class"                         => "ts_vcsc_main_lightbox_image",
            "category"                      => __( "VC Extensions", "ts_visual_composer_extend" ),
            "description"                   => __("Place an image in a lightbox element", "ts_visual_composer_extend"),
            "admin_enqueue_js"              => "",
            "admin_enqueue_css"             => "",
            "params"                        => array(
                // Single Image Content
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "ts_visual_composer_extend" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Lightbox Image",
                    "description"           => __( "", "ts_visual_composer_extend" )
                ),
				array(
                    "type"                  => "attach_image",
					"holder" 				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "img" : ""),
                    "heading"               => __( "Select Image", "ts_visual_composer_extend" ),
                    "param_name"            => "content_image",
					"class"					=> "ts_vcsc_holder_image",
                    "value"                 => "",
                    "admin_label"           => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
					"description"           => __( "Select the image for your lightbox.", "ts_visual_composer_extend" ),
					"dependency"            => ""
				),
				array(
					"type"                  => "dropdown",
					"heading"               => __( "Preview Image Source", "ts_visual_composer_extend" ),
					"param_name"            => "content_image_size",
					"width"                 => 150,
					"value"                 => array(
						__( 'Medium Size Image', "ts_visual_composer_extend" )		=> "medium",
						__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
						__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
					),
					"admin_label"           => true,
					"description"           => __( "Select which image size based on WordPress settings should be used for the preview image.", "ts_visual_composer_extend" ),
					"dependency"            => ""
				),
				array(
					"type"                  => "dropdown",
					"heading"               => __( "Lightbox Image Source", "ts_visual_composer_extend" ),
					"param_name"            => "lightbox_size",
					"width"                 => 150,
					"value"                 => array(
						__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
						__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
						__( 'Medium Size Image', "ts_visual_composer_extend" )		=> "medium",
					),
					"admin_label"           => true,
					"description"           => __( "Select which image size based on WordPress settings should be used for the lightbox image.", "ts_visual_composer_extend" ),
					"dependency"            => ""
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Enter TITLE Attribute", "ts_visual_composer_extend" ),
                    "param_name"            => "content_title",
                    "value"                 => "",
                    "description"           => __( "Enter a title for the lightbox image.", "ts_visual_composer_extend" ),
                    "dependency"            => ""
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Add Custom ALT Attribute", "ts_visual_composer_extend" ),
					"param_name"		    => "attribute_alt",
					"value"				    => "false",
					"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"					=> __( 'No', "ts_visual_composer_extend" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want add a custom ALT attribute value, otherwise file name will be set.", "ts_visual_composer_extend" ),
					"dependency"        	=> ""
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Enter ALT Attribute", "ts_visual_composer_extend" ),
                    "param_name"            => "attribute_alt_value",
                    "value"                 => "",
                    "description"           => __( "Enter a custom value for the ALT attribute for this image.", "ts_visual_composer_extend" ),
                    "dependency"            => array( 'element' => "attribute_alt", 'value' => 'true' )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Responsive Image", "ts_visual_composer_extend" ),
					"param_name"		    => "content_image_responsive",
					"value"				    => "true",
					"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"					=> __( 'No', "ts_visual_composer_extend" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want to use a responsive image size.", "ts_visual_composer_extend" ),
					"dependency"        	=> ""
				),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Auto Height Setting", "ts_visual_composer_extend" ),
                    "param_name"            => "content_image_height",
                    "width"                 => 150,
                    "value"                 => array(
                        __( '100% Height Setting', "ts_visual_composer_extend" )		=> "height: 100%;",
                        __( 'Auto Height Setting', "ts_visual_composer_extend" )     	=> "height: auto;",
                    ),
                    "description"           => __( "Select what CSS height setting should be applied to the image (change only if image height does not display correctly).", "ts_visual_composer_extend" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Width", "ts_visual_composer_extend" ),
                    "param_name"            => "content_image_width_r",
                    "value"                 => "100",
                    "min"                   => "1",
                    "max"                   => "100",
                    "step"                  => "1",
                    "unit"                  => '%',
                    "description"           => __( "Define the image width in percent (%).", "ts_visual_composer_extend" ),
                    "dependency"            => array( 'element' => "content_image_responsive", 'value' => 'true' )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Width", "ts_visual_composer_extend" ),
                    "param_name"            => "content_image_width_f",
                    "value"                 => "300",
                    "min"                   => "1",
                    "max"                   => "1980",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Define the image width in pixel (px).", "ts_visual_composer_extend" ),
                    "dependency"            => array( 'element' => "content_image_responsive", 'value' => 'false' )
                ),
                // Lightbox Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "ts_visual_composer_extend" ),
                    "param_name"            => "seperator_2",
                    "value"                 => "Lightbox Settings",
                    "description"           => __( "", "ts_visual_composer_extend" )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Create AutoGroup", "ts_visual_composer_extend" ),
					"param_name"		    => "lightbox_group",
					"value"				    => "true",
					"on"					=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"					=> __( 'No', "ts_visual_composer_extend" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want the plugin to group this image with all other non-gallery images on the page.", "ts_visual_composer_extend" ),
					"dependency"        	=> ""
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Group Name", "ts_visual_composer_extend" ),
                    "param_name"            => "lightbox_group_name",
                    "value"                 => "",
                    "admin_label"           => true,
                    "description"           => __( "Enter a custom group name to manually build group with other non-gallery items.", "ts_visual_composer_extend" ),
                    "dependency"            => array( 'element' => "lightbox_group", 'value' => 'false' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Transition Effect", "ts_visual_composer_extend" ),
                    "param_name"            => "lightbox_effect",
                    "width"                 => 150,
                    "value"                 => array(
						__( 'Random', "ts_visual_composer_extend" )       	=> "random",
						__( 'Swipe', "ts_visual_composer_extend" )        	=> "swipe",
						__( 'Fade & Swipe', "ts_visual_composer_extend" )	=> "fade",
						__( 'Scale', "ts_visual_composer_extend" )        	=> "scale",
						__( 'Slide Up', "ts_visual_composer_extend" )     	=> "slideUp",
						__( 'Slide Down', "ts_visual_composer_extend" )   	=> "slideDown",
						__( 'Flip', "ts_visual_composer_extend" )         	=> "flip",
						__( 'Skew', "ts_visual_composer_extend" )         	=> "skew",
						__( 'Bounce Up', "ts_visual_composer_extend" )    	=> "bounceUp",
						__( 'Bounce Down', "ts_visual_composer_extend" )  	=> "bounceDown",
						__( 'Break In', "ts_visual_composer_extend" )     	=> "breakIn",
						__( 'Rotate In', "ts_visual_composer_extend" )    	=> "rotateIn",
						__( 'Rotate Out', "ts_visual_composer_extend" )   	=> "rotateOut",
						__( 'Hang Left', "ts_visual_composer_extend" )    	=> "hangLeft",
						__( 'Hang Right', "ts_visual_composer_extend" )   	=> "hangRight",
						__( 'Cycle Up', "ts_visual_composer_extend" )     	=> "cicleUp",
						__( 'Cycle Down', "ts_visual_composer_extend" )   	=> "cicleDown",
						__( 'Zoom In', "ts_visual_composer_extend" )      	=> "zoomIn",
						__( 'Throw In', "ts_visual_composer_extend" )     	=> "throwIn",
						__( 'Fall', "ts_visual_composer_extend" )         	=> "fall",
						__( 'Jump', "ts_visual_composer_extend" )         	=> "jump",
                    ),
                    "admin_label"           => true,
                    "description"           => __( "Select the transition effect to be used for the image in the lightbox.", "ts_visual_composer_extend" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Backlight Effect", "ts_visual_composer_extend" ),
                    "param_name"            => "lightbox_backlight",
                    "width"                 => 150,
                    "value"                 => array(
						__( 'Auto Color', "ts_visual_composer_extend" )       											=> "auto",
						__( 'Custom Color', "ts_visual_composer_extend" )     											=> "custom",
						__( 'No Backlight (only for simple Black Lightbox Overlay)', "ts_visual_composer_extend" )     	=> "hideit",
                    ),
                    "admin_label"           => true,
                    "description"           => __( "Select the backlight effect for the image.", "ts_visual_composer_extend" ),
                    "dependency"            => ""
                ),
				array(
					"type"                  => "colorpicker",
					"heading"               => __( "Custom Backlight Color", "ts_visual_composer_extend" ),
					"param_name"            => "lightbox_backlight_color",
					"value"                 => "#ffffff",
					"description"           => __( "Define the backlight color for the lightbox image.", "ts_visual_composer_extend" ),
					"dependency"            => array( 'element' => "lightbox_backlight", 'value' => 'custom' )
				),
				// Other Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "ts_visual_composer_extend" ),
                    "param_name"            => "seperator_3",
                    "value"                 => "Other Settings",
                    "description"           => __( "", "ts_visual_composer_extend" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Margin: Top", "ts_visual_composer_extend" ),
                    "param_name"            => "margin_top",
                    "value"                 => "0",
                    "min"                   => "0",
                    "max"                   => "200",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Margin: Bottom", "ts_visual_composer_extend" ),
                    "param_name"            => "margin_bottom",
                    "value"                 => "0",
                    "min"                   => "0",
                    "max"                   => "200",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
					"group" 				=> "Other Settings",
                ),
				array(
					"type"                  => "textfield",
					"heading"               => __( "Define ID Name", "ts_visual_composer_extend" ),
					"param_name"            => "el_id",
					"value"                 => "",
					"description"           => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
					"group" 				=> "Other Settings",
				),
				array(
					"type"                  => "textfield",
					"heading"               => __( "Extra Class Name", "ts_visual_composer_extend" ),
					"param_name"            => "el_class",
					"value"                 => "",
					"description"           => __( "Enter a class name for the element.", "ts_visual_composer_extend" ),
					"group" 				=> "Other Settings",
				),
				// Load Custom CSS/JS File
				array(
					"type"                  => "load_file",
					"heading"               => __( "", "ts_visual_composer_extend" ),
                    "param_name"            => "el_file",
					"value"                 => "",
					"file_type"             => "js",
					"file_path"             => "js/ts-visual-composer-extend-element.min.js",
					"description"           => __( "", "ts_visual_composer_extend" )
				),
            ))
        );
    }
?>
<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                              => __( "TS Page Background", "ts_visual_composer_extend" ),
            "base"                              => "TS_VCSC_Page_Background",
            "icon" 	                            => "icon-wpb-ts_vcsc_page_background",
            "class"                             => "",
            "category"                          => __( "VC Extensions", "ts_visual_composer_extend" ),
            "description"                       => __("Add a background to your page.", "ts_visual_composer_extend"),
            "admin_enqueue_js"            		=> "",
            "admin_enqueue_css"           		=> "",
            "params"                            => array(
                // Divider Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "ts_visual_composer_extend" ),
                    "param_name"                => "seperator_1",
                    "value"                     => "Background Settings",
                    "description"               => __( "", "ts_visual_composer_extend" )
                ),				
                array(
                    "type"              		=> "dropdown",
                    "heading"           		=> __( "Background Type", "ts_visual_composer_extend" ),
                    "param_name"        		=> "type",
                    "width"             		=> 300,
                    "value"             		=> array(
						__( "Fixed Image", "ts_visual_composer_extend" )					=> "image",
						__( "YouTube Video", "ts_visual_composer_extend" )					=> "youtube",
						__( "Selfhosted Video", "ts_visual_composer_extend" )				=> "video",
                    ),
					"admin_label" 				=> true,
                    "description"       		=> __( "Select the type of video to be used for the background.", "ts_visual_composer_extend" ),
                ),				
				array(
					"type"              		=> "attach_image",
					"heading"           		=> __( "Background Image", "ts_visual_composer_extend" ),
					"param_name"        		=> "fixed_image",
					"value"             		=> "",
					"description"       		=> __( "Select the image to be used for the page background.", "ts_visual_composer_extend" ),
					"dependency"        		=> array( 'element' => "type", 'value' => 'image' ),
				),				
                array(
                    "type"              		=> "textfield",
                    "heading"           		=> __( "YouTube Video ID", "ts_visual_composer_extend" ),
                    "param_name"        		=> "video_youtube",
                    "value"             		=> "",                    
                    "description"       		=> __( "Enter the YouTube video ID.", "ts_visual_composer_extend" ),
					"dependency"        		=> array( 'element' => "type", 'value' => 'youtube' ),
                ),				
                array(
                    "type"                  	=> "textfield",
                    "heading"               	=> __( "MP4 Video", "ts_visual_composer_extend" ),
                    "param_name"            	=> "video_mp4",
                    "value"                 	=> "",
                    "description"           	=> __( "Enter the remote path to the MP4 version of the video.", "ts_visual_composer_extend" ),
                    "dependency"        		=> array( 'element' => "type", 'value' => 'video' ),
                ),
                array(
                    "type"                  	=> "textfield",
                    "heading"               	=> __( "WEBM Video", "ts_visual_composer_extend" ),
                    "param_name"            	=> "video_webm",
                    "value"                 	=> "",
                    "description"           	=> __( "Enter the remote path to the WEBM version of the video.", "ts_visual_composer_extend" ),
                    "dependency"        		=> array( 'element' => "type", 'value' => 'video' ),
                ),
                array(
                    "type"                  	=> "textfield",
                    "heading"               	=> __( "OGV Video", "ts_visual_composer_extend" ),
                    "param_name"            	=> "video_ogv",
                    "value"                 	=> "",
                    "description"           	=> __( "Enter the remote path to the OGV version of the video.", "ts_visual_composer_extend" ),
                    "dependency"        		=> array( 'element' => "type", 'value' => 'video' ),
                ),
				array(
					"type"              		=> "attach_image",
					"heading"           		=> __( "Poster Image", "ts_visual_composer_extend" ),
					"param_name"        		=> "video_image",
					"value"             		=> "",
					"description"       		=> __( "Select an image to be used as poster for the page background.", "ts_visual_composer_extend" ),
					"dependency"        		=> array( 'element' => "type", 'value' => 'video' ),
				),		
				
				
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Mute Video", "ts_visual_composer_extend" ),
                    "param_name"        		=> "video_mute",
                    "value"             		=> "true",
					"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"						=> __( 'No', "ts_visual_composer_extend" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to mute the video while playing.", "ts_visual_composer_extend" ),
                    "dependency"        		=> array( 'element' => "type", 'value' => array('video', 'youtube') ),
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Loop Video", "ts_visual_composer_extend" ),
                    "param_name"        		=> "video_loop",
                    "value"             		=> "false",
					"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"						=> __( 'No', "ts_visual_composer_extend" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to loop the video after it has finished.", "ts_visual_composer_extend" ),
                    "dependency"            	=> array( 'element' => "type", 'value' => array('video', 'youtube') ),
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Start Video on Pageload", "ts_visual_composer_extend" ),
                    "param_name"        		=> "video_start",
                    "value"             		=> "false",
					"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"						=> __( 'No', "ts_visual_composer_extend" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to if you want to start the video once the page has loaded.", "ts_visual_composer_extend" ),
                    "dependency"            	=> array( 'element' => "type", 'value' => array('video', 'youtube') ),
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Show Video Controls", "ts_visual_composer_extend" ),
                    "param_name"        		=> "video_controls",
                    "value"             		=> "true",
					"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"						=> __( 'No', "ts_visual_composer_extend" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to if you want to show basic video controls.", "ts_visual_composer_extend" ),
                    "dependency"            	=> array( 'element' => "type", 'value' => array('video', 'youtube') ),
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Show Raster over Background", "ts_visual_composer_extend" ),
                    "param_name"        		=> "video_raster",
                    "value"             		=> "false",
					"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"						=> __( 'No', "ts_visual_composer_extend" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to if you want to show a raster over the background.", "ts_visual_composer_extend" ),
                    "dependency"        		=> array( 'element' => "type", 'value' => 'youtube' ),
				),				
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Show Raster over Background", "ts_visual_composer_extend" ),
                    "param_name"        		=> "raster_use",
                    "value"             		=> "false",
					"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"						=> __( 'No', "ts_visual_composer_extend" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to if you want to show a raster over the background.", "ts_visual_composer_extend" ),
                    "dependency"        		=> array( 'element' => "type", 'value' => array('image', 'video') ),
				),
				array(
					"type"              		=> "background",
					"heading"           		=> __( "Raster Type", "ts_visual_composer_extend" ),
					"param_name"        		=> "raster_type",
					"width"             		=> 200,
					"value"             		=> $this->TS_VCSC_Rasters_List,
					"encoding"          		=> "false",
					"asimage"					=> "false",
					"thumbsize"					=> 40,
					"description"       		=> __( "Select the raster pattern for the page background.", "ts_visual_composer_extend" ),
					"dependency"            	=> array( 'element' => "raster_use", 'value' => 'true' ),
				),				
				array(
					"type"						=> "switch",
					"heading"           		=> __( "Color Overlay", "ts_visual_composer_extend" ),
					"param_name"        		=> "overlay_use",
					"value"             		=> "false",
					"on"						=> __( 'Yes', "ts_visual_composer_extend" ),
					"off"						=> __( 'No', "ts_visual_composer_extend" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
					"description"       		=> __( "Switch the toggle if you want to use a color overlay with the background; will only work with browser with RGBA support.", "ts_visual_composer_extend" ),
                    "dependency"        		=> array( 'element' => "type", 'value' => array('image', 'video') ),
				),
				array(
					"type"              		=> "colorpicker",
					"heading"           		=> __( "Overlay Color", "ts_visual_composer_extend" ),
					"param_name"        		=> "overlay_color",
					"value"            	 		=> "rgba(30,115,190,0.25)",
					"description" 				=> __("Define the overlay color; use the alpha channel setting to define the opacity of the overlay."),
					"dependency"            	=> array( 'element' => "overlay_use", 'value' => 'true' ),
				),				
				// Load Custom CSS/JS File
				array(
					"type"                      => "load_file",
					"heading"                   => __( "", "ts_visual_composer_extend" ),
                    "param_name"                => "el_file",
					"value"                     => "",
					"file_type"                 => "js",
					"file_path"                 => "js/ts-visual-composer-extend-element.min.js",
					"description"               => __( "", "ts_visual_composer_extend" )
				),
            ))
        );
    }
?>
<?php
	if (function_exists('vc_add_param')) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		// Row Setting Parameters
		vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_1",
			"value"             			=> "",
			"seperator"             		=> "Background Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Effects", "ts_visual_composer_extend"),
			"param_name" 					=> "ts_row_bg_effects",
			"value" 						=> array(
				__( "None", "ts_visual_composer_extend")					=> "",
				__( "Simple Image", "ts_visual_composer_extend")			=> "image",
				__( "Fixed Image", "ts_visual_composer_extend")				=> "fixed",
				__( "Parallax Image", "ts_visual_composer_extend")			=> "parallax",
				__( "Automove Image", "ts_visual_composer_extend")			=> "automove",
				__( "Movement Image", "ts_visual_composer_extend")			=> "movement",
				__( "Single Color", "ts_visual_composer_extend")			=> "single",
				__( "Gradient Color", "ts_visual_composer_extend")			=> "gradient",
				__( "YouTube Video", "ts_visual_composer_extend")			=> "youtube",
				__( "Selfhosted Video", "ts_visual_composer_extend")		=> "video",
			),
			"admin_label" 					=> true,
			"description" 					=> __("Select the effect you want to apply to the row background.", "ts_visual_composer_extend"),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Full Screen Height Settings
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Full Screen Height", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_screen_height",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if you want to set this row to full screen height (EXPERIMENTAL).", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "youtube", "single", "automove", "movement", "video", "youtube")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Height Offset", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_screen_offset",
			"value"                 		=> "0",
			"min"                   		=> "0",
			"max"                   		=> "500",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "Define an optional height offset to account for menu bars or other top fixed elements.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_screen_height",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Min Height Settings
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Minimum Height", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_min_height",
			"value"                 		=> "100",
			"min"                   		=> "0",
			"max"                   		=> "2048",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "Define the minimum height for the row; use only if your theme doesn't provide a similar option and if there is no row content.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_screen_height",
				"value" 	=> "false"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Full Width Settings
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorFullWidthInternal == "false") {
			$TS_VCSC_FullWidthRowMessage	= __( "Define the number of Parent Containers the Background should attempt to break away from.", "ts_visual_composer_extend" );
		} else {
			$TS_VCSC_FullWidthRowMessage	= __( "Define the number of Parent Containers the Background should attempt to break away from; Do NOT use in conjunction with VC's native Full Width setting.", "ts_visual_composer_extend" );
		}
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Full Width Breakouts", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_break_parents",
			"value"                 		=> "0",
			"min"                   		=> "0",
			"max"                   		=> "99",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> $TS_VCSC_FullWidthRowMessage,
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "youtube", "single", "automove", "movement", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Z-Index
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Z-Index for Background", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_zindex",
			"value"                 		=> "0",
			"min"                   		=> "-100",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "Define the z-Index for the background; use only if theme requires an adjustment!", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "youtube", "single", "automove", "movement", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Background Settings
		/*vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_2",
			"value"             			=> "",
			"seperator"             		=> "Background Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "youtube", "single", "automove", "movement", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));*/
		vc_add_param("vc_row", array(
			"type"							=> "attach_image",
			"heading"						=> __( "Background Image", "ts_visual_composer_extend" ),
			"param_name"					=> "ts_row_bg_image",
			"value"							=> "",
			"description"					=> __( "Select the background image for your row.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "dropdown",
			"heading"               		=> __( "Background Image Source", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_bg_source",
			"width"                 		=> 150,
			"value"                 		=> array(
				__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
				__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
				__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
			),
			"description"           		=> __( "Select which image size based on WordPress settings should be used for the lightbox image.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Background Position
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Position", "ts_visual_composer_extend" ),
			"param_name" 					=> "ts_row_bg_position",
			"value" 						=> array(
				__( "Center Center", "ts_visual_composer_extend" ) 	=> "center",
				__( "Center Top", "ts_visual_composer_extend" )		=> "top",
				__( "Center Bottom", "ts_visual_composer_extend" ) 	=> "bottom",
				__( "Left Top", "ts_visual_composer_extend" ) 		=> "left top",
				__( "Left Center", "ts_visual_composer_extend" ) 	=> "left center",
				__( "Left Bottom", "ts_visual_composer_extend" ) 	=> "left bottom",
				__( "Right Top", "ts_visual_composer_extend" ) 		=> "right top",
				__( "Right Center", "ts_visual_composer_extend" ) 	=> "right center",
				__( "Right Bottom", "ts_visual_composer_extend" ) 	=> "right bottom",
				__( "Custom Value", "ts_visual_composer_extend" ) 	=> "custom",
			),
			"description" 					=> __("Select the position of the background image; will have most effect on smaller screens."),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend" ),
		));		
        vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "Custom Image Position", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_bg_position_custom",
			"value"             			=> "",
			"description"       			=> __( "Enter the custom position of the image, using either px or % (i.e. '25% 15%').", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_position",
				"value" 	=> array("custom")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend" ),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Size", "ts_visual_composer_extend" ),
			"param_name" 					=> "ts_row_bg_size_standard",
			"value" 						=> array(
				__( "Cover", "ts_visual_composer_extend" ) 			=> "cover",
				__( "Contain", "ts_visual_composer_extend" ) 		=> "contain",
				__( "Initial", "ts_visual_composer_extend" ) 		=> "initial",
				__( "Auto", "ts_visual_composer_extend" ) 			=> "auto",
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Size", "ts_visual_composer_extend" ),
			"param_name" 					=> "ts_row_bg_size_parallax",
			"value" 						=> array(
				__( "Cover", "ts_visual_composer_extend" ) 			=> "cover",
				__( "150%", "ts_visual_composer_extend" )			=> "150%",
				__( "200%", "ts_visual_composer_extend" )			=> "200%",
				__( "Contain", "ts_visual_composer_extend" ) 		=> "contain",
				__( "Initial", "ts_visual_composer_extend" ) 		=> "initial",
				__( "Auto", "ts_visual_composer_extend" ) 			=> "auto",
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("parallax", "automove")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Repeat", "ts_visual_composer_extend" ),
			"param_name" 					=> "ts_row_bg_repeat",
			"value" 						=> array(
				__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
				__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
				__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
				__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));		
		// Parallax Settings
		/*vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_3",
			"value"             			=> "",
			"seperator"             		=> "Parallax Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "parallax"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));*/
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Parallax", "ts_visual_composer_extend"),
			"param_name" 					=> "ts_row_parallax_type",
			"value" 						=> array(
				"Up"			=> "up",
				"Down"			=> "down",
				"Left"			=> "left",
				"Right"			=> "right",
			),
			"description" 					=> __("Select the parallax effect for your background image. You must have a background image to use this.", "ts_visual_composer_extend"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "parallax"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Position", "ts_visual_composer_extend" ),
			"param_name" 					=> "ts_row_bg_alignment_v",
			"value" 						=> array(
				__( "Center", "ts_visual_composer_extend" )			=> "center",
				__( "Left", "ts_visual_composer_extend" ) 			=> "left",
				__( "Right", "ts_visual_composer_extend" ) 			=> "right"
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_parallax_type",
				"value" 	=> array("up", "down")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend" ),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Position", "ts_visual_composer_extend" ),
			"param_name" 					=> "ts_row_bg_alignment_h",
			"value" 						=> array(
				__( "Center", "ts_visual_composer_extend" )			=> "center",
				__( "Top", "ts_visual_composer_extend" ) 			=> "top",
				__( "Bottom", "ts_visual_composer_extend" ) 		=> "bottom"
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_parallax_type",
				"value" 	=> array("left", "right")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend" ),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Parallax Speed", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_parallax_speed",
			"value"                 		=> "20",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "parallax"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Auto Move Settings
		/*vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_4",
			"value"             			=> "",
			"seperator"             		=> "AutoMove Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "automove"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));*/
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Automove Speed", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_automove_speed",
			"value"                 		=> "75",
			"min"                   		=> "0",
			"max"                   		=> "1000",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "Define the AutoMove Speed; the higher the value, the slower the movement.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "automove"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Automove Scroll", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_automove_scroll",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if the auto-moving image should scroll with the page or be fixed.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "automove"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Automove Path", "ts_visual_composer_extend"),
			"param_name" 					=> "ts_row_automove_align",
			"value" 						=> array(
				"Horizontal"		=> "horizontal",
				"Vertical"			=> "vertical",
			),
			"description" 					=> __("Select the path the auto-moving image should be using.", "ts_visual_composer_extend"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "automove"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));	
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Moving Direction", "ts_visual_composer_extend"),
			"param_name" 					=> "ts_row_automove_path_h",
			"value" 						=> array(
				"Left to Right"		=> "leftright",
				"Right to Left"		=> "rightleft",
			),
			"description" 					=> __("Select the path the auto-moving image should be using.", "ts_visual_composer_extend"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_automove_align",
				"value" 	=> "horizontal"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Moving Direction", "ts_visual_composer_extend"),
			"param_name" 					=> "ts_row_automove_path_v",
			"value" 						=> array(
				"Top to Bottom"		=> "topbottom",
				"Bottom to Top"		=> "bottomtop",
			),
			"description" 					=> __("Select the path the auto-moving image should be using.", "ts_visual_composer_extend"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_automove_align",
				"value" 	=> "vertical"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Movement Settings
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Horizontal (X) Movement", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_movement_x_allow",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to have the background follow horizontal (x) movements.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "movement"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Horizontal Ratio", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_movement_x_ratio",
			"value"                 		=> "10",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "Define the ratio in pixels by how much the background is allowed to move horizontally.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_movement_x_allow",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Vertical (Y) Movement", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_movement_y_allow",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to have the background follow vertical (y) movements.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "movement"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Vertical Ratio", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_movement_y_ratio",
			"value"                 		=> "10",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "Define the ratio in pixels by how much the background is allowed to move vertically.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_movement_y_allow",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Move Content Elements", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_movement_content",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to move content elements with the background image.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "movement"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Global Settings
		vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_5",
			"value"             			=> "",
			"seperator"             		=> "Global Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Padding: Top", "ts_visual_composer_extend" ),
			"param_name"            		=> "padding_top",
			"value"                 		=> "30",
			"min"                   		=> "0",
			"max"                   		=> "250",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Padding: Bottom", "ts_visual_composer_extend" ),
			"param_name"            		=> "padding_bottom",
			"value"                 		=> "30",
			"min"                   		=> "0",
			"max"                   		=> "250",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Margin: Left", "ts_visual_composer_extend" ),
			"param_name"            		=> "margin_left",
			"value"                 		=> "0",
			"min"                   		=> "-50",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Margin: Right", "ts_visual_composer_extend" ),
			"param_name"            		=> "margin_right",
			"value"                 		=> "0",
			"min"                   		=> "-50",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Background Color", "ts_visual_composer_extend" ),
			"param_name"        			=> "single_color",
			"value"            	 			=> "#ffffff",
			"description"       			=> __( "Define the background color for the row.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "single"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Gradient Color Background
		/*vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_6",
			"value"             			=> "",
			"seperator"             		=> "Gradient Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));*/
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Gradient Angle", "ts_visual_composer_extend" ),
			"param_name"            		=> "gradient_angle",
			"value"                 		=> "0",
			"min"                   		=> "0",
			"max"                   		=> "360",
			"step"                  		=> "1",
			"unit"                  		=> 'deg',
			"description"           		=> __( "Define the angle at which the gradient should spread.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Start Color", "ts_visual_composer_extend" ),
			"param_name"        			=> "gradient_color_start",
			"value"            	 			=> "#cccccc",
			"description"       			=> __( "Define the start color for the gradient.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Gradient Start", "ts_visual_composer_extend" ),
			"param_name"            		=> "gradient_start_offset",
			"value"                 		=> "0",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '%',
			"description"           		=> __( "Define the beginning section of the gradient.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "End Color", "ts_visual_composer_extend" ),
			"param_name"        			=> "gradient_color_end",
			"value"            	 			=> "#cccccc",
			"description"       			=> __( "Define the end color for the gradient.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Gradient End", "ts_visual_composer_extend" ),
			"param_name"            		=> "gradient_end_offset",
			"value"                 		=> "100",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '%',
			"description"           		=> __( "Define the end section of the gradient.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// YouTube Video Background
		/*vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_7",
			"value"             			=> "",
			"seperator"             		=> "YouTube Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));*/
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "YouTube Video ID", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_youtube",
			"value"             			=> "",
			"description"       			=> __( "Enter the YouTube video ID.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "attach_image",
			"heading"						=> __( "Background Image", "ts_visual_composer_extend" ),
			"param_name"					=> "video_background",
			"value"							=> "",
			"description"					=> __( "Select an alternative background image for the video on mobile devices; otherwise YouTube cover image will be used.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		
		// Video Background
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "MP4 Video Path", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_mp4",
			"value"             			=> "",
			"description"       			=> __( "Enter the path to the MP4 video version.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "OGV Video Path", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_ogv",
			"value"             			=> "",
			"description"       			=> __( "Enter the path to the OGV video version.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "WEBM Video Path", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_webm",
			"value"             			=> "",
			"description"       			=> __( "Enter the path to the WEBM video version.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "attach_image",
			"heading"						=> __( "Video Screenshot Image", "ts_visual_composer_extend" ),
			"param_name"					=> "video_image",
			"value"							=> "",
			"description"					=> __( "Select the a screenshot image for the video.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Mute Video", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_mute",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to mute the video while playing.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("youtube", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Loop Video", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_loop",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to loop the video after it has finished.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("youtube", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));		
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Remove Video", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_remove",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to remove (hide) the video after it has finished playing.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "video_loop",
				"value" 	=> "false"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));		
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Start Video on Pageload", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_start",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to start the video once the page has loaded.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("youtube", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));		
		/*vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Play Video on Hover", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_hover",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to play the video only when hovering over it.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));	*/	
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Stop Video once out of View", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_stop",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to stop the video once it is out of view and restart when it comes back into view.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("youtube", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Show Video Controls", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_controls",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to show basic video controls.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("youtube", "video")
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Show Raster over Video", "ts_visual_composer_extend" ),
			"param_name"        			=> "video_raster",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to show a raster over the video.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		// Row Shapes
		vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_8",
			"value"             			=> "",
			"seperator"             		=> "Top Shapes",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> "",
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Use Top Shape", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_top_on",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if you want to apply a SVG shape to the top of the row.", "ts_visual_composer_extend" ),
			"dependency" 					=> "",
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Top SVG Shape", "ts_visual_composer_extend" ),
			"param_name" 					=> "svg_top_style",
			"value" 						=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_SVG_RowShapes_List,
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_top_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend" ),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Top SVG Height", "ts_visual_composer_extend" ),
			"param_name"            		=> "svg_top_height",
			"value"                 		=> "100",
			"min"                   		=> "0",
			"max"                   		=> "300",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_top_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Flip Top Shape", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_top_flip",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if you want to flip the top SVG shape.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "svg_top_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Top SVG Position", "ts_visual_composer_extend" ),
			"param_name"            		=> "svg_top_position",
			"value"                 		=> "0",
			"min"                   		=> "-300",
			"max"                   		=> "300",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "Define the exact position for the top SVG shape; you might have to adjust margins to avoid overlaps.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "svg_top_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));		
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Top SVG Color Main", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_top_color1",
			"value"            	 			=> "#ffffff",
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_top_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Top SVG Color Alternate", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_top_color2",
			"value"            	 			=> "#ededed",
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_top_style",
				"value" 	=> array("14", "16")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_9",
			"value"             			=> "",
			"seperator"             		=> "Bottom Shapes",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> "",
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Use Bottom Shape", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_bottom_on",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if you want to apply a SVG shape to the bottom of the row.", "ts_visual_composer_extend" ),
			"dependency" 					=> "",
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Bottom SVG Shape", "ts_visual_composer_extend" ),
			"param_name" 					=> "svg_bottom_style",
			"value" 						=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_SVG_RowShapes_List,
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_bottom_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend" ),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Bottom SVG Height", "ts_visual_composer_extend" ),
			"param_name"            		=> "svg_bottom_height",
			"value"                 		=> "100",
			"min"                   		=> "0",
			"max"                   		=> "300",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_bottom_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Flip Bottom Shape", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_bottom_flip",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if you want to flip the bottom SVG shape.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "svg_bottom_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Bottom SVG Position", "ts_visual_composer_extend" ),
			"param_name"            		=> "svg_bottom_position",
			"value"                 		=> "0",
			"min"                   		=> "-300",
			"max"                   		=> "300",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "Define the exact position for the bottom SVG shape; you might have to adjust margins to avoid overlaps.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "svg_bottom_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Bottom SVG Color Main", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_bottom_color1",
			"value"            	 			=> "#ffffff",
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_bottom_on",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Bottom SVG Color Alternate", "ts_visual_composer_extend" ),
			"param_name"        			=> "svg_bottom_color2",
			"value"            	 			=> "#ededed",
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "svg_bottom_style",
				"value" 	=> array("14", "16")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		// Other Effects
		vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_10",
			"value"             			=> "",
			"seperator"             		=> "Other Effects",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "single", "automove", "movement", "video")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		// Raster Settings
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Raster Overlay", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_raster_use",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if you want to use a raster overlay with the background effect.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "single", "automove", "movement", "video")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "background",
			"heading"           			=> __( "Raster Type", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_raster_type",
			"width"             			=> 200,
			"value"             			=> $this->TS_VCSC_Rasters_List,
			"encoding"          			=> "false",
			"asimage"						=> "false",
			"thumbsize"						=> 40,
			"description"       			=> __( "Select the raster pattern for the background effect.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_raster_use",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		// Color Overlay
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Color Overlay", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_overlay_use",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle if you want to use a color overlay with the background effect; will only work with browser with RGBA support.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement", "video")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Overlay Color", "ts_visual_composer_extend" ),
			"param_name"        			=> "ts_row_overlay_color",
			"value"            	 			=> "rgba(30,115,190,0.25)",
			"description" 					=> __("Define the overlay color; use the alpha channel setting to define the opacity of the overlay."),
			"dependency" 					=> array(
				"element" 	=> "ts_row_overlay_use",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		/*vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Overlay Opacity", "ts_visual_composer_extend" ),
			"param_name"            		=> "ts_row_overlay_opacity",
			"value"                 		=> "25",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "Define the opacity for the overlay.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_overlay_use",
				"value" 	=> "true"
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));*/
		// Blur Effect Settings
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Blur Strength", "ts_visual_composer_extend"),
			"param_name" 					=> "ts_row_blur_strength",
			"value" 						=> array(
				__( "None", "ts_visual_composer_extend")					=> "",
				__( "Small Blur", "ts_visual_composer_extend")				=> "ts-background-blur-small",
				__( "Medium Blur", "ts_visual_composer_extend")				=> "ts-background-blur-medium",
				__( "Strong Blur", "ts_visual_composer_extend")				=> "ts-background-blur-strong",
			),
			"description" 					=> __("Define an optional blur strength for the background effect.", "ts_visual_composer_extend"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "automove", "movement")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		// Viewport Animation
		vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "seperator_11",
			"value"             			=> "",
			"seperator"             		=> "Animation Settings",
			"description"       			=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient", "single")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "css3animations",
			"class" 						=> "",
			"heading" 						=> __("Viewport Animation", "ts_visual_composer_extend"),
			"param_name" 					=> "animation_view",
			"standard"						=> "false",
			"prefix"						=> "",
			"connector"						=> "css3animations_in",
			"noneselect"					=> "true",
			"default"						=> "",
			"value" 						=> "",
			"admin_label"					=> false,
			"description" 					=> __("Select a Viewport Animation for this Row; it is advised not to use with Parallax.", "ts_visual_composer_extend"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient", "single")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                      	=> "hidden_input",
			"heading"                   	=> __( "Animation Type", "ts_visual_composer_extend" ),
			"param_name"                	=> "css3animations_in",
			"value"                     	=> "",
			"admin_label"		        	=> true,
			"description"               	=> __( "", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient", "single")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Repeat Effect", "ts_visual_composer_extend" ),
			"param_name"        			=> "animation_scroll",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "ts_visual_composer_extend" ),
			"off"							=> __( 'No', "ts_visual_composer_extend" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to repeat the viewport effect when element has come out of view and comes back into viewport.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient", "single")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Animation Speed", "ts_visual_composer_extend" ),
			"param_name"            		=> "animation_speed",
			"value"                 		=> "2000",
			"min"                   		=> "1000",
			"max"                   		=> "5000",
			"step"                  		=> "100",
			"unit"                  		=> 'ms',
			"description"           		=> __( "Define the Length of the Viewport Animation in ms.", "ts_visual_composer_extend" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient", "single")
			),
			"group" 						=> __( "VCE Effects", "ts_visual_composer_extend"),
		));
		// Load Required Files
		vc_add_param("vc_row", array(
			"type"                  		=> "load_file",
			"class" 						=> "",
			"heading"               		=> __( "", "ts_visual_composer_extend" ),
			"param_name"            		=> "el_file1",
			"value"                 		=> "",
			"file_type"             		=> "js",
			"file_path"             		=> "js/ts-visual-composer-extend-element.min.js",
			"description"           		=> __( "", "ts_visual_composer_extend" ),
			"group" 						=> __( "VCE Backgrounds", "ts_visual_composer_extend"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "load_file",
			"class" 						=> "",
			"heading"           			=> __( "", "ts_visual_composer_extend" ),
			"param_name"        			=> "el_file2",
			"value"             			=> "",
			"file_type"         			=> "css",
			"file_id"         				=> "ts-extend-animations",
			"file_path"         			=> "css/ts-visual-composer-extend-animations.min.css",
			"description"       			=> __( "", "ts_visual_composer_extend" )
		));
		
		// Add Custom BackEnd View
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorBackgroundIndicator == "true") {
			$setting = array (
				"js_view" 					=> 'TS_VCSC_VcRowViewCustom'
			);
		} else {
			$setting = array ();
		}
		vc_map_update('vc_row', $setting);
	}
	
	add_filter('TS_VCSC_ComposerRowAdditions_Filter',		'TS_VCSC_ComposerRowAdditions', 		10, 2);
	
	function TS_VCSC_ComposerRowAdditions($output, $atts, $content='') {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndWaypoints == "true") {
			if (wp_script_is('waypoints', $list = 'registered')) {
				wp_enqueue_script('waypoints');
			} else {
				wp_enqueue_script('ts-extend-waypoints');
			}
		}
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndForcable == "false") {
			wp_enqueue_style('ts-extend-animations');			
			wp_enqueue_style('ts-visual-composer-extend-front');
			wp_enqueue_script('ts-visual-composer-extend-front');
		}

		extract(shortcode_atts( array(
			'ts_row_bg_image'			=> '',
			'ts_row_bg_source'			=> 'full',
			'ts_row_bg_effects'			=> '',
			'ts_row_break_parents'		=> 0,
			
			'ts_row_blur_strength'		=> '',
			'ts_row_raster_use'			=> 'false',
			'ts_row_raster_type'		=> '',
			
			'ts_row_overlay_use'		=> 'false',
			'ts_row_overlay_color'		=> 'rgba(30,115,190,0.25)',
			'ts_row_overlay_opacity'	=> 25,
			
			'ts_row_zindex'				=> 0,
			'ts_row_min_height'			=> 100,
			'ts_row_screen_height'		=> 'false',
			'ts_row_screen_offset'		=> 0,
			
			'svg_top_on'				=> 'false',
			'svg_top_style'				=> '1',
			'svg_top_height'			=> 100,
			'svg_top_flip'				=> 'false',
			'svg_top_position'			=> 0,
			'svg_top_color1'			=> '#ffffff',
			'svg_top_color2'			=> '#ededed',
			
			'svg_bottom_on'				=> 'false',
			'svg_bottom_style'			=> '1',
			'svg_bottom_height'			=> 100,
			'svg_bottom_flip'			=> 'false',
			'svg_bottom_position'		=> 0,
			'svg_bottom_color1'			=> '#ffffff',
			'svg_bottom_color2'			=> '#ededed',
			
			'ts_row_bg_position'		=> 'center',
			'ts_row_bg_position_custom'	=> '',
			'ts_row_bg_alignment_h'		=> 'center',
			'ts_row_bg_alignment_v'		=> 'center',
			'ts_row_bg_repeat'			=> 'no-repeat',
			'ts_row_bg_size_parallax'	=> 'cover',
			'ts_row_bg_size_standard'	=> 'cover',
			'ts_row_parallax_type'		=> '',
			'ts_row_parallax_speed'		=> 20,
			
			'ts_row_automove_scroll'	=> 'true',
			'ts_row_automove_align'		=> 'horizontal',
			'ts_row_automove_path_v'	=> 'topbottom',
			'ts_row_automove_path_h'	=> 'rightleft',
			'ts_row_automove_speed'		=> 75,
			
			'ts_row_movement_x_allow'	=> 'true',
			'ts_row_movement_x_ratio'	=> 20,
			'ts_row_movement_y_allow'	=> 'true',
			'ts_row_movement_y_ratio'	=> 20,
			'ts_row_movement_content'	=> 'false',
			
			'margin_left'				=> 0,
			'margin_right'				=> 0,
			'padding_top'				=> 20,
			'padding_bottom'			=> 20,
			'enable_mobile'				=> 'false',
			
			'single_color'				=> '#ffffff',
			
			'gradient_angle'			=> 0,
			'gradient_color_start'		=> '#cccccc',
			'gradient_start_offset'		=> 0,
			'gradient_color_end'		=> '#cccccc',
			'gradient_end_offset'		=> 100,
			
			'video_youtube'				=> '',
			'video_background'			=> '',
			'video_mute'				=> 'true',
			'video_loop'				=> 'false',
			'video_remove'				=> 'false',
			'video_start'				=> 'false',
			'video_hover'				=> 'false',
			'video_stop'				=> 'true',
			'video_controls'			=> 'true',
			'video_raster'				=> 'false',
			
			'video_mp4'					=> '',
			'video_ogv'					=> '',
			'video_webm'				=> '',
			'video_image'				=> '',

			'animation_factor'			=> '0.33',
			'animation_scroll'			=> 'false',
			'animation_view'			=> '',
			'animation_speed'			=> 2000,
		), $atts));
		
		$output 						= "";
		
		$randomizer						= mt_rand(999999, 9999999);

		// Viewport Animations
		if (!empty($animation_view)) {
			$animation_css				= "ts-viewport-css-" . $animation_view;
			$output						.= '<div class="ts-viewport-row ts-viewport-animation" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-scrollup = "' . $animation_scroll . '" data-factor="' . $animation_factor . '" data-viewport="' . $animation_css . '" data-speed="' . $animation_speed . '"></div>';
		} else {
			$animation_css				= '';
		}

		// CSS3 Blur Effect
		if ($ts_row_blur_strength != '') {
			$blur_class					= "ts-background-blur " . $ts_row_blur_strength;
			if ($ts_row_blur_strength == "ts-background-blur-small") {
				$blur_factor			= 2;
			} else if ($ts_row_blur_strength == "ts-background-blur-medium") {
				$blur_factor			= 5;
			} else if ($ts_row_blur_strength == "ts-background-blur-strong") {
				$blur_factor			= 8;
			}
		} else {
			$blur_class					= "";
			$blur_factor				= 0;
		}
		
		// Raster (Noise) Overlay
		if (($ts_row_raster_use == "true") && ($ts_row_raster_type != '')) {
			$raster_content				= '<div class="ts-background-raster" style="background-image: url(' . $ts_row_raster_type . ');"></div>';
		} else {
			$raster_content				= '';
		}
		
		// Color Overlay
		if (($ts_row_overlay_use == "true") && ($ts_row_overlay_color != '')) {
			$overlay_content			= '<div class="ts-background-overlay" style="background: ' . $ts_row_overlay_color . ';"></div>';
		} else {
			$overlay_content			= '';
		}
		
		// SVG Shape Overlays
		$svg_enabled					= 'false';
		if ($svg_top_on == "true") {
			$svg_top_content			= '<div id="ts-background-separator-top-' . $randomizer . '" class="ts-background-separator-container" style="height: ' . $svg_top_height . 'px; top: ' . $svg_top_position . 'px; bottom: auto; z-index: ' . (1 + $ts_row_zindex) . ';"><div class="ts-background-separator-wrap ts-background-separator-top' . ($svg_top_flip == "true" ? "-flip" : "") . '" data-random="' . $randomizer . '" data-height="' . $svg_top_height . '" data-position="top" style="height: ' . $svg_top_height . 'px;">' . TS_VCSC_GetRowSeparator($svg_top_style, $svg_top_color1, $svg_top_color2, $svg_top_height) . '</div></div>';
			$svg_enabled				= 'true';
		} else {
			$svg_top_content			= '';
		}
		if ($svg_bottom_on == "true") {
			$svg_bottom_content			= '<div id="ts-background-separator-bottom-' . $randomizer . '" class="ts-background-separator-container" style="height: ' . $svg_bottom_height . 'px; top: auto; bottom: ' . $svg_bottom_position . 'px; z-index: ' . (1 + $ts_row_zindex) . ';"><div class="ts-background-separator-wrap ts-background-separator-bottom' . ($svg_bottom_flip == "true" ? "-flip" : "") . '" data-random="' . $randomizer . '" data-height="' . $svg_bottom_height . '" data-position="bottom" style="height: ' . $svg_bottom_height . 'px;">' . TS_VCSC_GetRowSeparator($svg_bottom_style, $svg_bottom_color1, $svg_bottom_color2, $svg_bottom_height) . '</div></div>';
			$svg_enabled				= 'true';
		} else {
			$svg_bottom_content			= '';
		}
		
		// Simple Background Image
		if ($ts_row_bg_effects == "image") {
			$ts_row_bg_image_url		= wp_get_attachment_image_src($ts_row_bg_image, $ts_row_bg_source);
			if ($ts_row_bg_position == "custom") {
				$ts_row_bg_position		= $ts_row_bg_position_custom;
			}
			$output						.= "<div id='ts-background-main-" . $randomizer . "' class='ts-background-image ts-background " . $blur_class . "' data-svgshape='" . $svg_enabled . "' data-random='" . $randomizer . "' data-image-width='" . $ts_row_bg_image_url[1] . "' data-image-height='" . $ts_row_bg_image_url[2] . "' data-type='" . $ts_row_bg_effects . "' data-inline='" . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . "' data-height='" . $ts_row_min_height . "' data-screen='" . $ts_row_screen_height . "' data-offset='" . $ts_row_screen_offset . "' data-blur='" . $blur_factor . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_standard . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-repeat='" . $ts_row_bg_repeat . "' data-break-parents='" . esc_attr( $ts_row_break_parents ) . "'>";
				$output					.= $svg_top_content;
				$output					.= $overlay_content;
				$output					.= $raster_content;
				$output					.= $svg_bottom_content;
			$output 					.= "</div>";
		}
		
		// Fixed Background Image
		if ($ts_row_bg_effects == "fixed") {
			$ts_row_bg_image_url		= wp_get_attachment_image_src($ts_row_bg_image, $ts_row_bg_source);
			if ($ts_row_bg_position == "custom") {
				$ts_row_bg_position		= $ts_row_bg_position_custom;
			}
			$output						.= "<div id='ts-background-main-" . $randomizer . "' class='ts-background-fixed ts-background " . $blur_class . "' data-svgshape='" . $svg_enabled . "' data-random='" . $randomizer . "' data-image-width='" . $ts_row_bg_image_url[1] . "' data-image-height='" . $ts_row_bg_image_url[2] . "' data-type='" . $ts_row_bg_effects . "' data-inline='" . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . "' data-height='" . $ts_row_min_height . "' data-screen='" . $ts_row_screen_height . "' data-offset='" . $ts_row_screen_offset . "' data-blur='" . $blur_factor . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_standard . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-repeat='" . $ts_row_bg_repeat . "' data-break-parents='" . esc_attr( $ts_row_break_parents ) . "'>";
				$output					.= $svg_top_content;
				$output					.= $overlay_content;
				$output					.= $raster_content;
				$output					.= $svg_bottom_content;
			$output 					.= "</div>";
		}

		// Parallax Background
		if ($ts_row_bg_effects == "parallax") {
			$parallaxClass				= ( $ts_row_parallax_type == "none" ) ? "" : "ts-background-parallax";
			$parallaxClass				= in_array( $ts_row_parallax_type, array( "none", "fixed", "up", "down", "left", "right", "ts-background-parallax" ) ) ? $parallaxClass : "";			
			if (($ts_row_parallax_type == "up") || ($ts_row_parallax_type == "down")) {
				$ts_row_bg_alignment	= $ts_row_bg_alignment_v;
			} else if (($ts_row_parallax_type == "left") || ($ts_row_parallax_type == "right")) {
				$ts_row_bg_alignment	= $ts_row_bg_alignment_h;
			}			
			if (!empty($parallaxClass)) {
				$ts_row_bg_image_url	= wp_get_attachment_image_src($ts_row_bg_image, $ts_row_bg_source);
				$ts_row_parallax_speed	= round(($ts_row_parallax_speed / 100), 2);
				$output					.= "<div id='ts-background-main-" . $randomizer . "' class='" . esc_attr($parallaxClass) . " ts-background " . $blur_class . "' data-svgshape='" . $svg_enabled . "' data-random='" . $randomizer . "' data-image-width='" . $ts_row_bg_image_url[1] . "' data-image-height='" . $ts_row_bg_image_url[2] . "' data-type='" . $ts_row_bg_effects . "' data-inline='" . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . "' data-disabled='false' data-height='" . $ts_row_min_height . "' data-screen='" . $ts_row_screen_height . "' data-offset='" . $ts_row_screen_offset . "' data-blur='" . $blur_factor . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_parallax . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-alignment='" . $ts_row_bg_alignment . "' data-repeat='" . $ts_row_bg_repeat . "' data-direction='" . esc_attr($ts_row_parallax_type) . "' data-momentum='" . esc_attr((float)$ts_row_parallax_speed * -1) . "' data-mobile-enabled='" . esc_attr($enable_mobile) . "' data-break-parents='" . esc_attr($ts_row_break_parents) . "'>";
					$output				.= $svg_top_content;
					$output				.= $overlay_content;
					$output				.= $raster_content;
					$output				.= $svg_bottom_content;
				$output 				.= "</div>";
			}
		}
		
		// AutoMove Background
		if ($ts_row_bg_effects == "automove") {
			$ts_row_bg_image_url		= wp_get_attachment_image_src($ts_row_bg_image, $ts_row_bg_source);
			if ($ts_row_automove_align == "horizontal") {
				$ts_row_automove_path	= $ts_row_automove_path_h;
			} else if ($ts_row_automove_align == "vertical") {
				$ts_row_automove_path	= $ts_row_automove_path_v;
			}			
			$output						.= "<div id='ts-background-main-" . $randomizer . "' class='ts-background-automove ts-background " . $blur_class . "' data-svgshape='" . $svg_enabled . "' data-random='" . $randomizer . "' data-image-width='" . $ts_row_bg_image_url[1] . "' data-image-height='" . $ts_row_bg_image_url[2] . "' data-type='" . $ts_row_bg_effects . "' data-inline='" . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . "' data-height='" . $ts_row_min_height . "' data-screen='" . $ts_row_screen_height . "' data-offset='" . $ts_row_screen_offset . "' data-blur='" . $blur_factor . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_standard . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-repeat='repeat 0 0' data-scroll='" . $ts_row_automove_scroll . "' data-alignment='" . $ts_row_automove_align . "' data-direction='" . $ts_row_automove_path . "' data-speed='" . $ts_row_automove_speed . "' data-break-parents='" . esc_attr( $ts_row_break_parents ) . "'>";
				$output					.= $svg_top_content;
				$output					.= $overlay_content;
				$output					.= $raster_content;
				$output					.= $svg_bottom_content;
			$output 					.= "</div>";
		}
		
		// Movement Background
		if ($ts_row_bg_effects == "movement") {
			wp_enqueue_script('ts-extend-parallaxify');
			$ts_row_bg_image_url		= wp_get_attachment_image_src($ts_row_bg_image, $ts_row_bg_source);			
			$ts_row_movement_data		= ' data-allowx="' . $ts_row_movement_x_allow . '" data-movex="' . $ts_row_movement_x_ratio . '" data-allowy="' . $ts_row_movement_y_allow . '" data-movey="' . $ts_row_movement_y_ratio . '" data-allowcontent="' . $ts_row_movement_content . '"';
			$output						.= "<div id='ts-background-main-" . $randomizer . "' class='ts-background-movement ts-background " . $blur_class . "' data-svgshape='" . $svg_enabled . "' data-random='" . $randomizer . "' data-image-width='" . $ts_row_bg_image_url[1] . "' data-image-height='" . $ts_row_bg_image_url[2] . "' data-type='" . $ts_row_bg_effects . "' data-inline='" . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . "' data-disabled='false' data-height='" . $ts_row_min_height . "' data-screen='" . $ts_row_screen_height . "' data-offset='" . $ts_row_screen_offset . "' data-blur='" . $blur_factor . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_parallax . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-repeat='" . $ts_row_bg_repeat . "' data-mobile-enabled='" . esc_attr($enable_mobile) . "' data-break-parents='" . esc_attr($ts_row_break_parents) . "' " . $ts_row_movement_data . ">";
				$output					.= $svg_top_content;
				$output					.= $overlay_content;
				$output					.= $raster_content;
				$output					.= $svg_bottom_content;
			$output 					.= "</div>";
		}

		// Selfhosted Video Background
		if ($ts_row_bg_effects == "video") {
			wp_enqueue_style('ts-font-mediaplayer');
			wp_enqueue_style('ts-extend-wallpaper');
			wp_enqueue_script('ts-extend-wallpaper');
			if (!empty($video_image)) {
				$video_image_url		= wp_get_attachment_image_src($video_image, 'full');
				$video_image_url		= $video_image_url[0];
			} else {
				$video_image_url		= "";
			}
			$output						.= '<div id="ts-background-main-' . $randomizer . '" class="ts-background-video ts-background" data-svgshape="' . $svg_enabled . '" data-random="' . $randomizer . '" data-type="' . $ts_row_bg_effects . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-height="' . $ts_row_min_height . '" data-screen="' . $ts_row_screen_height . '" data-offset="' . $ts_row_screen_offset . '" data-blur="' . $blur_factor . '" data-index="' . $ts_row_zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-paddingtop="' . $padding_top . '" data-paddingbottom="' . $padding_bottom . '" data-raster="' . ((($ts_row_raster_use == "true") && ($ts_row_raster_type != '')) ? $ts_row_raster_type : "") . '" data-overlay="' . ((($ts_row_overlay_use == "true") && ($ts_row_overlay_color != '')) ? $ts_row_overlay_color : "") . '" data-mp4="' . $video_mp4 . '" data-ogv="' . $video_ogv . '" data-webm="' . $video_webm . '" data-image="' . $video_image_url . '" data-controls="' . $video_controls . '" data-start="' . $video_start . '" data-stop="' . $video_stop . '" data-hover="' . $video_hover . '" data-loop="' . $video_loop . '" data-remove="' . $video_remove . '" data-mute="' . $video_mute . '" data-break-parents="' . esc_attr( $ts_row_break_parents ) . '">';
				$output 				.= '<div class="ts-background-video-holder" style=""></div>';
				$output					.= $svg_top_content;
				$output					.= $svg_bottom_content;
			$output						.= '</div>';
		}
		
		// Youtube Video Background
		if ($ts_row_bg_effects == "youtube") {
			if (preg_match('~((http|https|ftp|ftps)://|www.)(.+?)~', $video_youtube)) {
				$video_youtube			= $video_youtube;
			} else {
				$video_youtube			= 'https://www.youtube.com/watch?v=' . $video_youtube;
			}
			if (!empty($video_background)) {
				$video_background		= wp_get_attachment_image_src($video_background, 'full');
				$video_background		= $video_background[0];
			} else {
				$video_background		= TS_VCSC_VideoImage_Youtube($video_youtube);
			}		
			wp_enqueue_script('ts-extend-ytplayer');
			wp_enqueue_style('ts-extend-ytplayer');
			$output						.= '<div id="ts-background-main-' . $randomizer . '" class="ts-background-youtube ts-background" data-svgshape="' . $svg_enabled . '" data-random="' . $randomizer . '" data-type="' . $ts_row_bg_effects . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-height="' . $ts_row_min_height . '" data-screen="' . $ts_row_screen_height . '" data-offset="' . $ts_row_screen_offset . '" data-blur="' . $blur_factor . '" data-index="' . $ts_row_zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-paddingtop="' . $padding_top . '" data-paddingbottom="' . $padding_bottom . '" data-image="' . $video_background . '" data-video="' . $video_youtube . '" data-controls="' . $video_controls . '" data-start="' . $video_start . '" data-stop="' . $video_stop . '" data-hover="' . $video_hover . '" data-raster="' . $video_raster . '" data-mute="' . $video_mute . '" data-loop="' . $video_loop . '" data-remove="' . $video_remove . '" data-break-parents="' . esc_attr( $ts_row_break_parents ) . '">';
				$output					.= $svg_top_content;
				$output					.= $overlay_content;
				$output					.= $raster_content;
				$output					.= $svg_bottom_content;
			$output						.= '</div>';
		}
		
		// Vimeo Video Background
		if ($ts_row_bg_effects == "vimeo") {

		}
		
		// Single Color Background
		if ($ts_row_bg_effects == "single") {
			$output						.= '<div id="ts-background-main-' . $randomizer . '" class="ts-background-single ts-background" style="display: none; background-color: ' . $single_color . ';" data-svgshape="' . $svg_enabled . '" data-random="' . $randomizer . '" data-type="' . $ts_row_bg_effects . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-color="' . $single_color . '" data-height="' . $ts_row_min_height . '" data-screen="' . $ts_row_screen_height . '" data-offset="' . $ts_row_screen_offset . '" data-blur="' . $blur_factor . '" data-index="' . $ts_row_zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-paddingtop="' . $padding_top . '" data-paddingbottom="' . $padding_bottom . '" data-break-parents="' . esc_attr( $ts_row_break_parents ) . '">';
				$output					.= $svg_top_content;
				$output					.= $raster_content;
				$output					.= $svg_bottom_content;
			$output 					.= '</div>';
		}
		
		// Gradient Background
		if ($ts_row_bg_effects == "gradient") {
			$gradient_css_attr[] 		= 'background: ' . $gradient_color_start . '';
			$gradient_css_attr[] 		= 'background: -moz-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: -webkit-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: -o-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: -ms-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr = 		implode('; ', $gradient_css_attr);
			$output						.= '<div id="ts-background-main-' . $randomizer . '" class="ts-background-gradient ts-background" style="display: none; ' . $gradient_css_attr . '" data-svgshape="' . $svg_enabled . '" data-random="' . $randomizer . '" data-type="' . $ts_row_bg_effects . '" data-inline="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode . '" data-height="' . $ts_row_min_height . '" data-screen="' . $ts_row_screen_height . '" data-offset="' . $ts_row_screen_offset . '" data-blur="' . $blur_factor . '" data-index="' . $ts_row_zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-paddingtop="' . $padding_top . '" data-paddingbottom="' . $padding_bottom . '" data-break-parents="' . esc_attr( $ts_row_break_parents ) . '">';
				$output					.= $svg_top_content;
				$output					.= $raster_content;
				$output					.= $svg_bottom_content;
			$output 					.= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	
	if (!function_exists('vc_theme_before_vc_row')){
		function vc_theme_before_vc_row($atts, $content = null) {
			return apply_filters( 'TS_VCSC_ComposerRowAdditions_Filter', '', $atts, $content );
		}
	}
	if (!function_exists('vc_theme_before_vc_row_inner')){
		function vc_theme_before_vc_row_inner($atts, $content = null){
			return apply_filters( 'TS_VCSC_ComposerRowAdditions_Filter', '', $atts, $content );
		}
	}
?>
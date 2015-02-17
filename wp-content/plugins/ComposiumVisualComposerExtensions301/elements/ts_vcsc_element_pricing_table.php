<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Pricing Table", "ts_visual_composer_extend" ),
            "base"                          => "TS-VCSC-Pricing-Table",
            "icon"                          => "icon-wpb-ts_vcsc_pricing_table",
            "class"                         => "",
            "category"                      => __( "VC Extensions", "ts_visual_composer_extend" ),
            "description" 		            => __("Place a pricing table", "ts_visual_composer_extend"),
			"js_view"     					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorLivePreview == "true" ? "TS_VCSC_PricingTableViewCustom" : ""),
            "admin_enqueue_js"            	=> "",
            "admin_enqueue_css"           	=> "",
            "params"                        => array(
				// Pricing Table Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "ts_visual_composer_extend" ),
					"param_name"		    => "seperator_1",
					"value"				    => "Pricing Table Settings",
					"description"		    => __( "", "ts_visual_composer_extend" ),
                    "dependency"            => "",
				),
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Design", "ts_visual_composer_extend" ),
                    "param_name"            => "style",
                    "admin_label"           => true,
                    "value"			        => array(
                        __( "Style 1", "")          => "1",
                        __( "Style 2", "" )         => "2",
                        __( "Style 3", "" )         => "3",
                        __( "Style 4", "" )         => "4",
                        __( "Style 5", "" )         => "5",
                    ),
                ),
                array(
                    "type"                  => "switch",
                    "heading"               => __( "Featured Table", "ts_visual_composer_extend" ),
                    "param_name"            => "featured",
                    "value"                 => "false",
                    "on"				    => __( 'Yes', "ts_visual_composer_extend" ),
                    "off"				    => __( 'No', "ts_visual_composer_extend" ),
                    "style"				    => "select",
                    "design"			    => "toggle-light",
                    "description"           => __( "Switch the toggle if this table will be a featured table..", "ts_visual_composer_extend" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "textfield",
                    "class"                 => "",
                    "heading"               => __( "Plan", "ts_visual_composer_extend" ),
                    "param_name"            => "featured_text",
                    "value"                 => "Recommended",
                    "dependency"            => array( 'element' => "style", 'value' => "3" )
                ),
                array(
                    "type"                  => "textfield",
                    "class"                 => "",
                    "heading"               => __( "Plan", "ts_visual_composer_extend" ),
                    "param_name"            => "plan",
                    "value"                 => "Basic",
                    "admin_label"           => true,
                ),
                array(
                    "type"                  => "textfield",
                    "class"                 => "",
                    "heading"               => __( "Cost", "ts_visual_composer_extend" ),
                    "param_name"            => "cost",
                    "value"                 => "$20",
                    "admin_label"           => true,
                ),
                array(
                    "type"		            => "textfield",
                    "class"		            => "",
                    "heading"               => __( "Per (optional)", "ts_visual_composer_extend" ),
                    "param_name"            => "per",
                    "value"                 => "/ month",
                ),
                array(
                    "type"		            => "textarea_html",
                    "class"		            => "",
                    "heading"               => __( "Features", "ts_visual_composer_extend" ),
                    "param_name"            => "content",
                    "value"                 => "<ul>
                                                <li>30GB Storage</li>
                                                <li>512MB Ram</li>
                                                <li>10 databases</li>
                                                <li>1,000 Emails</li>
                                                <li>25GB Bandwidth</li>
                                            </ul>",
                ),
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Link Style", "ts_visual_composer_extend" ),
                    "param_name"            => "link_type",
                    "admin_label"           => true,
                    "value"			        => array(
                        __( "Default Link Button", "")		=> "default",
                        __( "Custom Code Block", "" )		=> "custom",
                        __( "No Link", "" )         		=> "none",
                    ),
                ),
                array(
                    "type"			        => "textfield",
                    "class"			        => "",
                    "heading"		        => __( "Button: Text", "ts_visual_composer_extend" ),
                    "param_name"	        => "button_text",
                    "value"			        => "Button Text",
                    "description"	        => __( "Button: Text", "ts_visual_composer_extend" ),
					"dependency"			=> array( 'element' => "link_type", 'value' => 'default' )
                ),
                array(
                    "type"			        => "textfield",
                    "class"			        => "",
                    "heading"		        => __( "Button: URL", "ts_visual_composer_extend" ),
                    "param_name"	        => "button_url",
                    "value"			        => "",
                    "description"	        => __( "Button: URL", "ts_visual_composer_extend" ),
					"dependency"			=> array( 'element' => "link_type", 'value' => 'default' )
                ),
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Button: Link Target", "ts_visual_composer_extend" ),
                    "param_name"	        => "button_target",
					"value"             => array(
						__( "Same Window", "ts_visual_composer_extend" )                    => "_parent",
						__( "New Window", "ts_visual_composer_extend" )                     => "_blank"
					),
					"dependency"			=> array( 'element' => "link_type", 'value' => 'default' )
                ),
				array(
					"type"              	=> "textarea_raw_html",
					"heading"           	=> __( "Custom Code", "ts_visual_composer_extend" ),
					"param_name"        	=> "button_custom",
					"value"             	=> base64_encode(""),
					"description"       	=> __( "Enter the HTML code to build your custom link (button).", "ts_visual_composer_extend" ),
					"dependency"        	=> array( 'element' => "link_type", 'value' => 'custom' )
				),
				// Other Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "ts_visual_composer_extend" ),
					"param_name"		    => "seperator_2",
					"value"				    => "Other Settings",
					"description"		    => __( "", "ts_visual_composer_extend" ),
                    "dependency"            => "",
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
					"type"              	=> "textfield",
					"heading"           	=> __( "Define ID Name", "ts_visual_composer_extend" ),
					"param_name"        	=> "el_id",
					"value"             	=> "",
					"description"       	=> __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
					"group" 				=> "Other Settings",
				),
				array(
					"type"              	=> "textfield",
					"heading"           	=> __( "Extra Class Name", "ts_visual_composer_extend" ),
					"param_name"        	=> "el_class",
					"value"             	=> "",
					"description"       	=> __( "Enter a class name for the element.", "ts_visual_composer_extend" ),
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
            )
        ));
    }
?>
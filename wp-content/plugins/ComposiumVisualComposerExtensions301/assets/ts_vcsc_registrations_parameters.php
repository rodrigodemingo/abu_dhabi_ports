<?php
    global $VISUAL_COMPOSER_EXTENSIONS;
    // Create custom Paramater Types for Visual Composer
    // -------------------------------------------------
    if (function_exists('add_shortcode_param')) {
        // Generate param type "custompost" + "custompostcat"
        if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesCheckup == "true") {
            if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesTeam == true) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesTestimonial == true) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesLogo == true) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesSkillset == true)) {
            // Function to generate param type "custompost"
            add_shortcode_param('custompost', 'custompost_settings_field');
            function custompost_settings_field($settings, $value) {
                global $VISUAL_COMPOSER_EXTENSIONS;
                $dependency     	= vc_generate_dependencies_attributes($settings);
                $param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
                $posttype			= isset($settings['posttype']) ? $settings['posttype'] : '';
                $posttaxonomy		= isset($settings['posttaxonomy']) ? $settings['posttaxonomy'] : '';
                $postsingle			= isset($settings['postsingle']) ? $settings['postsingle'] : '';
                $postplural			= isset($settings['postplural']) ? $settings['postplural'] : '';
                $postclass			= isset($settings['postclass']) ? $settings['postclass'] : '';
                $type           	= isset($settings['type']) ? $settings['type'] : '';
                $url            	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
                $output         	= '';
                $posts_fields 		= array();
                $categories			= '';
                $category_fields 	= array();
                $categories_count	= 0;
                $terms_slugs 		= array();
                $value_arr 			= $value;
                if (!is_array($value_arr)) {
                    $value_arr = array_map('trim', explode(',', $value_arr));
                }
                if (!empty($settings['posttype']) ) {
                    $args = array(
                        'no_found_rows' 		=> 1,
                        'ignore_sticky_posts' 	=> 1,
                        'posts_per_page' 		=> -1,
                        'post_type' 			=> $posttype,
                        'post_status' 			=> 'publish',
                        'orderby' 				=> 'title',
                        'order' 				=> 'ASC',
                    );
                    $custompost_nocategory			= 0;
                    $custompost_query = new WP_Query($args);
                    if ($custompost_query->have_posts()) {
                        foreach($custompost_query->posts as $p) {
                            $categories = TS_VCSC_GetTheCategoryByTax($p->ID, $posttaxonomy);
                            if ($categories && !is_wp_error($categories)) {
                                $category_slugs_arr = array();
                                foreach ($categories as $category) {
                                    $category_slugs_arr[] = $category->slug;
                                    $category_data = array(
                                        'slug'		=> $category->slug,
                                        'name'		=> $category->cat_name,
                                        'count'		=> $category->count,
                                    );
                                    $category_fields[] = $category_data;
                                }
                                $categories_slug_str = join(",", $category_slugs_arr);
                            } else {
                                $custompost_nocategory++;
                                $categories_slug_str = '';
                            };
                            $posts_fields[] = sprintf(
                                '<option id="%s" class="%s" name="%s" value="%s" data-filter="false" data-id="%s" data-categories="%s" %s>%s (ID: %s)</option>',
                                $settings['param_name'] . '-' . $p->ID,
                                $settings['param_name'] . ' ' . $type,
                                $settings['param_name'] . '-' . $p->ID,
                                $p->ID,
                                $p->post_title,
                                $categories_slug_str,
                                selected(in_array($p->ID, $value_arr), true, false),
                                $p->post_title,
                                $p->ID
                            );
                        }
                    }
                    wp_reset_postdata();
                }
                $category_fields = array_map("unserialize", array_unique(array_map("serialize", $category_fields)));
                $output .= '<div class="ts-custompost-selector-parent" data-selectable="' . __( "Available Categories:", "ts_visual_composer_extend" ) . '" data-selection="' . __( "Filtered By:", "ts_visual_composer_extend" ) . '">';
                    if (count($category_fields) > 1) {
                        $output .= '<div class="wpb_element_label">' . __( "Filter Controls", "ts_visual_composer_extend" ) . '</div>';
                        $output .= '<div class="ts-switch-button ts-composer-switch" data-value="false" data-width="80" data-style="select" data-on="' . __( "Show", "ts_visual_composer_extend" ) . '" data-off="' . __( "Hide", "ts_visual_composer_extend" ) . '">';
                            $output .= '<input type="checkbox" style="display: none;" class="toggle-input ts-custompost-filter-switch" value="false" id="ts-custompost-filter-switch" name="ts-custompost-filter-switch"/>';
                            $output .= '<div class="toggle toggle-light" style="width: 80px; height: 20px;">';
                                $output .= '<div class="toggle-slide">';
                                    $output .= '<div class="toggle-inner">';
                                        $output .= '<div class="toggle-on">'. __( "Show", "ts_visual_composer_extend" ) . '</div>';
                                        $output .= '<div class="toggle-blob"></div>';
                                        $output .= '<div class="toggle-off active">' . __( "Hide", "ts_visual_composer_extend" ) . '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<span class="description clear">' . __( "Switch the toggle if you want to show controls to filter available post types by categories.", "ts_visual_composer_extend" ) . '</span>';
                        $output .= '<div class="ts-custom-post-filter-frame" style="display: none; margin-top: 20px;">';
                            $output .= '<span style="font-size: 12px; margin-bottom: 10px; width: 100%; display: block;">' . __( "Filter by Category:", "ts_visual_composer_extend" ) . '</span>';
                            $output .= '<select multiple="multiple" id="' . $param_name . '_filter" data-selector="' . $param_name . '" class="ts-' . $postclass . '-selector-filter ts-custompost-selector-filter">';
                                if ($custompost_nocategory > 0) {
                                    $output .= '<option id="" class="" name="" data-id="" data-author="" data-category="ts-custompost-none-applied" value="ts-custompost-none-applied">' . __( "No Category", "ts_visual_composer_extend" ) . ' (' . $custompost_nocategory . ')</option>';
                                }
                                foreach ($category_fields as $index => $array) {
                                    $output .= '<option id="" class="" name="" data-id="" data-author="" data-category="' . $category_fields[$index]['slug'] . '" value="' . $category_fields[$index]['slug'] . '">' . $category_fields[$index]['name'] . ' (' . $category_fields[$index]['count'] . ')</option>';
                                }
                            $output .= '</select>';
                            $output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block; text-align: justify;">' . __( "Click on 'Available Categories' to filter by category; click on 'Flitered By' to remove from filter.", "ts_visual_composer_extend" ) . '</span>';
                        $output .= '</div>';
                    }
                    $output .= '<select name="ts-custompost-selector-mirror" id="ts-custompost-selector-mirror" class="ts-custompost-selector-mirror dropdown" value="" style="display: none !important;">';
                        $output .= implode( $posts_fields );
                    $output .= '</select>';
                    
                    $output .= '<span style="font-size: 12px; margin-top: 20px; margin-bottom: 10px; width: 100%; display: block;">' . __( "Select", "ts_visual_composer_extend" ) . ' ' . $postsingle . ':</span>';
                    $output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-' . $postclass . '-selector ts-custompost-selector wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" value=" ' . $value . '" style="">';
                        $output .= '<option id="" class="placeholder" name="" value="" data-filter="false" data-id="" data-categories="">' . __( "Select", "ts_visual_composer_extend" ) . ' ' . $postsingle . '</option>';
                        $output .= implode( $posts_fields );
                    $output .= '</select>';
                $output .= '</div>';
                return $output;
            }
            // Function to generate param type "custompostcat"
            add_shortcode_param('custompostcat', 'custompostcat_settings_field');
            function custompostcat_settings_field($settings, $value) {
                global $VISUAL_COMPOSER_EXTENSIONS;
                $dependency     	= vc_generate_dependencies_attributes($settings);
                $param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
                $posttype			= isset($settings['posttype']) ? $settings['posttype'] : '';
                $posttaxonomy		= isset($settings['posttaxonomy']) ? $settings['posttaxonomy'] : '';
                $postsingle			= isset($settings['postsingle']) ? $settings['postsingle'] : '';
                $postplural			= isset($settings['postplural']) ? $settings['postplural'] : '';
                $postclass			= isset($settings['postclass']) ? $settings['postclass'] : '';
                $type           	= isset($settings['type']) ? $settings['type'] : '';
                $url            	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
                $output         	= '';
                $posts_fields 		= array();
                $categories			= '';
                $category_fields 	= array();
                $categories_count	= 0;
                $terms_slugs 		= array();
                $value_arr 			= $value;
                if (!is_array($value_arr)) {
                    $value_arr = array_map('trim', explode(',', $value_arr));
                }			
                if (!empty($settings['posttype']) ) {
                    $args = array(
                        'no_found_rows' 			=> 1,
                        'ignore_sticky_posts' 		=> 1,
                        'posts_per_page' 			=> -1,
                        'post_type' 				=> $posttype,
                        'post_status' 				=> 'publish',
                        'orderby' 					=> 'title',
                        'order' 					=> 'ASC',
                    );
                    $custompost_nocategory_count	= 0;
                    $custompost_nocategory_name		= 'ts-' . $postclass . '-none-applied';
                    $custompost_query = new WP_Query($args);
                    if ($custompost_query->have_posts()) {
                        foreach($custompost_query->posts as $p) {
                            $categories = TS_VCSC_GetTheCategoryByTax($p->ID, $posttaxonomy);
                            if ($categories && !is_wp_error($categories)) {
                                $category_slugs_arr = array();
                                foreach ($categories as $category) {
                                    $category_slugs_arr[] = $category->slug;
                                    $category_data = array(
                                        'slug'		=> $category->slug,
                                        'name'		=> $category->cat_name,
                                        'count'		=> $category->count,
                                    );
                                    $category_fields[] = $category_data;
                                }
                                $categories_slug_str = join(",", $category_slugs_arr);
                            } else {
                                $custompost_nocategory_count++;
                            }
                        }
                    }
                    wp_reset_postdata();
                }
                $category_fields = array_map("unserialize", array_unique(array_map("serialize", $category_fields)));
                $output .= '<div class="ts-custompost-categories-holder">';
                    $output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
                    $output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-custompost-categories-selector wpb-input wpb-select dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;" data-selectable="' . __( "Available Categories:", "ts_visual_composer_extend" ) . '" data-selection="' . __( "Applied Categories:", "ts_visual_composer_extend" ) . '">';
                        if ($custompost_nocategory_count > 0) {
                            $output .= '<option id="" class="" name="" data-id="" data-author="" value="ts-' . $postclass . '-none-applied" ' . selected(in_array($custompost_nocategory_name, $value_arr), true, false) . '>' . __( "No Category", "ts_visual_composer_extend" ) . ' (' . $custompost_nocategory_count . ')</option>';
                        }
                        foreach ($category_fields as $index => $array) {
                            $output .= '<option id="" class="" name="" data-id="" data-author="" value="' . $category_fields[$index]['slug'] . '" ' . selected(in_array($category_fields[$index]['slug'], $value_arr), true, false) . '>' . $category_fields[$index]['name'] . ' (' . $category_fields[$index]['count'] . ')</option>';
                        }
                    $output .= '</select>';
                    $output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block; text-align: justify;">' . __( "Click on a name in 'Available Categories' to add category to slider; click on a name in 'Applied Categories' to remove from slider.", "ts_visual_composer_extend" ) . '</span>';
                $output .= '</div>';
                return $output;
            }
            }
        }        
        // Function to generate param type "standardpostcat"
        add_shortcode_param('standardpostcat', 'standardpostcat_settings_field');
        function standardpostcat_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     	= vc_generate_dependencies_attributes($settings);
            $param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
            $posttype			= isset($settings['posttype']) ? $settings['posttype'] : '';
            $posttaxonomy		= isset($settings['posttaxonomy']) ? $settings['posttaxonomy'] : '';
            $postsingle			= isset($settings['postsingle']) ? $settings['postsingle'] : '';
            $postplural			= isset($settings['postplural']) ? $settings['postplural'] : '';
            $postclass			= isset($settings['postclass']) ? $settings['postclass'] : '';
            $type           	= isset($settings['type']) ? $settings['type'] : '';
            $url            	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         	= '';
            $posts_fields 		= array();
            $categories			= '';
            $category_fields 	= array();
            $categories_count	= 0;
            $terms_slugs 		= array();
            $value_arr 			= $value;
            if (!is_array($value_arr)) {
                $value_arr = array_map('trim', explode(',', $value_arr));
            }
            // Categories for Standard Post Type
            $args = array(
                'type'                     => 'post',
                'child_of'                 => 0,
                'parent'                   => '',
                'orderby'                  => 'name',
                'order'                    => 'ASC',
                'hide_empty'               => 1,
                'hierarchical'             => 1,
                'exclude'                  => '',
                'include'                  => '',
                'number'                   => '',
                'taxonomy'                 => 'category',
                'pad_counts'               => false 
            );
            $categories = get_categories($args);
            $output .= '<div class="ts-standardpost-categories-holder">';
                $output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
                $output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-standardpost-categories-selector wpb-input wpb-select dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;" data-selectable="' . __( "Included Categories:", "ts_visual_composer_extend" ) . '" data-selection="' . __( "Excluded Categories:", "ts_visual_composer_extend" ) . '">';
                    foreach($categories as $category) { 
                        $output .= '<option id="" class="" name="" data-id="" data-author="" value="' . $category->slug . '" ' . selected(in_array($category->slug, $value_arr), true, false) . '>' . $category->name . ' (' . $category->count . ')</option>';
                    }
                $output .= '</select>';
                $output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block; text-align: justify;">' . __( "Click on 'Included Categories' to exclude that category; click on 'Excluded Categories' to include a category again.", "ts_visual_composer_extend" ) . '</span>';
            $output .= '</div>';
            return $output;
        }            
        // Function to generate param type "gopricing"
        add_shortcode_param('gopricing', 'gopricing_settings_field');
        function gopricing_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $radios         = isset($settings['options']) ? $settings['options'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            $pricing_tables = get_option('go_pricing_tables');
            if (!empty($pricing_tables)) {
                $output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-go-pricing-tables wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="margin-bottom: 20px;">';
                    foreach ($pricing_tables as $pricing_table) {
                        $tableID 	= $pricing_table['table-id'];
                        $tableName	= $pricing_table['table-name'];
                        if ($value == $tableID) {
                            $output 	.= '<option class="" value="' . $tableID . '" selected>' . $tableName . '</option>';
                        } else {
                            $output 	.= '<option class="" value="' . $tableID . '">' . $tableName . '</option>';
                        }
                    }
                $output .= '</select>';
            } else {
                $output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-go-pricing-tables wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="margin-bottom: 20px;">';
                    $output 	.= '<option class="" value="None">No Tables could be found!</option>';
                $output .= '</select>';
            }
            return $output;
        }
        // Function to generate param type "quform"
        add_shortcode_param('quform', 'quform_settings_field');
        function quform_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $radios         = isset($settings['options']) ? $settings['options'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            if (function_exists('iphorm_get_all_forms')) {
                $quforms_forms 	= iphorm_get_all_forms();
                if (count($quforms_forms)) {
                    $output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-quform-selector wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="margin-bottom: 20px;">';
                    foreach ($quforms_forms as $form) {
                        $formID 	= $form['id'];
                        $formName	= $form['name'];
                        $formStatus	= $form['active'];
                        if ($formStatus == 0) {
                            if ($value == $formID) {
                                $output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '" selected>' . $formName . ' (inactive)</option>';
                            } else {
                                $output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '">' . $formName . ' (inactive)</option>';
                            }
                        } else {
                            if ($value == $formID) {
                                $output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '" selected>' . $formName . '</option>';
                            } else {
                                $output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '">' . $formName . '</option>';
                            }
                        }
                    }
                    $output .= '</select>';
                } else {
                    printf(esc_html__('No forms found, %sclick here to create one%s.', 'ts_visual_composer_extend'), '<a href="' . admin_url('admin.php?page=iphorm_form_builder') . '">', '</a>');
                }
            }
            return $output;
        }        
        // Function to generate param type "loadfile"
        add_shortcode_param('load_file', 'loadfile_setting_field');
        function loadfile_setting_field($settings, $value){
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $file_type      = isset($settings['file_type']) ? $settings['file_type'] : '';
            $file_id      	= isset($settings['file_id']) ? $settings['file_id'] : '';
            $file_path      = isset($settings['file_path']) ? $settings['file_path'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            if (!empty($file_path)) {
                if ($file_type == "js") {
                    $output .= '<script type="text/javascript" src="' . $url.$file_path . '"></script>';
                } else if ($file_type == "css") {
                    $output .= '<link rel="stylesheet" id="' . $file_id . '" type="text/css" href="' . $url.$file_path . '" media="all">';
                }
            }
            return $output;
        }
        // Function to generate param type "css3animations"
        add_shortcode_param('css3animations', 'css3animations_settings_field');
        function css3animations_settings_field($settings, $value){
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name 	= isset($settings['param_name']) ? $settings['param_name'] : '';
            $type 			= isset($settings['type']) ? $settings['type'] : '';
            $class 			= isset($settings['class']) ? $settings['class'] : '';
            $noneselect		= isset($settings['noneselect']) ? $settings['noneselect'] : 'false';
            $standard		= isset($settings['standard']) ? $settings['standard'] : 'true';
            $prefix			= isset($settings['prefix']) ? $settings['prefix'] : '';
            $default		= isset($settings['default']) ? $settings['default'] : '';
            $connector		= isset($settings['connector']) ? $settings['connector'] : '';
            $effectgroups	= array();
            $selectedclass	= '';
            $selectedgroup	= '';
            $output 		= '';
            $css3animations = '';
            if (empty($value)) {
                $value		= $prefix . $default;
            }
            if ($noneselect == 'true') {
                $css3animations .= '<option class="" value="" data-name=""data-group="" data-prefix="" data-value="">' . __( "None", "ts_visual_composer_extend" ) . '</option>';
            }
            foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Animations_Array as $Animation_Class => $animations) {
                if ($animations) {
                    if (!in_array($animations['group'], $effectgroups)) {
                        if ((($animations['group'] == 'Standard Visual Composer') && ($standard == 'true')) || ($animations['group'] != 'Standard Visual Composer')) {
                            array_push($effectgroups, $animations['group']);
                            $css3animations .= '<optgroup label="' . $animations['group'] . '">';
                        }
                    }
                    if ($value == $prefix . $animations['class']) {
                        if ((($animations['group'] == 'Standard Visual Composer') && ($standard == 'true')) || ($animations['group'] != 'Standard Visual Composer')) {
                            $css3animations .= '<option class="' . $animations['class'] . '" value="' . $prefix . $animations['class'] . '" data-name="' . $Animation_Class . '" data-group="' . $animations['group'] . '" data-prefix="' . $prefix . '" data-value="' . $animations['class'] . '" selected="selected">' . $Animation_Class . '</option>';
                            $selectedgroup 	= $animations['group'];
                            if ($selectedgroup == 'Standard Visual Composer') {
                                $selectedclass	= 'wpb_hover_animation wpb_' . $animations['class'];
                            } else {
                                $selectedclass	= 'ts-animation-frame ts-hover-css-' . $animations['class'];
                            }
                        }
                    } else {
                        if ((($animations['group'] == 'Standard Visual Composer') && ($standard == 'true')) || ($animations['group'] != 'Standard Visual Composer')) {
                            $css3animations .= '<option class="' . $animations['class'] . '" value="' . $prefix . $animations['class'] . '" data-name="' . $Animation_Class . '"data-group="' . $animations['group'] . '" data-prefix="' . $prefix . '" data-value="' . $animations['class'] . '">' . $Animation_Class . '</option>';
                        }
                    }
                }
            }
            unset($effectgroups);
            $output .= '<div class="ts-css3-animations-wrapper" style="width: 100%; display: block;" data-connector="' . $connector . '" data-prefix="' . $prefix . '">';
                $output .= '<div class="ts-css3-animations-selector" style="width: 50%; float: left; margin-bottom: 10px;">';
                    $output .= '<select name="' . $param_name . '" class="wpb_vc_param_value wpb-input wpb-select dropdown ' . $param_name . ' ' . $type . ' ' . $class . ' ' . $value . '" data-class="' . $class . '" data-type="' . $type . '" data-name="' . $param_name . '" data-option="' . $value . '" value="' . $value . '">';
                        $output .= $css3animations;
                    $output .= '</select>';
                $output .= '</div>';
                $output .= '<div class="ts-css3-animations-preview" style="padding: 0px; width: 40%; float: right; text-align: right; margin-left: 10%;">';
                    $output .= '<span class="' . $selectedclass . '" style="padding: 10px; background: #C60000; color: #FFFFFF; border: 1px solid #dddddd; display: inline-block;">' . __( "Animation Preview", "ts_visual_composer_extend" ) . '</span>';
                $output .= '</div>';
            $output .= '</div>';
            return $output;
        }
        // Function to generate param type "seperator"
        add_shortcode_param('seperator', 'seperator_settings_field');
        function seperator_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $seperator		= isset($settings['seperator']) ? $settings['seperator'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            if ($seperator != '') {
                $output		.= '<div id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" name="' . $param_name . '" style="border-bottom: 2px solid #DDDDDD; margin-bottom: 10px; margin-top: 10px; padding-bottom: 10px; font-size: 20px; font-weight: bold; color: #BFBFBF;">' . $seperator . '</div>';
            } else {
                $output		.= '<div id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" name="' . $param_name . '" style="border-bottom: 2px solid #DDDDDD; margin-bottom: 10px; margin-top: 10px; padding-bottom: 10px; font-size: 20px; font-weight: bold; color: #BFBFBF;">' . $value . '</div>';
            }
            return $output;
        }
        // Function to generate param type "messenger"
        add_shortcode_param('messenger', 'messenger_settings_field');
        function messenger_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $message        = isset($settings['message']) ? $settings['message'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
            $class          = isset($settings['class']) ? $settings['class'] : '';
            $color			= isset($settings['color']) ? $settings['color'] : '#000000';
            $weight			= isset($settings['weight']) ? $settings['weight'] : 'normal';
            $size			= isset($settings['size']) ? $settings['size'] : '12';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            if ($message != '') {
                $output 	.= '<div id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" name="' . $param_name . '" style="text-align: justify; border-top: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color: ' . $color . '; margin: 10px 0; padding: 10px 0; font-size: ' . $size . 'px; font-weight: ' . $weight . ';">' . $message . '</div>';
            } else {
                $output 	.= '<div id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" name="' . $param_name . '" style="text-align: justify; border-top: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color: ' . $color . '; margin: 10px 0; padding: 10px 0; font-size: ' . $size . 'px; font-weight: ' . $weight . ';">' . $value . '</div>';
            }
            return $output;
        }
        // Function to generate param type "videoselect"
        add_shortcode_param( 'videoselect', 'videoselect_settings_field');
        function videoselect_settings_field( $settings, $value ) {
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $video_format	= isset($settings['video_format']) ? $settings['video_format'] : 'mp4';			
            $video_format	= explode(',', $video_format);
            $output			= '';
            $args = array(
                'post_type' 		=> 'attachment',
                'post_mime_type' 	=> 'video',
                'post_status' 		=> 'inherit',
                'posts_per_page' 	=> -1,
            );			
            if ($value != '') {
                $metadata			= wp_get_attachment_metadata($value);
                $disabled			= '';
                $visible			= 'display: block;';
                $query_videos 		= new WP_Query($args);
                if ($query_videos->have_posts()) {
                    foreach ($query_videos->posts as $video) {
                        if ($video->ID == $value) {
                            $video_id 		= $value;
                            $video_title 	= $video->post_title;
                            $video_width	= $metadata['width'];
                            $video_height	= $metadata['height'];
                            $video_length	= $metadata['length_formatted'];
                            break;
                        }
                    }
                }
            } else {
                $metadata			= array();
                $disabled			= 'disabled="disabled"';
                $visible			= 'display: none;';
                $video_id			= '';
                $video_title 		= '';
                $video_url			= '';
                $video_width		= '';
                $video_height		= '';
                $video_length		= '';
            }			
            $output 	.= '<div class="ts_vcsc_video_select_block" data-format="' . implode(',', $video_format) . '">';			
                $output 	.= '<input style="display: none;" name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput video_value ' . $param_name . ' ' . $type . '_field" type="text" value="' . $value . '" ' . $dependency . '/>';
                $output 	.= '<input type="button" class="video_select button" value="' . __( 'Select Video', 'ts_visual_composer_extend' ) . '" style="width: 150px; text-align: center;">';
                $output 	.= '<input type="button" class="video_remove button" value="' . __( 'Remove Video', 'ts_visual_composer_extend' ) . '" style="width: 150px; text-align: center; color: red; margin-left: 20px;" ' . $disabled . '>';
                $output		.= '<div class="video_metadata_frame" style="width: 100%; margin-top: 20px; ' .$visible . '">';
                    $output		.= '<div style="float: left; width: 92px; margin-right: 10px;">';
                        if (in_array("mp4", $video_format)) {
                            $output		.= '<img src="' . TS_VCSC_GetResourceURL('images/mediatypes/mp4_video.jpg') . '" style="width: 90px; height: auto; border: 1px solid #ededed;">';
                        } else if ((in_array("ogg", $video_format)) || (in_array("ogv", $video_format))) {
                            $output		.= '<img src="' . TS_VCSC_GetResourceURL('images/mediatypes/ogg_video.jpg') . '" style="width: 90px; height: auto; border: 1px solid #ededed;">';
                        } else if (in_array("webm", $video_format)) {
                            $output		.= '<img src="' . TS_VCSC_GetResourceURL('images/mediatypes/webm_video.jpg') . '" style="width: 90px; height: auto; border: 1px solid #ededed;">';
                        }
                    $output 	.= '</div>';
                    $output		.= '<div style="float: left;">';
                        $output		.= '<div style=""><span style="">' . __( 'Video ID', 'ts_visual_composer_extend' ) . ': </span><span class="video_metadata video_id">' . $video_id . '</span></div>';
                        $output		.= '<div style=""><span style="">' . __( 'Video Name', 'ts_visual_composer_extend' ) . ': </span><span class="video_metadata video_name">' . $video_title . '</span></div>';
                        $output		.= '<div style=""><span style="">' . __( 'Video Duration', 'ts_visual_composer_extend' ) . ': </span><span class="video_metadata video_duration">' . ($video_length != '' ? $video_length : 'N/A') . '</span></div>';
                        $output		.= '<div style=""><span style="">' . __( 'Video Width', 'ts_visual_composer_extend' ) . ': </span><span class="video_metadata video_width">' . ($video_width != '' ? $video_width : 'N/A') . '</span></div>';
                        $output		.= '<div style=""><span style="">' . __( 'Video Height', 'ts_visual_composer_extend' ) . ': </span><span class="video_metadata video_height">' . ($video_height != '' ? $video_height : 'N/A') . '</span></div>';
                    $output 	.= '</div>';
                $output 	.= '</div>';				
            $output 	.= '</div>';
            return $output;
        }
        // Function to generate param type "audioselect"
        add_shortcode_param( 'audioselect', 'audioselect_settings_field');
        function audioselect_settings_field( $settings, $value ) {
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $audio_format	= isset($settings['audio_format']) ? $settings['audio_format'] : 'mpeg';			
            $audio_format	= explode(',', $audio_format);
            $output			= '';
            $args = array(
                'post_type' 		=> 'attachment',
                'post_mime_type' 	=> 'audio',
                'post_status' 		=> 'inherit',
                'posts_per_page' 	=> -1,
            );			
            if ($value != '') {
                $metadata			= wp_get_attachment_metadata($value);
                $disabled			= '';
                $visible			= 'display: block;';
                $query_audios 		= new WP_Query($args);
                if ($query_audios->have_posts()) {
                    foreach ($query_audios->posts as $audio) {
                        if ($audio->ID == $value) {
                            $audio_id 		= $value;
                            $audio_title 	= $audio->post_title;
                            $audio_length	= $metadata['length_formatted'];
                            break;
                        }
                    }
                }
            } else {
                $metadata			= array();
                $disabled			= 'disabled="disabled"';
                $visible			= 'display: none;';
                $audio_id			= '';
                $audio_title 		= '';
                $audio_url			= '';
                $audio_length		= '';
            }			
            $output 	.= '<div class="ts_vcsc_audio_select_block" data-format="' . implode(',', $audio_format) . '">';			
                $output 	.= '<input style="display: none;" name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput audio_value ' . $param_name . ' ' . $type . '_field" type="text" value="' . $value . '" ' . $dependency . '/>';
                $output 	.= '<input type="button" class="audio_select button" value="' . __( 'Select Audio', 'ts_visual_composer_extend' ) . '" style="width: 150px; text-align: center;">';
                $output 	.= '<input type="button" class="audio_remove button" value="' . __( 'Remove Audio', 'ts_visual_composer_extend' ) . '" style="width: 150px; text-align: center; color: red; margin-left: 20px;" ' . $disabled . '>';
                $output		.= '<div class="audio_metadata_frame" style="width: 100%; margin-top: 20px; ' .$visible . '">';
                    $output		.= '<div style="float: left; width: 92px; margin-right: 10px;">';
                        if ((in_array("mp3", $audio_format)) || (in_array("mpeg", $audio_format)) ){
                            $output		.= '<img src="' . TS_VCSC_GetResourceURL('images/mediatypes/mp3_audio.jpg') . '" style="width: 90px; height: auto; border: 1px solid #ededed;">';
                        } else if ((in_array("ogg", $audio_format)) || (in_array("ogv", $audio_format))) {
                            $output		.= '<img src="' . TS_VCSC_GetResourceURL('images/mediatypes/ogg_audio.jpg') . '" style="width: 90px; height: auto; border: 1px solid #ededed;">';
                        }
                    $output 	.= '</div>';
                    $output		.= '<div style="float: left;">';
                        $output		.= '<div style=""><span style="">' . __( 'Audio ID', 'ts_visual_composer_extend' ) . ': </span><span class="audio_metadata audio_id">' . $audio_id . '</span></div>';
                        $output		.= '<div style=""><span style="">' . __( 'Audio Name', 'ts_visual_composer_extend' ) . ': </span><span class="audio_metadata audio_name">' . $audio_title . '</span></div>';
                        $output		.= '<div style=""><span style="">' . __( 'Audio Duration', 'ts_visual_composer_extend' ) . ': </span><span class="audio_metadata audio_duration">' . ($audio_length != '' ? $audio_length : 'N/A') . '</span></div>';
                    $output 	.= '</div>';
                $output 	.= '</div>';				
            $output 	.= '</div>';
            return $output;
        }		
        // Function to generate param type "icons_panel"
        add_shortcode_param('icons_panel', 'iconspanel_settings_field');
        function iconspanel_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $default		= isset($settings['default']) ? $settings['default'] : '';
            $height         = isset($settings['height']) ? $settings['height'] : "250";
            $size           = isset($settings['size']) ? $settings['size'] : "28";
            $margin         = isset($settings['margin']) ? $settings['margin'] : "4";
            $custom         = isset($settings['custom']) ? $settings['custom'] : 'true';
            $icon_select    = isset($settings['source']) ? $settings['source'] : '';
            $font_select	= isset($settings['fonts']) ? $settings['fonts'] : 'true';
            $icon_filter	= isset($settings['filter']) ? $settings['filter'] : 'true';
            $summary		= isset($settings['summary']) ? $settings['summary'] : 'true';
            $visual			= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector;
            $override		= isset($settings['override']) ? $settings['override'] : 'false';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            if (($visual == "true") || ($override == "true")) {
                if (($value == "") && ($default == "")) {
                    $value	= "transparent";
                } else if (($value == "") && ($default != "")) {
                    $value	= $default;
                }
                $output .= '<div class="ts-font-icons-selector-parent">';
                    if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Fonts > 1 ) && ($font_select == "true")) {
                        $output .= __( "Filter by Font:", "ts_visual_composer_extend" );
                    }
                    if ($font_select == "true") {
                        $output .= '<select name="ts-font-icons-fonts" id="ts-font-icons-fonts" class="ts-font-icons-fonts wpb_vc_param_value wpb-input wpb-select font dropdown" style="margin-bottom: 20px; ' . ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Fonts > 1 ? "display: block;" : "display: none;") . '">';
                            foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_List_Select_Fonts as $Icon_Font => $iconfont) {
                                if (strlen($iconfont) != 0) {
                                    $font = str_replace("(", "", strtolower($Icon_Font));
                                    $font = str_replace(")", "", strtolower($font));
                                    $output .= '<option class="" value="' . $font . '">' . $Icon_Font . '</option>';
                                } else {
                                    $output .= '<option class="" value="">' . $Icon_Font . '</option>';
                                }
                            }
                        $output .= '</select>';
                    }
                    if ($icon_filter == "true") {
                        $output .= __( "Filter by Icon:", "ts_visual_composer_extend" );
                        $output .= '<input name="ts-font-icons-search" id="ts-font-icons-search" class="ts-font-icons-search" type="text" placeholder="' . __( "Search ...", "ts_visual_composer_extend" ) . '" />';				
                        $output .= '<div id="ts-font-icons-count" class="ts-font-icons-count" data-count="' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Count . '" style="margin-top: 10px; font-size: 10px;">' . __( "Icons Found:", "ts_visual_composer_extend" ) . ' <span id="ts-font-icons-found" class="ts-font-icons-found">' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Count . '</span> / ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Active_Icon_Count . '</div>';				
                    }
                    if ($summary == "true") {
                        $output .= '<div id="ts-font-icons-preview" class="ts-font-icons-preview" style="border: 1px solid #ededed; float: left; width: 100%; display: block; padding: 0; margin: 10px auto; background: #ededed; ' . ((empty($value) || $value == "transparent") ? "display: none;" : "") . '">';
                            $output .= '<div style="float: left; text-align: left;">';
                                $output .= '<span style="font-weight: bold; width: 100%; display: block; margin: 10px; padding: 0;">' . __( "Selected Icon:", "ts_visual_composer_extend" ) . '</span>';
                                $output .= '<span style="width: 100%; display: block; margin: 10px; padding: 0;">' . __( "Class Name:", "ts_visual_composer_extend" ) . ' <span class="ts-font-icons-preview-class">' . $value . '</span></span>';
                            $output .= '</div>';
                            $output .= '<div style="float: right;">';
                                $output .= '<i class="' . $value . '" style="display: inline-flex; font-size: 50px; height: 50px; line-height: 50px; color: #B24040; margin: 10px;"></i>';
                            $output .= '</div>';
                        $output .= '</div>';
                    }
                    $output .= '<div id="ts-font-icons-wrapper-' . $param_name . '" class="ts-visual-selector ts-font-icons-wrapper" style="height: ' . $height . 'px;">';
                        $output .= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-font-icons-input wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
                        // Add Built-In Fonts (based on provided Source)              
                        foreach ($icon_select as $group => $icons) {
                            if (!is_array($icons) || !is_array(current($icons))) {
                                $class_key      = key($icons);
                                $class_group    = explode('-', esc_attr($class_key));
                                if (($class_group[0] != "dashicons") && ($class_group[0] != "transparent")) {
                                    if ($value == esc_attr($class_key)) {
                                        $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="" data-filter="false" data-font="font-' . $class_group[1] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($icons)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i><div class="selector-tick"></div></a>';
                                    } else {
                                        $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="" data-filter="false" data-font="font-' . $class_group[1] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($icons)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i></a>';
                                    }
                                } else if ($class_group[0] == "transparent") {
                                    if ($value == 'transparent') {
                                        $output .= '<a class="TS_VCSC_Icon_Empty TS_VCSC_Icon_Link ts-no-icon current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . __( "No Icon", "ts_visual_composer_extend" ) . '" data-group="" rel="transparent" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;">r<div class="selector-tick"></div></a>';
                                    } else {
                                        $output .= '<a class="TS_VCSC_Icon_Empty TS_VCSC_Icon_Link ts-no-icon" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . __( "No Icon", "ts_visual_composer_extend" ) . '" data-group="" rel="transparent" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;">r</a>';
                                    }
                                } else {
                                    if ($value == esc_attr($class_key)) {
                                        $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="" data-filter="false" data-font="font-' . $class_group[0] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($icons)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i><div class="selector-tick"></div></a>';
                                    } else {
                                        $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="" data-filter="false" data-font="font-' . $class_group[0] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($icons)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i></a>';
                                    }
                                }
                            } else {
                                foreach ($icons as $key => $label) {
                                    $class_key      = key($label);
                                    $class_group    = explode('-', esc_attr($class_key));
                                    $font           = str_replace("(", "", strtolower(strtolower(esc_attr($group))));
                                    $font           = str_replace(")", "", strtolower($font));
                                    if (($class_group[0] != "dashicons") && ($class_group[0] != "transparent")) {
                                        if ($value == esc_attr($class_key)) {
                                            $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="' . $font . '" data-filter="false" data-font="font-' . $class_group[1] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($label)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i><div class="selector-tick"></div></a>';
                                        } else {
                                            $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="' . $font . '" data-filter="false" data-font="font-' . $class_group[1] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($label)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i></a>';
                                        }
                                    } else if ($class_group[0] == "transparent") {
                                        if ($value == 'transparent') {
                                            $output .= '<a class="TS_VCSC_Icon_Empty TS_VCSC_Icon_Link ts-no-icon current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . __( "No Icon", "ts_visual_composer_extend" ) . '" data-group="" rel="transparent" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;">r<div class="selector-tick"></div></a>';
                                        } else {
                                            $output .= '<a class="TS_VCSC_Icon_Empty TS_VCSC_Icon_Link ts-no-icon" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . __( "No Icon", "ts_visual_composer_extend" ) . '" data-group="" rel="transparent" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;">r</a>';
                                        }
                                    } else {
                                        if ($value == esc_attr($class_key)) {
                                            $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="' . $font . '" data-filter="false" data-font="font-' . $class_group[0] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($label)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i><div class="selector-tick"></div></a>';
                                        } else {
                                            $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="' . $font . '" data-filter="false" data-font="font-' . $class_group[0] . '" data-icon="' . esc_attr($class_key) . '" rel="' . esc_html(current($label)) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i></a>';
                                        }
                                    }
                                }
                            }
                        }
                        // Add Custom Upload Font
                        if ((get_option('ts_vcsc_extend_settings_tinymceCustom', 0) == 1) && ($custom == "true")) {                       
                            foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icons_Compliant_Custom as $group => $icons) {
                                if (!is_array($icons) || !is_array(current($icons))) {
                                    $class_key      = key($icons);
                                    $class_group    = explode('-', esc_attr($class_key));
                                    if ($value == esc_attr($class_key)) {
                                        $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="" data-filter="false" data-font="font-custom" data-icon="' . esc_attr($class_key) . '" rel="' . esc_attr($class_key) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i><div class="selector-tick"></div></a>';
                                    } else {
                                        $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="" data-filter="false" data-font="font-custom" data-icon="' . esc_attr($class_key) . '" rel="' . esc_attr($class_key) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i></a>';
                                    }
                                } else {
                                    foreach ($icons as $key => $label) {
                                        $class_key      = key($label);
                                        $class_group    = explode('-', esc_attr($class_key));
                                        $font           = str_replace("(", "", strtolower(strtolower(esc_attr($group))));
                                        $font           = str_replace(")", "", strtolower($font));
                                        if ($value == esc_attr($class_key)) {
                                            $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link current" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="' . $font . '" data-filter="false" data-font="font-custom" data-icon="' . esc_attr($class_key) . '" rel="' . esc_attr($class_key) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i><div class="selector-tick"></div></a>';
                                        } else {
                                            $output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="' . __( "Icon Name:", "ts_visual_composer_extend" ) . ' ' . esc_attr($class_key) . '" data-group="' . $font . '" data-filter="false" data-font="font-custom" data-icon="' . esc_attr($class_key) . '" rel="' . esc_attr($class_key) . '" style="height: ' . $size . 'px; width: ' . $size . 'px; margin: ' . $margin . 'px ' . $margin . 'px 0 0;"><i style="font-size: ' . $size . 'px; line-height: ' . $size . 'px; height: ' . $size . 'px; width: ' . $size . 'px;" class="' . esc_attr($class_key) . '"></i></a>';
                                        }
                                    }
                                }
                            }                            
                        }			
                    $output .= '</div>';
                $output .= '</div>';
            } else {
                $previewURL = site_url() . '/wp-admin/admin.php?page=TS_VCSC_Previews';			
                $output .= '<input name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" value="' . $value . '"/>';
                $output .= '<a href="' . $previewURL . '" target="_blank">' . __( "Find Icon Class Name", "ts_visual_composer_extend" ) . '</a>';
            }
            return $output;
        }
        // Function to generate param type "backgrounds_panel"
        add_shortcode_param('background', 'background_settings_field');
        function background_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $pattern_select	= isset($settings['value']) ? $settings['value'] : '';
            $encoding       = isset($settings['encoding']) ? $settings['encoding'] : '';
            $asimage		= isset($settings['asimage']) ? $settings['asimage'] : 'true';
            $thumbsize		= isset($settings['thumbsize']) ? $settings['thumbsize'] : 34;
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            $output .= '<div class="ts-visual-selector ts-font-background-wrapper">';
            $output .= '<input name="'.$param_name.'" id="'.$param_name.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
            $selectsize	= "height: " . $thumbsize . "px; width: " . $thumbsize . "px;";
            if ($value == "") {
                $value		= "transparent";
            }
            if ($encoding == 'true') {
                foreach ($pattern_select as $key => $option ) {
                    if ($key) {
                        if ($value == $key) {
                            $output .= '<a class="TS_VCSC_Back_Link current" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-' . $key . '" rel="' . $key . '">';
                                if ($asimage == "true") {
                                    $output .= '<img src="' . $url.$option . '" style="' . $selectsize . '"><div class="selector-tick"></div>';
                                } else {
                                    $output .= '<div style="background-image: url(' . $url.$option . '); background-repeat: repeat; ' . $selectsize . '"></div><div class="selector-tick"></div>';
                                }
                            $output .= '</a>';
                        } else {
                            $output .= '<a class="TS_VCSC_Back_Link" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-' . $key . '" rel="' . $key . '">';
                                if ($asimage == "true") {
                                    $output .= '<img src="' . $url.$option . '" style="' . $selectsize . '">';
                                } else {
                                    $output .= '<div style="background-image: url(' . $url.$option . '); background-repeat: repeat; ' . $selectsize . '"></div>';
                                }
                            $output .= '</a>';
                        }
                    } else {
                        if ($value == 'transparent') {
                            $output .= '<a class="TS_VCSC_Back_Link ts-no-background current" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-transparent" rel="transparent">r<div class="selector-tick"></div></a>';
                        } else {
                            $output .= '<a class="TS_VCSC_Back_Link ts-no-background" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-transparent" rel="transparent">r</a>';
                        }
                    }
                }
            } else {
                foreach ($pattern_select as $key => $option) {
                    if ($key) {
                        if ($value == $url.$option) {
                            $output .= '<a class="TS_VCSC_Back_Link current" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-' . $key . '" rel="' . $url.$option . '">';
                                if ($asimage == "true") {
                                    $output .= '<img src="' . $url.$option . '" style="' . $selectsize . '"><div class="selector-tick"></div>';
                                } else {
                                    $output .= '<div style="background-image: url(' . $url.$option . '); background-repeat: repeat; ' . $selectsize . '"></div><div class="selector-tick"></div>';
                                }
                            $output .= '</a>';
                        } else {
                            $output .= '<a class="TS_VCSC_Back_Link" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-' . $key . '" rel="' . $url.$option . '">';
                                if ($asimage == "true") {
                                    $output .= '<img src="' . $url.$option . '" style="' . $selectsize . '">';
                                } else {
                                    $output .= '<div style="background-image: url(' . $url.$option . '); background-repeat: repeat; ' . $selectsize . '"></div>';
                                }
                            $output .= '</a>';
                        }
                    } else {
                        if ($value == 'transparent') {
                            $output .= '<a class="TS_VCSC_Back_Link ts-no-background current" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-transparent" rel="transparent">r<div class="selector-tick"></div></a>';
                        } else {
                            $output .= '<a class="TS_VCSC_Back_Link ts-no-background" data-value="' . $value . '" style="' . $selectsize . '" href="#" title="' . __( "Background Name:", "ts_visual_composer_extend" ) . ': ts-vcsc-transparent" rel="transparent">r</a>';
                        }
                    }
                }
            }
            $output .= '</div>'; 
            return $output;
        }		
        // Function to generate param type "map marker panel"
        add_shortcode_param('mapmarker', 'mapmarker_settings_field');
        function mapmarker_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $pattern_select	= isset($settings['value']) ? $settings['value'] : '';
            $encoding       = isset($settings['encoding']) ? $settings['encoding'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $dir 			= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginDir;
            $output         = '';
            $output 		.= __( "Search for Marker:", "ts_visual_composer_extend" );
            $output 		.= '<input name="ts-font-marker-search" id="ts-font-marker-search" class="ts-font-marker-search" type="text" placeholder="Search ..." />';
            $output 		.= '<div class="ts-visual-selector ts-font-marker-wrapper">';
                $output		.= '<input name="'.$param_name.'" id="'.$param_name.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
                $markerpath 	= $dir . 'images/marker/';
                $images 		= glob($markerpath . "*.png");
                foreach($images as $img)     {
                    $markername	= basename($img);
                    if ($value == $markername) {
                        $output 	.= '<a class="TS_VCSC_Marker_Link current" href="#" title="' . __( "Marker Name:", "ts_visual_composer_extend" ) . ': ' . $markername . '" rel="' . $markername . '"><img src="' . TS_VCSC_GetResourceURL('images/marker/') . $markername . '" style="height: 37px; width: 32px;"><div class="selector-tick"></div></a>';
                    } else {
                        $output 	.= '<a class="TS_VCSC_Marker_Link" href="#" title="' . __( "Marker Name:", "ts_visual_composer_extend" ) . ': ' . $markername . '" rel="' . $markername . '"><img src="' . TS_VCSC_GetResourceURL('images/marker/') . $markername . '" style="height: 37px; width: 32px;"></a>';
                    }
                }			
            $output .= '</div>'; 
            return $output;
        }
        // Function to generate param type "switch"
        add_shortcode_param('switch', 'switch_settings_field');
        function switch_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $on            	= isset($settings['on']) ? $settings['on'] : __( "On", "ts_visual_composer_extend" );
            $off            = isset($settings['off']) ? $settings['off'] : __( "Off", "ts_visual_composer_extend" );
            $style			= isset($settings['style']) ? $settings['style'] : 'select'; 			// 'compact' or 'select'
            $design			= isset($settings['design']) ? $settings['design'] : 'toggle-light'; 	// 'toggle-light', 'toggle-modern' or 'toggle'soft'
            $width			= isset($settings['width']) ? $settings['width'] : '80';
            $suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
            $class          = isset($settings['class']) ? $settings['class'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            $output .= '<div class="ts-switch-button ts-composer-switch" data-value="' . $value . '" data-width="' . $width . '" data-style="' . $style . '" data-on="' . $on . '" data-off="' . $off . '">';
                $output .= '<input type="hidden" style="display: none; " class="toggle-input wpb_vc_param_value ' . $param_name . ' ' . $type . '" value="' . $value . '" name="' . $param_name . '"/>';
                $output .= '<div class="toggle ' . $design . '" style="width: ' . $width . 'px; height: 20px;">';
                    $output .= '<div class="toggle-slide">';
                        $output .= '<div class="toggle-inner">';
                            $output .= '<div class="toggle-on ' . ($value == 'true' ? 'active' : '') . '">' . $on . '</div>';
                            $output .= '<div class="toggle-blob"></div>';
                            $output .= '<div class="toggle-off ' . ($value == 'false' ? 'active' : '') . '">' . $off . '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            return $output;
        }
        // Function to generate param type "nouislider"
        add_shortcode_param('nouislider', 'nouislider_settings_field');
        function nouislider_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $min            = isset($settings['min']) ? $settings['min'] : '';
            $max            = isset($settings['max']) ? $settings['max'] : '';
            $step           = isset($settings['step']) ? $settings['step'] : '';
            $unit           = isset($settings['unit']) ? $settings['unit'] : '';
            $decimals		= isset($settings['decimals']) ? $settings['decimals'] : 0;
            $suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
            $class          = isset($settings['class']) ? $settings['class'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $output         = '';
            $output 		.= '<div class="ts-nouislider-input-slider">';
                $output 		.= '<input style="width: 100px; float: left; margin-left: 0px; margin-right: 10px;" name="' . $param_name . '"  class="ts-nouislider-serial nouislider-input-selector nouislider-input-composer wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" value="' . $value . '"/>';
                    $output 		.= '<span style="float: left; margin-right: 30px; margin-top: 10px;" class="unit">' . $unit . '</span>';
                $output 		.= '<div class="ts-nouislider-input ts-nouislider-input-element" data-value="' . $value . '" data-min="' . $min . '" data-max="' . $max . '" data-decimals="' . $decimals . '" data-step="' . $step . '" style="width: 250px; float: left; margin-top: 10px;"></div>';
            $output 		.= '</div>';
            return $output;
        }
        // Function to generate param type "imagehotspot"
        add_shortcode_param('imagehotspot', 'imagehotspot_settings_field');
        function imagehotspot_settings_field($settings, $value) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $min            = isset($settings['min']) ? $settings['min'] : '';
            $max            = isset($settings['max']) ? $settings['max'] : '';
            $step           = isset($settings['step']) ? $settings['step'] : '';
            $unit           = isset($settings['unit']) ? $settings['unit'] : '';
            $decimals		= isset($settings['decimals']) ? $settings['decimals'] : 0;
            $suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
            $class          = isset($settings['class']) ? $settings['class'] : '';
            $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
            $coordinates	= explode(",", $value);
            $output         = '';
            $required_vc 	= '4.3.0';
            if (defined('WPB_VC_VERSION')){
                if (version_compare(WPB_VC_VERSION, $required_vc) >= 0) {
                    // Hotspot Image Preview
                    $output 		.= '<div class="ts-image-hotspot-container-preview" style="margin-top: 30px;">';
                        $output 		.= '<img class="ts-image-hotspot-image-preview" data-default="' . TS_VCSC_GetResourceURL('images/other/hotspot_raster.jpg') . '" src="">';
                        $output 		.= '<div class="ts-image-hotspot-holder-preview">';				
                            $output 		.= '<div class="ts-image-hotspot-single-preview" style="left: ' . $coordinates[0] . '%; top: ' . $coordinates[1] . '%;">';					
                                $output 		.= '<div class="ts-image-hotspot-trigger-preview"><div class="ts-image-hotspot-trigger-pulse"></div><div class="ts-image-hotspot-trigger-dot"></div></div>';
                            $output 		.= '</div>';				
                        $output			.= '</div>';
                    $output 		.= '</div>';	
                    $output 		.= '<div class="vc_clearfix"></div>';
                    // Message
                    $output			.= '<div class="" style="text-align: justify; margin-top: 30px; font-size: 13px; font-style: italic; color: #999999;">' . __( "Use the sliders below or use your mouse to drag the hotspot to its desired spot on the image.", "ts_visual_composer_extend" ) . '</div>';
                } else {
                    // Message
                    $output			.= '<div class="" style="text-align: justify; margin-top: 0px; font-size: 13px; font-style: italic; color: #999999;">' . __( "Use the sliders below to position the hotspot on its desired spot on the image.", "ts_visual_composer_extend" ) . '</div>';
                }
            } else {
                // Message
                $output				.= '<div class="" style="text-align: justify; margin-top: 0px; font-size: 13px; font-style: italic; color: #999999;">' . __( "Use the sliders below to position the hotspot on its desired spot on the image.", "ts_visual_composer_extend" ) . '</div>';
            }
            // Hidden Input
            $output 		.= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-nouislider-hotspot-value wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';	
            // X-Position Slider
            $output 		.= '<div class="ts-nouislider-hotspot-slider" style="width: 100%; margin-top: 20px;">';
                $output			.= '<div class="" style="font-weight: bold;">' . __( "Horizontal Position (X)", "ts_visual_composer_extend" ) . '</div>';
                $output 		.= '<input id="ts-input-hotspot-horizontal" style="width: 100px; float: left; margin-left: 0px; margin-right: 10px;" name="" class="ts-nouislider-serial nouislider-input-selector nouislider-input-composer" type="text" value="' . $coordinates[0] . '"/>';
                    $output 		.= '<span style="float: left; margin-right: 30px; margin-top: 10px;" class="unit">' . $unit . '</span>';
                $output 		.= '<div id="ts-nouislider-hotspot-horizontal" class="ts-nouislider-input ts-nouislider-hotspot-element" data-position="horizontal" data-value="' . $coordinates[0] . '" data-min="' . $min . '" data-max="' . $max . '" data-decimals="' . $decimals . '" data-step="' . $step . '" style="width: 250px; float: left; margin-top: 10px;"></div>';
            $output 		.= '</div>';
            $output 		.= '<div class="vc_clearfix"></div>';
            // Y-Position Slider
            $output 		.= '<div class="ts-nouislider-hotspot-slider" style="width: 100%; margin-top: 20px;">';
                $output			.= '<div class="" style="font-weight: bold;">' . __( "Vertical Position (Y)", "ts_visual_composer_extend" ) . '</div>';
                $output 		.= '<input id="ts-input-hotspot-vertical" style="width: 100px; float: left; margin-left: 0px; margin-right: 10px;" name="" class="ts-nouislider-serial nouislider-input-selector nouislider-input-composer" type="text" value="' . $coordinates[1] . '"/>';
                    $output 		.= '<span style="float: left; margin-right: 30px; margin-top: 10px;" class="unit">' . $unit . '</span>';
                $output 		.= '<div id="ts-nouislider-hotspot-vertical" class="ts-nouislider-input ts-nouislider-hotspot-element" data-position="vertical" data-value="' . $coordinates[1] . '" data-min="' . $min . '" data-max="' . $max . '" data-decimals="' . $decimals . '" data-step="' . $step . '" style="width: 250px; float: left; margin-top: 10px;"></div>';
            $output 		.= '</div>';
            return $output;
        }		
        // Function to generate param type "fonts"
        add_shortcode_param('fonts', 'fonts_setting_field');
        function fonts_setting_field($settings, $value){
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $radios         = isset($settings['options']) ? $settings['options'] : '';
            $url            = plugin_dir_url( __FILE__ );
            $output			= '';
            $output .= '<div class="ts-font-selector">';
                $output .= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-font-selector-list wpb-select wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" value="' . $value . '" data-holder="' . __( "Select a Font", "ts_visual_composer_extend" ) . '"/>';
            $output .= '</div>';
            return $output;
        }
        // Function to generate param type "hidden_input"
        add_shortcode_param('hidden_input', 'hiddeninput_setting_field');
        function hiddeninput_setting_field($settings, $value){
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $radios         = isset($settings['options']) ? $settings['options'] : '';
            $output 		= '';
            $output .= '<input name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ts_shortcode_hidden ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
            return $output;
        }
        // Function to generate param type "hidden_textarea"
        add_shortcode_param('hidden_textarea', 'hiddentextarea_setting_field');
        function hiddentextarea_setting_field($settings, $value){
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $radios         = isset($settings['options']) ? $settings['options'] : '';
            $output 		= '';
            $output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ts_shortcode_hidden ' . $param_name . ' ' . $type . '" style="display: none !important;">' . $value . '</textarea>';
            return $output;
        }         
        // Function to generate param type "datetime_picker"
        add_shortcode_param('datetime_picker', 'datetimepicker_setting_field');
        function datetimepicker_setting_field($settings, $value){
            $dependency     = vc_generate_dependencies_attributes($settings);
            $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type           = isset($settings['type']) ? $settings['type'] : '';
            $radios         = isset($settings['options']) ? $settings['options'] : '';
            $period         = isset($settings['period']) ? $settings['period'] : '';
            $output 		= '';
            if ($period == "datetime") {
                $output 		.= '<div class="ts-datetime-picker-element">';
                    $output 	.= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-datetimepicker-value wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
                    //$output		.= '<input class="ts-datetimepicker-clear" type="button" value="Clear" style="width: 150px; text-align: center; display: block; height: 30px; padding: 5px; font-size: 12px; line-height: 12px; margin-bottom: 10px;">';
                    $output 	.= '<input class="ts-datetimepicker" type="text" placeholder="" value="' . $value . '"/>';
                $output 		.= '</div>';
            } else if ($period == "date") {
                $output 		.= '<div class="ts-date-picker-element">';
                    $output 	.= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-datepicker-value wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
                    //$output		.= '<input class="ts-datetimepicker-clear" type="button" value="Clear" style="width: 150px; text-align: center; display: block; height: 30px; padding: 5px; font-size: 12px; line-height: 12px; margin-bottom: 10px;">';
                    $output 	.= '<input class="ts-datepicker" type="text" placeholder="" value="' . $value . '"/>';
                $output 		.= '</div>';
            } else if ($period == "time") {
                $output 		.= '<div class="ts-time-picker-element">';
                    $output 	.= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-timepicker-value wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
                    //$output		.= '<input class="ts-datetimepicker-clear" type="button" value="Clear" style="width: 150px; text-align: center; display: block; height: 30px; padding: 5px; font-size: 12px; line-height: 12px; margin-bottom: 10px;">';
                    $output 	.= '<input class="ts-timepicker" type="text" placeholder="" value="' . $value . '"/>';
                $output 		.= '</div>';
            }
            return $output;
        }   
            
            
        // Create Custom Paramater Types for WooCommerce Elements
        // ------------------------------------------------------
        if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_WooCommerceActive == "true") {
            // Function to generate param type "wc_single_product"
            add_shortcode_param('wc_single_product', 'wc_single_product_settings_field');
            function wc_single_product_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $attr 			= array("post_type" => "product", "orderby" => "name", "order" => "asc", 'posts_per_page' => -1);
                $categories 	= get_posts($attr);
                $output			= '';
                $output .= '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';
                foreach($categories as $category) {
                    $selected 	= '';
                    if ($value!=='' && $category->ID === $value) {
                        $selected = ' selected="selected"';
                    }
                    $output .= '<option class="' . $category->ID . '" value="' . $category->ID . '" data-name="' . $category->post_title . '" ' . $selected . '>' . $category->post_title . ' (ID: ' . $category->ID . ')</option>';
                }
                $output .= '</select>';
                return $output;
            }
            // Function to generate param type "wc_multiple_products"
            add_shortcode_param('wc_multiple_products', 'wc_multiple_products_settings_field');
            function wc_multiple_products_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $value_arr 		= $value;
                $output			= '';
                if (!is_array($value_arr)) {
                    $value_arr = array_map('trim', explode(',', $value_arr));
                }			
                $attr 			= array("post_type" => "product", "orderby" => "name", "order" => "asc", 'posts_per_page' => -1);
                $categories 	= get_posts($attr);
                $output .= '<div class="ts-woocommerce-products-holder">';
                    $output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
                    $output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-woocommerce-products-selector wpb-input wpb-select dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;" data-selectable="' . __( "Available Products:", "ts_visual_composer_extend" ) . '" data-selection="' . __( "Selected Products:", "ts_visual_composer_extend" ) . '">';
                        foreach($categories as $category) { 
                            $output .= '<option id="" class="" name="" data-id="" data-author="" value="' . $category->ID . '" ' . selected(in_array($category->ID, $value_arr), true, false) . '>' . $category->post_title . ' (ID: ' . $category->ID . ')</option>';
                        }
                    $output .= '</select>';
                    $output .= '<span style="font-size: 10px; margin-bottom: 10px; width: 100%; display: block; text-align: justify;">' . __( "Click on 'Available Products' to add that product; click on 'Selected Products' to remove a product from selection.", "ts_visual_composer_extend" ) . '</span>';
                $output .= '</div>';			
                return $output;
            }
            // Function to generate param type "wc_single_product_category"
            add_shortcode_param('wc_single_product_category', 'wc_single_product_category_settings_field');
            function wc_single_product_category_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $categories 	= get_terms('product_cat');
                $output			= '';
                $output .= '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
                foreach ($categories as $category) {
                    $selected 	= '';
                    if ($value!=='' && $category->slug === $value) {
                        $selected = ' selected="selected"';
                    }
                    $output .= '<option class="' . $category->slug . '" value="' . $category->slug . '" data-name="' . $category->name . '" ' . $selected . '>' . $category->name . '</option>';
                }
                $output .= '</select>';
                return $output;
            }
            // Function to generate param type "wc_multiple_product_categories"
            add_shortcode_param('wc_multiple_product_categories', 'wc_multiple_product_categories_settings_field');
            function wc_multiple_product_categories_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $value_arr 		= $value;
                $output			= '';
                if (!is_array($value_arr)) {
                    $value_arr = array_map('trim', explode(',', $value_arr));
                }			
                $categories 	= get_terms('product_cat');
                $output .= '<div class="ts-woocommerce-categories-holder">';
                    $output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
                    $output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-woocommerce-categories-selector wpb-input wpb-select dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;" data-selectable="' . __( "Available Categories:", "ts_visual_composer_extend" ) . '" data-selection="' . __( "Selected Categories:", "ts_visual_composer_extend" ) . '">';
                        foreach($categories as $category) { 
                            $output .= '<option id="" class="' . $category->slug . '" data-id="' . $category->term_id . '" data-count="' . $category->count . '" data-parent="' . $category->parent . '" value="' . $category->term_id . '" ' . selected(in_array($category->term_id, $value_arr), true, false) . '>' . $category->name . ' (&Sigma; ' . $category->count . ')</option>';
                        }
                    $output .= '</select>';
                    $output .= '<span style="font-size: 10px; margin-bottom: 10px; width: 100%; display: block; text-align: justify;">' . __( "Click on 'Available Categories' to add that category; click on 'Selected Categories' to remove a category from selection.", "ts_visual_composer_extend" ) . '</span>';
                $output .= '</div>';			
                return $output;
            }
            // Function to generate param type "wc_product_attributes"
            add_shortcode_param('wc_product_attributes', 'wc_product_attributes_settings_field');
            function wc_product_attributes_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $taxonomies 	= wc_get_attribute_taxonomies();
                $output			= '';
                $output .= '<select name="'.$settings['param_name'].'" data-connector="ts-woocommerce-terms-selector" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
                foreach ($taxonomies as $taxonomy) {
                    $selected = '';
                    if ($value!=='' && $taxonomy->attribute_name === $value) {
                        $selected = ' selected="selected"';
                    }
                    $output .= '<option class="' . $taxonomy->attribute_name . '" data-taxonomy="pa_' . $taxonomy->attribute_name . '" value="' . $taxonomy->attribute_name . '"' . $selected . '>' . $taxonomy->attribute_label . '</option>';
                }
                $output .= '</select>';
                return $output;
            }
            // Function to generate param type "wc_product_terms"
            add_shortcode_param('wc_product_terms', 'wc_product_terms_settings_field');
            function wc_product_terms_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $value_arr 		= $value;
                $output			= '';
                if (!is_array($value_arr)) {
                    $value_arr 	= array_map('trim', explode(',', $value_arr));
                }
                $taxonomies 	= wc_get_attribute_taxonomies();
                $taxonomy_terms = array();
                if ($taxonomies) {
                    foreach ($taxonomies as $taxonomy) {
                        if (taxonomy_exists(wc_attribute_taxonomy_name($taxonomy->attribute_name))) {
                            $taxonomy_terms[$taxonomy->attribute_name] = get_terms(wc_attribute_taxonomy_name($taxonomy->attribute_name), 'orderby=name&hide_empty=0');
                        }
                    };
                };
                $output .= '<div class="ts-woocommerce-terms-holder">';
                    $output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
                    $output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-woocommerce-terms-selector wpb-input wpb-select dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;" data-selectable="' . __( "Available Terms:", "ts_visual_composer_extend" ) . '" data-selection="' . __( "Selected Terms:", "ts_visual_composer_extend" ) . '">';
                        foreach ($taxonomy_terms as $taxonomy_term) {
                            foreach ($taxonomy_term as $term) {
                                if (intval($term->count) > 0) {
                                    $output .= '<option id="" class="' . $term->slug . '" data-id="' . $term->term_id . '" data-taxonomy="' . $term->taxonomy . '" data-term="' . $term->slug . '" value="' . $term->slug . '" ' . selected(in_array($term->slug, $value_arr), true, false) . '>' . $term->name . ' (&Sigma; ' . $term->count . ')</option>';
                                }
                            }
                        }
                    $output .= '</select>';
                    $output .= '<span style="font-size: 10px; margin-bottom: 10px; width: 100%; display: block; text-align: justify;">' . __( "Click on 'Available Terms' to add that term; click on 'Selected Terms' to remove a term from selection.", "ts_visual_composer_extend" ) . '</span>';
                $output .= '</div>';
                return $output;
            }
        }
        // Create Custom Parameter Types for bbPress Elements
        // --------------------------------------------------
        if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_bbPressActive == "true") {
            // Function to generate param type "bbpress_forumslist"
            add_shortcode_param('bbpress_forumslist', 'bbpress_forumslist_settings_field');
            function bbpress_forumslist_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $allforums		= isset($settings['allforums']) ? $settings['allforums'] : 'false';
                $value_arr 		= $value;
                $args = array(
                    'post_type' 	=> bbp_get_forum_post_type(),
                    'orderby' 		=> 'title',
                    'order' 		=> 'ASC'
                );
                $forums 		= new WP_Query($args);
                $output			= '';
                $output .= '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'].'">';
                if ($allforums == "true") {
                    $output .= "<option value=''>" . __("All Forums", "ts_visual_composer_extend") . "</option>";
                }
                while ($forums->have_posts()) { 
                    $forums->the_post(); 
                    if ($value!='' && get_the_ID() == $value) {
                         $selected = ' selected="selected"';
                    } else {
                        $selected = "";
                    }
                    $output .= '<option class="' . get_the_ID() . '" data-id="' . get_the_ID() . '" data-value="' . get_the_title() . '" value="' . get_the_ID() . '"' . $selected . '>' . get_the_title() . '</option>';
                }
                wp_reset_query();
                $output .= '</select>';
                return $output;
            }
            // Function to generate param type "bbpress_topicslist"
            add_shortcode_param('bbpress_topicslist', 'bbpress_topicslist_settings_field');
            function bbpress_topicslist_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $args = array(
                    'post_type' 	=> bbp_get_topic_post_type(),
                    'orderby' 		=> 'title',
                    'order' 		=> 'ASC'
                );
                $forums 		= new WP_Query($args);
                $output			= '';
                $output .= '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';
                while ($forums->have_posts()) { 
                    $forums->the_post(); 
                    if ($value!='' && get_the_ID() == $value) {
                        $selected = ' selected="selected"';
                    } else {
                        $selected = "";
                    }
                    $output .= '<option class="' . get_the_ID() . '" data-id="' . get_the_ID() . '" data-value="' . get_the_title() . '" value="' . get_the_ID() . '"' . $selected . '>' . get_the_title() . '</option>';
                }
                wp_reset_query();
                $output .= '</select>';
                return $output;
            }
            // Function to generate param type "bbpress_replieslist"
            add_shortcode_param('bbpress_replieslist', 'bbpress_replieslist_settings_field');
            function bbpress_replieslist_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $args = array(
                    'post_type' 	=> bbp_get_reply_post_type(),
                    'orderby' 		=> 'title',
                    'order' 		=> 'ASC'
                );
                $forums 		= new WP_Query($args);
                $output			= '';
                $output .= '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';
                while ($forums->have_posts()) { 
                    $forums->the_post(); 
                    if ($value!='' && get_the_ID() == $value) {
                        $selected = ' selected="selected"';
                    } else {
                        $selected = "";
                    }
                    $output .= '<option class="' . get_the_ID() . '" data-id="' . get_the_ID() . '" data-value="' . get_the_title() . '" value="' . get_the_ID() . '"' . $selected . '>' . get_the_title() . '</option>';
                }
                wp_reset_query();
                $output .= '</select>';
                return $output;
            }
            // Function to generate param type "bbpress_tagslist"
            add_shortcode_param('bbpress_tagslist', 'bbpress_tagslist_settings_field');
            function bbpress_tagslist_settings_field($settings, $value) {
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
                $type           = isset($settings['type']) ? $settings['type'] : '';
                $tags 			= get_terms('topic-tag');
                $output			= '';
                $output .= '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';
                foreach ($tags as $item) {  
                    if ($value!='' && $item->term_id == $value) {
                        $selected = ' selected="selected"';
                    } else {
                        $selected = "";
                    }
                    $output .= '<option class="' . $item->term_id . '" value="' . $item->term_id . '"' . $selected . '>' . $item->name . '</option>';
                }
                $output .= '</select>';
                return $output;
            }        
        }
    }
?>
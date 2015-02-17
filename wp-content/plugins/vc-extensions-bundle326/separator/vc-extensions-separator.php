<?php
if (!class_exists('VC_Extensions_Separator')) {
    class VC_Extensions_Separator{
        function VC_Extensions_Separator() {
          wpb_map(array(
            "name" => __("Separator with Icon", 'vc_separator_cq'),
            "base" => "cq_vc_separator",
            "class" => "wpb_cq_vc_extension_separator",
            // "as_parent" => array('only' => 'cq_vc_separator_item'),
            "icon" => "cq_allinone_separator",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Horizontal separator with icon or text', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_separator_cq",
                "heading" => __("Display the title as:", "vc_separator_cq"),
                "param_name" => "titleas",
                "value" => array(__("Text", "vc_separator_cq") => "text", __("Font Awesome icon", "vc_separator_cq") => "icon"),
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Title", "vc_separator_cq"),
                "param_name" => "title",
                "value" => "Title",
                "dependency" => Array('element' => "titleas", 'value' => array('text')),
                "description" => __("Support <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a>.", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Font Awesome", "vc_separator_cq"),
                "param_name" => "icon",
                "value" => "fa-angle-double-down",
                "dependency" => Array('element' => "titleas", 'value' => array('icon')),
                "description" => __("Support Font Awesome icon.", "vc_separator_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the title/icon)', 'vc_separator_cq' ),
                'param_name' => 'link',
                'description' => __( '', 'vc_separator_cq' )
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_separator_cq",
                "heading" => __("Display how many icons:", "vc_separator_cq"),
                "param_name" => "iconnum",
                "value" => array("1", "2", "3", "4", "5"),
                "dependency" => Array('element' => "titleas", 'value' => array('icon')),
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_separator_cq",
                "heading" => __("Shape of the text:", "vc_separator_cq"),
                "param_name" => "titleshape1",
                "value" => array(__("rounded (border-radius 4px)", "vc_separator_cq") => "rounded", __("square (border-radius 0)", "vc_separator_cq") => "square"),
                "dependency" => Array('element' => "titleas", 'value' => array('text')),
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_separator_cq",
                "heading" => __("Shape of the icon:", "vc_separator_cq"),
                "param_name" => "titleshape2",
                "value" => array(__("circle (border-radius 50%)", "vc_separator_cq") => "circle", __("rounded (border-radius 4px)", "vc_separator_cq") => "rounded", __("square (border-radius 0)", "vc_separator_cq") => "square"),
                "dependency" => Array('element' => "titleas", 'value' => array('icon')),
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background color", 'vc_separator_cq'),
                "param_name" => "bgcolor",
                "value" => '#333',
                "description" => __("", 'vc_separator_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Font color", 'vc_separator_cq'),
                "param_name" => "fontcolor",
                "value" => '#fff',
                "description" => __("", 'vc_separator_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "#333",
                "heading" => __("Border color", 'vc_separator_cq'),
                "param_name" => "bordercolor",
                "value" => '',
                "description" => __("", 'vc_separator_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Border color for the center element", 'vc_separator_cq'),
                "param_name" => "centerbordercolor",
                "value" => '',
                "description" => __("", 'vc_separator_cq')
              ),
              // array(
              //   "type" => "dropdown",
              //   "holder" => "",
              //   "class" => "vc_separator_cq",
              //   "heading" => __("Title position", "vc_separator_cq"),
              //   "param_name" => "titleposition",
              //   "value" => array(__("Align center", "vc_separator_cq") => "center", __("Align center", "vc_separator_cq") => "center",__("Align left", "vc_separator_cq") => "left", __("Align right", "vc_separator_cq") => "right"),
              //   "description" => __("", "vc_separator_cq")
              // ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_separator_cq",
                "heading" => __("Border style", "vc_separator_cq"),
                "param_name" => "borderstyle",
                "value" => array("solid", "dashed", "dotted", "gradient-color"),
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Left color for the gradient-color", 'vc_separator_cq'),
                "param_name" => "leftcolor",
                "value" => '#4ac1ff',
                "dependency" => Array('element' => "borderstyle", 'value' => array('gradient-color')),
                "description" => __("", 'vc_separator_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Center color for the gradient-color", 'vc_separator_cq'),
                "param_name" => "centercolor",
                "value" => '#663399',
                "dependency" => Array('element' => "borderstyle", 'value' => array('gradient-color')),
                "description" => __("", 'vc_separator_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Right color for the gradient-color", 'vc_separator_cq'),
                "param_name" => "rightcolor",
                "value" => '#795bb0',
                "dependency" => Array('element' => "borderstyle", 'value' => array('gradient-color')),
                "description" => __("", 'vc_separator_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_separator_cq",
                "heading" => __("Element width", "vc_separator_cq"),
                "param_name" => "elementwidth",
                "value" => array("100%", "90%", "80%", "70%", "60%", "50%", "40%"),
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Position (CSS left here) of the text/icon:", "vc_separator_cq"),
                "param_name" => "titleposition",
                "value" => "50%",
                "description" => __("Default is 50%, stand for center. 0 stand for left, 80% stand for right.", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Width for the text/icon:", "vc_separator_cq"),
                "param_name" => "titlewidth",
                "value" => "",
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Border size", "vc_separator_cq"),
                "param_name" => "bordersize",
                "value" => "1px",
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Text/icon font size:", "vc_separator_cq"),
                "param_name" => "fontsize",
                "value" => "1em",
                "description" => __("", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-family for the text", "vc_separator_cq"),
                "param_name" => "fontfamily",
                "value" => "",
                "dependency" => Array('element' => "titleas", 'value' => array('text')),
                "description" => __("You can specify the CSS font-family for the text here.", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Border radius", "vc_separator_cq"),
                "param_name" => "customborderradius",
                "value" => "",
                // "dependency" => Array('element' => "titleshape", 'value' => array('custom')),
                "description" => __("You can select the shape above or specify the border-radius for the text/icon background here.", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS margin for this separator", "vc_separator_cq"),
                "param_name" => "margin",
                "value" => "",
                "description" => __("Default is margin: 4em auto.", "vc_separator_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS padding for the text/icon", "vc_separator_cq"),
                "param_name" => "padding",
                "value" => "",
                "description" => __("Default is 0.4em 0.6em for rounded and square.", "vc_separator_cq")
              )
           )
        ));

        function cq_vc_separator_func($atts, $content=null) {
          extract(shortcode_atts(array(
            "titleas" => 'text',
            "title" => 'Title',
            "link" => '',
            "icon" => 'fa-tree',
            "iconnum" => '1',
            "bgcolor" => '',
            "fontcolor" => '',
            "bordercolor" => '#333',
            "centerbordercolor" => '',
            "borderstyle" => 'solid',
            "titleposition" => '50%',
            "titlewidth" => '',
            "titleshape1" => 'rounded',
            "titleshape2" => 'rounded',
            "leftcolor" => '',
            "centercolor" => '',
            "rightcolor" => '',
            "bordersize" => '1px',
            "fontsize" => '1em',
            "padding" => '',
            "margin" => '',
            "fontfamily" => '',
            "customborderradius" => '',
            "elementwidth" => '100%',
          ), $atts));


          $i = -1;
          $output = '';
          wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
          wp_enqueue_style( 'font-awesome' );
          wp_register_style( 'vc-extensions-separator-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-separator-style' );
          wp_register_script('vc-extensions-separator-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-separator-script');
          $borderradius = '4px';
          $link = vc_build_link($link);
          $titleshape = '';
          if($titleas=="icon"){
            $titleshape = $titleshape2;
          }else{
            $titleshape = $titleshape1;
          }
          if($titleshape=="square"){
              $borderradius = '0px';
          }else if($titleshape=="rounded"){
              $borderradius = '4px';
          }else if($titleshape=="circle"){
              $borderradius = '50%';
          }
          if($customborderradius!="") $borderradius = $customborderradius;
          $output .= '<div class="cq-hr cq-hr-'.$titleshape.'" data-bgcolor="'.$bgcolor.'" data-fontcolor="'.$fontcolor.'" data-shape="'.$titleshape.'" data-borderstyle="'.$borderstyle.'" data-bordercolor="'.$bordercolor.'" data-centerbordercolor="'.$centerbordercolor.'" data-leftcolor="'.$leftcolor.'" data-centercolor="'.$centercolor.'" data-rightcolor="'.$rightcolor.'" data-elementwidth="'.$elementwidth.'" data-bordersize="'.$bordersize.'" data-fontsize="'.$fontsize.'" data-titleposition="'.$titleposition.'" data-titlewidth="'.$titlewidth.'" data-borderradius="'.$borderradius.'" data-padding="'.$padding.'" data-fontfamily="'.$fontfamily.'" data-margin="'.$margin.'">';
          $output .= '<div class="cq-hr-icon-container">';
          if($titleas=="icon"){
              if($link['url']!=""){
                $output .= '<a href="'.$link['url'].'" title="'.$link['title'].'" target="'.$link['target'].'" class="cq-hr-link">';
              }
              for ($i=0; $i < $iconnum; $i++) {
                  $output .= '<i style="" class="cq-hr-symbol fa '.$icon.'"></i>';
              }
              if($link['url']!=""){
                $output .= '</a>';
              }
          }else{
              if($link['url']!=""){
                $output .= '<a href="'.$link['url'].'" title="'.$link['title'].'" target="'.$link['target'].'">';
              }
              $output .= '<i style="" class="cq-hr-symbol">'.$title.'</i>';
              if($link['url']!=""){
                $output .= '</a>';
              }
          }
          $output .= '</div>';
          $output .= '</div>';
          return $output;

        }

        add_shortcode('cq_vc_separator', 'cq_vc_separator_func');

      }
  }

}

?>
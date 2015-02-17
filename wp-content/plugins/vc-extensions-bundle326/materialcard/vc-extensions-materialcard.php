<?php
if (!class_exists('VC_Extensions_MaterialCard')) {
    class VC_Extensions_MaterialCard{
        function VC_Extensions_MaterialCard() {
          wpb_map(array(
            "name" => __("Material Card", 'vc_materialcard_cq'),
            "base" => "cq_vc_materialcard",
            "class" => "wpb_cq_vc_extension_materialcard",
            // "as_parent" => array('only' => 'cq_vc_materialcard_item'),
            "icon" => "cq_allinone_materialcard",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Add Google Material style card', 'js_composer'),
            "params" => array(
              array(
                "type" => "textfield",
                "heading" => __("Card title", "vc_materialcard_cq"),
                "param_name" => "title",
                "value" => "",
                "description" => __("", "vc_materialcard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title color", 'vc_materialcard_cq'),
                "param_name" => "titlecolor",
                "value" => '',
                "description" => __("", 'vc_materialcard_cq')
              ),
              array(
                "type" => "textarea_html",
                "heading" => __("Card content:", "vc_materialcard_cq"),
                "param_name" => "content",
                "value" => "Here is the content, please edit it in the editor.",
                "description" => __("", "vc_materialcard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content color", 'vc_materialcard_cq'),
                "param_name" => "contentcolor",
                "value" => '',
                "description" => __("", 'vc_materialcard_cq')
              ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Author:", "vc_materialcard_cq"),
              //   "param_name" => "author",
              //   "value" => "",
              //   "description" => __("", "vc_materialcard_cq")
              // ),
              array(
                "type" => "textarea_raw_html",
                "heading" => __("Label under the content (on the right):", "vc_materialcard_cq"),
                "param_name" => "label",
                "value" => "",
                "description" => __("Support HTML here, for example &lt;i class=&#039;fa fa-twitter&#039;&gt;&lt;/i&gt; will insert a <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a>.", "vc_materialcard_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the label)', 'vc_materialcard_cq' ),
                'param_name' => 'link',
                'description' => __( '', 'vc_materialcard_cq' )
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_materialcard_cq",
                "heading" => __("Border and link color option:", "vc_materialcard_cq"),
                "param_name" => "colorstyle",
                "value" => array("Medium Gray" => "#AAB2BD", "Grass" => "#8CC152", "Lavender" => "#967ADC", "Grapefruit" => "#DA4453", "Sunflower" => "#F6BB42", "Blue" => "#4A89DC", "Pink" => "#D770AD", "Mint" => "#37BC9B", "Aqua" => "#3BAFDA", "Light Gray" => "#E6E9ED",  "Dark Gray" => "#434A54", "Or customize below:" => "customized"),
                "description" => __("", "vc_materialcard_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Customize border and link color", 'vc_materialcard_cq'),
                "param_name" => "bordercolor",
                "value" => '',
                "dependency" => Array('element' => "colorstyle", 'value' => array('customized')),
                "description" => __("", 'vc_materialcard_cq')
              ),
              array(
                  "type" => "checkbox",
                  "holder" => "",
                  "class" => "vc_materialcard_cq",
                  "heading" => __("Do not apply ripple effect to the label link.", 'vc_materialcard_cq'),
                  "param_name" => "isripple",
                  "value" => array(__("Yes, do not show the ripple", "vc_materialcard_cq") => 'on'),
                  "description" => __("We'll add ripple effect to the label link by default, you can check this if you don't want it.", 'vc_materialcard_cq')
                ),
              // array(
              //   "type" => "textfield",
              //   "heading" => __("Not apply the ripple effect to these link:", "vc_materialcard_cq"),
              //   "param_name" => "noripplelink",
              //   "value" => "",
              //   "description" => __("Specify a class name of the link you do not want the ripple effect here.", "vc_materialcard_cq")
              // ),
              array(
                "type" => "textfield",
                "heading" => __("CSS margin of the title:", "vc_materialcard_cq"),
                "param_name" => "titlemargin",
                "value" => "",
                "description" => __("Default is 0.5em 0, which stand for margin 0.5em for top and bottom. You can specify other value here.", "vc_materialcard_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Width of the whole card:", "vc_materialcard_cq"),
                "param_name" => "cardwidth",
                "value" => "",
                "description" => __("Default is 90%.", "vc_materialcard_cq")
              )
           )
        ));

        function cq_vc_materialcard_func($atts, $content=null) {
          extract(shortcode_atts(array(
            "title" => '',
            "titlecolor" => '',
            "contentcolor" => '',
            "author" => '',
            "label" => '',
            "bordercolor" => '',
            "link" => '',
            // "noripplelink" => '',
            "isripple" => '',
            "colorstyle" => '',
            "titlemargin" => '',
            "cardwidth" => '',
          ), $atts));


          $output = '';
          wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
          wp_enqueue_style( 'font-awesome' );
          wp_register_style( 'vc-extensions-materialcard-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-materialcard-style' );
          wp_register_script('vc-extensions-materialcard-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-materialcard-script');
          $link = vc_build_link($link);
          $output .= '<div class="cq-material-card" data-bordercolor="'.$bordercolor.'" data-colorstyle="'.$colorstyle.'" data-isripple="'.$isripple.'" data-titlecolor="'.$titlecolor.'" data-contentcolor="'.$contentcolor.'" data-cardwidth="'.$cardwidth.'" data-titlemargin="'.$titlemargin.'">';
          $output .= '<div class="material-card-content">';
          if($title!="") $output .= '<h3 class="material-card-title">'.$title.'</h3>';
          $output .= '<p class="material-card-summary">'.do_shortcode($content).'</p>';
          // if($author!="") $output .= '<p class="card-author">'.$author.'</p>';
          if($label!="") {
              if($link["url"]!==""){
                  $output .= '<div class="material-card-label">';
                  $output .= '<a href="'.$link["url"].'" title="'.$link["title"].'" target="'.$link["target"].'" class="material-card-label-link">';
                  $output .= rawurldecode(base64_decode($label));
                  $output .= '</a>';
                  $output .= '</div>';
              }else{
                  $output .= '<div class="material-card-label">';
                  $output .= rawurldecode(base64_decode($label));
                  $output .= '</div>';
              }

          }
          $output .= '</div>';
          $output .= '</div>';
          $output .= '';
          return $output;

        }

        add_shortcode('cq_vc_materialcard', 'cq_vc_materialcard_func');

      }
  }

}

?>
<?php
if (!class_exists('VC_Extensions_CubeBox')) {
    class VC_Extensions_CubeBox{
        function VC_Extensions_CubeBox() {
          wpb_map(array(
            "name" => __("Cube Box", 'vc_cubebox_cq'),
            "base" => "cq_vc_cubebox",
            "class" => "wpb_cq_vc_extension_cubebox",
            // "as_parent" => array('only' => 'cq_vc_cubebox_item'),
            "icon" => "cq_allinone_cubebox",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Rotate on hover', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_cubebox_cq",
                "heading" => __("Display the header avatar with:", "vc_cubebox_cq"),
                "param_name" => "frontavatar",
                "value" => array("none" => "none", "Image" => "image", "Font Awesome icon" => "icon"),
                "group" => "Front Card",
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Header image", "vc_cubebox_cq"),
                "param_name" => "frontimage",
                "value" => "",
                "dependency" => Array('element' => "frontavatar", 'value' => array('image')),
                "group" => "Front Card",
                "description" => __("Select image from media library.", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Header icon:", "vc_cubebox_cq"),
                "param_name" => "fronticon",
                "value" => "",
                "group" => "Front Card",
                "dependency" => Array('element' => "frontavatar", 'value' => array('icon')),
                "description" => __("For example fa-twitter will insert a Twitter <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a>", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Front Card title (optional):", "vc_cubebox_cq"),
                "param_name" => "fronttitle",
                "value" => "",
                "group" => "Front Card",
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                "type" => "textarea",
                "heading" => __("Front Card content (optional):", "vc_cubebox_cq"),
                "param_name" => "frontcontent",
                "value" => "",
                "group" => "Front Card",
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_cubebox_cq",
                "heading" => __("Display the header avatar with:", "vc_cubebox_cq"),
                "param_name" => "backavatar",
                "value" => array("none" => "none", "Image" => "image", "Font Awesome icon" => "icon"),
                "group" => "Back Card",
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Header image", "vc_cubebox_cq"),
                "param_name" => "backimage",
                "value" => "",
                "dependency" => Array('element' => "backavatar", 'value' => array('image')),
                "group" => "Back Card",
                "description" => __("Select image from media library.", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Header icon:", "vc_cubebox_cq"),
                "param_name" => "backicon",
                "value" => "",
                "group" => "Back Card",
                "dependency" => Array('element' => "backavatar", 'value' => array('icon')),
                "description" => __("For example fa-twitter will insert a Twitter <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a>", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Back Card title (optional):", "vc_cubebox_cq"),
                "param_name" => "backtitle",
                "value" => "",
                "group" => "Back Card",
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                "type" => "textarea",
                "heading" => __("Back Card content (optional):", "vc_cubebox_cq"),
                "param_name" => "backcontent",
                "value" => "",
                "group" => "Back Card",
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for the whole Cube)', 'vc_cubebox_cq' ),
                'param_name' => 'link',
                'group' => 'Link',
                'description' => __( '', 'vc_cubebox_cq' )
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_cubebox_cq",
                "heading" => __("Auto rotate Cube", "vc_cubebox_cq"),
                "param_name" => "rotatecube",
                'value' => array(2, 3, 4, 5, 7, 10, __( 'Disable', 'vc_cubebox_cq' ) => 0 ),
                'std' => 0,
                'group' => 'Auto rotate?',
                "description" => __("Auto rotate Cube in each X seconds.", "vc_cubebox_cq")
              ),
              // array(
              //   "type" => "textarea_html",
              //   "heading" => __("Back Card content, support HTML link etc here:", "vc_cubebox_cq"),
              //   "param_name" => "content",
              //   "value" => "Here is the content, please edit it in the editor.",
              //   "group" => "Back Card",
              //   "description" => __("", "vc_cubebox_cq")
              // ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_cubebox_cq",
                "heading" => __("Cube Color style:", "vc_cubebox_cq"),
                "param_name" => "cardstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'mediumgray',
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Front Card background", 'vc_cubebox_cq'),
                "param_name" => "frontbg",
                "value" => '',
                "dependency" => Array('element' => "cardstyle", 'value' => array('customized')),
                "description" => __("", 'vc_cubebox_cq')
              ),

              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Back Card background", 'vc_cubebox_cq'),
                "param_name" => "backbg",
                "value" => '',
                "dependency" => Array('element' => "cardstyle", 'value' => array('customized')),
                "description" => __("", 'vc_cubebox_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_cubebox_cq",
                "heading" => __("Cube transition direction", "vc_cubebox_cq"),
                "param_name" => "cubedirection",
                "value" => array("Bottom to top" => "bottomtop", "Right to left" => "rightleft"),
                "description" => __("", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Width of the whole Cube:", "vc_cubebox_cq"),
                "param_name" => "cubewidth",
                "value" => "",
                "description" => __("Default is 90%.", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Height of the whole Cube:", "vc_cubebox_cq"),
                "param_name" => "cubeheight",
                "value" => "",
                "description" => __("Default is 200px. You can specify other value here.", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Size of the Avatar (image or icon):", "vc_cubebox_cq"),
                "param_name" => "avatarsize",
                "value" => "",
                "description" => __("Default is 80(px). You can specify other value here (without the px).", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the title:", "vc_cubebox_cq"),
                "param_name" => "titlesize",
                "value" => "",
                "description" => __("Default is 1.8em. You can specify other value here.", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the content:", "vc_cubebox_cq"),
                "param_name" => "contentsize",
                "value" => "",
                "description" => __("Default is 1em. You can specify other value here.", "vc_cubebox_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Width of the title and content:", "vc_cubebox_cq"),
                "param_name" => "contentwidth",
                "value" => "",
                "description" => __("Default is 90%. You can specify other value here.", "vc_cubebox_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Avatar Font Awesome icon color:", 'vc_cubebox_cq'),
                "param_name" => "iconcolor",
                "value" => '',
                "description" => __("You can specify the color for the Font Awesome icon here, default is same as the title and content color.", 'vc_cubebox_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Color of the title and content:", 'vc_cubebox_cq'),
                "param_name" => "contentcolor",
                "value" => '',
                "description" => __("", 'vc_cubebox_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("CSS margin of the whole Cube:", "vc_cubebox_cq"),
                "param_name" => "cubemargin",
                "value" => "",
                "description" => __("Default is 12px 0 0 0, which stand for margin-top 12px. You can specify other value here.", "vc_cubebox_cq")
              )

           )
        ));

        function cq_vc_cubebox_func($atts, $content=null) {
          extract(shortcode_atts(array(
            "cubeheight" => '',
            "fronttitle" => '',
            "frontcontent" => '',
            "backcontent" => '',
            "frontavatar" => 'none',
            "frontimage" => '',
            "fronticon" => '',
            "backavatar" => 'none',
            "backimage" => '',
            "backicon" => '',
            "backtitle" => '',
            "frontbg" => '',
            "backbg" => '',
            "cubedirection" => 'bottomtop',
            "cardstyle" => 'mediumgray',
            "avatarsize" => '80',
            "contentcolor" => '',
            "contentsize" => '',
            "contentwidth" => '',
            "rotatecube" => '',
            "iconcolor" => '',
            "cubemargin" => '',
            "cubewidth" => '',
            "link" => ''
          ), $atts));

          $color_style_arr = array("grapefruit" => array("#ED5565", "#DA4453"), "bittersweet" => array("#FC6E51", "#E9573F"), "sunflower" => array("#FFCE54", "#F6BB42"), "grass" => array("#A0D468", "#8CC152"), "mint" => array("#48CFAD", "#37BC9B"), "aqua" => array("#4FC1E9", "#3BAFDA"), "bluejeans" => array("#5D9CEC", "#4A89DC"), "lavender" => array("#AC92EC", "#967ADC"), "pinkrose" => array("#EC87C0", "#D770AD"), "lightgray" => array("#F5F7FA", "#E6E9ED"), "mediumgray" => array("#CCD1D9", "#AAB2BD"), "darkgray" => array("#656D78", "#434A54"), "customized" => array("$frontbg", "$backbg") );
          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';
          wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
          wp_enqueue_style( 'font-awesome' );
          wp_register_style( 'vc-extensions-cubebox-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-cubebox-style' );
          wp_register_script('vc-extensions-cubebox-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-cubebox-script');
          $link = vc_build_link($link);
          $frontimage = wp_get_attachment_image_src($frontimage, 'full');
          $backimage = wp_get_attachment_image_src($backimage, 'full');
          $cardstyle_arr = $color_style_arr[$cardstyle];
          $fontcolor = '';
          if($cardstyle=="lightgray"){
            $fontcolor = "#666";
          }
          $cq_card_face_1 = $cq_card_face2 = '';
          if($cubedirection=="bottomtop"){
            $cq_card_face_1 = 'cq-face-front';
            $cq_card_face_2 = 'cq-face-back';
          }else{
            $cq_card_face_1 = 'cq-face-left';
            $cq_card_face_2 = 'cq-face-right';
          }
          $output .= '<div class="cq-twoface-box-container" data-frontbg="'.$cardstyle_arr[0].'" data-backbg="'.$cardstyle_arr[1].'" data-fontcolor="'.$fontcolor.'" data-face1="'.$cq_card_face_1.'" data-face2="'.$cq_card_face_2.'" data-cubedirection="'.$cubedirection.'" data-cubeheight="'.$cubeheight.'" data-avatarsize="'.$avatarsize.'" data-contentcolor="'.$contentcolor.'" data-contentsize="'.$contentsize.'" data-contentwidth="'.$contentwidth.'" data-rotatecube="'.$rotatecube.'" data-iconcolor="'.$iconcolor.'" data-cubemargin="'.$cubemargin.'" data-cubewidth="'.$cubewidth.'">';

          if($link["url"]!=="") $output .= '<a href="'.$link["url"].'" title="'.$link["title"].'" target="'.$link["target"].'" class="cq-twoface-link">';
          $output .= '<div class="cq-twoface-box">';
          $output .= '<div class="cq-face-item '.$cq_card_face_1.'">';
          $output .= '<div class="cq-face-content">';
          if($frontavatar=="image"){
              if($frontimage[0]!="")$output .= '<img src="'.aq_resize($frontimage[0], $avatarsize*2, $avatarsize*2, true, true, true).'" width="'.$avatarsize.'" height="'.$avatarsize.'" class="cq-face-avatar" />';
          }elseif ($frontavatar=="icon") {
              $output .= '<i class="fa cq-face-avatar '.$fronticon.'"></i>';
          }
          if($fronttitle!=""){
              $output .= '<h4 class="cq-face-title">';
              $output .= $fronttitle;
              $output .= '</h4>';
          }
          $output .= $frontcontent;
          $output .= '</div>';
          $output .= '</div>';
          $output .= '<div class="cq-face-item '.$cq_card_face_2.'">';
          $output .= '<div class="cq-face-content">';
          if($backavatar=="image"){
              if($backimage[0]!="") $output .= '<img src="'.aq_resize($backimage[0], $avatarsize*2, $avatarsize*2, true, true, true).'" width="'.$avatarsize.'" height="'.$avatarsize.'" class="cq-face-avatar" />';
          }elseif ($backavatar=="icon") {
              $output .= '<i class="fa cq-face-avatar '.$backicon.'"></i>';
          }

          // $output .= '<img src="http://wp.cq.com/wp-content/uploads/2014/09/type-away-640x480.jpg" class="cq-face-avatar" />';
          if($backtitle!=""){
              $output .= '<h4 class="cq-face-title">';
              $output .= $backtitle;
              $output .= '</h4>';
          }
          $output .= $backcontent;
          $output .= '</div>';
          $output .= '</div>';
          // $output .= '<div class="cq-face-item cq-face-left">';
          // $output .= 'Front Face';
          // $output .= '</div>';
          // $output .= '<div class="cq-face-item cq-face-right">';
          // $output .= 'Back Face';
          // $output .= '</div>';
          $output .= '</div>';
          if($link["url"]!=="") $output .= '</a>';
          $output .= '</div>';
          return $output;

        }

        add_shortcode('cq_vc_cubebox', 'cq_vc_cubebox_func');

      }
  }

}

?>
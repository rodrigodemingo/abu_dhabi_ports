<?php
if (!class_exists('VC_Extensions_SideBySide ')) {
    class VC_Extensions_SideBySide{
        function VC_Extensions_SideBySide () {
          wpb_map(array(
            "name" => __("Side by Side", 'vc_sidebyside_cq'),
            "base" => "cq_vc_sidebyside",
            "class" => "wpb_cq_vc_extension_sidebyside",
            // "as_parent" => array('only' => 'cq_vc_sidebyside_item'),
            "icon" => "cq_allinone_sidebyside",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Card with image, icon and text', 'js_composer'),
            "params" => array(
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Choose the mode, display the card with:", "vc_sidebyside_cq"),
                "param_name" => "card1avatar",
                "value" => array("Text Only" => "none", "Image (with tooltip)" => "image", "Icon (Font Awesome icon)" => "icon"),
                "group" => "Card 1",
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Card image:", "vc_sidebyside_cq"),
                "param_name" => "card1image",
                "value" => "",
                "dependency" => Array('element' => "card1avatar", 'value' => array('image')),
                "group" => "Card 1",
                "description" => __("Select image from media library.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Card icon:", "vc_sidebyside_cq"),
                "param_name" => "card1icon",
                "value" => "",
                "dependency" => Array('element' => "card1avatar", 'value' => array('icon')),
                "group" => "Card 1",
                "description" => __("Support Font Awesome icon, for example fa-twitter will insert a Twitter <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a>", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color", 'vc_sidebyside_cq'),
                "param_name" => "card1iconcolor",
                "value" => '',
                "group" => "Card 1",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Text follow the icon (optional):", "vc_sidebyside_cq"),
                "param_name" => "card1icontext",
                "value" => "",
                "group" => "Card 1",
                "dependency" => Array('element' => "card1avatar", 'value' => array('icon')),
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Size of the Font Awesome icon (and optional follow text):", "vc_sidebyside_cq"),
                "param_name" => "card1iconsize",
                "value" => "1.2em",
                "group" => "Card 1",
                "dependency" => Array('element' => "card1avatar", 'value' => array('icon')),
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Card 1 title (optional):", "vc_sidebyside_cq"),
                "param_name" => "card1title",
                "value" => "",
                "group" => "Card 1",
                "description" => __("Will be displayed as <strong>tooltip</strong> in the image mode.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title color", 'vc_sidebyside_cq'),
                "param_name" => "card1titlecolor",
                "value" => '',
                "group" => "Card 1",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "textarea",
                "heading" => __("Card 1 content (optional):", "vc_sidebyside_cq"),
                "param_name" => "card1content",
                "value" => "",
                "group" => "Card 1",
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content color", 'vc_sidebyside_cq'),
                "param_name" => "card1contentcolor",
                "value" => '',
                "group" => "Card 1",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "textarea_raw_html",
                "heading" => __("Divider text", "vc_sidebyside_cq"),
                "param_name" => "divider",
                "value" => "",
                "group" => "Divider",
                "description" => __("The divider in the center of the 2 cards. Support HTML here, for example &lt;i class=&#039;fa fa-twitter&#039;&gt;&lt;/i&gt; will insert a Twitter <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a>", "vc_sidebyside_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Divider background shape:", "vc_sidebyside_cq"),
                "param_name" => "dividerborder",
                "value" => array("circle" => "50%", "rounded" => "4px", "square" => "0"),
                "group" => "Divider",
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the divider:", "vc_sidebyside_cq"),
                "param_name" => "dividerfontsize",
                "value" => "",
                "group" => "Divider",
                "description" => __("Default is 1em.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("width of the divider:", "vc_sidebyside_cq"),
                "param_name" => "dividerwidth",
                "value" => "",
                "group" => "Divider",
                "description" => __("Default is 36px.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("height of the divider:", "vc_sidebyside_cq"),
                "param_name" => "dividerheight",
                "value" => "",
                "group" => "Divider",
                "description" => __("Default is 36px.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Divider background", 'vc_sidebyside_cq'),
                "param_name" => "dividerbg",
                "value" => '#fff',
                "group" => "Divider",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Divider text color", 'vc_sidebyside_cq'),
                "param_name" => "dividercolor",
                "value" => '#333',
                "group" => "Divider",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Apply border in the divider?", "vc_sidebyside_cq"),
                "param_name" => "isgap",
                "value" => array("No" => "", "Yes" => "cq-isgap"),
                "group" => "Divider",
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Color of the divider border:", 'vc_sidebyside_cq'),
                "param_name" => "gapcolor",
                "value" => '',
                "group" => "Divider",
                "dependency" => Array('element' => "isgap", 'value' => array('cq-isgap')),
                "description" => __("The color of the gap between 2 cards, default is white.", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Choose the mode, display the card with:", "vc_sidebyside_cq"),
                "param_name" => "card2avatar",
                "value" => array("Text Only" => "none", "Image (with tooltip)" => "image", "Icon (Font Awesome icon)" => "icon"),
                "group" => "Card 2",
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "attach_image",
                "heading" => __("Card image:", "vc_sidebyside_cq"),
                "param_name" => "card2image",
                "value" => "",
                "dependency" => Array('element' => "card2avatar", 'value' => array('image')),
                "group" => "Card 2",
                "description" => __("Select image from media library.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Font Awesome icon:", "vc_sidebyside_cq"),
                "param_name" => "card2icon",
                "value" => "",
                "dependency" => Array('element' => "card2avatar", 'value' => array('icon')),
                "group" => "Card 2",
                "description" => __("For example fa-twitter will insert a Twitter <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome icon</a>", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color", 'vc_sidebyside_cq'),
                "param_name" => "card2iconcolor",
                "value" => '',
                "group" => "Card 2",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Text follow the icon (optional):", "vc_sidebyside_cq"),
                "param_name" => "card2icontext",
                "value" => "",
                "group" => "Card 2",
                "dependency" => Array('element' => "card2avatar", 'value' => array('icon')),
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Size of the Font Awesome icon (and optional follow text):", "vc_sidebyside_cq"),
                "param_name" => "card2iconsize",
                "value" => "1.2em",
                "group" => "Card 2",
                "dependency" => Array('element' => "card2avatar", 'value' => array('icon')),
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Card 2 title (optional):", "vc_sidebyside_cq"),
                "param_name" => "card2title",
                "value" => "",
                "group" => "Card 2",
                "description" => __("Will be displayed as <strong>tooltip</strong> in the image mode.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title color", 'vc_sidebyside_cq'),
                "param_name" => "card2titlecolor",
                "value" => '',
                "group" => "Card 2",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "textarea",
                "heading" => __("Card 2 content (optional):", "vc_sidebyside_cq"),
                "param_name" => "card2content",
                "value" => "",
                "group" => "Card 2",
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content color", 'vc_sidebyside_cq'),
                "param_name" => "card2contentcolor",
                "value" => '',
                "group" => "Card 2",
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for this Card)', 'vc_sidebyside_cq' ),
                'param_name' => 'card1link',
                'group' => 'Card 1',
                'description' => __( '', 'vc_sidebyside_cq' )
              ),
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Optional link for this Card)', 'vc_sidebyside_cq' ),
                'param_name' => 'card2link',
                'group' => 'Card 2',
                'description' => __( '', 'vc_sidebyside_cq' )
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Display the card, side by side from:", "vc_sidebyside_cq"),
                "param_name" => "carddirection",
                "value" => array("left to right" => "leftright", "top to bottom" => "topbottom"),
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Display the card in shape:", "vc_sidebyside_cq"),
                "param_name" => "cardshape",
                "value" => array("Square" => "", "Rounded" => "cq-rounded"),
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Card color style:", "vc_sidebyside_cq"),
                "param_name" => "cardstyle",
                "value" => array("Grape Fruit" => "grapefruit", "Bitter Sweet" => "bittersweet", "Sunflower" => "sunflower", "Grass" => "grass", "Mint" => "mint", "Aqua" => "aqua", "Blue Jeans" => "bluejeans", "Lavender" => "lavender", "Pink Rose" => "pinkrose", "Light Gray" => "lightgray", "Medium Gray" => "mediumgray", "Dark Gray" => "darkgray", "Customized color:" => "customized"),
                'std' => 'mediumgray',
                "description" => __("", "vc_sidebyside_cq")
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_sidebyside_cq",
                "heading" => __("Tooltip position:", "vc_sidebyside_cq"),
                "param_name" => "tooltipposition",
                "value" => array("top" => "top", "bottom" => "bottom", "left" => "left", "right" => "right"),
                "description" => __("Tooltip only available with the image mode.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Card 1 background", 'vc_sidebyside_cq'),
                "param_name" => "card1bg",
                "value" => '',
                "dependency" => Array('element' => "cardstyle", 'value' => array('customized')),
                "description" => __("", 'vc_sidebyside_cq')
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Card 2 background", 'vc_sidebyside_cq'),
                "param_name" => "card2bg",
                "value" => '',
                "dependency" => Array('element' => "cardstyle", 'value' => array('customized')),
                "description" => __("", 'vc_sidebyside_cq')
              ),

              array(
                "type" => "textfield",
                "heading" => __("height of the whole element:", "vc_sidebyside_cq"),
                "param_name" => "cardheight",
                "value" => "",
                "description" => __("Default is 200px. You can specify other value here.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("width of the whole element:", "vc_sidebyside_cq"),
                "param_name" => "elementwidth",
                "value" => "",
                "description" => __("Default is 100%. You can specify other value here.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Resize the images to this width:", "vc_sidebyside_cq"),
                "param_name" => "imagewidth",
                "value" => "",
                "description" => __("Specify a width here (for example 480), otherwise we will use the original image.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the title (in card 1 and card 2):", "vc_sidebyside_cq"),
                "param_name" => "titlesize",
                "value" => "",
                "description" => __("Default is 1.2em. You can specify other value here.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("font-size of the content: (in card 1 and card 2)", "vc_sidebyside_cq"),
                "param_name" => "contentsize",
                "value" => "",
                "description" => __("Default is 1em. You can specify other value here.", "vc_sidebyside_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("width of the title and content (in card 1 and card 2):", "vc_sidebyside_cq"),
                "param_name" => "contentwidth",
                "value" => "",
                "description" => __("Default is 90%. You can specify other value here.", "vc_sidebyside_cq")
              ),
              //  array(
              //   "type" => "colorpicker",
              //   "holder" => "div",
              //   "class" => "",
              //   "heading" => __("Color of the optional follow text in the icon mode:", 'vc_sidebyside_cq'),
              //   "param_name" => "followtextcolor",
              //   "value" => '',
              //   "description" => __("", 'vc_sidebyside_cq')
              // ),
              array(
                "type" => "textfield",
                "heading" => __("CSS margin of the whole element:", "vc_sidebyside_cq"),
                "param_name" => "cardmargin",
                "value" => "",
                "description" => __("Default is margin: 12px auto 0 auto. You can specify other value here.", "vc_sidebyside_cq")
              )

           )
        ));

        function cq_vc_sidebyside_func($atts, $content=null) {
          extract(shortcode_atts(array(
            "divider" => '',
            "dividerbg" => '',
            "dividercolor" => '',
            "dividerborder" => '0',
            "dividerfontsize" => '',
            "dividerwidth" => '',
            "dividerheight" => '',
            "card1avatar" => '',
            "card1image" => '',
            "card1icon" => '',
            "card1icontext" => '',
            "card1iconsize" => '',
            "card1title" => '',
            "card1titlecolor" => '',
            "card1contentcolor" => '',
            "card1iconcolor" => '',
            "card1bg" => '',
            "card2bg" => '',
            "card1content" => '',
            "card2avatar" => '',
            "card2image" => '',
            "card2icon" => '',
            "card2icontext" => '',
            "card2iconsize" => '',
            "card2title" => '',
            "card2titlecolor" => '',
            "card2contentcolor" => '',
            "card2iconcolor" => '',
            "card2content" => '',
            "card1link" => '',
            "card2link" => '',
            "cardstyle" => '',
            "cardheight" => '',
            "titlesize" => '',
            "contentwidth" => '',
            "contentsize" => '',
            "carddirection" => 'leftright',
            "elementwidth" => '',
            "cardmargin" => '',
            "tooltipposition" => 'top',
            "imagewidth" => '',
            "followtextcolor" => '',
            "cardshape" => '',
            "isgap" => '',
            "gapcolor" => '',
            "link" => ''
          ), $atts));

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';
          wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
          wp_enqueue_style( 'font-awesome' );

          wp_register_style('tooltipster', plugins_url('../appmockup/css/tooltipster.css', __FILE__));
          wp_enqueue_style('tooltipster');
          wp_register_script('tooltipster', plugins_url('../appmockup/js/jquery.tooltipster.js', __FILE__), array('jquery'));
          wp_enqueue_script('tooltipster');

          wp_register_style( 'vc-extensions-sidebyside-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-sidebyside-style' );

          wp_register_script('vc-extensions-sidebyside-script', plugins_url('js/init.min.js', __FILE__), array("jquery", "tooltipster"));
          wp_enqueue_script('vc-extensions-sidebyside-script');


          $card1link = vc_build_link($card1link);
          $card2link = vc_build_link($card2link);

          $color_style_arr = array("grapefruit" => array("#ED5565", "#DA4453"), "bittersweet" => array("#FC6E51", "#E9573F"), "sunflower" => array("#FFCE54", "#F6BB42"), "grass" => array("#A0D468", "#8CC152"), "mint" => array("#48CFAD", "#37BC9B"), "aqua" => array("#4FC1E9", "#3BAFDA"), "bluejeans" => array("#5D9CEC", "#4A89DC"), "lavender" => array("#AC92EC", "#967ADC"), "pinkrose" => array("#EC87C0", "#D770AD"), "lightgray" => array("#F5F7FA", "#E6E9ED"), "mediumgray" => array("#CCD1D9", "#AAB2BD"), "darkgray" => array("#656D78", "#434A54"), "customized" => array("$card1bg", "$card2bg") );

          $cardstyle_arr = $color_style_arr[$cardstyle];
          $card1image = wp_get_attachment_image_src($card1image, 'full');
          $card2image = wp_get_attachment_image_src($card2image, 'full');

          $output .= '<div class="cq-sidebyside-container '.$cardshape.' cq-sidebyside-'.$carddirection.'" data-card1titlecolor="'.$card1titlecolor.'" data-card1contentcolor="'.$card1contentcolor.'" data-card1bg="'.$cardstyle_arr[0].'" data-card2titlecolor="'.$card2titlecolor.'" data-card2contentcolor="'.$card2contentcolor.'" data-card2bg="'.$cardstyle_arr[1].'" data-dividerbg="'.$dividerbg.'" data-dividercolor="'.$dividercolor.'" data-card1iconsize="'.$card1iconsize.'" data-cardheight="'.$cardheight.'" data-dividerborder="'.$dividerborder.'" data-dividerfontsize="'.$dividerfontsize.'" data-dividerwidth="'.$dividerwidth.'" data-dividerheight="'.$dividerheight.'" data-contentsize="'.$contentsize.'" data-titlesize="'.$titlesize.'" data-contentwidth="'.$contentwidth.'" data-card2iconsize="'.$card2iconsize.'" data-elementwidth="'.$elementwidth.'" data-cardmargin="'.$cardmargin.'" data-card1avatar="'.$card1avatar.'" data-card2avatar="'.$card2avatar.'" data-tooltipposition="'.$tooltipposition.'" data-followtextcolor="'.$followtextcolor.'" data-cardshape="'.$cardshape.'" data-isgap="'.$isgap.'" data-gapcolor="'.$gapcolor.'" data-carddirection="'.$carddirection.'">';
          $output .= '<div class="cq-sidebyside-content '.$isgap.' cq-sidecontent-1" data-cardtitle="'.$card1title.'" data-cardavatar="'.$card1avatar.'" data-iconcolor="'.$card1iconcolor.'">';
          if($imagewidth!=""){
              $output .= '<div class="cq-sidebyside-paragraphy"  data-image="'.aq_resize($card1image[0], $imagewidth, null, true, true, true).'">';
          }else{
              $output .= '<div class="cq-sidebyside-paragraphy"  data-image="'.$card1image[0].'">';
          }
          if($card1link["url"]!=="") $output .= '<a href="'.$card1link["url"].'" title="'.$card1link["title"].'" target="'.$card1link["target"].'" class="cq-sidebyside-link">';
          if($card1avatar=="image"){
                if($card1image[0]!=""){
                      $output .= '<div class="cq-sidebyside-imgcontainer">';
                      // $output .= '<img src="'.aq_resize($card1image[0], 500*2, 320*2, true, true, true).'" class="cq-sidebyside-image" width="500" height="320" />';
                      $output .= '</div>';
                }
          }else if($card1avatar=="icon"){
              $output .= '<div class="cq-sidebyside-iconcontainer">';
              $output .= '<i class="fa '.$card1icon.' cq-sidebyside-cardicon"></i>';
              $output .= ' <span class="cq-sidebyside-icontext">';
              $output .= $card1icontext;
              $output .= '</span>';
              $output .= '</div>';
          }
          if($card1title!=""&&$card1avatar!="image"){
              $output .= '<h4 class="cq-sidebyside-title">';
              $output .= $card1title;
              $output .= '</h4>';
          }
          if($card1content!=""){
              $output .= '<span class="cq-sidebyside-text">'.$card1content.'</span>';
          }
          if($card1link["url"]!=="") $output .= '</a>';
          $output .= '</div>';
          $output .= '</div>';
          if($divider!="")$output .= '<span class="cq-sidebyside-divider">'.rawurldecode(base64_decode($divider)).'</span>';
          $output .= '<div class="cq-sidebyside-content '.$isgap.' cq-sidecontent-2" data-cardtitle="'.$card2title.'" data-cardavatar="'.$card2avatar.'" data-iconcolor="'.$card2iconcolor.'">';
          if($imagewidth!=""){
              $output .= '<div class="cq-sidebyside-paragraphy" data-image="'.aq_resize($card2image[0], $imagewidth, null, true, true, true).'">';
          }else{
              $output .= '<div class="cq-sidebyside-paragraphy" data-image="'.$card2image[0].'">';
          }
          if($card2link["url"]!=="") $output .= '<a href="'.$card2link["url"].'" title="'.$card2link["title"].'" target="'.$card2link["target"].'" class="cq-sidebyside-link">';
          if($card2avatar=="image"){
                if($card2image[0]!=""){
                      $output .= '<div class="cq-sidebyside-imgcontainer">';
                      // $output .= '<img src="'.aq_resize($card2image[0], 500*2, 320*2, true, true, true).'" class="cq-sidebyside-image" width="500" height="320" />';
                      $output .= '</div>';
                }
          }else if($card2avatar=="icon"){
              $output .= '<div class="cq-sidebyside-iconcontainer">';
              $output .= '<i class="fa '.$card2icon.' cq-sidebyside-cardicon"></i>';
              $output .= ' <span class="cq-sidebyside-icontext">';
              $output .= $card2icontext;
              $output .= '</span>';
              $output .= '</div>';
          }
          if($card2title!=""&&$card2avatar!="image"){
              $output .= '<h4 class="cq-sidebyside-title">';
              $output .= $card2title;
              $output .= '</h4>';
          }
          if($card2content!=""){
              $output .= '<span class="cq-sidebyside-text">'.$card2content.'</span>';
          }
          if($card2link["url"]!=="") $output .= '</a>';
          $output .= '</div>';
          $output .= '</div>';
          $output .= '</div>';

          return $output;

        }

        add_shortcode('cq_vc_sidebyside', 'cq_vc_sidebyside_func');

      }
  }

}

?>
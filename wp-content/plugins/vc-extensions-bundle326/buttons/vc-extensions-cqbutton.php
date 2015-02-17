<?php
if (!class_exists('VC_Extensions_CQButton')) {

    class VC_Extensions_CQButton {
        function VC_Extensions_CQButton() {
          wpb_map( array(
            "name" => __("Animate Button 01", 'vc_cqbutton_cq'),
            "base" => "cq_vc_cqbutton",
            "class" => "wpb_cq_vc_extension_button01",
            "controls" => "full",
            "icon" => "cq_allinone_button01",
            "category" => __('Sike Extensions', 'js_composer'),
            'description' => __( 'Eye catching button', 'js_composer' ),
            "params" => array(
              array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Link)', 'vc_cqbutton_cq' ),
                'param_name' => 'link',
                'description' => __( 'Button link.', 'vc_cqbutton_cq' )
              ),
              array(
                "type" => "textfield",
                "heading" => __("Text on the button:", "vc_cqbutton_cq"),
                "param_name" => "buttonlabel",
                "value" => "Button Text",
                "description" => __("Leave it to be blank if you want to use the original image.", "vc_cqbutton_cq")
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Icon", "vc_cqbutton_cq"),
                  "param_name" => "icon",
                  "description" => __('Select the icon', 'vc_cqbutton_cq'),
                  "value" => array( __("angellist", "vc_animationfw_cq") => "angellist", __("area-chart", "vc_animationfw_cq") => "area-chart", __("at", "vc_animationfw_cq") => "at", __("bell-slash", "vc_animationfw_cq") => "bell-slash", __("bell-slash-o", "vc_animationfw_cq") => "bell-slash-o", __("bicycle", "vc_animationfw_cq") => "bicycle", __("binoculars", "vc_animationfw_cq") => "binoculars", __("birthday-cake", "vc_animationfw_cq") => "birthday-cake", __("bus", "vc_animationfw_cq") => "bus", __("calculator", "vc_animationfw_cq") => "calculator", __("cc", "vc_animationfw_cq") => "cc", __("cc-amex", "vc_animationfw_cq") => "cc-amex", __("cc-discover", "vc_animationfw_cq") => "cc-discover", __("cc-mastercard", "vc_animationfw_cq") => "cc-mastercard", __("cc-paypal", "vc_animationfw_cq") => "cc-paypal", __("cc-stripe", "vc_animationfw_cq") => "cc-stripe", __("cc-visa", "vc_animationfw_cq") => "cc-visa", __("copyright", "vc_animationfw_cq") => "copyright", __("eyedropper", "vc_animationfw_cq") => "eyedropper", __("futbol-o", "vc_animationfw_cq") => "futbol-o", __("google-wallet", "vc_animationfw_cq") => "google-wallet", __("ils", "vc_animationfw_cq") => "ils", __("ioxhost", "vc_animationfw_cq") => "ioxhost", __("lastfm", "vc_animationfw_cq") => "lastfm", __("lastfm-square", "vc_animationfw_cq") => "lastfm-square", __("line-chart", "vc_animationfw_cq") => "line-chart", __("meanpath", "vc_animationfw_cq") => "meanpath", __("newspaper-o", "vc_animationfw_cq") => "newspaper-o", __("paint-brush", "vc_animationfw_cq") => "paint-brush", __("paypal", "vc_animationfw_cq") => "paypal", __("pie-chart", "vc_animationfw_cq") => "pie-chart", __("plug", "vc_animationfw_cq") => "plug", __("shekel", "vc_animationfw_cq") => "shekel", __("sheqel", "vc_animationfw_cq") => "sheqel", __("slideshare", "vc_animationfw_cq") => "slideshare", __("soccer-ball-o", "vc_animationfw_cq") => "soccer-ball-o", __("toggle-off", "vc_animationfw_cq") => "toggle-off", __("toggle-on", "vc_animationfw_cq") => "toggle-on", __("trash", "vc_animationfw_cq") => "trash", __("tty", "vc_animationfw_cq") => "tty", __("twitch", "vc_animationfw_cq") => "twitch", __("wifi", "vc_animationfw_cq") => "wifi", __("yelp", "vc_animationfw_cq") => "yelp", __("automobile", "vc_cqbutton_cq") => "automobile", __("bank", "vc_cqbutton_cq") => "bank", __("behance", "vc_cqbutton_cq") => "behance", __("behance-square", "vc_cqbutton_cq") => "behance-square", __("bomb", "vc_cqbutton_cq") => "bomb", __("building", "vc_cqbutton_cq") => "building", __("cab", "vc_cqbutton_cq") => "cab", __("car", "vc_cqbutton_cq") => "car", __("child", "vc_cqbutton_cq") => "child", __("circle-o-notch", "vc_cqbutton_cq") => "circle-o-notch", __("circle-thin", "vc_cqbutton_cq") => "circle-thin", __("codepen", "vc_cqbutton_cq") => "codepen", __("cube", "vc_cqbutton_cq") => "cube", __("cubes", "vc_cqbutton_cq") => "cubes", __("database", "vc_cqbutton_cq") => "database", __("delicious", "vc_cqbutton_cq") => "delicious", __("deviantart", "vc_cqbutton_cq") => "deviantart", __("digg", "vc_cqbutton_cq") => "digg", __("drupal", "vc_cqbutton_cq") => "drupal", __("empire", "vc_cqbutton_cq") => "empire", __("envelope-square", "vc_cqbutton_cq") => "envelope-square", __("fax", "vc_cqbutton_cq") => "fax", __("file-archive-o", "vc_cqbutton_cq") => "file-archive-o", __("file-audio-o", "vc_cqbutton_cq") => "file-audio-o", __("file-code-o", "vc_cqbutton_cq") => "file-code-o", __("file-excel-o", "vc_cqbutton_cq") => "file-excel-o", __("file-image-o", "vc_cqbutton_cq") => "file-image-o", __("file-movie-o", "vc_cqbutton_cq") => "file-movie-o", __("file-pdf-o", "vc_cqbutton_cq") => "file-pdf-o", __("file-photo-o", "vc_cqbutton_cq") => "file-photo-o", __("file-picture-o", "vc_cqbutton_cq") => "file-picture-o", __("file-powerpoint-o", "vc_cqbutton_cq") => "file-powerpoint-o", __("file-sound-o", "vc_cqbutton_cq") => "file-sound-o", __("file-video-o", "vc_cqbutton_cq") => "file-video-o", __("file-word-o", "vc_cqbutton_cq") => "file-word-o", __("file-zip-o", "vc_cqbutton_cq") => "file-zip-o", __("ge", "vc_cqbutton_cq") => "ge", __("git", "vc_cqbutton_cq") => "git", __("git-square", "vc_cqbutton_cq") => "git-square", __("google", "vc_cqbutton_cq") => "google", __("graduation-cap", "vc_cqbutton_cq") => "graduation-cap", __("hacker-news", "vc_cqbutton_cq") => "hacker-news", __("header", "vc_cqbutton_cq") => "header", __("history", "vc_cqbutton_cq") => "history", __("institution", "vc_cqbutton_cq") => "institution", __("joomla", "vc_cqbutton_cq") => "joomla", __("jsfiddle", "vc_cqbutton_cq") => "jsfiddle", __("language", "vc_cqbutton_cq") => "language", __("life-bouy", "vc_cqbutton_cq") => "life-bouy", __("life-ring", "vc_cqbutton_cq") => "life-ring", __("life-saver", "vc_cqbutton_cq") => "life-saver", __("mortar-board", "vc_cqbutton_cq") => "mortar-board", __("openid", "vc_cqbutton_cq") => "openid", __("paper-plane", "vc_cqbutton_cq") => "paper-plane", __("paper-plane-o", "vc_cqbutton_cq") => "paper-plane-o", __("paragraph", "vc_cqbutton_cq") => "paragraph", __("paw", "vc_cqbutton_cq") => "paw", __("pied-piper", "vc_cqbutton_cq") => "pied-piper", __("pied-piper-alt", "vc_cqbutton_cq") => "pied-piper-alt", __("pied-piper-square", "vc_cqbutton_cq") => "pied-piper-square", __("qq", "vc_cqbutton_cq") => "qq", __("ra", "vc_cqbutton_cq") => "ra", __("rebel", "vc_cqbutton_cq") => "rebel", __("recycle", "vc_cqbutton_cq") => "recycle", __("reddit", "vc_cqbutton_cq") => "reddit", __("reddit-square", "vc_cqbutton_cq") => "reddit-square", __("send", "vc_cqbutton_cq") => "send", __("send-o", "vc_cqbutton_cq") => "send-o", __("share-alt", "vc_cqbutton_cq") => "share-alt", __("share-alt-square", "vc_cqbutton_cq") => "share-alt-square", __("slack", "vc_cqbutton_cq") => "slack", __("sliders", "vc_cqbutton_cq") => "sliders", __("soundcloud", "vc_cqbutton_cq") => "soundcloud", __("space-shuttle", "vc_cqbutton_cq") => "space-shuttle", __("spoon", "vc_cqbutton_cq") => "spoon", __("spotify", "vc_cqbutton_cq") => "spotify", __("steam", "vc_cqbutton_cq") => "steam", __("steam-square", "vc_cqbutton_cq") => "steam-square", __("stumbleupon", "vc_cqbutton_cq") => "stumbleupon", __("stumbleupon-circle", "vc_cqbutton_cq") => "stumbleupon-circle", __("support", "vc_cqbutton_cq") => "support", __("taxi", "vc_cqbutton_cq") => "taxi", __("tencent-weibo", "vc_cqbutton_cq") => "tencent-weibo", __("tree", "vc_cqbutton_cq") => "tree", __("university", "vc_cqbutton_cq") => "university", __("vine", "vc_cqbutton_cq") => "vine", __("wechat", "vc_cqbutton_cq") => "wechat", __("weixin", "vc_cqbutton_cq") => "weixin", __("wordpress", "vc_cqbutton_cq") => "wordpress", __("yahoo", "vc_cqbutton_cq") => "yahoo", __("rub", "vc_cqbutton_cq") => 'rub', __("ruble", "vc_cqbutton_cq") => 'ruble', __("rouble", "vc_cqbutton_cq") => 'rouble', __("pagelines", "vc_cqbutton_cq") => 'pagelines', __("stack-exchange", "vc_cqbutton_cq") => 'stack-exchange', __("arrow-circle-o-right", "vc_cqbutton_cq") => 'arrow-circle-o-right', __("arrow-circle-o-left", "vc_cqbutton_cq") => 'arrow-circle-o-left', __("caret-square-o-left", "vc_cqbutton_cq") => 'caret-square-o-left', __("toggle-left", "vc_cqbutton_cq") => 'toggle-left', __("dot-circle-o", "vc_cqbutton_cq") => 'dot-circle-o', __("wheelchair", "vc_cqbutton_cq") => 'wheelchair', __("vimeo-square", "vc_cqbutton_cq") => 'vimeo-square', __("try", "vc_cqbutton_cq") => 'try', __("turkish-lira", "vc_cqbutton_cq") => 'turkish-lira', __("plus-square-o", "vc_cqbutton_cq") => 'plus-square-o', __("adjust", "vc_cqbutton_cq") => 'adjust', __("anchor", "vc_cqbutton_cq") => 'anchor', __("archive", "vc_cqbutton_cq") => 'archive', __("arrows", "vc_cqbutton_cq") => 'arrows', __("arrows-h", "vc_cqbutton_cq") => 'arrows-h', __("arrows-v", "vc_cqbutton_cq") => 'arrows-v', __("asterisk", "vc_cqbutton_cq") => 'asterisk', __("ban", "vc_cqbutton_cq") => 'ban', __("bar-chart-o", "vc_cqbutton_cq") => 'bar-chart-o', __("barcode", "vc_cqbutton_cq") => 'barcode', __("bars", "vc_cqbutton_cq") => 'bars', __("beer", "vc_cqbutton_cq") => 'beer', __("bell", "vc_cqbutton_cq") => 'bell', __("bell-o", "vc_cqbutton_cq") => 'bell-o', __("bolt", "vc_cqbutton_cq") => 'bolt', __("book", "vc_cqbutton_cq") => 'book', __("bookmark", "vc_cqbutton_cq") => 'bookmark', __("bookmark-o", "vc_cqbutton_cq") => 'bookmark-o', __("briefcase", "vc_cqbutton_cq") => 'briefcase', __("bug", "vc_cqbutton_cq") => 'bug', __("building-o", "vc_cqbutton_cq") => 'building-o', __("bullhorn", "vc_cqbutton_cq") => 'bullhorn', __("bullseye", "vc_cqbutton_cq") => 'bullseye', __("calendar", "vc_cqbutton_cq") => 'calendar', __("calendar-o", "vc_cqbutton_cq") => 'calendar-o', __("camera", "vc_cqbutton_cq") => 'camera', __("camera-retro", "vc_cqbutton_cq") => 'camera-retro', __("caret-square-o-down", "vc_cqbutton_cq") => 'caret-square-o-down', __("caret-square-o-left", "vc_cqbutton_cq") => 'caret-square-o-left', __("caret-square-o-right", "vc_cqbutton_cq") => 'caret-square-o-right', __("caret-square-o-up", "vc_cqbutton_cq") => 'caret-square-o-up', __("certificate", "vc_cqbutton_cq") => 'certificate', __("check", "vc_cqbutton_cq") => 'check', __("check-circle", "vc_cqbutton_cq") => 'check-circle', __("check-circle-o", "vc_cqbutton_cq") => 'check-circle-o', __("check-square", "vc_cqbutton_cq") => 'check-square', __("check-square-o", "vc_cqbutton_cq") => 'check-square-o', __("circle", "vc_cqbutton_cq") => 'circle', __("circle-o", "vc_cqbutton_cq") => 'circle-o', __("clock-o", "vc_cqbutton_cq") => 'clock-o', __("cloud", "vc_cqbutton_cq") => 'cloud', __("cloud-download", "vc_cqbutton_cq") => 'cloud-download', __("cloud-upload", "vc_cqbutton_cq") => 'cloud-upload', __("code", "vc_cqbutton_cq") => 'code', __("code-fork", "vc_cqbutton_cq") => 'code-fork', __("coffee", "vc_cqbutton_cq") => 'coffee', __("cog", "vc_cqbutton_cq") => 'cog', __("cogs", "vc_cqbutton_cq") => 'cogs', __("comment", "vc_cqbutton_cq") => 'comment', __("comment-o", "vc_cqbutton_cq") => 'comment-o', __("comments", "vc_cqbutton_cq") => 'comments', __("comments-o", "vc_cqbutton_cq") => 'comments-o', __("compass", "vc_cqbutton_cq") => 'compass', __("credit-card", "vc_cqbutton_cq") => 'credit-card', __("crop", "vc_cqbutton_cq") => 'crop', __("crosshairs", "vc_cqbutton_cq") => 'crosshairs', __("cutlery", "vc_cqbutton_cq") => 'cutlery', __("dashboard", "vc_cqbutton_cq") => 'dashboard', __("desktop", "vc_cqbutton_cq") => 'desktop', __("dot-circle-o", "vc_cqbutton_cq") => 'dot-circle-o', __("download", "vc_cqbutton_cq") => 'download', __("edit", "vc_cqbutton_cq") => 'edit', __("ellipsis-h", "vc_cqbutton_cq") => 'ellipsis-h', __("ellipsis-v", "vc_cqbutton_cq") => 'ellipsis-v', __("envelope", "vc_cqbutton_cq") => 'envelope', __("envelope-o", "vc_cqbutton_cq") => 'envelope-o', __("eraser", "vc_cqbutton_cq") => 'eraser', __("exchange", "vc_cqbutton_cq") => 'exchange', __("exclamation", "vc_cqbutton_cq") => 'exclamation', __("exclamation-circle", "vc_cqbutton_cq") => 'exclamation-circle', __("exclamation-triangle", "vc_cqbutton_cq") => 'exclamation-triangle', __("external-link", "vc_cqbutton_cq") => 'external-link', __("external-link-square", "vc_cqbutton_cq") => 'external-link-square', __("eye", "vc_cqbutton_cq") => 'eye', __("eye-slash", "vc_cqbutton_cq") => 'eye-slash', __("female", "vc_cqbutton_cq") => 'female', __("fighter-jet", "vc_cqbutton_cq") => 'fighter-jet', __("film", "vc_cqbutton_cq") => 'film', __("filter", "vc_cqbutton_cq") => 'filter', __("fire", "vc_cqbutton_cq") => 'fire', __("fire-extinguisher", "vc_cqbutton_cq") => 'fire-extinguisher', __("flag", "vc_cqbutton_cq") => 'flag', __("flag-checkered", "vc_cqbutton_cq") => 'flag-checkered', __("flag-o", "vc_cqbutton_cq") => 'flag-o', __("flash", "vc_cqbutton_cq") => 'flash', __("flask", "vc_cqbutton_cq") => 'flask', __("folder", "vc_cqbutton_cq") => 'folder', __("folder-o", "vc_cqbutton_cq") => 'folder-o', __("folder-open", "vc_cqbutton_cq") => 'folder-open', __("folder-open-o", "vc_cqbutton_cq") => 'folder-open-o', __("frown-o", "vc_cqbutton_cq") => 'frown-o', __("gamepad", "vc_cqbutton_cq") => 'gamepad', __("gavel", "vc_cqbutton_cq") => 'gavel', __("gear", "vc_cqbutton_cq") => 'gear', __("gears", "vc_cqbutton_cq") => 'gears', __("gift", "vc_cqbutton_cq") => 'gift', __("glass", "vc_cqbutton_cq") => 'glass', __("globe", "vc_cqbutton_cq") => 'globe', __("group", "vc_cqbutton_cq") => 'group', __("hdd-o", "vc_cqbutton_cq") => 'hdd-o', __("headphones", "vc_cqbutton_cq") => 'headphones', __("heart", "vc_cqbutton_cq") => 'heart', __("heart-o", "vc_cqbutton_cq") => 'heart-o', __("home", "vc_cqbutton_cq") => 'home', __("inbox", "vc_cqbutton_cq") => 'inbox', __("info", "vc_cqbutton_cq") => 'info', __("info-circle", "vc_cqbutton_cq") => 'info-circle', __("key", "vc_cqbutton_cq") => 'key', __("keyboard-o", "vc_cqbutton_cq") => 'keyboard-o', __("laptop", "vc_cqbutton_cq") => 'laptop', __("leaf", "vc_cqbutton_cq") => 'leaf', __("legal", "vc_cqbutton_cq") => 'legal', __("lemon-o", "vc_cqbutton_cq") => 'lemon-o', __("level-down", "vc_cqbutton_cq") => 'level-down', __("level-up", "vc_cqbutton_cq") => 'level-up', __("lightbulb-o", "vc_cqbutton_cq") => 'lightbulb-o', __("location-arrow", "vc_cqbutton_cq") => 'location-arrow', __("lock", "vc_cqbutton_cq") => 'lock', __("magic", "vc_cqbutton_cq") => 'magic', __("magnet", "vc_cqbutton_cq") => 'magnet', __("mail-forward", "vc_cqbutton_cq") => 'mail-forward', __("mail-reply", "vc_cqbutton_cq") => 'mail-reply', __("mail-reply-all", "vc_cqbutton_cq") => 'mail-reply-all', __("male", "vc_cqbutton_cq") => 'male', __("map-marker", "vc_cqbutton_cq") => 'map-marker', __("meh-o", "vc_cqbutton_cq") => 'meh-o', __("microphone", "vc_cqbutton_cq") => 'microphone', __("microphone-slash", "vc_cqbutton_cq") => 'microphone-slash', __("minus", "vc_cqbutton_cq") => 'minus', __("minus-circle", "vc_cqbutton_cq") => 'minus-circle', __("minus-square", "vc_cqbutton_cq") => 'minus-square', __("minus-square-o", "vc_cqbutton_cq") => 'minus-square-o', __("mobile", "vc_cqbutton_cq") => 'mobile', __("mobile-phone", "vc_cqbutton_cq") => 'mobile-phone', __("money", "vc_cqbutton_cq") => 'money', __("moon-o", "vc_cqbutton_cq") => 'moon-o', __("music", "vc_cqbutton_cq") => 'music', __("pencil", "vc_cqbutton_cq") => 'pencil', __("pencil-square", "vc_cqbutton_cq") => 'pencil-square', __("pencil-square-o", "vc_cqbutton_cq") => 'pencil-square-o', __("phone", "vc_cqbutton_cq") => 'phone', __("phone-square", "vc_cqbutton_cq") => 'phone-square', __("picture-o", "vc_cqbutton_cq") => 'picture-o', __("plane", "vc_cqbutton_cq") => 'plane', __("plus", "vc_cqbutton_cq") => 'plus', __("plus-circle", "vc_cqbutton_cq") => 'plus-circle', __("plus-square", "vc_cqbutton_cq") => 'plus-square', __("plus-square-o", "vc_cqbutton_cq") => 'plus-square-o', __("power-off", "vc_cqbutton_cq") => 'power-off', __("print", "vc_cqbutton_cq") => 'print', __("puzzle-piece", "vc_cqbutton_cq") => 'puzzle-piece', __("qrcode", "vc_cqbutton_cq") => 'qrcode', __("question", "vc_cqbutton_cq") => 'question', __("question-circle", "vc_cqbutton_cq") => 'question-circle', __("quote-left", "vc_cqbutton_cq") => 'quote-left', __("quote-right", "vc_cqbutton_cq") => 'quote-right', __("random", "vc_cqbutton_cq") => 'random', __("refresh", "vc_cqbutton_cq") => 'refresh', __("reply", "vc_cqbutton_cq") => 'reply', __("reply-all", "vc_cqbutton_cq") => 'reply-all', __("retweet", "vc_cqbutton_cq") => 'retweet', __("road", "vc_cqbutton_cq") => 'road', __("rocket", "vc_cqbutton_cq") => 'rocket', __("rss", "vc_cqbutton_cq") => 'rss', __("rss-square", "vc_cqbutton_cq") => 'rss-square', __("search", "vc_cqbutton_cq") => 'search', __("search-minus", "vc_cqbutton_cq") => 'search-minus', __("search-plus", "vc_cqbutton_cq") => 'search-plus', __("share", "vc_cqbutton_cq") => 'share', __("share-square", "vc_cqbutton_cq") => 'share-square', __("share-square-o", "vc_cqbutton_cq") => 'share-square-o', __("shield", "vc_cqbutton_cq") => 'shield', __("shopping-cart", "vc_cqbutton_cq") => 'shopping-cart', __("sign-in", "vc_cqbutton_cq") => 'sign-in', __("sign-out", "vc_cqbutton_cq") => 'sign-out', __("signal", "vc_cqbutton_cq") => 'signal', __("sitemap", "vc_cqbutton_cq") => 'sitemap', __("smile-o", "vc_cqbutton_cq") => 'smile-o', __("sort", "vc_cqbutton_cq") => 'sort', __("sort-alpha-asc", "vc_cqbutton_cq") => 'sort-alpha-asc', __("sort-alpha-desc", "vc_cqbutton_cq") => 'sort-alpha-desc', __("sort-amount-asc", "vc_cqbutton_cq") => 'sort-amount-asc', __("sort-amount-desc", "vc_cqbutton_cq") => 'sort-amount-desc', __("sort-asc", "vc_cqbutton_cq") => 'sort-asc', __("sort-desc", "vc_cqbutton_cq") => 'sort-desc', __("sort-down", "vc_cqbutton_cq") => 'sort-down', __("sort-numeric-asc", "vc_cqbutton_cq") => 'sort-numeric-asc', __("sort-numeric-desc", "vc_cqbutton_cq") => 'sort-numeric-desc', __("sort-up", "vc_cqbutton_cq") => 'sort-up', __("spinner", "vc_cqbutton_cq") => 'spinner', __("square", "vc_cqbutton_cq") => 'square', __("square-o", "vc_cqbutton_cq") => 'square-o', __("star", "vc_cqbutton_cq") => 'star', __("star-half", "vc_cqbutton_cq") => 'star-half', __("star-half-empty", "vc_cqbutton_cq") => 'star-half-empty', __("star-half-full", "vc_cqbutton_cq") => 'star-half-full', __("star-half-o", "vc_cqbutton_cq") => 'star-half-o', __("star-o", "vc_cqbutton_cq") => 'star-o', __("subscript", "vc_cqbutton_cq") => 'subscript', __("suitcase", "vc_cqbutton_cq") => 'suitcase', __("sun-o", "vc_cqbutton_cq") => 'sun-o', __("superscript", "vc_cqbutton_cq") => 'superscript', __("tablet", "vc_cqbutton_cq") => 'tablet', __("tachometer", "vc_cqbutton_cq") => 'tachometer', __("tag", "vc_cqbutton_cq") => 'tag', __("tags", "vc_cqbutton_cq") => 'tags', __("tasks", "vc_cqbutton_cq") => 'tasks', __("terminal", "vc_cqbutton_cq") => 'terminal', __("thumb-tack", "vc_cqbutton_cq") => 'thumb-tack', __("thumbs-down", "vc_cqbutton_cq") => 'thumbs-down', __("thumbs-o-down", "vc_cqbutton_cq") => 'thumbs-o-down', __("thumbs-o-up", "vc_cqbutton_cq") => 'thumbs-o-up', __("thumbs-up", "vc_cqbutton_cq") => 'thumbs-up', __("ticket", "vc_cqbutton_cq") => 'ticket', __("times", "vc_cqbutton_cq") => 'times', __("times-circle", "vc_cqbutton_cq") => 'times-circle', __("times-circle-o", "vc_cqbutton_cq") => 'times-circle-o', __("tint", "vc_cqbutton_cq") => 'tint', __("toggle-down", "vc_cqbutton_cq") => 'toggle-down', __("toggle-left", "vc_cqbutton_cq") => 'toggle-left', __("toggle-right", "vc_cqbutton_cq") => 'toggle-right', __("toggle-up", "vc_cqbutton_cq") => 'toggle-up', __("trash-o", "vc_cqbutton_cq") => 'trash-o', __("trophy", "vc_cqbutton_cq") => 'trophy', __("truck", "vc_cqbutton_cq") => 'truck', __("umbrella", "vc_cqbutton_cq") => 'umbrella', __("unlock", "vc_cqbutton_cq") => 'unlock', __("unlock-alt", "vc_cqbutton_cq") => 'unlock-alt', __("unsorted", "vc_cqbutton_cq") => 'unsorted', __("upload", "vc_cqbutton_cq") => 'upload', __("user", "vc_cqbutton_cq") => 'user', __("users", "vc_cqbutton_cq") => 'users', __("video-camera", "vc_cqbutton_cq") => 'video-camera', __("volume-down", "vc_cqbutton_cq") => 'volume-down', __("volume-off", "vc_cqbutton_cq") => 'volume-off', __("volume-up", "vc_cqbutton_cq") => 'volume-up', __("warning", "vc_cqbutton_cq") => 'warning', __("wheelchair", "vc_cqbutton_cq") => 'wheelchair', __("wrench", "vc_cqbutton_cq") => 'wrench', __("check-square", "vc_cqbutton_cq") => 'check-square', __("check-square-o", "vc_cqbutton_cq") => 'check-square-o', __("circle", "vc_cqbutton_cq") => 'circle', __("circle-o", "vc_cqbutton_cq") => 'circle-o', __("dot-circle-o", "vc_cqbutton_cq") => 'dot-circle-o', __("minus-square", "vc_cqbutton_cq") => 'minus-square', __("minus-square-o", "vc_cqbutton_cq") => 'minus-square-o', __("plus-square", "vc_cqbutton_cq") => 'plus-square', __("plus-square-o", "vc_cqbutton_cq") => 'plus-square-o', __("square", "vc_cqbutton_cq") => 'square', __("square-o", "vc_cqbutton_cq") => 'square-o', __("bitcoin", "vc_cqbutton_cq") => 'bitcoin', __("btc", "vc_cqbutton_cq") => 'btc', __("cny", "vc_cqbutton_cq") => 'cny', __("dollar", "vc_cqbutton_cq") => 'dollar', __("eur", "vc_cqbutton_cq") => 'eur', __("euro", "vc_cqbutton_cq") => 'euro', __("gbp", "vc_cqbutton_cq") => 'gbp', __("inr", "vc_cqbutton_cq") => 'inr', __("jpy", "vc_cqbutton_cq") => 'jpy', __("krw", "vc_cqbutton_cq") => 'krw', __("money", "vc_cqbutton_cq") => 'money', __("rmb", "vc_cqbutton_cq") => 'rmb', __("rouble", "vc_cqbutton_cq") => 'rouble', __("rub", "vc_cqbutton_cq") => 'rub', __("ruble", "vc_cqbutton_cq") => 'ruble', __("rupee", "vc_cqbutton_cq") => 'rupee', __("try", "vc_cqbutton_cq") => 'try', __("turkish-lira", "vc_cqbutton_cq") => 'turkish-lira', __("usd", "vc_cqbutton_cq") => 'usd', __("won", "vc_cqbutton_cq") => 'won', __("yen", "vc_cqbutton_cq") => 'yen', __("align-center", "vc_cqbutton_cq") => 'align-center', __("align-justify", "vc_cqbutton_cq") => 'align-justify', __("align-left", "vc_cqbutton_cq") => 'align-left', __("align-right", "vc_cqbutton_cq") => 'align-right', __("bold", "vc_cqbutton_cq") => 'bold', __("chain", "vc_cqbutton_cq") => 'chain', __("chain-broken", "vc_cqbutton_cq") => 'chain-broken', __("clipboard", "vc_cqbutton_cq") => 'clipboard', __("columns", "vc_cqbutton_cq") => 'columns', __("copy", "vc_cqbutton_cq") => 'copy', __("cut", "vc_cqbutton_cq") => 'cut', __("dedent", "vc_cqbutton_cq") => 'dedent', __("eraser", "vc_cqbutton_cq") => 'eraser', __("file", "vc_cqbutton_cq") => 'file', __("file-o", "vc_cqbutton_cq") => 'file-o', __("file-text", "vc_cqbutton_cq") => 'file-text', __("file-text-o", "vc_cqbutton_cq") => 'file-text-o', __("files-o", "vc_cqbutton_cq") => 'files-o', __("floppy-o", "vc_cqbutton_cq") => 'floppy-o', __("font", "vc_cqbutton_cq") => 'font', __("indent", "vc_cqbutton_cq") => 'indent', __("italic", "vc_cqbutton_cq") => 'italic', __("link", "vc_cqbutton_cq") => 'link', __("list", "vc_cqbutton_cq") => 'list', __("list-alt", "vc_cqbutton_cq") => 'list-alt', __("list-ol", "vc_cqbutton_cq") => 'list-ol', __("list-ul", "vc_cqbutton_cq") => 'list-ul', __("outdent", "vc_cqbutton_cq") => 'outdent', __("paperclip", "vc_cqbutton_cq") => 'paperclip', __("paste", "vc_cqbutton_cq") => 'paste', __("repeat", "vc_cqbutton_cq") => 'repeat', __("rotate-left", "vc_cqbutton_cq") => 'rotate-left', __("rotate-right", "vc_cqbutton_cq") => 'rotate-right', __("save", "vc_cqbutton_cq") => 'save', __("scissors", "vc_cqbutton_cq") => 'scissors', __("strikethrough", "vc_cqbutton_cq") => 'strikethrough', __("table", "vc_cqbutton_cq") => 'table', __("text-height", "vc_cqbutton_cq") => 'text-height', __("text-width", "vc_cqbutton_cq") => 'text-width', __("th", "vc_cqbutton_cq") => 'th', __("th-large", "vc_cqbutton_cq") => 'th-large', __("th-list", "vc_cqbutton_cq") => 'th-list', __("underline", "vc_cqbutton_cq") => 'underline', __("undo", "vc_cqbutton_cq") => 'undo', __("unlink", "vc_cqbutton_cq") => 'unlink', __("angle-double-down", "vc_cqbutton_cq") => 'angle-double-down', __("angle-double-left", "vc_cqbutton_cq") => 'angle-double-left', __("angle-double-right", "vc_cqbutton_cq") => 'angle-double-right', __("angle-double-up", "vc_cqbutton_cq") => 'angle-double-up', __("angle-down", "vc_cqbutton_cq") => 'angle-down', __("angle-left", "vc_cqbutton_cq") => 'angle-left', __("angle-right", "vc_cqbutton_cq") => 'angle-right', __("angle-up", "vc_cqbutton_cq") => 'angle-up', __("arrow-circle-down", "vc_cqbutton_cq") => 'arrow-circle-down', __("arrow-circle-left", "vc_cqbutton_cq") => 'arrow-circle-left', __("arrow-circle-o-down", "vc_cqbutton_cq") => 'arrow-circle-o-down', __("arrow-circle-o-left", "vc_cqbutton_cq") => 'arrow-circle-o-left', __("arrow-circle-o-right", "vc_cqbutton_cq") => 'arrow-circle-o-right', __("arrow-circle-o-up", "vc_cqbutton_cq") => 'arrow-circle-o-up', __("arrow-circle-right", "vc_cqbutton_cq") => 'arrow-circle-right', __("arrow-circle-up", "vc_cqbutton_cq") => 'arrow-circle-up', __("arrow-down", "vc_cqbutton_cq") => 'arrow-down', __("arrow-left", "vc_cqbutton_cq") => 'arrow-left', __("arrow-right", "vc_cqbutton_cq") => 'arrow-right', __("arrow-up", "vc_cqbutton_cq") => 'arrow-up', __("arrows", "vc_cqbutton_cq") => 'arrows', __("arrows-alt", "vc_cqbutton_cq") => 'arrows-alt', __("arrows-h", "vc_cqbutton_cq") => 'arrows-h', __("arrows-v", "vc_cqbutton_cq") => 'arrows-v', __("caret-down", "vc_cqbutton_cq") => 'caret-down', __("caret-left", "vc_cqbutton_cq") => 'caret-left', __("caret-right", "vc_cqbutton_cq") => 'caret-right', __("caret-square-o-down", "vc_cqbutton_cq") => 'caret-square-o-down', __("caret-square-o-left", "vc_cqbutton_cq") => 'caret-square-o-left', __("caret-square-o-right", "vc_cqbutton_cq") => 'caret-square-o-right', __("caret-square-o-up", "vc_cqbutton_cq") => 'caret-square-o-up', __("caret-up", "vc_cqbutton_cq") => 'caret-up', __("chevron-circle-down", "vc_cqbutton_cq") => 'chevron-circle-down', __("chevron-circle-left", "vc_cqbutton_cq") => 'chevron-circle-left', __("chevron-circle-right", "vc_cqbutton_cq") => 'chevron-circle-right', __("chevron-circle-up", "vc_cqbutton_cq") => 'chevron-circle-up', __("chevron-down", "vc_cqbutton_cq") => 'chevron-down', __("chevron-left", "vc_cqbutton_cq") => 'chevron-left', __("chevron-right", "vc_cqbutton_cq") => 'chevron-right', __("chevron-up", "vc_cqbutton_cq") => 'chevron-up', __("hand-o-down", "vc_cqbutton_cq") => 'hand-o-down', __("hand-o-left", "vc_cqbutton_cq") => 'hand-o-left', __("hand-o-right", "vc_cqbutton_cq") => 'hand-o-right', __("hand-o-up", "vc_cqbutton_cq") => 'hand-o-up', __("long-arrow-down", "vc_cqbutton_cq") => 'long-arrow-down', __("long-arrow-left", "vc_cqbutton_cq") => 'long-arrow-left', __("long-arrow-right", "vc_cqbutton_cq") => 'long-arrow-right', __("long-arrow-up", "vc_cqbutton_cq") => 'long-arrow-up', __("toggle-down", "vc_cqbutton_cq") => 'toggle-down', __("toggle-left", "vc_cqbutton_cq") => 'toggle-left', __("toggle-right", "vc_cqbutton_cq") => 'toggle-right', __("toggle-up", "vc_cqbutton_cq") => 'toggle-up', __("arrows-alt", "vc_cqbutton_cq") => 'arrows-alt', __("backward", "vc_cqbutton_cq") => 'backward', __("compress", "vc_cqbutton_cq") => 'compress', __("eject", "vc_cqbutton_cq") => 'eject', __("expand", "vc_cqbutton_cq") => 'expand', __("fast-backward", "vc_cqbutton_cq") => 'fast-backward', __("fast-forward", "vc_cqbutton_cq") => 'fast-forward', __("forward", "vc_cqbutton_cq") => 'forward', __("pause", "vc_cqbutton_cq") => 'pause', __("play", "vc_cqbutton_cq") => 'play', __("play-circle", "vc_cqbutton_cq") => 'play-circle', __("play-circle-o", "vc_cqbutton_cq") => 'play-circle-o', __("step-backward", "vc_cqbutton_cq") => 'step-backward', __("step-forward", "vc_cqbutton_cq") => 'step-forward', __("stop", "vc_cqbutton_cq") => 'stop', __("youtube-play", "vc_cqbutton_cq") => 'youtube-play', __("adn", "vc_cqbutton_cq") => 'adn', __("android", "vc_cqbutton_cq") => 'android', __("apple", "vc_cqbutton_cq") => 'apple', __("bitbucket", "vc_cqbutton_cq") => 'bitbucket', __("bitbucket-square", "vc_cqbutton_cq") => 'bitbucket-square', __("bitcoin", "vc_cqbutton_cq") => 'bitcoin', __("btc", "vc_cqbutton_cq") => 'btc', __("css3", "vc_cqbutton_cq") => 'css3', __("dribbble", "vc_cqbutton_cq") => 'dribbble', __("dropbox", "vc_cqbutton_cq") => 'dropbox', __("facebook", "vc_cqbutton_cq") => 'facebook', __("facebook-square", "vc_cqbutton_cq") => 'facebook-square', __("flickr", "vc_cqbutton_cq") => 'flickr', __("foursquare", "vc_cqbutton_cq") => 'foursquare', __("github", "vc_cqbutton_cq") => 'github', __("github-alt", "vc_cqbutton_cq") => 'github-alt', __("github-square", "vc_cqbutton_cq") => 'github-square', __("gittip", "vc_cqbutton_cq") => 'gittip', __("google-plus", "vc_cqbutton_cq") => 'google-plus', __("google-plus-square", "vc_cqbutton_cq") => 'google-plus-square', __("html5", "vc_cqbutton_cq") => 'html5', __("instagram", "vc_cqbutton_cq") => 'instagram', __("linkedin", "vc_cqbutton_cq") => 'linkedin', __("linkedin-square", "vc_cqbutton_cq") => 'linkedin-square', __("linux", "vc_cqbutton_cq") => 'linux', __("maxcdn", "vc_cqbutton_cq") => 'maxcdn', __("pagelines", "vc_cqbutton_cq") => 'pagelines', __("pinterest", "vc_cqbutton_cq") => 'pinterest', __("pinterest-square", "vc_cqbutton_cq") => 'pinterest-square', __("renren", "vc_cqbutton_cq") => 'renren', __("skype", "vc_cqbutton_cq") => 'skype', __("stack-exchange", "vc_cqbutton_cq") => 'stack-exchange', __("stack-overflow", "vc_cqbutton_cq") => 'stack-overflow', __("trello", "vc_cqbutton_cq") => 'trello', __("tumblr", "vc_cqbutton_cq") => 'tumblr', __("tumblr-square", "vc_cqbutton_cq") => 'tumblr-square', __("twitter", "vc_cqbutton_cq") => 'twitter', __("twitter-square", "vc_cqbutton_cq") => 'twitter-square', __("vimeo-square", "vc_cqbutton_cq") => 'vimeo-square', __("vk", "vc_cqbutton_cq") => 'vk', __("weibo", "vc_cqbutton_cq") => 'weibo', __("windows", "vc_cqbutton_cq") => 'windows', __("xing", "vc_cqbutton_cq") => 'xing', __("xing-square", "vc_cqbutton_cq") => 'xing-square', __("youtube", "vc_cqbutton_cq") => 'youtube', __("youtube-play", "vc_cqbutton_cq") => 'youtube-play', __("youtube-square", "vc_cqbutton_cq") => 'youtube-square', __("ambulance", "vc_cqbutton_cq") => 'ambulance', __("h-square", "vc_cqbutton_cq") => 'h-square', __("hospital-o", "vc_cqbutton_cq") => 'hospital-o', __("medkit", "vc_cqbutton_cq") => 'medkit', __("plus-square", "vc_cqbutton_cq") => 'plus-square', __("stethoscope", "vc_cqbutton_cq") => 'stethoscope', __("user-md", "vc_cqbutton_cq") => 'user-md', __("wheelchair", "vc_cqbutton_cq") => 'wheelchair')
              ),
              array(
                "type" => "checkbox",
                "holder" => "",
                "class" => "vc_cqbutton_cq",
                "heading" => __("Put the icon on the left?", 'vc_cqbutton_cq'),
                "param_name" => "iconposition",
                "value" => array(__("Yes", "vc_cqbutton_cq") => 'left'),
                "description" => __("You can check this if you want to display icon on the left, it is on the right by default.", 'vc_cqbutton_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_cqbutton_cq",
                "heading" => __("Transition style of the icon button", "vc_cqbutton_cq"),
                "param_name" => "animationstyle",
                "value" => array(__("animation 1", "vc_cqbutton_cq") => "animatetype-1", __("animation 2", "vc_cqbutton_cq") => "animatetype-2", __("animation 3", "vc_cqbutton_cq") => "animatetype-3", __("animation 4 (pulse)", "vc_cqbutton_cq") => "animatetype-4"),
                "description" => __("", "vc_cqbutton_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("margin-top of the icon", "vc_cqbutton_cq"),
                "param_name" => "icontop",
                "value" => "-9px",
                "description" => __("Sometimes you have to change the margin-top offset of the icon, default is -9px.", "vc_cqbutton_cq")
              ),
              array(
                "type" => "textfield",
                "heading" => __("margin-left of the icon", "vc_cqbutton_cq"),
                "param_name" => "iconleft",
                "value" => "-9px",
                "description" => __("Sometimes you have to change the margin-left offset of the icon, default is -9px.", "vc_cqbutton_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button text color", 'vc_cqbutton_cq'),
                "param_name" => "buttoncolor",
                "value" => '',
                "description" => __("Default is white, choose other color as you like.", 'vc_cqbutton_cq')
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "vc_cqbutton_cq",
                "heading" => __("Color of the icon button", "vc_cqbutton_cq"),
                "param_name" => "iconbuttoncolor",
                "value" => array(__("orange", "vc_cqbutton_cq") => "cqbtn-1", __("blue", "vc_cqbutton_cq") => "cqbtn-2", __("gray", "vc_cqbutton_cq") => "cqbtn-3", __("purple", "vc_cqbutton_cq") => "cqbtn-4"),
                "description" => __("Select the background color for the button, or you can use the color picker below to choose one.", "vc_cqbutton_cq")
              ),
              array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button background color", 'vc_cqbutton_cq'),
                "param_name" => "buttonbackground",
                "value" => '',
                "description" => __("Choose the background color for the button.", 'vc_cqbutton_cq')
              ),
              array(
                "type" => "textfield",
                "heading" => __("Extra class name for the container", "vc_cqbutton_cq"),
                "param_name" => "extra_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vc_cqbutton_cq")
              )

            )
        ));

        function cq_vc_cqbutton_func($atts, $content=null) {
          extract( shortcode_atts( array(
            'buttonlabel' => '',
            'link' => '',
            'buttoncolor' => '',
            'buttonbackground' => '',
            'containerwidth' => '',
            'animationstyle' => 'animatetype-1',
            'iconbuttoncolor' => 'cqbtn-1',
            'iconposition' => '',
            'icon' => '',
            'icontop' => '',
            'iconleft' => '',
            // 'buttonwidth' => '',
            // 'pulse' => '',
            'mobilewidth' => '',
            'onclick' => '',
            'extra_class' => ''
          ), $atts ) );


          wp_register_style( 'vc_cqbutton_cq_style', plugins_url('css/style.min.css', __FILE__));
          wp_enqueue_style( 'vc_cqbutton_cq_style' );

          wp_register_style( 'font-awesome', plugins_url('../faanimation/css/font-awesome.min.css', __FILE__) );
          wp_enqueue_style( 'font-awesome' );

          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
          $output = '';
          $link = vc_build_link($link);
          $output .= '<div class="cq-buttoncontainer '.$iconposition.' '.$extra_class.'">';
          $output .= '<div class="'.$animationstyle.'">';
          $output .= '<div>';
          $output .= '<a href="'.$link['url'].'" title="'.$link['title'].'" target="'.$link['target'].'" style="color:'.$buttoncolor.';background-color:'.$buttonbackground.';" class="btn '.$iconbuttoncolor.'">';
          $output .= '<span class="txt">'.$buttonlabel.'</span>';
          $output .= '<span class="round"><i style="margin-top:'.$icontop.';margin-left:'.$iconleft.';" class="fa fa-'.$icon.'"></i></span>';
          $output .= '</a>';
          $output .= '</div>';
          $output .= '</div>';
          $output .= '</div>';


          return $output;

        }

        add_shortcode('cq_vc_cqbutton', 'cq_vc_cqbutton_func');

      }
  }

}

?>
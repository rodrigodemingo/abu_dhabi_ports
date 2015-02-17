<?php
	global $VISUAL_COMPOSER_EXTENSIONS;
	$Lightbox_OverlayColor			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('overlay', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['overlay'] 		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['overlay']);
	$Lightbox_BackgroundImage		= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('background', $TS_VCSC_Lightbox_Defaults))) 	? $TS_VCSC_Lightbox_Defaults['background'] 		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['background']);
	$Lightbox_BackgroundRepeat		= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('repeat', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['repeat'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['repeat']);
	$Lightbox_NoisePattern			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('noise', $TS_VCSC_Lightbox_Defaults))) 			? $TS_VCSC_Lightbox_Defaults['noise'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['noise']);
	$Lightbox_ButtonScheme			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('scheme', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['scheme'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['scheme']);
	$Lightbox_AllowShare			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('share', $TS_VCSC_Lightbox_Defaults))) 			? $TS_VCSC_Lightbox_Defaults['share'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['share']);
	$Lightbox_SocialNetworks		= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('social', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['social'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['social']);
	$Lightbox_AllowTouchSwipe		= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('notouch', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['notouch'] 		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['notouch']);
	$Lightbox_AllowKeyboard			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('keyboard', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['keyboard'] 		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['keyboard']);
	$Lightbox_AllowZoom				= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('zoom', $TS_VCSC_Lightbox_Defaults))) 			? $TS_VCSC_Lightbox_Defaults['zoom'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['zoom']);
	$Lightbox_AllowFullscreen		= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('fullscreen', $TS_VCSC_Lightbox_Defaults))) 	? $TS_VCSC_Lightbox_Defaults['fullscreen'] 		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['fullscreen']);
	$Lightbox_CloseButton			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('closer', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['closer'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['closer']);
	$Lightbox_BackgroundClose		= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('bgclose', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['bgclose'] 		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['bgclose']);
	$Lightbox_RemoveHashtag			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('nohashes', $TS_VCSC_Lightbox_Defaults))) 		? $TS_VCSC_Lightbox_Defaults['nohashes'] 		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['nohashes']);
	$Lightbox_RemoveLight 			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('removelight', $TS_VCSC_Lightbox_Defaults))) 	? $TS_VCSC_Lightbox_Defaults['removelight'] 	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['removelight']);
	$Lightbox_CustomLight			= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('customlight', $TS_VCSC_Lightbox_Defaults))) 	? $TS_VCSC_Lightbox_Defaults['customlight'] 	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['customlight']);
	$Lightbox_BackColor				= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('customcolor', $TS_VCSC_Lightbox_Defaults))) 	? $TS_VCSC_Lightbox_Defaults['customcolor'] 	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['customcolor']);
	$Lightbox_AllowCORS				= (((is_array($TS_VCSC_Lightbox_Defaults)) && (array_key_exists('cors', $TS_VCSC_Lightbox_Defaults))) 			? $TS_VCSC_Lightbox_Defaults['cors'] 			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['cors']);
	//var_dump($TS_VCSC_Lightbox_Defaults)
?>
<div id="ts-settings-lightbox" class="tab-content">
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-images-alt2"></i>Lightbox Settings</div>
		<div class="ts-vcsc-section-content">
			<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
				These settings will be used as global settings for the included lightbox, used in a variety of elements. Most elements include additional lightbox settings and/or options to override some of the global settings below.
			</div>
			<div style="margin-top: 20px;">
				<h4>Lightbox Background (Overlay) Color:</h4>
				<p style="font-size: 12px;">Define the lightbox background (overlay) color and opacity by using the color and alpha picker below:</p>
				<div class="ts-color-group">
					<input id="ts_vcsc_extend_settings_defaultLightboxOverlay" name="ts_vcsc_extend_settings_defaultLightboxOverlay" data-error="Lightbox - Overlay Color" data-order="8" class="validate[required,funcCall[checkColorPickerSyntax]] ts_vcsc_extend_settings_defaultLightboxOverlay ts-color-control" data-alpha="true" type="text" value="<?php echo $Lightbox_OverlayColor; ?>"/>
				</div>
			</div>
			<div style="margin-top: 20px;">
				<h4>Lightbox Background Image:</h4>
				<p style="font-size: 12px;">Select the image that should be used for the lightbox background, instead of a color overlay:</p>
				<div class="ts-vcsc-notice-field ts-vcsc-critical" style="margin-top: 10px; font-size: 13px; text-align: justify; font-weight: bold;">
					A selected background image will ALWAYS overwrite the color overlay setting above! If "no-repeat" has been selected, ensure that your selected image is sufficient enough to accomodate large screens.
				</div>	
				<div id="ts_vcsc_extend_settings_defaultLightboxBackgroundHolder">
					<input id="ts_vcsc_extend_settings_defaultLightboxBackground" class="ts_vcsc_extend_settings_defaultLightboxBackground" type="hidden" size="36" name="ts_vcsc_extend_settings_defaultLightboxBackground" value="<?php echo $Lightbox_BackgroundImage; ?>" /> 
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxUploader" style="margin-left: 0px; margin-right: 10px;">Select or Upload a Background Image:</label>
					<input id="ts_vcsc_extend_settings_defaultLightboxUploader" class="ts_vcsc_extend_settings_defaultLightboxUploader button" type="button" value="Background Image" <?php echo ($Lightbox_BackgroundImage != '' ? 'disabled="disabled"' : ''); ?>/>
				</div>
				<div id="ts_vcsc_extend_settings_defaultLightboxImageHolder" style="display: <?php echo ($Lightbox_BackgroundImage != '' ? 'block' : 'none'); ?>;">
					<span id="ts_vcsc_extend_settings_defaultLightboxImageRemove" title="Remove Background Image for Lightbox"><i class="dashicons dashicons-no"></i></span>
					<img id="ts_vcsc_extend_settings_defaultLightboxImageDisplay" class="ts_vcsc_extend_settings_defaultLightboxImage" src="<?php echo $Lightbox_BackgroundImage; ?>">
                    <label class="Uniform" style="display: inline-block; margin-left: 0px; width: 148px;" for="ts_vcsc_extend_settings_defaultLightboxRepeat">Background Repeat:</label>
                    <select id="ts_vcsc_extend_settings_defaultLightboxRepeat" name="ts_vcsc_extend_settings_defaultLightboxRepeat" style="width: 148px; margin: 0;">
                        <option value="no-repeat" <?php selected('no-repeat', 	$Lightbox_BackgroundRepeat); ?>>No Repeat</option>
                        <option value="repeat" <?php selected('repeat', 		$Lightbox_BackgroundRepeat); ?>>Repeat X + Y</option>
                        <option value="repeat x" <?php selected('repeat x', 	$Lightbox_BackgroundRepeat); ?>>Repeat X</option>
						<option value="repeat y" <?php selected('repeat y', 	$Lightbox_BackgroundRepeat); ?>>Repeat Y</option>
                    </select>
				</div>
			</div>			
			<div style="margin-top: 20px;">
				<h4>Lightbox Noise Pattern:</h4>
				<p style="font-size: 12px;">Select an optional noise pattern for the lightbox overlay (should only be used with semi-transparent overlay or lightly colored overlay):</p>
				<select id="ts_vcsc_extend_settings_defaultLightboxNoise" name="ts_vcsc_extend_settings_defaultLightboxNoise" data-background="true" data-width="100" data-height="100" class="ts-image-picker ts_vcsc_extend_settings_defaultLightboxNoise" value="<?php echo $Lightbox_NoisePattern; ?>">
					<?php
						foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Rasters_List as $key => $option) {
							$selected = selected(($Lightbox_NoisePattern == TS_VCSC_GetResourceURL($option)) , true, false);
							if ($key != '') {
								echo '<option data-img-src="' . TS_VCSC_GetResourceURL($option) . '" value="' . TS_VCSC_GetResourceURL($option) . '" ' . $selected . '>' . $key . '</option>';
							} else {
								echo '<option data-img-src="" value="" ' . $selected . '>transparent</option>';
							}
						}
					?>
				</select>
			</div>			
			<div style="margin-top: 20px;">
				<h4>Lightbox Button Scheme:</h4>
				<p style="font-size: 12px;">Select the button scheme (color) that should be used with the lightbox:</p>
				<select id="ts_vcsc_extend_settings_defaultLightboxScheme" name="ts_vcsc_extend_settings_defaultLightboxScheme" data-background="true" data-width="286" data-height="60" class="ts-image-picker ts_vcsc_extend_settings_defaultLightboxScheme" value="<?php echo $Lightbox_ButtonScheme; ?>">
					<?php
						$selected = selected(($Lightbox_ButtonScheme == 'dark') , true, false);
						echo '<option data-img-src="' . TS_VCSC_GetResourceURL("images/other/lightbox_dark.jpg") . '" value="dark" ' . $selected . '>Dark</option>';
						$selected = selected(($Lightbox_ButtonScheme == 'light') , true, false);
						echo '<option data-img-src="' . TS_VCSC_GetResourceURL("images/other/lightbox_light.jpg") . '" value="light" ' . $selected . '>Light</option>';
					?>
				</select>
			</div>			
			<div style="margin-top: 10px;">
				<h4>Touch & Swipe Navigation:</h4>
				<p style="font-size: 12px;">Define if the lightbox can be navigated via touch and swipe gestures (on supported devices):</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_AllowTouchSwipe == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxNoTouch" class="toggle-check ts_vcsc_extend_settings_defaultLightboxNoTouch" name="ts_vcsc_extend_settings_defaultLightboxNoTouch" value="1" <?php echo checked('1', $Lightbox_AllowTouchSwipe); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_AllowTouchSwipe == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_AllowTouchSwipe == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxNoTouch">Enable Touch & Swipe Navigation</label>
			</div>	
			<div style="margin-top: 20px;">
				<h4>Keyboard Navigation:</h4>
				<p style="font-size: 12px;">Define if the lightbox can be operated via keyboard navigation (on supported devices):</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_AllowKeyboard == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxKeyboard" class="toggle-check ts_vcsc_extend_settings_defaultLightboxKeyboard" name="ts_vcsc_extend_settings_defaultLightboxKeyboard" value="1" <?php echo checked('1', $Lightbox_AllowKeyboard); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_AllowKeyboard == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_AllowKeyboard == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxKeyboard">Enable Keyboard Navigation</label>
			</div>	
			<div style="margin-top: 20px;">
				<h4>Zoom Feature:</h4>
				<p style="font-size: 12px;">Define if the lightbox should provide a zoom option for over-sized images:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_AllowZoom == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxZoom" class="toggle-check ts_vcsc_extend_settings_defaultLightboxZoom" name="ts_vcsc_extend_settings_defaultLightboxZoom" value="1" <?php echo checked('1', $Lightbox_AllowZoom); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_AllowZoom == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_AllowZoom == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxZoom">Enable Zoom Button</label>
			</div>	
			<div style="margin-top: 20px;">
				<h4>Full Screen Feature:</h4>
				<p style="font-size: 12px;">Define if the lightbox should provide a full screen option:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_AllowFullscreen == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxFullScreen" class="toggle-check ts_vcsc_extend_settings_defaultLightboxFullScreen" name="ts_vcsc_extend_settings_defaultLightboxFullScreen" value="1" <?php echo checked('1', $Lightbox_AllowFullscreen); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_AllowFullscreen == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_AllowFullscreen == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxFullScreen">Enable Full Screen Button</label>
			</div>	
			<div style="margin-top: 20px;">
				<h4>Close Button inside Lightbox:</h4>
				<p style="font-size: 12px;">Define if the lightbox should provide another close button inside the Lightbox element:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_CloseButton == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxCloser" class="toggle-check ts_vcsc_extend_settings_defaultLightboxCloser" name="ts_vcsc_extend_settings_defaultLightboxCloser" value="1" <?php echo checked('1', $Lightbox_CloseButton); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_CloseButton == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_CloseButton == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxCloser">Enable 2nd Close Button inside Lightbox</label>
			</div>
			<div style="margin-top: 20px;">
				<h4>Background Close Feature:</h4>
				<p style="font-size: 12px;">Define if the lightbox can be closed by clicking on the lightbox background:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_BackgroundClose == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxBGClose" class="toggle-check ts_vcsc_extend_settings_defaultLightboxBGClose" name="ts_vcsc_extend_settings_defaultLightboxBGClose" value="1" <?php echo checked('1', $Lightbox_BackgroundClose); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_BackgroundClose == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_BackgroundClose == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxBGClose">Enable Background Close</label>
			</div>
			
			<div style="margin-top: 20px;">
				<h4>Social Share Feature:</h4>
				<p style="font-size: 12px;">Define if the lightbox should allow for a social share feature; can be overwritten by some elements:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_AllowShare == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxShare" class="toggle-check ts_vcsc_extend_settings_defaultLightboxShare" name="ts_vcsc_extend_settings_defaultLightboxShare" value="1" <?php echo checked('1', $Lightbox_AllowShare); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_AllowShare == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_AllowShare == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxShare">Enable Global Social Share</label>
			</div>			
			<div style="margin-top: 20px;">
				<h4>Social Networks:</h4>
				<p style="font-size: 12px;">Define the social networks and their order, using "fb" for Facebook, "tw" for Twitter, "gp" for Google+ and "pin" for Pinterest; separate by comma (i.e. "fb,tw,gp,pin"):</p>
				<label class="Uniform" style="display: inline-block; margin-left: 0;" for="ts_vcsc_extend_settings_defaultLightboxNetworks">Social Networks (fb,tw,gp,pin):</label>
				<input class="validate[required]" data-error="Lightbox - Social Networks" data-order="8" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_defaultLightboxNetworks" name="ts_vcsc_extend_settings_defaultLightboxNetworks" value="<?php echo $Lightbox_SocialNetworks; ?>" size="100">
			</div>			
			<div style="margin-top: 20px;">
				<h4>Remove Hashtag Navigation:</h4>
				<p style="font-size: 12px;">Define if the lightbox should remove hashtags from media elements (otherwise added for navigation purposes and deeplinking):</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_RemoveHashtag == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxHashtag" class="toggle-check ts_vcsc_extend_settings_defaultLightboxHashtag" name="ts_vcsc_extend_settings_defaultLightboxHashtag" value="1" <?php echo checked('1', $Lightbox_RemoveHashtag); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_RemoveHashtag == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_RemoveHashtag == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxHashtag">Remove Hashtag Navigation</label>
			</div>			
			<div style="margin-top: 20px;">
				<h4>Allow CORS Requests:</h4>
				<p style="font-size: 12px;">Define if the lightbox is allowed to use CORS requests to analyze image data; enable only if images are retrieved cross-domain as it will increase image loading times:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_AllowCORS == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxCors" class="toggle-check ts_vcsc_extend_settings_defaultLightboxCors" name="ts_vcsc_extend_settings_defaultLightboxCors" value="1" <?php echo checked('1', $Lightbox_AllowCORS); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_AllowCORS == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_AllowCORS == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxHashtag">Enable CORS Requests</label>
			</div>			
			<div style="margin-top: 20px; margin-bottom: 10px;">
				<h4>Remove Backlight Effect:</h4>
				<p style="font-size: 12px;">Define if the lightbox should remove the backlight effect for all elements (will overwrite individual element settings):</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_RemoveLight == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxBacklight" class="toggle-check ts_vcsc_extend_settings_defaultLightboxBacklight" name="ts_vcsc_extend_settings_defaultLightboxBacklight" value="1" <?php echo checked('1', $Lightbox_RemoveLight); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_RemoveLight == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_RemoveLight == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxBacklight">Remove Backlight Effect</label>
			</div>
			<div id="ts_vcsc_extend_settings_defaultLightboxBacklight_false" style="margin-top: 10px; margin-bottom: 10px; margin-left: 25px; <?php echo ($Lightbox_RemoveLight == 1 ? 'display: none;' : 'display: block;'); ?>">
				<h4>Use Global Backlight Color:</h4>
				<p style="font-size: 12px;">Define if the lightbox should use a global backlight color, overriding all individual settings:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($Lightbox_CustomLight == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_defaultLightboxBackCustom" class="toggle-check ts_vcsc_extend_settings_defaultLightboxBackCustom" name="ts_vcsc_extend_settings_defaultLightboxBackCustom" value="1" <?php echo checked('1', $Lightbox_CustomLight); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($Lightbox_CustomLight == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($Lightbox_CustomLight == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_defaultLightboxBacklight">Use Global Backlight</label>
				<div id="ts_vcsc_extend_settings_defaultLightboxBackCustom_true" style="margin-top: 20px; margin-bottom: 10px; margin-left: 25px; <?php echo ($Lightbox_CustomLight == 0 ? 'display: none;' : 'display: block;'); ?>">
					<h4>Lightbox Backlight Color:</h4>
					<p style="font-size: 12px;">Define a global color to be used for lightbox backlight effect:</p>
					<div class="ts-color-group">
						<input id="ts_vcsc_extend_settings_defaultLightboxBackColor" name="ts_vcsc_extend_settings_defaultLightboxBackColor" data-error="Lightbox - Backlight Color" data-order="8" class="validate[required,funcCall[checkColorPickerSyntax]] ts_vcsc_extend_settings_defaultLightboxBackColor ts-color-control" data-alpha="false" type="text" value="<?php echo $Lightbox_BackColor; ?>"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	global $VISUAL_COMPOSER_EXTENSIONS;	
?>
<div id="ts-settings-general" class="tab-content">
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-info"></i>General Information</div>
		<div class="ts-vcsc-section-content">
			<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
				In order to use this plugin, you MUST have the Visual Composer Plugin installed; either as a normal plugin or as part of your theme. If Visual Composer is part of your theme, please ensure that it has not been modified;
				some theme developers heavily modify Visual Composer in order to allow for certain theme functions. Unfortunately, some of these modification prevent this extension pack from working correctly.
			</div>
			<div style="margin-top: 20px; margin-bottom: 10px;">
				<h4>Visual Composer Extensions</h4>
				<div class="ts-vcsc-notice-field ts-vcsc-critical" style="margin-top: 10px; font-size: 13px; text-align: justify;">If you are using the "User Groups Access Rules" provided by Visual Composer itself, you MUST enable the new elements in the <a href="options-general.php?page=vc_settings" target="_parent">settings</a> for the actual Visual Composer Plugin.</div>
				<div style="margin-top: 20px;">
					<a class="button-secondary" style="width: 150px; margin: 0px auto; text-align: center;" href="http://codecanyon.net/item/visual-composer-extensions/7190695" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/logos/ts_vcsc_menu_icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Buy Plugin</a>
					<a class="button-secondary" style="width: 150px; margin: 0px auto; text-align: center;" href="http://tekanewascripts.info/composer/manual/" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/other/ts_vcsc_manual_icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Manual</a>
					<a class="button-secondary" style="width: 150px; margin: 0px auto; text-align: center;" href="http://support.tekanewascripts.info/forums/forum/wordpress-plugins/visual-composer-extensions/" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/other/ts_vcsc_support_icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Support Forum</a>
					<a class="button-secondary" style="width: 150px; margin: 0px auto; text-align: center;" href="http://support.tekanewascripts.info/category/visual-composer-extensions/" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/other/ts_vcsc_knowledge_icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Knowledge Base</a>
					<a class="button-secondary" style="width: 150px; margin: 0px auto; text-align: center;" href="admin.php?page=TS_VCSC_CSS" target="_parent"><img src="<?php echo TS_VCSC_GetResourceURL('images/other/ts_vcsc_customcss_icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Custom CSS</a>
					<a class="button-secondary" style="width: 150px; margin: 0px auto; text-align: center;" href="admin.php?page=TS_VCSC_JS" target="_parent"><img src="<?php echo TS_VCSC_GetResourceURL('images/other/ts_vcsc_customjs_icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Custom JS</a>
					<?php
						if (get_option('ts_vcsc_extend_settings_extended', 0) == 0) {
							echo '<a class="button-secondary" style="width: 150px; margin: 0px auto; text-align: center;" href="admin.php?page=TS_VCSC_License" target="_parent"><img src="' . TS_VCSC_GetResourceURL('images/other/ts_vcsc_license_icon_16x16.png') . '" style="width: 16px; height: 16px; margin-right: 10px;">License</a>';
						}
					?>
				</div>
			</div>
		</div>		
	</div>
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-admin-generic"></i>Basic Settings</div>
		<div class="ts-vcsc-section-content">
			<div style="margin-top: 10px;">
				<h4>Placement of Visual Composer Extensions Menu:</h4>
				<p style="font-size: 12px;">Define where the menu for this plugin should be placed in WordPress; if disabled, the main menu will be placed in the 'Settings' section:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_mainmenu == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_mainmenu" class="toggle-check ts_vcsc_extend_settings_mainmenu" name="ts_vcsc_extend_settings_mainmenu" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_mainmenu); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_mainmenu == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_mainmenu == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_mainmenu">Give Visual Composer Extensions its own menu</label>
			</div>		
			<div style="margin-top: 30px;">
				<h4>Use of Language Domain Translations:</h4>
				<p style="font-size: 12px;">Define if the plugin can use its language domain files (stored in the 'locale' folder) in order to automatically be translated into available languages:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_translationsDomain == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_translationsDomain" class="toggle-check ts_vcsc_extend_settings_translationsDomain" name="ts_vcsc_extend_settings_translationsDomain" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_translationsDomain); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_translationsDomain == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_translationsDomain == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_translationsDomain">Use Plugin Language Files</label>
			</div>			
			<div style="margin-top: 30px;">
				<h4>Show Dashboard Panel:</h4>
				<p style="font-size: 12px;">Define if the plugin should show its dashboard panel with basic plugin information:</p>
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_dashboard == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_dashboard" class="toggle-check ts_vcsc_extend_settings_dashboard" name="ts_vcsc_extend_settings_dashboard" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_dashboard); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_dashboard == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_dashboard == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_dashboard">Show Dashboard Panel</label>
			</div>			
			<div style="margin-top: 30px; margin-bottom: 10px;">
				<h4>Show Live Preview in Backend Editor:</h4>
				<p style="font-size: 12px;">Define if the plugin should render a live preview of basic elements when using the backend editor:</p>
				<div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					For some more basic element that don't have any dependencies on JavaScript routines, the plugin can create a live preview of how the element would look like in the frontend while editing in the backend editor.
					Additional attributes like links or CSS3 animations will of course not be shown, just a graphic rendering of the element. Additional stylesheets (CSS) will have to be loaded to define element styling.
				</div>	
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_backendPreview == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_backendPreview" class="toggle-check ts_vcsc_extend_settings_backendPreview" name="ts_vcsc_extend_settings_backendPreview" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_backendPreview); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_backendPreview == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_backendPreview == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_previewImages">Show Live Preview</label>
			</div>			
			<div style="margin-top: 30px; margin-bottom: 10px;">
				<h4>Show Preview Images in Backend Editor:</h4>
				<p style="font-size: 12px;">Define if the plugin should show preview images for all elements using images, or just the image ID when editing a page in the back-end editor:</p>
				<div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					By default, the plugin will always show a thumbnail preview image for all of its elements that can utilize images. If you have many of those elements on one site, it can slow down loading times while editing on the
					backend as the thumbnail for each image has to be loaded individually via Ajax request. If you prefer, you can therefore disable that preview and you will be provided with the WordPress image ID number instead.
					This setting will not affect the live preview rendering of basic elements as defined above.
				</div>	
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_previewImages == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_previewImages" class="toggle-check ts_vcsc_extend_settings_previewImages" name="ts_vcsc_extend_settings_previewImages" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_previewImages); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_previewImages == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_previewImages == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_previewImages">Show Preview Images</label>
			</div>
			<div style="margin-top: 30px; margin-bottom: 10px;">
				<h4>Use Visual Icon Selector:</h4>
				<p style="font-size: 12px;">Define if the plugin should provide you with a visual icon selector for elements, or if you want to manually enter the icon class name:</p>				
				<div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					While the visual icon selector is more convenient to use as you immediately know how the icon looks like, it might slow down your site if you have too many icons (icon fonts) activated as it takes more time
					to create the visual preview of 1,000+ icons, than it does for 200 icons. In those cases, you can disable the visual icon selector and instead provide your icon of choice by entering its class name.
				</div>	
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_visualSelector == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " data-native="<?php echo $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorIconFontsInternal; ?>" id="ts_vcsc_extend_settings_visualSelector" class="toggle-check ts_vcsc_extend_settings_visualSelector" name="ts_vcsc_extend_settings_visualSelector" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_visualSelector); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_visualSelector == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_visualSelector == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_visualSelector">Use Visual Icon Selector</label>
			</div>	
			<div id="ts_vcsc_extend_settings_visualSelector_true" data-native="<?php echo $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorIconFontsInternal; ?>" style="margin-top: 30px; margin-bottom: 10px; margin-left: 25px; display: <?php echo ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorIconFontsInternal == "true") && ($ts_vcsc_extend_settings_visualSelector == 1)) ? "block;" : "none;"); ?>">
				<h4>Use VC Native Icon Selector:</h4>
				<p style="font-size: 12px;">Define if the plugin should use the native icon selector that comes with Visual Composer (v4.4.0+):</p>				
				<div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					This add-on included a visual icon selector from its very first release, while Visual Composer itself didn't have such feature, until the release of v4.4.0. To keep things uniform, this add-on will use the
					native icon selector that is now part of Visual Composer, but you can switch back to the custom version we used before, if you desire to do so.
				</div>	
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_nativeSelector == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_nativeSelector" class="toggle-check ts_vcsc_extend_settings_nativeSelector" name="ts_vcsc_extend_settings_nativeSelector" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_nativeSelector); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_nativeSelector == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_nativeSelector == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_nativeSelector">Use VC Native Icon Selector</label>
			</div>
			<div id="ts_vcsc_extend_settings_nativeSelector_true" class="clearFixMe" style="margin-top: 30px; margin-bottom: 10px; margin-left: 50px; display: <?php echo ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorIconFontsInternal == "true") && ($ts_vcsc_extend_settings_visualSelector == 1) && ($ts_vcsc_extend_settings_nativeSelector == 1)) ? "block;" : "none;"); ?>">
				<h4>Number of Icons per Page:</h4>
				<p style="font-size: 12px;">Define the number of icons that should be shown per page when using the icon picker:</p>
				<div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					The more icons you are showing per page, the slower the icon picker element will initially render, as it takes more time to build a visual preview of 200 icons, than it would for 1,000. The limit set here will
					only apply to the native icon pickers utilized by this add-on; it will not transfer to the same type of icon picker used by Visual Composer itself or other add-ons.
				</div>	
				<div class="ts-nouislider-input-slider">
					<input style="width: 100px; float: left; margin-left: 0px; margin-right: 10px;" name="ts_vcsc_extend_settings_nativePaginator" id="ts_vcsc_extend_settings_nativePaginator" class="ts_vcsc_extend_settings_nativePaginator ts-nouislider-serial nouislider-input-selector nouislider-input-composer" type="text" value="<?php echo $ts_vcsc_extend_settings_nativePaginator; ?>"/>
						<span style="float: left; margin-right: 30px; margin-top: 10px;" class="unit">Icons</span>
					<div class="ts-nouislider-input ts-nouislider-settings-element" data-value="<?php echo $ts_vcsc_extend_settings_nativePaginator; ?>" data-min="50" data-max="1000" data-decimals="0" data-step="1" style="width: 250px; float: left; margin-top: 10px;"></div>
				</div>
			</div>
			<div style="margin-top: 30px; margin-bottom: 10px;">
				<h4>Old Settings Retrieval:</h4>
				<p style="font-size: 12px;">Define if the plugin should attempt to retrieve settings lost after an update:</p>				
				<div class="ts-vcsc-notice-field ts-vcsc-critical" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					Sometimes, it becomes necessary to change the way the plugin is storing its settings in order to allow for additional settings or an improved performance. In those cases, existing settings might get lost in the
					process. By activating the switch below, you can attempt to retrieve some of those old settings (no guarantees given). Please remember to deactivate that switch once done so the retrieval procedure doesn't run
					every time!
				</div>	
				<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_dataRestore == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
					<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_dataRestore" class="toggle-check ts_vcsc_extend_settings_dataRestore" name="ts_vcsc_extend_settings_dataRestore" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_dataRestore); ?>/>
					<div class="toggle toggle-light" style="width: 80px; height: 20px;">
						<div class="toggle-slide">
							<div class="toggle-inner">
								<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_dataRestore == 1 ? 'active' : ''); ?>">Yes</div>
								<div class="toggle-blob"></div>
								<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_dataRestore == 0 ? 'active' : ''); ?>">No</div>
							</div>
						</div>
					</div>
				</div>
				<label class="labelToggleBox" for="ts_vcsc_extend_settings_dataRestore">Attempt Data Retrieval</label>
			</div>
		</div>		
	</div>	
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-shield"></i>Manage Elements</div>
		<div class="ts-vcsc-section-content">
			<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 20px; font-size: 13px; text-align: justify;">
				While you can prevent individual elements from becoming available to certain user groups (using the "User Group Access Rules" in the settings for the original Visual Composer Plugin), the elements are technically still
				loaded in the background. In order to allow for an improved overall site performance, you can completely disable unwanted elements that are part of "Composium - Visual Composer Extensions" here. Once disabled, the element and its
				associated shortcode will not be loaded anymore. <strong>Also, on default, not all elements are activated upon first plugin activation, so please check the list and the select the elements you are planning to use.</strong>
			</div>		
			<div class="ts-vcsc-notice-field ts-vcsc-critical" style="margin-top: 20px; margin-bottom: 20px; font-size: 13px; font-weight: bold; text-align: justify;">
				The original Visual Composer Plugin might still require you to enable the elements based on available user roles using the <a href="options-general.php?page=vc_settings">settings panel</a> for Visual Composer. That settings panel controls
				which users have access to which Visual Composer elements but doesn't stop them from being loaded.
			</div>		
			<div class="clearFixMe" style="">
				<div style="width: 100%; float: left;">
					<h4>Standard Shortcodes</h4>
					<p style="font-size: 12px; text-align: justify;">These are the elements that are currently fully supported and fully compatible with the current release of Visual Composer.</p>
					<?php foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
						if (($element['type'] != 'demos') && ($element['deprecated'] == 'false') && ($element['type'] != 'external')) {
							echo '<div style="margin: 0 0 10px 0; width: 30%; float: left; min-width: 360px; margin-right: 3%;">';
								echo '<div class="ts-switch-button ts-composer-switch" data-value="' . $element['active'] . '" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">';
									echo '<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_custom' . $element['setting'] .'" class="toggle-check ts_vcsc_extend_settings_custom' . $element['setting'] . '" name="ts_vcsc_extend_settings_custom' . $element['setting'] . '" value="1" ' . ($element['active'] == "true" ? ' checked="checked"' : '') . '/>';
									echo '<div class="toggle toggle-light" style="width: 80px; height: 20px;">';
										echo '<div class="toggle-slide">';
											echo '<div class="toggle-inner">';
												echo '<div class="toggle-on ' . ($element['active'] == 'true' ? 'active' : '') . '">Yes</div>';
												echo '<div class="toggle-blob"></div>';
												echo '<div class="toggle-off ' . ($element['active'] == 'false' ? 'active' : '') . '">No</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<label class="labelToggleBox" for="ts_vcsc_extend_settings_custom' . $element['setting'] . '">Enable "' . $ElementName . '"</label>';				
							echo '</div>';
						}
					} ?>
				</div>
			</div>
			<div class="clearFixMe" style="margin-top: 20px;">
				<div style="width: 48%; float: left; min-width: 360px; margin-right: 2%;">
					<h4>Deprecated Shortcodes</h4>
					<p style="font-size: 12px; text-align: justify;">These elements have been deprecated in favor of other elements; you should use the new versions instead.</p>
					<?php foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
						if (($element['type'] != 'demos') && ($element['deprecated'] == 'true') && ($element['type'] != 'external')) {
							echo '<div style="margin: 0 0 10px 0;">';
								echo '<div class="ts-switch-button ts-composer-switch" data-value="' . $element['active'] . '" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">';
									echo '<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_custom' . $element['setting'] .'" class="toggle-check ts_vcsc_extend_settings_custom' . $element['setting'] . '" name="ts_vcsc_extend_settings_custom' . $element['setting'] . '" value="1" ' . ($element['active'] == "true" ? ' checked="checked"' : '') . '/>';
									echo '<div class="toggle toggle-light" style="width: 80px; height: 20px;">';
										echo '<div class="toggle-slide">';
											echo '<div class="toggle-inner">';
												echo '<div class="toggle-on ' . ($element['active'] == 'true' ? 'active' : '') . '">Yes</div>';
												echo '<div class="toggle-blob"></div>';
												echo '<div class="toggle-off ' . ($element['active'] == 'false' ? 'active' : '') . '">No</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<label class="labelToggleBox" for="ts_vcsc_extend_settings_custom' . $element['setting'] . '">Enable "' . $ElementName . '"</label>';	
							echo '</div>';
						}
					} ?>
				</div>
				<div style="width: 48%; float: left; min-width: 360px; margin-left: 2%;">
					<h4>3rd Party Shortcodes</h4>
					<p style="font-size: 12px; text-align: justify;">These elements require additional (not included) plugins or are just for demo purposes.</p>
					<?php foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
						if (($element['type'] == 'demos') || ($element['type'] == 'external')) {
							echo '<div style="margin: 0 0 10px 0;">';
								echo '<div class="ts-switch-button ts-composer-switch" data-value="' . $element['active'] . '" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">';
									echo '<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_custom' . $element['setting'] .'" class="toggle-check ts_vcsc_extend_settings_custom' . $element['setting'] . '" name="ts_vcsc_extend_settings_custom' . $element['setting'] . '" value="1" ' . ($element['active'] == "true" ? ' checked="checked"' : '') . '/>';
									echo '<div class="toggle toggle-light" style="width: 80px; height: 20px;">';
										echo '<div class="toggle-slide">';
											echo '<div class="toggle-inner">';
												echo '<div class="toggle-on ' . ($element['active'] == 'true' ? 'active' : '') . '">Yes</div>';
												echo '<div class="toggle-blob"></div>';
												echo '<div class="toggle-off ' . ($element['active'] == 'false' ? 'active' : '') . '">No</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<label class="labelToggleBox" for="ts_vcsc_extend_settings_custom' . $element['setting'] . '">Enable "' . $ElementName . '"</label>';	
							echo '</div>';
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
	<div class="clear clearFixMe"></div>
	<?php if (((get_option('ts_vcsc_extend_settings_extended', 0) == 1) && (get_option('ts_vcsc_extend_settings_additions', 1) == 1)) || ((get_option('ts_vcsc_extend_settings_extended', 0) == 0))) { ?>
		<div class="ts-vcsc-section-main">
			<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-schedule"></i>Extended Rows & Columns</div>
			<div class="ts-vcsc-section-content">
				<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					Visual Composer Extensions allows you to extend the available options for Row and Column settings, adding features such as viewport animations (row + column) and a variety of background effects (row). If you already use other
					plugins that provide the same or similar options you should decide for either one but not use both at the same time as they can cause contradicting settings. Also, if your theme incorporates Visual Composer by itself, some
					themes already provide you with similar options; in these cases, you should disable the settings below in order to avoid any conflicts.
				</div>		
				<div style="margin-top: 20px; font-weight: bold;">The extended Row and Column Options require a Visual Composer version of 4.1 or higher, in order to function correctly!</div>		
				<div style="margin-top: 20px;">
					<h4>Extend Options for Visual Composer Rows:</h4>
					<p style="font-size: 12px;">Extend Row Options with Background Effects and Viewport Animation Settings:</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_additionsRows == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_additionsRows" class="toggle-check ts_vcsc_extend_settings_additionsRows" name="ts_vcsc_extend_settings_additionsRows" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_additionsRows); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_additionsRows == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_additionsRows == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_additionsRows">Extend Row Options</label>
				</div>				
				<div id="ts_vcsc_extend_settings_additionsRows_true" style="margin-top: 20px; margin-bottom: 10px; margin-left: 25px; <?php echo ($ts_vcsc_extend_settings_additionsRows == 0 ? 'display: none;' : 'display: block;'); ?>">
					<h4>Show Background Preview Indicator:</h4>
					<p style="font-size: 12px;">When a row background has been applied with the extended row options, a background indicator can be shown next to the row control options:</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_backgroundIndicator == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_backgroundIndicator" class="toggle-check ts_vcsc_extend_settings_backgroundIndicator" name="ts_vcsc_extend_settings_backgroundIndicator" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_backgroundIndicator); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_backgroundIndicator == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_backgroundIndicator == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_additionsRows">Show Background Indicator</label>
				</div>
				<div style="margin-top: 20px;">
					<h4>Extend Options for Visual Composer Columns:</h4>
					<p style="font-size: 12px;">Extend Column Options with Viewport Animation Settings:</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_additionsColumns == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_additionsColumns" class="toggle-check ts_vcsc_extend_settings_additionsColumns" name="ts_vcsc_extend_settings_additionsColumns" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_additionsColumns); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_additionsColumns == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_additionsColumns == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_additionsColumns">Extend Column Options</label>
				</div>		
				<div style="margin-top: 20px; margin-bottom: 10px;">
					<h4>Smooth Scroll for Pages:</h4>
					<p style="font-size: 12px;">Extend all pages with Smooth Scroll Feature (will not be applied on mobilde devices); do not use if your theme or another plugin is already implementing a smooth scroll feature:</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_additionsSmoothScroll == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_additionsSmoothScroll" class="toggle-check ts_vcsc_extend_settings_additionsSmoothScroll" name="ts_vcsc_extend_settings_additionsSmoothScroll" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_additionsSmoothScroll); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_additionsSmoothScroll == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_additionsSmoothScroll == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_additionsColumns">Extend Pages with Smooth Scroll</label>
				</div>
			</div>
		</div>
	<?php } ?>
	
	<?php if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesCheckup == "true") {  ?>
		<div class="ts-vcsc-section-main">
			<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-format-aside"></i>Manage Custom Post Types</div>
			<div class="ts-vcsc-section-content">
				<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					Starting with version 2.0, Visual Composer Extensions introduced custom post types, to be used for some of the elements and for more complex layouts. If your theme or another plugin already provides a similiar post
					type (i.e. a post type for "teams"), you can disable the corresponding custom post type that comes with Visual Composer Extensions. Disabling a custom post type will also disable the corresponding Visual Composer elements
					and shortcodes associated with the post type.
				</div>				
				<?php
					if ((version_compare('1.2.0', $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesClass, '>=')) && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesInternal == "false")) {
						echo '<div class="ts-vcsc-notice-field ts-vcsc-critical" style="margin-top: 20px; margin-bottom: 20px; font-size: 13px; font-weight: bold; color: red; text-align: justify;">';
							echo 'Another plugin or your theme is loading an OUTDATED version (v' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesClass . ') of the PHP helper class "Custom Metaboxes and Fields", which is
							used to create the custom post types below. Functionality of our custom post types can not be guaranteed with the outdated version your WordPress is currently using.';
						echo '</div>';
					} else if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesInternal == "false") {
						echo '<div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 20px; margin-bottom: 20px; font-size: 13px; font-weight: bold; color: #fbeba4; text-align: justify;">';
							echo 'Another plugin or your theme is already loading the PHP helper class "Custom Metaboxes and Fields" (v' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesClass . '), which is
							used to create the custom post types below. Please ensure that the version loaded is not modified as functionality of our custom post types can otherwise not be guaranteed.';
						echo '</div>';
					}
				?>
				<div style="margin-top: 20px; display: <?php echo (((get_option('ts_vcsc_extend_settings_extended', 0) == 1) && (get_option('ts_vcsc_extend_settings_posttypeTeam', 1) == 0)) ? "none;" : "block;"); ?>">
					<h4>Visual Composer Team:</h4>
					<p style="font-size: 12px;">Enable or disable the custom post type "VC Team":</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_customTeam == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_customTeam" class="toggle-check ts_vcsc_extend_settings_customTeam" name="ts_vcsc_extend_settings_customTeam" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_customTeam); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_customTeam == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_customTeam == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_customTeam">Enable "VC Team" Post Type</label>
				</div>		
				<div style="margin-top: 20px; display: <?php echo (((get_option('ts_vcsc_extend_settings_extended', 0) == 1) && (get_option('ts_vcsc_extend_settings_posttypeTestimonial', 1) == 0)) ? "none;" : "block;"); ?>">
					<h4>Visual Composer Testimonials:</h4>
					<p style="font-size: 12px;">Enable or disable the custom post type "VC Testimonials":</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_customTestimonial == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_customTestimonial" class="toggle-check ts_vcsc_extend_settings_customTestimonial" name="ts_vcsc_extend_settings_customTestimonial" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_customTestimonial); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_customTestimonial == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_customTestimonial == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_customTestimonial">Enable "VC Testimonials" Post Type</label>
				</div>		
				<div style="margin-top: 20px; display: <?php echo (((get_option('ts_vcsc_extend_settings_extended', 0) == 1) && (get_option('ts_vcsc_extend_settings_posttypeSkillset', 1) == 0)) ? "none;" : "block;"); ?>">
					<h4>Visual Composer Skillsets:</h4>
					<p style="font-size: 12px;">Enable or disable the custom post type "VC Skillsets":</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_customSkillset == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_customSkillset" class="toggle-check ts_vcsc_extend_settings_customSkillset" name="ts_vcsc_extend_settings_customSkillset" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_customSkillset); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_customSkillset == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_customSkillset == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_customLogo">Enable "VC Skillsets" Post Type</label>			
				</div>	
				<div style="margin-top: 20px; display: <?php echo (((get_option('ts_vcsc_extend_settings_extended', 0) == 1) && (get_option('ts_vcsc_extend_settings_posttypeLogo', 1) == 0)) ? "none;" : "none;"); ?>">
					<h4>Visual Composer Logos:</h4>
					<p style="font-size: 12px;">Enable or disable the custom post type "VC Logos":</p>
					<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_customLogo == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
						<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_customLogo" class="toggle-check ts_vcsc_extend_settings_customLogo" name="ts_vcsc_extend_settings_customLogo" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_customLogo); ?>/>
						<div class="toggle toggle-light" style="width: 80px; height: 20px;">
							<div class="toggle-slide">
								<div class="toggle-inner">
									<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_customLogo == 1 ? 'active' : ''); ?>">Yes</div>
									<div class="toggle-blob"></div>
									<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_customLogo == 0 ? 'active' : ''); ?>">No</div>
								</div>
							</div>
						</div>
					</div>
					<label class="labelToggleBox" for="ts_vcsc_extend_settings_customLogo">Enable "VC Logos" Post Type</label>			
				</div>
				<div style="height: 0px; width: 100%; margin: 0 0 10px 0; padding: 0;"></div>
			</div>
		</div>
	<?php } ?>
	
	<?php
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
		$license_check = get_site_option('ts_vcsc_extend_settings_demo', 1);
	} else {
		$license_check = get_option('ts_vcsc_extend_settings_demo', 1);
	}
	if (((get_option('ts_vcsc_extend_settings_extended', 0) == 1) && (get_option('ts_vcsc_extend_settings_iconicum', 1) == 1)) || ((get_option('ts_vcsc_extend_settings_extended', 0) == 0) && ($license_check == 0))) {
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconicumStandard == "false") { ?>
			<div class="ts-vcsc-section-main">
				<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-awards"></i>Iconicum - Font Icon Generator</div>
				<div class="ts-vcsc-section-content">
					<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
						For licensed buyers, Visual Composer Extensions includes a bonus plugin "Iconicum - WordPress Icon Fonts". The bonus plugin allows you to use all the font icons that come with Visual Composer Extensions
						outside of the elements that can utilize icons. By using the provided icon generator, you can easily generate icon shortcodes and use those shortcodes anywhere on your site where a standard tinyMCE editor
						field is provided to you.
					</div>
					<div style="margin-top: 10px; margin-bottom: 10px;">
						<h4>Provide Shortcode Generator for Font Icons:</h4>
						<p style="font-size: 12px;">Adds a shortcode generator button to the tinyMCE menu to embed font icons directly into the text editor:</p>
						<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_useIconGenerator == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
							<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_useIconGenerator" class="toggle-check ts_vcsc_extend_settings_useIconGenerator" name="ts_vcsc_extend_settings_useIconGenerator" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_useIconGenerator); ?>/>
							<div class="toggle toggle-light" style="width: 80px; height: 20px;">
								<div class="toggle-slide">
									<div class="toggle-inner">
										<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_useIconGenerator == 1 ? 'active' : ''); ?>">Yes</div>
										<div class="toggle-blob"></div>
										<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_useIconGenerator == 0 ? 'active' : ''); ?>">No</div>
									</div>
								</div>
							</div>
						</div>
						<label class="labelToggleBox" for="ts_vcsc_extend_settings_useIconGenerator">Enable Font Icon Generator</label>
					</div>			
					<div id="ts_vcsc_extend_settings_useIconGenerator_true" style="margin-top: 10px; margin-bottom: 10px; margin-left: 25px; <?php echo ($ts_vcsc_extend_settings_useIconGenerator == 0 ? 'display: none;' : 'display: block;'); ?>">
						<h4>Placement of Shortcode Generator Button:</h4>
						<p style="font-size: 12px;">If the option is disabled, the button will be placed into the tinyMCE menu bar instead:</p>
						<div class="ts-switch-button ts-composer-switch" data-value="<?php echo ($ts_vcsc_extend_settings_useTinyMCEMedia == 1 ? 'true' : 'false'); ?>" data-width="80" data-style="compact" data-on="Yes" data-off="No" style="float: left; margin-right: 10px;">
							<input type="checkbox" style="display: none; " id="ts_vcsc_extend_settings_useTinyMCEMedia" class="toggle-check ts_vcsc_extend_settings_useTinyMCEMedia" name="ts_vcsc_extend_settings_useTinyMCEMedia" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_useTinyMCEMedia); ?>/>
							<div class="toggle toggle-light" style="width: 80px; height: 20px;">
								<div class="toggle-slide">
									<div class="toggle-inner">
										<div class="toggle-on <?php echo ($ts_vcsc_extend_settings_useTinyMCEMedia == 1 ? 'active' : ''); ?>">Yes</div>
										<div class="toggle-blob"></div>
										<div class="toggle-off <?php echo ($ts_vcsc_extend_settings_useTinyMCEMedia == 0 ? 'active' : ''); ?>">No</div>
									</div>
								</div>
							</div>
						</div>
						<label class="labelToggleBox" for="ts_vcsc_extend_settings_useTinyMCEMedia">Place Generator Button next to "Add Media" Button</span></label>
					</div>
				</div>
			</div>
	<?php } else { ?>
		<div class="ts-vcsc-section-main">
			<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-awards"></i>Iconicum - Font Icon Generator</div>
			<div class="ts-vcsc-section-content">
				<div style="margin-top: 10px; margin-bottom: 10px; font-size: 13px; text-align: justify;">
					"Iconicum - WordPress Icon Fonts" is already installed and activated as standalone plugin. Therefore, the version that is included with "Visual Composer Extensions" has been disabled in order to prevent conflicts.
				</div>
			</div>
		</div>
	<?php }} ?>
	
	<div class="ts-vcsc-section-main" style="display: none;">
		<div class="ts-vcsc-section-title ts-vcsc-section-show">Other Settings</div>
		<div class="ts-vcsc-section-content">
			<div style="margin-top: 10px; margin-bottom: 10px;">
				<h4>Viewing Device Detection:</h4>
				<p style="font-size: 12px;">Enable or disable the use of the Device Detection:</p>
				<input type="hidden" name="ts_vcsc_extend_settings_loadDetector" value="0" />
				<input type="checkbox" name="ts_vcsc_extend_settings_loadDetector" id="ts_vcsc_extend_settings_loadDetector" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadDetector); ?> />
				<label class="labelCheckBox" for="ts_vcsc_extend_settings_loadDetector">Use Device Detection</label>
			</div>
		</div>
	</div>
</div>

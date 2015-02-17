<?php
	global $VISUAL_COMPOSER_EXTENSIONS;
	$ts_vcsc_extend_settings_licenseKeyed 									= '';
	$ts_vcsc_extend_settings_licenseRemove									= 'false';
	
	// Check License Key with Envato API
	// ---------------------------------
	if (!function_exists('TS_VCSC_checkEnvatoAPI')){
		function TS_VCSC_checkEnvatoAPI() {
			global $VISUAL_COMPOSER_EXTENSIONS;
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
				if (strlen(get_site_option('ts_vcsc_extend_settings_license')) != 0) {
					$envato_code 													= get_site_option('ts_vcsc_extend_settings_license');
				} else {
					$envato_code 													= "";
				}
				$ts_vcsc_extend_settings_licenseKeyed 								= get_site_option('ts_vcsc_extend_settings_licenseKeyed',			'emptydelimiterfix');
			} else {
				if (strlen(get_option('ts_vcsc_extend_settings_license')) != 0) {
					$envato_code 													= get_option('ts_vcsc_extend_settings_license');
				} else {
					$envato_code 													= "";
				}
				$ts_vcsc_extend_settings_licenseKeyed 								= get_option('ts_vcsc_extend_settings_licenseKeyed',				'emptydelimiterfix');
			}		
			if (($ts_vcsc_extend_settings_licenseKeyed != $envato_code) || ($envato_code == "")) {
				if ((function_exists('wp_remote_get')) && (strlen($envato_code) != 0)) {
					$remoteResponse = wp_remote_get($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_External_URL . $envato_code . '&clienturl=' . site_url());
					$responseText 	= wp_remote_retrieve_body($remoteResponse);
					$responseCode 	= wp_remote_retrieve_response_code($remoteResponse);
				} else if ((function_exists('wp_remote_post')) && (strlen($envato_code) != 0)) {
					$remoteResponse = wp_remote_post($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_External_URL . $envato_code . '&clienturl=' . site_url());
					$responseText 	= wp_remote_retrieve_body($remoteResponse);
					$responseCode 	= wp_remote_retrieve_response_code($remoteResponse);
				} else {
					$remoteResponse = "";
					$responseText	= "";
					$responseCode 	= "";
				}
				if (($responseCode == 200) && (strlen($responseText) != 0)) {
					if ((strlen($envato_code) == 0) || (strpos($responseText, $envato_code) === FALSE)) {
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
							update_site_option('ts_vcsc_extend_settings_licenseValid', 	0);
							update_site_option('ts_vcsc_extend_settings_licenseKeyed', 	'emptydelimiterfix');
							update_site_option('ts_vcsc_extend_settings_licenseInfo', 	((strlen($envato_code) != 0) ? $responseText : ''));
							update_site_option('ts_vcsc_extend_settings_demo', 			1);
						} else {
							update_option('ts_vcsc_extend_settings_licenseValid', 		0);
							update_option('ts_vcsc_extend_settings_licenseKeyed', 		'emptydelimiterfix');
							update_option('ts_vcsc_extend_settings_licenseInfo', 		((strlen($envato_code) != 0) ? $responseText : ''));
							update_option('ts_vcsc_extend_settings_demo', 				1);
						}
						$LicenseCheckStatus = '<div class="clearFixMe" style="color: red; font-weight: bold; padding-bottom: 10px;">License Check has been initiated but was unsuccessful!</div>';
						$LicenseCheckSuccess = 0;
					} else if ((strlen($envato_code) != 0) && (strpos($responseText, $envato_code) != FALSE)) {
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
							update_site_option('ts_vcsc_extend_settings_licenseValid', 	1);
							update_site_option('ts_vcsc_extend_settings_licenseKeyed', 	$envato_code);
							update_site_option('ts_vcsc_extend_settings_licenseInfo', 	str_replace("Link_To_Envato_Image", TS_VCSC_GetResourceURL('images/envato/envato_logo.png'), $responseText));
							update_site_option('ts_vcsc_extend_settings_demo', 			0);
						} else {
							update_option('ts_vcsc_extend_settings_licenseValid', 		1);
							update_option('ts_vcsc_extend_settings_licenseKeyed', 		$envato_code);
							update_option('ts_vcsc_extend_settings_licenseInfo', 		str_replace("Link_To_Envato_Image", TS_VCSC_GetResourceURL('images/envato/envato_logo.png'), $responseText));
							update_option('ts_vcsc_extend_settings_demo', 				0);
						}
						$LicenseCheckStatus = '<div class="clearFixMe" style="color: green; font-weight: bold; padding-bottom: 10px;">License Check has been succesfully completed!</div>';
						$LicenseCheckSuccess = 1;
					} else {
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
							update_site_option('ts_vcsc_extend_settings_licenseValid', 	0);
							update_site_option('ts_vcsc_extend_settings_licenseKeyed', 	'emptydelimiterfix');
							update_site_option('ts_vcsc_extend_settings_licenseInfo', 	((strlen($envato_code) != 0) ? $responseText : ''));
							update_site_option('ts_vcsc_extend_settings_demo', 			1);
						} else {
							update_option('ts_vcsc_extend_settings_licenseValid', 		0);
							update_option('ts_vcsc_extend_settings_licenseKeyed', 		'emptydelimiterfix');
							update_option('ts_vcsc_extend_settings_licenseInfo', 		((strlen($envato_code) != 0) ? $responseText : ''));
							update_option('ts_vcsc_extend_settings_demo', 				1);
						}
						$LicenseCheckStatus = '<div class="clearFixMe" style="color: red; font-weight: bold; padding-bottom: 10px;">License Check has been initiated but was unsuccessful!</div>';
						$LicenseCheckSuccess = 0;
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
						update_site_option('ts_vcsc_extend_settings_licenseValid', 		0);
						update_site_option('ts_vcsc_extend_settings_licenseKeyed', 		'emptydelimiterfix');
						update_site_option('ts_vcsc_extend_settings_licenseInfo', 		'');
						update_site_option('ts_vcsc_extend_settings_demo', 				1);
					} else {
						update_option('ts_vcsc_extend_settings_licenseValid', 			0);
						update_option('ts_vcsc_extend_settings_licenseKeyed', 			'emptydelimiterfix');
						update_option('ts_vcsc_extend_settings_licenseInfo', 			'');
						update_option('ts_vcsc_extend_settings_demo', 					1);
					}
					$LicenseCheckStatus = '<div class="clearFixMe" style="color: red; font-weight: bold; padding-bottom: 10px;">License Check could not be initiated - Missing License Key!</div>';
					$LicenseCheckSuccess = 0;
				}
			} else {
				$LicenseCheckSuccess = 0;
				$LicenseCheckStatus = '<div class="clearFixMe" style="color: green; font-weight: bold; padding-bottom: 10px;">License has been validated already!</div>';
			}
		}
	}
	
	// Get Item Information from Envato
	// --------------------------------
	if (!function_exists('TS_VCSC_ShowInformation')){
		function TS_VCSC_ShowInformation($item_id, $item_vc = true) {
			if ($item_vc == true) {
				$item_id = '7190695';
			}
			$item = TS_VCSC_GetItemInfo($item_id);
			if ($item === false) {
				return '<p style="text-align: justify;">Oops... Something went wrong. Could not retrieve item information from Envato.</p>';
			}
			$item = $item['item'];
			extract($item);
			$ts_vcsc_extend_envatoItem_Name     = $item;
			$ts_vcsc_extend_envatoItem_User		= $user;
			$ts_vcsc_extend_envatoItem_Rating	= $rating;
			$ts_vcsc_extend_envatoItem_Sales	= $sales;
			$ts_vcsc_extend_envatoItem_Price	= $cost;
			$ts_vcsc_extend_envatoItem_Thumb	= $thumbnail;
			$ts_vcsc_extend_envatoItem_Image	= $live_preview_url;
			$ts_vcsc_extend_envatoItem_Link		= $url;
			$ts_vcsc_extend_envatoItem_Release	= $uploaded_on;
			$ts_vcsc_extend_envatoItem_Update	= $last_update;
			$ts_vcsc_extend_envatoItem_HTML 	= '';
			$ts_vcsc_extend_envatoItem_HTML .= '
			<div class="ts_vcsc_envato_item">
				<div class="ts_vcsc_title">'.$ts_vcsc_extend_envatoItem_Name.'</div>
				<div class="ts_vcsc_wrap">
					<div class="ts_vcsc_top">
						<div class="ts_vcsc_rating"><span class="ts_vcsc_desc">Rating</span>' . TS_VCSC_GetEnvatoStars($ts_vcsc_extend_envatoItem_Rating) . '</div>
					</div>
					<div class="ts_vcsc_middle">
						<div class="ts_vcsc_sales">
							<span class="ts_vcsc_img_sales"></span>
							<div class="ts_vcsc_text">
								<span class="ts_vcsc_num">'.$ts_vcsc_extend_envatoItem_Sales.'</span>
								<span class="ts_vcsc_desc">Sales</span>
							</div>
						</div>
						<div class="ts_vcsc_thumb">
							<img src="'.$ts_vcsc_extend_envatoItem_Thumb.'" alt="'.$ts_vcsc_extend_envatoItem_Name.'" width="80" height="80"/>
						</div>
						<div class="ts_vcsc_price">
							<span class="ts_vcsc_img_price"></span>
							<div class="ts_vcsc_text">
								<span class="ts_vcsc_num"><span>$</span>'.round($ts_vcsc_extend_envatoItem_Price).'</span>
								<span class="ts_vcsc_desc">only</span>
							</div>
						</div>
					</div>
					<div class="ts_vcsc_bottom">
						<a href="'.$ts_vcsc_extend_envatoItem_Link.'" target="_blank"></a>
					</div>
				</div>
			</div>';
			if ($item_vc == true) {
				update_option('ts_vcsc_extend_settings_envatoInfo', 	$ts_vcsc_extend_envatoItem_HTML);
				update_option('ts_vcsc_extend_settings_envatoLink', 	$ts_vcsc_extend_envatoItem_Link);
				update_option('ts_vcsc_extend_settings_envatoPrice', 	$ts_vcsc_extend_envatoItem_Price);
				update_option('ts_vcsc_extend_settings_envatoRating', 	TS_VCSC_GetEnvatoStars($ts_vcsc_extend_envatoItem_Rating));
				update_option('ts_vcsc_extend_settings_envatoSales', 	$ts_vcsc_extend_envatoItem_Sales);
			} else {
				echo $ts_vcsc_extend_envatoItem_HTML;
			}
		}
	}
	if (!function_exists('TS_VCSC_GetItemInfo')){
		function TS_VCSC_GetItemInfo($item_id) {
			/* Data cache timeout in seconds - It sends a new request each hour instead of each page refresh */
			$CACHE_EXPIRATION = 3600;
			/* Set the transient ID for caching */
			$transient_id = 'TS_VCSC_Extend_Envato_Item_Data';
			/* Get the cached data */
			$cached_item = get_transient($transient_id);
			/* Check if the function has to send a new API request */
			if (!$cached_item || ($cached_item->item_id != $item_id)) {
				/* Set the API URL, %s will be replaced with the item ID  */
				$api_url = "http://marketplace.envato.com/api/edge/item:%s.json"; 
				/* Fetch data using the WordPress function wp_remote_get() */
				if ((function_exists('wp_remote_get')) && (strlen($item_id) != 0)) {
					$response = wp_remote_get(sprintf($api_url, $item_id));
				} else if ((function_exists('wp_remote_post')) && (strlen($item_id) != 0)) {
					$response = wp_remote_post(sprintf($api_url, $item_id));
				}
				/* Check for errors, if there are some errors return false */
				if (is_wp_error($response) or (wp_remote_retrieve_response_code($response) != 200)) {
					return false;
				}
				/* Transform the JSON string into a PHP array */
				$item_data = json_decode(wp_remote_retrieve_body($response), true);
				/* Check for incorrect data */
				if (!is_array($item_data)) {
					return false;
				}
				/* Prepare data for caching */
				$data_to_cache = new stdClass();
				$data_to_cache->item_id 		= $item_id;
				$data_to_cache->item_info 		= $item_data;
				/* Set the transient - cache item data*/
				set_transient($transient_id, $data_to_cache, $CACHE_EXPIRATION);
				/* Return item info array */
				return $item_data;
			}
			/* If the item is already cached return the cached info */
			return $cached_item->item_info;
		}
	}
	if (!function_exists('TS_VCSC_GetEnvatoStars')){
		function TS_VCSC_GetEnvatoStars($rating) {
			if ((int) $rating == 0) {
				return '<div class="ts_vcsc_not_rating">Not rated yet.</div>';
			}
			$return = '<ul class="ts_vcsc_stars">';
			$i=1;
			while ((--$rating) >= 0) {
				$return .= '<li class="ts_vcsc_full_star"></li>';
				$i++;
			}
			if ($rating == -0.5) {
				$return .= '<li class="ts_vcsc_full_star"></li>';
				$i++;
			}
			while ($i <= 5) {
				$return .= '<li class="ts_vcsc_empty_star"></li>';
				$i++;
			}
			$return .= '</ul>';
			return $return;
		}
	}
	
	// Save / Load Parameters
	// ----------------------
	if (isset($_POST['License'])) {
		$ts_vcsc_extend_settings_license 							= trim ($_POST['ts_vcsc_extend_settings_license']);
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
			$ts_vcsc_extend_settings_licenseKeyed 					= get_site_option('ts_vcsc_extend_settings_licenseKeyed',		'emptydelimiterfix');
			$ts_vcsc_extend_settings_licenseInfo 					= get_site_option('ts_vcsc_extend_settings_licenseInfo',		'');
			update_site_option('ts_vcsc_extend_settings_license', 			$ts_vcsc_extend_settings_license);
			update_site_option('ts_vcsc_extend_settings_licenseUpdate', 	1);
		} else {
			$ts_vcsc_extend_settings_licenseKeyed 					= get_option('ts_vcsc_extend_settings_licenseKeyed',			'emptydelimiterfix');
			$ts_vcsc_extend_settings_licenseInfo 					= get_option('ts_vcsc_extend_settings_licenseInfo',				'');
			update_option('ts_vcsc_extend_settings_license', 				$ts_vcsc_extend_settings_license);
			update_option('ts_vcsc_extend_settings_licenseUpdate', 			1);
		}
		echo '<script> window.location="' . $_SERVER['REQUEST_URI'] . '"; </script> ';
		//Header('Location: '.$_SERVER['REQUEST_URI']);
		Exit();
	} else if (isset($_POST['Unlicense'])) {
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
			update_site_option('ts_vcsc_extend_settings_license', 			'');
			update_site_option('ts_vcsc_extend_settings_licenseKeyed', 		'unlicenseinprogress');
			update_site_option('ts_vcsc_extend_settings_licenseUpdate', 	1);
		} else {
			update_option('ts_vcsc_extend_settings_license', 				'');
			update_option('ts_vcsc_extend_settings_licenseKeyed', 			'unlicenseinprogress');
			update_option('ts_vcsc_extend_settings_licenseUpdate', 			1);
		}
		echo '<script> window.location="' . $_SERVER['REQUEST_URI'] . '"; </script> ';
		//Header('Location: '.$_SERVER['REQUEST_URI']);
		Exit();
	} else {
		TS_VCSC_ShowInformation('7190695');
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
			$ts_vcsc_extend_settings_license 						= get_site_option('ts_vcsc_extend_settings_license',			'');
			$ts_vcsc_extend_settings_licenseKeyed 					= get_site_option('ts_vcsc_extend_settings_licenseKeyed',		'emptydelimiterfix');
			$ts_vcsc_extend_settings_licenseInfo 					= get_site_option('ts_vcsc_extend_settings_licenseInfo',		'');
		} else {
			$ts_vcsc_extend_settings_license 						= get_option('ts_vcsc_extend_settings_license',					'');
			$ts_vcsc_extend_settings_licenseKeyed 					= get_option('ts_vcsc_extend_settings_licenseKeyed',			'emptydelimiterfix');
			$ts_vcsc_extend_settings_licenseInfo 					= get_option('ts_vcsc_extend_settings_licenseInfo',				'');
		}
		
		if ($ts_vcsc_extend_settings_licenseKeyed == 'unlicenseinprogress') {
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
				update_site_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix');
			} else {
				update_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix');
			}
			$ts_vcsc_extend_settings_licenseRemove 					= 'true';
		}
		
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
			if (get_site_option('ts_vcsc_extend_settings_licenseUpdate') == 1) {
				TS_VCSC_checkEnvatoAPI();
				echo "\n";
				echo "<script type='text/javascript'>" . "\n";
				echo "SettingsLicenseUpdate = true;" . "\n";
					if (get_site_option('ts_vcsc_extend_settings_licenseValid') == 1) {
						echo 'VC_Extension_Demo = false;' . "\n";
					} else {
						echo 'VC_Extension_Demo = true;' . "\n";
					}
					if (strlen(get_site_option('ts_vcsc_extend_settings_license')) != 0) {
						echo "SettingsLicenseKey = true;" . "\n";
					} else {
						echo "SettingsLicenseKey = false;" . "\n";
					}
				if ($ts_vcsc_extend_settings_licenseRemove == 'true') {
					echo "SettingsUnLicensing = true;" . "\n";
				} else {
					echo "SettingsUnLicensing = false;" . "\n";
				}
				echo "</script>" . "\n";
			} else {
				echo "\n";
				echo "<script type='text/javascript'>" . "\n";
				echo "SettingsLicenseUpdate = false;" . "\n";
					if (get_site_option('ts_vcsc_extend_settings_licenseValid') == 1) {
						echo 'VC_Extension_Demo = false;' . "\n";
					} else {
						echo 'VC_Extension_Demo = true;' . "\n";
					}
					if (strlen(get_site_option('ts_vcsc_extend_settings_license')) != 0) {
						echo "SettingsLicenseKey = true;" . "\n";
					} else {
						echo "SettingsLicenseKey = false;" . "\n";
					}
				if ($ts_vcsc_extend_settings_licenseRemove == 'true') {
					echo "SettingsUnLicensing = true;" . "\n";
				} else {
					echo "SettingsUnLicensing = false;" . "\n";
				}
				echo "</script>" . "\n";
			}
		} else {
			if (get_option('ts_vcsc_extend_settings_licenseUpdate') == 1) {
				TS_VCSC_checkEnvatoAPI();
				echo "\n";
				echo "<script type='text/javascript'>" . "\n";
				echo "SettingsLicenseUpdate = true;" . "\n";
					if (get_option('ts_vcsc_extend_settings_licenseValid') == 1) {
						echo 'VC_Extension_Demo = false;' . "\n";
					} else {
						echo 'VC_Extension_Demo = true;' . "\n";
					}
					if (strlen(get_option('ts_vcsc_extend_settings_license')) != 0) {
						echo "SettingsLicenseKey = true;" . "\n";
					} else {
						echo "SettingsLicenseKey = false;" . "\n";
					}
				if ($ts_vcsc_extend_settings_licenseRemove == 'true') {
					echo "SettingsUnLicensing = true;" . "\n";
				} else {
					echo "SettingsUnLicensing = false;" . "\n";
				}
				echo "</script>" . "\n";
			} else {
				echo "\n";
				echo "<script type='text/javascript'>" . "\n";
				echo "SettingsLicenseUpdate = false;" . "\n";
					if (get_option('ts_vcsc_extend_settings_licenseValid') == 1) {
						echo 'VC_Extension_Demo = false;' . "\n";
					} else {
						echo 'VC_Extension_Demo = true;' . "\n";
					}
					if (strlen(get_option('ts_vcsc_extend_settings_license')) != 0) {
						echo "SettingsLicenseKey = true;" . "\n";
					} else {
						echo "SettingsLicenseKey = false;" . "\n";
					}
				if ($ts_vcsc_extend_settings_licenseRemove == 'true') {
					echo "SettingsUnLicensing = true;" . "\n";
				} else {
					echo "SettingsUnLicensing = false;" . "\n";
				}
				echo "</script>" . "\n";
			}
		}
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
			update_site_option('ts_vcsc_extend_settings_licenseUpdate', 	0);
		} else {
			update_option('ts_vcsc_extend_settings_licenseUpdate', 			0);
		}
		
		$LicenseCheckStatus = "";
	}
?>

<?php
	echo '<div class="ts-vcsc-settings-group-header">';
		echo '<div class="display_header">';
			echo '<h2><span class="dashicons dashicons-admin-network"></span>Visual Composer Extensions - License Information</h2>';
		echo '</div>';
		echo '<div class="clear"></div>';
	echo '</div>';
?>
<form class="ts-vcsc-license-check-wrap" name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-info"></i>License Information</div>
		<div class="ts-vcsc-section-content">
			<a class="button-secondary" style="width: 200px; margin: 10px auto 10px auto; text-align: center;" href="<?php echo $VISUAL_COMPOSER_EXTENSIONS->settingsLink; ?>" target="_parent"><img src="<?php echo TS_VCSC_GetResourceURL('images/logos/ts_vcsc_menu_icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Back to Plugin Settings</a>
			<?php
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
					if (get_site_option('ts_vcsc_extend_settings_demo', 1) == 1) {
						echo '<div class="ts-vcsc-info-field ts-vcsc-critical" style="margin-top: 10px; font-size: 13px; text-align: justify;">Please enter your License Key in order to activate the Auto-Update and the bonus tinyMCE Font Icon Generator features of the plugin!</div>';
					}
				} else {
					if (get_option('ts_vcsc_extend_settings_demo', 1) == 1) {
						echo '<div class="ts-vcsc-info-field ts-vcsc-critical" style="margin-top: 10px; font-size: 13px; text-align: justify;">Please enter your License Key in order to activate the Auto-Update and the bonus tinyMCE Font Icon Generator features of the plugin!</div>';
					}
				}
			?>			
			<div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
				In order to use this plugin, you MUST have the Visual Composer Plugin installed; either as a normal plugin or as part of your theme. If Visual Composer is part of your theme, please ensure that it has not been modified;
				some theme developers heavily modify Visual Composer in order to allow for certain theme functions. Unfortunately, some of these modification prevent this extension pack from working correctly.
			</div>
		</div>		
	</div>
	<div class="wrapper" style="min-height: 100px; width: 100%; margin-top: 20px;">
		<table style="border: 1px solid #ededed; min-height: 100px; width: 100%;">
			<tr>
				<td style="width: 210px; padding: 0px 20px 0px 20px; border-right: 1px solid #ededed;"><?php echo get_option('ts_vcsc_extend_settings_envatoInfo'); ?></td>
				<td>
					<div>
						<h4 style="margin-top: 20px;"><span style="margin-left: 10px;">Envato Purchase License Key:</span></h4>
						<p style="margin-top: 5px; margin-left: 10px; margin-bottom: 15px;">Please enter your Envato Purchase License Key here:</p>
						<?php echo $LicenseCheckStatus; ?>
						<label style="margin-left: 10px;" class="Uniform" for="ts_vcsc_extend_settings_license">Envato License Key:</label>
						<input class="<?php
							if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
								echo ((get_site_option('ts_vcsc_extend_settings_licenseValid') == 0) ? "Required" : "");
							} else {
								echo ((get_option('ts_vcsc_extend_settings_licenseValid') == 0) ? "Required" : "");
							}
						?>" type="input" style="width: 20%; height: 30px; margin: 0 10px;" id="ts_vcsc_extend_settings_license" name="ts_vcsc_extend_settings_license" value="<?php echo $ts_vcsc_extend_settings_license; ?>" size="100">
						<?php
							if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
								if (strlen(get_site_option('ts_vcsc_extend_settings_license')) != 0) {
									echo get_site_option('ts_vcsc_extend_settings_licenseInfo');
									if (get_site_option('ts_vcsc_extend_settings_licenseValid') == 0) {
										echo '<div class="ts_vcsc_extend_messi_link clearFixMe" data-title="Retrieve your Envato License Code" data-source="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'" style="cursor: pointer; margin-left: 10px; margin-top: 10px;">';
											echo '<img style="float: left; border: 1px solid #CCCCCC; margin: 0px auto; max-width: 125px; height: auto;" src="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'">';
										echo '</div>';
										echo '<div style="margin-left: 10px; margin: 10px 0 20px 10px; width: 100%; float: left;">Click on Image to get Directions to retrieve your Envato License Key.</div>';
									}
								} else {
									echo '<span id="Envato_Key_Missing" style="color: red;">Please enter your Purchase/License Key!</span>';
									echo '<div class="ts_vcsc_extend_messi_link clearFixMe" data-title="Retrieve your Envato License Code" data-source="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'" style="cursor: pointer; margin-left: 10px; margin-top: 10px;">';
										echo '<img style="float: left; border: 1px solid #CCCCCC; margin: 0px auto; max-width: 125px; height: auto;" src="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'">';
									echo '</div>';
									echo '<div style="margin-left: 10px; margin: 10px 0 20px 10px; width: 100%; float: left;">Click on Image to get Directions to retrieve your Envato License Key.</div>';
								}
							} else {
								if (strlen(get_option('ts_vcsc_extend_settings_license')) != 0) {
									echo get_option('ts_vcsc_extend_settings_licenseInfo');
									if (get_option('ts_vcsc_extend_settings_licenseValid') == 0) {
										echo '<div class="ts_vcsc_extend_messi_link clearFixMe" data-title="Retrieve your Envato License Code" data-source="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'" style="cursor: pointer; margin-left: 10px; margin-top: 10px;">';
											echo '<img style="float: left; border: 1px solid #CCCCCC; margin: 0px auto; max-width: 125px; height: auto;" src="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'">';
										echo '</div>';
										echo '<div style="margin-left: 10px; margin: 10px 0 20px 10px; width: 100%; float: left;">Click on Image to get Directions to retrieve your Envato License Key.</div>';
									}
								} else {
									echo '<span id="Envato_Key_Missing" style="color: red;">Please enter your Purchase/License Key!</span>';
									echo '<div class="ts_vcsc_extend_messi_link clearFixMe" data-title="Retrieve your Envato License Code" data-source="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'" style="cursor: pointer; margin-left: 10px; margin-top: 10px;">';
										echo '<img style="float: left; border: 1px solid #CCCCCC; margin: 0px auto; max-width: 125px; height: auto;" src="' . TS_VCSC_GetResourceURL('images/envato/envato_find_license_key.png') .'">';
									echo '</div>';
									echo '<div style="margin-left: 10px; margin: 10px 0 20px 10px; width: 100%; float: left;">Click on Image to get Directions to retrieve your Envato License Key.</div>';
								}
							}
						?>
						<div style="height: 20px; display: block;"></div>
					</div>
				</td>
			</tr>
		</table>
		<?php
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
				echo '<div id="ts-settings-summary" style="display: none;" data-extended="' . get_site_option('ts_vcsc_extend_settings_extended', 0) . '" data-summary="' . get_site_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix') . '">' . get_site_option('ts_vcsc_extend_settings_licenseInfo', '') . '</div>';
			} else {
				echo '<div id="ts-settings-summary" style="display: none;" data-extended="' . get_option('ts_vcsc_extend_settings_extended', 0) . '" data-summary="' . get_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix') . '">' . get_option('ts_vcsc_extend_settings_licenseInfo', '') . '</div>';
			}
		?>
	</div>

	<span class="submit">
		<input title="Click here to check your Envato License." style="width: 200px; margin-top: 20px;" class="button-primary ButtonSubmit TS_Tooltip" type="submit" name="License" value="Check License" />
		<?php		
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
				if (get_site_option('ts_vcsc_extend_settings_demo', 1) == 0) {
					echo '<input title="Click here to unlicense this installation of Visual Composer Extensions." style="width: 200px; margin-top: 20px; float: right;" class="button-secondary ButtonUnLicense TS_Tooltip" type="submit" name="Unlicense" value="Unlicense Plugin" />';
				}
			} else {
				if (get_option('ts_vcsc_extend_settings_demo', 1) == 0) {
					echo '<input title="Click here to unlicense this installation of Visual Composer Extensions." style="width: 200px; margin-top: 20px; float: right;" class="button-secondary ButtonUnLicense TS_Tooltip" type="submit" name="Unlicense" value="Unlicense Plugin" />';
				}
			}
		?>
	</span>
</form>

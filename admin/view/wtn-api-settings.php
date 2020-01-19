<?php
$wtnShowMessage = false;

if(isset($_POST['updateSettings'])){
    $wtnSettingsInfo = array(
                                'wtn_api_key' => (!empty($_POST['wtn_api_key']) && (sanitize_text_field($_POST['wtn_api_key'])!='')) ? sanitize_text_field($_POST['wtn_api_key']) : '',
                            );
     $wtnShowMessage = update_option('wtn_api_settings', serialize($wtnSettingsInfo));
     $wtn_settings = stripslashes_deep(unserialize(get_option('wtn_settings')));
     $this->wtn_set_api_data_to_cache($wtn_settings['wtn_select_source'], sanitize_text_field($_POST['wtn_api_key']));
}
$wtn_api_settings = stripslashes_deep(unserialize(get_option('wtn_api_settings')));
?>
<div id="wph-wrap-all" class="wrap">
     <div class="settings-banner">
          <h2><?php esc_html_e('WP Top News API Settings', WTN_TXT_DMN); ?></h2>
     </div>
     <?php if($wtnShowMessage): $this->wtn_display_notification('success', 'Your information updated successfully.'); endif; ?>

     <form name="wpre-table" role="form" class="form-horizontal" method="post" action="" id="wtn-settings-form">
          <table class="form-table">
          <tr class="wtn_api_key">
               <th scope="row">
                    <label for="wtn_api_key"><?php esc_html_e('Enter API Key:', WTN_TXT_DMN); ?></label>
               </th>
               <td>
                    <input type="text" name="wtn_api_key" placeholder="API Key" class="regular-text" value="<?php esc_attr_e($wtn_api_settings['wtn_api_key']); ?>">
                    <br>
                    <code><i><?php esc_html_e("Default limited API Key: 'e6649e8cbfb74fc58a07d94a341bdba7'", WTN_TXT_DMN); ?></i></code>
               </td>
          </tr>
          </table>
          <p class="submit"><button id="updateSettings" name="updateSettings" class="button button-primary"><?php esc_attr_e('Update Settings', WTN_TXT_DMN); ?></button></p>
     </form>
</div>
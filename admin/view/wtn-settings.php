<?php
$wtnShowMessage = false;
$wtn_setting = array( 'swtn_select_source' => 'cnn');

if( isset( $_POST['updateSettings'] ) ) {
     
     $wtnSettingsInfo = array(
          'wtn_select_source'           => !empty($_POST['wtn_select_source']) ? filter_var($_POST['wtn_select_source'], FILTER_SANITIZE_STRING) : 'cnn',
          'wtn_news_number'             => ( isset( $_POST['wtn_news_number'] ) && filter_var( $_POST['wtn_news_number'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wtn_news_number'] : 10,
          'wtn_layout'                  => ( filter_var( $_POST['wtn_layout'], FILTER_SANITIZE_STRING ) ) ? $_POST['wtn_layout'] : '',
          'wtn_title_length'            => ( isset( $_POST['wtn_title_length'] ) && filter_var( $_POST['wtn_title_length'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wtn_title_length'] : 4,
          'wtn_desc_length'             => ( isset( $_POST['wtn_desc_length'] ) && filter_var( $_POST['wtn_desc_length'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wtn_desc_length'] : 18,
          'wtn_display_news_source'     => ( isset( $_POST['wtn_display_news_source'] ) && filter_var( $_POST['wtn_display_news_source'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wtn_display_news_source'] : '',
          'wtn_display_date'            => ( isset( $_POST['wtn_display_date'] ) && filter_var( $_POST['wtn_display_date'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wtn_display_date'] : '',
     );

     $wtnShowMessage = update_option( 'wtn_settings', serialize( $wtnSettingsInfo ) );
     $wtn_api_settings = stripslashes_deep( unserialize( get_option('wtn_api_settings') ) );
     $this->wtn_set_api_data_to_cache( $_POST['wtn_select_source'], $wtn_api_settings['wtn_api_key'] );
}

$wtn_settings            = stripslashes_deep( unserialize( get_option('wtn_settings') ) );
$wtn_news_number         = isset( $wtn_settings['wtn_news_number'] ) ? $wtn_settings['wtn_news_number'] : 10;
$wtn_title_length        = isset( $wtn_settings['wtn_title_length'] ) ? $wtn_settings['wtn_title_length'] : 4;
$wtn_desc_length         = isset( $wtn_settings['wtn_desc_length'] ) ? $wtn_settings['wtn_desc_length'] : 18;
$wtn_display_news_source = isset( $wtn_settings['wtn_display_news_source'] ) ? $wtn_settings['wtn_display_news_source'] : '';
$wtn_display_date        = isset( $wtn_settings['wtn_display_date'] ) ? $wtn_settings['wtn_display_date'] : '';
?>
<div id="wph-wrap-all" class="wrap">
     <div class="settings-banner">
          <h2><?php esc_html_e('WP Top News Settings', WTN_TXT_DMN); ?></h2>
     </div>
     <?php if($wtnShowMessage): $this->wtn_display_notification('success', 'Your information updated successfully.'); endif; ?>

     <form name="wpre-table" role="form" class="form-horizontal" method="post" action="" id="wtn-settings-form">
          <table class="form-table">
          <tr class="wtn_select_source">
               <th scope="row">
                    <label for="wtn_select_source"><?php esc_html_e('News Source:', WTN_TXT_DMN); ?></label>
               </th>
               <td>
                    <div class="wtn-template-selector">
                        <?php 
                        $wtnNewsSourceArray = $this->wtnGetNewsSources();
                        $i=1;
                        foreach($wtnNewsSourceArray as $source => $name): ?>
                            <div class="wtn-template-item">
                                <input type="radio" name="wtn_select_source" id="wtn_select_source_<?php echo $i; ?>" value="<?php printf('%s', esc_attr($source)); ?>" <?php if($wtn_settings['wtn_select_source'] == $source) { echo 'checked'; } ?>>
                                <label for="<?php printf('%s', esc_attr($name)); ?>" class="wtn-template">
                                   <?php printf('%s', esc_attr($name)); ?>
                                </label>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
               </td>
          </tr>
          <tr class="wtn_news_number">
               <th scope="row">
                    <label for="wtn_news_number"><?php esc_html_e('Number of News:', WTN_TXT_DMN); ?></label>
               </th>
               <td>
                    <input type="number" name="wtn_news_number" class="medium-text" min="1" max="10" value="<?php echo esc_attr( $wtn_news_number ); ?>">
                    <code>Max 10 news for free API</code>
               </td>
          </tr>
          <tr class="wtn_layout">
               <th scope="row">
                         <label for="wtn_layout"><?php esc_html_e('Layout:', WTN_TXT_DMN); ?></label>
               </th>
               <td>
                    <input type="radio" name="wtn_layout" value="list" <?php if($wtn_settings['wtn_layout'] == "list") { echo 'checked'; } ?>>
                    <label for="wtn_layout"><span></span><?php esc_html_e('List', WTN_TXT_DMN); ?></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="wtn_layout" value="grid" <?php if($wtn_settings['wtn_layout'] == "grid") { echo 'checked'; } ?>>
                    <label for="wtn_layout"><span></span><?php esc_html_e('Grid', WTN_TXT_DMN); ?></label>
               </td>
          </tr>
          <tr class="wtn_title_length">
               <th scope="row">
               <label for="wtn_title_length"><?php esc_html_e('Title Word Length:', WTN_TXT_DMN); ?></label>
               </th>
               <td>
               <input type="number" name="wtn_title_length" class="medium-text" min="1" max="50"
                    value="<?php echo esc_attr( $wtn_title_length ); ?>">
               </td>
          </tr>
          <tr class="wtn_desc_length">
               <th scope="row">
               <label for="wtn_desc_length"><?php esc_html_e('Description Word Length:', WTN_TXT_DMN); ?></label>
               </th>
               <td>
               <input type="number" name="wtn_desc_length" class="medium-text" min="1" max="100"
                    value="<?php echo esc_attr( $wtn_desc_length ); ?>">
               </td>
          </tr>
          <tr class="wtn_display_news_source">
               <th scope="row">
                    <label for="wtn_display_news_source"><?php esc_html_e('Display Source?', WTN_TXT_DMN); ?></label>
               </th>
               <td>
                    <input type="checkbox" name="wtn_display_news_source" class="wtn_display_news_source" value="1" <?php echo ( '1' === $wtn_display_news_source ) ? 'checked' : ''; ?> >
               </td>
          </tr>
          <tr class="wtn_display_date">
               <th scope="row">
                    <label for="wtn_display_date"><?php esc_html_e('Display Date?', WTN_TXT_DMN); ?></label>
               </th>
               <td>
                    <input type="checkbox" name="wtn_display_date" class="wtn_display_date" value="1" <?php echo ( '1' === $wtn_display_date ) ? 'checked' : ''; ?> >
               </td>
          </tr>
          <tr class="wtn_shortcode">
               <th scope="row">
                    <label for="wtn_shortcode"><?php esc_html_e('Shortcode:', WTN_TXT_DMN); ?></label>
               </th>
               <td>
                    <input type="text" name="wtn_shortcode" id="wtn_shortcode" class="regular-text" value="[wp_top_news]" readonly />
               </td>
          </tr>
          </table>
          <p class="submit"><button id="updateSettings" name="updateSettings" class="button button-primary"><?php esc_attr_e('Update Settings', WTN_TXT_DMN); ?></button></p>
     </form>
</div>
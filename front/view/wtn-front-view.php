<?php
$wtn_settings = stripslashes_deep(unserialize(get_option('wtn_settings')));
$wtn_api_settings = stripslashes_deep(unserialize(get_option('wtn_api_settings')));

$newsSource = (!empty($wtn_settings[ 'wtn_select_source' ])) ? $wtn_settings[ 'wtn_select_source' ] : 'cnn';
$apiKey = (!empty($wtn_api_settings[ 'wtn_api_key' ])) ? $wtn_api_settings[ 'wtn_api_key' ] : '';
$wtn_news_init_stdclass = !empty($this->wtn_get_api_data( $newsSource, $apiKey )) ? $this->wtn_get_api_data( $newsSource, $apiKey ) : array();
?>
<div class="wtn-main-container">
    <?php 
    for( $i = 0; $i < count($wtn_news_init_stdclass); $i++ ):
    $wtn_news = (array)$wtn_news_init_stdclass[$i];
    if(!empty($wtn_news)):
    ?>
    <div class="wtn-feed-container">
        <div class="wtn-thumbnail-container">
            <img src="<?php printf('%s', esc_attr($wtn_news['urlToImage'])); ?>" />
        </div>
        <div class="wtn-feeds">
            <a href="<?php printf('%s', esc_url($wtn_news['url'])); ?>" target="_blank" class="wtn-feeds-title">
                <?php esc_html_e($wtn_news['title']); ?>
            </a>
            <p class="wtn-feeds-description">
                <?php esc_html_e($wtn_news['description']); ?>
            </p>
            <span><?php printf('%s', 'Source:'); ?> <?php $wtn_source = (array)$wtn_news['source']; printf('%s', $wtn_source['name']); ?> | <?php printf('%s', 'Date:'); ?> <?php echo date('d M, Y',strtotime($wtn_news['publishedAt'])); ?></span>
        </div>
        <div style="clear:both"></div>
    </div>
    <?php endif; endfor; ?>
    <a href="<?php printf('%s', 'https://newsapi.org/'); ?>" target="_blank" class="wtn-powered-by">Powered by NewsAPI.org</a>
</div>
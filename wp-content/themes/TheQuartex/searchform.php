<form class="searchBar" role="search" method="get" class="col-xs-12 col-md-6" style="" action="<?php echo home_url('/'); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label') ?></span>
        <input type="search" class="search-field col-xs-7 col-md-7" placeholder="<?php echo esc_attr_x('Search …', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
    </label>
    <button class="search-submit">
      <i class="fas fa-search"></i><?php echo esc_attr_x(' Search', 'submit button') ?>
    </button>
    <!--<input type="submit" class="search-submit col-xs-4 col-md-3" value="" />-->
</form>

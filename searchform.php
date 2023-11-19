<?php

/**
 * Custom Search Form.
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="input-group">
        <a href="<?php echo esc_url(home_url('/')); ?>"> <i class="fa-solid fa-magnifying-glass "></i></a>
        <input type="search" class="form-control" placeholder="SEARCH" value="<?php echo get_search_query(); ?>"  />
    </div>
    <button type="submit" class="btn-close" aria-label="Close"></button>
</form>
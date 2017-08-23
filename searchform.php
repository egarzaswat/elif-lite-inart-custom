<?php

/**
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
 
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form">
		<span class="screen-reader-text"><?php esc_attr_e( 'Search for', 'elif-lite' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search &#8230;', 'elif-lite' ); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'elif-lite' ); ?>">
		<button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>	
	 </div>
</form>
<?php get_header(); ?>
<div class="wrap wide">
	<div class="parts-head" style="margin-top:50px">
		<h2>Search: &ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo;</h2>
		<span class="mono"><?php echo esc_html( (int) $wp_query->found_posts ); ?> results</span>
	</div>
	<?php if ( have_posts() ) : ?>
		<div class="part-grid"><?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/part-card' ); endwhile; ?></div>
	<?php else : ?>
		<div class="content"><p>No parts matched. Call <a href="<?php echo esc_url( gta_tel() ); ?>"><?php echo esc_html( gta_opt( 'phone' ) ); ?></a> or <a href="<?php echo esc_url( home_url( '/quote/' ) ); ?>">request a quote</a> and we'll source it.</p></div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>

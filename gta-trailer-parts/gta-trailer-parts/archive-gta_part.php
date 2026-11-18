<?php get_header(); ?>
<div class="wrap wide">
	<div class="parts-head" style="margin-top:50px"><h2>All Parts</h2><span class="mono"><?php echo esc_html( (int) $wp_query->found_posts ); ?> Items Listed</span></div>
	<div class="part-grid"><?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/part-card' ); endwhile; ?></div>
	<?php the_posts_pagination(); ?>
</div>
<?php get_footer(); ?>

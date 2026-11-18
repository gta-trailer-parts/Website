<?php
get_header();
$t   = get_queried_object();
$n   = gta_two( get_term_meta( $t->term_id, 'gta_order', true ) );
$tag = get_term_meta( $t->term_id, 'gta_tagline', true );
?>
<div class="wrap wide">
	<div class="sec-hero">
		<div class="txt">
			<span class="pill">Section <em><?php echo esc_html( $n ); ?></em> &middot; <?php echo esc_html( $tag ? $tag : $t->name ); ?></span>
			<h1><?php echo esc_html( $t->name ); ?></h1>
			<p><?php echo esc_html( $t->description ); ?></p>
			<div class="facts">
				<span class="box"><?php echo esc_html( (int) $wp_query->found_posts ); ?> products in this section</span>
				<span class="ok"><?php echo gta_icon( 'check' ); ?> Brampton Warehouse Verified Stock</span>
			</div>
		</div>
		<div class="img"><?php echo gta_system_image( $t->term_id, 'large' ); ?></div>
	</div>

	<div class="parts-head">
		<h2>Parts in Section <?php echo esc_html( $n ); ?></h2>
		<span class="mono"><?php echo esc_html( (int) $wp_query->found_posts ); ?> Items Listed</span>
	</div>

	<?php if ( have_posts() ) : ?>
		<div class="part-grid">
			<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/part-card' ); endwhile; ?>
		</div>
	<?php else : ?>
		<p>No parts listed in this section yet.</p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>

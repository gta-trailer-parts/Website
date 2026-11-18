<?php get_header(); while ( have_posts() ) : the_post();
$id = get_the_ID();
$no = get_post_meta( $id, '_gta_part_no', true );
$feats = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( $id, '_gta_features', true ) ) ) );
$tags = array_filter( array_map( 'trim', explode( ',', (string) get_post_meta( $id, '_gta_tags', true ) ) ) );
$terms = get_the_terms( $id, 'gta_system' );
?>
<div class="wrap wide">
	<p class="crumbs"><a href="<?php echo esc_url( home_url( '/#catalog' ) ); ?>">Catalog</a>
	<?php if ( $terms && ! is_wp_error( $terms ) ) : ?> / <a href="<?php echo esc_url( get_term_link( $terms[0] ) ); ?>"><?php echo esc_html( $terms[0]->name ); ?></a><?php endif; ?></p>
	<div class="single-part">
		<figure class="pimg"><?php echo gta_part_image( $id, 'large' ); ?></figure>
		<div>
			<?php if ( $no ) : ?><span class="pill">Part <em>#<?php echo esc_html( $no ); ?></em></span><?php endif; ?>
			<h1 style="margin:14px 0"><?php the_title(); ?></h1>
			<?php if ( $tags ) : ?><div class="tags"><?php foreach ( $tags as $t ) { echo '<span>' . esc_html( $t ) . '</span>'; } ?></div><?php endif; ?>
			<div style="margin:18px 0;color:var(--grey)"><?php the_content(); ?></div>
			<?php if ( $feats ) : ?><ul class="feat"><?php foreach ( $feats as $f ) { echo '<li>' . gta_icon( 'check' ) . '<span>' . esc_html( $f ) . '</span></li>'; } ?></ul><?php endif; ?>
			<p style="margin-top:24px"><a class="btn lg" href="<?php echo esc_url( add_query_arg( 'part', rawurlencode( ( $no ? '#' . $no . ' ' : '' ) . get_the_title() ), home_url( '/quote/' ) ) ); ?>">Request Quote</a></p>
		</div>
	</div>
</div>
<?php endwhile; get_footer(); ?>

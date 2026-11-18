<?php
$id    = get_the_ID();
$no    = get_post_meta( $id, '_gta_part_no', true );
$spec  = get_post_meta( $id, '_gta_spec', true );
$tags  = array_filter( array_map( 'trim', explode( ',', (string) get_post_meta( $id, '_gta_tags', true ) ) ) );
$feats = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( $id, '_gta_features', true ) ) ) );
$cvsa  = get_post_meta( $id, '_gta_cvsa', true ) !== '0';
?>
<article class="pcard">
	<div class="ph">
		<?php if ( $no ) : ?><span class="no mono">Part #<?php echo esc_html( $no ); ?></span><?php endif; ?>
		<h3 class="display"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php if ( $cvsa ) : ?><span class="cvsa"><?php echo gta_icon( 'info' ); ?> CVSA</span><?php endif; ?>
	</div>
	<figure class="pimg">
		<?php echo gta_part_image( $id ); ?>
		<?php if ( $spec ) : ?><figcaption class="spec"><?php echo esc_html( $spec ); ?></figcaption><?php endif; ?>
	</figure>
	<div class="pbody">
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
		<?php if ( $tags ) : ?><div class="tags"><?php foreach ( $tags as $t ) { echo '<span>' . esc_html( $t ) . '</span>'; } ?></div><?php endif; ?>
		<?php if ( $feats ) : ?><ul class="feat"><?php foreach ( array_slice( $feats, 0, 3 ) as $f ) { echo '<li>' . gta_icon( 'check' ) . '<span>' . esc_html( $f ) . '</span></li>'; } ?></ul><?php endif; ?>
		<div class="pfoot"><a class="btn" href="<?php echo esc_url( add_query_arg( 'part', rawurlencode( ( $no ? '#' . $no . ' ' : '' ) . get_the_title() ), home_url( '/quote/' ) ) ); ?>"><?php echo gta_icon( 'bag' ); ?> Request Quote</a></div>
	</div>
</article>

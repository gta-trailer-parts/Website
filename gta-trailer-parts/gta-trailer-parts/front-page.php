<?php get_header(); ?>

<div class="trust">
	<div class="wrap">
		<div><?php echo gta_icon( 'truck' ); ?> <?php echo esc_html( gta_opt( 'trust_1' ) ); ?></div>
		<div><?php echo gta_icon( 'shield' ); ?> <?php echo esc_html( gta_opt( 'trust_2' ) ); ?></div>
		<div><?php echo gta_icon( 'dollar' ); ?> <?php echo esc_html( gta_opt( 'trust_3' ) ); ?></div>
		<div><?php echo gta_icon( 'return' ); ?> <?php echo esc_html( gta_opt( 'trust_4' ) ); ?></div>
	</div>
</div>

<section class="sec" id="catalog">
	<div class="wrap">
		<div class="sec-head">
			<span class="eyebrow"><?php echo esc_html( gta_opt( 'cat_eyebrow' ) ); ?></span>
			<h2><?php echo esc_html( gta_opt( 'cat_title' ) ); ?></h2>
			<p><?php echo esc_html( gta_opt( 'cat_intro' ) ); ?></p>
		</div>
		<div class="sys-grid">
			<?php foreach ( gta_systems() as $t ) : ?>
				<a class="sys-card" href="<?php echo esc_url( get_term_link( $t ) ); ?>" style="--sc:<?php echo esc_attr( gta_system_color( $t->term_id ) ); ?>">
					<div class="sys-top"><b><?php echo esc_html( gta_two( get_term_meta( $t->term_id, 'gta_order', true ) ) ); ?></b><span><?php echo esc_html( $t->name ); ?></span></div>
					<div class="sys-img"><?php echo gta_system_image( $t->term_id ); ?></div>
					<div class="sys-body">
						<p><?php echo esc_html( $t->description ); ?></p>
						<span class="view">View Parts &rarr;</span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sec why" id="why">
	<div class="wrap">
		<div class="sec-head">
			<span class="eyebrow"><?php echo esc_html( gta_opt( 'why_eyebrow' ) ); ?></span>
			<h2><?php echo esc_html( gta_opt( 'why_title' ) ); ?></h2>
			<p><?php echo esc_html( gta_opt( 'why_intro' ) ); ?></p>
		</div>
		<div class="why-grid">
			<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
				<div><b><?php echo esc_html( gta_two( $i ) ); ?></b><h4><?php echo esc_html( gta_opt( "why_{$i}_t" ) ); ?></h4><p><?php echo esc_html( gta_opt( "why_{$i}_d" ) ); ?></p></div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="sec" id="contact">
	<div class="wrap">
		<div class="contact-grid">
			<div class="sec-head">
				<span class="eyebrow">Contact</span>
				<h2><?php echo esc_html( gta_opt( 'contact_title' ) ); ?></h2>
				<p><?php echo esc_html( gta_opt( 'contact_intro' ) ); ?></p>
				<p style="margin-top:22px"><a class="btn lg" href="<?php echo esc_url( gta_tel() ); ?>"><?php echo gta_icon( 'phone' ); ?> <?php echo esc_html( gta_opt( 'phone' ) ); ?></a>
				<a class="btn lg dark" style="color:var(--ink);border-color:var(--line)" href="<?php echo esc_url( home_url( '/quote/' ) ); ?>">Request a Quote</a></p>
			</div>
			<div class="cbox">
				<div class="row"><span>Address</span><div><?php echo esc_html( gta_opt( 'address' ) ); ?></div></div>
				<div class="row"><span>Phone</span><div><a href="<?php echo esc_url( gta_tel() ); ?>"><?php echo esc_html( gta_opt( 'phone' ) ); ?></a></div></div>
				<div class="row"><span>Email</span><div><a href="mailto:<?php echo esc_attr( gta_opt( 'email' ) ); ?>"><?php echo esc_html( gta_opt( 'email' ) ); ?></a></div></div>
				<div class="row"><span>Hours</span><div><?php echo esc_html( gta_opt( 'hours' ) ); ?></div></div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

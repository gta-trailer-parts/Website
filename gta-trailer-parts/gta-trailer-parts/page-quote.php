<?php
/* Template for the page with slug "quote" */
get_header();
$part = isset( $_GET['part'] ) ? sanitize_text_field( wp_unslash( $_GET['part'] ) ) : '';
$sent = isset( $_GET['sent'] ) ? sanitize_text_field( wp_unslash( $_GET['sent'] ) ) : '';
?>
<div class="wrap">
	<div class="content">
		<h1>Request a Quote</h1>
		<?php if ( '1' === $sent ) : ?><div class="notice">Thanks — we received your request and will confirm price and delivery shortly.</div><?php elseif ( '0' === $sent ) : ?><div class="notice" style="background:#fdecec;border-color:#e6a0a0">Sorry, the message could not be sent. Please call us instead.</div><?php endif; ?>
		<form class="qform" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="gta_quote">
			<?php wp_nonce_field( 'gta_quote', 'gta_quote_nonce' ); ?>
			<div style="position:absolute;left:-9999px" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
			<div><label for="q_name">Name</label><input id="q_name" name="q_name" required></div>
			<div><label for="q_email">Email</label><input id="q_email" type="email" name="q_email" required></div>
			<div><label for="q_phone">Phone</label><input id="q_phone" name="q_phone"></div>
			<div><label for="q_part">Part / brand / quantity</label><input id="q_part" name="q_part" value="<?php echo esc_attr( $part ); ?>" required></div>
			<div><label for="q_msg">Notes (trailer make, VIN, delivery or pick-up)</label><textarea id="q_msg" name="q_msg" rows="5"></textarea></div>
			<div><button class="btn lg" type="submit">Send Request</button></div>
		</form>
	</div>
</div>
<?php get_footer(); ?>

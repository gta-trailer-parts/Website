<footer class="site-footer">
	<div class="wrap wide">
		<div>
			<b>GTA Trailer Parts &amp; Equipment</b><br>
			<?php echo esc_html( gta_opt( 'address' ) ); ?><br>
			<?php echo esc_html( gta_opt( 'hours' ) ); ?>
		</div>
		<div>
			<a href="<?php echo esc_url( gta_tel() ); ?>"><?php echo esc_html( gta_opt( 'phone' ) ); ?></a><br>
			<a href="mailto:<?php echo esc_attr( gta_opt( 'email' ) ); ?>"><?php echo esc_html( gta_opt( 'email' ) ); ?></a>
		</div>
		<div>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> GTA Trailer Parts &mdash; <?php echo esc_html( gta_opt( 'trust_1' ) ); ?> &middot; <?php echo esc_html( gta_opt( 'trust_3' ) ); ?> &middot; <?php echo esc_html( gta_opt( 'trust_4' ) ); ?></div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

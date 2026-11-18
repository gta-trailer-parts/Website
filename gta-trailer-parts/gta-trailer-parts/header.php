<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="announce">
	<?php echo gta_icon( 'bolt' ); ?> <?php echo esc_html( gta_opt( 'announce_text' ) ); ?>
	<a href="<?php echo esc_url( gta_tel() ); ?>"><?php echo esc_html( gta_opt( 'announce_btn' ) ); ?></a>
</div>
<div class="infobar mono">
	<div class="wrap wide">
		<div><span><?php echo gta_icon( 'pin' ); ?> <?php echo esc_html( gta_opt( 'address' ) ); ?></span><span><?php echo gta_icon( 'clock' ); ?> <?php echo esc_html( gta_opt( 'hours' ) ); ?></span></div>
		<div><span><?php echo gta_icon( 'phone' ); ?> <b><?php echo esc_html( gta_opt( 'phone_label' ) ); ?></b></span></div>
	</div>
</div>

<header class="site-header">
	<div class="wrap wide">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?>">
			<span class="logo">
				<?php if ( has_custom_logo() ) { echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'thumbnail' ); } else { echo '<b>GTA</b>'; } ?>
			</span>
			<span>
				<span class="name"><i>GTA</i>Trailer Parts</span>
				<small><?php echo esc_html( gta_opt( 'tagline' ) ); ?></small>
			</span>
		</a>

		<nav class="nav" id="site-nav" aria-label="Primary">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'gta_fallback_menu', 'depth' => 2 ) ); ?>
			<form class="hsearch" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" name="s" placeholder="Search part # or item..." value="<?php echo esc_attr( get_search_query() ); ?>" aria-label="Search parts">
				<input type="hidden" name="post_type" value="gta_part">
			</form>
			<a class="btn dark nav-quote" href="<?php echo esc_url( home_url( '/quote/' ) ); ?>"><?php echo gta_icon( 'bag' ); ?> Quote</a>
			<a class="btn" href="<?php echo esc_url( gta_tel() ); ?>"><?php echo gta_icon( 'phone' ); ?> <?php echo esc_html( gta_opt( 'phone' ) ); ?></a>
		</nav>
		<button class="menu-toggle" aria-controls="site-nav" aria-expanded="false">Menu</button>
	</div>
</header>

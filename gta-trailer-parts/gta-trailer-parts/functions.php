<?php
/**
 * GTA Trailer Parts theme functions.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once get_template_directory() . '/inc/seed.php';

/* ---------- Setup ---------- */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 140, 'width' => 140, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'gta' ) ) );
	add_image_size( 'gta-card', 700, 520, true );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'gta-fonts', 'https://fonts.googleapis.com/css2?family=Archivo+Black&family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap', array(), null );
	wp_enqueue_style( 'gta-style', get_stylesheet_uri(), array( 'gta-fonts' ), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script( 'gta-main', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );
} );

/* ---------- Custom post type + taxonomy ---------- */
add_action( 'init', function () {
	register_post_type( 'gta_part', array(
		'labels' => array(
			'name' => 'Parts', 'singular_name' => 'Part', 'add_new_item' => 'Add New Part',
			'edit_item' => 'Edit Part', 'all_items' => 'All Parts', 'menu_name' => 'Parts',
		),
		'public' => true, 'has_archive' => 'parts', 'menu_icon' => 'dashicons-admin-generic', 'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'rewrite' => array( 'slug' => 'part' ), 'show_in_rest' => true,
	) );
	register_taxonomy( 'gta_system', 'gta_part', array(
		'labels' => array( 'name' => 'Systems', 'singular_name' => 'System', 'menu_name' => 'Systems (Sections)', 'add_new_item' => 'Add New System' ),
		'hierarchical' => true, 'public' => true, 'show_admin_column' => true, 'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'system' ),
	) );
} );

/* ---------- Helpers ---------- */
function gta_defaults() {
	return array(
		'announce_text'  => 'Same-Day GTA Delivery Available for Orders Placed Before 2:00 PM EST',
		'announce_btn'   => 'CALL COUNTER DIRECT',
		'address'        => '140 Rutledge Rd, Brampton, ON L6V 4S2',
		'hours'          => 'Mon - Fri: 7:00 AM - 6:00 PM',
		'phone'          => '+1-647-909-7759',
		'phone_label'    => 'Counter: +1-647-909-7759',
		'email'          => 'info@gtatrailerparts.com',
		'tagline'        => "Toronto's Leading Semi-Trailer Parts Supplier",
		'trust_1' => 'Fast Delivery', 'trust_2' => 'Premium Quality', 'trust_3' => 'Competitive Pricing', 'trust_4' => 'Easy Returns',
		'cat_eyebrow'    => 'The Catalog',
		'cat_title'      => 'Eight Systems. One Supplier.',
		'cat_intro'      => 'From air brake chambers to LED marker lights — every system of the semi-trailer, stocked and ready to ship.',
		'why_eyebrow'    => 'Why GTA',
		'why_title'      => 'Parts that keep you moving.',
		'why_intro'      => 'High-quality trailer repair parts sourced through trusted international partnerships and stocked locally in Brampton.',
		'why_1_t' => 'Quality You Can Trust', 'why_1_d' => 'Parts from reliable manufacturers.',
		'why_2_t' => 'Fast Local Delivery',   'why_2_d' => 'Serving Ontario and surrounding areas.',
		'why_3_t' => 'Competitive Pricing',   'why_3_d' => 'Direct sourcing saves you money.',
		'why_4_t' => 'Easy Returns',          'why_4_d' => 'Hassle-free on eligible parts.',
		'why_5_t' => 'Personal Service',      'why_5_d' => 'One call/text to a real person who knows trailer parts.',
		'why_6_t' => 'Brand Coverage',        'why_6_d' => 'Great Dane, Wabash, Utility, Manac and more.',
		'contact_title'  => 'Tell us what you need.',
		'contact_intro'  => 'Brand, part type and quantity — we confirm price and delivery time, usually same-day.',
	);
}
function gta_opt( $key ) {
	$d = gta_defaults();
	$v = get_theme_mod( 'gta_' . $key, isset( $d[ $key ] ) ? $d[ $key ] : '' );
	return ( '' === $v && isset( $d[ $key ] ) ) ? $d[ $key ] : $v;
}
function gta_tel() { return 'tel:' . preg_replace( '/[^0-9+]/', '', gta_opt( 'phone' ) ); }

function gta_icon( $name ) {
	$p = array(
		'pin'    => '<path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>',
		'clock'  => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
		'phone'  => '<path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.3a2 2 0 012.1-.4c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/>',
		'truck'  => '<path d="M1 3h15v13H1zM16 8h4l3 3v5h-7z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
		'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
		'dollar' => '<path d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>',
		'return' => '<path d="M1 4v6h6"/><path d="M3.5 15a9 9 0 102.1-9.4L1 10"/>',
		'bag'    => '<path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 01-8 0"/>',
		'check'  => '<circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-6"/>',
		'info'   => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>',
		'bolt'   => '<path d="M13 2L3 14h9l-1 8 10-12h-9z"/>',
	);
	return '<svg class="ico" viewBox="0 0 24 24" aria-hidden="true">' . ( isset( $p[ $name ] ) ? $p[ $name ] : '' ) . '</svg>';
}

function gta_system_color( $term_id, $order = 1 ) {
	$c = get_term_meta( $term_id, 'gta_color', true );
	return $c ? $c : '#e4173a';
}
function gta_system_image( $term_id, $size = 'gta-card' ) {
	$id = (int) get_term_meta( $term_id, 'gta_image_id', true );
	if ( $id ) { return wp_get_attachment_image( $id, $size, false, array( 'loading' => 'lazy' ) ); }
	return '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/placeholder.svg' ) . '" alt="">';
}
function gta_part_image( $post_id, $size = 'gta-card' ) {
	if ( has_post_thumbnail( $post_id ) ) { return get_the_post_thumbnail( $post_id, $size, array( 'loading' => 'lazy' ) ); }
	$t = get_the_terms( $post_id, 'gta_system' );
	return ( $t && ! is_wp_error( $t ) ) ? gta_system_image( $t[0]->term_id, $size ) : '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/placeholder.svg' ) . '" alt="">';
}
function gta_systems() {
	$t = get_terms( array( 'taxonomy' => 'gta_system', 'hide_empty' => false, 'meta_key' => 'gta_order', 'orderby' => 'meta_value_num', 'order' => 'ASC' ) );
	return is_wp_error( $t ) ? array() : $t;
}
function gta_two( $n ) { return str_pad( (int) $n, 2, '0', STR_PAD_LEFT ); }

/* ---------- System (term) fields ---------- */
add_action( 'gta_system_add_form_fields', function () {
	?>
	<div class="form-field"><label>Section number</label><input type="number" name="gta_order" value="1" min="1"></div>
	<div class="form-field"><label>Tab colour</label><input type="text" name="gta_color" value="#e4173a"><p>Hex colour of the number tab on the home page card.</p></div>
	<div class="form-field"><label>Tagline</label><input type="text" name="gta_tagline" placeholder="Safety you can rely on"></div>
	<div class="form-field"><label>Section image</label><input type="hidden" name="gta_image_id" class="gta-img-id"><button type="button" class="button gta-pick">Choose image</button><div class="gta-prev"></div></div>
	<?php
} );
add_action( 'gta_system_edit_form_fields', function ( $term ) {
	$img = (int) get_term_meta( $term->term_id, 'gta_image_id', true );
	?>
	<tr class="form-field"><th>Section number</th><td><input type="number" name="gta_order" value="<?php echo esc_attr( get_term_meta( $term->term_id, 'gta_order', true ) ); ?>" min="1"></td></tr>
	<tr class="form-field"><th>Tab colour</th><td><input type="text" name="gta_color" value="<?php echo esc_attr( get_term_meta( $term->term_id, 'gta_color', true ) ); ?>"><p class="description">Hex colour of the number tab.</p></td></tr>
	<tr class="form-field"><th>Tagline</th><td><input type="text" name="gta_tagline" value="<?php echo esc_attr( get_term_meta( $term->term_id, 'gta_tagline', true ) ); ?>"></td></tr>
	<tr class="form-field"><th>Section image</th><td><input type="hidden" name="gta_image_id" class="gta-img-id" value="<?php echo esc_attr( $img ); ?>"><button type="button" class="button gta-pick">Choose image</button> <button type="button" class="button gta-clear">Remove</button><div class="gta-prev"><?php echo $img ? wp_get_attachment_image( $img, 'thumbnail' ) : ''; ?></div></td></tr>
	<?php
} );
add_action( 'created_gta_system', 'gta_save_term' );
add_action( 'edited_gta_system', 'gta_save_term' );
function gta_save_term( $id ) {
	if ( ! current_user_can( 'manage_categories' ) ) { return; }
	if ( isset( $_POST['gta_order'] ) )    { update_term_meta( $id, 'gta_order', absint( $_POST['gta_order'] ) ); }
	if ( isset( $_POST['gta_color'] ) )    { update_term_meta( $id, 'gta_color', sanitize_hex_color( wp_unslash( $_POST['gta_color'] ) ) ); }
	if ( isset( $_POST['gta_tagline'] ) )  { update_term_meta( $id, 'gta_tagline', sanitize_text_field( wp_unslash( $_POST['gta_tagline'] ) ) ); }
	if ( isset( $_POST['gta_image_id'] ) ) { update_term_meta( $id, 'gta_image_id', absint( $_POST['gta_image_id'] ) ); }
}
add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( in_array( $hook, array( 'edit-tags.php', 'term.php' ), true ) ) {
		wp_enqueue_media();
		wp_add_inline_script( 'jquery-core', "jQuery(function($){var f;$(document).on('click','.gta-pick',function(e){e.preventDefault();var b=$(this).closest('td,.form-field');f=wp.media({multiple:false}).on('select',function(){var a=f.state().get('selection').first().toJSON();b.find('.gta-img-id').val(a.id);b.find('.gta-prev').html('<img src=\"'+(a.sizes&&a.sizes.thumbnail?a.sizes.thumbnail.url:a.url)+'\" style=\"max-width:120px\">');}).open();});$(document).on('click','.gta-clear',function(){var b=$(this).closest('td');b.find('.gta-img-id').val('');b.find('.gta-prev').empty();});});" );
	}
} );

/* ---------- Part meta box ---------- */
add_action( 'add_meta_boxes', function () {
	add_meta_box( 'gta_part_details', 'Part Details', 'gta_part_box', 'gta_part', 'normal', 'high' );
} );
function gta_part_box( $post ) {
	wp_nonce_field( 'gta_part_save', 'gta_part_nonce' );
	$g = function ( $k ) use ( $post ) { return get_post_meta( $post->ID, $k, true ); };
	?>
	<style>.gta-f label{display:block;font-weight:600;margin:12px 0 4px}.gta-f input[type=text],.gta-f textarea,.gta-f select{width:100%}</style>
	<div class="gta-f">
		<label>Part number (shows in red pill)</label><input type="text" name="gta_part_no" value="<?php echo esc_attr( $g( '_gta_part_no' ) ); ?>" placeholder="GTA-2000 or 01">
		<label>Spec line on image (e.g. T30/30 | T24/30 | T24/24)</label><input type="text" name="gta_spec" value="<?php echo esc_attr( $g( '_gta_spec' ) ); ?>">
		<label>Badges (comma separated, e.g. IN STOCK, OEM QUALITY)</label><input type="text" name="gta_tags" value="<?php echo esc_attr( $g( '_gta_tags' ) ); ?>">
		<label>Key features (one per line)</label><textarea name="gta_features" rows="5"><?php echo esc_textarea( $g( '_gta_features' ) ); ?></textarea>
		<label><input type="checkbox" name="gta_cvsa" value="1" <?php checked( $g( '_gta_cvsa' ) !== '0' ); ?>> Show CVSA badge</label>
		<p class="description">The short description (Excerpt box) appears on the part card. Use Featured Image for the photo and "Order" (Page Attributes) to sort.</p>
	</div>
	<?php
}
add_action( 'save_post_gta_part', function ( $id ) {
	if ( ! isset( $_POST['gta_part_nonce'] ) || ! wp_verify_nonce( $_POST['gta_part_nonce'], 'gta_part_save' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $id ) ) { return; }
	update_post_meta( $id, '_gta_part_no', sanitize_text_field( wp_unslash( $_POST['gta_part_no'] ?? '' ) ) );
	update_post_meta( $id, '_gta_spec', sanitize_text_field( wp_unslash( $_POST['gta_spec'] ?? '' ) ) );
	update_post_meta( $id, '_gta_tags', sanitize_text_field( wp_unslash( $_POST['gta_tags'] ?? '' ) ) );
	update_post_meta( $id, '_gta_features', sanitize_textarea_field( wp_unslash( $_POST['gta_features'] ?? '' ) ) );
	update_post_meta( $id, '_gta_cvsa', empty( $_POST['gta_cvsa'] ) ? '0' : '1' );
} );

/* ---------- Search: include part number, parts only ---------- */
add_action( 'pre_get_posts', function ( $q ) {
	if ( ! is_admin() && $q->is_main_query() ) {
		if ( $q->is_search() ) { $q->set( 'post_type', 'gta_part' ); }
		if ( $q->is_tax( 'gta_system' ) ) { $q->set( 'posts_per_page', 60 ); $q->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) ); }
	}
} );
add_filter( 'posts_search', function ( $search, $q ) {
	global $wpdb;
	if ( is_admin() || ! $q->is_main_query() || ! $q->is_search() || ! $q->get( 's' ) ) { return $search; }
	$like = '%' . $wpdb->esc_like( $q->get( 's' ) ) . '%';
	$extra = $wpdb->prepare( " OR EXISTS (SELECT 1 FROM {$wpdb->postmeta} pm WHERE pm.post_id = {$wpdb->posts}.ID AND pm.meta_key = '_gta_part_no' AND pm.meta_value LIKE %s)", $like );
	if ( ! $search ) { return $search; }
	return ' AND ( (' . preg_replace( '/^\s*AND\s*/', '', $search ) . ')' . $extra . ' )';
}, 10, 2 );

/* ---------- Quote form handler ---------- */
add_action( 'admin_post_nopriv_gta_quote', 'gta_quote_submit' );
add_action( 'admin_post_gta_quote', 'gta_quote_submit' );
function gta_quote_submit() {
	if ( ! isset( $_POST['gta_quote_nonce'] ) || ! wp_verify_nonce( $_POST['gta_quote_nonce'], 'gta_quote' ) ) { wp_die( 'Security check failed.' ); }
	if ( ! empty( $_POST['website'] ) ) { wp_safe_redirect( home_url( '/' ) ); exit; } // honeypot
	$name  = sanitize_text_field( wp_unslash( $_POST['q_name'] ?? '' ) );
	$email = sanitize_email( wp_unslash( $_POST['q_email'] ?? '' ) );
	$phone = sanitize_text_field( wp_unslash( $_POST['q_phone'] ?? '' ) );
	$part  = sanitize_text_field( wp_unslash( $_POST['q_part'] ?? '' ) );
	$msg   = sanitize_textarea_field( wp_unslash( $_POST['q_msg'] ?? '' ) );
	$to    = gta_opt( 'email' );
	$body  = "Name: $name\nEmail: $email\nPhone: $phone\nPart / brand / qty: $part\n\n$msg";
	$ok    = wp_mail( $to, 'Quote request from ' . $name, $body, array( 'Reply-To: ' . $email ) );
	$back  = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	wp_safe_redirect( add_query_arg( 'sent', $ok ? '1' : '0', remove_query_arg( 'sent', $back ) ) );
	exit;
}

/* ---------- Customizer ---------- */
add_action( 'customize_register', function ( $wp ) {
	$sections = array(
		'gta_top'     => array( 'Top Bar & Contact', array( 'announce_text', 'announce_btn', 'address', 'hours', 'phone', 'phone_label', 'email', 'tagline' ) ),
		'gta_trust'   => array( 'Trust Strip', array( 'trust_1', 'trust_2', 'trust_3', 'trust_4' ) ),
		'gta_home'    => array( 'Home Page Text', array( 'cat_eyebrow', 'cat_title', 'cat_intro', 'why_eyebrow', 'why_title', 'why_intro', 'contact_title', 'contact_intro' ) ),
		'gta_why'     => array( 'Why GTA Items', array( 'why_1_t', 'why_1_d', 'why_2_t', 'why_2_d', 'why_3_t', 'why_3_d', 'why_4_t', 'why_4_d', 'why_5_t', 'why_5_d', 'why_6_t', 'why_6_d' ) ),
	);
	$d = gta_defaults();
	$pri = 30;
	foreach ( $sections as $sid => $s ) {
		$wp->add_section( $sid, array( 'title' => 'GTA: ' . $s[0], 'priority' => $pri++ ) );
		foreach ( $s[1] as $k ) {
			$wp->add_setting( 'gta_' . $k, array( 'default' => $d[ $k ], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
			$wp->add_control( 'gta_' . $k, array( 'label' => ucwords( str_replace( '_', ' ', $k ) ), 'section' => $sid, 'type' => ( strpos( $k, 'intro' ) !== false || strpos( $k, '_d' ) !== false ) ? 'textarea' : 'text' ) );
		}
	}
} );

/* ---------- Footer fallback menu ---------- */
function gta_fallback_menu() {
	echo '<ul><li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li><li><a href="' . esc_url( home_url( '/#catalog' ) ) . '">Catalog</a></li><li><a href="' . esc_url( home_url( '/#why' ) ) . '">Why GTA</a></li><li><a href="' . esc_url( home_url( '/#contact' ) ) . '">Contact</a></li></ul>';
}

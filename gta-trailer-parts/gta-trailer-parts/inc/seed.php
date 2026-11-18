<?php
/**
 * One-time starter content, created when the theme is activated.
 * Safe to run once: guarded by the option gta_seeded_v1.
 * To re-run: delete that option (or use Tools > Re-run GTA setup if you add one).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'after_switch_theme', 'gta_seed' );


function gta_import_image( $file, $title ) {
	$path = get_template_directory() . '/assets/img/starter/' . $file;
	if ( ! file_exists( $path ) ) { return 0; }
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$up = wp_upload_bits( 'gta-' . $file, null, file_get_contents( $path ) );
	if ( ! empty( $up['error'] ) ) { return 0; }
	$att = wp_insert_attachment( array( 'post_mime_type' => wp_check_filetype( $up['file'] )['type'], 'post_title' => $title, 'post_status' => 'inherit' ), $up['file'] );
	if ( ! $att || is_wp_error( $att ) ) { return 0; }
	wp_update_attachment_metadata( $att, wp_generate_attachment_metadata( $att, $up['file'] ) );
	return $att;
}

function gta_seed() {
	if ( get_option( 'gta_seeded_v1' ) ) { flush_rewrite_rules(); return; }

	$systems = array(
		1 => array( 'Brake System', '#e4173a', 'Safety you can rely on',
			'High-performance brake components built for maximum stopping power, durability and reliability. Designed to meet or exceed industry standards for safe and dependable operation on every mile.' ),
		2 => array( 'Air System', '#1e4b8f', 'Pressure where it counts',
			'Premium, high-performance air system components for semi-trailers. Valves, tanks, gladhands, hose and fittings that keep the whole air circuit sealed and responsive.' ),
		3 => array( 'Suspension System', '#2e6b3a', 'Smooth ride, less wear',
			'Suspension components designed to deliver a smoother ride, improve stability and extend the life of your trailer. Air springs, shocks, leaf springs and slider parts.' ),
		4 => array( 'Hydraulic System', '#c8963e', 'Power under pressure',
			'Hydraulic components built for strength, precision and long-lasting performance in the toughest conditions. Cylinders, pumps, hose and fittings.' ),
		5 => array( 'Body Parts', '#8b5e3c', 'Structural integrity',
			'High-quality body components designed for strength, durability and long-lasting performance. Keep your trailer structurally sound with rails, posts, doors, hinges and roof parts.' ),
		6 => array( 'Hardware & Fasteners', '#e4173a', 'Built to hold',
			'Comprehensive range of industrial-grade hardware and heavy-duty fasteners, engineered to withstand vibration, corrosion and heavy loads.' ),
		7 => array( 'Electrical & Lighting System', '#2e6b3a', 'Visibility & compliance',
			'High-performance electrical systems and lighting solutions engineered for semi-trailers. Built to withstand harsh weather, vibration and long hours on the road.' ),
		8 => array( 'Trailer Accessories', '#c8963e', 'Finish the job',
			'Essential trailer maintenance and safety accessories. Find high-quality silicone sealants from Sika, heavy-duty reflective tape, decals and more.' ),
	);

	$ids = array();
	foreach ( $systems as $n => $s ) {
		$r = wp_insert_term( $s[0], 'gta_system', array( 'description' => $s[3] ) );
		if ( is_wp_error( $r ) ) { $t = get_term_by( 'name', $s[0], 'gta_system' ); $tid = $t ? $t->term_id : 0; } else { $tid = $r['term_id']; }
		if ( ! $tid ) { continue; }
		update_term_meta( $tid, 'gta_order', $n );
		update_term_meta( $tid, 'gta_color', $s[1] );
		update_term_meta( $tid, 'gta_tagline', $s[2] );
		$img = gta_import_image( 'system-' . $n . '.jpg', $s[0] );
		if ( $img ) { update_term_meta( $tid, 'gta_image_id', $img ); }
		$ids[ $n ] = $tid;
	}

	// Sample parts (replace / edit freely). Brake examples come from the live site; others from the supplier catalog.
	$parts = array(
		1 => array(
			array( 'Spring Brake Chamber', '01', 'T30/30 | T24/30 | T24/24', 'MAXIMUM SAFETY, BUILT TO LAST, OEM QUALITY', 'High-performance spring brake chambers built for durability and consistent braking force. Designed for service and parking brake applications, ensuring maximum safety and reliability.', "High-strength steel housing for long service life\nPowerful spring force for secure parking\nCorrosion-resistant finish for harsh weather" ),
			array( 'Heavy Duty Brake Drum', '02', '16.5" x 7" Outboard Mount', 'EXCELLENT HEAT DISSIPATION, PREMIUM QUALITY, EXTENDED SERVICE LIFE', 'Precision-engineered brake drums designed for heavy-duty applications. Built with high-quality cast iron for superior heat dissipation, strength and wear resistance.', "Premium grade cast iron for maximum durability\nPrecision machining for proper fit and balance\nSuperior heat dissipation for extended life" ),
			array( 'Automatic Slack Adjuster', '03', '10 & 28 spline | 5" / 5½" / 6"', 'IN STOCK, OEM QUALITY', 'Automatic slack adjusters that keep brake stroke in spec and cut down on manual adjustment.', "Available in 10 and 28 spline\nMultiple arm lengths\nDirect fit replacement" ),
		),
		2 => array(
			array( 'Relay Valve', '04', 'Sealco | Haldex | Bendix', 'IN STOCK, OEM QUALITY', 'Relay valves for fast, consistent air delivery to the brake chambers.', "Cross-referenced to major brands\nTested before shipping\nDirect fit replacement" ),
			array( 'Gladhands & Coiled Airline', '05', 'Service | Emergency | Universal', 'IN STOCK', 'Bracket-mount and conventional gladhands, seals, and 12-15 ft coiled airline.', "Aluminum bodies\nRed / blue colour coded\nSeals and filters available" ),
		),
		3 => array(
			array( 'Air Spring (Rolling Lobe)', '06', 'Firestone / Goodyear cross-reference', 'IN STOCK, OEM QUALITY', 'Air springs for Neway, Hendrickson, Reyco and Hutch suspensions, cross-referenced to industry numbers.', "Crossover chart available\nSealed, pressure-tested\nFits major air-ride systems" ),
			array( 'Shock Absorber', '07', 'Monroe / Gabriel crossover', 'IN STOCK', 'Heavy-duty shock absorbers for trailer air-ride suspensions.', "OEM fitment\nMonroe to Gabriel crossover\nBushings available" ),
		),
		4 => array(
			array( 'Hydraulic Cylinder & Pump Set', '08', 'Call with VIN to confirm fit', 'SPECIAL ORDER', 'Hydraulic components for dump, lift-axle and landing-gear applications. Quoted per application.', "Pressure-rated components\nHose and fittings available\nCall to confirm fit" ),
		),
		5 => array(
			array( 'Roof Bow', '09', 'Steel & aluminum | all major brands', 'IN STOCK', 'Roof bows for Great Dane, Wabash, Utility, Strick, Trailmobile and more.', "Cambered and anti-snag styles\nGalvanized or aluminum\nCross-referenced by brand" ),
			array( 'Door Hinge & Lockrod Parts', '10', '3-hole, 4-hole & 5-hole', 'IN STOCK', 'Hinges, hinge pins and lockrod components for swing doors.', "Aluminum and steel hinges\nMiner lockrod components\nHinge pins and bushings" ),
		),
		6 => array(
			array( 'Rivets & Floor Screws', '11', 'Aluminum rivets | Torx screws', 'IN STOCK', 'Brazier and universal head rivets, plus 1/4" and 5/16" Torx flathead floor screws.', "Hard (2117-T3) or soft (H1100) alloy\nBulk and boxed quantities\nAll common lengths" ),
		),
		7 => array(
			array( 'LED Marker & Clearance Lights', '12', '12V LED | DOT approved', 'IN STOCK, DOT COMPLIANT', 'LED stop, turn, tail, marker and clearance lamps with replacement lenses.', "Truck-Lite production standard\nWeather-sealed\nLong service life" ),
			array( '7-Way Receptacle & Pigtails', '13', 'Split pins | 20 & 30 amp breakers', 'IN STOCK', '7-way receptacles, plugs, junction boxes and bulk cable.', "Sealed connectors\nCoiled cords available\nBulk cable by the foot" ),
		),
		8 => array(
			array( 'Conspicuity Tape & Decals', '14', 'DOT red/white | 2" x 150\'', 'IN STOCK, DOT COMPLIANT', 'DOT red/white conspicuity tape and reflective decals.', "7-year and 3-year grades\nVan kits available\nDecal reflectors in amber and red" ),
			array( 'Sealants & Shop Supplies', '15', 'Sika | Manus-Bond', 'IN STOCK', 'Silicone and polyurethane sealants, adhesives, tapes and shop supplies.', "Manus-Bond and Sikaflex\nFoam and roof tape\nPaint and cleaners" ),
		),
	);

	foreach ( $parts as $n => $list ) {
		if ( empty( $ids[ $n ] ) ) { continue; }
		foreach ( $list as $i => $p ) {
			$pid = wp_insert_post( array(
				'post_type' => 'gta_part', 'post_status' => 'publish', 'post_title' => $p[0],
				'post_excerpt' => $p[4], 'post_content' => $p[4], 'menu_order' => $i,
			) );
			if ( ! $pid || is_wp_error( $pid ) ) { continue; }
			wp_set_object_terms( $pid, array( (int) $ids[ $n ] ), 'gta_system' );
			update_post_meta( $pid, '_gta_part_no', $p[1] );
			update_post_meta( $pid, '_gta_spec', $p[2] );
			update_post_meta( $pid, '_gta_tags', $p[3] );
			update_post_meta( $pid, '_gta_features', $p[5] );
			update_post_meta( $pid, '_gta_cvsa', '1' );
		}
	}

	// Pages: Home (static front page) and Quote.
	$home = wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => 'Home', 'post_name' => 'home' ) );
	$quote = wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => 'Request a Quote', 'post_name' => 'quote' ) );
	if ( $home && ! is_wp_error( $home ) ) { update_option( 'show_on_front', 'page' ); update_option( 'page_on_front', $home ); }

	update_option( 'permalink_structure', '/%postname%/' );

	// Menu.
	$name = 'GTA Primary';
	$menu = wp_get_nav_menu_object( $name );
	$mid  = $menu ? $menu->term_id : wp_create_nav_menu( $name );
	if ( $mid && ! is_wp_error( $mid ) ) {
		$link = function ( $title, $url, $parent = 0 ) use ( $mid ) {
			return wp_update_nav_menu_item( $mid, 0, array( 'menu-item-title' => $title, 'menu-item-url' => $url, 'menu-item-type' => 'custom', 'menu-item-status' => 'publish', 'menu-item-parent-id' => $parent ) );
		};
		$link( 'Home', home_url( '/' ) );
		$cat = $link( 'Catalog', home_url( '/#catalog' ) );
		foreach ( $ids as $n => $tid ) {
			wp_update_nav_menu_item( $mid, 0, array( 'menu-item-type' => 'taxonomy', 'menu-item-object' => 'gta_system', 'menu-item-object-id' => $tid, 'menu-item-status' => 'publish', 'menu-item-parent-id' => $cat ) );
		}
		$link( 'Why GTA', home_url( '/#why' ) );
		$link( 'Contact', home_url( '/#contact' ) );
		$loc = get_theme_mod( 'nav_menu_locations', array() );
		$loc['primary'] = $mid;
		set_theme_mod( 'nav_menu_locations', $loc );
	}

	$logo = gta_import_image( 'logo.png', 'GTA Trailer Parts logo' );
	if ( $logo ) { set_theme_mod( 'custom_logo', $logo ); }

	update_option( 'blogname', 'GTA Trailer Parts & Equipment' );
	update_option( 'blogdescription', "Toronto's Leading Semi-Trailer Parts Supplier" );
	update_option( 'gta_seeded_v1', 1 );
	flush_rewrite_rules();
}

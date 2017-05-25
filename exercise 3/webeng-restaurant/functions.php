<?php
define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
define( 'IMAGES', TEMPPATH. "/images");
define( 'JS', TEMPPATH. "/js");

wp_enqueue_script("jquery");

function mytheme_customize_register( $wp_customize ) {
    //Restaurant Content Settings
	$wp_customize->add_setting( 'website_title' , array(
		'default'   => 'La Place - Zurich',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'website_desc' , array(
		'default'   => 'The ultimate gastronomical experience. Exquisite dishes from all over the world.<br/>Fine selection of wine and drinks. The place to be for a perfect dinner.',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'def_bg_color' , array(
		'default'   => '433',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'header_picture' , array(
		'default'   => IMAGES.'/header.jpg',
		'transport' => 'postMessage',
	) );

	//Opening Hours Settings
	$wp_customize->add_setting( 'monday' , array(
		'default'   => 'Closed',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'tue_fri' , array(
		'default'   => '8am - 12am',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'sat_sun' , array(
		'default'   => '7am - 1am',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'holidays' , array(
		'default'   => '12pm - 12am',
		'transport' => 'postMessage',
	) );

	//Contact Details Settings
	$wp_customize->add_setting( 'address1' , array(
		'default'   => '4578 Zurich',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'address2' , array(
		'default'   => 'Badenerstrasse 500',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'phone' , array(
		'default'   => '(606) 144-0100',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_setting( 'email' , array(
		'default'   => 'admin@laplace.com',
		'transport' => 'postMessage',
	) );

    //Restaurant Content Section
	$wp_customize->add_section( 'restaurant_website_section' , array(
		'title'      => __( 'Restaurant Content', 'mytheme' ),
		'priority'   => 10000,
	) );

	//Opening Hours Section
	$wp_customize->add_section( 'opening_hours_section' , array(
		'title'      => __( 'Opening Hours', 'mytheme' ),
		'priority'   => 10001,
	) );

	//Contact Detais Section
	$wp_customize->add_section( 'contact_details_section' , array(
		'title'      => __( 'Contact Details', 'mytheme' ),
		'priority'   => 10002,
	) );

	//Restaurant Content Controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'website_title', array(
		'label'      => __( 'Website Title', 'mytheme' ),
		'section'    => 'restaurant_website_section',
		'settings'   => 'website_title',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'website_desc', array(
		'label'      => __( 'Website Description', 'mytheme' ),
		'section'    => 'restaurant_website_section',
		'settings'   => 'website_desc',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_picture', array(
		'label'      => __( 'Header Picture', 'mytheme' ),
		'section'    => 'restaurant_website_section',
		'settings'   => 'header_picture',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'def_bg_color', array(
		'label'      => __( 'Default Background Color', 'mytheme' ),
		'section'    => 'restaurant_website_section',
		'settings'   => 'def_bg_color',
	) ) );

	//Opening Hours Controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monday', array(
		'label'      => __( 'Monday', 'mytheme' ),
		'section'    => 'opening_hours_section',
		'settings'   => 'monday',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tue_fri', array(
		'label'      => __( 'Tue-Fri', 'mytheme' ),
		'section'    => 'opening_hours_section',
		'settings'   => 'tue_fri',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sat_sun', array(
		'label'      => __( 'Sat-Sun', 'mytheme' ),
		'section'    => 'opening_hours_section',
		'settings'   => 'sat_sun',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'holidays', array(
		'label'      => __( 'Holidays', 'mytheme' ),
		'section'    => 'opening_hours_section',
		'settings'   => 'holidays',
	) ) );

	//Contact Details Controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'address1', array(
		'label'      => __( 'Zip Code - City', 'mytheme' ),
		'section'    => 'contact_details_section',
		'settings'   => 'address1',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'address2', array(
		'label'      => __( 'Street', 'mytheme' ),
		'section'    => 'contact_details_section',
		'settings'   => 'address2',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'phone', array(
		'label'      => __( 'Phone', 'mytheme' ),
		'section'    => 'contact_details_section',
		'settings'   => 'phone',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'email', array(
		'label'      => __( 'Email', 'mytheme' ),
		'section'    => 'contact_details_section',
		'settings'   => 'email',
	) ) );
}

//generates css for changes in style
function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
	$return = '';
	$mod = get_theme_mod($mod_name);
	if ( ! empty( $mod ) ) {
		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix.$mod.$postfix
		);
		if ( $echo ) {
			echo $return;
		}
	}
	return $return;
}

//produces new header output for changes in style
function header_output() {
	?>
	<!--Customizer CSS-->
	<style type="text/css">
		<?php generate_css('#header',
						   'background',
						   'header_picture',
						   'url(',
						   ')'); ?>
		<?php generate_css('#our-menu-container',
						   'background',
						   'def_bg_color',
						   '#') ?>
		<?php generate_css('#events-container',
						   'background-color',
						   'def_bg_color',
						   '#') ?>
	</style>
	<!--/Customizer CSS-->
	<?php
}

//support for live preview, as requested in the exercise
function live_preview() {
	wp_enqueue_script(
		'mytheme-themecustomizer', // Give the script a unique ID
		get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
		array(  'jquery', 'customize-preview' ), // Define dependencies
		'', // Define a version (optional)
		true // Specify whether to put in footer (leave this true)
	);
}
add_action( 'customize_register', 'mytheme_customize_register' );
add_action( 'wp_head' , 'header_output' );
add_action( 'customize_preview_init' , 'live_preview' );

add_theme_support('post-thumbnails');

//Custom Type Dish
if(!function_exists('create_dish_post_type')):
    function create_dish_post_type() {
        $labels = array(
            'name' => __('Dishes'),
            'singular_name' => __('Dish'),
            'menu_name' => __('Dishes'),
            'add_new' => __('Add dish'),
            'all_items' => __('All dishes'),
            'add_new_item' => __('Add dish'),
            'edit_item' => __('Edit dish'),
            'new_item' => __('New dish'),
            'view_item' => __('View dish'),
            'search_items' => __('Search dishes'),
            'not_found' => __('No dishes found'),
            'not_found_in_trash' => __('No dishes found in trash'),
            'parent_item_colon' => __('Parent dish')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'thumbnail',
            ),
            'menu_position' => 5,
            'register_meta_box_cb' => 'add_dish_post_type_metabox'
        );
        register_post_type('dish', $args);
    }
    add_action('init', 'create_dish_post_type');
endif;

function add_dish_post_type_metabox() {
    add_meta_box( 'dish_metabox', 'Dish data', 'dish_metabox', 'dish', 'normal' );
}

function dish_metabox() {
    global $post;
    $custom = get_post_custom($post->ID);
    $dish_type= $custom['dish_type'][0];
    $dish_description= $custom['dish_description'][0]; ?>
    <p>
        <label>
            Type (Appetizers, Pasta, Meat-Fish, Desserts) <br>
            <input type="text" name="dish_type" size="50" value="<?php echo $dish_type;?>"/>
        </label>
    </p>
    <p>
        <label>
            Description <br>
            <textarea type="text" name="dish_description" rows="5" cols="80""><?php echo $dish_description;?></textarea>
        </label>
    </p>
    </div>
<?php }

function dish_post_save_meta($post_id, $post) {
    // is the user allowed to edit the post or page?
    if( ! current_user_can('edit_post', $post->ID)){
        return $post->ID;
    }
    
    $dish_post_meta['dish_type'] = $_POST['dish_type'];
    $dish_post_meta['dish_description'] = $_POST['dish_description'];
    // add values as custom fields
    foreach( $dish_post_meta as $key => $value ) {
        if( get_post_meta( $post->ID, $key, FALSE ) ) {
            // if the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else {
            // if the custom field doesn't have a value
            add_post_meta( $post->ID, $key, $value );
        }
        if( !$value ) {
            // delete if blank
            delete_post_meta( $post->ID, $key );
        }
    }
}

add_action('save_post', 'dish_post_save_meta', 1, 2);

//Custom Type Event
if(!function_exists('create_event_post_type')):
    function create_event_post_type() {
        $labels = array(
            'name' => __('Events'),
            'singular_name' => __('Dish'),
            'menu_name' => __('Events'),
            'add_new' => __('Add event'),
            'all_items' => __('All events'),
            'add_new_item' => __('Add event'),
            'edit_item' => __('Edit event'),
            'new_item' => __('New event'),
            'view_item' => __('View event'),
            'search_items' => __('Search eventss'),
            'not_found' => __('No events found'),
            'not_found_in_trash' => __('No events found in trash'),
            'parent_item_colon' => __('Parent event')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'thumbnail',
            ),
            'menu_position' => 6,
            'register_meta_box_cb' => 'add_event_post_type_metabox'
        );
        register_post_type('event', $args);
    }
    add_action('init', 'create_event_post_type');
endif;

function add_event_post_type_metabox() {
    add_meta_box( 'event_metabox', 'Event data', 'event_metabox', 'event', 'normal' );
}

function event_metabox() {
    global $post;
    $custom = get_post_custom($post->ID);
    $event_datetime_start= $custom['event_datetime_start'][0];
    $event_datetime_end= $custom['event_datetime_end'][0];
    $event_description= $custom['event_description'][0]; ?>
    <p>
        <label>
            Starting date and time <br>
            <input type="datetime-local" name="event_datetime_start" value="<?php echo $event_datetime_start; ?>"/>
        </label>
    </p>
    <p>
        <label>
            Ending date and time<br>
            <input type="datetime-local" name="event_datetime_end" value="<?php echo $event_datetime_end; ?>"/>
        </label>
    </p>
    <p>
        <label>
            Description <br>
            <textarea type="text" name="event_description" rows="5" cols="80""><?php echo $event_description; ?></textarea>
        </label>
    </p>
    </div>
<?php }

function event_post_save_meta($post_id, $post) {
    // is the user allowed to edit the post or page?
    if( ! current_user_can('edit_post', $post->ID)){
        return $post->ID;
    }
    
    $event_post_meta['event_datetime_start'] = $_POST['event_datetime_start'];
    $event_post_meta['event_datetime_end'] = $_POST['event_datetime_end'];
    $event_post_meta['event_description'] = $_POST['event_description'];
    // add values as custom fields
    foreach( $event_post_meta as $key => $value ) {
        if( get_post_meta( $post->ID, $key, FALSE ) ) {
            // if the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else {
            // if the custom field doesn't have a value
            add_post_meta( $post->ID, $key, $value );
        }
        if( !$value ) {
            // delete if blank
            delete_post_meta( $post->ID, $key );
        }
    }
}

add_action('save_post', 'event_post_save_meta', 1, 2);

add_action('wp_ajax_get_past_events', 'get_past_events');
add_action('wp_ajax_nopriv_get_past_events', 'get_past_events');

function get_past_events() {
    $pastEvents = $_POST['pastEvents'];
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => 4,
        'meta_query' => array(
            array(
                'key' => 'event_datetime_start',
                'value' => date("Y-m-d\TH:i"),
                'compare' => '<'
            )
        ),
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'offset' => $pastEvents
    );
    $past_events = new WP_Query($args);
    while (($past_events->have_posts())) {
        $past_events->the_post();
        echo '<article class="past-event"><span style="background: url(\'';
        echo the_post_thumbnail_url();
        echo '\') no-repeat;"></span><a href="#" onclick="return loadEvent(';
        echo the_ID(); 
        echo ');"><h3>';
        echo the_title();
        echo '</h3><h2>';
        $event_datetime_start = get_post_meta(get_the_ID(), 'event_datetime_start', true); 
        echo date("d/m/Y H:i", strtotime($event_datetime_start));
        $event_datetime_end = get_post_meta(get_the_ID(), 'event_datetime_end', true); 
        if ($event_datetime_end != '') {
            echo date(" \- H:i", strtotime($event_datetime_end));
        }
        echo '</h2></a></article>';
    }
    wp_die();
}

add_action('wp_ajax_get_event', 'get_event');
add_action('wp_ajax_nopriv_get_event', 'get_event');

function get_event() {
    $event_id = $_POST['event_id'];

    $event = new WP_Query(array('post_type' => 'event', 'p' => $event_id));
    while (($event->have_posts())) {
        $event->the_post();
        echo '<article class="single-event"><h2>';
        echo the_title();
        echo '</h2><span style="background: url(\'';
        echo the_post_thumbnail_url();
        echo '\') no-repeat center;"></span><p><b>Start date and time:</b> ';
        $event_datetime_start = get_post_meta(get_the_ID(), 'event_datetime_start', true); 
        echo date("d/m/Y \a\\t H:i", strtotime($event_datetime_start));
        echo '</p>';
        $event_datetime_end = get_post_meta(get_the_ID(), 'event_datetime_end', true); 
        if ($event_datetime_end != '') {
            echo '<p><b>End date and time:</b> ';
            echo date("d/m/Y \a\\t H:i", strtotime($event_datetime_end));
            echo '</p>';
        }
        echo '<p class="single-event-description">';
        echo get_post_meta(get_the_ID(), 'event_description', true);
        echo '</p></article>';
    }
    wp_die();
}
?>

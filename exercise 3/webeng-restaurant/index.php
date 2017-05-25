<?php get_header(); ?>
<!-- About -->
<section class="menu-height-filler" id="about">
    <?php $page1 = new WP_Query(array('pagename' => 'welcome')); $page1->the_post(); ?>
    <section class="simple-section" id="page1-container">
        <h2><?php the_title()?></h2>
        <p><?php the_content()?></p>
    </section>
	<?php $page2 = new WP_Query(array('pagename' => 'high-quality-cuisine')); $page2->the_post(); ?>
    <section id="page2-container">
        <section id="page2-container-text">
            <h2><?php the_title()?></h2>
            <p><?php the_content()?></p>
        </section>
    </section>
	<?php $page3 = new WP_Query(array('pagename' => 'only-the-best-ingredients')); $page3->the_post(); ?>
    <section class="simple-section" id="page3-container">
        <h2><?php the_title()?></h2>
        <p><?php the_content()?></p>
    </section>
</section>
<!-- Our Menu -->
<section class="menu-height-filler" id="menu">
    <div id="our-menu-container">
        <section id="our-menu-text-container">
            <header>
                <h2>Our Menu</h2>
                <h3>Appetizers</h3>
                <p>We serve a seasonal tasting menu that focuses on local ingredients. Our appetizers may vary during the year to always ensure the best quality. For the appetizers, we are famous for our bruschettas that we serve in several different variants.</p>
            </header>
            <nav>
                <a id="appetizers-button">Appetizers</a>
                <a id="pasta-button">Fresh Pasta</a>
                <a id="meat-button">Meat - Fish</a>
                <a id="dessert-button">Dessert</a>
            </nav>
        </section>
        <section class="menu-items-container" id="appetizers-container">
            <?php $appetizers = new WP_Query(array('post_type' => 'dish', 'meta_key' => 'dish_type', 'meta_value' => 'Appetizers', 'posts_per_page' => 6));
            while ($appetizers->have_posts()) {
                $appetizers->the_post(); ?>
                <article class="menu-item">
                    <a href="#menu-item-<?php global $post; echo $post->post_name; ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"/></a>                
                    <div><div><a href="#menu-item-<?php echo $post->post_name; ?>"><?php the_title(); ?></a></div></div>
                </article>
            <?php } ?>
        </section>
        <section class="menu-items-container" id="pasta-container">
            <?php $pasta = new WP_Query(array('post_type' => 'dish', 'meta_key' => 'dish_type', 'meta_value' => 'Pasta', 'posts_per_page' => 6));
            while ($pasta->have_posts()) {
                $pasta->the_post(); ?>
                <article class="menu-item">
                    <a href="#menu-item-<?php global $post; echo $post->post_name; ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"/></a>                
                    <div><div><a href="#menu-item-<?php echo $post->post_name; ?>"><?php the_title(); ?></a></div></div>
                </article>
            <?php } ?>
        </section>
        <section class="menu-items-container" id="meat-container">
            <?php $meat = new WP_Query(array('post_type' => 'dish', 'meta_key' => 'dish_type', 'meta_value' => 'Meat-Fish', 'posts_per_page' => 6));
            while ($meat->have_posts()) {
                $meat->the_post(); ?>
                <article class="menu-item">
                    <a href="#menu-item-<?php global $post; echo $post->post_name; ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"/></a>                
                    <div><div><a href="#menu-item-<?php echo $post->post_name; ?>"><?php the_title(); ?></a></div></div>
                </article>
            <?php }?>
        </section>
        <section class="menu-items-container" id="dessert-container">
            <?php $desserts = new WP_Query(array('post_type' => 'dish', 'meta_key' => 'dish_type', 'meta_value' => 'Desserts', 'posts_per_page' => 6));
            while ($desserts->have_posts()) {
                $desserts->the_post(); ?>
                <article class="menu-item">
                    <a href="#menu-item-<?php global $post; echo $post->post_name; ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"/></a>                
                    <div><div><a href="#menu-item-<?php echo $post->post_name; ?>"><?php the_title(); ?></a></div></div>
                </article>
            <?php } ?>
        </section>
    </div>
    <div>
        <?php $dishes = new WP_Query(array('post_type' => 'dish', 'posts_per_page' => 24));
        while ($dishes->have_posts()) {
            $dishes->the_post();?>
            <div class="overlay" id="menu-item-<?php global $post; echo $post->post_name; ?>">
                <div class="popup">
                    <h2><?php the_title(); ?></h2>
                    <a class="close" href="#close">&times;</a>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"/>
                    <p><?php $dish_description = get_post_meta(get_the_ID(), 'dish_description', true); echo $dish_description; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<!-- Events -->
<section class="menu-height-filler" id="events">
	<?php $page4 = new WP_Query(array('pagename' => 'our-events')); $page4->the_post(); ?>
    <header class="simple-section" id="page4-container">
        <h2><?php the_title()?></h2>
        <p><?php the_content()?></p>
    </header>
    <section id="events-container">
        <section id="upcoming-events-container">
            <header>
                <h3><b>Upcoming Events</b></h3>
            </header>
            <section>
                <?php $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => 3,
                    'meta_query' => array(
                        array(
                            'key' => 'event_datetime_start',
                            'value' => date("Y-m-d\TH:i"),
                            'compare' => '>'
                        )
                    ),
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                );                
                $upcoming_events = new WP_Query($args);
                
                function limit_text($text, $limit) {
                    if (str_word_count($text, 0) > $limit) {
                        $words = str_word_count($text, 2);
                        $pos = array_keys($words);
                        $text = substr($text, 0, $pos[$limit]) . '... ';
                    }
                    return $text;
                }
                
                while (($upcoming_events->have_posts())) {
                    $upcoming_events->the_post();?>                    
                    <article class="upcoming-event">
                        <span style="background: url('<?php the_post_thumbnail_url(); ?>') no-repeat;"></span>
                        <a href="#" onclick="return loadEvent(<?php the_ID(); ?>);">
                            <h3><?php the_title(); ?></h3>
                            <h2>
                                <?php $event_datetime_start = get_post_meta(get_the_ID(), 'event_datetime_start', true); 
                                echo date("d/m/Y H:i", strtotime($event_datetime_start));
                                $event_datetime_end = get_post_meta(get_the_ID(), 'event_datetime_end', true); 
                                if ($event_datetime_end != '') {
                                    echo date(" \- H:i", strtotime($event_datetime_end)); 
                                }?>
                            </h2>
                        </a>
                        <p><?php $event_description = get_post_meta(get_the_ID(), 'event_description', true); echo limit_text($event_description, 40); ?><a href="#" onclick="return loadEvent(<?php the_ID(); ?>);">[Read More]</a></p>
                    </article>
                <?php } ?>
            </section>
        </section>
        <section id="past-events-container">
            <header>
                <h3><b>Past Events</b></h3>
            </header>
            <section>
                <?php $args = array(
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
                    'order' => 'DESC'
                );                
                $past_events = new WP_Query($args);                
                while (($past_events->have_posts())) {
                    $past_events->the_post();?>
                    <article class="past-event">
                        <span style="background: url('<?php the_post_thumbnail_url(); ?>') no-repeat;"></span>
                        <a href="#" onclick="return loadEvent(<?php the_ID(); ?>);">
                            <h3><?php the_title(); ?></h3>
                            <h2>
                                <?php $event_datetime_start = get_post_meta(get_the_ID(), 'event_datetime_start', true); 
                                echo date("d/m/Y H:i", strtotime($event_datetime_start));
                                $event_datetime_end = get_post_meta(get_the_ID(), 'event_datetime_end', true); 
                                if ($event_datetime_end != '') {
                                    echo date(" \- H:i", strtotime($event_datetime_end)); 
                                }?>
                            </h2>
                        </a>
                    </article>
                <?php } ?>
            </section>
            <footer id="see-more-button-container">
                <div id="see-more-button">
                    <a href="#" onclick="return loadPastEvents();">See More</a>
                </div>
            </footer>
        </section>
        <section id="single-event-container">
    </section>
</section>

<!-- Contact us -->
<section class="menu-height-filler" id="contact">
    <header id="contact-us-container">
        <h2>Contact us</h2>
        <p>Feel free to contact us for any kind of issues or questions</p>
    </header>
    <section id="contact-form-container">
        <form id="contact-form-inner-container" method="post" action="#">
            <section class="flex-input" id="contact-name-mail">
                <div>
                    <input type="text" placeholder="Name"/>
                </div>
                <div>
                    <input type="text" placeholder="Email"/>
                </div>
            </section>
            <section id="contact-message">
                <textarea name="message" placeholder="Message"></textarea>
            </section>
            <section>
                <ul id="contact-submit-clear">
                    <li id="contact-submit-button">
                        <input type="submit" value="Send Message"/>
                    </li>
                    <li  id="contact-clear-button">
                        <input type="reset" value="Clear Form"/>
                    </li>
                </ul>
            </section>
        </form>
    </section>
</section>

<!-- Booking -->
<section class="menu-height-filler" id="booking">
    <div id="booking-container">
        <section id="booking-form">
            <header>
                <h2>Book a table</h2>
            </header>
            <section>
                <form method="post" action="#">
                    <div class="flex-input">
                        <div><input type="text" placeholder="Name"/></div>
                        <div><input type="text" placeholder="Phone"/></div>
                        <div><input type="text" placeholder="Date"/></div>
                        <div><input type="text" placeholder="Time"/></div>
                    </div>
                    <div id="booking-message">
                        <textarea name="message" placeholder="Message"></textarea>
                    </div>
                    <input type="submit" value="Book" id="booking-button-2"/>
                </form>
            </section>
        </section>
    </div>
</section>

<!-- Opening hours - Contacts -->
<section id="opening-hours-contact-address-container">
    <section id="opening-hours-contact-address-container-text">
        <article id="opening-hours-container">
            <h2>Opening Hours</h2>
            <p><b>MONDAY : </b><span id="monday">Closed</span></p>
            <br/>
            <p><b>TUE-FRI : </b><span id="tue-fri">8am - 12am</span></p>
            <br/>
            <p><b>SAT-SUN : </b><span id="sat-sun">7am - 1am</span></p>
            <br/>
            <p><b>HOLIDAYS : </b><span id="holidays">12pm - 12am</span></p>
            <br/>
        </article>
        <article id="contact-address-container">
            <h2>Contacts</h2>
            <p><b>ADDRESS : </b><span id="address1">4578 Zurich</span></p>
            <br/>
            <p><span id="address2">Badenerstrasse 500</span></p>
            <br/>
            <p><b>PHONE : </b><span id="phone">(606) 144-0100</span></p>
            <br/>
            <p><b>EMAIL : </b><span id="email">admin@laplace.com</span></p>
            <br/>
        </article>
    </section>
</section>
<?php get_footer(); ?>

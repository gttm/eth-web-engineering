<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head><title><?php bloginfo('name'); ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="<?php echo(JS.'/animations.js')?>"></script>
    <script type="text/javascript" src="<?php echo(JS.'/menu.js')?>"></script>
    <script type="text/javascript" src="<?php echo(JS.'/ajax.js')?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Kreon" rel="stylesheet"/>
    <link href="http://fonts.googleapis.com/css?family=Roboto:100,200,300,400" rel="stylesheet" type="text/css"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>?v=1" media="screen"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Navigation -->
    <nav id="menu-container">
        <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#"><img src="<?php echo(IMAGES.'/logo.png')?>" alt="" id="logo"/></a></li>
            <li><a href="#events">Events</a></li>
            <li><a href="#contact">Contacts</a></li>
        </ul>
    </nav>

    <section id="menu-filler"></section>

    <!-- Header -->
    <header id="header">
        <h1 id="title">La Place - Zurich</h1>
        <h2 id="description">The ultimate gastronomical experience. Exquisite dishes from all over the world.<br/>Fine selection of wine and drinks. The place to be for a perfect dinner.</h2>
        <a href="#booking" id="booking-button-1">Book a Table</a>
    </header>

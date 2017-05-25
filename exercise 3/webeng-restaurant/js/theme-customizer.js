( function( $ ) {

    // Update the site title in real time...
    wp.customize( 'website_title', function( value ) {
        value.bind( function( newval ) {
            $( '#header #title' ).html( newval );
        } );
    } );

    //Update the site description in real time...
    wp.customize( 'website_desc', function( value ) {
        value.bind( function( newval ) {
            $( '#header #description' ).html( newval );
        } );
    } );

    //Update background color in real time...
    wp.customize( 'def_bg_color', function( value ) {
        value.bind( function( newval ) {
            $('#our-menu-container').css('background', "#" + newval );
            $('#events-container').css('background-color', "#" + newval );
        } );
    } );

    //Update the background image...
    wp.customize( 'header_picture', function( value ) {
        value.bind( function( newval ) {
            $('#header').css('background', "url(\'" + newval + "\')");
        } );
    } );

    // Update opening times on Monday in real time...
    wp.customize( 'monday', function( value ) {
        value.bind( function( newval ) {
            $( '#monday' ).html( newval );
        } );
    } );

    // Update opening times on Tuesday - Friday in real time...
    wp.customize( 'tue_fri', function( value ) {
        value.bind( function( newval ) {
            $( '#tue-fri' ).html( newval );
        } );
    } );

    // Update opening times on Saturday - Sunday in real time...
    wp.customize( 'sat_sun', function( value ) {
        value.bind( function( newval ) {
            $( '#sat-sun' ).html( newval );
        } );
    } );

    // Update opening times on holidays in real time...
    wp.customize( 'holidays', function( value ) {
        value.bind( function( newval ) {
            $( '#holidays' ).html( newval );
        } );
    } );

    // Update opening times on Monday in real time...
    wp.customize( 'address1', function( value ) {
        value.bind( function( newval ) {
            $( '#address1' ).html( newval );
        } );
    } );

    // Update opening times on Tuesday - Friday in real time...
    wp.customize( 'address2', function( value ) {
        value.bind( function( newval ) {
            $( '#address2' ).html( newval );
        } );
    } );

    // Update opening times on Saturday - Sunday in real time...
    wp.customize( 'phone', function( value ) {
        value.bind( function( newval ) {
            $( '#phone' ).html( newval );
        } );
    } );

    // Update opening times on holidays in real time...
    wp.customize( 'email', function( value ) {
        value.bind( function( newval ) {
            $( '#email' ).html( newval );
        } );
    } );
} )( jQuery );
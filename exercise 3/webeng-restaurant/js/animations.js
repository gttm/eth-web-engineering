$.fn.isOnScreen = function(){

    var win = jQuery(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};
var animated = {"title": false,
                "page1": false,
                "page2": false,
                "page3": false,
                "page4": false,
                "upcoming-events": false,
                "past-events": false,
                "contact-form": false,
                "booking-form": false,
                "opening-hours-address": false};

jQuery(document).ready(function( $ ) {
    var menuHeight = undefined;
    jQuery('#title').ready( function() {
        $('#title').animate({marginLeft: '0', marginRight: '0'}, 1000);
    });
    jQuery('#description').ready( function() {
        $('#description').animate({marginTop: '20px', marginBottom: '0'}, 1000);
    });
    if (animated["page1"] == false) {
        if ($('#page1-container').isOnScreen() == true) {
            $('#page1-container').animate({marginTop: '0', marginBottom: '0'}, 1000);
            animated["page1"] = true;
        }
    }
    jQuery('#appetizers-button').css('background-color','#556B2F');
    jQuery('#pasta-container').hide();
    jQuery('#meat-container').hide();
    jQuery('#dessert-container').hide();

    jQuery(window).scroll(function() {
        if (animated["page1"] == false) {
            if ($('#page1-container').isOnScreen() == true) {
                $('#page1-container').animate({marginTop: '0', marginBottom: '0'}, 1000);
                animated["page1"] = true;
            }
        }
        if (animated["page2"] == false) {
            if ($('#page2-container-text').isOnScreen() == true) {
                $('#page2-container-text').animate({marginLeft: '0', marginRight: '0'}, 1000);
                animated["page2"] = true;
            }
        }

        if (animated["page3"] == false) {
            if ($('#page3-container').isOnScreen() == true) {
                $('#page3-container').animate({marginLeft: '0', marginRight: '0'}, 1000);
                animated["page3"] = true;
            }
        }
        if (animated["page4"] == false) {
            if ($('#page4-container').isOnScreen() == true) {
                $('#page4-container').animate({marginLeft: '0', marginRight: '0'}, 1000);
                animated["page4"] = true;
            }
        }
        if (animated["upcoming-events"] == false) {
            if ($('#upcoming-events-container').isOnScreen() == true) {
                $('#upcoming-events-container').animate({marginTop: '0', marginBottom: '0'}, 1000);
                animated["upcoming-events"] = true;
            }
        }
        if (animated["past-events"] == false) {
            if ($('#past-events-container').isOnScreen() == true) {
                $('#past-events-container').animate({marginLeft: '0', marginRight: '0'}, 1000);
                animated["past-events"] = true;
            }
        }
        if (animated["contact-form"] == false) {
            if ($('#contact-form-inner-container').isOnScreen() == true) {
                $('#contact-form-inner-container').animate({marginLeft: '0', marginRight: '0'}, 1000);
                animated["contact-form"] = true;
            }
        }
        
        if (animated["booking-form"] == false) {
            if ($('#booking-form').isOnScreen() == true) {
                $('#booking-form').animate({marginTop: '0', marginBottom: '0'}, 1000);
                animated["booking-form"] = true;
            }
        }
        if (animated["opening-hours-address"] == false) {
            if ($('#opening-hours-contact-address-container-text').isOnScreen() == true) {
                $('#opening-hours-contact-address-container-text').animate({marginLeft: '0', marginRight: '0'}, 1000);
                animated["opening-hours-address"] = true;
            }
        }
        if (menuHeight == undefined)
            menuHeight = jQuery('#menu').height();

        var menuItem = menuItemToShow(menuHeight);

        if (menuItem == "Appetizers") {
            showAppetizers()
        }
        else if (menuItem == "Pasta") {
            showPasta()
        }
        else if (menuItem == "Meat") {
            showMeat()
        }
        else {
            showDessert()
        }
    });
});




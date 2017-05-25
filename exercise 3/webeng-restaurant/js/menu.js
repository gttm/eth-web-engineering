function showAppetizers() {
    jQuery('#pasta-container').hide();
    jQuery('#meat-container').hide();
    jQuery('#dessert-container').hide();
    jQuery('#appetizers-container').show();
    jQuery('#appetizers-button').css('background-color','#556B2F');
    jQuery('#pasta-button').css('background-color','Transparent');
    jQuery('#meat-button').css('background-color','Transparent');
    jQuery('#dessert-button').css('background-color','Transparent');
}

function showPasta() {
    jQuery('#appetizers-container').hide();
    jQuery('#meat-container').hide();
    jQuery('#dessert-container').hide();
    jQuery('#pasta-container').show();
    jQuery('#appetizers-button').css('background-color','Transparent');
    jQuery('#pasta-button').css('background-color','#556B2F');
    jQuery('#meat-button').css('background-color','Transparent');
    jQuery('#dessert-button').css('background-color','Transparent');
}

function showMeat() {
    jQuery('#appetizers-container').hide();
    jQuery('#pasta-container').hide();
    jQuery('#dessert-container').hide();
    jQuery('#meat-container').show();
    jQuery('#appetizers-button').css('background-color','Transparent');
    jQuery('#pasta-button').css('background-color','Transparent');
    jQuery('#meat-button').css('background-color','#556B2F');
    jQuery('#dessert-button').css('background-color','Transparent');
}

function showDessert() {
    jQuery('#appetizers-container').hide();
    jQuery('#pasta-container').hide();
    jQuery('#meat-container').hide();
    jQuery('#dessert-container').show();
    jQuery('#appetizers-button').css('background-color','Transparent');
    jQuery('#pasta-button').css('background-color','Transparent');
    jQuery('#meat-button').css('background-color','Transparent');
    jQuery('#dessert-button').css('background-color','#556B2F');
}

function menuItemToShow(menuHeight) {
    var win = jQuery(window);
    var mid = Math.floor(win.scrollTop() + 0.5 * win.height());

    var menuTop = jQuery('#menu').position().top;

    try {
        //alert(jQuery('#menu').height());
        if (mid < Math.floor(menuTop + 0.25 * menuHeight)) {
            return "Appetizers";
        }
        else if (mid >= Math.floor(menuTop + 0.25 * menuHeight) &&
            mid < Math.floor(menuTop + 0.5 * menuHeight)) {
            return "Pasta";
        }
        else if (mid >= Math.floor(menuTop + 0.5 * menuHeight) &&
            mid < Math.floor(menuTop + 0.75 * menuHeight)) {
            //alert("3 : " + mid + " " + Math.floor(menu.top + 0.5 * menu.height) + " " + Math.floor(menu.top + 0.75 * menu.height));
            return "Meat";
        }
        else {
            //alert("4 : " + mid + " " + Math.floor(menu.top + 0.5 * menu.height) + " " + Math.floor(menu.top + 0.75 * menu.height));
            return "Dessert";
        }
    }
    catch(err) {
        alert(err.message)
    }

}
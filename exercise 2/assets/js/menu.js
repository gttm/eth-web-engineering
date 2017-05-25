function showAppetizers() {
    $('#pasta-container').hide();
    $('#meat-container').hide();
    $('#dessert-container').hide();
    $('#appetizers-container').show();
    $('#appetizers-button').css('background-color','#556B2F');
    $('#pasta-button').css('background-color','Transparent');
    $('#meat-button').css('background-color','Transparent');
    $('#dessert-button').css('background-color','Transparent');
}

function showPasta() {
    $('#appetizers-container').hide();
    $('#meat-container').hide();
    $('#dessert-container').hide();
    $('#pasta-container').show();
    $('#appetizers-button').css('background-color','Transparent');
    $('#pasta-button').css('background-color','#556B2F');
    $('#meat-button').css('background-color','Transparent');
    $('#dessert-button').css('background-color','Transparent');
}

function showMeat() {
    $('#appetizers-container').hide();
    $('#pasta-container').hide();
    $('#dessert-container').hide();
    $('#meat-container').show();
    $('#appetizers-button').css('background-color','Transparent');
    $('#pasta-button').css('background-color','Transparent');
    $('#meat-button').css('background-color','#556B2F');
    $('#dessert-button').css('background-color','Transparent');
}

function showDessert() {
    $('#appetizers-container').hide();
    $('#pasta-container').hide();
    $('#meat-container').hide();
    $('#dessert-container').show();
    $('#appetizers-button').css('background-color','Transparent');
    $('#pasta-button').css('background-color','Transparent');
    $('#meat-button').css('background-color','Transparent');
    $('#dessert-button').css('background-color','#556B2F');
}

function menuItemToShow(menuHeight) {
    var win = $(window);
    var mid = Math.floor(win.scrollTop() + 0.5 * win.height());

    var menuTop = $('#menu').position().top;

    try {
        //alert($('#menu').height());
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
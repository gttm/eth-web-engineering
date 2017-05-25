var devicename; // the name of this screen and specified in the URL
var imageCount = 7; // the maximum number of images available

document.addEventListener("DOMContentLoaded", function(event) {
    devicename = getQueryParams().name;
    if (devicename) {
        var text = document.querySelector("#name");
        text.textContent = devicename;
    }
    connectToServer();
});

function showImage(imageIndex) {
    var img = document.querySelector("#image");
    var msg = document.querySelector("#msg");
    if (imageIndex >= 0 && imageIndex <= imageCount){
        img.setAttribute("src", "images/" + imageIndex + ".jpg");
        msg.style.display = "none";
        img.style.display = "block";
    }
}

function clearImage() {
    var img = document.querySelector("#image");
    var msg = document.querySelector("#msg");
    img.style.display = "none";
    img.style.width = "100%";
    msg.style.display = "block";
}

function getQueryParams() {
    var qs = window.location.search.split("+").join(" ");
    var params = {}, tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;
    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])]
            = decodeURIComponent(tokens[2]);
    }
    return params;
}

function connectToServer(){
    var serverSocket = io();
    serverSocket.emit("screenName", devicename);
    
    serverSocket.on("showImage", function (imageIndex) {
        if (imageIndex >= 0) {
            showImage(imageIndex % imageCount);
        } 
        else {
            clearImage();
        }
    });
    
    serverSocket.on("zoomImage", function (zoomLevel) {
        var width;
        if (zoomLevel == 0) width = 100;
        else if (zoomLevel == 1) width = 80;
        else if (zoomLevel == 2) width = 60;
        else width = 40;
        var img = document.querySelector("#image");
        img.style.width = width + "%";
    });
}

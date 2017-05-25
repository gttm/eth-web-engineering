var currentImage = 0; // the currently selected image
var imageCount = 7; // the maximum number of images available

var serverSocket;
var connectedScreens = [];
var jerkTiltDirection = 0;
var lastJerkTilt = 0;
var zoomLevel = 0;

function showImage(imageIndex) {
    // Update selection on remote
    currentImage = imageIndex;
    var images = document.querySelectorAll("img");
    document.querySelector("img.selected").classList.toggle("selected");
    images[imageIndex].classList.toggle("selected");    
    // Send the command to the screen
    if (connectedScreens.length > 0) {
        serverSocket.emit("showGallery", {imageIndex: imageIndex, connectedScreens: connectedScreens});
    }
}

function initialiseGallery() {
    var container = document.querySelector("#gallery");
    for (var i = 0; i < imageCount; i++) {
        var img = document.createElement("img");
        img.src = "images/" + i + ".jpg";
        container.appendChild(img);
        var handler = (function (imageIndex) {
            return function () {
                showImage(imageIndex);
            }
        })(i);
        img.addEventListener("click", handler);
    }
    document.querySelector("img").classList.toggle("selected");
}

Array.prototype.subtract = function (a) {
    return this.filter(function (i) {
        return a.indexOf(i) < 0;
    });
};

function listScreens(screenList) {
    // empty screen list
    var screenListElement = document.querySelector("#menu").querySelector("ul");
    while (screenListElement.firstChild) {
        screenListElement.removeChild(screenListElement.firstChild);
    }
    // reconstruct screen list
    for (var i = 0; i < screenList.length; i++) {
        var listItem = document.createElement("li");
        var button = document.createElement("button");
        listItem.appendChild(document.createTextNode(screenList[i]));
        button.title = screenList[i];
        button.className = "pure-button";
        button.appendChild(document.createTextNode(connectedScreens.indexOf(screenList[i]) > -1 ? "Disconnect" : "Connect"));
        listItem.appendChild(button);
        screenListElement.appendChild(listItem);
    }
    // remove disconnected screens from connectedScreens
    var disconnectedScreens = connectedScreens.subtract(screenList);
    connectedScreens = connectedScreens.subtract(disconnectedScreens);
}

function connectToServer() {
    serverSocket = io();
    serverSocket.emit("remote");
    
    serverSocket.on("screenList", function (screenList) {
        listScreens(screenList);
        showImage(currentImage);
    });
}

function mod(n, m) {
    return ((n % m) + m) % m;
}

document.addEventListener("DOMContentLoaded", function () {
    initialiseGallery();    
    // settings button toggle event
    document.querySelector("#toggleMenu").addEventListener("click", function () {
        var style = document.querySelector("#menu").style;
        style.display = style.display == "none" || style.display == "" ? "block" : "none";
    });    
    // screen list buttons toggle event
    document.querySelector("#menu").querySelector("ul").addEventListener("click", function (event) {
        if (event.target && event.target.nodeName == "BUTTON") {
            event.target.firstChild.nodeValue = event.target.firstChild.nodeValue == "Connect" ? "Disconnect" : "Connect";
            connectedScreens = [];
            var screenElements = document.querySelector("#menu").querySelector("ul").querySelectorAll("button");
            for (var i = 0; i < screenElements.length; i++) {
                if (screenElements[i].firstChild.nodeValue == "Disconnect") {
                    connectedScreens.push(screenElements[i].title);
                }
            }
            serverSocket.emit("showGallery", {imageIndex: currentImage, connectedScreens: connectedScreens});
        }
    });
    // tilt up/down to zoom out/in
    if (window.DeviceOrientationEvent) {
        window.addEventListener("deviceorientation", function (event) {
            var newZoomLevel;
            if (event.beta < 20) newZoomLevel = 0;
            else if (event.beta < 40) newZoomLevel = 1;
            else if (event.beta < 60) newZoomLevel = 2;
            else newZoomLevel = 4;
            if (zoomLevel != newZoomLevel) {
                zoomLevel = newZoomLevel;
                serverSocket.emit("zoomImages", {zoomLevel: zoomLevel, connectedScreens: connectedScreens});
            }
        });
    }
    // jerk-tilt left/right to select the previous/next image
    if (window.DeviceMotionEvent) {
        window.addEventListener("devicemotion", function (event) {
            if (Math.abs(event.rotationRate.beta) > 5) {
                if (jerkTiltDirection != Math.sign(event.rotationRate.beta) && Date.now() - lastJerkTilt > 500) {
                    jerkTiltDirection = Math.sign(event.rotationRate.beta);
                    lastJerkTilt = Date.now();
                    var newImage =(currentImage + jerkTiltDirection + imageCount) % imageCount
                    showImage(newImage);
                }
            }
            else if (Math.abs(event.rotationRate.beta) < 4 && jerkTiltDirection != 0) {
                jerkTiltDirection = 0;
            }
        });
    }
    connectToServer();
});

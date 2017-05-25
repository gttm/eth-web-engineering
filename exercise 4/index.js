var express = require("express");
var app = express();
var http = require("http").Server(app);
var io = require("socket.io").listen(http);

var screens = {};
var remotes = {};

app.use(express.static("public"));

function updateScreenList() {
    // update screen list on remotes
    var screenList = Object.keys(screens);
    console.log("screenList: " + screenList.toString());
    io.emit("screenList", screenList);
}

Array.prototype.subtract = function (a) {
    return this.filter(function (i) {
        return a.indexOf(i) < 0;
    });
};

io.on("connection", function (socket) {
    socket.on("remote", function () {
        // store remote
        console.log("remote: " + this.id);
        remotes[this.id] = {socket: this, connectedScreens: []};
        updateScreenList();
    });

    socket.on("screenName", function (screenName) {
        // store screen
        console.log("screen: " + this.id + "| " + screenName);
        screens[screenName] = {socket: this};
        updateScreenList();
    });

    socket.on("showGallery", function (message) {
        console.log("showGallery message: " + this.id + "| " + message.imageIndex + "| " + message.connectedScreens.toString());
        if (this.id in remotes) {
            // clear image on deliberately disconnected screens
            var clearScreens = remotes[this.id].connectedScreens.subtract(message.connectedScreens);
            for (var i = 0; i < clearScreens.length; i++) {
                var screenName = clearScreens[i];
                console.log("clear screenName: " + screenName);
                if (screenName in screens) {
                    screens[screenName].socket.emit("showImage", -1);
                }
            }
            remotes[this.id].connectedScreens = message.connectedScreens;
            // show images on the connected screens
            var i = 0;
            for (var i = 0; i < message.connectedScreens.length; i++) {
                var screenName = message.connectedScreens[i];
                console.log("showImage screenName: " + screenName);
                if (screenName in screens) {
                    screens[screenName].socket.emit("showImage", message.imageIndex + i);
                }
            }
        }
    });
    
    socket.on("zoomImages", function (message) {
        console.log("zoomImages message: " + this.id + "| " + message.zoomLevel + "| " + message.connectedScreens.toString());
        // zoom image on all connected screens
        for (var i = 0; i < message.connectedScreens.length; i++) {
            var screenName = message.connectedScreens[i];
            if (screenName in screens) {
                screens[screenName].socket.emit("zoomImage", message.zoomLevel);
            }
        }
    });
    
    socket.on("disconnect", function () {
        // remove disconnected remote/screen
        if (this.id in remotes) {
            console.log("remote disconnected: " + this.id);
            // clear images on all screens remote controlled
            for (var i = 0; i < remotes[this.id].connectedScreens.length; i++) {
                var screenName = remotes[this.id].connectedScreens[i];
                console.log("clear screenName: " + screenName);
                if (screenName in screens) {
                    screens[screenName].socket.emit("showImage", -1);
                }
            }
            delete remotes[this.id];
        }
        else {
            for (var screenName in screens) {
                if (screens[screenName].socket.id == this.id) {
                    console.log("screen disconnected: " + this.id + "| " + screenName);
                    delete screens[screenName];
                    break;
                }
            }
            updateScreenList();
        }
    });
});

http.listen(8080, function() {
    console.log("listening on *:8080");
});

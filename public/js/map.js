/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/map.ts ***!
  \*****************************/
 // Initialize and add the map

window.initMap = function () {
  // The location of Baghdad
  var baghdad = {
    lat: 33.312805,
    lng: 44.361488
  }; // The map, centered at baghdad

  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 6,
    center: baghdad,
    fullscreenControl: false,
    mapId: "6e21f68e87eba133"
  }); // Get User location

  var geolocation = navigator.geolocation;

  if (geolocation) {
    geolocation.getCurrentPosition(function (position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      }; // The marker, positioned at user location

      var marker = new google.maps.Marker({
        position: pos,
        map: map,
        icon: "./assets/svg/current_pos.svg"
      }); // Center map on user location

      map.setCenter(pos);
      map.setZoom(16);
    }, function () {// Browser doesn't support Geolocation
    }, {
      enableHighAccuracy: true,
      maximumAge: 0,
      timeout: Infinity
    });
  }
};
/******/ })()
;
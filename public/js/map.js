/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/map.ts ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
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
    mapTypeControl: false,
    streetViewControl: false,
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
    places === null || places === void 0 ? void 0 : places.forEach(function (element) {
      // The marker, positioned at a place
      var marker = new google.maps.Marker({
        position: {
          lat: element.longitude,
          lng: element.latitude
        },
        map: map,
        clickable: true
      });
      var infoWindow = new google.maps.InfoWindow({
        position: {
          lat: element.longitude,
          lng: element.latitude
        },
        ariaLabel: element.description,
        content: element.name
      });
      marker.addListener("click", function () {
        infoWindow.open(map, marker);
      });
    });
  }
};


/******/ })()
;
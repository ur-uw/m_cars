import { ServicePlace } from "./service_place";
import axios from "axios";

// Initialize and add the map
window.initMap = async () => {
    // The location of Baghdad
    const baghdad = { lat: 33.312805, lng: 44.361488 };
    // The map, centered at baghdad
    const map: google.maps.Map = new google.maps.Map(
        document.getElementById("map") as HTMLElement,
        {
            zoom: 12,
            center: baghdad,
            fullscreenControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            mapId: "6e21f68e87eba133",
        }
    );
    const userLocationButton: HTMLButtonElement =
        document.createElement("button");
    userLocationButton.classList.add("btn");
    userLocationButton.classList.add("btn-primary");
    userLocationButton.classList.add("transition");
    userLocationButton.style.margin = "0.5rem";
    userLocationButton.innerHTML = `<i class="fas fa-map-marker-alt text-lg"></i>`;
    userLocationButton.addEventListener("click", () => {
        moveToUserLocation(map);
    });
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
        userLocationButton
    );
    // Get User location
    moveToUserLocation(map);
    // Show service places on the map
    await getServicePlaces(map);
};

// Add service places to the map
async function getServicePlaces(map: google.maps.Map) {
    const response = await axios.get("/api/service-places");
    const servicePlaces: ServicePlace[] = response.data["service_places"];

    servicePlaces.forEach((servicePlace: ServicePlace) => {
        const marker = new google.maps.Marker({
            position: {
                lat: servicePlace.longitude,
                lng: servicePlace.latitude,
            },
            map: map,
            clickable: true,
        });
        const infoWindow = new google.maps.InfoWindow({
            content: `<div class="flex flex-col space-y-1">
            <div class="text-primary">${servicePlace.name}</div>
            <div class="text-gray-500">${servicePlace.description}</div>
            ${
                servicePlace.phone_number.length > 0
                    ? `<div class="text-gray-500"> <span class="text-black font-semibold text-sm">Phone Number: </span> ${servicePlace.phone_number}</div>`
                    : ""
            }
            </div>`,
        });
        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });
    });
}
// TODO: REMOVE OLD MARKER
function moveToUserLocation(map: google.maps.Map): google.maps.Marker | null {
    const geolocation = navigator.geolocation;
    if (geolocation) {
        geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                // The marker, positioned at user location
                const newMarker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: "./assets/svg/current_pos.svg",
                });

                // Center map on user location
                map.moveCamera({
                    center: pos,
                });
                map.setZoom(16);
                map.setCenter(pos);
                return newMarker;
            },
            () => {
                // Browser doesn't support Geolocation
                return null;
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: Infinity,
            }
        );
    }
    return null;
}

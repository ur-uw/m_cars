import { ServicePlace } from "./service_place";
import axios from "axios";
import { haversine_distance } from "./services/distance_calculator";
import { LocationService } from "./services/location_service";

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

    // Get service places from the server
    const servicePlaces = await getServicePlaces();

    // Create button to move to user location
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
    let servicePlacesMarkers: google.maps.Marker[] | null;
    // Show service places on the map
    if (servicePlaces !== null) {
        servicePlacesMarkers = showServicePlaces(map, servicePlaces);
    }

    // Get User location
    moveToUserLocation(map)
        .then((marker) => {
            // Create button to get nearest service place
            const nearestServicePlaceButton: HTMLButtonElement =
                document.createElement("button");
            nearestServicePlaceButton.classList.add("btn");
            nearestServicePlaceButton.classList.add("btn-primary");
            nearestServicePlaceButton.classList.add("transition");
            nearestServicePlaceButton.style.margin = "0.5rem";
            nearestServicePlaceButton.innerHTML = `<i class="fa-solid fa-screwdriver-wrench text-lg"></i>`;

            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
                nearestServicePlaceButton
            );
            nearestServicePlaceButton.addEventListener("click", () => {
                if (servicePlaces != null && marker != null) {
                    const nearestServicePlace: ServicePlace | null =
                        getNearestServicePlace(marker, servicePlaces);
                    if (nearestServicePlace != null) {
                        const cameraOptions: google.maps.CameraOptions = {
                            center: {
                                lat: nearestServicePlace.latitude,
                                lng: nearestServicePlace.longitude,
                            },
                            zoom: 18,
                        };
                        // Get nearest places markers
                        const nearestPlaceMarkers =
                            servicePlacesMarkers?.filter((marker) => {
                                return (
                                    JSON.stringify(marker.getPosition()) ===
                                    JSON.stringify({
                                        lat: nearestServicePlace.latitude,
                                        lng: nearestServicePlace.longitude,
                                    })
                                );
                            });
                        if (
                            nearestPlaceMarkers != null &&
                            nearestPlaceMarkers?.length > 0
                        ) {
                            // Open nearest place info window
                            nearestPlaceMarkers[0].setAnimation(
                                google.maps.Animation.DROP
                            );
                            new google.maps.event.trigger(
                                nearestPlaceMarkers[0],
                                "click"
                            );
                        }
                        map.setCenter(cameraOptions.center!);
                        map.setTilt(45);
                        map.setZoom(cameraOptions.zoom!);
                    }
                }
            });
        })
        .catch((e) => console.error(e));
};

// Add service places to the map
async function getServicePlaces(): Promise<ServicePlace[] | null> {
    const response = await axios.get("/api/service-places");
    const servicePlaces: ServicePlace[] = response.data["service_places"];
    return servicePlaces;
}

// Show service places on the map
function showServicePlaces(
    map: google.maps.Map,
    servicePlaces: ServicePlace[]
): google.maps.Marker[] | null {
    // Create markers for service places
    const markers: google.maps.Marker[] = [];
    let infoWindow = new google.maps.InfoWindow();
    servicePlaces.forEach((servicePlace: ServicePlace) => {
        const marker = new google.maps.Marker({
            position: {
                lat: servicePlace.latitude,
                lng: servicePlace.longitude,
            },
            map: map,
            clickable: true,
        });

        marker.addListener("click", () => {
            infoWindow.setContent(`<div class="flex flex-col space-y-1">
            <div class="text-primary">${servicePlace.name}</div>
            <div class="text-gray-500">${servicePlace.description}</div>
            ${
                servicePlace.phone_number.length > 0
                    ? `<div class="text-gray-500"> <span class="text-black font-semibold text-sm">Phone Number: </span> ${servicePlace.phone_number}</div>`
                    : ""
            }
            </div>`);
            infoWindow.open(map, marker);
        });
        markers.push(marker);
    });
    return markers;
}
// TODO: REMOVE OLD MARKER
async function moveToUserLocation(
    map: google.maps.Map
): Promise<google.maps.Marker | null> {
    const geolocation = navigator.geolocation;
    if (geolocation) {
        const position = await LocationService.getPosition({
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: Infinity,
        });
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
        map.setZoom(16);
        map.panTo(pos);
        return newMarker;
    }
    return null;
}
// Get nearest service place
function getNearestServicePlace(
    marker: google.maps.Marker,
    servicePlaces: ServicePlace[]
): ServicePlace | null {
    // get nearest service place
    if (servicePlaces.length > 0) {
        const nearestServicePlace = servicePlaces.reduce(
            (p1: ServicePlace, p2) => {
                const distance1 = haversine_distance(marker, {
                    lat: p1.latitude,
                    lng: p1.longitude,
                });
                const distance2 = haversine_distance(marker, {
                    lat: p2.latitude,
                    lng: p2.longitude,
                });
                return distance1 < distance2 ? p1 : p2;
            }
        );
        // Return nearest service place
        return nearestServicePlace;
    }
    return null;
}

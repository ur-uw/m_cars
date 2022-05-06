import { ServicePlace } from "./service_place";
import axios from "axios";
import { haversine_distance } from "./services/distance_calculator";
import { LocationService } from "./services/location_service";

// Initialize and add the map
window.initMap = async () => {
    // The location of Baghdad
    const baghdad = { lat: 33.312805, lng: 44.361488 };
    // Create directions renderer to show routes
    const directionsRenderer: google.maps.DirectionsRenderer =
        new google.maps.DirectionsRenderer({
            markerOptions: {
                visible: false,
            },
            suppressMarkers: true,
            polylineOptions: {
                strokeColor: "#5267DF",
            },
            preserveViewport: true,
            suppressInfoWindows: true,
        });
    // The map, centered at baghdad
    const map: google.maps.Map = new google.maps.Map(
        document.getElementById("map") as HTMLElement,
        {
            zoom: 12,
            center: baghdad,
            fullscreenControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            gestureHandling: screen.height >= 1024 ? "cooperative" : "greedy",
            mapId: "6e21f68e87eba133",
        }
    );
    directionsRenderer.setMap(map);
    // Current location marker
    const currentLocationMarker = new google.maps.Marker({
        map: map,
        icon: "./assets/svg/current_pos.svg",
    });

    // Get service places from the server
    const servicePlaces = await getServicePlaces();

    // Create button to move to user location
    const userLocationButton: HTMLButtonElement =
        document.createElement("button");
    userLocationButton.setAttribute("title", "Move to your location");
    userLocationButton.classList.add("btn");
    userLocationButton.classList.add("btn-primary");
    userLocationButton.classList.add("transition");
    userLocationButton.style.margin = "0.5rem";
    userLocationButton.innerHTML = `<i class="fas fa-map-marker-alt text-lg"></i>`;
    userLocationButton.addEventListener("click", () => {
        moveToUserLocation(map, currentLocationMarker);
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
    moveToUserLocation(map, currentLocationMarker)
        .then((locationExists) => {
            // Create button to get nearest service place
            const nearestServicePlaceButton: HTMLButtonElement =
                document.createElement("button");
            nearestServicePlaceButton.setAttribute(
                "title",
                "Locate nearest service place"
            );
            nearestServicePlaceButton.classList.add("btn");
            nearestServicePlaceButton.classList.add("btn-primary");
            nearestServicePlaceButton.classList.add("transition");
            nearestServicePlaceButton.style.margin = "0.5rem";
            nearestServicePlaceButton.innerHTML = `<i class="fa-solid fa-screwdriver-wrench text-lg"></i>`;

            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
                nearestServicePlaceButton
            );
            nearestServicePlaceButton.addEventListener("click", async () => {
                if (servicePlaces != null && locationExists != null) {
                    moveToNearestPlace(
                        map,
                        currentLocationMarker,
                        "Car Service",
                        servicePlaces!,
                        servicePlacesMarkers!,
                        directionsRenderer
                    );
                }
            });
            // Create button to get nearest care place
            const nearestCarePlaceButton: HTMLButtonElement =
                document.createElement("button");
            nearestCarePlaceButton.setAttribute(
                "title",
                "Locate nearest care place"
            );
            nearestCarePlaceButton.classList.add("btn");
            nearestCarePlaceButton.classList.add("btn-primary");
            nearestCarePlaceButton.classList.add("transition");
            nearestCarePlaceButton.style.margin = "0.5rem";
            nearestCarePlaceButton.innerHTML = `<i class="fa-solid fa-spray-can-sparkles text-lg"></i>`;

            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
                nearestCarePlaceButton
            );
            nearestCarePlaceButton.addEventListener("click", async () => {
                if (servicePlaces != null && locationExists != null) {
                    moveToNearestPlace(
                        map,
                        currentLocationMarker,
                        "Car Care",
                        servicePlaces!,
                        servicePlacesMarkers!,
                        directionsRenderer
                    );
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
            icon:
                servicePlace.service_place_type.name == "Car Care"
                    ? "./assets/svg/care_place_marker.svg"
                    : "./assets/svg/service_place_marker.svg",
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

async function moveToUserLocation(
    map: google.maps.Map,
    marker: google.maps.Marker
): Promise<boolean> {
    const geolocation = navigator.geolocation;
    return new Promise(async (resolve, reject) => {
        if (geolocation) {
            const position: any = await LocationService.getPosition({
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: Infinity,
            });
            const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };

            // The marker, positioned at user location
            marker.setPosition(pos);
            // Center map on user location
            map.setZoom(16);
            map.panTo(pos);
            resolve(true);
        }
        reject(false);
    });
}
// Get nearest service place
function getNearestServicePlace(
    currentPos: { lat: number; lng: number },
    servicePlaces: ServicePlace[],
    type: string,
    directionsRenderer: google.maps.DirectionsRenderer
): ServicePlace | null {
    // get nearest service place
    if (servicePlaces.length > 0) {
        const nearestServicePlace: ServicePlace = servicePlaces
            .filter(
                (place: ServicePlace) => place.service_place_type.name === type
            )
            .reduce((p1: ServicePlace, p2) => {
                const distance1 = haversine_distance(currentPos, {
                    lat: p1.latitude,
                    lng: p1.longitude,
                });
                const distance2 = haversine_distance(currentPos, {
                    lat: p2.latitude,
                    lng: p2.longitude,
                });
                return distance1 < distance2 ? p1 : p2;
            });
        // Return nearest service place
        // Get route
        LocationService.getRoute(
            {
                lat: currentPos.lat,
                lng: currentPos.lng,
            },
            {
                lat: nearestServicePlace.latitude,
                lng: nearestServicePlace.longitude,
            },
            directionsRenderer
        );
        return nearestServicePlace;
    }
    return null;
}

async function moveToNearestPlace(
    map: google.maps.Map,
    currentLocationMarker: google.maps.Marker,
    placeType: string,
    servicePlaces: ServicePlace[],
    servicePlacesMarkers: google.maps.Marker[],
    directionsRenderer: google.maps.DirectionsRenderer
): Promise<void> {
    const requestPos: any = await LocationService.getPosition({
        enableHighAccuracy: true,
        maximumAge: 0,
        timeout: Infinity,
    });

    if (requestPos.coords == null) {
        return;
    }
    const userCurrentPos = {
        lat: requestPos.coords.latitude,
        lng: requestPos.coords.longitude,
    };
    currentLocationMarker.setPosition(userCurrentPos);
    const nearestServicePlace: ServicePlace | null = getNearestServicePlace(
        userCurrentPos,
        servicePlaces,
        placeType,
        directionsRenderer
    );
    if (nearestServicePlace != null) {
        const cameraOptions: google.maps.CameraOptions = {
            center: {
                lat: nearestServicePlace.latitude,
                lng: nearestServicePlace.longitude,
            },
            zoom: 18,
        };
        // Get nearest places markers
        const nearestPlaceMarkers = servicePlacesMarkers?.filter((marker) => {
            return (
                JSON.stringify(marker.getPosition()) ===
                JSON.stringify({
                    lat: nearestServicePlace.latitude,
                    lng: nearestServicePlace.longitude,
                })
            );
        });
        if (nearestPlaceMarkers != null && nearestPlaceMarkers?.length > 0) {
            // Open nearest place info window
            nearestPlaceMarkers[0].setAnimation(google.maps.Animation.DROP);
            new google.maps.event.trigger(nearestPlaceMarkers[0], "click");
        }
        map.setCenter(cameraOptions.center!);
        map.setTilt(45);
        map.setZoom(cameraOptions.zoom!);
    }
}

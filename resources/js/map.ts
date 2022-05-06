import { LocationService } from "./services/location_service";
import { PlacesService } from "./services/places_service";

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
    const placesService = new PlacesService();
    const servicePlaces = await placesService.getServicePlaces();

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
        customControlButton(
            {
                title: "Move to your location",
                iconElement: `<i class="fas fa-map-marker-alt text-lg"></i>`,
            },
            () => {
                LocationService.moveToUserLocation(map, currentLocationMarker);
            }
        )
    );
    // Show service places on the map
    if (servicePlaces !== null) {
        placesService.showServicePlaces(map);
    }

    // Get User location
    LocationService.moveToUserLocation(map, currentLocationMarker)
        .then((locationExists) => {
            // Create button to get nearest service place
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
                customControlButton(
                    {
                        title: "Locate nearest service place",
                        iconElement: `<i class="fa-solid fa-screwdriver-wrench text-lg"></i>`,
                    },
                    async () => {
                        if (servicePlaces != null && locationExists != null) {
                            placesService.moveToNearestPlace(
                                map,
                                currentLocationMarker,
                                "Car Service",
                                directionsRenderer
                            );
                        }
                    }
                )
            );
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
                customControlButton(
                    {
                        title: "Locate nearest care place",
                        iconElement: `<i class="fa-solid fa-spray-can-sparkles text-lg"></i>`,
                    },
                    async () => {
                        if (servicePlaces != null && locationExists != null) {
                            placesService.moveToNearestPlace(
                                map,
                                currentLocationMarker,
                                "Car Care",
                                directionsRenderer
                            );
                        }
                    }
                )
            );
        })
        .catch((e) => console.error(e));
};
/**
 * Create custom control button
 * @param buttonOptions - button options
 * @param listener - button onClick event
 * @returns HTMLButtonElement custom control button
 */
function customControlButton(
    buttonOptions: {
        title: string | null;
        iconElement: string | null;
    } | null,
    listener: (this: HTMLButtonElement, ev: MouseEvent) => any
): HTMLButtonElement {
    // Create button to move to user location
    const userLocationButton: HTMLButtonElement =
        document.createElement("button");
    userLocationButton.setAttribute("title", buttonOptions?.title ?? "Button");
    userLocationButton.classList.add("btn");
    userLocationButton.classList.add("btn-primary");
    userLocationButton.classList.add("transition");
    userLocationButton.style.margin = "0.5rem";
    userLocationButton.innerHTML =
        buttonOptions?.iconElement ??
        `<i class="fas fa-map-marker-alt text-lg"></i>`;
    userLocationButton.addEventListener("click", listener);
    return userLocationButton;
}

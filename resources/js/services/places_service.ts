import axios from "axios";
import { ServicePlace } from "../service_place";
import { haversine_distance } from "./distance_calculator";
import { LocationService } from "./location_service";

export class PlacesService {
    private servicePlaces: ServicePlace[] | null = null;
    private servicePlacesMarkers: google.maps.Marker[] | null = null;

    /**
     * Fetch service places from the server
     * @returns {Promise<ServicePlace[]>} - Promise that resolves to the service places
     * @memberof PlacesService
     */
    public async getServicePlaces(): Promise<ServicePlace[] | null> {
        const response = await axios.get("/api/service-places");
        const servicePlaces: ServicePlace[] = response.data["service_places"];
        this.servicePlaces = servicePlaces;
        return servicePlaces;
    }

    /**
     * Adds service places markers to the map
     * @param map - Map
     * @memberof PlacesService
     */
    public showServicePlaces(map: google.maps.Map): void {
        // Create markers for service places
        const markers: google.maps.Marker[] = [];
        let infoWindow = new google.maps.InfoWindow();
        this.servicePlaces?.forEach((servicePlace: ServicePlace) => {
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
        // Set markers to the service places markers
        this.servicePlacesMarkers = markers;
    }

    /**
     * Gets the nearest service place to the user
     * @param currentPos - Current user position
     * @param type - Place type
     * @param directionsRenderer - Directions renderer
     * @returns Nearest service place
     * @memberof PlacesService
     */
    public getNearestServicePlace(
        currentPos: { lat: number; lng: number },
        type: string,
        directionsRenderer: google.maps.DirectionsRenderer
    ): ServicePlace | null {
        // get nearest service place
        if (this.servicePlaces == null) {
            return null;
        }
        if (this.servicePlaces.length > 0) {
            const nearestServicePlace: ServicePlace | undefined | null =
                this.servicePlaces
                    ?.filter(
                        (place: ServicePlace) =>
                            place.service_place_type.name === type
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

    /**
     * Move the camera to the nearest service place
     * @param map - Map
     * @param currentLocationMarker - Current location marker
     * @param placeType - Place type
     * @param directionsRenderer - Directions renderer
     * @memberof PlacesService
     */
    public async moveToNearestPlace(
        map: google.maps.Map,
        currentLocationMarker: google.maps.Marker,
        placeType: string,
        directionsRenderer: google.maps.DirectionsRenderer
    ): Promise<ServicePlace | null> {
        return new Promise(async (resolve, reject) => {
            const requestPos: any = await LocationService.getPosition({
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: Infinity,
            });

            if (requestPos.coords == null) {
                return null;
            }
            const userCurrentPos = {
                lat: requestPos.coords.latitude,
                lng: requestPos.coords.longitude,
            };
            currentLocationMarker.setPosition(userCurrentPos);
            const nearestServicePlace: ServicePlace | null =
                this.getNearestServicePlace(
                    userCurrentPos,
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
                const nearestPlaceMarkers = this.servicePlacesMarkers?.filter(
                    (marker) => {
                        return (
                            JSON.stringify(marker.getPosition()) ===
                            JSON.stringify({
                                lat: nearestServicePlace.latitude,
                                lng: nearestServicePlace.longitude,
                            })
                        );
                    }
                );
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
                resolve(nearestServicePlace);
            }
            reject(null);
        });
    }
}

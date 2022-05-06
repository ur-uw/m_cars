export class LocationService {
    static getPosition = (options?: PositionOptions): unknown => {
        return new Promise((resolve, reject) =>
            navigator.geolocation.getCurrentPosition(resolve, reject, options)
        );
    };

    /**
     * Move to user current location
     * @param map - map
     * @param marker - current location marker
     * @returns - promise
     * @memberof LocationService
     * @static
     * @async
     * */
    public static async moveToUserLocation(
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

    /**
     *
     * @param origin - origin position
     * @param destination - destination position
     * @param directionsRenderer - directions renderer
     * @returns  - promise
     */
    static getRoute = (
        origin: { lat: number; lng: number },
        destination: { lat: number; lng: number },
        directionsRenderer: google.maps.DirectionsRenderer
    ): Promise<google.maps.DirectionsResult | null> => {
        return new Promise<google.maps.DirectionsResult | null>(
            (resolve, reject) => {
                const directionsService = new google.maps.DirectionsService();
                const directionsRequest: google.maps.DirectionsRequest = {
                    origin: {
                        lat: origin.lat,
                        lng: origin.lng,
                    },
                    destination: {
                        lat: destination.lat,
                        lng: destination.lng,
                    },
                    travelMode: google.maps.TravelMode.WALKING,
                };
                directionsService.route(directionsRequest, (result, status) => {
                    if (status === google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(result);
                        resolve(result);
                    } else {
                        reject(result);
                    }
                });
            }
        );
    };
}

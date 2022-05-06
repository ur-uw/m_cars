export class LocationService {
    static getPosition = (options?: PositionOptions): unknown => {
        return new Promise((resolve, reject) =>
            navigator.geolocation.getCurrentPosition(resolve, reject, options)
        );
    };
    static getRoute = (
        origin: { lat: number; lng: number },
        destination: { lat: number; lng: number },
        directionsRenderer: google.maps.DirectionsRenderer
    ): unknown => {
        return new Promise((resolve, reject) => {
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
        });
    };
}

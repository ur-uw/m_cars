export class LocationService {
    static getPosition = (options?: PositionOptions): unknown => {
        return new Promise((resolve, reject) =>
            navigator.geolocation.getCurrentPosition(resolve, reject, options)
        );
    };
}

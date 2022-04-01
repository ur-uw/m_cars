export class LocationService {
    static getPosition = (options?: PositionOptions) => {
        return new Promise((resolve, reject) =>
            navigator.geolocation.getCurrentPosition(resolve, reject, options)
        );
    };
}

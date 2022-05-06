/**
 * Haversine distance calculator
 * @param pos1 - Position 1
 * @param pos2 - Position 2
 * @returns  Distance between two positions
 * @description Get the distance between two points
 */
export const haversine_distance = (
    pos1: { lat: number; lng: number },
    pos2: { lat: number; lng: number }
) => {
    var R = 3958.8; // Radius of the Earth in miles (3958.8km) taken in miles to reduce calculation time
    var rlat1 = pos1.lat * (Math.PI / 180); // Convert degrees to radians
    var rlat2 = pos2.lat * (Math.PI / 180); // Convert degrees to radians
    var difflat = rlat2 - rlat1; // Radian difference (latitudes)
    var difflon = (pos2.lng - pos1.lng) * (Math.PI / 180); // Radian difference (longitudes)

    var d =
        2 *
        R *
        Math.asin(
            Math.sqrt(
                Math.sin(difflat / 2) * Math.sin(difflat / 2) +
                    Math.cos(rlat1) *
                        Math.cos(rlat2) *
                        Math.sin(difflon / 2) *
                        Math.sin(difflon / 2)
            )
        );
    return d;
};

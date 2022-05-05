export const haversine_distance = (
    mk1: google.maps.Marker,
    pos2: { lat: number; lng: number }
) => {
    if (mk1.getPosition() !== undefined) {
        var R = 3958.8; // Radius of the Earth in miles
        var rlat1 = mk1.getPosition()!.lat() * (Math.PI / 180); // Convert degrees to radians
        var rlat2 = pos2.lat * (Math.PI / 180); // Convert degrees to radians
        var difflat = rlat2 - rlat1; // Radian difference (latitudes)
        var difflon = (pos2.lng - mk1.getPosition()!.lng()) * (Math.PI / 180); // Radian difference (longitudes)

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
    }
    return 0;
};

// Euclidean distance

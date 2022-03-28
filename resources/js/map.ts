// Initialize and add the map
window.initMap = () => {
    // The location of Baghdad
    const baghdad = { lat: 33.312805, lng: 44.361488 };
    // The map, centered at baghdad
    const map = new google.maps.Map(
        document.getElementById("map") as HTMLElement,
        {
            zoom: 6,
            center: baghdad,
            fullscreenControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            mapId: "6e21f68e87eba133",
        }
    );

    // Get User location
    const geolocation = navigator.geolocation;
    if (geolocation) {
        geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                // The marker, positioned at user location
                const marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: "./assets/svg/current_pos.svg",
                });

                // Center map on user location
                map.setCenter(pos);
                map.setZoom(16);
            },
            () => {
                // Browser doesn't support Geolocation
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: Infinity,
            }
        );
    }
};

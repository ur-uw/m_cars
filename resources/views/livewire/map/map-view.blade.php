@section('styles')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: calc(100vh - (75px + 1rem));
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }

    </style>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection

<div id="map"></div>

@section('scripts')
    <script>
        const places = {!! json_encode($places->toArray()) !!};
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdfWSat-fHuct3Ba33AeqcHfyrvUUIzj8&callback=initMap">
    </script>
@endsection

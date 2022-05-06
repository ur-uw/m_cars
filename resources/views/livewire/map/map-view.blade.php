@section('page-title')
    Map
@endsection
@section('styles')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: calc(100vh - (75px + 1rem));
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }

        #floating-panel {
            line-height: 30px;
        }

    </style>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection
<div>
    <div id="floating-panel"
        class="absolute z-10 w-1/2 p-2 text-center bg-white rounded shadow-md left-1 top-24 lg:w-auto">
        <b>Mode of Travel: </b>
        <select id="mode">
            <option value="WALKING" selected>Walking</option>
            <option value="DRIVING">Driving</option>
        </select>
    </div>

    <div id="map"></div>
</div>

@section('scripts')
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}8&callback=initMap">
    </script>
@endsection

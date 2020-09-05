@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Map</div>

                <div class="panel-body">

                    {{-- Maps   --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map" style="width: 100%; height: 500px;"></div>
                        </div>

                    </div>



                    <p id="demo"></p>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function initialize() {


        var users = <?php use Illuminate\Support\Facades\Auth; echo json_encode($users); ?>;
        var loggedInUserLat = <?php echo json_encode(Auth::user()->latitude); ?>;
        var loggedInUserLon = <?php echo json_encode(Auth::user()->longitude); ?>;
        // console.log(users);
        //without jQuery
        var userSizeCount = 0
        for (x in users)
        {
            userSizeCount++;
        }



        const locations = [];

        var map_canvas = document.getElementById('map');
        var latlng = new google.maps.LatLng( loggedInUserLat, loggedInUserLon);

        //// Initialise the map
        var map_options = {
            center: latlng,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options)

        // Put all locations into array
        for (var key in users) {
            var value = users[key];

            locations.push(value.latitude);
            locations.push(value.longitude);


            var location = new google.maps.LatLng(value.latitude, value.longitude);
            var labels = value.name;
            labelIndex = 0;
            const contentString =
                '<div id="content">' +
                    value.name +
                "</div>";

            const infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: false,
                anchorPoint: new google.maps.Point(0, -29),
                label: labels[labelIndex++ % labels.length],
            });

        }


        console.log(locations);



    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection

<div id="map" style="width:100%;height:480px;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap " defer async></script>

<script type="text/javascript">
    function initialize() {

        let mapOptions = {
            zoom: 60,
            center: new google.maps.LatLng(-7.4302745, 109.199404),
            disableDefaultUI: false
        };

        var mapElement = document.getElementById('map');

        var map = new google.maps.Map(mapElement, mapOptions);

        setMarkers(map, officeLocations);

    }

    var officeLocations = [
        <?php
        $data = file_get_contents('http://localhost/maps/ambildata.php');
        $no = 1;
        if (json_decode($data, true)) {
            $obj = json_decode($data);
            foreach ($obj->results as $item) {
        ?>[<?php echo $item->id_wisata ?>, '<?php echo $item->nama_wisata ?>', '<?php echo $item->alamat ?>', <?php echo $item->longitude ?>, <?php echo $item->latitude ?>],
        <?php
            }
        }
        ?>
    ];

    function setMarkers(map, locations) {
        var globalPin = 'img/marker.png';

        for (var i = 0; i < locations.length; i++) {

            var office = locations[i];
            var myLatLng = new google.maps.LatLng(office[4], office[3]);
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h5 id="firstHeading" class="firstHeading">' + office[1] + '</h5>' +
                '<div id="bodyContent">' +
                '<a href=detail.php?id_wisata=' + office[0] + '>Info Detail</a>' +
                '</div>' +
                '</div>';

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: office[1],
                icon: 'img/markermap.png'
            });

            google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
        }
    }

    function getInfoCallback(map, content) {
        var infowindow = new google.maps.InfoWindow({
            content: content
        });
        return function() {
            infowindow.setContent(content);
            infowindow.open(map, this);
        };
    }

    initialize();
</script>
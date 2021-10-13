<?php 

$loactions = [];

   
$args = array(  
    'post_type' => 'marker',
 );

$loop = new WP_Query( $args ); 

while ( $loop->have_posts() ) : $loop->the_post(); 
    // echo get_the_title() . ' ' . get_field('latitude') . ' / ' . get_field('longitude'); 
    $loactions[] = [get_the_title(), get_the_content(), get_field('latitude'), get_field('longitude')];
endwhile;

wp_reset_postdata();

?>

<style>
    #map {
        height: 600px; 
        width: 100%; 
        background-color: grey;
    }
</style>
<div id="map" data-json="<?= htmlspecialchars(json_encode($loactions)) ?>"></div>
    <script type="text/javascript">
        let mapContainer = document.querySelector("#map");
        function initMap() {
            var center = {
                lat: 34.052235,
                lng: -118.243683,
            };
            var locations = JSON.parse(mapContainer.dataset.json);
            console.log(locations);
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 9,
                center: center,
            });

            var infowindow = new google.maps.InfoWindow({});
            var marker, count;
            for (count = 0; count < locations.length; count++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        locations[count][2],
                        locations[count][3]
                    ),
                    map: map,
                    title: locations[count][0],
                });

                google.maps.event.addListener(
                    marker,
                    "click",
                    (function(marker, count) {
                        return function() {
                            infowindow.setContent(locations[count][1]);
                            infowindow.open(map, marker);
                        };
                    })(marker, count)
                );
            }
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtkQHnhbFcYABEBesoqcpepp3IM3nMQQ0&callback=initMap"></script>
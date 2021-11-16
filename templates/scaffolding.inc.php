<?php 

// options
$loactions = [];
$maps_api = get_option('ormapker_google_maps_api', 'xxxxxxxxxxxxxxxx');
$map_center_lat = get_option('ormapker_centre_latitude', 41.067452);
$map_center_lng = get_option('ormapker_centre_longitude', -103.956911);
$map_zoom = get_option('ormapker_zoom', 1);
$default_icon = !empty(get_option('ormapker_marker_icon')) ? get_option('ormapker_marker_icon') : "https://img.icons8.com/office/40/000000/marker.png";
   
// Get ormapker records
$args = array(  
    'post_type' => 'ormapker_marker',
 );

$loop = new WP_Query( $args ); 

while ($loop->have_posts() ) : 
    $loop->the_post(); 
    $loactions[] = [get_the_title(), get_the_content(), get_post_meta(get_the_ID(), 'ormapker_marker_lat', true), get_post_meta(get_the_ID(), 'ormapker_marker_lng', true), (!empty(get_post_meta(get_the_ID(), 'ormapker_marker_icon', true)) ? get_post_meta(get_the_ID(), 'ormapker_marker_icon', true) : $default_icon)];
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
                lat: <?php echo $map_center_lat; ?>,
                lng: <?php echo $map_center_lng; ?>,
            };
            var locations = JSON.parse(mapContainer.dataset.json);
            console.log(locations);
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: <?php echo $map_zoom; ?>,
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
					icon: locations[count][4]
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

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $maps_api ?>&callback=initMap"></script>
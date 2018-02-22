<?php
    require_once("../../../global.php");
    header("Content-Type: text/javascript");
    global $config, $db, $w_user;
?>
var Maps = function()
{
    var $map;
    $DefaultLat = <?php echo $config->GoogleDefaultLat; ?>;
    $DefaultLon = <?php echo $config->GoogleDefaultLon; ?>;
    $DefaultZoom = <?php echo $config->GoogleDefaultZoom; ?>;

    var init_Map_Hybrid = function($div, $pick, $kml)
    {
        var $mapdiv = $('#'+$div)[0];

        jQuery('#'+$div).parent().append('<input type="hidden" id="_lat_'+$div+'" name="_lat_'+$div+'" value="0"><input type="hidden" id="_lng_'+$div+'" name="_lng_'+$div+'" value="0"><input type="hidden" id="_zom_'+$div+'" name="_zom_'+$div+'" value="0">');

        $map = new google.maps.Map($mapdiv,
        {
            center: {lat: $DefaultLat, lng: $DefaultLon},
            zoom: $DefaultZoom,
            fullscreenControl: true,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            zoomControlOptions:
            {
                position: google.maps.ControlPosition.TOP_LEFT
            }
        });

        if ($pick == true)
        {
            window.setTimeout(function(){
                $marker = new google.maps.Marker({
                    map: $map,
                    position: $map.getCenter(),
                    draggable: true,
                    title: 'Drag me to your location !',
                    animation:  google.maps.Animation.DROP
                });

                $marker.addListener('dragstart',function(){
                    $dragmeInfo.close();
                });
                $marker.addListener('drag',function(){
                    jQuery('#_lat_'+$div).val(this.getPosition().lat());
                    jQuery('#_lng_'+$div).val(this.getPosition().lng());
                    jQuery('#_zom_'+$div).val($map.getZoom());
                });
            },1000);
            window.setTimeout(function(){
                $dragmeInfo = new google.maps.InfoWindow({
                    content: '<i class="fa fa-map-marker push-10-r text-primary"></i>Drag me to your location !'
                });
                $dragmeInfo.open($map, $marker);
            },2000);
        }

        if ($kml == true)
        {    window.setTimeout(function(){
                $ManjungDistrict = new google.maps.KmlLayer({
                    url: '<?php echo URL_MEDIA;?>/maps/manjung.kml',
                    map: $map
                });
            },5000);
        }
        
    };

    return {
        Hybrid: function($div, $pick, $kml) {
            init_Map_Hybrid($div, $pick, $kml);
        }
    };
}();
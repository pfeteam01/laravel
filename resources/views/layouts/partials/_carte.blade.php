<div id="mapid" style="width: 200px; height: 200px;"></div>

<script type="text/javascript">
    //declaration de la map + son affichage aux bons coordonnées + un zoom par défaut
    var mymap = L.map('mapid').setView([36.752089156946326,3.065185546875], 13);
    //Integration de la tuile que on veut
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        id: 'mapbox.streets'
    }).addTo(mymap);
</script>

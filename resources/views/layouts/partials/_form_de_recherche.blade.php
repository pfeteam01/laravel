{{--Le script qui permet de gérer les évènements de ce formulaire est 'script_move.js'--}}
<div class="form-group">
    <input type="text" value="alger" class="form-control" id="recherche" placeholder="Rechercher une place" style="width: 350px;" ><br>
    <a id="rechercher-map" class="btn btn-success">Rechercher</a>
</div>
<div class="form-group">
    <input class="find" type="checkbox" id="vente" checked><label for="vente">Vente</label>
    <input class="find" type="checkbox" id="location" checked><label for="location">Location</label>
    <input class="find" type="checkbox" id="colocation" checked><label for="colocation">Colocation</label>
</div>
<div class="form-group">
    <input class="find" type="checkbox" id="appartement" checked><label for="appartement">Appartement</label>
    <input class="find" type="checkbox" id="maison" checked><label for="maison">Maison</label>
    <input class="find" type="checkbox" id="studio" checked><label for="studio">Studio</label>
    <input class="find" type="checkbox" id="terrain" checked><label for="terrain">Terrain</label>
    <input class="find" type="checkbox" id="garage" checked><label for="garage">Garage</label>
</div>
<div class="form-group">
    <label>Tout prix: </label><br><br>
    <label>Prix Min: </label>
    <select class="find" id="prixmin">
        <option value="pmin" selected>--Prix Min--</option>
        <option value="0">0 DA</option>
        <option value="100">100 DA</option>
        <option value="200">200 DA</option>
        <option value="300">300 DA</option>
        <option value="400">400 DA</option>
        <option value="500">500 DA</option>
        <option value="600">600 DA</option>
        <option value="700">700 DA</option>
        <option value="800">800 DA</option>
        <option value="900">900 DA</option>
        <option value="1000">1000 DA</option>
        <option value="1100">1100 DA</option>
        <option value="1200">1200 DA</option>
        <option value="1300">1300 DA</option>
    </select><br>
    <label>Prix Max: </label>
    <select class="find" id="prixmax">
        <option value="pmax" selected>--Prix Max--</option>
        <option value="100">100 DA</option>
        <option value="200">200 DA</option>
        <option value="300">300 DA</option>
        <option value="400">400 DA</option>
        <option value="500">500 DA</option>
        <option value="600">600 DA</option>
        <option value="700">700 DA</option>
        <option value="800">800 DA</option>
        <option value="900">900 DA</option>
        <option value="1000">1000 DA</option>
        <option value="1100">1100 DA</option>
        <option value="1200">1200 DA</option>
        <option value="1300">1300 DA</option>
        <option value="1400">1400 DA</option>
    </select>
</div>
<div class="form-group">
    <label>Tout loyer :</label><br><br>
    <label>Loyer Min: </label>
    <select class="find" id="loyermin">
        <option value="lmin" selected>--Loyer Min--</option>
        <option value="0">0 DA</option>
        <option value="100">100 DA</option>
        <option value="200">200 DA</option>
        <option value="300">300 DA</option>
        <option value="400">400 DA</option>
        <option value="500">500 DA</option>
        <option value="600">600 DA</option>
        <option value="700">700 DA</option>
        <option value="800">800 DA</option>
        <option value="900">900 DA</option>
        <option value="1000">1000 DA</option>
        <option value="1100">1100 DA</option>
        <option value="1200">1200 DA</option>
        <option value="1300">1300 DA</option>
    </select><br><br>
    <label>Loyer Max: </label>
    <select class="find" id="loyermax">
        <option value="lmax" selected>--Loyer Max--</option>
        <option value="100">100 DA</option>
        <option value="200">200 DA</option>
        <option value="300">300 DA</option>
        <option value="400">400 DA</option>
        <option value="500">500 DA</option>
        <option value="600">600 DA</option>
        <option value="700">700 DA</option>
        <option value="800">800 DA</option>
        <option value="900">900 DA</option>
        <option value="1000">1000 DA</option>
        <option value="1100">1100 DA</option>
        <option value="1200">1200 DA</option>
        <option value="1300">1300 DA</option>
        <option value="1400">1400 DA</option>
    </select>
</div>
<div class="form-group">
    <label>Nombres de pieces : </label><br>
    <input class="find" type="checkbox" id="one" checked><label for="one">1 piece</label>
    <input class="find" type="checkbox" id="two" checked><label for="two">2 pieces</label>
    <input class="find" type="checkbox" id="three" checked><label for="three">3 pieces</label>
    <input class="find"type="checkbox" id="four" checked><label for="four">4 pieces</label>
    <input class="find" type="checkbox" id="five" checked><label for="five">5 pieces</label><br>
    <input class="find" type="checkbox" id="six" checked><label for="six">6 pieces</label>
    <input class="find" type="checkbox" id="seven" checked><label for="seven">7 pieces</label>
    <input class="find" type="checkbox" id="eightandmore" checked><label for="eightandmore">8 pieces et +</label>
</div><br><br>
<div class="form-group">
    <label>Numero d'etage : </label><br>
    <input class="find" type="checkbox" id="oneetage" checked><label for="oneetage">1er etage</label>
    <input class="find" type="checkbox" id="twoetage" checked><label for="twoetage">2eme etage</label>
    <input class="find" type="checkbox" id="threeetage" checked><label for="threeetage">3eme etage</label>
    <input class="find" type="checkbox" id="fouretage" checked><label for="fouretage">4eme etage</label><br>
    <input class="find" type="checkbox" id="fiveetage" checked><label for="fiveetage">5eme etage</label>
    <input class="find" type="checkbox" id="sixetage" checked><label for="sixetage">6eme etage</label>
    <input class="find" type="checkbox" id="sevenetage" checked><label for="sevenetage">7eme etage</label><br>
    <input class="find" type="checkbox" id="eightandmoreetage" checked><label for="eightandmoreetage">8eme etage et +</label>
</div>
<div class="form-group">
    <label>Surface du bien :</label><br><br>
    <label>Surface Min: </label>
    <select class="find" id="surfacemin">
        <option value="smin" selected>--Surface Min--</option>
        <option value="0">0 m2</option>
        <option value="20">20 m2</option>
        <option value="25">25 m2</option>
        <option value="30">30 m2</option>
        <option value="35">35 m2</option>
        <option value="40">40 m2</option>
        <option value="50">50 m2</option>
        <option value="60">60 m2</option>
        <option value="70">70 m2</option>
        <option value="80">80 m2</option>
        <option value="90">90 m2</option>
        <option value="100">100 m2</option>
        <option value="110">110 m2</option>
        <option value="120">120 m2</option>
        <option value="130">130 m2</option>
        <option value="140">140 m2</option>
        <option value="150">150 m2</option>
        <option value="200">200 m2</option>
        <option value="300">300 m2</option>
        <option value="400">400 m2</option>
    </select><br><br>
    <label>Surface Max: </label>
    <select class="find" id="surfacemax">
        <option value="smax" selected>--Surface Max--</option>
        <option value="20">20 m2</option>
        <option value="25">25 m2</option>
        <option value="30">30 m2</option>
        <option value="35">35 m2</option>
        <option value="40">40 m2</option>
        <option value="50">50 m2</option>
        <option value="60">60 m2</option>
        <option value="70">70 m2</option>
        <option value="80">80 m2</option>
        <option value="90">90 m2</option>
        <option value="100">100 m2</option>
        <option value="110">110 m2</option>
        <option value="120">120 m2</option>
        <option value="130">130 m2</option>
        <option value="140">140 m2</option>
        <option value="150">150 m2</option>
        <option value="200">200 m2</option>
        <option value="300">300 m2</option>
        <option value="400">400 m2</option>
        <option value="500">500 m2</option>
    </select>
</div>
<div class="form-group">
    <label>Date de publication: </label>
    <select class="find" id="datedepublication">
        <option value="0" selected>Ajoutées aujourd'hui</option>
        <option value="3">Moins de 3 jours</option>
        <option value="7">Moins d'une semaine</option>
        <option value="30">Moins d'un mois</option>
        <option value="all" selected>Toutes les dates</option>
    </select>
</div>

<script>
    $('#rechercher-map').on('click',function () {
        alert("rrrr");
    });
</script>

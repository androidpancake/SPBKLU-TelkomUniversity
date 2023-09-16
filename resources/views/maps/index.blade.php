@extends('layouts.template')
@section('content')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection


<div id="map" class="w-full h-72"></div>

<div class="space-y-2 p-2 items-start h-full overflow-y-auto">
    <h1 class="font-semibold text-lg text-start">Station Terdekat</h1>
    @foreach($stations as $data)
        <div class="rounded-lg bg-white shadow border border-gray-200">
            <img src="{{ $data['image'] }}" class="rounded-t-lg" alt="">
            <div class="flex flex-col items-start w-full p-2">
                <div class="w-full p-2">
                    <h1 class="font-semibold text-lg flex-nowrap">{{ $data['name'] }}</h1>
                </div>
                <div class="inline-flex items-center space-x-2">
                    <a href="{{ $data['direction'] }}" class="p-2 bg-green-500 rounded-lg">
                        <div class="inline-flex space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,109.66l-48,48A8,8,0,0,1,168,152V112H128a88.1,88.1,0,0,0-88,88,8,8,0,0,1-16,0A104.11,104.11,0,0,1,128,96h40V56a8,8,0,0,1,13.66-5.66l48,48A8,8,0,0,1,229.66,109.66Z"></path></svg>
                            <p class="text-white text-sm font-semibold">Direction</p>
                        </div>
                    </a>
                    <button id="buttonpan {{$loop->index}}" class="block w-full bg-white border rounded-lg p-2 items-start hover:bg-gray-50">
                        <p class="font-medium text-start text-sm">Lokasi</p><p id="jarak {{$loop->index}}"></p>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
@push('map')
<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyAyK_5basxgKcbjrtrfCBLgRBhfHBKsmdM"});</script>
@endpush
@push('map-view')
<script>
    var stations = <?php echo json_encode($stations) ?>;
    console.log(stations);
        var lat = stations.map(function(station) {
            return station.lat;
        });
        // console.log(labels); 
        var long = stations.map(function(station) {
            return station.long;
            console.log(long);
        });

    let map;

    async function initMap() {
        // The location of Uluru
        var position = [];
        for(var obyek in stations){
            position.push({lat:parseFloat(stations[obyek].lat), lng:parseFloat(stations[obyek].long)});
        }
        console.log(position);
        // const position = { lat: parseFloat(lat), lng: parseFloat(long) };
        // Request needed libraries.
        //@ts-ignore
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
        const service = new google.maps.DistanceMatrixService();

        // The map, centered at Uluru
        map = new Map(document.getElementById("map"), {
            zoom: 19,
            center: position[0],
            mapId: "DEMO_MAP_ID",
        });
        var posisi = [];
        navigator.geolocation.getCurrentPosition(
        (positions) => {
          const pos = {
            lat: positions.coords.latitude,
            lng: positions.coords.longitude,
          };
        //   const request = {
        //     origins: [pos],
        //     destinations: position,
        //     travelMode: google.maps.TravelMode.DRIVING,
        //     unitSystem: google.maps.UnitSystem.METRIC,
        //     avoidHighways: false,
        //     avoidTolls: false,
        // };
        // console.log(request);
          map.setCenter(pos);
        //   service.getDistanceMatrix(request).then((response) => {
        //     console.log(response);
        //     for ( var i = 0; i < position.length; i++ ) (function(i){ 
        //         document.getElementById("jarak "+i).innerHTML = "jarak nya =";

        //     })(i);
        //   });
        },
        () => {
          handleLocationError(true,map.getCenter());
        }
      );

      for ( var i = 0; i < position.length; i++ ) (function(i){ 
        document.getElementById("buttonpan "+i).onclick =
        ()=>{
            map.setCenter(position[i]);
        };
        })(i);
        // document.getElementById("buttonpan 1").onclick =
        // ()=>{
        //     map.setCenter(position[1]);
        // };
        // The marker, positioned at Uluru
        for(var posisi in position){
                const marker = new AdvancedMarkerElement({
                map: map,
                position: position[posisi],
                title: "SPBKLU",
            });
        }

    }

    initMap();

</script>

@endpush

@endsection
<?php

class LocationHelper{

function getTimeZone($latitude,$longitude){


  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.geonames.org/timezoneJSON?lat=".$latitude."&lng=".$longitude."&username=fataelislami",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "postman-token: 1cd9ee0d-719e-1c64-2a13-24a038b8f783"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
$obj=json_decode($response);
  curl_close($curl);


  $datawaktu=explode(" ",$obj->time);
  $datatanggal=explode("-",$datawaktu[0]);
  $tanggal=$datawaktu[0];
  $datajam=$datawaktu[1];
  $tahun=$datatanggal[0];
  $bulan=$datatanggal[1];
  $hari=$datatanggal[2];
  $timezone=$obj->gmtOffset;
  $timezoneid=$obj->timezoneId;
  $negara=$obj->countryName;

  $arr = array($datajam,$tahun,$bulan,$tanggal,$hari,$timezone,$timezoneid,$negara);

  return $arr;

}

 function getCity($latitude,$longitude){
     $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=administrative_area_level_2&key=AIzaSyBMNYhWCm65MIgTPHGkfykIeGOSPRaNIyU";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
 }


}


 ?>

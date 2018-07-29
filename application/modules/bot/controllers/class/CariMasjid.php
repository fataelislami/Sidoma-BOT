<?php
require_once('MessageBuilder.php');
require_once('ClientAPI.php');
class CariMasjid{
    public function get($latitude,$longitude){//reply berupa slide
        $send=new MessageBuilder();
        $api = new ClientAPI();
        $url='https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$latitude.','.$longitude.'&rankby=distance&type=mosque&key=AIzaSyBEvEHXrYiiTlkSP54m-lBTglwa6lqv6DQ';
        $json=$api->get($url);
        $obj=json_decode($json);
        if($obj->status=='ZERO_RESULTS'){
            $pre=array($send->text("tidak ditemukan"));
             return $pre;
        }else{
              $total=count($obj->results);
              if($total>=10){
                  $total=10;
              }else{
                  $total=$total;
              }
              $slideArray=[];
              $limit=1;
              foreach($obj->results as $o){
                  $title    = $o->name;
                  $address  = $o->vicinity;
                  $lat      = $o->geometry->location->lat;
                  $long     = $o->geometry->location->lng;
                  $distance = $this->distance($latitude, $longitude, $lat, $long, "M");
                  $urlimage = 'https://islamify.id/imagebot/okemas.png';
                  $postdata = $lat . '#' . $long . '#' . $address;
                  $desc     = '🏁 Jarak '.round($distance,2).' Meter';
                  $button=array(array('type'=>'postback','label'=>'Tuju','data'=>substr(('goto#'.$postdata),0,299),'text'=>'otw ke '.$title));//Data dikirim berupa postback
                  $slide=$send->itemCarousel($urlimage,$title,$desc,$button);
                  array_push($slideArray,$slide);
                  if($limit==$total){
                      break;
                  }
                  $limit++;
              }
              $pre=array($send->carouselMessage("Cari Masjid!",$slideArray));
              return $pre;
        }
        
    }
    
   function getMasjidDonasi($latitude,$longitude){
       $send=new MessageBuilder();
        $api = new ClientAPI();
        $url="https://kostlab.id/bot/sidoma/dkm/json/terdekat?lat=$latitude&lng=$longitude";
        $json=$api->get($url);
        $obj=json_decode($json);
        if($obj->status=='ZERO_RESULTS'){
            $pre=array($send->text("tidak ditemukan"));
             return $pre;
        }else{
              $total=count($obj->results);
              if($total>=10){
                  $total=10;
              }else{
                  $total=$total;
              }
              $slideArray=[];
              $limit=1;
              foreach($obj->results as $o){
                  $title    = $o->nama;
                  $address  = $o->alamat;
                  $lat      = $o->latitude;
                  $long     = $o->longitude;
                  $distance = $this->distance($latitude, $longitude, $lat, $long, "M");
                  $urlimage = 'https://islamify.id/imagebot/okemas.png';
                  $postdata = $lat . '#' . $long . '#' . $address;
                  $desc     = '🏁 Jarak '.round($distance,2).' Meter';
                  $button=array(
                      array('type'=>'postback','label'=>'Tuju','data'=>substr(('goto#'.$postdata),0,299),'text'=>'otw ke '.$title),
                      array('type'=>'postback','label'=>'Donasi','data'=>'donasi#'.$o->id_masjid,'text'=>'id masjid'.$o->id_masjid)
                      );//Data dikirim berupa postback
                  $slide=$send->itemCarousel($urlimage,$title,$desc,$button);
                  array_push($slideArray,$slide);
                  if($limit==$total){
                      break;
                  }
                  $limit++;
              }
              $pre=array($send->carouselMessage("Cari Masjid!",$slideArray));
              return $pre;
        }
   }
   
    
   public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "M") {
        return ($miles * 1609.34);
    } else {
        return $miles;
    }
  }
}
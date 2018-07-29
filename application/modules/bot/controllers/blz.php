<?php


class Reply{

    function blz_text($replyToken,$text){
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(

                    'type' => 'text',
                    'text' => $text
                )

            )
        );
        return $balas;
    }

    function blz_audio($replyToken,$url){
      $balas = array(
          'replyToken' => $replyToken,
          'messages' => array(
            array(
              'type' => 'audio',
              'originalContentUrl' => $url,
              'duration' => 240000,
              )
          )
      );
      return $balas;
    }
    function blz_gambar($replyToken,$url){
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $url,
                    'previewImageUrl' =>$url
                )
            )
        );
        return $balas;
    }

    function blz_video($replyToken,$urlvideo,$urlimage){
      $balas = array(
          'replyToken' => $replyToken,
          'messages' => array(
              array(
                  'type' => 'image',
                  'originalContentUrl' => $urlvideo,
                  'previewImageUrl' =>$urlimage
              )
          )
      );
      return $balas;
    }

    function blz_lokasi($replyToken,$title,$address,$latitude,$longitude){
      $balas = array(
          'replyToken' => $replyToken,
          'messages' => array(
                array(
              'type' => 'location',
              'title' => $title,
              'address' => $address,
              'latitude' => $latitude,
              'longitude' => $longitude,
              )
          )
      );
      return $balas;
    }


}
?>

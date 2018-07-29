<?php

class MessageBuilder{
    //digunakan untuk membalas pesan dengan berbagai type
    //KostLab
    
    
    public function reply($replyToken,$array){//Fungsi utama
        $reply=array('replyToken'=>$replyToken,'messages'=>$array);
        return $reply;
    }
    
    public function text($string){
        $typeMessage=array(
                    'type' => 'text',
                    'text' => $string
                );
        return $typeMessage;
    }
    public function audio($url){
        $typeMessage=array(
              'type' => 'audio',
              'originalContentUrl' => $url,
              'duration' => 240000,
              );
        return $typeMessage;
    }
    
    public function image($url){
        $typeMessage=array(
                    'type' => 'image',
                    'originalContentUrl' => $url,
                    'previewImageUrl' =>$url
                );
        return $typeMessage;
    }
    
    public function video($urlVideo,$urlImage){
        $typeMessage=array(
                  'type' => 'video',
                  'originalContentUrl' => $urlVideo,
                  'previewImageUrl' =>$urlImage
              );
        return $typeMessage;
    }
    
    public function location($title,$address,$latitude,$longitude){
        $typeMessage=array(
              'type' => 'location',
              'title' => $title,
              'address' => $address,
              'latitude' => $latitude,
              'longitude' => $longitude,
              );
        return $typeMessage;
    }
    
    public function imagemap($baseUrl,$altText){
        $typeMessage=array(
                    'type' => 'imagemap',
                    'baseUrl' => $baseUrl,
                    'altText' => $altText,
                    'baseSize' =>
                    array (
                        'height' => 1040,
                        'width' => 1040,
                        ),
                        'actions' =>
                        array (
                            0 =>
                            array (
                                'type' => 'message',
                                'text' => '-',
                                'area' =>
                                array (
                                    'x' => 0,
                                    'y' => 0,
                                    'width' => 1,
                                    'height' => 1,
                                    ),
                                  ),
                               ),
                            );
      return $typeMessage;
    }
    
    public function imagemapurl($baseUrl,$altText,$url){
        $typeMessage=array(

                  'type' => 'imagemap',
                  'baseUrl' => $baseUrl,
                  'altText' => $altText,
                  'baseSize' =>
                  array (
                    'height' => 1040,
                    'width' => 1040,
                  ),
                  'actions' =>
                  array (
                    0 =>
                     array (
                      'type' => 'uri',
                      'linkUri' => $url,
                      'area' =>
                      array (
                        'x' => 0,
                        'y' => 0,
                        'width' => 1040,
                        'height' => 1040,
                      ),
                    ),
                    ),
                );
        return $typeMessage;
    }
    public function imagemaptext($baseUrl,$altText,$text){
        $typeMessage=array(

                  'type' => 'imagemap',
                  'baseUrl' => $baseUrl,
                  'altText' => $altText,
                  'baseSize' =>
                  array (
                    'height' => 1040,
                    'width' => 1040,
                  ),
                  'actions' =>
                  array (
                    0 =>
                     array (
                      'type' => 'message',
                      'text' => $text,
                      'area' =>
                      array (
                        'x' => 0,
                        'y' => 0,
                        'width' => 1040,
                        'height' => 1040,
                      ),
                    ),
                    ),
                );
        return $typeMessage;
    }
        
    
    
    ///Template Message nya LINE
    
    public function buttonMessage($imageUrl,$altText,$title,$text,$action){
        $typeMessage=array (
                  'type' => 'template',
                  'altText' => $altText,
                  'template' => 
                  array (
                    'type' => 'buttons',
                    'thumbnailImageUrl' => $imageUrl,
                    // 'imageAspectRatio' => 'rectangle',
                    // 'imageSize' => 'cover',
                    // 'imageBackgroundColor' => '#FFFFFF',
                    'title' => $title,
                    'text' => $text,
                    'actions' => $action,
                  ),
                );
        return $typeMessage;
    }
    
    public function confirmMessage($altText,$text,$action){
        $typeMessage=array (
              'type' => 'template',
              'altText' => $altText,
              'template' => 
              array (
                'type' => 'confirm',
                'text' => $text,
                'actions' => $action,
              ),
            );
        return $typeMessage;
    }
    //Carousel Message
    public function carouselMessage($altText,$columns){
        $typeMessage=array (
                  'type' => 'template',
                  'altText' => $altText,
                  'template' => 
                  array (
                    'type' => 'carousel',
                    'columns' => $columns,
                    // 'imageAspectRatio' => 'rectangle',
                    // 'imageSize' => 'cover',
                  ),
                );
        return $typeMessage;
    }
    
    public function itemCarousel($imgUrl,$title,$text,$buttons){
        $item=array (
                        'thumbnailImageUrl' => $imgUrl,
                        'title' => $title,
                        'text' => $text,
                        'actions' => $buttons,
                      );
        return $item;
    }
    //Carousel Message End
    //Image Carousel
    public function carouselImage($altText,$columns){
        $typeMessage=array (
  'type' => 'template',
  'altText' => $altText,
  'template' => 
  array (
    'type' => 'image_carousel',
    'columns' => $columns
    ,
  ),
);
return $typeMessage;
    }
    
    public function itemImage($imgUrl,$button){
        $item=
      array (
        'imageUrl' => $imgUrl,
        'action' => $button,
      );
      return $item;
    
    }
    //Image Carousel END
}
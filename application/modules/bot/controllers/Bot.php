<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('line_class.php');
require_once('class/MessageBuilder.php');
include 'blz.php';


class Bot extends MY_Controller {

	 /*
        WELCOME TO KOSTLAB X CODEIGNITER FRAMEWORK
        Framework inidibuat untuk memudahkan development chatbot LINE
        Coders : @kostlab @fataelislami


        Dokumentasi Fungsi
                                   function update($userid,$data,$to)
                                   function getdata($userid,$from)
                                   function insert($data,$to)

        Struktur Model
            DBS
        Struktur Controller
            Welcome

     */

	   public function __construct()
          {
            parent::__construct();
            //Codeigniter : Write Less Do More
			$this->load->model(array('Dbs'));


          }


	public function index()
	{


    $channelAccessToken = '6GvdYbSVMfqvt/K0KR4eBkAWlilkuMcznWlIwSRWLGbI7XwAJP/IS+O4I6RlfXPszT8WuQgbDfngcpAw8aa569o0cpZaMB1y2DvvbCn91CMvlp7vfFOMOGzuZtqHlT0KwbUgXsuXmy34lJvU6lC8uQdB04t89/1O/w1cDnyilFU='; //sesuaikan
    $channelSecret = '58ff99764ecdade5983c0ff07fe6819b';//sesuaikan

    $client = new LINEBotTiny($channelAccessToken, $channelSecret);
    $bls  = new Reply();
    $send= new MessageBuilder();

        $userId   = $client->parseEvents()[0]['source']['userId'];
        $groupId    = $client->parseEvents()[0]['source']['groupId'];
        $replyToken = $client->parseEvents()[0]['replyToken'];
        $timestamp  = $client->parseEvents()[0]['timestamp'];
        $message  = $client->parseEvents()[0]['message'];
        $messageid  = $client->parseEvents()[0]['message']['id'];
      $latitude=$client->parseEvents()[0]['message']['latitude'];
      $longitude=$client->parseEvents()[0]['message']['longitude'];
        $address=$client->parseEvents()[0]['message']['address'];
      $addresstitle=$client->parseEvents()[0]['message']['title'];
        $postback=$client->parseEvents() [0]['postback'];
        $profil = $client->profil($userId);
        $nama=$profil->displayName;
        $pesan_datang = $message['text'];
        $upPesan = strtoupper($pesan_datang);
        $pecahnama=explode(" ",$profil->displayName);
        $namapanggilan=$pecahnama[0];
        $event=$client->parseEvents() [0];

        $db = $this->Dbs->getdata($userId, 'donatur')->result();
        function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
        //Fungsi cek register

        //

            if ($event['type'] == 'follow')//Yang bot lakukan pertama kali saat di add oleh user
              {
              require_once('class/Register.php');
                $reg=new Register();
              $start=$reg->start($userId,$nama,$namapanggilan);
              $balas=$send->reply($replyToken,$start);

              }
              if ($event['type'] == 'unfollow')//Yang bot lakukan pertama kali saat di add oleh user
              {
              $this->db->where('userid', $userId);
              $this->db->delete('donatur');

              }

            // if ($event['type'] == 'join')
            //   {
						//
            //   }

          //MAPPING FITUR
          //MENU
              if ($upPesan == 'GET@MYID'){
              $pre=array($send->text($userId));
              $balas=$send->reply($replyToken,$pre);
          		}

            //MENU
          if($db[0]->flag=='carimasjid'){
              require_once('class/CariMasjid.php');
              $oMasjid=new CariMasjid();
              if($message['type']=='location'){
                 $data['flag']='default';
                 $sql=$this->Dbs->update($userId,$data,'donatur');
                 if($sql){
                 $pre=$oMasjid->get($latitude,$longitude);
                 $balas=$send->reply($replyToken,$pre);
                 }
              }
              if($message['type']=='text'){
                 $data['flag']='default';
                 $sql=$this->Dbs->update($userId,$data,'donatur');
                 if($sql){
                 //langsung lempar keyword
                 }
              }

              }
              
                      if($db[0]->flag=='carimasjid_donasi'){
              require_once('class/CariMasjid.php');
              $oMasjid=new CariMasjid();
              if($message['type']=='location'){
                 $data['flag']='default';
                 $sql=$this->Dbs->update($userId,$data,'donatur');
                 if($sql){
                 $pre=$oMasjid->getMasjidDonasi($latitude,$longitude);
                 $balas=$send->reply($replyToken,$pre);
                 }
              }
              if($message['type']=='text'){
                 $data['flag']='default';
                 $sql=$this->Dbs->update($userId,$data,'donatur');
                 if($sql){
                 //langsung lempar keyword
                 }
              }

              }

          //MAPPING FITUR
          if($db[0]->flag=='register' and $groupId==null){
              if (substr($postback['data'],0,6)=='gender' and $db[0]->counter==1){//Bertanya gender
                  $getpostdata=explode("#",$postback['data']);
                  $gender=$getpostdata[1];
                  $data=array('gender'=>$gender,'counter'=>$db[0]->counter+1);
                  $sql=$this->Dbs->update($userId,$data,'donatur');
                  if($sql){
                      if($gender=='male'){
                          $pre=array($send->text("kalo boleh tau umur kang ".$namapanggilan." sekarang berapa tahun nih?"));
                          $balas=$send->reply($replyToken,$pre);
                      }else{
                          $pre=array($send->text("kalo boleh tau umur teh ".$namapanggilan." sekarang berapa tahun nih?"));
                          $balas=$send->reply($replyToken,$pre);
                      }
                  }
              }else if($message['type']=='text' and $db[0]->counter==1){
                  $pre=array($send->text("eh kak ".$namapanggilan." itu jawab dulu pertanyaan SiDoMa BOT sebelum gunain bot ini"));
                  $balas=$send->reply($replyToken,$pre);
              }

              if($message['type']=='text' and $db[0]->counter==2){//untuk mengambil data tahun lahir
                 $age=preg_replace('/[^0-9]/', '', $pesan_datang);
                   $pre=date("Y")-$age;
                   $year=(int)$pre;
                   $data=array('tahun_lahir'=>$year,'counter'=>$db[0]->counter+1);
                   $sql=$this->Dbs->update($userId,$data,'donatur');
                   if($sql){
                       //https://islamify.id/iimap/tutorialshare
                       $arr=[];
                       $line1=$send->text("ohiya kak ".$namapanggilan.",langkah terakhir kirimkan lokasi ya! untuk penyesuaian fitur SiDoMa BOT");
                       $line2=$send->imagemapurl("https://islamify.id/dashboard/imagemap/mapfy/","Location Share!","line://nv/location");
                       array_push($arr,$line1,$line2);
                       $balas=$send->reply($replyToken,$arr);
                   }
              }

              if($message['type']=='location' and $db[0]->counter==3){
                  //OLAH DATA
                  require_once('class/LocationHelper.php');
                  $location=new LocationHelper();
                  $obj=json_decode($location->getCity($latitude,$longitude));
                  $city=$obj->results[0]->address_components[0]->short_name;
                  $getTimeZone=$location->getTimeZone($latitude,$longitude);
                  $timezone=$getTimeZone[5];
                  //OLAH DATA END
                  $data=array(
                      'kota'=>$city,
                      'latitude'=>$latitude,
                      'longitude'=>$longitude,
                      'counter'=>0,
                      'flag'=>'default'
                      );
                  $sql=$this->Dbs->update($userId,$data,'donatur');
                  if($sql){
                      $pre=array($send->text("Pendaftaran Berhasil,Selamat Menggunakan SiDoMa BOT!!"));
                      $balas=$send->reply($replyToken,$pre);
                  }

              }else if($message['type']=='text' and $db[0]->counter==3){
                 $pre=array($send->text("eh kak ".$namapanggilan." kirim lokasi dulu sebelum gunain SiDoMa bot ini"));
                 $balas=$send->reply($replyToken,$pre);
              }

          }
          else{

//FITUR CARI MASJID
            if ($upPesan == 'CARI MASJID'){
                require_once('class/Register.php');
                require_once('class/CariMasjid.php');
                $reg=new Register();
                $oMasjid=new CariMasjid();//mengaktifkan objek untuk class cari masjid
                if($groupId!=null){//Cek pesan jika keyword berasal dari grup
                   $pre=array($send->text("Fitur Cari Masjid hanya bisa digunakan di personal chat"));
                  $balas=$send->reply($replyToken,$pre);
                }else{
                   if($reg->check($userId)===TRUE){
                    $data['flag']='carimasjid';//Merubah flag dari default menjadi cari masjid dan di cek di line ke 154
                    $sql=$this->Dbs->update($userId,$data,'donatur');
                    if($sql){
                        $pre=[];
                        $line1=$send->text('hi kak '.$namapanggilan.' untuk mendapatkan masjid terdekat, kirimkan lokasi kakak sekarang ya!'."\r\nTap gambar dibawah ini!");
                        $line2=$send->imagemapurl("https://islamify.id/iimap/carimasjid/","Cari Masjid","line://nv/location");
                        array_push($pre,$line1,$line2);
                        $balas=$send->reply($replyToken,$pre);
                    }
                }else{
                    $pre=$reg->check($userId);//Return kedua dari fungsi check dilempar sebagai message
                  $balas=$send->reply($replyToken,$pre);
                }
                }

            }
            
            if ($upPesan == 'DONASI'){
                require_once('class/Register.php');
                require_once('class/CariMasjid.php');
                $reg=new Register();
                $oMasjid=new CariMasjid();//mengaktifkan objek untuk class cari masjid
                if($groupId!=null){//Cek pesan jika keyword berasal dari grup
                   $pre=array($send->text("Fitur Cari Masjid hanya bisa digunakan di personal chat"));
                  $balas=$send->reply($replyToken,$pre);
                }else{
                   if($reg->check($userId)===TRUE){
                    $data['flag']='carimasjid_donasi';//Merubah flag dari default menjadi cari masjid dan di cek di line ke 154
                    $sql=$this->Dbs->update($userId,$data,'donatur');
                    if($sql){
                        $pre=[];
                        $line1=$send->text('hi kak '.$namapanggilan.' untuk mendapatkan masjid terdekat, kirimkan lokasi kakak sekarang ya!'."\r\nTap gambar dibawah ini!");
                        $line2=$send->imagemapurl("https://islamify.id/iimap/carimasjid/","Cari Masjid","line://nv/location");
                        array_push($pre,$line1,$line2);
                        $balas=$send->reply($replyToken,$pre);
                    }
                }else{
                    $pre=$reg->check($userId);//Return kedua dari fungsi check dilempar sebagai message
                  $balas=$send->reply($replyToken,$pre);
                }
                }

            }
//FITUR CARI MASJID END


        //  if ($upPesan == 'TEST'){
        //      $pre=array($send->audio("https://islamify.id/botbeta/surat78.mp3"));
        //      $balas=$send->reply($replyToken,$pre);
        //  }


             // require_once('class/Register.php');
            //     $reg=new Register();
            //     if($groupId!=null){//Cek pesan jika keyword berasal dari grup
            //       $pre=array($send->text("Fitur Cari Masjid hanya bisa digunakan di personal chat"));
             //     $balas=$send->reply($replyToken,$pre);
            //     }else{
            //       if($reg->check($userId)===TRUE){
            //         //isi

            //     }else{
            //         $pre=$reg->check($userId);//Return kedua dari fungsi check dilempar sebagai message
             //     $balas=$send->reply($replyToken,$pre);
            //     }
            //     }

//POSTBACK UNTUK MENERIMA LOKASI
            if (substr($postback['data'],0,4)=='goto'){
                $getpostdata=explode("#",$postback['data']);
                $address=$getpostdata[3];
                $lat=$getpostdata[1];
                $long=$getpostdata[2];
                $pre=array($send->location("Tap untuk melihat lokasi",$address,$lat,$long));
                $balas=$send->reply($replyToken,$pre);
            }
//POSTBACK END
        }//END ELSE DARI PENGECEKAN DB FLAG




        $client->replyMessage($balas);


  }

  public function cekdb(){
    $get=$this->Dbs->getVideoKajian()->result();
    var_dump($get);

  }
}

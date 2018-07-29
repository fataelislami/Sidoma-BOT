<?php
require_once('MessageBuilder.php');

class Register extends Bot{
    public function __construct()
          {
            parent::__construct();
            //Codeigniter : Write Less Do More
			$this->load->model(array('Dbs'));
          }

    public function check($userId){
        $send=new MessageBuilder();
        $db=$this->Dbs->getdata($userId, 'donatur')->result();//variable dari controller bot
        if($db[0]->userid!=null){
            return true;
        }else{
            $arr=[];
            $button = array(array('type'=>'postback','label'=>'Register','data'=>'register'));
            $line1=$send->text("Kamu Belum Terdaftar,silahkan klik register untuk menggunakan bot");
            $line2=$send->buttonMessage("https://islamify.id/dashboard/xfile/images/register.png","Regist dulu kuy","Langsung aja cuy!","klik tombol register",$button);
            array_push($arr,$line1,$line2);
            return $arr;
        }
    }

    public function start($userId,$nama,$namapanggilan){
        $send=new MessageBuilder();
        $data=array(
        	        'userid'=>$userId,
        	        'nama'=>$nama,
        	        'flag'=>'register',
        	        'counter'=>1
        	        );
        	    $sql=$this->Dbs->insert($data,'donatur');
        	    if($sql){
        	        $arr=[];
        	        $slideArray=[];
        	        $button1=array(array('type'=>'postback','label'=>'Ya! Ikhwan','data'=>'gender#male'));//Data dikirim berupa postback
        	        $button2=array(array('type'=>'postback','label'=>'Aku Akhwat','data'=>'gender#female'));//Data dikirim berupa postback
                    $slide1=$send->itemCarousel("https://islamify.id/imagebot/ikhwan.jpg","Ikhwan","Ikhwan=Laki-Laki",$button1);
                    $slide2=$send->itemCarousel("https://islamify.id/imagebot/akhwat.jpg","Akhwat","Akhwat=Perempuan",$button2);
                    array_push($slideArray,$slide1,$slide2);
                    $line1=$send->text("hai kak ".$namapanggilan." kenalan dulu yuk! kakak ikhwan apa akhwat nih?");
        	        $line2=$send->carouselMessage("Kenalan",$slideArray);
        	        array_push($arr,$line1,$line2);
            	    return $arr;
        	    }

    }






}

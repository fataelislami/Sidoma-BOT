<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbs extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }


  function reset($target,$data){
      $this->db->get($target);
      $db=$this->db->update($target,$data);
      if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }
  //insert data ke tabel
  function insert($data,$to){
    $insert = $this->db->insert($to, $data);
    if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }

  //mengambil berdasarkan data userid
  function getdata($userid,$from){
    $this->db->where('userid', $userid);
    $db=$this->db->get($from);
    return $db;
  }

  function getorderdata($order_no){
    $this->db->where('order_no', $order_no);
    $db=$this->db->get('orders');
    return $db;
  }
  
   function masjidterdekat($kilo,$lat,$lng){
 $this->db->select("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance");
   $this->db->having('distance <= ' . $kilo);
   $this->db->order_by('distance');
   $this->db->limit(20, 0);
   $db=$this->db->get('masjid');
   return $db;
}


  //fungsi untuk mengambil lokasi terdekat berdasarkan longitude latitude di parameter
  function getdistance($kilo,$lat,$lng,$userid,$session1,$session2){
      $this->db->select("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( cur_lat ) ) * cos( radians( cur_long ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( cur_lat ) ) ) ) AS distance");
        $this->db->having('distance <= ' . $kilo);
        $this->db->order_by('distance');
        $this->db->limit(20, 0);
        $this->db->where('userid !=', $userid);
        $this->db->where('flag !=', $session1);
        $this->db->where('flag !=', $session2);
        $this->db->where('cur_order', null);
        $this->db->where('cur_help', null);
        $db=$this->db->get('donatur');
        return $db;
  }

  function getevent($kilo,$lat,$lng){
      $this->db->select("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance");
        $this->db->having('distance <= ' . $kilo);
        $this->db->order_by('distance');
        $this->db->limit(20, 0);
        $db=$this->db->get('event');
        return $db;
  }


  //fungsi untuk update field berdasarkan userid
  function update($userid,$data,$to){
    $this->db->where('userid',$userid);
    $db=$this->db->update($to,$data);
    if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }
  function updatewhere($where,$value,$data,$to){
     $this->db->where($where,$value);
    $db=$this->db->update($to,$data);
    if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }

  function getVideoKajian(){
        $this->db->limit(10);
        $this->db->order_by('id', 'DESC');
       return $this->db->get('videokajian');
  }

  ///NEW

    function updateVoucher($novoucher,$data){
    $this->db->where('novoucher',$novoucher);
    $this->db->where('used !=',1);
    $this->db->where('expire >=','CURDATE()',FALSE);
    $db=$this->db->update('voucher',$data);
    if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }

  function getvoucher($novoucher){
    $this->db->where('novoucher',$novoucher);
    $db=$this->db->get('voucher');
    return $db;
  }

  function deletepremium(){
   $sql = "DELETE `premium` FROM `premium`,`voucher` where premium.userid=voucher.userid and premium.novoucher=voucher.novoucher and voucher.expire<now()";
  $this->db->query($sql);

  }

  function cekpremium(){//mengecek user premium yang expire nya kurang dari tanggal hari ini
    $sql="SELECT premium.userid,premium.notify,voucher.expire FROM `premium`,`voucher` WHERE premium.userid=voucher.userid and premium.novoucher=voucher.novoucher and voucher.expire<now()";
    $query=$this->db->query($sql);
    return $query;
  }

  function getreminder($status){
    $this->db->where('status',$status);
    $this->db->where('power','on');
   $db=$this->db->get('pray_reminder');
   return $db;
  }

  //cekpremium
  function ispremium($userId){
    $this->db->where('userid',$userId);
    $count=$this->db->get('premium')->num_rows();
    if($count==0){
        return false;
    }else{
        return true;
    }

  }

}

 
<?php
class Login_m extends CI_Model{

public function inserttt($data){
  $this->db->insert("nes_stocks",$data);
    return $this->db->insert_id();
}
 public function register_fn($data){
  $this->db->insert("users",$data);
    return $this->db->insert_id();
}
 

public function get_uesr_data($phone_number,$pass){
     $this->db->select("*");
    $this->db->from("users");

  $this->db->where("phone_number",$phone_number);
    $this->db->where("password",$pass);
    $query=$this->db->get();
    return  $query->result();
 }

public function Suggetions($opn){
    $this->db->select("*");
    $this->db->from("nes_stocks");

  $this->db->like("Name",$opn);
    $query=$this->db->get();
    return  $query->result();

}


public function Get_details($dataid){
    $this->db->select("*");
    $this->db->from("nes_stocks");

  $this->db->where("id",$dataid);
    $query=$this->db->get();
    return  $query->result();

}





 }
?>
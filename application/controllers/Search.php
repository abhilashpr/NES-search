<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/libraries/ImplementJwt.php';
class Search extends CI_Controller { 
	function __construct() {
        parent::__construct();
         $this->objOfJwt = new ImplementJwt();
     $this->load->model("Login_m","",TRUE);
   $this->user=$this->session->userdata('self_loggedin');
		$this->load->helper('cookie');
    }	
  



public function Suggetions(){
    if(!empty($this->user)){
     $token=$this->getBearerToken();

      try
            {

 $jwtData = $this->objOfJwt->DecodeToken($token);


 

if($this->user['id']==$jwtData['userid']){

$opt= $this->input->post('opn');
if(!empty($opt)){
$res=$this->Login_m->Suggetions($opt); 
}else{
    $res=[]; 
}

  echo json_encode(array( "status" => true, "message" => "success","datas"=>$res));exit;  


}else{
  echo json_encode(array( "status" => false, "message" => "Invalid Token id","datas"=>""));exit;  
}



                 }
            
            catch (Exception $e)
            {
            
            echo json_encode(array( "status" => false, "message" => $e->getMessage(),"datas"=>""));exit;
            }


}else{
     echo json_encode(array( "status" => false, "message" => "Not Logged In","datas"=>""));exit;
}


}







public function Get_details(){
    if(!empty($this->user)){
     $token=$this->getBearerToken();

      try
            {

 $jwtData = $this->objOfJwt->DecodeToken($token);


 

if($this->user['id']==$jwtData['userid']){

$dataid= $this->input->post('dataid');
if(!empty($dataid)){
$res=$this->Login_m->Get_details($dataid); 
}else{
    $res=[]; 
}

  echo json_encode(array( "status" => true, "message" => "success","datas"=>$res));exit;  


}else{
  echo json_encode(array( "status" => false, "message" => "Invalid Token id","datas"=>""));exit;  
}



                 }
            
            catch (Exception $e)
            {
            
            echo json_encode(array( "status" => false, "message" => $e->getMessage(),"datas"=>""));exit;
            }


}else{
     echo json_encode(array( "status" => false, "message" => "Not Logged In","datas"=>""));exit;
}


}






  public function getBearerToken() {
            $headers = $this->getAuthorizationHeader();
           
            if (!empty($headers)) {
                if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                    return $matches[1];
                }
            }else{
                 echo json_encode(array( "status" => false, "message" => "Access Token Not found"));exit;
                
            }
            
        }



  public function GetTokenData()
    {
    $received_Token = $this->input->request_headers('Authorization');
        try
            {
            $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
            echo json_encode($jwtData);
            }
            catch (Exception $e)
            {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
            }
    } 




  function curl($url) 
{

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$data = curl_exec($ch);
//echo $data;exit();
curl_close($ch);
return $data;
}
 

 
  public function getAuthorizationHeader(){
            $headers = null;
            if (isset($_SERVER['Authorization'])) {
                $headers = trim($_SERVER["Authorization"]);
            }
            else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
                $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();
                // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
                $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
            return $headers;
        }
 












 } ?>
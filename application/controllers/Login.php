<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/libraries/ImplementJwt.php';
class Login extends CI_Controller { 
	function __construct() {
        parent::__construct();
         $this->objOfJwt = new ImplementJwt();
     $this->load->model("Login_m","",TRUE);
   $this->user=$this->session->userdata('self_loggedin');
		$this->load->helper('cookie');
    }	
  

  
public function index(){
if(!empty($this->user)){
redirect("Welcome");

}else{
   $data['error'] ="";
       $this->load->view("login",$data);
}
      
      


}


 
public function Register(){
if(!empty($this->user)){
redirect("Welcome");

}else{
   
       $this->load->view("Register");
}
      
      


}



public function register_fn(){
 $name = $this->input->post('user'); 
  $phone = $this->input->post('phone'); 
   $pass = $this->input->post('pass'); 

$data=array(
"name"=>$name,
"password"=>$pass,
"phone_number"=>$phone,
);

$dat=$this->Login_m->register_fn($data); 

if(!empty($dat)){
$tokenData['phone']=$phone;
            
             $tokenData['userid']=$dat;
              $jwtToken = $this->objOfJwt->GenerateToken($tokenData); 
  $session_array =array();
                 $session_array =array('id'=>$dat,
                                       'name'=>$name,
                                       'token'=>$jwtToken,
                                   
                                       );
                 $this->session->set_userdata('self_loggedin',$session_array);


            redirect("Welcome");

}else{
  echo "Something Wrong ";
}



}









public function process(){
 $phone = $this->input->post('phone');  
        $pass = $this->input->post('pass');  

$dat=$this->Login_m->get_uesr_data($phone,$pass); 


        if (!empty($dat))   
        {  
            $userid=$dat[0]->id;
          $tokenData['phone']=$phone;
            
             $tokenData['userid']=$userid;
              $jwtToken = $this->objOfJwt->GenerateToken($tokenData); 
            
            
           
 $session_array =array();
                 $session_array =array('id'=>$userid,
                                       'name'=>$dat[0]->name,
                                       'token'=>$jwtToken,
                                   
                                       );
                 $this->session->set_userdata('self_loggedin',$session_array);


            redirect("Welcome");
        }  
        else{  
            $data['error'] = 'Your Account is Invalid';  
            $this->load->view('login', $data);  
        } 
}


      public function logout()  
    {  
      
        $this->session->unset_userdata('self_loggedin');  
        redirect("Login");  
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
 




  
}  
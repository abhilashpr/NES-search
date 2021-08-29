<!DOCTYPE html>
<html>
<head>
	<title>Search Data</title>
	  <meta charset="UTF-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<section class="page-wrapper">
	<a style="text-align: right;" href="<?php echo base_url(); ?>Login/logout">Logout</a>
		<div class="container d-flex justify-content-center align-items-center">
			<div class="col-md-10 ">

				<div class="container d-flex justify-content-center align-items-center">
				<div class="col-md-8  mb-5">
			<div class="text-center">

				<h1>The easiest way to buy and sell stocks.</h1>
				<p>Stock analysis and screening tool for investors in india</p>
				<form class="form-inline box-input-card">

  <div class="input-group ">
  <input type="text" class="form-control border-none" onkeydown="cleardata()" placeholder="Search" onkeyup="search_options(this.value)" >

 <!-- <button class="btn btn-outline-primary" type="button">Search</button>-->
</div>

</form>
<ul class="search-view" id="search_res" style="display:none" >
  	
  	

  </ul>
  <span id="err_msg"></span>
			</div>
		</div>
	</div>
		<div class="container d-flex justify-content-center align-items-center" id="data_section" >
		<div class="col-md-11">
			<div class="box-card" id="res_data" style="display:none"  >
				<h5 id="title_display" ></h5>
				<table class="table-box table ">
  
  <tbody id="details_display" >
  
   
  </tbody>
</table>
			</div>
			
		</div>
	</div>
</div>
</section>






	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
	function search_options(opn){
		Data={'opn':opn}
	var token="<?php echo $token; ?>";
	$.ajax({

    type: "POST",
    url: "<?php echo base_url(); ?>Search/Suggetions",
    headers: {
        Authorization: 'Bearer ' + token
    },
    dataType: 'json',
    data:Data,
     beforeSend: function() {
       $("#search_res").empty();
     

    },
    success: function (data) {
       $("#search_res").show();
if(data.status==true){
  $("#search_res").empty();
if(data.datas.length!=0){

for(i=0;i<data.datas.length;i++){

var res="<li onclick='getdatas("+data.datas[i].id+")' >"+data.datas[i].Name+"</li>";
$("#search_res").append(res);
}


}




}else{
$("#err_msg").text(data.message);
$("#details_display").empty();

}



    },
   
});
	}
</script>
<script type="text/javascript">
	function getdatas(dataid){
$("#res_data").show();
	Data={'dataid':dataid}
	var token="<?php echo $token; ?>";
	$.ajax({

    type: "POST",
    url: "<?php echo base_url(); ?>Search/Get_details",
    headers: {
        Authorization: 'Bearer ' + token
    },
    dataType: 'json',
    data:Data,
     beforeSend: function() {
       $("#search_res").empty();
      $("#title_display").empty();  
       $("#search_res").hide();

       

    },
    success: function (data) {
       
if(data.status==true){
$("#title_display").text(data.datas[0].Name)

var res="<tr><td class='bg-green'>Market Cap<span class='text-danger'>"+data.datas[0].Market_Cap+"</span></td><td class='bg-green'>Dividend Yield<span class='text-danger'>"+data.datas[0].Dividend_Yield+"</span></td><td class='bg-green'>Debt to Equity<span class='text-danger'>"+data.datas[0].Debt_to_Equity+"</span></td></tr><tr><td class='bg-green'>Current Price<span class='text-danger'>"+data.datas[0].Current_Market_Price+"</span></td><td class='bg-green'>ROCE<span class='text-danger'>"+data.datas[0].ROCE+"</span></td><td class='bg-green'>EPS<span class='text-danger'>"+data.datas[0].EPS+"</span></td></tr><tr><td class='bg-green'>Stock P/E<span class='text-danger'>"+data.datas[0].Stock_P_E+"</span></td><td class='bg-green'>ROE<span class='text-danger'>"+data.datas[0].ROE_Previous_Annum+"</span></td><td class='bg-green'>Reserves<span class='text-danger'>"+data.datas[0].Reserves+"</span></td></tr><tr><td class='bg-green'>Debt<span class='text-danger'>"+data.datas[0].Debt+"</span></td></tr>";

$("#details_display").append(res);






}else{


}



    },
   
});






	}

</script>
<script type="text/javascript">
	function cleardata(){
		  $("#details_display").empty();
       $("#title_display").empty(); 
       $("#res_data").hide();

	}
</script>
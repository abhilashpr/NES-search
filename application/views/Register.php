<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
      <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<section class="page-wrapper">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-8 ">
                <div class="container d-flex justify-content-center align-items-center">
                <div class="col-md-8  mb-5">
            <div class="text-center">
                <h1>The easiest way to buy and sell stocks.</h1>
                <p>Stock analysis and screening tool for investors in india</p>
                  <form method="post" action="<?php echo base_url() ; ?>login/register_fn">   
<div class="loginform text-left">
  <div class="mb-3 ">
   
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control border-none box-input-card  border-none" name="user" placeholder="Name" required="" >
  </div>
<div class="mb-3 ">
   
    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
    <input type="number" class="form-control border-none box-input-card  border-none" name="phone" placeholder="phone" required="" >
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control box-input-card  border-none" name="pass" placeholder="Password">
  </div>
  <!--<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>-->
  <button type="submit" class="btn btn-primary">Register</button>
</div>
</form>
<a href="<?php echo base_url(); ?>login">Login</a>
            </div>
        </div>
    </div>
        
</div>
</section>















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
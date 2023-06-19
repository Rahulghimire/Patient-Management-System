<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <script type="text/javascript" src="../../assets/jquery-3.7.0.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <style>
    .form-control::placeholder {
    opacity: 0.5;
    }
    </style>
</head>

<body>
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="../../assets/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
              <?php
                $status = $this->session->flashdata('failed');
                if($status){
                    echo '<div class="alert alert-danger alert-dismissible fade show zindex" role="alert">' . $status . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>';
                }
            ?>
                <form action="<?php echo base_url()?>index.php/Login/checkLogin" method="post">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login into your account</h5>

                  <div class="form-outline mb-2">
                    <small class="text-danger"><?php echo form_error("name")?></small>
                    <input type="text" id="name" class="form-control form-control-lg" name="name" placeholder="John Doe" value=""/>
                    <label class="form-label" for="form2Example17">Enter Your Name</label>
                  </div>

                  <div class="form-outline mb-2">
                  <small class="text-danger"><?php echo form_error("email")?></small>
                    <input type="email" id="email" class="form-control form-control-lg" name="email" placeholder="example@gmail.com"/>
                    <label class="form-label" for="form2Example17">Email address</label>
                  </div>

                  <div class="form-outline mb-2">
                    <small class="text-danger"><?php echo form_error("password")?></small>
                    <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="**********"/>
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-2">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>

setTimeout(function() {
    $('.alert').alert('close');
  }, 1700);

  $('form').submit(function(event){

  var email=$('#email').val();
  var password=$('#password').val();

  if(email=="" || password==""){
    alert("fields are empty");
    event.preventDefault(); 
  }
});
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <!-- SweetAlert2-->
  <link rel="stylesheet" href="vendor/sweetalert2/sweetalert2.min.css">
  <script src="vendor/sweetalert2/sweetalert2.min.js"></script>
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <title>Login Page</title>
  <style>
    body {
      background-image: url("img/bglogin.png");
      background-size: cover;
    }

    #logo-bm {
      width: 155px;
      height: 66px;
      margin-left: 23px;
      margin-top: 15px;

    }

    .container {
      position: relative;
    }

    #btn-form {
      width: 230px;
      height: 70px;

      background: #FF3D00;
      box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
      border-radius: 12px;
    }

    .card {
      border-radius: 25px;
    }

    .form-control {
      height: 48px;
    }

    .lg-choice {
      margin: auto;
    }

    input[type='radio'] {
      accent-color: #232323;
    }
  </style>
</head>

<body>
  <img id="logo-bm" src="img/LOGO-BM.png" alt="">
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div style="margin-top: 50px;" class="card o-hidden border-0 shadow-lg">
          <div style="background-color: #D0161D;" class="card-body pt-5">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <h1 style="font-weight: bold;" class="h1 text-white text-center">LOGIN</h1>
                <div class="px-4 py-5">

                  <form id="form" class="user" action="includes/logincode.php" method="POST">
                    <input id="username" type="text" name="username" class="form-control mb-5" placeholder="username"
                      required>
                    <input id="password" type="password" name="password" class="form-control mb-4"
                      placeholder="Password" required>
                    <div id="lg-choice" class="form-group text-white mb-4">
                      <input type="radio" name="loginType" id="myRadio" value="dept">
                      <label class="form-check-label" for="1">
                        Departement
                      </label>
                      <input class="ml-5" type="radio" name="loginType" id="myRadio" value="adm">
                      <label class="form-check-label" for="0">
                        Admin
                      </label>
                    </div>
                    <div class="text-center"><button id="btn-form" type="submit" name="login_btn"
                        class="btn btn-danger btn-primary ">
                        Login </button></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


  <?php
include('includes/scripts.php'); 
?>

  <script>
    document.getElementById("myRadio").required = true;
    var username = document.getElementById("username");
    var password = document.getElementById("password");

    $(document).on('click', '#btn-form', function (e) {
      e.preventDefault();
      if (username.value != "" && password.value != "") {
        $.ajax({
          type: "POST",
          url: $(".user").attr('action'),
          data: $(".user").serialize(),
          success: function (data) {
            var validate = JSON.parse(data);
            if (validate.valid == "success")
              window.location.href = "/index.php";
            else
              Swal.fire({
                title: 'Gagal Login !',
                text: 'Username atau Password Salah!!',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: 'red'
              }
              );

          }
        });
      } else {
        Swal.fire({
          icon: 'error',
          text: 'Masukkan Username dan Password Anda!',
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
      };
    });
  </script>


</body>

</html>
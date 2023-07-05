<?php 
 
include 'koneksi.php';
 
session_start();
 

 
if (isset($_POST['login'])) {
    $username= $_POST['username'];
    $pass = $_POST['pass'];
 
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id_admin'];
        $_SESSION['role'] = $row['status'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['log'] = "Logged";

        if ($_SESSION['role'] == 'Admin') {
            header('location:admin/admin_home.php');
            echo "<script>alert('Masuk!')</script>";
        } else if ($_SESSION['role'] == 'Operator') {
            header('location:Kasir/kasir_home.php');
            echo "<script>alert('Masuk!')</script>";
        }  else {
        };
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event) {
            event.preventDefault();
            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
    </script>

    <title>Kerja Praktek</title>


</head>

<body style="background-image: url(assets/img/bg011.jpg); background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">



    <br>
    <div class="container" style="padding-top: 100px;">
        <div class="row">
            <div class="col-6"><br>

            </div>
            <div class="col-6" style="padding-top: 40px;">
                <div class="card" style="background-color: #fff0;border: 1px #fff0;color:white;">
                    <div class="card-body">
                        <h1>Login</h1><br>
                        <form method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="username"
                                    aria-describedby="emailHelp" placeholder="Username">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your username
                                    with anyone else.</small>
                            </div><br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="pass" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div><br>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>
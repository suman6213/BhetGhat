<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
    include 'dbcon.php';

    if (isset($_POST['register'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        $pass = password_hash($password, PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

        $emailquery = " SELECT * FROM user_table WHERE email = '$email' ";
        $query = mysqli_query($con, $emailquery);

        $emailcount = mysqli_num_rows($query);

        if ($emailcount > 0) {
            ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Email aready registered!",
                    });
                </script>
            <?php
        } else {
            if ($password === $cpassword) {
                $insertquery = "INSERT into user_table(username, email, pass, cpass) values('$username','$email','$pass','$cpass')";

                $iquery = mysqli_query($con, $insertquery);

                if ($iquery) {
            ?>
                    <script>
                        alert("Inserted Successfully");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("Not Inserted");
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Password are not matching");
                </script>
    <?php
            }
        }
    }
    ?>
    <!-- LOGIN FORM CONTAINER -->
    <?php

    include 'dbcon.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email_search = " SELECT * FROM user_table WHERE email = '$email' ";

        $query = mysqli_query($con, $email_search);

        $email_count = mysqli_num_rows($query);

        if ($email_count) {
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['pass'];

            $pass_decode = password_verify($password, $db_pass);

            if ($pass_decode) {
    ?>
                <script>
                    alert("Login Succesfully");
                </script>
            <?php
            } else {
            ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Incorrect Password",
                    });
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Invalid Email");
            </script>
    <?php
        }
    }
    ?>
    <div class="container">
        <div class="side-panel">
            <h2 class="logo">Bhet<span>Ghat</span> <sub>भेटघाट</sub></h2>
            <div class="panel-text">
                <h2>Welcome! <br><span>
                        To Our Website...
                    </span></h2>
                <p>The medium to connect millions of people.</p>
                <div class="social-icon">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="login-section">
            <div class="form-box login">
                <form action="" method="post">
                    <h2>Sign In</h2>
                    <div class="create-account">
                        <p>Create A New Account? <a href="#" class="register-link" id="register-link">Sign Up</a></p>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" placeholder=" " name="email" required autocomplete="off">
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='fas fa-lock'></i></span>
                        <input type="password" placeholder=" " name="password" class="password" required autocomplete="off">
                        <label>Password</label>
                        <i class='fas fa-eye toggle'></i>
                    </div>
                    <div class="remember-password">
                        <label for=""><input type="checkbox" required>Remember Me</label>
                        <a href="#">Forget Password?</a>
                    </div>
                    <button class="btn" name="login">Log In</button>
                </form>
            </div>

            <!-- Registration Form  -->

            <div class="form-box register">
                <form action="" method="post" autocomplete="off">

                    <h2>Sign Up</h2>

                    <div class="create-account">
                        <p>Already Have An Account? <a href="#" class="login-link" id="login-link">Sign In</a></p>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='fas fa-user'></i></span>
                        <input type="text" placeholder=" " name="username" autocomplete="off" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='fa-solid fa-envelope'></i></span>
                        <input type="email" placeholder=" " name="email" autocomplete="off" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='fas fa-lock'></i></span>
                        <input type="password" class="password" name="password" placeholder=" " autocomplete="off" required>
                        <label>Password</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='fas fa-lock'></i></span>
                        <input type="password" class="password" name="cpassword" placeholder=" " autocomplete="off" required>
                        <i class='fas fa-eye toggle'></i>
                        <label>Confirm Password</label>
                    </div>
                    <div class="remember-password">
                        <label for=""><input type="checkbox" required>I agree with the given <a href="">terms and condition</a></label>
                    </div>
                    <button class="btn" name="register">Register</button>
                </form>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
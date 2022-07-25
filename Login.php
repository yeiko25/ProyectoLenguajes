<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InnovaTech</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="shortcut icon" href="imgs/shop.png" />
    <link rel="stylesheet" href="css/Login.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body>

    <?php


if(isset($_POST["btnLogin"]))
{
    include 'User_login.php';
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $_login_verification = Verification_login($email,$pass);

    if($_login_verification > 0){
        
        $_SESSION['user'] = $email;
        header("location: index.php"); 
    }
    else
    {
        $_SESSION['user'] = null;
        echo ' <script type="text/javascript">
        $(document).ready(function() {  
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Sorry, Your email or password is incorrect, try again."
            }).then(function() {
            document.location.href = "/ProyectoLenguajes/Login.php";
            })});
        </script>';
    } 
}

if(isset($_POST["btnRegister"]))
{  
    include 'User_register.php';
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $surname2 = $_POST['surname2'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $_email_verification = EmailVER($email);
    $_user_verification= UserVER($user);
   
   

    if($_email_verification > 0){
 
        echo ' <script type="text/javascript">
        $(document).ready(function() {  
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "The email you entered already exists, please try another email."
            }).then(function() {
            document.location.href = "/ProyectoLenguajes/Login.php";
            })});
        </script>';
    }else if($_user_verification > 0){
        echo ' <script type="text/javascript">
        $(document).ready(function() {  
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "The user you entered already exists, please try another user."
            }).then(function() {
            document.location.href = "/ProyectoLenguajes/Login.php";
            })});
        </script>';      
    }else{
            registerUser();
            $link = ConnectDB();
            
            $query = "CALL REGISTRARUSUARIO('$name', '$surname', '$surname2', '$address', 
            '$email', '$user', '$pass')";
            
            $call = oci_parse($link, $query);
            oci_execute($call);
            
             echo ' <script type="text/javascript">
            $(document).ready(function() {  
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "User created successfully."
                }).then(function() {
                document.location.href = "/ProyectoLenguajes/index.php";
                })});
            </script>'; 
            
            CloseDB($link);
            
            return $call;
    

        }
    

}

?>

    <main>

        <div class="container_all">
            <div class="back_box">
                <div class="back_box-login">
                    <h3>You have already an account?</h3>
                    <p>Login to enter the page</p>
                    <button id="btn__sing_in">Sign In</button>
                </div>
                <div class="back_box-register">
                    <h3>Do not you have an account yet?</h3>
                    <p>Register to be able to login</p>
                    <button id="btn__register">Sign Up</button>
                </div>
            </div>

            <!--Form login and register-->
            <div class="container__login-register">
                <!--Login-->
                <form action="" method="POST" class="form__login">
                    <h2>Sign In</h2>
                    <input type="email" placeholder="Email" name='email' required>
                    <input type="password" placeholder="Password" name='pass' required>
                    <button type="submit" name="btnLogin">Sign in</button>
                </form>

                <!--Register-->
                <form action="" method="POST" class="form__register">
                    <h2>Sign Up</h2>
                    <input type="text" placeholder="Name" name="name" required>
                    <input type="text" placeholder="Surname" name="surname" required>
                    <input type="text" placeholder="Middle name" name="surname2" required>
                    <input type="text" placeholder="Address" name="address" required>
                    <input type="text" placeholder="User Name" name="user" required>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="pass" required>
                    <button type="submit" name="btnRegister">Sign Up</button>
                </form>

            </div>
        </div>
    </main>

    <script src="js/Login.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
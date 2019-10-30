<?php

include 'database_conection/connection_db.php';

$_SESSION["wrong_password"]="";

if (isset($_POST["btn_ingresar"])) {
    $login_username = $_POST["txtusername"];
    $login_password = $_POST["txtpassword"];
    $login_carnet = $_POST["txtcarnet"];

    $check_user_exist = "SELECT * FROM login WHERE user='$login_username' AND password='$login_password' AND n_carnet='$login_carnet' LIMIT 1 ";
    $run_query = mysqli_query($conn,$check_user_exist);
    $user_exist = mysqli_num_rows($run_query);
    if ($user_exist==1) {
        $get_user_details = "SELECT * FROM login WHERE user='$login_username' ";
        $run_get_details = mysqli_query($conn,$get_user_details);
        $get_details = mysqli_fetch_assoc($run_get_details);

        #cookies para mantener la sesion
        $user_password = $get_details["password"];
        $user_carnet = $get_details["n_carnet"];
        setcookie("user_n_carnet", $user_carnet,time() + (86400 * 30), "/");
        setcookie("password_user", $user_password,time() + (86400 * 30), "/");
        setcookie("user_name", $login_username, time(), + (86400 * 30), "/");
        

        header("Location:includes/home.php");
    }else {
        $_SESSION["wrong_password"]="Wrong Username or Password";
        $error_message ="No existe el Usuario o contraseña incorrecta";
        echo "<script>alert('$error_message')</script>";
    }
}

include 'Front_End/login.php';

?>

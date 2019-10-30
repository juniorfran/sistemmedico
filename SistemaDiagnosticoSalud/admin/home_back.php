<?php

include '../database_conection/connection_db.php' ;

$user_n = $_COOKIE["user_name"];
$user_p = $_COOKIE["password_user"];
$login_carnet = $_COOKIE["user_n_carnet"];

$mysql_check_carnet_assigned = "SELECT * FROM registro_usuarios WHERE n_carnet ='$login_carnet' LIMIT 1 ";
$execute_chec_carnet_assigned = mysqli_query($conn,$mysql_check_carnet_assigned);
$check_presence = mysqli_num_rows($execute_chec_carnet_assigned);

if ($check_presence == 1) {
    $get_entire_results = mysqli_fetch_array($execute_chec_carnet_assigned);

    $tipo_user = $get_entire_results["tipo_usuario"];
    $user_region_trabajo = $get_entire_results["region_trabajo"];
    $user_name = $get_entire_results["user_name"];

    if ($user_region_trabajo!="unassigned" && $user_name!="inassigned") {
        $contains_data = "true";

        $get_tipo_user_query = "SELECT * FROM user_lectura WHERE tipo_usuario_lectura='$tipo_user' AND user_name_lectura='$user_name' LIMIT 1";
        $execute_get_user = mysqli_query($conn,$get_tipo_user_query);
        $get_tipo_user_contact = mysqli_fetch_array($execute_get_user);
        $lectura_contacto = $get_tipo_user_contact["lectura_numero_contacto"];

        $assign_contact_user = "UPDATE `registro_usuarios` SET `numero_contacto` ='$lectura_contacto' WHERE `n_carnet` ='$login_carnet' ";
        $execute_assign_contact = mysqli_query($conn,$assign_contact_user);

    }else {
        $contains_data = "false";
    }
}else {
    $mysql_check_carnet_assigned = "SELECT * FROM registro_usuarios WHERE n_carnet ='$login_carnet' LIMIT 1 ";
$execute_chec_carnet_assigned = mysqli_query($conn,$mysql_check_carnet_assigned);
$check_presence = mysqli_num_rows($execute_chec_carnet_assigned);

if ($check_presence == 1) {
    $get_entire_results = mysqli_fetch_array($execute_chec_carnet_assigned);

    $tipo_user = $get_entire_results["tipo_usuario"];
    $user_region_trabajo = $get_entire_results["region_trabajo"];
    $user_name = $get_entire_results["user_name"];

    if ($user_region_trabajo!="unassigned" && $user_name!="inassigned") {
        $contains_data = "true";

        $get_tipo_user_query = "SELECT * FROM user_lectura WHERE tipo_usuario_lectura='$tipo_user' AND user_name_lectura='$user_name' LIMIT 1";
        $execute_get_user = mysqli_query($conn,$get_tipo_user_query);
        $get_tipo_user_contact = mysqli_fetch_array($execute_get_user);
        $lectura_contacto = $get_tipo_user_contact["lectura_numero_contacto"];

        $assign_contact_user = "UPDATE `registro_usuarios` SET `numero_contacto` ='$lectura_contacto' WHERE `n_carnet` ='$login_carnet' ";
        $execute_assign_contact = mysqli_query($conn,$assign_contact_user);

    }else {
        $contains_data = "false";
    }
}
}
?>
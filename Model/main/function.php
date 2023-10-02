<?php

// **********************************************mksave****************************************************************
// Function To Filter Data 
function mksave($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
}
// **********************************************row_count****************************************************************
function row_count ($sql){
    global $con;
    $stmt_row_count = $con->prepare("$sql");
    $stmt_row_count->execute(array());
    $row_count = $stmt_row_count->rowCount();
    return $row_count;
}
// **********************************************row_info****************************************************************
function row_info ($sql){
    global $con;
    $stmt_row_info = $con->prepare("$sql");
    $stmt_row_info->execute(array());
    $row_info = $stmt_row_info->fetch();
    return $row_info;
}
// **********************************************userinfo****************************************************************

if (isset($_SESSION['username'])) {
    $userid = $_SESSION['us_code'];
    $stmt_sisson_user = $con->prepare("SELECT * FROM `users` WHERE `us_code`=?");
    $stmt_sisson_user->execute(array($userid));
    $user_session_info = $stmt_sisson_user->fetch();
}
// **********************************************set_info****************************************************************
// if (isset($_SESSION['us_id'])) {
    $userid = "admin";
    $stmt_sisson_set = $con->prepare("SELECT * FROM `setting` WHERE `set_us_username`=?");
    $stmt_sisson_set->execute(array($userid));
    $set_info = $stmt_sisson_set->fetch();
// }
// **************************************************Get All ************************************************************
function get_all ($sql){
    global $con;
    $get_all_info = $con->prepare("$sql");
    $get_all_info->execute(array());
    $get_all_fetch = $get_all_info->fetchAll();
    return $get_all_fetch;
}
// **************************************************delete************************************************************
function delete ($sql){
    global $con;
    $delete = $con->prepare("$sql");
    $result_delete = $delete->execute(array());
    return $result_delete;
}
// **************************************************Get name by code ************************************************************
function get_name_by_id ($table="",$field="",$code="",$data=""){
    global $con;
    $get_name_by_code = $con->prepare("SELECT * FROM `$table` WHERE `$field` = '$code'");
    $get_name_by_code->execute(array());
    $get_name_by_code_info = $get_name_by_code->fetch();
    return $get_name_by_code_info[$data];
    // echo  $un_name = get_name_by_id("units","un_id",$it_un['un_id'],"un_name");
}
// **************************************************Get max ************************************************************
function max_code($max_code="",$table=""){
    global $con;
    $stmt_max_code = $con->prepare("SELECT $max_code FROM $table ");
    $stmt_max_code->execute(array());
    $max_info = $stmt_max_code->fetch();
    $cont = $max_info[$max_code];
    if ($cont>0) {
        $max_code_info =    $cont+1;
    } else {
        $max_code_info = 1;
    }
    return  $max_code_info;
}

?>
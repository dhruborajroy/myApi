<?php
require("inc/connection.inc.php");
require("token.php");
if(!isset($status) && isset($_POST['id']) && $_POST['id']>0){
    $id=get_safe_value($_POST['id']);
    mysqli_query($con,"delete from data where id='$id'");
    $data=array(
        'data' => 'Data deleted',
        'code' => '200',
    );
}
echo json_encode([$data]);
<?php
session_start();
require("inc/connection.inc.php");
include("inc/function.inc.php");
header('Access-Control-Allow-Origin: *');
header("Content-type:application/json; charset=utf-8");
$data=array();
if(isset($_POST['store_id']) && isset($_POST['store_password'])){
    $store_id=trim(get_safe_value($_POST['store_id']));
    $store_password=get_safe_value($_POST['store_password']);
    $sql="select * from api_user where store_id='$store_id' and store_password='$store_password'";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        if($row['status']==1){
            if($row['hit_count']>=$row['hit_limit']){
                $status="true";
                $data=array(
                    "data"=>"hit limit excid",
                );
            }else{
                mysqli_query($con,"update api_user set hit_count=hit_count+1 where store_id='$store_id' and store_password='$store_password'");
            }
        }else{
            $status="true";
            $data=array(
                "data"=>"api token deactivated",
            );
        }
    }else{
        $status="true";
        $data=array(
            "data"=>"your provide valid api token ",
        );
    }
}else{
    $status="true";
    $data=array(
        "data"=>"Please provide store id & password",
    );
}
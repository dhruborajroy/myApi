<?php
require("inc/connection.inc.php");
require("token.php");
if(!isset($status)){
    $data=array(
        'data' => 'welcome',
    );
}
echo json_encode(['status'=>$status,$data]);
die;
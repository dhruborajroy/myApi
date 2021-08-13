
<?php/*
$link = mysqli_connect('localhost', 'root', '');
$id=5;
mysqli_query($link,"delete from data where id='$id'");
printf("Records deleted: %d\n", mysqli_affected_rows($link));

mysqli_query($link,"delete from data where id='$id'");
printf("Records deleted: %d\n", mysqli_affected_rows($link));
die;
?>

<?php
require("inc/connection.inc.php");
require("token.php");
if(!isset($status) && isset($_POST['id']) && $_POST['id']>0){
	$id=get_safe_value($_POST['id']);
    mysqli_query($con,"delete from data where id='$id'");
    $data=array(
        'data' => 'Data deleted',
    );
}
echo json_encode([$data]);

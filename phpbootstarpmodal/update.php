<?php

include 'connect.php';


if(isset($_POST['updateid'])){
    $user_id=$_POST['updateid'];
    $sql="Select * from `crud` where id=$user_id";
    $result=mysqli_query($con,$sql);
    $response=array();
    while($row=mysqli_fetch_assoc($result)){
        $response=$row;
    }
    echo json_encode($response);


}else{
    $response['status']=200;
    $response['message']="invalid or data not found";
}

//update querry 

if(isset($_POST['hiddendata'])){
    $uniqueid=$_POST['hiddendata'];
    $name=$_POST['updatename'];
    $email=$_POST['updateemail'];
    $moblie=$_POST['updatemobile'];
    $place=$_POST['updateplace'];

    $sql="UPDATE `crud` SET  `name`='$name',email='$email',mobile='$moblie',place='$place' where id=$uniqueid";
    $result=mysqli_query($con,$sql);




}

?>
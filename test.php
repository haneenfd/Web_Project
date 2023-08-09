<?php
 function islog($con){
    if(isset($_SESSION['name'])){
       $name=$_SESSION['name'];
       $stm="SELECT * from user where name='$name'";
       $sel=$con->query($stm);
       $arr=$sel->fetch();
       return $arr;
       
    }
    else header("location: login.php");

 }
 function isuser($data){
    if($data['type']=='policeman')
    header("location: login.php");


 }
 function ispolice($data){
   if($data['type']=='Driver')
   header("location: login.php");


}
function isAdmin($data){
   if($data['user_id']!='102')
   header("location: login.php");
  


}




?>
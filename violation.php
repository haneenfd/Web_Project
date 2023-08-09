<?php 
session_start();

include("test.php");
$servername="localhost";
$username="root";
$password="";
$dbname="violation";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

$data=islog($conn);


        $carid=$cartype=$date=$place=$int=$name=$viol="";
        
        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        
            $carid=$cartype=$date=$place=$int=$name=$viol="";

            $name=test_input($_POST["name"]);
            $carid=test_input($_POST["carid"]);
            $cartype=test_input($_POST["cartype"]);
            $viol=test_input($_POST["viol"]);
            $place=test_input($_POST["place"]);
            $int=test_input($_POST["int"]);
            $date=date("d/m/y");



            $servername="localhost";
            $username="root";
            $password="";
            $dbname="violation";
            try {
                    
                    
                    $userid=$data['user_id'];
                    $sel="SELECT Name,policeid from policeman where Name='$name' and policeid='$userid'";
                    $selc="SELECT carid,type from user where carid='$carid' and type='Driver'";
                    $stm=$conn->query($sel);
                    $stmc=$conn->query($selc);
                    $arr=$stm->fetch();
                    $arrc=$stmc->fetch();
                    if(!empty($arr)){
                        if(!empty($arrc)){
                            $ins="INSERT INTO `violations`( `carid`, `cartype`, `date`, `place`, `fine`, `policeId`, `viol`) VALUES ('$carid','$cartype','$date','$place','$int','$name','$viol')";
                            $conn->exec($ins);
                            $carid=$cartype=$date=$place=$int=$name=$viol="";
                            echo "<script>window.alert('editted succesfully')</script>";
                            header("location :policeman.php");

                        }
                        else 
                        echo "<script>window.alert('Plese Check Car id')</script>";
                        
                    }else 
                     echo "<script>window.alert('Plese Check Police name')</script>";
                    
                
                

                    
                   
                  




                }catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                  }
        

        ?>
<!DOCTYPE html>
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
ispolice($data);

?>
<?php 
        $carid=$cartype=$date=$place=$int=$name=$viol="";
        
        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
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
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
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
                            
                            header("location: editViolation.php");
                           

                        }
                        else 
                        echo "<script>window.alert('Car is not exist please chick')</script>";
                        
                    }else 
                     echo "<script>window.alert('Plese Check Police name')</script>";
                    
                
                

                    
                   
                  




                }catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                  }
        }

        ?>
<html>
    <head>
        <title>edit violation</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <style>
           
                
            div.back{
                position: relative;
            }
            div.labell{
                display: inline;
                width: 120px;
            }
            div.test{
                width: 45%;
            }
            .test1  {
                padding:0%;

                background-image: url(image/index.jpg);
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                
                
            }
            .test1 > div{
                
                position: relative;
                padding: 4%;
                height: 100%;
                width:100%;
                background-color: rgb(227, 253, 253,.5);

            }
            input,#da{

                opacity: 1;
                border-style: solid;
                border-width:2px;
                border-radius: 5px;
                border-color: rgb(26, 125, 134);
                margin-left: 2px;
                background-color: white;
                height: 33px;

                width: 50%;
                }
                #da{
                    font-size: 110%;
                }
                .form-div{

                    
                   
                    border-radius: 5px;
                    width: 50%;
                   
                    
                }

                .input span{
                    color:rgb(1, 22, 24); ;
                }

                .submit{
                    color: white;
                background-color: #1a7d86;
                width: 50%;
                font-family: "Times New Roman", Times, serif;
            }
            #confirm{
                display: none;
                
                text-align: center;
                padding: 3%;
                padding-top: 8%;
                border: 5px #1a7d86 solid;
                
                background-color: rgb(255, 255, 255,.8);
                border-radius: 15px;
                position: absolute;
                left: 50%;
                height: 35%;
                top:22%;
            }
            #confirm button{
                color: white;
                background-color: #1a7d86;
                border: none;
            }
                    #user{
            font-size: 150%;
            position: relative;
            left: 26%;
        }
        </style>
        <script>
            
           
            function validate(){
               
                var carid=document.forms["violation"]["carid"].value;               
                var type=document.forms["violation"]["cartype"].value;          
                var viol= document.forms["violation"]["viol"].value;
                var place=document.forms["violation"]["place"].value;
                var fine=document.forms["violation"]["int"].value;
                var name=document.forms["violation"]["name"].value;
      
                if(type==""||/[0-9 ]/.test(type)){
                
                window.alert("Car Type must contain only letters without spaces");
                return false;
            }
            
            if(viol==""||/[0-9]/.test(viol)){
                window.alert("violation must contain only letters ");
                return false;
                
            }
            
                if(place==" "||/[0-9 ]/.test(place)){
                    window.alert("place must contain only letters ");
                return false;
            }
            if(fine==" "||/[a-z A-Z]/.test(fine)){
                window.alert("fine must contain only numbers");
                return false;
                
                
            }
            return true;
            }
        
        
        </script>

        

    </head>
    <body>
        <div class="horizantal">
            <span class="img-sp"> <img class="icon" src="image/logo.png"> </span>
            <div class="p-sp"> <span id="p1"><p class="icon">الشرطة الفلسطينية</p></span>
            <span id="p2">  <p class="icon">Palestinian Police</p></span></div>
        </div>
        <div class="block">
            <div id="in_block">
            <div class="userim"><img class="userim" width="30%" src="<?php echo$data['image']?>"></div>
                <p id="user"> <?php echo $data['name']?></p>
            </div>
            <div id="li">
                <ul>
                    <li><a href="policeman.php">Home Page</a></li>
                    <li><a href="#">Edit Violation</a></li>
                    <li><a href="trafficViolation.php">Traffic Violations</a></li>
                    <li><a href="#" >Edit Profile</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>

        </div>
        <div class="test1">           
            <div>

                <div class="form-div">
                    <form  id="f"  name="violation" onsubmit="return validate()" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" >
                        <div class="input">
                            <span>CAR ID</span>
                            <br>
                            <input required name="carid" value="<?php echo $carid ?>" type="text">
                        </div>
                        <div  class="input">
                            <span>CAR TYPE</span>
                            <br>
                            <input required name="cartype" value="<?php echo $cartype ?>" type="text">
                        </div>
                        <div class="input">
                            <span>DATE</span>
                            <br>
                            <p id="da"><?php echo date("d/m/y")?></p>
                        </div>
                    
                        <div class="input">
                            <span>VIOLATION</span>
                            <br>
                            <input required name="viol" value="<?php echo $viol ?>" type="text">
                        </div>
                        <div class="input">
                            <span>PLACE</span>
                            <br>
                            <input required name="place" value="<?php echo $place ?>" type="text">
                        </div>
                        <div class="input">
                            <span>FINE AMOUNT</span>
                            <br>
                            <input required name="int" value="<?php echo $int ?>" type="text">
                        </div>
                        <div class="input">
                            <span>POLICEMAN NAME</span>
                            <br>
                            <input required name="name" value="<?php echo $name ?>" type="text">
                        </div>
                        <div>
                            <br>
                            <input class="submit" type="submit" value="SAVE" ">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>


    </body>
</html>
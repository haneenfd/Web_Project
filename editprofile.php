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

$typ=$data["type"];

if($typ=="Driver"){
$linkh="user.php";
$linkv="viewViolations.php";
$vio="View Violation";
}
else if($typ=="policeman"){
    $linkh="policeman.php";
$linkv="editViolation.php";
$vio="Edit Violation";
}


?>
<!DOCTYPE html>
<html>
    <head>
       
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link href="css/style.css" rel="stylesheet">
            <script src="javaScript/user.js"></script>
            <style>
                input{

                opacity: 1;
                border-style: solid;
                border-width:2px;
                border-radius: 5px;
                border-color: rgb(26, 125, 134);
                margin-left: 2px;
                background-color: white;
                height: 33px;
                display: block;
                margin: 4%;
                width: 30%;
                }
                #sub{
                    background-color: rgb(26, 125, 134);

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

            </style>

            <?php
            $id=$data["carid"];

            function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $name=test_input($_POST["name"]);                
                $phone=test_input($_POST["phone"]);
                $pass=test_input($_POST["pass"]);
                $type=$data["type"];
                
                if($type=="Driver"){if($phone!=""){
                    $stm="UPDATE `user` SET `phone`='$phone' WHERE carid='$id'";
                    $conn->exec($stm);

                }
                if($pass!=""){
                    $stm="UPDATE `user` SET `password`='$pass' WHERE carid='$id'";
                    $conn->exec($stm);
                }
                
                $seln="SELECT name from user where name='$name'";
                    $stmn=$conn->query($seln);
                    $arrn=$stmn->fetch();
                     if($name!=""&&empty($arrn)){
                    $name=test_input($_POST["name"]);
                    $stm="UPDATE `user` SET `name`='$name' WHERE carid='$id'";
                    $conn->exec($stm);

                }  
                 else  echo "<script>window.alert('User Name is taken')</script>";
                    
                    if( is_uploaded_file($_FILES['photo']['tmp_name'])){
                        $img_dir="upload/".$_FILES['photo']['name'];                           
                        $img_tmp=$_FILES['photo']['tmp_name'];    
                        move_uploaded_file($img_tmp,$img_dir);
                        $img=$img_dir;
                        $stm="UPDATE `user` SET `image`='$img' WHERE carid='$id'";
                         $conn->exec($stm);

    
                    }}
                    else{
                        $id=$data["user_id"];
                        if($phone!=""){
                            $stm="UPDATE `user` SET `phone`='$phone' WHERE user_id='$id'";
                            $conn->exec($stm);
        
                        }
                        if($pass!=""){
                            $stm="UPDATE `user` SET `password`='$pass' WHERE user_id='$id'";
                            $conn->exec($stm);
                        }
                        
                        $seln="SELECT name from user where name='$name'";
                            $stmn=$conn->query($seln);
                            $arrn=$stmn->fetch();
                             if($name!=""&&empty($arrn)){
                            $name=test_input($_POST["name"]);
                            $stm="UPDATE `user` SET `name`='$name' WHERE user_id='$id'";
                            $conn->exec($stm);
        
                        }  
                         else  echo "<script>window.alert('User Name is taken')</script>";
                            
                            if( is_uploaded_file($_FILES['photo']['tmp_name'])){
                             
                                $img_dir="upload/".$_FILES['photo']['name'];                           
                                $img_tmp=$_FILES['photo']['tmp_name'];    
                                move_uploaded_file($img_tmp,$img_dir);
                                $img=$img_dir;
                                $stm="UPDATE `user` SET `image`='$img' WHERE user_id='$id'";
                                 $conn->exec($stm);
        
            
                            }

                    }
   
            
            header("location:login.php");
            }
            
            ?>
           
    
          
    
    
        
    
        </heaad>
    
    <body>
        <div class="horizantal">
            <span class="img-sp"> <img class="icon" src="image/logo.png"> </span>
            <div class="p-sp"> <span id="p1"><p class="icon">الشرطة الفلسطينية</p></span>
            <span id="p2">  <p class="icon">Palestinian Police</p></span></div>
        </div>
        <div class="block">
            <div id="in_block">
            <div class="userim"><img class="userim" width="30%" src="<?php echo$data['image']?>"></div>
                <p id="user"> <?php echo $data['name']?></p></div>
            
            <div id="li">
                <ul>
                    <li><a href="<?php echo $linkh?>">Home Page</a></li>
                    <li><a href="<?php echo $linkv?>"><?php echo $vio?></a></li>
                    <li><a href="trafficViolation.php">Traffic Violations</a></li>
                    <li><a href="#" >Edit Profile</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>

        </div>
        <script>
        function validateForm(){
            var name=document.forms["signup"]["name"].value;
            var pass=document.forms["signup"]["pass"].value;
            var repass=document.forms["signup"]["repass"].value;
            var phone=document.forms["signup"]["phone"].value;
            
            if(name!=""(name.length<=5||name.length>=20)){
                window.alert("user name must have more than 5  characters and less than 20 characters ");
                return false;

            }
            if(pass!=""&&pass.length<8){
                window.alert("password is too short must be more than 8 characters") 
                return false;
            }
            if(pass!=""&&pass!=repass){
                window.alert("mismatches password");
                return false;

            }
            if(phone!=""&&phone.length!=10){
                window.alert("phone number is only 10 digit");
                return false;

            }
            
            if(phone!=""&&/[A-Z a-z]/.test(phone)){
                window.alert("phone number must contain only numbers");
                return false;
            }
            if(name!=""&&/[ ]/.test(name)){
                window.alert("user name must have no spaces");
                return false;
            }

            
            return true;
        }
    </script>


        <div class="test1">
            <div>
          
            <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="signup" onsubmit="return validateForm()">

                <input type="text" placeholder="USER_NAME" name="name">
                <input type="password" placeholder="PASSWORD" name="pass">
                <input type="password" placeholder="RE-PASSWORD" name="repass">
                <input type="text" placeholder="PHONE_NUMBER" name="phone">
                <input type="file" name="photo">
                <input type="submit" id="sub" name="submit" value="SAVE">


            </form>
             
        </div>
        </div>
    </body>

</html>
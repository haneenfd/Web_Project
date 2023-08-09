<!DOCTYPE html>
<html>
    <heaad>
        <title>Sign UP</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                padding: 6%;
                background-color: #E3FDFD;
                
            }
            .parent{
                
                text-align: center;
                margin: auto;
                background-color: #A6E3E9;
                
                
                                
                max-width: 40%;
                border: 1px solid grey ;
                border-radius: 10px;
                height: auto;
                padding-top: 10px;
                


            }
            .suparent{
               
                position: relative;
                top: 10px;
            }
            p{
                font-size: 70%;
            }

            a{
                color: black;
                text-decoration: none;
                font-size: 105%;
                
            }



            .input{

                opacity: 1;
                border-radius: 5px;
                border-color: #1a7d86;
                margin-left: 2px;
                
                width: 70%;
            }

            .submit{
                background-color: #1a7d86;
                width: 30%;
                font-family: "Times New Roman", Times, serif;
            }
            
            .logo{
                height: 28%;
                width: 28%;

            } 
             p.type{
                font-family: "Times New Roman", Times, serif;
               display: inline;
               font-size: 100%;

             }
             label.type{
                font-size: 75%;
                font-family: "Times New Roman", Times, serif;
     
             }
             .photo{
                 color: #1a7d86;

             }


        </style>
        <script>

            
            function validateForm(){
                var name=document.forms["signup"]["userN"].value;
                var pass=document.forms["signup"]["pass"].value;
                var repass=document.forms["signup"]["repass"].value;
                var userId=document.forms["signup"]["userId"].value;
                var phone=document.forms["signup"]["phone"].value;
                
                if(name.length<=5||name.length>=20){
                    window.alert("user name must have more than 5  characters and less than 20 characters ");
                    return false;

                }
                if(pass.length<8){
                    window.alert("password is too short must be more than 8 characters") 
                    return false;
                }
                if(pass!=repass){
                    window.alert("mismatches password");
                    return false;

                }
                if(phone.length!=10){
                    window.alert("phone number is only 10 digit");
                    return false;

                }
                if(/[A-Z a-z]/.test(userId)){
                    window.alert("user Id must contain only numbers");
                    return false;
                }
                if(/[A-Z a-z]/.test(phone)){
                    window.alert("phone number must contain only numbers");
                    return false;
                }
                if(/[ ]/.test(name)){
                    window.alert("user name must have no spaces");
                    return false;
                }

                
                return true;
            }
        </script>
       
        
      
    </heaad>

    
    <body>
            <?php
            $carId=$name=$userId=$phone=$pass=$img_dir=$type="";
            
            function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name=test_input($_POST["userN"]);
                $userId=test_input($_POST["userId"]);
                $carId=test_input($_POST["carId"]);
                $phone=test_input($_POST["phone"]);
                $pass=test_input($_POST["pass"]);
                $type=$_POST['type'];
                $img_dir="upload/".$_FILES['photo']['name'];

                


                $servername="localhost";
                $username="root";
                $password="";
                $dbname="violation";
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                 
                
                if($_POST['type']=='Driver'){

                    $seld="SELECT car_id,driver_id from cars where car_id='$carId' and driver_id='$userId' ";
                    $stm=$conn->query($seld);
                    $arr=$stm->fetch();
                    $selu="SELECT carid,user_id from user where carid='$carId' and user_id='$userId' ";
                    $seln="SELECT name from user where name='$name'";
                    $stmn=$conn->query($seln);
                    $arrn=$stmn->fetch();
                    $stm1=$conn->query($selu);
                    $arr1=$stm1->fetch();
                    if(!empty($arr)){
                       if(empty($arrn)) {if(empty($arr1)){
                            $ins="INSERT INTO user ( carid, name, user_id, phone, password, image, type) VALUES ('$carId','$name','$userId','$phone','$pass','$img_dir','$type')";
                        $conn->exec($ins);
                        if(isset($img_dir)){
                            $img_name=$_FILES['photo']['name'];
                            $img_tmp=$_FILES['photo']['tmp_name'];    
                            move_uploaded_file($img_tmp,$img_dir);
        
                        }
                        $carId=$name=$userId=$phone=$pass=$img_dir=$type="";
                        header ("Location: signUp.php");
                        

                        }else{
                            echo "<script>window.alert('you already have an account')</script>";
                        }} else echo "<script>window.alert('User Name is taken')</script>";
                    }
                    else{
                        echo "<script>window.alert('wrong information please check')</script>";
                    }
            } else if($_POST['type']=='policeman'){

                $seld="SELECT policeid  from policeman where policeid='$userId'  ";
                $stm=$conn->query($seld);
                $arr=$stm->fetch();
                $selu="SELECT user_id from user where  user_id='$userId' ";
                $seln="SELECT name from user where name='$name'";
                $stmn=$conn->query($seln);
                $arrn=$stmn->fetch();        
                $stm1=$conn->query($selu);
                $arr1=$stm1->fetch();
                if(!empty($arr)){
                    if(empty($arrn)){
                    if(empty($arr1)){
                        
                        $ins="INSERT INTO user ( carid, name, user_id, phone, password, image, type) VALUES (' ','$name','$userId','$phone','$pass','$img_dir','$type')";
                        $conn->exec($ins);
                    if(isset($img_dir)){
                        $img_name=$_FILES['photo']['name'];
                        $img_tmp=$_FILES['photo']['tmp_name'];    
                        move_uploaded_file($img_tmp,$img_dir);
    
                    }
                    $carId=$name=$userId=$phone=$pass=$img_dir=$type="";
                    header ("Location: signUp.php");
                    

                    }else{
                        echo "<script>window.alert('you already have an account')</script>";
                    }} else echo "<script>window.alert('User Name is taken')</script>";
                }
                else{
                    echo "<script>window.alert('wrong information please check')</script>";
                }
        }
            

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
                



        }

            

            
            ?>
 
        <div class="parent">
            <form name="signup" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" enctype="multipart/form-data" onsubmit="return validateForm() ">
                <div >
                    <img src="image/logo.png" alt="no photo" class="logo">
                    <br><br>
                    <div><p class="type"><b>sign up as: </b></p>
                    <input class="type" type="radio"  id="d" name="type" value="policeman"  checked>
                     <label  for="p" class="type">Policeman</label>  
                     <input  class="type" type="radio" name="type" id="p" value="Driver" <?php if(isset($type)&&$type=='Driver') echo "checked"?> 
                     <label for="d" class="type">Driver</label></div>
                   
                    <div >  <span class="icon"><i aria-hidden="true" class="fa fa-user"></i></span><input name="userN" class="input" type="text"  placeholder="User Name"  value="<?php echo $name ?>" required ></div>
                    <br>                   
                    <div> <span class="icon"><i aria-hidden="true" class="fa fa-address-card"></i></span> <input name="userId" class="input" type="text" placeholder="User ID" value="<?php echo $userId ?>" required></div>
                    <br>
                    <div> <span class="icon"><i aria-hidden="true" class="fa fa-car"></i></span><input class="input" name="carId" type="text" placeholder="Car ID" value="<?php echo $carId ?>" ></div>
                    <br> 
                    <div> <span class="icon"><i aria-hidden="true" class="fa fa-phone"></i></span><input class="input" name="phone" type="text" placeholder="Phone Number" value="<?php echo $phone ?>" required></div>
                    <br>
                    <div> <span class="icon"><i aria-hidden="true" class="fa fa-key"></i></span> <input class="input" type="password" name="pass" placeholder="Password"  value="<?php echo $pass ?>" required></div>
                    <br>
                    <div> <span class="icon"><i aria-hidden="true" class="fa fa-key"></i></span> <input class="input" type="password" name="repass" placeholder="Re-type Password" value="<?php echo $pass ?>" required></div>
                    <br>
                    <div> <span class="icon"><i aria-hidden="true" class="fa fa-file-image-o"></i></span> <input class="input photo" type="file" value="drag Photo" accept=".jpg, .jpeg, .png" name="photo" required></div>
                    <br>
                    <div><input class="input submit" type="submit" value="Sign Up"></div>



                    
                    <br>
                    
                </div>
            </form>
        </div>
        <br>

        <div class =parent>
           <div class="supa"><p>Have an account? <a href="login.php"><b>Log In</b></a></p></div> 
        </div>

    </body>
</html>
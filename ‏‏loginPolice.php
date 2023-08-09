<!DOCTYPE html>
<html>
    <heaad>
        <title>Log in</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                
                padding: 10%;
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
            .submit{
                background-color: #1a7d86;
                width: 30%;
            }


            input{

                opacity: 1;
                border-radius: 5px;
                border-color: #1a7d86;
                
                width: 47%;
            }
            .logo{
                height: 28%;
                width: 28%;

            }

        </style>
       
        
      
    </heaad>

    
    <body>

    <?php 
        $x="";
        
         function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $name=test_input($_POST["name"]);
            $pass=test_input($_POST["pass"]);
            $servername="localhost";
                $username="root";
                $password="";
                $dbname="violation";
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    

                    $sel="SELECT name, password,type from user where name='$name' and password='$pass'";
                    $stm=$conn->query($sel);
                    $arr=$stm->fetch();
                    
                   
                   if(!empty($arr)){
                        $x="";
                        if($arr['type']=="policeman"){
                        header("location: policeman.php");}
                        else if($arr['type']=="Driver"){
                            header("location: user.php");
                        }

                    }
                    else $x="Incorrect Log In Information please check it and try again";




                }catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                  }
        }

        ?>
        
 
        <div class="parent">
            <form  name="signin" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                <div >
                    <img src="image/logo.png" alt="no photo" class="logo">
                    <br><br>
                    <div><input name="name" type="text" placeholder="User name"></div>
                    <br>
                    <div><input name="pass" type="password" placeholder="Password"></div>
                    <br>
                    <div><input class="submit" type="submit" value="Log in"></div>
                    <br>
                    <div class="supa"><p> <b><?php echo $x?> </b> </p></div>
                </div>
            </form>
        </div>
        <br>

        <div class =parent>
           <div class="supa"><p>Don't have an account? <a href="signUp.php"><b>Sign up</b></a></p></div> 
        </div>
        
      







    </body>

</html>
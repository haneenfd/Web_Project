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
isuser($data);

?>

<!DOCTYPE html>
<html>
    <head>
       
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link href="css/style.css" rel="stylesheet">   

            <style>
                .violation ,.details{
                    background-color: #07373b;
                    color: white;
                    border-radius: 10px;
                    width: 100%;
                    padding: 2%;
                }
                .details{
                    background-color: rgb(156,207,207,1);
                    color:#07373b;
                    display: none;
                }
                h3{
                    font-family: 'Bebas Neue', cursive;
                }
                .down{
                    position: relative;
                    left: 95%;
                }
                .down a:hover{
                    color: white;

                }
            </style>
            <script>
                $(document).ready(function(){
                    $("#show").click(function(x,y){
                        $(".details").slideDown("slow");
                        $("#show").hide();


                    });
                    $("#hide").click(function(){
                        $(".details").slideUp("slow");
                        $("#show").show();


                    });
                
                
                
                
                });
            </script>
            <?php
                $id=$data["carid"];
                $stm="SELECT * from violations where carid='$id'";
                $q=$conn->query($stm);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $a=$conn->query($stm);
                $a->setFetchMode(PDO::FETCH_ASSOC);
     
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
                <p id="user"> <?php echo $data['name']?></p> </div>
                
                <div id="li">
                    <ul>
                        <li><a href="user.php">Home Page</a></li>
                        <li><a href="#">View Violation</a></li>
                        <li><a href="trafficViolation.php">Traffic Violations</a></li>
                        <li><a href="#" >Edit Profile</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </div>

            </div>
            <div class="test1">


                
                 <?php
                 if(empty($row1 = $a->fetch())){
                    echo '<div class="violation" ">';
                     echo "Hello, You Have Zero Violations Good Job!";
                     echo '</div>';
                 }

                  while ($row = $q->fetch()){
                     $i=0;
                     $i++;
                     if($i%2==0)
                     $col="#79bebf";
                     else
                     $col="#07373b";
                     $viol=$row["viol"];
                     $carid=$row["carid"];
                     $cart=$row["cartype"];
                     $date=$row["date"];
                     $place=$row["place"];
                     $fine=$row["fine"];
                     $name=$row["policeId"];
                     echo '<div class="violation" ">';
                     echo '<h3>violation name: '.$viol.' </h3>';
                     echo '<p> <i class="fa fa-money" aria-hidden="true"></i> Fine: '. $fine .'$ </p>';
                     echo '<p> <i class="fa fa-car" aria-hidden="true"></i> Car Id: '. $carid .'</p>';
                     echo '<p> <i class="fa fa-car" aria-hidden="true"></i> Car Type: '. $cart .' </p>';
                     echo '<p><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Date: '. $date .' </p>';
                     echo '<p><i class="fa fa-location-arrow" aria-hidden="true"></i> place: '. $place .' </p>';
                     echo '<p> <i class="fa fa-male" aria-hidden="true"></i> Police Man: '. $name .' </p>';
                     
                     echo '</div>'.'</br>';
                 } ?>
                
                
                
            


            </div>

        </body>
</html>
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
        <link href="css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
        <style>
           
            tr:hover{background-color: #07373b;
            color: aliceblue;
             font-size: 120%;}

        </style>
    
    
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
                <p id="user"> <?php echo $data['name']?></p>            </div>
            <div id="li">
                <ul>
                    <li><a href="<?php echo $linkh?>">Home Page</a></li>
                    <li><a href="<?php echo $linkv?>"><?php echo $vio?></a></li>
                    <li><a href="#">Traffic Violations</a></li>
                    <li><a href="#" >Edit Profile</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>

        </div>
        <div class="test1"> 
            <div class="container">
                <div class="table-responsive">
                    <table class="table ">
                       
                      <tr id="head"><th>Violation</th> <th>Fines NIS</th></tr>
                    
                      <tr><td>Driving a vehicle without valid insurance</td><td>750</td></tr>
                      <tr><td>Covering, painting, spraying or obscuring the vision of the glass without the permission of the licensing authority</td><td>300</td></tr>
                      <tr><td>The driving license expires for a period of no less than six months</td><td>150</td></tr>
                      <tr><td>Not wearing a seat belt while driving</td><td>150</td></tr>
                      <tr><td>Failure to show insurance document or driver's license</td><td>150</td></tr>
                      <tr><td>Driving the vehicle in a way that obstructs traffic</td><td>150</td></tr>
                      <tr><td>Using a mobile phone while driving</td><td>500</td></tr>
                      <tr><td>Cargo without cover</td><td>300</td></tr>
                      <tr><td>Stopping or parking a vehicle next to another vehicle on dual carriageways</td><td>150</td></tr>
                      <tr><td>Carrying passengers in a public vehicle in excess of the permitted number</td><td>300</td></tr>
                      <tr><td>Transporting a passenger in a public vehicle without operating the meter</td><td>150</td></tr>
                      <tr><td>Operating a vehicle without marking plates</td><td>150</td></tr>
                      <tr><td>Transporting passengers for a fee in a private or commercial vehicle</td><td>300</td></tr>
                      <tr><td>Driving a vehicle with more seats than the number of seats registered in the driver’s license</td><td>150</td></tr>
                      <tr><td>Expiry of a driver's license for more than one year</td><td>150</td></tr>
                      <tr><td>Throwing trash from the car</td><td>150</td></tr>
                      <tr><td>Crossing the road without a place designated for pedestrians</td><td>150</td></tr>
                      <tr><td>Failure to install an identification plate in the public vehicle</td><td>300</td></tr>
                      <tr><td>Driving on a closed or a restricted road</td><td>300</td></tr>
                      <tr><td> Speed violation (over 40km/h)</td><td>200</td></tr>
                      <tr><td> Lighting violation</td><td>150</td></tr>
                    </table>
                  </div>
            </div>
        </div>

    </body>
</html>
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
isUser($data);

?>
<html>
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link href="css/style.css" rel="stylesheet">
            <script src="javaScript/user.js"></script>
           
    
          
    
    
        
    
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
                <p id="user"> <?php echo $data['name']?></p>
            </div>
            <div id="li">
                <ul>
                    <li><a href="user.php">Home Page</a></li>
                    <li><a href="viewViolations.php">View Violation</a></li>
                    <li><a href="trafficViolation.php">Traffic Violations</a></li>
                    <li><a href="editprofile.php" >Edit Profile</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>
           
        </div>


        <div class="test1">
            <div class="wel"><p class="wel"><b>Welcome <?php echo $data['name']?> To  <br>Traffic Viloations Websitle</b> </p></div>
            <div class="latest"><p>Latest News</p></div>
            <div class="test">
                <div class="container " >
                    <div class="row ">
                        <div  id="n1" class="col-sm-4 news" onmouseover="over(this,n2,n3)" onmouseleave="leave(this)">
                            <div>
                                <p class="neswsp">Gaza: 7 injuries in 11 traffic accidents during the last 24 hours</p>
                                <div class="newsImg"><img height="100%" width="100%" src="image/news1.jpeg"></div>
                            </div>
        
                        </div>
                        <div id="n2" class="col-sm-4 news" onmouseover="over(this,n1,n3)" onmouseleave="leave(this)">
                            <div>
                                <p class="neswsp">Tulkarm: 8 injured in a bus rollover in tulkarm</p>
                                <div class="newsImg" ><img height="100%" width="100%" src="image/news2.jpeg"></div>
                            </div>
                            
                        </div>
                        <div  id="n3" class="col-sm-4 news" onmouseover="over(this)" onmouseleave="leave(this)">
                            <div>
                            <p class="neswsp">"Traffic": 13 traffic accidents during the past 24 hours, without injuries</p>
                                <div class="newsImg"><img height="100%" width="100%" src="image/news3.jpeg"></div>
                            </div>
                            
                        </div>
        
                    </div>
        
                </div>
             </div>
             

        </div>
    </body>

</html>
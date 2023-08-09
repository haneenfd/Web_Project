<?PHP

$conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($_SERVER["requset_method"]=="post"){
$ispn=$_POST['ispn'];
$author=$_POST['author'];
$title=$_POST['title'];
$price=$_POST['ispn'];

$stm=$conn->prepare("INSERT INTO Book (ISBN, AUTHOR, TITLE,PRICE) VALUES (:ispn,:author,:nam,:price)");
$stm->bindparam(":ispn",$ispn);
$stm->bindparam(":author",$autor);
$stm->bindparam(":nam",$name);
$stm->bindparam(":price",$price);
$stm->execute();

$q="SELECT PRICE where ISBN='$ispn' ";
$stmt=$conn->exec($q);
$resulr=$stmt->setf
}








?>
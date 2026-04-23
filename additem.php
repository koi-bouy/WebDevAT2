<link rel="stylesheet" href="css/styles.css">
<?php
    // Server name
	$servername = "localhost";
	
	// Standard user name for database
	$username = "root";
	
	// password for database
	$password = "usbw";


try {
    $conn = new PDO("mysql:host=$servername;dbname=mining", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $requestor = $_POST["requestor"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $infotype = $_POST["infotype"];
    $request = $_POST["request"];

    $sql = "INSERT INTO `requests` (requestor,email,phone,infotype,request) VALUES (?,?,?,?,?)";
    $stmt= $conn->prepare($sql);

    if ($stmt->execute([$requestor, $email, $phone,$infotype,$request]) === TRUE) {
        



    } else {
        echo "Unable to Insert Error";
    }

    try {
        $sql = "SELECT requestid, requestor,email,phone,infotype,request 
        FROM requests";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $rownum = 0;
        //open table
        echo '<table class="table table-striped companies" id="outtable">';
        echo "<tr ><th>Request ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Info Type</th><th>Request</th></tr>";
        // output data of each row
        while($row = $stmt->fetch()) {

            echo "<tr>
            <td>" . $row["requestid"]. "</td>
            <td>" . $row["requestor"]. "</td>
            <td>" . $row["email"]. "</td>
            <td>" . $row["phone"]. "</td>
            <td>" . $row["infotype"]. "</td>
            <td>" . $row["request"]. "</td>
            </tr>";
        }
        echo '</table>';
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    }
$conn = null;
?>

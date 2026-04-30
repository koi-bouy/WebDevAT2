<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Past Requests</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>
        <h1>Past Requests</h1>
    </header>
    <nav>
        <ul class="navbar">
            <li><a href="contact.htm">Return To Form</a></li>
        </ul>
    </nav>
    <div class="container">
        <main class="center" style="flex-basis:100vw">
            <table class="table table-striped companies" id="outtable">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Info Type</th>
                        <th>Request</th>
                    </tr>
                </thead>
                <tbody>
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
                        $stmt = $conn->prepare($sql);

                        if ($stmt->execute([$requestor, $email, $phone, $infotype, $request]) === TRUE) {
                        } else {
                            echo "<tr><td>Unable to Insert Error</td></tr>";
                        }

                        try {
                            $sql = "SELECT requestid, requestor,email,phone,infotype,request 
                                FROM requests";

                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();


                            $rownum = 0;
                            // output data of each row
                            while ($row = $stmt->fetch()) {

                                echo "
                        <tr>
                        <td>" . $row["requestid"] . "</td>
                        <td>" . $row["requestor"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["phone"] . "</td>
                        <td>" . $row["infotype"] . "</td>
                        <td>" . $row["request"] . "</td>            
                        </tr>
                        ";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    $conn = null;
                    ?>
                </tbody>
            </table>
        </main>
    </div>

</body>

</html>
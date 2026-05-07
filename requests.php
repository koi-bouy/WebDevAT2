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
            <table class="striped">
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


                        /* only try to add a new request if all input fields are recieved
                           otherwise just print the request table */

                        if (isset(
                            $_POST["requestor"],
                            $_POST["email"],
                            $_POST["phone"],
                            $_POST["infotype"],
                            $_POST["request"]
                        )) {
                            $requestor = $_POST["requestor"];
                            $email = $_POST["email"];
                            $phone = $_POST["phone"];
                            $infotype = $_POST["infotype"];
                            $request = $_POST["request"];

                            $sql = "INSERT INTO `requests` (requestor,email,phone,infotype,request) VALUES (?,?,?,?,?)";
                            $stmt = $conn->prepare($sql);

                            if ($stmt->execute([$requestor, $email, $phone, $infotype, $request]) === TRUE) {
                                echo "<strong style='color:green;'>Request Submitted Successfully!</strong>";
                            } else {
                                echo "<strong style='color:red;'>Unable to Insert Error</strong>";
                            }
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
                        <td>" . htmlspecialchars($row["requestid"]) . "</td>
                        <td>" . htmlspecialchars($row["requestor"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . htmlspecialchars($row["phone"]) . "</td>
                        <td>" . htmlspecialchars($row["infotype"]) . "</td>
                        <td>" . htmlspecialchars($row["request"]) . "</td>            
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
    <footer>
        <p>
            Background photo by <a
                href="https://unsplash.com/@matthewdelivera?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">
                Matthew de Livera
            </a>
            on
            <a
                href="https://unsplash.com/photos/a-view-of-a-large-open-pit-in-the-middle-of-nowhere-4Gf51uY0YQE?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">
                Unsplash
            </a>
            <br>
            All html/css code is the work of Raphael Fernandes.
        </p>
    </footer>

</body>

</html>
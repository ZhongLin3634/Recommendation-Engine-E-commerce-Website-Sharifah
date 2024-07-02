<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

</head>
<body>
<div class="container">
        <?php
        // Database parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "user_sharifah";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $databaseName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $shippingAddress = $_POST['shipping_address'];

        // Check if the username already exists
        $checkUsernameQuery = "SELECT * FROM user WHERE username = '$name'";
        $result = $conn->query($checkUsernameQuery);

        if ($result->num_rows > 0) {
            // Username already exists, display error message and back button
            echo "<h2>Registration failed!</h2>";
            echo "<p style='color: red;'>Error: Username '$name' already exists.</p>";
            echo "<button onclick='goBack()'>Go Back</button>";
            echo "<script>
                    function goBack() {
                        window.history.back();
                    }
                  </script>";
        } else {
            // Username is unique, proceed with registration
            $randomNumber = mt_rand(1000, 9999);
            $newId = $randomNumber;

            $sql = "INSERT INTO user (id, username, password, gmail, shipping_address, Register_Date) 
                    VALUES ('$newId', '$name', '$password', '$email', '$shippingAddress', NOW())";

            if ($conn->query($sql) === TRUE) {
                // Registration successful, display success message and countdown
                echo "<h2>Registration successful!</h2>";
                echo "<p class='success-message'>Your ID is: $newId</p>";
                echo "<p class='countdown'>Redirecting to login page in <span id='countdown'>3</span> seconds...</p>";
                echo '<script>
                          var seconds = 3;
                          function countdown() {
                            document.getElementById("countdown").innerHTML = seconds;
                            if (seconds <= 0) {
                              window.location.href = "login.php";
                            } else {
                              seconds--;
                              setTimeout(countdown, 1000);
                            }
                          }
                          countdown();
                      </script>';
            } else {
                // Display error message if registration fails and back button
                echo "<h2>Registration failed!</h2>";
                echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                echo "<button onclick='goBack()'>Go Back</button>";
                echo "<script>
                        function goBack() {
                            window.history.back();
                        }
                      </script>";
            }
        }

        // Close the connection
        $conn->close();
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.querySelector('.container').classList.add('show');
            }, 100);
        });
    </script>
</body>
</html>
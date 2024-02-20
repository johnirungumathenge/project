<?php
include 'connect.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Initialize variables
$fullname = $username = $email= $phone = $password = $confirm_password = "";
$errors = array();

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    $username = sanitizeInput($_POST["username"]);
    if (empty($username)) {
        $errors["username"] = "Username is required";
    } else {
        // Check if username already exists in the database
        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($checkUsernameQuery);
        if ($result->num_rows > 0) {
            $errors["username"] = "Username already exists";
        }
    }

    //validate fullname
    $fullname = sanitizeInput($_POST["fullname"]);
    if (empty($fullname)) {
        $errors["fullname"] = "fullname is required";
    } else {
        // Check if username already exists in the database
         $errors["username"] = "Username already exists";
        
    }
    //phone
    $phone = sanitizeInput($_POST["phone"]);
    if (empty($phone)) {
        $errors["phone"] = "phone is required";
    } else {
        // Check if username already exists in the database
         $errors["phone"] = "input phone";
        
    }
    // Validate email
    $email = sanitizeInput($_POST["email"]);
    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    } else {
        // Check if email already exists in the database
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);
        if ($result->num_rows > 0) {
            $errors["email"] = "Email already exists";
        }
    }

    // Validate password
    $password = sanitizeInput($_POST["password"]);
    $confirm_password = sanitizeInput($_POST["confirm_password"]);
    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Password must be at least 6 characters long";
    } elseif ($password != $confirm_password) {
        $errors["confirm_password"] = "Passwords do not match";
    }

    // If there are no validation errors, insert user into the database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insertUserQuery = "INSERT INTO user (fullname,username, email,phone, password) VALUES ('$fullname','$username', '$email','$phone', '$hashed_password')";
        if ($conn->query($insertUserQuery) === TRUE) {
            echo "Registration successful!";
            header('Location: login.php');
        } else {
            echo "Error: " . $insertUserQuery . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();

$conn = null; // Close connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid ">
        <div class="cont">
        <h1>Registration Form</h1>
            <form action="register.php" method="post" class="form-control text-center">
                <label for="username">Fullname:</label>
                <input type="text" id="fullname" name="fullname" required><br><br>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="username">Phone:</label>
                <input type="text" id="phone" name="phone" required><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>

                <button type="submit">Register</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

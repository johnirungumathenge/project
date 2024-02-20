<?php
session_start();

if(isset($_SESSION['user'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
            <div class="form-class text-light">
                <h1 class="text-center text-dark p-2">Registration Form</h1>
                <?php echo $successMessage; ?>
            </div>
        <?php
        // print_r($_POST);
        $successMessage = '';

        if(isset($_POST['submit'])){
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            // Encrypting the password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(empty($fullname) OR empty($email) OR empty($password) OR empty($cpassword)){
                array_push($errors, "All fields ar required!");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid!");
            }
            if(strlen($password) < 8){
                array_push($errors, "Password must be atleast 8 characters");
            }
            if($password !== $cpassword){
                array_push($errors, "Password do not match!");
            }
            //connect to the database
            require_once  'connect.php';

            $sql = "SELECT * FROM Users where email='$email'";
            $result = mysqli_query($conn,$sql);
            $rowCount = mysqli_num_rows($result);

            if($rowCount > 0){
                array_push($errors, "Email already Exists!");
                //echo "<div class='alert alert-success'> Email already exists.</div>";
            }

            if(count($errors) >0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>" . $error . "</div>";
                }
            }
            else{
                //insert data into the database
                                
                $sql = "INSERT INTO Users (fullname, email, password)  VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$passwordHash);
                    mysqli_stmt_execute($stmt);
                    $successMessage = "<div class='alert alert-success'> You have registered successfully </div>";
                    //echo "<div class='alert alert-success'> You have registered successfully </div>";
                }
                else{
                    die("Something went wrong!" . mysqli_stmt_error($stmt));
                }
            }
        }

        ?>
        <form method="POST" action="register.php">
            
            <div class="form-group">
                <input type="text" name="fullname" placeholder="Fullname" class="form-control">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="cpassword" placeholder="confirm-password" class="form-control">
            </div>
            <div class="form-group text-center">
                <input type="submit" name="submit" value="Register" class="btn btn-primary m-2 p-2">
            </div>
        </form>
        <p class="text-center p-1 m-2">Registered?<a class="text-decoration-none p-3" href="login.php">  Login here</a></p>
        <p class="text-center ">Admin?<a class="text-decoration-none p-3" href="lecturer_login.php">  Login As Admin</a></p>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
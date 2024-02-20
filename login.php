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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    
    <div class="container">
        <div class="row m-2 p-3">
            <h1>Login Form</h1>
        </div>

        <?php
            if(isset($_POST['login'])){
                $email = $_POST['email'];
                $password = $_POST['password'];

                require_once 'connect.php';
                $sql ="SELECT * FROM Users WHERE email='$email'";
                $result = mysqli_query($conn,$sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $userId = $user['id'];

                if($user){
                    if(password_verify($password, $user['password'])){
                        session_start();
                        $_SESSION['user'] = $userId;
                        header("Location:index.php");
                        die();
                    }else{
                        echo "<div class='alert alert-danger'>Password does not Exist</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Email does not Exist</div>";
                }
            }
        ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <input type="email" name="email" placeholder="email"  class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="password" class="form-control">
            </div>
            
            <div class="btn">
                <input type="submit" value="Login" name="login" class="btn btn-success">
            </div>

        </form>
        <p class="text-center p-2 m-3">Not yet registered? <a class="text-decoration-none" href="register.php">Register here</a></p>
    </div>


    

</body>
</html>

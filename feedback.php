<?php

session_start();
require_once "connect.php";

$lecname = $_SESSION['admin'];
$sql ="SELECT * FROM Request join Users ON Request.users_id=Users.id WHERE Request.approve = 'approved' ";
$result = $conn->query($sql);
$row=$result->fetch_assoc();

//$id =$row['users_id'];
$newId = $_GET['userid'];

// approve the student into the database
// function to update the student into request table in the database
function approveStudent($conn,$approve){
    $newId = $_GET['userid'];
    $sql1 = "SELECT * FROM Request WHERE users_id = '$newId' AND approve IS NULL";
    
    $result =mysqli_query($conn,$sql1);

    if($result && mysqli_num_rows($result) > 0){
        $updateSql ="UPDATE Request SET approve='$approve' WHERE approve IS NULL ";
        $updateResult = mysqli_query($conn, $updateSql);
        if($updateResult){
            echo "student record updated successful";
        }else{
            echo "failed to update";
        }
    }   

}
if(isset($_POST['submit'])){
    $name = $lecname;
    $text = $_POST['text']; 
    $newId = $_GET['userid'];   

    $sql ="INSERT INTO feedback(user_id,lecturer,feedback) VALUES($newId ,'$name','$text')";
    $result = mysqli_query($conn,$sql);

    if($result){
        approveStudent($conn, 'approve');
        header('Location: admin.php');
        //echo "<script>alert('success')</script>";
    }else{
        echo mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedbackupload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>
<body>
<div class="container-fluid " id="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid  justify-content-between">
            <div class="container">
               <i class="bi bi-pass-fill"></i>
                <a class="navbar-brand" href="#">Lecturers</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="btn btn-danger d-flex p-2">
                        <a class="text-light text-decoration-none" href="admin_logout.php">Logout </a>
                        <i class="bi bi-box-arrow-right"></i></i>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
    <div class="container mt-5">
        <h1>Feedback</h1>
        <p>
            <?php echo "the day is: ". $newId; ?>
        </p>
        <form method="POST" class="form-control">
            <div class="form-group">
                <label for="lecturer" class="form-label">Lecturer Name</label>
                <input type="text" name="lecturer" class="form-control" value="<?php echo $lecname; ?>" placeholder="enter name">
            </div>
            <div class="form-group">
                <label for="lecturer" class="form-label">Feedback</label>
                <textarea  name="text" class="form-control" rows=10 placeholder="enter feedback"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary mt-2">Upload Review</button>
                <a   class="btn btn-danger mt-2">Cancel</a>
            </div>
        </form>
    </div>
    
</body>
</html>
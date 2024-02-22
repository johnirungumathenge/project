<?php
session_start();
require_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attachment Records</title>
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
                <a class="navbar-brand" href="#">Students</a>
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
                        <a class="text-light text-decoration-none" href="logout.php">Logout </a>
                        <i class="bi bi-box-arrow-right"></i></i>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container-fluid" style="margin-top: 4rem;">
    <h4>Reviews</h4>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Student Name</th>
        <th scope="col">ID</th>
        <th scope="col">Lecturer</th>
        <th scope="col">Feedback</th>
        <th scope="col">Feedback Date</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody> 
    
    <?php
    $id =$_SESSION['user'];
    $sql = "SELECT * FROM feedback JOIN Users ON  feedback.user_id = Users.id WHERE user_id=$id";
    $result = mysqli_query($conn, $sql);
    // Assuming $result is the result set from your query
    while ($row = mysqli_fetch_assoc($result)) {
        $sname = $row['fullname'];
        $ses =$_SESSION['user'];
        $id = $row['user_id'];
        $feedback = $row['feedback'];
        $date = $row['feedback_date'];
        $lecturer = $row['lecturer'];

        echo '      
        <tr>        
            <td>' . $sname . '</td>
            <td>' . $id . '</td>
            <td>' . $lecturer . '</td>
            <td>' . $feedback . '</td>
            <td>' . $date . '</td>
            <td></td>
        </tr>';
    }
    ?>
    </tbody> 
    </table>
    <br>
</div>
    <br>
  
</div>
<div class="container-fluid" style="margin-top:1rem;">
        
    <a class="btn btn-info text-decoration-none m-2 p-2" href="index.php">Close</a>
</div>


<!-- CDN links to import the bootstrap 5 styling -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
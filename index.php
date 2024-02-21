<?php
session_start();

// require_once 'connection.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

$Id = $_SESSION['user']

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

<!-- Help section -->
    <div class="container cont">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">How To Update Your Log Book</h5>
                        <h5><?php echo $Id  ?></h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/student-849825.jpg" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- text  -->
    

    <div class="container mt-3">
        <div class="row ">
            <?php  
                if(isset($_POST['submit'])){
                    $day = $_POST['day'];
                    $date = $_POST['date'];
                    $week = $_POST['week'];
                    $text_input = $_POST['text_input'];

                    // session from database users
                    $users_id = $Id;

                    // prepare sql statement with placeholder
                    require_once  "connect.php";

                    $sql = "INSERT INTO Request (users_id,request_date,week,Day, Description) VALUES(?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bind_param('sssss', $users_id,$date,$week,$day,$text_input);

                    if($stmt->execute()){
                        echo "<script> alert('Record added success')</script>";
                    }else{
                        echo "<script>alert('error '. $stmt->error)</script>";
                    }
                    //close the connection
                    $stmt->close();
                    $conn->close();
                }
            ?>
            <form method="POST" action="index.php">
                <h3 class="mt-5 p-3 mb-3">
                    Record Todays Activity
                </h3>
                <p class="m-2 b">please select the specific day and week in boxes provided</p>
                <div class="row text-center">                
                    <div class="col-md-4 mb-3">
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <select name="day" class="form-control text-center">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            
                        </select>
                    </div>
                    <!-- week selection -->
                    <div class="col-md-4">
                        <select name="week" class="form-control text-center">
                            <option value="week1">Week1</option>
                            <option value="week2">Week2</option>
                            <option value="week3">Week3</option>
                            <option value="week4">Week4</option>
                            <option value="week5">Week5</option>
                            <option value="week6">Week6</option>
                            <option value="week7">Week7 </option>
                            <option value="week8">Week8</option>
                            <option value="week9">Week9</option>
                            <option value="week10">Week10</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <textarea class="form-control mb-3" id="saturday" name="text_input" rows="6"></textarea>
                </div>

                <div class="mt-3">
                    <button type="submit"  name="submit" class="btn btn-primary">Update Activity</button>
                </div>
            </form>
        </div>
    </div>
    
    <br>
  
    <br>
     <div class="container mt-3">
        <h4>Lecturers Reviews</h4>
        <div class="image">
        <p class="card-text">click the button to see the reviews your made by lecturers</p>
            <a href="reviews.php" class="btn btn-success text-decoration-none">Show Reviews</a>
        </div>
    </div>

    <br>

    <!-- About Us section -->
    <div class="container cont mb-5">
        <h3>About Us</h3>
        <div class="card">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">We Help The Students To Record Their Details With Ease</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/student-849825.jpg" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- contacts section -->
    <div class="container mt-5">
  <div class="row d-flex">
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Contacts</h4>
        </div>
        <div class="card-body d-flex justify-content-between">
          <!-- Contact 1 -->
          <div class="mb-3">
            <h5>Contact Name: Admin</h5>
            <p>Email: admin@example.com</p>
            <p>Phone: +254 4567890</p>
          </div>

          <!-- Contact 2 -->
          <div class="mb-3">
            <h5>Contact Name: Student</h5>
            <p>Email: student@example.com</p>
            <p>Phone: +254 7654321</p>
          </div>

          <!-- Add more contacts as needed -->

        </div>
      </div>
    </div>
  </div>
</div>

    <!-- frequently asked  questions section -->
    <div class="container mt-5">
        <div class="row">
            <h2>FAQS</h2>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Sam</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Mary</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">John</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <br>
    


    <!-- footer section -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

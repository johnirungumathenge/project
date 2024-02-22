<?php 
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: lecturer_login.php");
}             

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- icon link to import icons in  our webpage -->
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
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#FAQS">FAQS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacts">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">reviews</a>
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

<!-- Help section -->
    <div class="container cont">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Review The Days The Log Book Is Filled.</h5>
                        <p><?php echo "Lecturer: " . $_SESSION['admin']; ?></p>
                        <p class="card-text">Review the Requests Made By The Students As Shown Below in the Reviews section and 
                            Award The Marks By Approvint The Request And Writing A Feedback That Will Help The Student With Their Learning. 
                            Please Ensure You Write A Feedback. .</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/student-849825.jpg" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- reviews section -->
    <div class="container mt-5" id="reviews">
        <h4>Lecturers Reviews && Feedback Writing for Reviewed requests</h4>
        
    <?php 
        // connect to the database
        require_once 'connect.php';

        $sql ="SELECT * FROM Request join Users ON Request.users_id=Users.id WHERE approve IS NULL ";       
        $result = $conn->query($sql);
        //$row = $result->fetch_assoc();

        if($result->num_rows > 0){
            echo "<form method='POST' enctype='multipart/form-data'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>ID</th><th>Full Name</th><th>Day</th><th>Week</th><th>Description</th><th>Approve</th></tr></thead>";
            //$row = $result->fetch_assoc();
            while($row=$result->fetch_assoc()){
                $id =$row['users_id'];
                echo "<tr>";
                echo "<td>" . $row["users_id"] . "</td>";
                echo "<td>" . $row["fullname"] . "</td>";
                echo "<td>" . $row["Day"] . "</td>";
                echo "<td>" . $row["week"] . "</td>"; //userid=<?php echo $id; 
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td><a href='feedback.php?userid=" . $id . "' name='submit' class='btn btn-danger p-2'>Approve</a></td>";
                
                echo "</tr>";                
            }
            
            echo "</table>";
            echo "</form>";

        } else {
            //echo "<script>alert('Error: No rows found')</script>";
            echo "No rows to Review" . 0;
        }        
        
    ?>
</div>
        <!-- The about us section -->
    <<div class="container cont mb-5" id="about">
        <h3>About Us</h3>
        <div class="card">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">We Help The Lecturers To Review Requests Made With Ease.</h5>
                        <p class="card-text">The 'About Us' section of our logbook updating system provides insight
                             into our commitment to efficient record management.
                              We highlight our team's dedication to developing user-friendly interfaces, ensuring seamless navigation. Learn about our mission to streamline the logging process, enhance data accuracy,
                             and empower users with robust tools for comprehensive and hassle-free record keeping.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/workspace-766045.jpg" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- contacts section to show how a person can reach to us -->
    <div class="container mt-5" id="contacts">
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
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- frequently asked  questions section -->
    <div class="container mt-5" id="FAQS">
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
<!-- CDN LINKS to add bootstrap 5 to our Webpage For Better Styling -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  
</body> 
</html>

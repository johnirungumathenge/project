<div class="container mt-5">
       
       <form method="POST" action="admin.php">    
           <?php
           //  require_once 'connect.php';

           //  $sql ="SELECT * FROM Request";
           //  $result = $conn->query($sql);
     
           //  if($result->num_rows > 0){
           //     $row = $result->fetch_assoc();
           //     echo "the new row ". $row['Description'];
           //  }else{
           //      echo "<script>alert('error')</script>";
           //  }
           
           ?>
           <h2>Accordion Example</h2>
           <p><strong>Note:</strong> The <strong>data-bs-parent</strong> attribute makes sure that all collapsible elements under the specified parent will be closed when one of the collapsible item is shown.</p>
           <div id="accordion">
               <div class="card">
               <div class="card-header">
                   <a class="btn" data-bs-toggle="collapse" href="#collapseOne">
                       <?php  echo $row['Day']; ?>
                   </a>
               </div>
               <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                   <div class="card-body">
                       <?php //echo $row['Description'] ?>
                   <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. -->
                   </div>
               </div>
               </div>
               <div class="card">
               <div class="card-header">
                   <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo">
                   Collapsible Group Item #2
               </a>
               </div>
               <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                   <div class="card-body">
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                   </div>
               </div>
               </div>
               <div class="card">
               <div class="card-header">
                   <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseThree">
                   Collapsible Group Item #3
                   </a>
               </div>
               <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                   <div class="card-body">
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                   </div>
               </div>
               </div>
               <!--  -->
               <div class="card">
               <div class="card-header">
                   <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseFour">
                   Collapsible Group Item #4
                   </a>
               </div>
               <div id="collapseFour" class="collapse" data-bs-parent="#accordion">
                   <div class="card-body">
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                   </div>
               </div>
               </div>
               <!-- 5 -->
               <div class="card">
               <div class="card-header">
                   <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseFive">
                   Collapsible Group Item #5
                   </a>
               </div>
               <div id="collapseFive" class="collapse" data-bs-parent="#accordion">
                   <div class="card-body">
                       <?php echo  $row['Description'] . 'row_data'; ?>
                   <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. -->
                   </div>
               </div>
               </div>
               <!--  -->
           </div>
           <!-- button to submit review -->
           <button type="submit" name="submit" class="btn btn-primary mt-1 p-2 m-2">Approve</button>
       </form>
   </div>
<?php
 include 'conn.php';
    $name = "";
    $class = "";
    $email = "";
    $marks = "";
    $yourself="";
    $subject="";
    $gender="";
    $showButton = true;

    //Insert Method
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $class = $_POST['class'];
        $email = $_POST['email'];
        $marks = $_POST['marks'];
        $yourself = $_POST['yourself'];
        echo $yourself;
        $subject = $_POST['subject'];
        $gender = $_POST['gender'];
 
        $sql = "INSERT INTO crud (name,class,email,marks,yourself,subject,gender) VALUES ('$name','$class','$email','$marks','$yourself','$subject','$gender')";
        $result = mysqli_query($con,$sql);
        header("Location: user.php");
        exit();
    }
    //  Delete Method -> Asking for Confirmation
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        echo '<script>
        let v = confirm("Do u want to continue?");
        if(v){
            window.location.href = "http://localhost/crud_op/user.php?id='.$id.'";
        }
        </script>';
        
    }
    // Delete Method -> Deleting from DB
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sqlDel  = "DELETE FROM crud WHERE id = $id";
        $resDel = mysqli_query($con, $sqlDel);
        if($resDel){
            echo "Data Deleted Successfully !";
            header("Location: user.php");
        }
        else{
            echo "ERROR: Could not able to Delete" . mysqli_error();
        }
    }
    //Update Method
     if(isset($_GET['updateid'])){
        $showButton = false;
        $idupdate = $_GET['updateid']; 
        $sql  = "SELECT *FROM crud WHERE id = $idupdate";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $class = $row['class'];
        $email = $row['email'];
        $marks = $row['marks'];
        $yourself = $row['yourself'];
        $subject = $row['subject'];
        //echo $yourself."\n";
        $gender = $row['gender'];
        
    }
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $class = $_POST['class'];
        $email = $_POST['email'];
        $marks = $_POST['marks'];
        $yourself = $_POST['yourself'];
        $subject = $_POST['subject'];
        $gender = $_POST['gender'];
        //echo "Entered".$name.$class.$email.$marks;
        $sqlup = "UPDATE crud SET name='$name', class='$class', email='$email', marks='$marks', yourself='$yourself', subject='$subject', gender='$gender'  WHERE id = '$idupdate'";
        $resultup = mysqli_query($con,$sqlup);
        if($resultup){
            //echo "Updated Successfully !";
            
           
            echo '<script>
              alert("Data Updated Successfully !!");
              window.location.href = "http://localhost/crud_op/user.php";
            </script>';
            //header("Location: user.php");
            //exit();
        }
        else{
            echo "Error: Could not able to Update".mysqli_error();
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <title>CRUD OPERATIONS!</title>
  </head>
  <body>
    <main class="container display=flex">
        <img src="./bird_colorful.jpg" alt="" style="width:100px; height:100px">
        <h2>CRUD Operations</h2>
        <form method="post">
            <div class="form-group">
                <label for="InputEmail">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Your Name" value="<?php echo $name;?>" required >
            
            </div>
            <div class="form-group">
                <label for="InputEmail">Class</label>
                <input type="text" class="form-control" name="class" placeholder="Your Class" value="<?php echo $class;?>" required>
                
            </div>
            <div class="form-group">
                <label for="InputEmail">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Your email" value="<?php echo $email;?>" required>
            </div>
            <div class="form-group">
                <label for="InputPassword">Marks</label>
                <input type="number" class="form-control" name="marks" placeholder="Enter Your Marks" value="<?php echo $marks;?>" required>
            </div>
            <div class="form-group">
                <label for="textbox">Write About Yourself</label>
                <textarea class='form-control' rows='3' name="yourself" placeholder="Write Here ..." ><?php echo $yourself ?></textarea>
            </div>
            <div class="form-group">
                <label for="Favourite Subject">Select Your Favourite Subject : </label>
                <select name="subject">
                    <option value="none" selected disabled hidden>---Select---</option>
                    <option value="Physics"<?php if($subject=="Physics") echo 'selected="selected"'; ?>>Physics</option>
                    <option value="Chemistry"<?php if($subject=="Chemistry") echo 'selected="selected"'; ?>>Chemistry</option>
                    <option value="Maths"<?php if($subject=="Maths") echo 'selected="selected"'; ?>>Maths</option>
                    <option value="Arts"<?php if($subject=="Arts") echo 'selected="selected"'; ?>>Arts</option>
                    <option value="Geography"<?php if($subject=="Geography") echo'selected="selected"'; ?>>Grography</option>
                    <option value="Accounts"<?php if($subject=="Accounts") echo'selected="selected"'; ?>>Accounts</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Gender">Gender</label><br>
                <label for="male"><input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo'checked="checked"'; ?>> Male</label><br>
                <label for="female"><input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo'checked="checked"'; ?>> Female</label><br>
                <label for="other"><input type="radio" name="gender" value="Other" <?php if($gender=="Other") echo'checked="checked"'; ?>> Other</label>
            </div>
            
            <?php
                if ($showButton) {
        
                    echo '<button type="submit" class="btn btn-success" name="submit">Submit</button>';

                } else {

                    echo '<button type="submit" class="btn btn-primary" name="update" >Update</button>';
                }
            ?>
            <!-- <button type="submit" class="btn btn-primary display=none"  name="submit" >Submit</button> -->
            <!-- <button type="submit" class="btn btn-primary" name="update" >Update</button> -->
        </form>
        
        <table class="table table-dark my-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Marks</th>
                    <th>Yourself</th>
                    <th>Subject</th>
                    <th>Gender</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                
                <?php
                    $sql  = "SELECT *FROM crud";
                    $result = mysqli_query($con, $sql);
                    if($result){
                        $j=1;
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['id'];
                            $name = $row['name'];
                            $class = $row['class'];
                            $email = $row['email'];
                            $marks = $row['marks'];
                            $yourself = $row['yourself'];
                            $subject = $row['subject'];
                            $gender = $row['gender'];
                            echo '<tr>
                            <th scope="row">'.$j.'</th>
                            <td>'.$name.'</td>
                            <td>'.$class.'</td>
                            <td>'.$email.'</td>
                            <td>'.$marks.'</td>
                            <td>'.$yourself.'</td>
                            <td>'.$subject.'</td>
                            <td>'.$gender.'</td>
                            <td><a href="user.php?updateid='.$id.'" class="btn btn-primary">Edit</a></td> 
                            <td><a href="user.php?deleteid='.$id.'" class="btn btn-danger">Delete</a></td>
                            
                            </tr>';
                            $j++;
                        }
                    }
                ?>
            </thead>
        
        </table>
    </main>

  
  </body>
</html>

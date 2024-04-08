<?php session_start(); 
include 'include/dbc.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BUMCMS | Login</title>
    <link rel="stylesheet" href="include/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="include/assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="include/assets/css/styles.css">
</head>

<body>
    <div class="login-dark">
        <form method="post" style="height: 488px; margin-top: -40px;">
    <h2 class="sr-only">Login Form</h2>
    <div class="illustration" style="height: 194px;width: 225px;margin-top: -95px;"><img src="include/assets/img/bu.jpg" style="height: 99px;width: 95px;"></div><span style="margin: 8px;margin-bottom: 67px;margin-left: 19px;color: rgb(8,200,227);font-size: 30px;">Student Clinic&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Login</span>
    <div
        class="form-group"><input id="uname" class="form-control" type="text" name="email" placeholder="User Name" style="margin-top: 61px;transition: 0.5s;" required></div>
    <div class="form-group text-center"><input id="pass" class="form-control" type="password" name="password" placeholder="Password" style="transition: 0.1s;" required>
    <code id="login_error" class="text-center"></code></div>
    <div class="form-group" style="height: 32px;margin-bottom: 0px;">
    <button id="login" type="submit" name="save" class="btn btn-primary btn-block">Log In</button></div>
    </form>
    <?php 
    if(isset($_POST['save']))
    {
        $username = $_POST['email'];
        $password = $_POST['password'];
        //$passwordMd5 = md5($password);
        // $employee = $conn->query("SELECT * FROM employee WHERE employee_id = '".$username."' and password ='".md5($password)."' ");
        // $employee_result = $employee->num_rows;


        // $student = $conn->query("SELECT * FROM patient WHERE student_id = '".$username."' and password ='".md5($password)."' ");
        // $student_result = $student->num_rows;

        // echo "<script>console.log('what it is workig');</script>";
        // echo "<script>console.log('".$username.$password."');</script>";

        $employee = "SELECT * FROM employee WHERE employee_id = '$username' and password = '".md5($password)."' limit 1";
        $student = "SELECT * FROM patient WHERE student_id = '$username' and password = '".md5($password)."' limit 1";

        $employee_result = mysqli_query($conn, $employee);
        $employee_result_check = mysqli_num_rows($employee_result);

        $student_result = mysqli_query($conn, $student);
        $student_result_check = mysqli_num_rows($student_result);

        if($student_result_check == 0 && $employee_result_check == 0){
             echo "<script>
            document.getElementById('login_error').innerHTML='Incorrect username or password'</script>";
        }else if ($employee_result_check > 0) {
     $employee_row = mysqli_fetch_assoc($employee_result);
     $_SESSION['user_name'] = $employee_row['fname'];
     $_SESSION['user_lname'] = $employee_row['lname'];
     $_SESSION['password'] = $employee_row['password'];
     $_SESSION['user_id'] = $employee_row['employee_id'];
     $_SESSION['position'] = $employee_row['position'];
     $_SESSION['status'] = $employee_row['status'];

     if($_SESSION['status'] == 0){
           echo "<script> alert('Your Account is diactivated, Please contact Admin'); </script>";
     }else{
         if($_SESSION['position'] == "Admin"){
         header("location:admin/index.php");
         die;
     }
     else if($_SESSION['position'] == "Manager"){
         header("location:manager/index.php");
         die;
     }
     else if($_SESSION['position'] == "Doctor"){
         header("location:doctor/index.php");
         die;
     }
     else if($_SESSION['position'] == "Pharmacist"){
         header("location:pharmacist/index.php");
         die;
     }
     else if($_SESSION['position'] == "Lab technician"){
         header("location:lab technician/index.php");
         die;
     }
     else if($_SESSION['position'] == "Clerk"){
         header("location:clerk/index.php");
         die;
     }
     else if($_SESSION['position'] == "Storekeeper"){
         header("location:store keeper/index.php");
         die;
     }
     }

    
    }else if($student_result_check > 0){
        echo "<script> alert('Well come gemechu'); </script>";
     $student_row = mysqli_fetch_assoc($student_result);
     $_SESSION['student_name'] = $student_row['fname'];
     $_SESSION['student_mname'] = $student_row['mname'];
     $_SESSION['student_id'] = $student_row['student_id'];
     $_SESSION['password'] = $student_row['password'];

     if($student_row['status_check'] == 0)
        echo "<script> alert('Your Account is diactivated, Please contact Admin'); </script>";
    else
     header("location:patient/index.php");
     die;
    }



        // if($result > 0)
        // {
        //     echo "<script>
        //     document.getElementById('login_error').innerHTML='Welcome'</script>";
        // }
        // else
        // {
        //    echo "<script>
        //     document.getElementById('login_error').innerHTML='Incorrect username or password'</script>";
        // }


    }
    ?>
    </div>
     
    <script src="include/assets/js/jquery.min.js"></script>
    <script src="include/assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
   //  $(document).ready(function(){
   //      $("#login").click(function(){
   //      var username = $("#uname").val();
   //      var password = $("#pass").val();
   //      // console.log(password);
   //      if(!validateUsername(username))
   //          $("#uname").focus();
   //      else if(!validatePassword(password))
   //          $("#pass").focus();
   //      else{
   //          $.ajax({
   //              url:'login.php',
   //              post:'post',
   //              data:{username:username,password:password},
   //              success:function(response){
   //                  alert(response);
   //                  console.log(username+password+"BB"+response);
   //              }
   //          });
   //      }
   //      })
        
   //  });
   //  function validateUsername(value){
   //      var result = document.getElementById('login_error');
   //      result.style.display = 'block';
   //      if(value.trim() == ""){
   //          result.innerHTML = "User Name Required";
   //          document.getElementById('uname').style.border = '1px solid red';
   //          // document.getElementById('uname').style.border = '1px solid red';
   //          return false;
   //      }
   //      document.getElementById('uname').style.border = 'none';
   //      result.style.display = 'none';
   //      return true;
   //  }
   // function validatePassword(value){
   //   var result = document.getElementById('login_error');
   //      result.style.display = 'block';
   //      if(value == ""){
   //          result.innerHTML = "Password Required";
   //          document.getElementById('pass').style.border = '1px solid red';
   //          // document.getElementById('uname').style.border = '1px solid red';
   //          return false;
   //      }
   //      document.getElementById('pass').style.border = 'none';
   //      result.style.display = 'none';
   //      return true;
   // }
</script> 
</body>

</html>
    <?php  session_start();
    include 'dbc.inc.php'; ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Password</title>
        <link rel="stylesheet" type="text/css" href="../../include/bootstrap/css/bootstrap.css">
        <script src="../../include/bootstrap/js/bootstrap.js"></script>
        <script src="../../include/jquery/jquery-3.6.2.js"></script>
        <link rel="stylesheet" type="text/css" href="../../include/fontawesome/css/all.css"> 
        <style type="text/css">
            body{
                /*background: #111;*/
            }
            #change_password{
                margin: 100px;
                /*width: 50%;*/
                align-items: center;
            }
        </style>
    </head>
    <body>
        <div id="change_password">
            <div class="container">
                <form method="POST" name='chang_passwords'>
                  <div class="mb-3">
                    <label for="old_password" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" id="old_password" required>
                    <code id="old_passwords" style="display: none;"></code>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" required>
                    <code id="new_passwords" style="display: none;"></code>
                </div>
                <div class="mb-3">
                    <label for="confirm_new_password" class="form-label">Repeat New Password</label>
                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" required>
                    <code id="confirm_passwords" style="display: none;"></code>
                </div>
                <code class="mb-3" id="whole_pass" style="display: none;"></code>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-danger" name="cancel" id="cancel">Cancel</button>
            </form>
            
        </div>
    </div>
</body>
</html>
<?php 

if(isset($_POST)){
    if((!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password']))){
            // echo "<script> alert('Its submited')</script>";
        if(strlen($_POST['new_password']) >= 8){
            if($_POST['new_password'] == $_POST['confirm_new_password']){
             $new_password = md5($_POST['new_password']);
             $old_password = md5($_POST['old_password']);
             $stud_id = $_SESSION['student_id'];
             if($old_password == $_SESSION['password']){

                $sql = "UPDATE patient set password = '$new_password' WHERE student_id = '$stud_id'";
                $res = mysqli_query($conn, $sql);
                if($res){
                  echo "<script> alert('Password changed successfully');</script>";
                  $_SESSION['password'] = $new_password;
                  header("location:../index.php");
                  
             }else{
                echo "<script> document.getElementById('whole_pass').style.display = 'block';
                document.getElementById('whole_pass').innerHTML = 'Password Not Updated';
                </script>";

            }

        }else{
            echo "<script>document.getElementById('whole_pass').style.display = 'block';
                document.getElementById('whole_pass').innerHTML = 'Incorrect password';
                 </script>";

        }

    }else
    echo "<script>document.getElementById('whole_pass').style.display = 'block';
    document.getElementById('whole_pass').innerHTML = 'New password is not matched with confirmed';</script>";
}else
    echo "<script> document.getElementById('whole_pass').style.display = 'block';
    document.getElementById('whole_pass').innerHTML = 'password length must be 8 or greater';
    </script>";

}
}

?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#cancel").click(function(){        
            location.href="../index.php";       
        });
    });
</script>
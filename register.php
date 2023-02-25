<?php

    include 'inc/Header.php';
    include 'inc/function.php';
?>
<?php
        if(isset($_POST['RegisterBtn']))
        {
                // print_r($_POST);
                $name=mysqli_real_escape_string($conn,$_POST['name']);
                $email=mysqli_real_escape_string($conn,$_POST['email']);
                $password=mysqli_real_escape_string($conn,$_POST['password']);
                $dob=mysqli_real_escape_string($conn,$_POST['dob']);

                if($name=='' || $email=='' || $password=='')
                {
                    $_SESSION['msg']="Plese fill all feilds";
                }else{
                       if(!dobCheck($dob))
                       {
                    $_SESSION['msg']="You are under Age of 18";
                       }else{
                                $query="select * from user_vote where email='$email'";
                                $run_query=mysqli_query($conn,$query);
                                if(mysqli_num_rows($run_query)>0)
                                {
                                    $_SESSION['msg']="You are Already Registered";
                                }
                                else{
                                    $SALT=password_hash($password,PASSWORD_BCRYPT);
                                    $query="INSERT INTO `user_vote`( `name`, `email`, `password`,dob) VALUES ('$name','$email','$SALT','$dob')";
                                    $run_query=mysqli_query($conn,$query);
                                if($run_query)
                                {
                                    $_SESSION['msg']="Success, You are Registered";
                                }   
                                else{
                                    $_SESSION['msg']="Something Went Wrong";
                                } 
                                }
                       }
                }
        }
?>

<script>
    document.body.classList.add("bg-success");
</script>

<div class="container d-flex bg-success justify-content-center align-items-center" style="height: 100vh;">
        <div class="form-group bg-warning col-sm-10 col-md-4 col-lg-4 p-4">
        <form action="" method="post">
        <div class="mb-3 bg-danger py-2">
            <h1 class="text-center text-light">Register Form</h1>
            </div>
            <div class="mb-3">
                    <?php
                            if(isset($_SESSION['msg']) && $_SESSION['msg']!='')
                            {
                                ?>
                                
                                <div class="alert alert-primary" role="alert">
                                    <?=$_SESSION['msg']?>
                    </div>
                                <?php
                                unset($_SESSION['msg']);
                            }

                    ?>
            </div>

            <div class="mb-3">
                <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Enter Your Email" class="form-control">
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Enter Your Password" class="form-control">
            </div>
            <div class="mb-3">
                <input type="date" name="dob"  class="form-control">
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button name="RegisterBtn" class="btn btn-danger">Register</button>
            </div>
            
            <div class="mb-3 d-flex justify-content-center">
                <a href="login.php" class="nav-link text-light">Already Have an Account &rarr;</a>
            </div>
        </form>
        </div>
</div>

    <?php

include 'inc/Footer.php';
?>
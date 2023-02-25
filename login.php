<?php

include 'inc/Header.php';
?>
<?php
if (isset($_POST['loginBtn'])) {
    // print_r($_POST);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($email == '' || $password == '') {
        $_SESSION['msg'] = "Plese fill all feilds";
    } else {

        $query = "select * from user_vote where email='$email'";
        $run_query = mysqli_query($conn, $query);
        if (mysqli_num_rows($run_query) ==1) {
            $data=mysqli_fetch_assoc($run_query);
            $data_db=$data['password'];
            $result=password_verify($password,$data_db);
            if($result){
                $_SESSION['is_login']=$email;
                header('location:index.php');
            }
            else{
                $_SESSION['msg'] = "Something Went Wrong";
            }
        }
        else{
            $_SESSION['msg'] = "Account Not Found";
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
            <h1 class="text-center text-light">Login Form</h1>
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
            <input type="email" name="email" placeholder="Enter Your Email" class="form-control">
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Enter Your Password" class="form-control">
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <button name="loginBtn" class="btn btn-danger">Register</button>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <a href="register.php" class="nav-link text-light">Don't Have an Account &rarr;</a>
        </div>
    </form>
    </div>
</div>

<?php

include 'inc/Footer.php';
?>
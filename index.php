<?php

include 'inc/Header.php';
include 'inc/function.php';
// $_SESSION['name']="krishna bansal";
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}
else{
    $e=$_SESSION['is_login'];
    $q="SELECT * FROM `user_vote` WHERE email='$e'";
    $run=mysqli_query($conn,$q);
    if(mysqli_num_rows($run)==1)
    {
        $data=mysqli_fetch_assoc($run);
    }
}

?>
<?php
if(isset($_POST['logoutBtn']))
{
    unset($_SESSION['is_login']);
    session_destroy();
    header('location:login.php');
}
?>


<?php



if(isset($_POST['voting']))
{
    if(isset($_POST['vote']))
    {
            $vote=mysqli_real_escape_string($conn,$_POST['vote']);
            $arr=array('BJP','Congrees','SAPA','AAP');
            $e=$_SESSION['is_login'];
            if(in_array($vote,$arr))
            {
                    $q="UPDATE `user_vote` SET `is_voted`='1',`vote_for`='$vote' WHERE email='$e' and is_voted='0'";
                    $run=mysqli_query($conn,$q);
                    if($run)
                    {
                        $_SESSION['msg']="Vote Success";
                        header('location:index.php');

                    }
                    else{
        $_SESSION['msg']="Something Went Wrong";
                    }
            }
            else{
        $_SESSION['msg']="PLese Select Valid Party";

            }

    }else{
        $_SESSION['msg']="Plese Select Vote Party";
    }
}
?>



<script>
    document.body.classList.add("bg-success");
</script>

<div class="container py-5">
    <div class="row d-flex justify-content-around ">

        <div class="col-sm-5 bg-secondary p-4 py-5 mb-3">
            <div class="mb-3 text-light">
                <h3>Name: <?=ucwords($data['name'])?></h3>
            </div>
            <div class="mb-3 text-light">
                <p>Email: <?=$data['email']?></p>
            </div>
            <div class="mb-3 text-light">
                <p>DOB: <?=correctDOB($data['dob'])?></p>
            </div>
            <div class="mb-3">
              <form action="" method="post">
              <button class="btn btn-primary" name="logoutBtn">Logout</button>
              </form>
            </div>
        </div>
        <div class="col-sm-5 bg-info p-5">
           <?php
           if($data['is_voted'])
           {
            ?>
                    <h1 class="text-light">You already Voted for <?=$data['vote_for']?> </h1>
            
            <?php
           }else{
            ?>
            
            <form action="" method="post">
                <div class="mb-3">
                    <?php
                                if(isset($_SESSION['msg']) && $_SESSION['msg']!='')
                                {
                                    ?>
                                    <div class="alert alert-danger">
                                    <?=$_SESSION['msg']?>
                    </div>
                                    <?php
                                    unset($_SESSION['msg']);
                                }

                    ?>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" name="vote" type="radio" value="BJP">
                        </div>
                        <input value="BJP" disabled type="text" class="form-control">
                    </div>
                </div>

                
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" name="vote" type="radio" value="Congrees">
                        </div>
                        <input value="Congrees" disabled type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" name="vote" type="radio" value="SAPA">
                        </div>
                        <input value="SAPA" disabled type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" name="vote" type="radio" value="AAP">
                        </div>
                        <input value="AAP" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="mb-3 d-flex justify-content-center">
                    <button name="voting" class="btn btn-danger">Vote &rarr;</button>
                </div>



        </div>
        </form>
            <?php
           }
           ?>

    </div>
</div>
</div>


<?php

include 'inc/Footer.php';
?>
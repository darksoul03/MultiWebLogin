<?php
include "config.php";

$msg="";

if(isset($_POST['but_submit'])){
    $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);
    $usertype = mysqli_real_escape_string($con,$_POST['userType']);
    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from users where username='".$uname."' and password='".$password."' and usertype='".$usertype."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            
            switch ($usertype) {
                case "admin":
                    header('Location: admin.php');
                  break;
                case "til":
                    header('Location: til.php');
                  break;
                case "public":
                    header('Location: public.php');
                  break;
                default:
              }
              
        }else{
            $msg = "Username or Password is not correct!";
        }

    }

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>multiuser based login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="bg-dark">
   <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 bg-light mt-5 px-0">
                <h3 class="text-center text-light bg-danger p-3">Please login</h3>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="p-4">
                        <div class="form-group">
                                <input type="text" name="txt_uname" class="form-control form-control-lg" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                                <input type="password" name="txt_pwd" class="form-control form-control-lg" placeholder="Password" required>
                        </div>
                    <div class="form-group lead">
              <label for="userType"> I'm a :</label>
              <input type="radio" name="userType" value="admin" class="custom-radio" required>&nbsp;admin |
              <input type="radio" name="userType" value="til" class="custom-radio" required>&nbsp;til |
              <input type="radio" name="userType" value="public" class="custom-radio" required>&nbsp;public
                    </div>
                    <div class="form-group">
                        <input type="submit" name="but_submit" class="btn btn-danger btn-block">
                    </div>
                    <h5 class="text-danger text-center"><?= $msg; ?></h5>
                 </form>
          </div>

        </div>
   </div>

</body>

</html>


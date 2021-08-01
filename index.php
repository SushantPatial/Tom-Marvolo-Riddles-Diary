<?php

  session_start();
  ob_start();
  $error = "";
  $success = "";


  if (array_key_exists("logout", $_GET))
  {
    session_unset ($_SESSION);
    $_SESSION["id"] = "";
    setcookie("id", "", time() - 60*60);
    $_COOKIE["id"] = "";
  }
  else if ((array_key_exists("id", $_COOKIE) && $_COOKIE['id']))
  {
    header ("Location:tomriddlesdiary.php");
  }

  if ($_POST['submit'])
  {

    include("connection.php");


    if ($_POST['email'] == "")
    {
      $error .= "Email is missing.<br>";
    }
    if ($_POST['password'] == "")
    {
      $error .= "Password is missing.<br>";
    }

    if ($error != "")
    {
      $error = "The following field(s) were missing:<br>".$error;
    }
    else
    {

      if ($_POST['signup'] == 1)
      {

        $query = "SELECT `id` FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0)
        {
          $error = "This email address is already registered<br>";
        }
        else
        {
          $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

          if (!mysqli_query($link, $query))
          {
            $error = "Could not sign you up. Please try again later.<br>";
          }
          else
          {
            
            $query = "UPDATE `users` SET `password` = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = '".mysqli_insert_id($link)."' LIMIT 1";

            mysqli_query($link, $query);

            $success = "You have been registered successfully! Please login.";
          }

        }
      }
      else
      {

        $query = "SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."'";

        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_array($result);

        if (isset($row))
        {
          $hashedPassword = md5(md5($row['id']).$_POST['password']);

          if ($hashedPassword == $row['password'])
          {
            $_SESSION['id'] = $row['id'];

            if ($_POST['stay-logged-in'] == '1')
            {
              setcookie("id", $row['id'], time() + 60*60*24*365);
            }

            header("Location:tomriddlesdiary.php");
          }
          else
          {
            $error = "Incorrect Email/Password entered.<br>";
          }
        }
        else
        {
          $error = "Incorrect Email/Password entered.<br>";
        }
      }
    }
  }

?>

<?php include("header.php") ?>

  <body>

    <div class="container">


      <h4>Do you wish to enter the</h4>
      <h1>Chamber of Secrets</h1>

      <div class="form-container">
        <form method="post" id="signup-form">

          <div class="form-group">
            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email">
          </div>

          <div class="form-group">
            <input type="password" name="password" class="form-control" id="password" placeholder="Your Password">
          </div>

          <div class="form-group">
            <input type="hidden" name="signup" value=1>

            <input type="submit" name="submit" class="btn form-btn" value="Sign Up">
          </div>

          <p>Already registered? <a class="toggle-form" id="toggle">Login</a></p>

        </form>

        <form method="post" id="login-form">

          <div class="form-group">
            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email">
          </div>

          <div class="form-group">
            <input type="password" name="password" class="form-control" id="password" placeholder="Your Password">
          </div>

          <div class="form-group">
            <input type="checkbox" id="checkbox" name="stay-logged-in" value=1>&nbsp;&nbsp;Stay logged in
          </div>

          <div class="form-group">
            <input type="hidden" name="signup" value=0> 

            <input type="submit" name="submit" class="btn form-btn" value="Log In">
          </div>

          <p>Not registered? <a class="toggle-form" id="toggle">Sign in</a></p>

        </form>

      </div>

    </div>

    <div>
      <?php
        if ($error != "")
        {
          echo "<div class='alert alert-light alert-dismissible fade show'>".$error."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
        else if ($success != "")
        {
          echo "<div class='alert alert-light alert-dismissible fade show'>".$success."</div>";
        }
      ?>
    </div>

<?php include("footer.php") ?>


    

<?php

  session_start();

  $diaryContent = "";

  if (array_key_exists("id", $_COOKIE) && $_COOKIE['id'])
  {
    $_SESSION['id'] = $_COOKIE['id'];
  }

  if (array_key_exists("id", $_SESSION) && $_SESSION['id'])
  {

    include ("connection.php");

    $query = "SELECT `diary` FROM `users` WHERE id= '".$_SESSION['id']."'";

    $row = mysqli_fetch_array(mysqli_query($link, $query));

    $diaryContent = $row['diary'];
  }
  else
  {
    header ("Location:index.php");
  }

  include("header.php");

?>



  <body>

  <nav class="navbar navbar-expand-lg navbar-sticky">

    <div class="navbar-brand">&nbsp;&nbsp;T. M. RIDDLE'S DIARY</div>

    <div class="mr-auto"></div>

    <div class="form-inline my-2 my-lg-0">
      <a href='index.php?logout=1'><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button></a>
    </div>

    </div>
  </nav>

    <textarea id="diary" class="form-control"><?php if($diaryContent == "") {echo "The Chamber of Secrets has been opened, enemies of the heir ... beware";} echo $diaryContent ?></textarea>


<?php include("footer.php"); ?>
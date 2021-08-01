<?php

  $link = mysqli_connect("Your Server Name", "Your Server Username", "Your Server Password", "Your Server Username");

  if (mysqli_connect_error())
  {
    die ("Database connection error. Please try again later.");
  }

?>

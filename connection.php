<?php

  $link = mysqli_connect("shareddb-h.hosting.stackcp.net", "chamberofsecrets-3735f0dd", "m0hwpiapwx", "chamberofsecrets-3735f0dd");

  if (mysqli_connect_error())
  {
    die ("Database connection error. Please try again later.");
  }

?>
    <script>

      $(".toggle-form").click(function()
      {
        $("#signup-form").toggle();
        $("#login-form").toggle();
      });

      $('#diary').bind('input propertychange', function()
      {
        $.ajax(
        {
          method: "POST",
          url: "updatedatabase.php",
          data: { content: $("#diary").val() }
        });
      });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>
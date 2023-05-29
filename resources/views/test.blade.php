<!DOCTYPE html>
<html>
<head>
  <title>Ajax Example</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</head>
<body>
  <button id="changeButton">Change Text</button>

  <script>
    $(document).ready(function() {
      $("#changeButton").click(function() {
        $("#changeButton").text("New Text");
      });
    });
  </script>
</body>
</html>

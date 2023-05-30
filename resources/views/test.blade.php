<!DOCTYPE html>
<html>
<head>
  <title>Ajax Example</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</head>
<body>
  <button id="changeButton1">Change Text</button>
  <p>{{ $var ?? 'None'}}</p>
  <script>
    $(document).ready(function() {
      $("#changeButton1").click(function() {
        $("#changeButton1").text("Button 1");
      });
    });
  </script>
  <button id="changeButton2">Change Text</button>
  <p>{{ $var ?? 'None'}}</p>
  <script>
    $(document).ready(function() {
      $("#changeButton2").click(function() {
        $("#changeButton2").text("Button 2");
      });
    });
  </script>
  <button id="changeButton3">Change Text</button>
  <p>{{ $var ?? 'None'}}</p>
  <script>
    $(document).ready(function() {
      $("#changeButton3").click(function() {
        $("#changeButton3").text("Button 3");
      });
    });
  </script>
  <button id="changeButton4">Change Text</button>
  <p>{{ $var ?? 'None'}}</p>
  <script>
    $(document).ready(function() {
      $("#changeButton4").click(function() {
        $("#changeButton4").text("Button 4");
      });
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Console Display</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

  <input type="text" name="patients_name" id="patients_name" class="form-control" placeholder="Search Name">

  <script>
    $(document).ready(function() {
      // Attach the input event handler to the input field
      $('#patients_name').on('input', function() {
        // Get the current value of the input field
        var inputValue = $(this).val();

        // Display the value in the console
        alert(inputValue);
      });
    });
  </script>

</body>
</html>

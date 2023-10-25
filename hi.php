<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Datepicker with Clickable Calendar Icon</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome for the calendar icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Include Bootstrap-datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    @import url('https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css');
    .datepicker{
        margin-top:50px;
    }
</style>
</head>
<body>
    <div class="container mt-5">
        <h1>Bootstrap Datepicker Example</h1>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="datepicker">Select a Date:</label>
            <div class="input-group">
                <input type="text" id="datepicker" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text" id="calendar-icon"><i class="fi fi-rr-calendar-clock"></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include Bootstrap-datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize the datepicker with "auto" orientation
            $('#datepicker').datepicker({
                orientation: 'auto',
            });

            // Set the default value to the current date
            $('#datepicker').datepicker('setDate', new Date());

            // Add a click event to the calendar icon
            $('#calendar-icon').click(function () {
                $('#datepicker').datepicker('show');
            });

            // Close the datepicker when a date is selected
            $('#datepicker').on('changeDate', function () {
                $('#datepicker').datepicker('hide');
            });
        });
    </script>
</body>
</html>

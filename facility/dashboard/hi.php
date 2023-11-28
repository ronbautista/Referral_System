<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <!-- Your HTML content -->

    <div class="try"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

            if (isMobile) {
                console.log("Mobile device detected");
                $('.try').text("Yow");
            } else {
                console.log("Desktop device detected");
                $('.try').text("Ye");
            }
        });
    </script>
</body>
</html>

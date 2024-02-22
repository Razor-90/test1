<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel Alina Paint</title>
    <!-- Add your CSS and JavaScript files here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- In your HTML file, preferably at the end of the body tag -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/inputmask.min.js"></script>

</head>
<body>
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- Add this script after including the Inputmask.js library -->
<script>
    // Apply phone number mask to the input field with id "phone"
    Inputmask({"mask": "+7 (999) 999-99-99"}).mask("#phone");
</script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>NSLINDIA</title>
    <style>

  .loader {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    margin: 200px auto;

}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<script>
        // Set the original website URL
        var originalWebsiteUrl = "http://localhost/NSLINDIA/loader"; // Replace with the actual URL
        
        // Set the delay in milliseconds
        var delayInMilliseconds = 5000; // Adjust the delay as needed

        // Function to redirect to the original website after the delay
        function redirectToOriginalWebsite() {
            window.location.href = originalWebsiteUrl;
        }

        // Wait for the specified delay and then redirect
        setTimeout(redirectToOriginalWebsite, delayInMilliseconds);
    </script>
</head>
<body style="background-color: #000;">
    <center><h1 class="fade-down" style="color:#fff; font-size: 100px;">NSLINDIA<h1></center>
    <div class="loader">
    </div>
</body>
</html>

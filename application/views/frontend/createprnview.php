<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create PRN</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container mt-5">
        <div class="text-center">
            <span class="responsive-color" style="color: green;">
                <?php
                // Retrieve the PRNNO from the query parameter
                $PRNNO = isset($_GET['prnno']) ? $_GET['prnno'] : 'N/A';
                ?>
                <h3> PRN NO: <?php echo $PRNNO; ?></h3>
            </span>
        </div>
    </div>

</body>
</html>

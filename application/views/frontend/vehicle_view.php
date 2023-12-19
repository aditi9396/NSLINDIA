<!DOCTYPE html>
<html>
<head>
    <title>My Website</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .content {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f2f2f2;
    }

    h2 {
        color: #333;
    }

    h3 {
        color: #555;
        margin-top: 20px;
    }

    p {
        color: #777;
        margin-bottom: 10px;
    }

    /* Media Queries for Mobile */
    @media only screen and (max-width: 480px) {
        .content {
            padding: 10px;
        }

        h2 {
            font-size: 24px;
        }

        h3 {
            font-size: 18px;
        }
    }
</style>


<body>
    <div class="content">
        <h2>View Vehicle Details</h2>
        <?php if (isset($vehicle)) { ?>
            <h3>Vehicle ID: <?php echo $vehicle->id; ?></h3>
            <p>Model: <?php echo $vehicle->make_model; ?></p>
        <?php } ?>

        <h3>Vehicle Parts:</h3>
        <?php if (isset($vehicle_parts)) { ?>
            <?php foreach ($vehicle_parts as $part) { ?>
                <p>Part Name: <?php echo $part->part_name; ?></p>
                <p>Part Code: <?php echo $part->part_code; ?></p>
            <?php } ?>
        <?php } else { ?>
            <p>No parts available for this vehicle.</p>
        <?php } ?>
    </div>
</body>

</html>

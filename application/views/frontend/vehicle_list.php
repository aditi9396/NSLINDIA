<!DOCTYPE html>
<html>
<head>
    <title>Vehicle List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid blue;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #e6e6e6;
        }

        th {
            background-color: blue;
            color: white;
        }

        td a {
            display: inline-block;
            margin-right: 5px;
            color: blue;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: none;
        }

        p.error {
            color: red;
        }


        @media only screen and (max-width: 480px) {
           .table-container {
            max-height: 300px;
            overflow-y: auto;
        }
        table {
            font-size: 12px;
        }

        th, td {
            padding: 4px;
        }
    }
</style>



</head>
<body>
    <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
        <h2>Vehicle List</h2>
        <a class="btn btn-primary" href="<?php echo base_url('vehicle'); ?>">ADD NEWLY</a>
    </div>
    
    <?php if (isset($error)): ?>
        <p>Error: <?php echo $error; ?></p>
    <?php else: ?>
        <div class="table-container">
            <table>
                <tr>
                    <th>Registration Date</th>
                    <th>License Plate</th>
                    <th>Make Model</th>
                    <th>Ownership</th>
                    <th>Part Code</th>
                    <th>Part Name</th>  
                    <th>UIN</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($vehicles as $vehicle): ?>
                    <tr>
                        <td><?php echo $vehicle->registration_date; ?></td>
                        <td><?php echo $vehicle->license_plate; ?></td>
                        <td><?php echo $vehicle->make_model; ?></td>
                        <td><?php echo get_column_data('tbl_ownership','title','id = '.$vehicle->owner_id.''); ?></td>
                        <td><?php echo $vehicle->part_code; ?></td>
                        <td><?php echo $vehicle->part_name; ?></td>
                        <td><?php echo $vehicle->UIN; ?></td>
                        <td><?php echo $vehicle->date; ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?php echo base_url('viewdata/' . $vehicle->id); ?>">View</a>
                            <a class="btn btn-primary" href="<?php echo base_url('editdata/' . $vehicle->id); ?>">Edit</a>
                            <a class="btn btn-primary" href="<?php echo base_url('deletedata/' . $vehicle->id); ?>" onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</body>


</html>

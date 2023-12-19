<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    h2 {
        margin-top: 0;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    select {
        width: 300px;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    #vehicle_parts {
        margin-top: 20px;
    }

    .part {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .part label {
        width: 120px;
        display: inline-block;
        vertical-align: top;
    }

    .part input[type="text"],
    .part select {
        width: 200px;
    }

    #add_part {
        margin-top: 10px;
        padding: 8px 12px;
        border-radius: 4px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .remove_part {
        margin-left: 10px;
        padding: 6px 10px;
        border-radius: 4px;
        background-color: #f44336;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    button[type="submit"] {
        margin-top: 20px;
        padding: 10px 16px;
        border-radius: 4px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        cursor: pointer;
    }
</style>
<h2>Edit Vehicle</h2>

<?php echo form_open('vehicle/update/'.$vehicle->id); ?>
<div style="margin-bottom: 10px;">
    <label for="registration_date">Registration Date:</label>
    <input type="text" name="registration_date" value="<?php echo isset($vehicle->registration_date) ? $vehicle->registration_date : ''; ?>">
</div>

<div style="margin-bottom: 10px;">
    <label for="license_plate">License Plate:</label>
    <input type="text" name="license_plate" value="<?php echo isset($vehicle->license_plate) ? $vehicle->license_plate : ''; ?>">
</div>

<div style="margin-bottom: 10px;">
    <label for="make_model">Make/Model:</label>
    <input type="text" name="make_model" value="<?php echo isset($vehicle->make_model) ? $vehicle->make_model : ''; ?>">
</div>

<div style="margin-bottom: 10px;">
    <label for="ownership">Ownership:</label>
    <select name="ownership">
        <?php foreach ($ownership_list as $ownership): ?>
            <option value="<?php echo $ownership->id; ?>" <?php echo (isset($vehicle->owner_id) && $vehicle->owner_id == $ownership->id) ? 'selected' : ''; ?>><?php echo $ownership->title; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div id="vehicle_parts">
    <h3>Vehicle Parts</h3>
    <?php if (!empty($vehicle_parts)): ?>
        <?php foreach ($vehicle_parts as $part): ?>
            <div class="part">
                <label for="part_code">Part Code:</label>
                <input type="text" name="part_code[]" value="<?php echo isset($part->part_code) ? $part->part_code : ''; ?>" >

                <label for="part_name">Part Name:</label>
                <input type="text" name="part_name[]" value="<?php echo isset($part->part_name) ? $part->part_name : ''; ?>" >

                <label for="uin">UIN:</label>
                <input type="text" name="uin[]" value="<?php echo isset($part->UIN) ? $part->UIN : ''; ?>" >

                <label for="part_date">Date:</label>
                <input type="text" name="part_date[]" class="datepicker" value="<?php echo isset($part->part_date) ? $part->part_date : date('Y-m-d'); ?>" >

                <button type="button" class="remove_part">Remove Part</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="part">
            <label for="part_code">Part Code:</label>
            <input type="text" name="part_code[]" value="" >

            <label for="part_name">Part Name:</label>
            <input type="text" name="part_name[]" value="" >

            <label for="uin">UIN:</label>
            <input type="text" name="uin[]" value="" >

            <label for="part_date">Date:</label>
            <input type="text" name="part_date[]" class="datepicker" value="<?php echo date('Y-m-d'); ?>" >

            <button type="button" class="remove_part">Remove Part</button>
        </div>
    <?php endif; ?>
</div>

<button id="add_part" type="button">Add Part</button>

<input type="submit" class="btn btn-primary" value="Update">

<?php echo form_close(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $(document).ready(function() {
        const addPartButton = $('#add_part');
        const vehiclePartsContainer = $('#vehicle_parts');

        addPartButton.on('click', function() {
            const partDiv = $('<div>').addClass('part');

            const partCodeLabel = $('<label>').text('Part Code:');
            const partCodeInput = $('<input>').attr('type', 'text').attr('name', 'part_code[]');

            const partNameLabel = $('<label>').text('Part Name:');
            const partNameInput = $('<input>').attr('type', 'text').attr('name', 'part_name[]');

            const uinLabel = $('<label>').text('UIN:');
            const uinInput = $('<input>').attr('type', 'text').attr('name', 'uin[]');

            const partDateLabel = $('<label>').text('Date:');
            const partDateInput = $('<input>').attr('type', 'text').attr('name', 'part_date[]').addClass('datepicker');

            const removePartButton = $('<button>').attr('type', 'button').addClass('remove_part').text('Remove Part');

            partDiv.append(partCodeLabel, partCodeInput, partNameLabel, partNameInput, uinLabel, uinInput, partDateLabel, partDateInput, removePartButton);

            vehiclePartsContainer.append(partDiv);
        });

        vehiclePartsContainer.on('click', '.remove_part', function() {
            $(this).closest('.part').remove();
        });

        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: new Date()
        });
    });
</script>




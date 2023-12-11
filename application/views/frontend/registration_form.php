<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Registration Form</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        form {
            background-color: #fff;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        select {
            width: 300px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #4caf50;
        }

        #vehicle_parts {
            margin-top: 20px;
        }

        .part {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .part label {
            width: 120px;
            display: inline-block;
            vertical-align: top;
            color: #555;
        }

        .part input[type="text"],
        .part select {
            width: 200px;
            padding: 6px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .part input[type="text"]:focus,
        .part select:focus {
            outline: none;
            border-color: #4caf50;
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
            background-color: #301bc1;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover,
        #add_part:hover,
        .remove_part:hover {
            opacity: 0.9;
        }

        .error {
            color: #f44336;
            margin-top: 5px;
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border-radius: 4px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        
        .loader {
            position: fixed;
            top: 69%;
            left: 16%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .loader:before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            margin-top: -20px;
            margin-left: -20px;
            border-radius: 50%;
            border: 4px solid #f3f3f3;
            border-top-color: #3498db;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>
<body>
    <h2>Vehicle Registration Form</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('vehicle/save'); ?>

    <label for="registration_date">Registration Date:</label>
    <input type="text" id="registration_date" name="registration_date" value="<?php echo set_value('registration_date', date('Y-m-d')); ?>" required>

    <label for="license_plate">License Plate:</label>
    <input type="text" name="license_plate" id="license_plate" required>

    <label for="make_model">Make Model:</label>
    <input type="text" name="make_model" id="make_model">

    <label for="ownership">Ownership:</label>
    <select name="owner_id" id="ownership" required>
        <option value="">Select Ownership</option>
        <?php foreach ($ownership_list as $ownership): ?>
            <option value="<?php echo $ownership->id; ?>"><?php echo $ownership->title; ?></option>
        <?php endforeach; ?>
    </select>

    <div id="vehicle_parts">
        <h3>Vehicle Parts</h3>
        <div class="part">
            <label for="part_code">Part Code:</label>
            <input type="text" name="part_code[]" required>

            <label for="part_name">Part Name:</label>
            <input type="text" name="part_name[]" required>

            <label for="uin">UIN:</label>
            <input type="text" name="uin[]" required>

            <label for="part_date">Date:</label>
            <input type="text" name="part_date[]" class="datepicker" value="<?php echo date('Y-m-d'); ?>" required>
            <button type="button" class="remove_part">Remove Part</button>
        </div>
    </div>

    <button type="button" id="add_part">Add Part</button>
    <div>
        <button type="submit" id="submit_button">Submit</button>
        <div id="loader" class="text-center" style="display: none;">
          <div class="loader"></div>
      </div> 
  </div>
  <?php echo form_close(); ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script type="text/javascript">
    document.getElementById("submit_button").addEventListener("click", function() {
      var submit_button = document.getElementById("submit_button");
      var loader = document.getElementById("loader");
      submit_button.style.display = "none";
      loader.style.display = "block";
  });

</script>

<script>
    $(document).ready(function() {
        $("#registration_date").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: new Date()
        });

        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: new Date()
        });

        var partCount = 1;
        $("#add_part").click(function() {
            var partHTML = '<div class="part">' +
            '<label for="part_code">Part Code:</label>' +
            '<input type="text" name="part_code[]" required>' +
            '<label for="part_name">Part Name:</label>' +
            '<input type="text" name="part_name[]" required>' +
            '<label for="uin">UIN:</label>' +
            '<input type="text" name="uin[]" required>' +
            '<label for="part_date">Date:</label>' +
            '<input type="text" name="part_date[]" class="datepicker" required>' +
            '<button type="button" class="remove_part">Remove Part</button>' +
            '</div>';

            $("#vehicle_parts").append(partHTML);
            partCount++;
            $(".datepicker").datepicker();
        });

        $(document).on("click", ".remove_part", function() {
            $(this).closest(".part").remove();
            partCount--;
        });
    });
</script>
<?php if ($this->session->flashdata('success')): ?>
    <script>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    </script>
<?php endif; ?>


<?php if ($this->session->flashdata('error')): ?>
    <script>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    </script>
<?php endif; ?>

</body>
</html>

    <?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <style type="text/css">
    .table-container {
      width: 100%;
      overflow-x: auto;
    }
    #invtab {
      border-collapse: collapse;
      width: 100%;
    }
    #invtab th, #invtab td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }
    #invtab th {
      background-color: #2c2d58a3;
    }
    #invtab input[type="text"], #invtab select {
      width: 100%;
      padding: 5px;
      box-sizing: border-box;
    }
    @media (max-width: 768px) {
      #invtab {
        font-size: 12px;
      }
      .table-scroll {
        overflow-x: auto;
    }
    }
  </style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">View Feedback</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Feedback</li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="row">
            <div class="row grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

            <form method="post" action="<?= site_url('viewcustfeedbackdata'); ?>" id="dateFilterForm">
    <center>
        <label for="startdt">Select Start Date</label>
        <input type="date" name="startdt" id="startdt" required>

        <label for="enddt">Select End Date</label>
        <input type="date" name="enddt" id="enddt" required>

        <input type="submit" value="Show" class="btn btn-outline-dark btn-fw" id="Submit" name="date" class="btn btn-primary">
    </center>
</form>

<br>
<br>
<br>

<?php if (isset($viewcustfeedback)): ?>
    <div class="table-container">
        <table id="invtab">
            <thead class="table-primary">
                <tr align="center">
                    <th>SR NO</th>
                        <th>DATE</th>
                        <th>LR NO</th>
                        <th>LR DATE</th>
						<th>Material Quantity</th>
						<th>AREA</th>
						<th>COMPANY NAME</th>
						<th>PARTY NAME</th>
						<th>CONTACT PERSON </th>
                        <th>CONTACT PER MOBILE </th>
                        <th>PROBLEM</th>
                        <th>RESPONSE</th>
                        <th>FEEDBACK</th>
                        <th>CATEGORY</th>
                         <th>ENTRY USER</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewcustfeedback as $row): ?>
                    <tr>
                        <td><?= $row->id ?></td>
                        <td><?= $row->Date ?></td>
                        <td><?= $row->LRNO ?></td>
                        <td><?= $row->LRDate ?></td>
                        <td><?= $row->PkgsNo ?></td>
                        <td><?= $row->ToPlace ?></td>
                        <td><?= $row->Consignee ?></td>
                        <td><?= $row->Consignor ?></td>
                        <td><?= $row->PersonName ?></td>
                        <td><?= $row->PersonMobile ?></td>
                        <td><?= $row->Problem ?></td>
                        <td><?= $row->Responce ?></td>
                        <td><?= $row->Feedback ?></td>
                        <td><?= $row->EntryUser ?></td>
                        <td><?= $row->CATEGORY ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>







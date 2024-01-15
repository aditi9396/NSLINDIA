
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

    #invtab th,
    #invtab td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    #invtab th {
        background-color: #2c2d58a3;
    }

    #invtab input[type="text"],
    #invtab select {
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
            <h3 class="page-title">LR TRACKING</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">LR Tracking</li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="row">
            <div class="row grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                       
                            <div class="table-container">
                                
                                                                    <?php
                           function getStatusMessage($status, $row)
{
    switch ($status) {
        case 1:
            return "Stock and Available for DRS/THC at " . $row['CurrentLocation'];
        case 2:
            return "Cancelled At " . $row['CurrentLocation'] . " By " . $row['CancelUser'];
        case 3:
            return "Gone For Delivery vide DRS No. " . $row['DRS_THCNO'];
        case 4:
            return "In Transit Between " . $row['CurrentLocation'] . " and " . $row['NextLocation'];
        case 5:
            return "Delivered At " . $row['CurrentLocation'] . " Rec. By Customer " . $row['DRS_THCNO'];
        case 6:
            return "UnDelivered vide DRS No. " . $row['DRS_THCNO'] . ". Stock and Available for DRS at " . $row['CurrentLocation'];
        case 8:
            return "UNDER LOADINGSHEET " . $row['LSNO'] . ". AT " . $row['CurrentLocation'] . " FOR DRS";
        case 9:
            return "UNDER LOADINGSHEET " . $row['LSNO'] . ". AT " . $row['CurrentLocation'] . " FOR THC";
        default:
            return "Unknown Status";
    }
}



                            ?>

    <?php if (!empty($result)): ?>
        <table id="invtab">
                                    <thead class="table-primary">
                                        <!-- Add your table header here if needed -->
                                    </thead>
                                    <tbody>
            <tr>
                                                <td><strong>LR No.</strong></td>
                                                <td><?= $result['LRNO'] ?></td>
                                                <td><strong>LR Date</strong></td>
                                                <td><?= $result['LRDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Place</strong></td>
                                                <td><?= $result['ToPlace'] ?></td>
                                                <td><strong>PAYMENT TYPE</strong></td>
                                                <td><?= $result['PayBasis'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Consigner</strong></td>
                                                <td><?= $result['Consignor'] ?></td>
                                                <td><strong>Consignee</strong></td>
                                                <td><?= $result['Consignee'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Quantity</strong></td>
                                                <td><?= $result['PkgsNo'] ?></td>
                                                <td><strong>Weight</strong></td>
                                                <td><?= $result['ActualWeight'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>INVOICE NO</strong></td>
                                                <td><?= $result['InvoiceNo'] ?></td>
                                                <td><strong>E WAY BILL NO</strong></td>
                                                <td><?= $result['EWBNo'] ?></td>
                                            </tr>
                                            <tr>    
                                                <td><strong>Statement NO</strong></td>
                                                <td><?= $result['StatementNos'] ?></td>
                                                <td><strong>Statement Date</strong></td>
                                                <td><?= $result['StatementDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total LR cost</strong></td>
                                                <td><?= $result['SINGLR_LR_COST'] ?></td>
                                                <td><strong>DocketTotal</strong></td>
                                                <td><?= $result['DocketTotal'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>STATUS</strong></td>
                                           <td><?= getStatusMessage($result['Status'], $result) ?></td>
                                                <td><strong>CANCEL REASON</strong></td>
                                                <td><?= $result['CancelReason'] ?><td>
                                            </tr>
                                            <tr>
                                                <td><strong>TollFree Feedback</strong></td>
                                                <td><?= $result['Feedback'] ?>-<?= $result['EntryUser'] ?></td>
                                                <td><strong>Return LRNO</strong></td>
                                                <td><?= $result['ReturnLR'] ?></td>
                                            </tr>
                                      </tbody>  
                                       </table>  
                                       <br>
                                       <br>
                                   
                                        <table id="invtab">
                                    <thead class="table-primary">
                                        <!-- Add your table header here if needed -->
                                    </thead>
                                    <tbody>
                                       <tr>
                                                <td><strong>DRS No.</strong></td>
                                                <td><?= $result['DRSNO'] ?></td>
                                                <td><strong>DRS Date</strong></td>
                                                <td><?= $result['LRDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Vehicle No</strong></td>
                                                <td><?= $result['VehicleNo'] ?></td>
                                                <td><strong>Vendor Name</strong></td>
                                                <td><?= $result['VendorName'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Driver Name</strong></td>
                                                <td><?= $result['DriverName'] ?></td>
                                                <td><strong>Driver Mobile No</strong></td>
                                                <td><?= $result['DriverMobile'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Delivery Status</strong></td>
                                                <td>  <?php
                                        if ($result['Delivered'] == 0) {
                                            echo '<span style="color: red;">Not Delivered</span>';
                                        } else{
                                            echo "Delivered";
                                        }
                                        ?></td>
                                                <td><strong>Delivery Date</strong></td>
                                                <td><?= $result['DeliveryDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Statement No</strong></td>
                                                <td><?= $result['StatementNo'] ?></td>
                                                <td><strong>Statement Date</strong></td>
                                                <td><?= $result['StatementDate'] ?></td>
                                            </tr>
                                            <tr>    
                                                <td><strong>======</strong></td>
                                                <td>=====</td>
                                                <td><strong>DRS Single LR Cost</strong></td>
                                                <td><?= $result['SINGLR_LR_COST'] ?></td>
                                            </tr>
                                             <tr>
                                                <td><strong>Profit</strong></td>
                                                <td><?= $lr_profit ?></td>
                                                <td><strong>Loss</strong></td>
                                                <td><?= $loss ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Image</strong></td>
                                           <td>=====</td>
                                                <td><strong>==</strong></td>
                                                <td>===<td>
                                            </tr>
                                            <tr>
                                                <td><strong>Cancelled</strong></td>

                                            <td>  <?php
                                        if ($result['Canceluser'] == '') {
                                          echo 'Not Cancelled</span>';
                                        } else{
                                            echo '<span style="color: red;">Cancelled</span>';
                                        }
                                        ?></td>                                               
                                         <td><strong>REASON</strong></td>
                                                <td><?= $result['Remark'] ?></td>
                                            </tr>
                                      </tbody>  
                                       </table>  


                                            <br>
                                            <?php
                                            if ($rate == 0) {
                                            echo $srrsy; 
                                            echo "Match not found";
                                            } else{
                                            echo $srrsy; 
                                            }
                                            ?>
                                       <br>
                                   
                                        <table id="invtab">
                                    <thead class="table-primary">
                                    </thead>
                                    <tbody>
                                       <tr>
                                                <td><strong>THC No.</strong></td>
                                                <td><?= $result['THCNO'] ?></td>
                                                <td><strong>THC Date</strong></td>
                                                <td><?= $result['THCdate'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Quantity</strong></td>
                                                <td><?= $result['Qty'] ?></td>
                                                <td><strong>RECEIVED QTY</strong></td>
                                                <td><?= $result['UpdatedQty'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>THC DEPOT</strong></td>
                                                <td><?= $result['Location'] ?></td>
                                                <td><strong>RECEIVED DEPOT</strong></td>
                                                <td><?= $result['Depot'] ?></td>
                                            </tr>
                                           
                                            <tr>
                                                <td><strong>Driver Name</strong></td>
                                                <td><?= $result['DriverNamethc'] ?></td>
                                                <td><strong>Driver Mobile No</strong></td>
                                                <td><?= $result['Drivermobailthc'] ?></td>
                                            </tr>
                                            <tr>    
                                                <td><strong>Vehicle No</strong></td>
                                                <td><?= $result['VehicleNothc'] ?></td>
                                                <td><strong>VendorName</strong></td>
                                                <td><?= $result['thcvendor'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>ARRIVAL REASON</strong></td>
                                                <td><?= $result['Reason'] ?></td>
                                                <td><strong>ArrivalDate</strong></td>
                                                <td><?= $result['ArrivalDate'] ?></td>
                                            </tr>
                                           
                                            <tr>
                                                <td><strong>THC Single LR Cost</strong></td>

                                               <td><?= $single_thcLR ?></td>
                                               
                                         <td><strong>Arrival User Name</strong></td>
                                                <td><?= $result['EmpName'] ?></td>
                                            </tr>

                                            <tr>
                                                <td><strong>Cancelled</strong></td>

                                            <td>  <?php
                                        if ($result['THCCanceluser'] == '') {
                                            echo 'Not Cancelled</span>';
                                        } else{
                                            echo '<span style="color: red;">Cancelled</span>';
                                        }
                                        ?></td>                                               
                                         <td><strong>REASON</strong></td>
                                                <td><?= $result['Reason'] ?></td>
                                            </tr>
                                      </tbody>  
                                       </table>  
                                      <?php 
echo "<br><br><br>Total DRS cost=" . round($totallrcost, 2);
echo "Total THC cost=" . round($single_thcLR, 2) . "<br>";
$totalthccost = 0;
$total11 = round($totallrcost, 2) + round($totalthccost, 2);
echo "<h3>Total LR Cost= $total11</h3>
<input type='hidden' name='tst' id='tst' value='$total11'>";
?>



    <?php else: ?>
    <?php endif; ?>

    
</div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
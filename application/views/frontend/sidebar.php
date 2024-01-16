<div class="container-fluid page-body-wrapper">
  <!-- partial:../../partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="assets/images/IMG-20230524-WA0014.jpg" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2 ">
              <?php 
              $emp = array("EmpName");
              echo $user->EmpName;  
              ?>
            </span>
            <span class="text-secondary text-small">
              <?php 
              $emp = array("Designation","Depot");
              echo $user->Designation  . "  ||  " . $user->Depot;  
              ?>
            </span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
           <!--  <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/buttons.html">Buttons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">Typography</a></li>
                </ul>
              </div>
            </li> -->
           <!--  <li class="nav-item">
              <a class="nav-link" href="../../pages/icons/mdi.html">
                <span class="menu-title">Icons</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="../../pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Forms</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse show" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link active" href="lr-generataion"> LRGENRATION </a></li>
                  <li class="nav-item"> <a class="nav-link" href="LR_cancel">LR CANCEL</a></li>
                  <li class="nav-item"> <a class="nav-link" href="Createprn">CREATE PRN </a></li>
                  <li class="nav-item"> <a class="nav-link" href="fetchprnwise">ARRIVAL PRN </a></li>
                  <li class="nav-item"> <a class="nav-link" href="createdrs">CREATE DRS </a></li>
                  <li class="nav-item"> <a class="nav-link" href="register"> REGISTER </a></li>
                  <li class="nav-item"> <a class="nav-link" href="thcarrival"> THC ARRIVAL </a></li>
                  <li class="nav-item"> <a class="nav-link" href="thc_cancel"> THC CANCEL </a></li>
                  <li class="nav-item"> <a class="nav-link" href="drs_cancel"> DRS CANCEL </a></li>
                  <li class="nav-item"> <a class="nav-link" href="verify_POD">VERIFY POD </a></li>
                  <li class="nav-item"> <a class="nav-link" href="PODSTATEMENT">POD STATEMENT </a></li>
                  <li class="nav-item"> <a class="nav-link" href="verify_THC">VERIFY THC</a></li>
                  <li class="nav-item"> <a class="nav-link" href="vehiclemaster">MASTER VEHICLE</a></li>
                  <li class="nav-item"> <a class="nav-link" href="customermaster">MASTER CUSTOMER</a></li>
                  <li class="nav-item"> <a class="nav-link" href="vendormaster">MASTER VENDOR</a></li>
                  <li class="nav-item"> <a class="nav-link" href="tripsheet">THRIPSHEET EXPENSES</a></li>
                  <li class="nav-item"> <a class="nav-link" href="locationmaster">MASTER LOCATION</a></li>
                  <li class="nav-item"> <a class="nav-link" href="citymaster">MASTER CITY</a></li>
                  <li class="nav-item"> <a class="nav-link" href="CreateDrsProfitApprovalForm">DRS APPROVAL FORM </a></li>
                  <li class="nav-item"> <a class="nav-link" href="DRSProfitApprovalReport">DRS APPROVAL REPORT </a></li>
                  <li class="nav-item"> <a class="nav-link" href="user_view">SPARE PART</a></li>
                  <li class="nav-item"> <a class="nav-link" href="spare_view">SPARE DETAILS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="VehicleIncidentTracker_view">VEHICLE INCIDENT TRACKER</a></li>
                  <li class="nav-item"> <a class="nav-link" href="lrtracking">LR TRACKING</a></li>
                  <li class="nav-item"> <a class="nav-link" href="sales_register">SALES REGISTER</a></li>
                  <li class="nav-item"> <a class="nav-link" href="cp_sales_register">CP SALES REGISTER</a></li>
                   <li class="nav-item"> <a class="nav-link" href="DRS_sales_register">DRS SALES REGISTER</a></li> <li class="nav-item"> <a class="nav-link" href="THC_sales_register">THC SALES REGISTER</a></li>
                  <li class="nav-item"><a class="nav-link" href="ExcelLR">EXCEL UPLOAD</a></li>
                  <li class="nav-item"><a class="nav-link" href="Pageaccess">PAGE ACCESS</a></li>
                </ul>
              </div>
            </li>

          </ul>
        </nav>

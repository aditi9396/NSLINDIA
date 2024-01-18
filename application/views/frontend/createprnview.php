    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">CREATE PRN</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Forms</a></li>
                      <li class="breadcrumb-item active" aria-current="page">CREATEPRN Form</li>
                  </ol>
              </nav>
          </div>
          <br>
          <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="container mt-5">
                        <div class="text-center">
                            <span class="responsive-color" style="color: green;">
                                <?php
                                $PRNNO = isset($_GET['prnno']) ? $_GET['prnno'] : 'N/A';
                                ?>
                                <h3> PRN NO: <?php echo $PRNNO; ?></h3>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

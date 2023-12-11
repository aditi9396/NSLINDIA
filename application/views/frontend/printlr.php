<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<div class="container">
  <div class="text-center">
    <h1 class="text-primary">CPVOLUMETRIC LR NO.<?php echo $this->uri->segment(2);?> Created Successfully</h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Document Name</th>
            <th scope="col">Document Number</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center">
            <td>LR</td>
            <td><?php echo $this->uri->segment(2);?></td>
            <td>
              <div class="row d-flex">
                <button class="btn btn-outline-dark btn-fw" onclick="window.open(base_url+'lrlazervolumetric?LRNO=<?php echo $this->uri->segment(2);?>', '_blank', 'width=1200,height=600');">LR Print</button>
                <button class="btn btn-outline-dark btn-fw" onclick="window.open(base_url+'stickerprint?LRNO=<?php echo $this->uri->segment(2);?>', '_blank', 'width=1200,height=600');">Sticker Print</button>
                <button class="btn btn-outline-dark btn-fw" onclick="window.open('declaration.php?LRNO=<?php echo $this->uri->segment(2);?>', '_blank', 'width=1200,height=600');">Declaration Print</button>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="3"></td>
          </tr>
          <tr>
            <td colspan="2">
              <a href="<?php echo base_url('lr-generataion/' . $this->uri->segment(2)); ?>" id="backLink">Click Here for more LR Entry.</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

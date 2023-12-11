<div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">Select simple State and get bellow Related City</div>
      <div class="panel-body">
<!-- Devloped by Pakainfo.com free download examples -->
            <div class="form-group">
                <label for="title">Please Select State:</label>
                <select name="state" class="form-control" style="width:350px">
                    <option value="">--- Select State ---</option>
                    <?php
                        foreach ($states as $key => $value) {
                            echo "<option value='".$value->id."'>".$value->name."</option>";
                        }
                    ?>
                </select>
            </div>
<!-- Devloped by Pakainfo.com free download examples -->
            <div class="form-group">
                <label for="title">Select Your City:</label>
                <select name="live_city" class="form-control" style="width:350px">
                </select>
            </div>
<!-- Devloped by Pakainfo.com free download examples -->
      </div>
    </div>
</div>
<script type="text/javascript">
   
    // $(document).ready(function() {
        $('select[name="state"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/liveform/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="live_city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="live_city"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="live_city"]').empty();
            }
        });
    // });
</script>
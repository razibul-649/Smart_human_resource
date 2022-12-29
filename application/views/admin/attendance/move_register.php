<?php
/* Leave Application view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>

<div class="box mb-4 <?php echo $get_animate;?>">
  <div id="accordion">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo 'Add Movement leave';?></h3>
      <div class="box-tools pull-right"> <a class="text-dark collapsed" data-toggle="collapse" href="#add_form" aria-expanded="false">
        <button type="button" class="btn btn-xs btn-primary"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('xin_add_new');?></button>
        </a> 
      </div>
    </div>

    <div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
      <div class="box-body">
        <?php $attributes = array('id' => 'move_register', 'autocomplete' => 'off', 'class' => 'add form-hrm');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/attendance/create_move_register', $attributes, $hidden);?>



        <div class="bg-white">
          <div class="box-block">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="date">Date</label>
                  <input class="form-control date" placeholder="date..." name="date" type="text" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="out_time">Office out time</label>
                  <input class="form-control  timepicker clear-1" placeholder="Office out time" name="out_time" type="text" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="in_time">Office in time</label>
                  <input class="form-control  timepicker clear-2" placeholder="Office in time" name="in_time" type="text" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="summary">Reason</label>
                  <textarea class="form-control" placeholder="reason" name="reason" cols="30" rows="3" id="reason"></textarea>
                </div>
              </div>
            </div>
            <div class="form-actions box-footer">
              <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>


<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title">Movement leave list</h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="example">
        <thead>
          <tr>
            <th style="width:120px;">No.</th>
            <th style="width:100px;">Date</th>
            <th style="width:100px;">Out time</th>
            <th style="width:100px;">In time</th>
            <th style="width:100px;">Status</th>
            <th style="width:100px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($results as $key => $row) { ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $row->date; ?></td>
              <td><?php echo $row->out_time; ?></td>
              <td><?php echo $row->in_time; ?></td>
              <td><?php echo ($row->status == 1)? "active":"Inactive"; ?></td>
              <td><a href="<?php echo base_url('admin/timesheet/delete_attn_file/'.$row->id); ?>" class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script>

  $(document).ready(function() {

    $('.clockpicker').clockpicker();
    var input = $('.timepicker').clockpicker({
      placement: 'bottom',
      align: 'left',
      autoclose: true,
      'default': 'now'
    });


    // file upload
    $("#move_register").on('submit', function(e) {
      var url = "<?php echo base_url('admin/attendance/create_move_register'); ?>";
      e.preventDefault();

      var okyes;
      okyes=confirm('Are you sure you want to leave?');
      if(okyes==false) return;

      $.ajax({
          url: url,
          type: 'POST',
          dataType: "json",
          data: new FormData(this),
          processData: false,
          contentType: false,
          cache : false,


          success: function(response){

            if(response.status == 'success') {
              alert(response.message)
            } else {
              alert(response.message)
            }
          },
          error: function(response) { 
            alert(response.message)
          }
      });
      return false;
    });


    $('#example').DataTable();

  });

</script>

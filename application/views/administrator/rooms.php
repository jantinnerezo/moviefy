
<div class="container">
  <div class="row admin-content">
   
        <!--  Messages section -->
         <?php if($this->session->flashdata('added')): ?>
               <div class="alert alert-success"><?php echo $this->session->flashdata('added'); ?></div>
         <?php endif; ?>

         <?php if($this->session->flashdata('existed')): ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('existed'); ?></div>
         <?php endif; ?>

          <?php if($this->session->flashdata('incomplete')): ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('incomplete'); ?></div>
         <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
               <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
         <?php endif; ?>

          <?php if($this->session->flashdata('error')): ?>
               <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
         <?php endif; ?>
        <!-- End Messages -->


        <!-- Toolbar section -->
        <div class="toolbar">
            <div class="row">
              <div class="col-md-4">
                <h2> <span class="glyphicon glyphicon-th-large"></span>  Rooms </h2>
              </div>


              <div class="col-md-4">
                
              </div>

              <div class="col-md-4 text-right">
                <div class="form-group">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> New room </a>
                </div>
               
              </div>
              
           
            </div>
        </div>

        <hr>

        <!-- End toolbar section -->

      <!-- Acounts section -->
       <?php if($rooms): ?>
               <div class="table-responsive">
                   <table  id="rooms_table" class="table table-striped table-bordered">
                     <thead>
                    
                       <th>Room ID</th>
                       <th>Name</th>
                       <th>Type</th>
                       <th>Status</th>
                       <th class="text-center">Options</th>
                     </thead>
                     <tbody>
                       <?php foreach($rooms as $room): ?>
                       <tr>
                        
                         <td><?php echo $room['room_id'];?></td>
                         <td><?php echo $room['room_name'];?></td>
                          <?php if($room['room_type'] == 1): ?>
                              <td> Regular  </td>
                         <?php endif; ?>

                          <?php if($room['room_type'] == 2): ?>
                              <td> 3D  </td>
                         <?php endif; ?>
                         <?php if($room['status'] == 0): ?>
                              <td class="bg-success" > Available  </td>
                         <?php endif; ?>

                          <?php if($room['status'] == 1): ?>
                              <td class="bg-danger"> Occupied  </td>
                         <?php endif; ?>

                       
                  
                         <td class="text-center">
                            <a href="<?php echo base_url();?>assets/img/rooms/<?php echo $room['room_img'];?>" data-fancybox="gallery"  class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
                            <button type="button" data-toggle="modal" data-id="<?php echo $room['room_id'];?>"  data-no="<?php echo $room['room_id'];?>"
                             data-name="<?php echo $room['room_name'];?>" 
                             data-room_type="<?php echo $room['room_type'];?>"
                             data-img="<?php echo $room['room_img'];?>" data-target="#editModal" class="btn btn-success edit"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </button>
                            <button class="btn btn-danger remove" data-toggle="modal" data-id="<?php echo $room['room_id'];?>" data-no="<?php echo $room['room_id'];?>" data-target="#confirmModal"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>
                          </td>
                       </tr>
                     <?php endforeach; ?>
                     </tbody>
                   </table>


               </div>
           
       <?php else: ?>
            <div class="alert alert-warning text-center">
               No room records
            </div>
       <?php endif; ?>
       <!-- End rooms section -->

       <!-- Add room Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-th-large"></span> New room</h4>
        </div>
        <?php echo form_open_multipart('admin/add_room'); ?>
        <div class="modal-body">

            <div class="form-group">
                <label> Room # </label>
                <input type="number" class="input-control" name="room_no"  required/>
            </div>

            <div class="form-group">
                 <label> Room Name </label>
                <input type="text" class="input-control" name="room_name"  required/>
            </div>

            <div class="form-group">
                <label> Room Photo </label>
                <input type="file" name="userfile" id="userfile">
            </div>

            <div class="form-group">
                <label for="type">Room Type:</label>
                <select name="room_type" class="input-control">
                  <option value="1">Regular</option>
                  <option value="2">3D</option>
                </select>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="admin" class="btn btn-primary">Add room</button>
        </div>
          <?php echo form_close(); ?>
      </div>
    </div>
  </div>



 <!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove room</h4>
      </div>
      <?php echo form_open('admin/rooms/remove_room'); ?>
        <div class="modal-body">
          <input type="hidden" id="room_id" name="room_id">
          <p id="message" class="lead"> </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Yes</button>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>




  <!-- end add modal -->

<!-- Edit room Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-th-large"></span> Edit room</h4>
        </div>
        <?php echo form_open_multipart('admin/edit_room'); ?>
        <div class="modal-body">

            <div class="form-group">
               <input type="hidden" class="input-control" name="room_id" id="room_id" required/>
                <label> Room # </label>
                <input type="number" class="input-control" name="room_no" id="room_no" required/>
            </div>

            <div class="form-group">
                <label> Room name </label>
                <input type="text" class="input-control" name="room_name" id="room_name" required/>
            </div>

            <div class="form-group">
                <label> Room photo </label>
                <input type="file" name="userfile" id="userfile">
                <input type="hidden" class="input-control" name="default_photo" id="default_photo" required/>
            </div>

            <div class="form-group">
                <label for="type">Room Type:</label>
                <select name="room_type" class="input-control">
                  <option value="1">Regular</option>
                  <option value="2">3D</option>
                </select>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit"  class="btn btn-primary">Save changes</button>
        </div>
          <?php echo form_close(); ?>
      </div>
    </div>
  </div>
     </div>


</div>

<script type="text/javascript">

  $('document').ready(function(){

    // Call datatable plugin
    $('#rooms_table').DataTable();


       $(document).on("click", ".edit", function () {
         var room_id = $(this).data('id');
         var room_no = $(this).data('no');
         var room_name = $(this).data('name');
         var room_type = $(this).data('room_type');
         var default_photo = $(this).data('img');
          
         $(".modal-body #room_id").val(room_id);
         $(".modal-body #room_no").val(room_no);
         $(".modal-body #room_name").val( room_name);
         $(".modal-body #room_type").val( room_type);
         $(".modal-body #default_photo").val(default_photo);
        
    });


        $(document).on("click", ".remove", function () {
         var room_id = $(this).data('id');
         var room_no = $(this).data('no');
 
          
         $(".modal-body #room_id").val(room_id);
         $(".modal-body #message").text('Are you sure you want to remove room # ' + room_no + '?');
       
        
    });



  });
</script>

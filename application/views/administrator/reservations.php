<div class="container-fluid">
  <div class="row admin-content">
      
        <?php if($this->session->flashdata('occupied')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('occupied'); ?>
            </div>
        <?php endif; ?>
        <!-- Toolbar section -->
        <div class="row">
          <div class="col-md-4">
            <?php if($reservations):?>

                 <h3><span class="glyphicon glyphicon-list"></span> Reservations (<?php echo count($reservations);?>)</h3> 
            <?php else: ?>
                  <h3><span class="glyphicon glyphicon-list"></span> Reservations (0)</h3> 
            <?php endif; ?>
          </div>
            <div class="col-md-4">
          </div>
            <div class="col-md-4 text-right">
               <div class="form-group">
                
              </div>
          </div>
        </div>
        <hr>

      <!-- Acounts section -->
       <?php if($reservations): ?>

                <div class="table-responsive">
                   <table  id="reservations_table" class="table table-striped table-bordered ">
                     <thead>
                       <th>Reservation #</th> 
                       <th>Name</th>
                       <th>Phone</th>
                       <th>Date</th>
                       <th>Time-in</th>
                       <th>Time-out</th>
                       <th>No. of persons</th>
                       <th>Room</th>
                       <th>Movie title</th>
                       <th>Type</th>
                       <th class="text-right">Fee</th>
                       <th>Status</th>
                       <th class="text-center">Options</th>
                     </thead>
                     <tbody>
                       <?php foreach($reservations as $reservation): ?>
                       <tr>
                         <td><?php echo $reservation['reservation_id'];?></td>
                         <td><?php echo $reservation['firstname'] . ' ' . $reservation['lastname'];?></td>
                         <td><?php echo $reservation['phone'];?></td>
                         <td><?php echo date('F d, Y',strtotime($reservation['reservation_date']));?></td>
                         <td><?php echo $reservation['time_in'];?></td>
                         <td><?php echo $reservation['time_out'];?></td>
                         <td><?php echo $reservation['person_count'];?></td>
                         <td><?php echo $reservation['room_name'];?></td>
                         <td><?php echo $reservation['movie_title'];?></td>
                            <?php if($reservation['reservation_type'] == 1): ?>
                                   <td>Walk-in</td>
                            <?php else: ?>
                                  <td>Reserved</td>
                            <?php endif;?>
                         <td class="text-right"> &#8369; <?php echo number_format($reservation['fee'], 2); ?></td>
                          <?php if($reservation['reservation_status'] == 0): ?>
                                <td class="text-center bg-success">Done</td>
                          <?php endif;?>
                          <?php if($reservation['reservation_status'] == 1): ?>
                                <td class="text-center bg-warning">Watching</td>
                          <?php endif;?>
                          <?php if($reservation['reservation_status'] == 2): ?>
                                 <td class="text-center bg-danger">Pending</td>
                          <?php endif;?>
                         <td class="text-center">

                            <?php if($reservation['reservation_type'] == 1): ?>
                            <?php else: ?>
                                 <a href="<?php echo base_url();?>admin/reservations/reserved?reservation_id=<?php echo $reservation['reservation_id'];?>&room_id=<?php echo $reservation['room_id'];?>" class="btn btn-success"><span class="glyphicon glyphicon-check"></span></a>
                            <?php endif; ?>
                          

                            <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id'];?>"/>
                            <a href="<?php echo base_url();?>admin/reservations/remove?reservation_id=<?php echo $reservation['reservation_id'];?>&room_id=<?php echo $reservation['room_id'];?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

                            <a href="<?php echo base_url();?>admin/reservations/check_out?reservation_id=<?php echo $reservation['reservation_id'];?>&room_id=<?php echo $reservation['room_id'];?>" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span></a>
                            
                             
                          </td>
                       </tr>
                     <?php endforeach; ?>
                     </tbody>
                   </table>


               </div>


              
           

           <div class="pagination-links">
                 <?php echo $this->pagination->create_links(); ?>
           </div>
       <?php else: ?>
            <div class="alert alert-warning text-center">
               No reservation records
            </div>
       <?php endif; ?>
       <!-- End reservations section -->


       <!-- Add reservation Modal -->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Walk-in reservation</h4>
                </div>
                <?php echo form_open('admin/reservations/walkin'); ?>
                  <div class="modal-body">
                          <input type="hidden" name="request_type" value="r_admin">
                         <div class="form-group">
                        <input type="hidden" id="request" value="reservation">
                        <div class="form-group">
                            <label for="account">Customer name</label>
                            <select name="account_id" class="input-control">
                              <?php if($accounts):?>
                                  <?php foreach($accounts as $account): ?>
                                       <option value="<?php echo $account['account_id'];?>"><?php echo $account['firstname'] . ' '.$account['lastname'];?></option>
                                  <?php endforeach;?>
                              <?php endif;?>
                            </select>
                        </div>

                        <div class="form-group">
                          <label for="person_count">Number of persons</label>
                          <input type="number" class="input-control"  name="person_count"  required />
                        </div>

                         <div class="form-group">
                            <label for="room_id">Room #</label>
                            <select name="room_id" class="input-control">
                              <?php if($rooms):?>
                                  <?php foreach($rooms as $room): ?>
                                       <option value="<?php echo $room['room_id'];?>"><?php echo $room['room_no'];?></option>
                                  <?php endforeach;?>
                              <?php endif;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="movie_id">Movie</label>
                            <select name="movie_id"  class="input-control">
                              <?php if($movies):?>
                                  <?php foreach($movies as $movie): ?>
                                       <option value="<?php echo $movie['movie_id'];?>"><?php echo $movie['movie_title'];?></option>
                                  <?php endforeach;?>
                              <?php endif;?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Reservation type:</label>
                            <select name="reservation_type"  class="input-control">
                                <option value="1">Walk-in</option>
                                <option value="2">Reserved</option>
                            </select>
                        </div>

                        </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Done</button>
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
                  <h4 class="modal-title" id="myModalLabel">Delete reservation</h4>
                </div>
                <?php echo form_open('admin/reservations/remove_reservation'); ?>
                  <div class="modal-body">
                    <input type="hidden" id="reservation_id" name="reservation_id">
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
     </div>


</div>






<script type="text/javascript">

  $('document').ready(function(){

  
    // Call datatable plugin
    $('#reservations_table').DataTable();


  

  });
</script>

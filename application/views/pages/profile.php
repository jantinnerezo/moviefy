<div class="content-center">
  <div class="overlay"> </div>
	<div class="profile-form">
		<h3>Welcome <?php echo $this->session->userdata('name'); ?>!</h3>
		<p class="lead text-center">Reservation History</p>
		<?php if($reservations):?>
			 <div class="table-responsive">
                   <table  id="reservations_table" class="table table-striped table-bordered ">
                     <thead>
                       <th>Date</th>
                       <th>Time-in</th>
                       <th>Time-out</th>
                       <th>No. of persons</th>
                       <th>Room Name</th>
                       <th>Movie title</th>
                       <th>Type</th>
                       <th class="text-right">Fee</th>
                       <th>Status</th>
                      
                     </thead>
                     <tbody>
                       <?php foreach($reservations as $reservation): ?>
                       <tr>
                      
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
                     
                       </tr>
                     <?php endforeach; ?>
                     </tbody>
                   </table>


               </div>

		<?php else:?>
			<div class="alert alert-warning text-center">
				<p>No reservation history</p>
			</div>
		<?php endif;?>
	</div>
</div>
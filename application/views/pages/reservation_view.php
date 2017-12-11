

 <div class="about">
	<div class="profile-form">
		<h1 class="text-center">Reservation View</h1>
      <div class="container">
          <!-- Acounts section -->
       <?php if($reservations): ?>

                <div class="table-responsive">
                   <table  id="reservations_table" class="table table-striped table-bordered ">
                     <thead>
                       <th>Date</th>
                       <th>Time-in</th>
                       <th>Time-out</th>
                       <th>Room Name</th>
                       <th>Movie title</th>
                       <th>Type</th>
                 
                     </thead>
                     <tbody>
                       <?php foreach($reservations as $reservation): ?>
                       <tr>
                        
                         <td><?php echo date('F d, Y',strtotime($reservation['reservation_date']));?></td>
                         <td><?php echo $reservation['time_in'];?></td>
                         <td><?php echo $reservation['time_out'];?></td>
                         <td><?php echo $reservation['room_name'];?></td>
                         <td><?php echo $reservation['movie_title'];?></td>

                         <?php if($reservation['reservation_type'] == 1): ?>
                                <td>Walk-in</td>
                         <?php else: ?>
                               <td>Reserved</td>
                         <?php endif;?>

                       
                        
                      
                       </tr>
                     <?php endforeach; ?>
                     </tbody>
                   </table>


               </div>

       <?php else: ?>
            <div class="alert alert-warning text-center">
               No reservation records
            </div>
       <?php endif; ?>
      </div>
	</div>
</div>

<div class="reservation">
  <div class="overlay"> </div>
	<div class="login-form">
       <?php if($this->session->flashdata('success')): ?>
               <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
         <?php endif; ?>
    
         <?php if($this->session->flashdata('error')): ?>
               <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
         <?php endif; ?>

          <?php if($this->session->flashdata('existed')): ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('existed'); ?></div>
         <?php endif; ?>



	  <?php echo form_open('user/reservations/client_reservation/' . $movie_id); ?>
		

		<div class="form-group">
              <p class="lead">Number of persons</p>
              <input type="text" class="input-control"  placeholder="minimum of 3 and maximum of 9 persons" name="person_count"  required />
           </div>

		 <div class="form-group">
            <p class="lead">Room:</p>
            <select name="room_id" class="input-control">
              <?php if($rooms):?>
                  <?php foreach($rooms as $room): ?>
                       <option value="<?php echo $room['room_id'];?>"><?php echo $room['room_name'];?></option>
                  <?php endforeach;?>
              <?php endif;?>
            </select>
         </div>

        <div class="form-group" id="date">
          <p class="lead">Reservation date:</p>
          <input type="date" class="input-control"  name="reservation_date"  required />
        </div>

        <div class="form-group" id="time">
          <p class="lead">Reservation time:</p>
          <input type="time" class="input-control"  name="reservation_time"  required />
        </div>

        <div class="form-group">
             <button type="submit" class="btn btn-block btn-success">Reserve</button>
     	</div>

     <?php echo form_close();?>
	</div>
</div>
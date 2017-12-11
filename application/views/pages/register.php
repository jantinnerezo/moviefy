<div class="content-register">
	<div class="overlay2"></div>
	<div class="register-form">

	<?php if($this->session->flashdata('r_success_user')): ?>
		<div class="alert alert-success text-center">
			<?php echo $this->session->flashdata('r_success_user'); ?>
		</div>
	<?php endif;?>

	<?php if($this->session->flashdata('r_error_user')): ?>
		<div class="alert alert-danger text-center">
			<?php echo $this->session->flashdata('r_error_user'); ?>
		</div>

<?php endif;?>
	



	 <?php echo form_open('users/register'); ?>
	  	<input type="hidden" name="request_type" value="r_user">
		<div class="form-group">
			<h3 class="text-center"><?= $title ?></h3>
		</div>
		<div class="form-group">
			<label for="lastname">Last name</label>
			<input type="text" class="form-control" id="lastname" name="lastname"  required />
		</div>
		<div class="form-group">
			<label for="lastname">First name</label>
			<input type="text" class="form-control" id="firstname" name="firstname"  required />
		</div>
		<div class="form-group">
			<label for="lastname">Phone #</label>
			<input type="text" class="form-control" id="phone" name="phone" placeholder="09*********" required />
		</div>
		<div class="form-group">
			<label for="address">Home Address:</label>
			<textarea name="address" class="form-control" rows="4"></textarea>
		</div>
		<div class="form-group">
			<label for="lastname">E-mail address</label> <?php if($this->session->flashdata('existed')): ?> <label class="text-danger"> <?php echo $this->session->flashdata('existed'); ?> </label> <?php endif;?> 
			<input type="email" class="form-control" id="email" name="email" placeholder="Valid e-mail address" required />
		</div>
		<div class="form-group">
			<label for="lastname">Create a password</label>  <?php if(form_error('password')): ?> <label class="text-danger"> <?php echo form_error('password'); ?> </label> <?php endif;?> 
			<input type="password" class="form-control" id="password" name="password" placeholder="(Minimum of 8 characters)" required />
		</div>
		<div class="form-group">
			<label for="lastname">Confirm password</label>  <?php if(form_error('password2')): ?> <label class="text-danger"> <?php echo form_error('password2'); ?> </label> <?php endif;?> 
			<input type="password" class="form-control" id="password2" name="password2" placeholder="Match password created" required />
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-block btn-success" value="Register"/>
		</div>
	<?php echo form_close(); ?>


	
	</div>
</div>
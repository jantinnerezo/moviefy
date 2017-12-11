<div class="content-center">
	<div class="overlay"></div>
	<div class="login-form">

    <?php if($this->session->flashdata('success')): ?>
		<div class="alert alert-success text-center">
			<?php echo $this->session->flashdata('success'); ?>
		</div>
	<?php endif;?>

	  <?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger text-center">
			<?php echo $this->session->flashdata('error'); ?>
		</div>
	<?php endif;?>
	<?php if($this->session->flashdata('invalid')): ?>
		<div class="alert alert-danger text-center">
			<?php echo $this->session->flashdata('invalid'); ?>
		</div>
	<?php endif;?>

	<?php echo form_open('login'); ?>
		<div class="form-group">
			<h3 class="text-center"><span class="glyphicon glyphicon-log-in"></span> Login</h3>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="email" name="email" placeholder="E-mail" required />
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-block btn-success" value="Login"/>
		</div>
		<div class="form-group">
			<a href="<?php echo base_url();?>register" class="btn btn-block btn-danger"><span class="glyphicon glyphicon-pencil"></span> Register</a>
		</div>
	<?php echo form_close();?>
	</div>
</div>
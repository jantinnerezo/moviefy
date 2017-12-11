<div class="add_account">
    <div class="container">
      <?php if($this->session->flashdata('added')): ?>
          <div class="alert alert-success"> <?php echo $this->session->flashdata('added'); ?>  </div>
      <?php endif; ?>
      <?php if($this->session->flashdata('existed')): ?>
          <div class="alert alert-danger"> <?php echo $this->session->flashdata('existed'); ?>  </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-md-4">
        </div>

        <div class="col-md-4">
          <div class="form-group text-center">
              <h3> New Account </h3>
          </div>
          <?php echo form_open('admin/add_account'); ?>
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First name"/>

              <?php if(form_error('firstname')): ?>
                <div class="alert alert-warning"> <?php echo form_error('firstname'); ?> </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name"/>
                  <?php if(form_error('lastname')): ?>
                  <div class="alert alert-warning"> <?php echo form_error('lastname'); ?> </div>
                  <?php endif; ?>
            </div>

            <div class="form-group">
              <label> Account type: </label>
              <select class="form-control" name="user_type">
                  <option value="1"> Administrator </option>
                  <option value="2"> User </option>
              </select>
                <?php if(form_error('user_type')): ?>
                <div class="alert alert-warning"> <?php echo form_error('user_type'); ?> </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email"/>
                  <?php if(form_error('email')): ?>
                <div class="alert alert-warning"> <?php echo form_error('email'); ?> </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password"/>
                  <?php if(form_error('password')): ?>
                  <div class="alert alert-warning"> <?php echo form_error('password'); ?> </div>
                  <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password"/>
                  <?php if(form_error('password2')): ?>
                  <div class="alert alert-warning"> <?php echo form_error('password2'); ?> </div>
                  <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="phone" placeholder="Phone No."/>
                  <?php if(form_error('phone')): ?>
                  <div class="alert alert-warning"> <?php echo form_error('phone'); ?> </div>
                  <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-block btn-primary" value="Add account"/>
            </div>

          <?php echo form_close(); ?>

        </div>

        <div class="col-md-4">
        </div>
      </div>

    </div>
</div>

<div class="form-page">
    <div class="form-container">
        <h3 class="text-center"><?= $title ?></h3>

        <?php echo form_open('admin/accounts/edit_account'); ?>
    
         <?php foreach($profile as $prof): ?>
    
            <input type="hidden" name="account_id" value="<?php echo $prof['account_id'];?>"  class="form-control">

            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $prof['firstname'];?>">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $prof['lastname'];?>">
            </div>

            <div class="form-group">
                <label> Account type: </label>
                <select class="form-control" name="account_type">

                    <?php if($prof['account_type'] == 1): ?>
                        <option value="1"> Administrator </option>
                    <?php endif; ?>

                    <?php if($prof['account_type'] == 2): ?>
                        <option value="2"> Staff </option>
                    <?php endif; ?>

                    <?php if($prof['account_type'] == 3): ?>
                        <option value="3"> User </option>
                    <?php endif; ?>

                    <option value="1"> Administrator </option>
                    <option value="2"> Staff </option>
                    <option value="3"> User </option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $prof['phone'];?>">
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-block btn-success" value="Save changes">
            </div>
                

        <?php endforeach; ?>

        <?php echo form_close(); ?>
    </div>
</div>
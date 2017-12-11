<div class="container">
  <div class="row admin-content">
        <!--  Messages section -->
         <?php if($this->session->flashdata('added')): ?>
               <div class="alert alert-success"><?php echo $this->session->flashdata('added'); ?></div>
         <?php endif; ?>

         <?php if($this->session->flashdata('noimage')): ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('noimage'); ?></div>
         <?php endif; ?>

      
        <!-- End Messages -->


        <!-- Toolbar section -->
        <div class="toolbar">
            <div>
              <div class="form-group text-left">
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-picture"></span> Add new image </a>
              </div>
            </div>
        </div>
        <hr>
        <!-- End toolbar section -->

        <!-- Slideshows section -->
        <?php if($slideshows): ?>
            <div class="gal">
                <?php foreach($slideshows as $image): ?>
                  <a href="<?php echo base_url();?>admin/slideshows/remove?slide_id=<?php echo $image['slide_id'];?>" class="btn btn-danger img-del"><span class="glyphicon glyphicon-trash"></span></a>
                  <a href="<?php echo base_url();?>assets/img/slideshows/<?php echo $image['slide_img']; ?>" data-fancybox="gallery">
                     <img src="<?php echo base_url();?>assets/img/slideshows/<?php echo $image['slide_img']; ?>" alt="">
                  </a>
                <?php endforeach; ?>
            </div>
  
        <?php else: ?>
            
            <div class="alert alert-warning text-center">No slideshow images available</div>

        <?php endif; ?>

        <!-- End section -->

   
     </div>

  <!-- Add movie Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-picture"></span> New slideshow image</h4>
        </div>
        <?php echo form_open_multipart('admin/add_slideshow'); ?>
        <div class="modal-body">

             <div class="form-group">
                <label> Browse for image </label>
                <input type="file" name="userfile" id="userfile">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="admin" class="btn btn-primary">Add image</button>
        </div>
          <?php echo form_close(); ?>
      </div>
    </div>
  </div>

  <!-- end add modal -->


 
</div>

<script type="text/javascript">

  $('document').ready(function(){

  


  });
</script>

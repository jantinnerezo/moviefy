<div class="container">
  <div class="row admin-content">
        <!--  Messages section -->
         <?php if($this->session->flashdata('added')): ?>
               <div class="alert alert-success"><?php echo $this->session->flashdata('added'); ?></div>
         <?php endif; ?>

         <?php if($this->session->flashdata('success')): ?>
               <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
         <?php endif; ?>
    
         <?php if($this->session->flashdata('error')): ?>
               <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
         <?php endif; ?>

         <?php if($this->session->flashdata('existed')): ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('existed'); ?></div>
         <?php endif; ?>

          <?php if($this->session->flashdata('incomplete')): ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('incomplete'); ?></div>
         <?php endif; ?>  
        <!-- End Messages -->

         <?php if(validation_errors()): ?>
             <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
         <?php endif; ?>
       

        <div class="row">
          <div class="col-md-4">
            <?php if($movies):?>
                 <h3><span class="glyphicon glyphicon-film"></span> Movies (<?php echo count($movies);?>)</h3> 
            <?php else: ?>
                  <h3><span class="glyphicon glyphicon-film"></span> Movies (0)</h3> 
            <?php endif; ?>
            
          </div>
            <div class="col-md-4">
            
          </div>
            <div class="col-md-4 text-right">
               <div class="form-group">
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> New movie </a>
              </div>
          </div>
        </div>
        <hr>


        <!-- End toolbar section -->

      <!-- Acounts section -->
       <?php if($movies): ?>
              <!-- <div class="table-responsive">
                   <table  id="movies_table" class="table table-striped table-bordered">
                     <thead>
                       <th>#</th>
                       <th>Title</th>
                       <th>Genre</th>
                       <th>Description</th>
                       <th>views</th>
                       <th class="text-center">Options</th>
                     </thead>
                     <tbody>
                       <?php foreach($movies as $movie): ?>
                       <tr>
                         <td>
                            <?php echo $movie['movie_id'];?>    
                         </td>
                         <td><?php echo $movie['movie_title'];?></td>
                         <td><?php echo $movie['movie_genre'];?></td>
                         <td><?php echo word_limiter($movie['movie_description'], 10);?></td>
                         <td><?php echo $movie['view_count'];?></td>
                     
                         <td class="text-center">
                            <a href="#" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
                            <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id'];?>"/>
                            <a href="<?php echo base_url();?>admin/movies/edit_movie?movie_id=<?php echo $movie['movie_id'];?>" class="btn btn-success"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>
                            <a href="#" class="btn btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a>
                          </td>
                       </tr>
                     <?php endforeach; ?>
                     </tbody>
                   </table>


               </div> -->
       <section>
          <div class="row">
            <div class="input-group input-group-lg">
              <input type="text" class="form-control" id="search" placeholder="Search Movie" aria-describedby="sizing-addon1">
               <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-search"></span></span>
            </div>
            <input type="hidden" id="base_url" value="<?php echo base_url();?>">
        </section>
            <br>

            
               <?php foreach($movies as $movie): ?>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="<?php echo base_url();?>assets/img/posters/<?php echo $movie['movie_poster'];?>" alt="...">
                <div class="caption">
                  <h4><?php echo $movie['movie_title'];?></h4>
                  <p>Category: <?php echo $movie['category'];?> </p>
                  <p>Description: <?php echo word_limiter($movie['movie_description'], 5);?> </p>
                  <p>Views: <?php echo $movie['view_count'];?></p>
                     <p>Ratings: 
                    <?php if($movie['movie_ratings'] == 0): ?>
                           <span class="glyphicon glyphicon-star"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span> 
                    <?php endif; ?>

                      <?php if($movie['movie_ratings'] == 1): ?>
                           <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span> 
                    <?php endif; ?>

                      <?php if($movie['movie_ratings'] == 2): ?>
                           <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span> 
                    <?php endif; ?>

                      <?php if($movie['movie_ratings'] == 3): ?>
                           <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star-empty"></span>  <span class="glyphicon glyphicon-star-empty"></span> 
                    <?php endif; ?>

                    <?php if($movie['movie_ratings'] == 4): ?>
                           <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star-empty"></span> 
                    <?php endif; ?>


                     <?php if($movie['movie_ratings'] == 5): ?>
                           <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span>  <span class="glyphicon glyphicon-star ratings"></span> 
                    <?php endif; ?>
                   
                   
                  </p>
                
                  <p class="movie_btns"><button class="btn btn-success view" data-toggle="modal" data-id="<?php echo $movie['movie_id'];?>" data-img="<?php echo base_url() . 'assets/img/posters/'.$movie['movie_poster'];?>" data-title="<?php echo $movie['movie_title'];?>" data-genre="<?php echo $movie['category_id'];?>" data-dt="<?php echo Date('M d, Y',strtotime($movie['movie_date']));?>" data-description="<?php echo $movie['movie_description'];?>" data-trailer="<?php echo $movie['movie_trailer'];?>" data-count="<?php echo $movie['view_count'];?>" data-ratings="<?php echo $movie['movie_ratings'];?>" data-target="#viewModal" role="button"><span class="glyphicon glyphicon-eye-open"></span> View</button> <button class="btn btn-success edit" data-toggle="modal" data-id="<?php echo $movie['movie_id'];?>" data-img="<?php echo $movie['movie_poster'];?>" data-title="<?php echo $movie['movie_title'];?>" data-genre="<?php echo $movie['category_id'];?>" data-dt="<?php echo $movie['movie_date'];?>" data-description="<?php echo $movie['movie_description'];?>" data-trailer="<?php echo $movie['movie_trailer'];?>" data-target="#editModal" role="button"><span class="glyphicon glyphicon-pencil"></span> Edit</button> <button data-toggle="modal" data-id="<?php echo $movie['movie_id'];?>" data-name="<?php echo $movie['movie_title'];?>" data-target="#confirmModal" class="btn btn-danger remove" role="button"><span class="glyphicon glyphicon-trash"></span> Remove</button></p>

               
                </div>
              </div>
            </div>
              <?php endforeach; ?>
          </div>
        
           
       <?php else: ?>
            <div class="alert alert-warning text-center">
               No movie records
            </div>
       <?php endif; ?>
       <!-- End movies section -->
    
           <!-- Add movie Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-film"></span> New movie</h4>
              </div>
              <?php echo form_open_multipart('admin/add_movie'); ?>
              <div class="modal-body">

                   <div class="form-group">
                      <label> Poster </label>
                      <input type="file" name="userfile" id="userfile">
                  </div>

                  <div class="form-group">
                      <label> Title </label>
                      <input type="text" class="input-control" name="movie_title" placeholder="Pirates of Silicon Valley, The Social Network, The Conjuring" required/>
                  </div>

                  <div class="form-group">
                       <label> Category </label>
                        <select class="form-control" name="category_id">
                            <?php foreach($categories as $category):?>
                                 <option value="<?php echo $category['category_id'];?>"><?php echo $category['category'];?></option>
                            <?php endforeach;?>
                           
                        </select>
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="input-control" name="movie_description" placeholder="Movie Description" rows="4"></textarea>
                  </div>

                  <div class="form-group">
                       <label> Movie length </label>
                      <input type="text" class="input-control" placeholder="Movie lenght" name="movie_length"  />
                  </div>

                  <div class="form-group">
                       <label> Movie date </label>
                      <input type="date" class="input-control" name="movie_date"  />
                  </div>

                  <div class="form-group">
                       <label> Trailer </label>
                      <input type="text" class="input-control" name="movie_trailer" placeholder="Ex: https://www.youtube.com/embed/9z1A1R8RQZs" />
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" name="admin" class="btn btn-primary">Add movie</button>
              </div>
                <?php echo form_close(); ?>
            </div>
          </div>
        </div>

        <!-- end add modal -->


        <!-- Edit modal section -->

       <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-film"></span> Update movie</h4>
              </div>
              <?php echo form_open_multipart('admin/edit_movie'); ?>
              <div class="modal-body">
                  <input type="hidden" name="movie_id" id="movie_id">
                   <div class="form-group">
                      <label> Poster </label>
                      <input type="file" name="userfile" id="userfile" id="movie_poster" >
                  </div>

                  <input type="hidden" name="default_poster" id="default_poster" >

                  <div class="form-group">
                      <label> Title </label>
                      <input type="text" class="input-control" name="movie_title" placeholder="Pirates of Silicon Valley, The Social Network, The Conjuring" id="movie_title" required/>
                  </div>

                   <div class="form-group">
                       <label> Category </label>
                        <select class="form-control" name="category_id" id="category_id">
                            <?php foreach($categories as $category):?>
                                 <option value="<?php echo $category['category_id'];?>"><?php echo $category['category'];?></option>
                            <?php endforeach;?>
                        </select>
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="input-control" name="movie_description" rows="4" placeholder="Movie Description" id="movie_description"></textarea>
                  </div>

                  <div class="form-group">
                       <label> Movie date </label>
                      <input type="date" class="input-control" name="movie_date" id="movie_date"  />
                  </div>

                  <div class="form-group">
                       <label> Trailer </label>
                      <input type="text" class="input-control" name="movie_trailer" placeholder="Ex: https://www.youtube.com/embed/9z1A1R8RQZs" />
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" name="admin" class="btn btn-success">Save changes</button>
              </div>
                <?php echo form_close(); ?>
            </div>
          </div>
        </div>


        <!-- End edit modal -->

        <!-- Confirm Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Remove movie</h4>
            </div>
            <?php echo form_open('admin/movies/remove_movie'); ?>
              <div class="modal-body">
                <input type="hidden" id="movie_id" name="movie_id">
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

        <!-- Confirm Modal -->
      <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header view-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title"></h4>
            </div>
              <div class="modal-body view-modal">
                <input type="hidden" id="movie_id" name="movie_id">
                <div class="grid">
                  <div class="box">
                    <img src="" alt="">
                  </div>
                  <div class="box">
                    <h4 id="movie_title"></h4>
                     <h5 id="movie_genre"></h5>
                    <h5 id="movie_description" ></h5>
                     <h5 id="movie_date"></h5>
                     <h5 id="view_count"></h5>
                      <h5 id="ratings"></h5>
                  </div>
                    <div class="box">
                    
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>
      </div>

  </div>

</div>

<script type="text/javascript">

  $('document').ready(function(){


    $(document).on("click", ".edit", function () {
       var movie_id = $(this).data('id');
       var default_poster = $(this).data('img');
       var movie_title = $(this).data('title');
       var movie_genre = $(this).data('genre');
       var movie_description = $(this).data('description');
       var movie_date = $(this).data('dt');
       var date_length = $(this).data('date_length');
       var movie_trailer = $(this).data('trailer');
       $(".modal-body #movie_id").val( movie_id );
       $(".modal-body #default_poster").val( default_poster );
       $(".modal-body #movie_title").val( movie_title );
       $(".modal-body #category_id").val(  movie_genre );
       $(".modal-body #movie_date").val( movie_date );
       $(".modal-body #movie_length").val( movie_length );
       $(".modal-body #movie_description").val( movie_description );
       $(".modal-body #movie_trailer").val( movie_trailer );

    });

     $(document).on("click", ".remove", function () {
       var movie_id = $(this).data('id');
       var movie_name = $(this).data('name');
       $(".modal-body #movie_id").val( movie_id );
       $(".modal-body #message").text( 'Are you sure you want to remove ' + movie_name + '?' );
    });


      $(document).on("click", ".view", function () {
         var movie_id = $(this).data('id');
         var default_poster = $(this).data('img');
         var movie_title = $(this).data('title');
         var movie_genre = $(this).data('genre');
         var movie_description = $(this).data('description');
         var movie_date = $(this).data('dt');
         var movie_length = $(this).data('date_length');
         var view_count = $(this).data('count');
         var ratings = $(this).data('ratings');

         

         $(".modal-body #movie_id").val( movie_id );
         $(".modal-body img").attr("src", default_poster);
         $(".modal-header #title").text( movie_title );
         $(".modal-body #movie_title").text( movie_title );
         $(".modal-body #movie_genre").text('Category: ' + movie_genre );
         $(".modal-body #movie_date").text( 'Release date: ' + movie_date );
         $(".modal-body #movie_length").text( 'Release date: ' + movie_length );
         $(".modal-body #movie_description").text( movie_description );
         $(".modal-body #view_count").text( 'Views: '  + view_count);
         $(".modal-body #ratings").text('Ratings: ' + ratings + ' stars' );
    });

  

    // Call datatable plugin
    $('#movies_table').DataTable();


  });

      var base_url = $('#base_url').val();

      $(document).on("click", ".input-group-addon", function () {
            var search = $('#search').val();
            var url = base_url + '/admin/movies?search=' + search;
            window.location.href = url;
        });

</script>

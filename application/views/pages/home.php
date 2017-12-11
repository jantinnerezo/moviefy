<html>
   <body>
    <div id="fullpage">
        
        <section id="showcase">
        <div class="overlay"></div>
               <!--  Messages section -->
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success text-center">
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger text-center">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
         <?php endif; ?>
          
         <?php if($this->session->flashdata('existed')): ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('existed'); ?></div>
         <?php endif; ?>
        <!-- End Messages -->
            <img class="img-logo" src="<?php echo base_url();?>assets/img/logo3.png" alt="">
            <h1 class="showcase">High Definition movies for private viewing</h1>

        </section>
        
        <section class="section-title">
            <p><span class="glyphicon glyphicon-tags"></span> Movie rates</p>
        </section>

        <section id="rates">

                <div class="box1">
                    <h2> Regular movies </h2>
                    <hr>
                    <h3> &#8369; 300 for 3 Persons / &#8369; 75 Additional Person </h3>
                    
                </div>

                <div class="box2">
                    <h2> Extended Movies </h2>
                    <hr>
                    <h3> &#8369; 400 for 3 Persons / &#8369; 75 Additional Person </h3>
                    
                </div>

                <div class="box3">
                    <h2> 3D Movies </h2>
                    <hr>
                    <h3> &#8369; 500 for 3 Persons / &#8369; 100 Additional Person </h3>
                     
                </div>

       </section>
        <hr>
        <section class="section-title">
            <p><span class="glyphicon glyphicon-film"></span> Our Movies (<?php echo count($movies);?>)</p>
        </section>
        
        <!--<div class="container-fluid dark">
           <div class="row">
              <?php if($movies): ?>
                <?php foreach($movies as $movie): ?>
                   <div class="col-xs-6 col-md-2 hvr-grow" >
                    <a href="#" class="thumbnail">
                      <img src="<?php echo base_url();?>assets/img/posters/<?php echo $movie['movie_poster'];?>" alt="Split">
                    </a>
                    <h5 class="text-muted text-center"> <?php echo $movie['movie_title'];?> </h5>
                  </div>
                <?php endforeach; ?>
                <div class="text-center"><a href="#" class="btn btn-default">View all</a></div>
              <?php else: ?>
                  
                  <div class="text-center"><h2 class="text-muted">No movies to show</h2></div>
                  
              <?php endif; ?>
             
            </div>
        </div>-->

        <div class="container-fluid dark">
            <div class="movies">
             <?php if($movies): ?>
                <?php foreach($movies as $movie): ?>
                    <div class="box view hvr-grow" data-toggle="modal" data-id="<?php echo $movie['movie_id'];?>" data-img="<?php echo base_url() . 'assets/img/posters/'.$movie['movie_poster'];?>" data-title="<?php echo $movie['movie_title'];?>" data-genre="<?php echo $movie['category'];?>" data-dt="<?php echo Date('M d, Y',strtotime($movie['movie_date']));?>" data-description="<?php echo $movie['movie_description'];?>" data-trailer="<?php echo $movie['movie_trailer'];?>" data-count="<?php echo $movie['view_count'];?>" data-ratings="<?php echo $movie['movie_ratings'];?>" data-trailer="<?php echo $movie['movie_trailer'];?>" data-target="#viewModal" role="button">
                       <img src="<?php echo base_url();?>assets/img/posters/<?php echo $movie['movie_poster'];?>">
                       <h4 ><?php echo $movie['movie_title'];?></h4>
                    </div>
                <?php endforeach; ?>
                  <div class="box-more hvr-grow">
                      <a href="<?php echo base_url();?>movies">Show more</a>
                  </div>
              <?php else: ?>
                
                  
              <?php endif; ?>
            </div>
        </div>

        <section class="section-title">
            <p><span class="glyphicon glyphicon-star"></span> Happy Customers</p>
        </section>

        <section class="slideshows">
             <div class="container">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              
              <ol class="carousel-indicators">
                <?php foreach($slideshows as $key=>$value): ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key; ?>" class="active"></li>
                <?php endforeach; ?>
              </ol>
            
             
              
              <div class="carousel-inner" role="listbox">
                
                     <?php
                        $item_class = ' active';
                        foreach($slideshows as $image):
                        ?>
                        <div class="item<?php echo $item_class; ?>" id="carousel-item">
                            <img id="customers" src="<?php echo base_url();?>assets/img/slideshows/<?php echo $image['slide_img']; ?>" alt="">
                            <div class="carousel-caption"> 
                                
                            </div>
                        </div>
                     <?php  
                        $item_class = '';
                        endforeach;
                    ?>
              </div>
             
             
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>
        </div>
        </section>
        
       
        <hr>


      <div class="modal fade" id="viewModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header view-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title"></h4>
            </div>

             <?php echo form_open('admin/reservations/client_reserve'); ?>
              <div class="modal-body view-modal">
                <input type="hidden" id="movie_id" name="movie_id">
                 <input type="hidden" name="request_type" value="r_user">
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
                       <hr>


                    <?php if($this->session->userdata('logged_in')):?>

                        <div class="form-group" id="date">
                          <h3> Reserve Now </h3>
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

                        <div class="form-group" id="date">
                          <label>Reservation date:</label>
                          <input type="date" class="input-control"  name="reservation_date"   />
                        </div>

                        <div class="form-group" id="time">
                          <label>Reservation time:</label>
                          <input type="time" class="input-control"  name="reservation_time"   />
                        </div>

                        <div class="form-group">
                             <button type="submit" class="btn btn-block btn-success">Watch</button>
                        </div>

                        <?php echo form_close(); ?>
                    <?php else: ?>
                         <h3 class="text-light">Login to reserve</h3>
                    <?php endif;?>
                    
                    
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



<div class="modal fade product_view" id="viewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 product_img">
                        <img class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4 id="movie_title"></h4>
                        <p id="movie_genre"></p>
                        <p id="movie_description"></p>
                        <p id="movie_date"></p>
                        <div class="form-group">
                             <a id="movie_trailer">Watch Trailer</a>
                        </div>
                        <input type="hidden" id="base_url" value="<?php echo base_url();?>">
                       
                        <a  id="reserver_url"  class="btn btn-block btn-success"><span class="glyphicon glyphicon-eye-open"></span> Reserve</a>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     
       

  <script>
     $(document).ready(function(){

      $(document).on("click", ".view", function () {

         var movie_id = $(this).data('id');
         var default_poster = $(this).data('img');
         var movie_title = $(this).data('title');
         var movie_genre = $(this).data('genre');
         var movie_description = $(this).data('description');
         var movie_date = $(this).data('dt');
         var view_count = $(this).data('count');
         var ratings = $(this).data('ratings');
         var trailer = $(this).data('trailer');
         var base_url = $('#base_url').val();

         var a_href = $('#movie_trailer').attr('href');
         $(".modal-body #movie_id").val( movie_id );
         $(".modal-body img").attr("src", default_poster);
         $(".modal-header #title").text( movie_title );
         $(".modal-body #movie_title").text( movie_title );
         $(".modal-body #movie_genre").text('Category: ' + movie_genre );
         $(".modal-body #movie_date").text( 'Release date: ' + movie_date );
         $(".modal-body #movie_description").text( movie_description );
         $("#movie_trailer").attr('href',trailer);
         $("#reserver_url").attr('href',base_url + '/user/reservations/client_reservation/' + movie_id);
         $(".modal-body #view_count").text( 'Views: '  + view_count);
         $(".modal-body #ratings").text('Ratings: ' + ratings + ' stars' );

      


    });

        /*$('#fullpage').fullpage({
      anchors:['showcase', 'rates', 'movies']
    }); */
      window.sr = ScrollReveal({ reset: true });

      sr.reveal('.navbar-inverse',{
          duration:2000,
          origin:'top'
      });

      sr.reveal('.img-logo',{
          duration:2000,
          origin:'top'
      });

      sr.reveal('.showcase',{
          duration:2000,
          origin:'top'
      });


      sr.reveal('.box1',{
          duration:2000,
          origin:'left',
          distance:'300px',
          viewFactor: 0.2
      });
       sr.reveal('.box2',{
          duration:2000,
          origin:'left',
          distance:'300px',
          viewFactor: 0.2
      });

      sr.reveal('.box3',{
          duration:2000,
          origin:'left',
          distance:'300px',
          viewFactor: 0.2
      });

      sr.reveal('.section-title',{
          duration:1000,
          origin:'left',
          viewFactor: 0.2
      });
   

      $('.single-item').slick({
         dots: true,
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear'
      });


    });
  </script>
   </body>
</html>
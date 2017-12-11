   <section id="movies-cover">
      
            <h1><span class="glyphicon glyphicon-film"></span></h1>
            <h1>Movies</h1>
            <div class="container">
              <div class="row">
                  <div class="col-md-4 text-left">
                        <select id="category" class="form-control input-lg">
                              <option value="#">Choose category</option>
                              <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category['category_id'];?>"><?php echo $category['category'];?></option>
                              <?php endforeach;?>
                        </select>
                   </div>

                  <div class="col-md-6 text-right">

                      <div class="input-group input-group-lg search">
                        <input type="text" class="form-control" id="search" placeholder="Search Movies" aria-describedby="sizing-addon1">
                         <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-search"></span></span>
                      </div>
                   
                  </div>


              </div>
            </div>
             <input type="hidden" id="base_url" value="<?php echo base_url();?>">
   </section>

  <div class="container-fluid dark">
          <?php if($movies): ?>
            <div class="movies">
           
                <?php foreach($movies as $movie): ?>
                    <div class="box view hvr-grow" data-toggle="modal" data-id="<?php echo $movie['movie_id'];?>" data-img="<?php echo base_url() . 'assets/img/posters/'.$movie['movie_poster'];?>" data-title="<?php echo $movie['movie_title'];?>" data-genre="<?php echo $movie['category'];?>" data-dt="<?php echo Date('M d, Y',strtotime($movie['movie_date']));?>" data-description="<?php echo $movie['movie_description'];?>" data-trailer="<?php echo $movie['movie_trailer'];?>" data-count="<?php echo $movie['view_count'];?>" data-ratings="<?php echo $movie['movie_ratings'];?>" data-trailer="<?php echo $movie['movie_trailer'];?>" data-target="#viewModal" role="button">
                       <img src="<?php echo base_url();?>assets/img/posters/<?php echo $movie['movie_poster'];?>">
                       <h4 ><?php echo $movie['movie_title'];?></h4>
                    </div>
                <?php endforeach; ?>
            
            
            </div>
              <?php else: ?>
                      <div class="col-md-4">
                          
                      </div>
                      <div class="col-md-4 text-center">
                            <p class="lead results">No Movies Found!</p>
                      </div>
                      <div class="col-md-4">
                          
                      </div> 
                    
              <?php endif; ?>

          
                    
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

      var base_url = $('#base_url').val();

       $(document).on("click", ".input-group-addon", function () {
            var search = $('#search').val();
            var url = base_url + '/movies?search=' + search;
            window.location.href = url;
        });

         $(document).on("change", "#category", function () {
            var category = $('#category').val();
            var url = base_url + '/movies?category=' + category;
            window.location.href = url;
        });

        /*$('#fullpage').fullpage({
      anchors:['showcase', 'rates', 'movies']
    }); */
    


    });
  </script>
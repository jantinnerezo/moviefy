<div class="form-page">
    <div class="form-container">
        <h3 class="text-center"><?= $title ?></h3>

        <?php echo form_open('admin/movies/edit_movie'); ?>
    
         <?php foreach($movie as $mov): ?>
    
            <input type="hidden" name="movie_id" value="<?php echo $mov['movie_id'];?>"  class="form-control">
            <input type="hidden" name="old_img" value="<?php echo $mov['movie_poster'];?>"  class="form-control">
            
            <div class="form-group">
                <label> Poster </label>
                <input type="file" name="userfile" id="userfile">
            </div>

            <div class="form-group">
                <label> Title </label>
                <input type="text" class="form-control" name="movie_title" placeholder="Pirates of Silicon Valley, The Social Network, The Conjuring" id="movie_title" value="<?php echo $mov['movie_title'];?>" required/>
            </div>

            <div class="form-group">
                    <label> Genre </label>
                <input type="text" class="form-control" name="movie_genre" placeholder="Ex: Horror, Romance, Adventure, Thriller, Mystery, Action, Computer" value="<?php echo $mov['movie_genre'];?>"/>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="movie_description" rows="4" id="movie_description" ><?php echo $mov['movie_description'];?></textarea>
            </div>

            <div class="form-group">
                <label> Movie date </label>
                <input type="date" class="form-control" name="movie_date" value="<?php echo $mov['movie_date'];?>" />
            </div>

            <div class="form-group">
                <label> Trailer </label>
                <input type="text" class="form-control" name="movie_trailer" placeholder="Ex: https://www.youtube.com/embed/9z1A1R8RQZs" value="<?php echo $mov['movie_trailer'];?>" />
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-block btn-success" value="Save changes">
            </div>

        <?php endforeach; ?>

        <?php echo form_close();?>
    
    </div>
</div>

            

                        
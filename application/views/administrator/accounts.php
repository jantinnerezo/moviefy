<div class="container">
  <div class="row admin-content">
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

        <!-- Toolbar section -->
        <div class="row">
          <div class="col-md-4">
            <?php if($accounts):?>
                 <h3><span class="glyphicon glyphicon-user"></span> Accounts (<?php echo count($accounts);?>)</h3> 
            <?php else: ?>
                  <h3><span class="glyphicon glyphicon-user"></span> Accounts (0)</h3> 
            <?php endif; ?>
            
          </div>
            <div class="col-md-4">
            
          </div>
            <div class="col-md-4 text-right">
               <div class="form-group">
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> Add account </a>
              </div>
          </div>
        </div>
        <hr>

        <!-- End toolbar section -->

      <!-- Acounts section -->
       <?php if($accounts): ?>
               <div class="table-responsive">
                   <table  id="accounts_table" class="table table-striped table-bordered">
                     <thead>
                       <th><span class="oi oi-key"></span> Account #</th>
                       <th>Last name</th>
                       <th>First name</th>
                       <th><span class="oi oi-box"></span> E-mail address</th>
                       <th><span class="oi oi-phone"></span> Phone</th>
                       <th><span class="oi oi-home"></span> Address</th>
                       <th class="text-center"><span class="oi oi-cog"></span> Options</th>
                     </thead>
                     <tbody>
                       <?php foreach($accounts as $account): ?>
                       <tr>
                         <td><?php echo $account['account_id'];?></td>
                         <td><?php echo $account['lastname'];?></td>
                         <td><?php echo $account['firstname'];?></td>
                         <td><?php echo $account['email'];?></td>
                         <td><?php echo $account['phone'];?></td>
                         <td><?php echo $account['address'];?></td>
                       
                         <td class="text-center">
                          
                            <input type="hidden" name="account_id" value="<?php echo $account['account_id'];?>"/>
                                <button class="btn btn-success reserve" data-toggle="modal" data-id="<?php echo $account['account_id'];?>
                              " data-name="<?php echo $account['firstname'] . ' ' . $account['lastname'];?>" data-target="#reserveModal"><span class="oi oi-account-login"></span></button>


                            <button  class="btn btn-primary edit" data-toggle="modal" data-id="<?php echo $account['account_id'];?>" 
                              data-firstname="<?php echo $account['firstname'];?>"
                              data-lastname="<?php echo $account['lastname'];?>"
                              data-type="<?php echo $account['account_type'];?>"
                              data-target="#editAccount">
                              <span class="oi oi-pencil"></span></button>

                            <button class="btn btn-danger delete" data-toggle="modal" data-id="<?php echo $account['account_id'];?>
                              " data-name="<?php echo $account['firstname'] . ' ' . $account['lastname'];?>" data-target="#confirmModal"><span class="oi oi-trash"></span></button>
                           
                            
                             
                          </td>
                       </tr>
                     <?php endforeach; ?>
                     </tbody>
                   </table>


               </div>
           

           <div class="pagination-links">
                 <?php echo $this->pagination->create_links(); ?>
           </div>
       <?php else: ?>
            <div class="alert alert-warning text-center">
               No account records
            </div>
       <?php endif; ?>


        <!-- Add reservation Modal -->
          <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><span class="oi oi-account-login"></span> Reserve</h4>
                </div>
                <?php echo form_open('admin/reservations/reserve'); ?>
                  <div class="modal-body">
                          <input type="hidden" name="request_type" value="r_admin">
                          <input type="hidden" name="account_id" id="account_id">
                         <div class="form-group">
                         <input type="hidden" id="request" value="account">
                   

                        <div class="form-group">
                            <label id="id"></label>
                        </div>
                        <div class="form-group">
                            <label id="name"></label>
                        </div>

                        <div class="form-group">
                          <label for="person_count">Number of persons</label>
                          <input type="number" class="input-control"  name="person_count"  required />
                        </div>

                         <div class="form-group">
                            <label for="room_id">Room</label>
                            <select name="room_id" class="input-control">
                              <?php if($rooms):?>
                                  <?php foreach($rooms as $room): ?>
                                       <option value="<?php echo $room['room_id'];?>"><?php echo $room['room_name'];?></option>
                                  <?php endforeach;?>
                              <?php endif;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="movie_id">Movie</label>
                            <select name="movie_id"  class="input-control">
                              <?php if($movies):?>
                                  <?php foreach($movies as $movie): ?>
                                       <option value="<?php echo $movie['movie_id'];?>"><?php echo $movie['movie_title'];?></option>
                                  <?php endforeach;?>
                               <?php endif;?>
                            </select>
                        </div>

                         <div class="form-group">
                            <label>Reservation type:</label>
                            <select name="reservation_type"  id="reservation_type" class="input-control">
                                <option value="1">Walk-in</option>
                                <option value="2">Reserved</option>
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



                        </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Done</button>
                  </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      
      
          <!-- Add Account Modal -->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><span class="oi oi-plus"></span> Add account</h4>
                </div>
                <?php echo form_open('users/register'); ?>
                  <div class="modal-body">
                          <input type="hidden" name="request_type" value="r_admin">
                         <div class="form-group">
                          <label for="lastname">Last name</label>
                          <input type="text" class="input-control"  name="lastname"  required />
                        </div>
                        <div class="form-group">
                          <label for="lastname">First name</label>
                          <input type="text" class="input-control"  name="firstname"  required />
                        </div>
                        <div class="form-group">
                          <label for="lastname">Phone #</label>
                          <input type="text" class="input-control"  name="phone" placeholder="09*********" required />
                        </div>
                        <div class="form-group">
                          <label for="address">Home Address:</label>
                          <textarea name="address" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="lastname">E-mail address</label> <?php if($this->session->flashdata('existed')): ?> <label class="text-danger"> <?php echo $this->session->flashdata('existed'); ?> </label> <?php endif;?> 
                          <input type="email" class="input-control"  name="email" placeholder="Valid e-mail address" required />
                        </div>
                        <div class="form-group">
                          <label for="lastname">Create a password</label>  <?php if(form_error('password')): ?> <label class="text-danger"> <?php echo form_error('password'); ?> </label> <?php endif;?> 
                          <input type="password" class="input-control" name="password" placeholder="(Minimum of 8 characters)" required />
                        </div>
                        <div class="form-group">
                          <label for="lastname">Confirm password</label>  <?php if(form_error('password2')): ?> <label class="text-danger"> <?php echo form_error('password2'); ?> </label> <?php endif;?> 
                          <input type="password" class="input-control"  name="password2" placeholder="Match password created" required />
                        </div>
                        </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>

          <!-- Confirm Modal -->
          <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Delete account</h4>
                </div>
                <?php echo form_open('admin/accounts/remove_account'); ?>
                  <div class="modal-body">
                    <input type="hidden" id="account_id" name="account_id">
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



           <!-- edit Modal -->
          <div class="modal fade" id="editAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><span class="oi oi-pencil"></span> Edit Account</h4>
                </div>
                <?php echo form_open('admin/accounts/edit_account'); ?>
                  <div class="modal-body">
                    <input type="hidden" id="account_id" name="account_id">
                    <p id="message" class="lead"> </p>
                    <input type="hidden" name="account_id" class="form-control" id="account_id" required>

                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" required>
                    </div>

                    <div class="form-group">
                        <label> Account type: </label>
                        <select class="form-control" name="account_type" id="account_type">
                            <option value="1"> Administrator </option>
                            <option value="2"> Staff </option>
                            <option value="3"> User </option>
                        </select>
                    </div>

                  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                  </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>




     </div>


</div>



<script type="text/javascript">

  $('document').ready(function(){

    $('#date').hide();
    $('#time').hide();

    $('#reservation_type').on('change', function() {

          var type = this.value;
          if(type == 2){
                 $('#date').show();
                 $('#time').show();
          }else{
                 $('#date').hide();
                 $('#time').hide();
          } 
         
    })


    $(document).on("click", ".reserve", function () {
       var account_id = $(this).data('id');
       var account_name = $(this).data('name');
        $(".modal-body #id").text( 'Account No: ' + account_id );
        $(".modal-body #name").text( 'Customer Name: ' + account_name);
       $(".modal-body #account_id").val( account_id );
       $(".modal-body #account_name").val( account_name );
       
    });
    
    $(document).on("click", ".delete", function () {
       var account_id = $(this).data('id');
       var account_name = $(this).data('name');
       $(".modal-body #account_id").val( account_id );
       $(".modal-body #message").text( 'Are you sure you want to remove ' + account_name + '?' );
    });


    $(document).on("click", ".edit", function () {
       var account_id = $(this).data('id');
       var firstname = $(this).data('firstname');
       var lastname = $(this).data('lastname');
       var account_type = $(this).data('type');
       $(".modal-body #account_id").val( account_id );
       $(".modal-body #firstname").val( firstname );
       $(".modal-body #lastname").val( lastname );
       $(".modal-body #account_type").val( account_type );
    });

    // Call datatable plugin
    $('#accounts_table').DataTable();


  
    var sort = localStorage.getItem("type");
    var sort2 = localStorage.getItem("sort2");
    //
    if(sort){
          $("#sort").val(sort);
    }else{
          $("#sort").val("0");
    }
    //
    if(sort2){
          $("#sort2").val(sort2);
    }else{
          $("#sort2").val("newest");
    }
    $('#sort').on('change', function() {


      if(sort2){
        window.location.href = '?type='+ this.value +'&sort_by='+ sort2;
        localStorage.setItem("type", this.value);
      }else{
        window.location.href = '?type='+ this.value;
        localStorage.setItem("type", this.value);
      }


    });
    $('#sort2').on('change', function() {

      if(sort){
        window.location.href = '?type='+ sort +'&sort_by='+ this.value;
        localStorage.setItem("sort2", this.value);
      }else{
        window.location.href = '&sort_by='+ this.value;
        localStorage.setItem("sort2", this.value);
      }

    });

    //
    $(document).on('click','.edit', function(){
      var customer_id = $(this).attr('id');
      $.ajax({
       url:window.location + "admin/account_info",
       method:"POST",
       data:{customer_id:customer_id},
       dataType:"json",
       success:function(data){
         $('#id').val(data.id);
         $('#lastname').val(data.lastname);
         $('#firstname').val(data.firstname);
         $('#middlename').val(data.middlename);
                   $('#address').val(data.address);
         $('#contact_no').val(data.contact_no);
         $('#quantity').val(data.quantity);
         $('#tracking_no').val(data.tracking_no);
         $('#note').val(data.note);
         $('#price').val(data.price);
                   $('#shipping_fee').val(data.shipping_fee);
         $("#mode").val(data.payment_mode);
         $("#status").val(data.status);


                   console.log(data.address);
         //Change button value
         $('#add_button').val('Save changes');

         //Show modal
         $('#edit-modal').modal('show');
       }
      });

    });

  });
</script>

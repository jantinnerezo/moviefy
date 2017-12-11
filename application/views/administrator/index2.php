<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#accounts" aria-controls="accounts" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
    <li role="presentation"><a href="#movies" aria-controls="movies" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-film"></span> Movies</a></li>
    <li role="presentation"><a href="#rooms" aria-controls="rooms" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-tent"></span> Rooms</a></li>
    <li role="presentation"><a href="#reservations" aria-controls="reservations" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-tasks
glyphicon "></span> Reservations</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <!-- Account tab -->
    <div role="tabpanel" class="tab-pane active" id="accounts">
      <div class="container">
        <?php if($this->session->flashdata('added')): ?>
              <div class="alert alert-success"><?php echo $this->session->flashdata('added'); ?></div>
        <?php endif; ?>

        <?php if($this->session->flashdata('existed')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('existed'); ?></div>
        <?php endif; ?>

        <div class="row text-right">

           <div class="col-md-4">
             <div class="form-group text-left">
               <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> Add account </a>
             </div>
           </div>


           <div class="toolbar">
             <div class="form-group">
                 <label for="sort">Sort by type:</label>
             </div>
             <div class="form-group">
                <select class="form-control" name="sort" id="sort">
                    <option value="0"> All </option>
                    <option value="1"> Administrators </option>
                    <option value="2"> Staffs </option>
                    <option value="3"> Users </option>
                </select>
             </div>
             <div class="form-group">
                 <label for="sort">Sort by:</label>
             </div>
             <div class="form-group">
                <select class="form-control" name="sort2" id="sort2">
                    <option value="newest"> Newest to oldest </option>
                    <option value="oldest"> Oldest to newest </option>
                    <option value="verified"> Verified </option>
                    <option value="not"> Not verified </option>
                </select>
             </div>


           </div>

           <div class="toolbar">
             <div class=" toolbar">
                <form method="GET" action="<?php echo base_url();?>admin">
                  <div class="form-group">
                      <input type="text" class="form-control search" name="search" placeholder="Search"/>
                  </div>

                  <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
                  </div>
              </form>
            </div>

           </div>

        </div>

        <div class="row">

          <?php if($accounts): ?>
          <div class="panel panel-default">
              <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <th>#</th>
                      <th>Last name</th>
                      <th>First name</th>
                      <th>User type</th>
                      <th>E-mail address</th>
                      <th>Phone</th>
                      <th>E-mail verified</th>
                      <th class="text-center">Options</th>
                    </thead>
                    <tbody>
                      <?php foreach($accounts as $account): ?>
                      <tr>
                        <td><?php echo $account['account_id'];?></td>
                        <td><?php echo $account['lastname'];?></td>
                        <td><?php echo $account['firstname'];?></td>

                          <?php if($account['account_type'] == 1): ?>
                                <td>Administrator</td>
                          <?php endif; ?>
                          <?php if($account['account_type'] == 2): ?>
                                <td>Staff</td>
                          <?php endif; ?>
                          <?php if($account['account_type'] == 3): ?>
                                <td>User</td>
                          <?php endif; ?>

                        <td><?php echo $account['email'];?></td>
                        <td><?php echo $account['phone'];?></td>
                        <?php if($account['verified'] == 1): ?>
                              <td class="bg-success">Yes</td>
                        <?php endif; ?>
                        <?php if($account['verified'] == 0): ?>
                              <td class="bg-danger">No</td>
                        <?php endif; ?>

                        <td class="text-center">
                           <a href="#" class="btn btn-success"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>
                           <a href="#" class="btn btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a>
                         </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
              </div>
          </div>
          <?php else: ?>
             <div class="alert alert-warning">
                No accounts yet
             </div>
          <?php endif; ?>

        </div>

      </div>


      <!-- Add Account Modal -->
      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> New account</h4>
            </div>
            <?php echo form_open('admin/add_account'); ?>
            <div class="modal-body">

                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="First name" required/>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required/>
                </div>

                <div class="form-group">
                  <label> Account type: </label>
                  <select class="form-control" name="account_type" required>
                      <option value="1"> Administrator </option>
                      <option value="2"> Staff </option>
                      <option value="3"> User </option>
                  </select>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required/>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required/>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required/>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="Phone No." required />
                </div>

                <div class="form-group">
                  <label> Verified: </label>
                  <select class="form-control" name="verified" required>
                      <option value="0"> No </option>
                      <option value="1"> Yes </option>
                  </select>
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" name="admin" class="btn btn-primary">Add account</button>
            </div>
              <?php echo form_close(); ?>
          </div>
        </div>
      </div>


    </div>

    <!-- End account tab -->

    <div role="tabpanel" class="tab-pane" id="movies">...</div>

    <div role="tabpanel" class="tab-pane" id="rooms">...</div>

    <div role="tabpanel" class="tab-pane" id="reservations">...</div>
  </div>

</div>


<script type="text/javascript">

  $('document').ready(function(){

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
        localStorage.setItem("sort", this.value);
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
  });
</script>

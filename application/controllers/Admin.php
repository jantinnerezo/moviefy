<?php

class Admin extends CI_Controller{

      public function __construct ()
      {
          parent::__construct();

           $this->load->model('accounts_model');
           $this->load->model('movies_model');
           $this->load->model('rooms_model');
           $this->load->model('image_model');
           $this->load->model('reservation_model');

      }
    public function index(){
      $this->load->view('administrator/header');
      $this->load->view('administrator/index');
    }

    
    public function accounts($offset = 0){


      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                 //Pagination Config
                $config['base_url'] = base_url() . 'admin/accounts/';
                $config['total_rows'] = $this->db->count_all('account');
                $config['per_page'] = 10;
                $config['uri_segment'] = 3;
                $config['attributes'] = array('class' => 'pagination-links');
                //Init Pagination
                $this->pagination->initialize($config);

                $type = $this->input->get('type');
                $sort = $this->input->get('sort_by');
                $search = $this->input->get('search');

                $data['rooms'] = $this->rooms_model->fetch_rooms();
                $data['movies'] = $this->movies_model->fetch_movies();
                $data['accounts'] = $this->accounts_model->show_accounts($type, $sort, $search,$config['per_page'],$offset);

                $this->load->view('administrator/header');
                $this->load->view('administrator/accounts', $data);

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }

      

    }

    public function add_account(){



       if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                $data['title'] = 'Add Account';

                  // Validate user form inputs
                  $this->form_validation->set_rules('firstname', 'First name', 'required');
                  $this->form_validation->set_rules('lastname', 'Last name', 'required');
                  $this->form_validation->set_rules('account_type', 'Account type', 'required');
                  $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
                  $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
                  $this->form_validation->set_rules('phone', 'Phone', 'required');


                  if($this->form_validation->run() === FALSE){

                    $this->load->view('administrator/header');
                    $this->load->view('administrator/accounts', $data);

                  }
                  else{

                    // Get user email
                    $email = $this->input->post('email');

                    // Get user password and encrypt it
                    $encrypted = md5($this->input->post('password'));

                    // Get user inputs and store it to array
                    $data = array(

                        'firstname' =>  $this->input->post('firstname'),
                        'lastname'     =>   $this->input->post('lastname'),
                        'account_type'  => $this->input->post('account_type'),
                        'phone'  =>   $this->input->post('phone'),
                        'address' => $this->input->post('address'),
                        'verified'  =>  1

                    );




                      $this->accounts_model->update_account($data);
                      $this->session->set_flashdata('saved', ' Changes saved' );
                      redirect('admin/accounts');

                  }

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }

			

	}

  public function account_info(){




      $account_id = $this->input->post('account_id');

      return json_encode($this->accounts_model->profile($account_id));


  }

  public function check_out(){

        $reservation_id = $this->input->get('reservation_id');
        $room_id = $this->input->get('room_id');

        $data1 = array(
            'reservation_status' => 0
        );

         $data2 = array(
            'status' => 0
        );

      
        $checkOut = $this->reservation_model->checkOut($reservation_id,$data1);

        if($checkOut){

                $unoccupy = $this->reservation_model->roomStatus($room_id,$data2);

                if($unoccupy){
                    
                     redirect('admin/reservations');
                }
                else{

                    $this->session->set_flashdata('error', 'Something went wrong' );
                    redirect('admin/reservations');
                }
         
        }else{
          $this->session->set_flashdata('error', ' Something went wrong on check out.' );
          redirect('admin/reservations');
        }
  }

  public function edit_account(){


      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

               
              $data['title'] = 'Edit Account';

              $id = $this->input->post('account_id');
              // Get user inputs and store it to array
              $data = array(

                  'firstname' =>  $this->input->post('firstname'),
                  'lastname'     =>   $this->input->post('lastname'),
                  'account_type'  => $this->input->post('account_type')
                  
              );


              // Check user input email if exist
            
                $this->accounts_model->update_account($id,$data);
                $this->session->set_flashdata('added', ' Account successfully updated' );
                redirect('admin/accounts');

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }


      

  
  }

  public function remove_account(){


      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

               
            
                $id = $this->input->post('account_id');
                $this->accounts_model->delete_account($id);

                $this->session->set_flashdata('r_success_admin', ' Account successfully deleted' );
                redirect('admin/accounts');

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }


  }



  // Movies section //

  // Show all movies
  public function movies(){



      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

               
              $search = $this->input->get('search');
              $data['movies'] = $this->movies_model->fetch_movies($search);
              $data['categories'] = $this->movies_model->fetch_category();

              $this->load->view('administrator/header');
              $this->load->view('administrator/movies',$data);

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }


     
    
  }

  // Add new movie
  public function add_movie(){


    if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

               
             $this->form_validation->set_rules('movie_title', 'Title', 'required');
     // $this->form_validation->set_rules('movie_genre', 'Gender', 'required');
     // $this->form_validation->set_rules('movie_description', 'Description', 'required');
      $this->form_validation->set_rules('movie_date', 'Date', 'required');
   
    
      if($this->form_validation->run() === FALSE){

          $this->session->set_flashdata('incomplete','Please complete the required fields');
          redirect(base_url(). 'admin/movies');

      }
      else{
          $config['upload_path']   = './assets/img/posters';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size']      = '2048';

          $this->load->library('upload', $config);

          if(!$this->upload->do_upload()){

            $errors = array('error' => $this->upload->display_errors());
            $img = 'default.png';

          }
          else{

            $data = array('upload_data' => $this->upload->data());
            $img = $_FILES['userfile']['name'];
 
          }

            $data = array(
                  'movie_poster' => $img,
                  'movie_title'  =>  $this->input->post('movie_title'),
                  'category_id' => $this->input->post('category_id'),
                  'movie_description'    =>   $this->input->post('movie_description'),
                  'movie_date'      =>  $this->input->post('movie_date'),
                  'movie_length'      =>  $this->input->post('movie_length'),
                  'movie_trailer'       =>  $this->input->post('movie_trailer'),
                  'movie_ratings' => 0
                  
              );
       
            $this->movies_model->insert_movie($data);
            $this->session->set_flashdata('added', 'New movie added' );

            redirect(base_url(). 'admin/movies');
      
    }

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }

     
  }

  public function edit_movie(){

    

      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

            $this->form_validation->set_rules('movie_title', 'Title', 'required');
      $this->form_validation->set_rules('movie_date', 'Date', 'required');
   
    
      if($this->form_validation->run() === FALSE){

          $this->session->set_flashdata('incomplete','Please complete the required fields');
          redirect(base_url(). 'admin/movies');

      }
      else{
          $config['upload_path']   = './assets/img/posters';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size']      = '2048';

          $this->load->library('upload', $config);

          if(!$this->upload->do_upload()){

            $errors = array('error' => $this->upload->display_errors());
            $img = $this->input->post('default_poster');

          }
          else{

            $data = array('upload_data' => $this->upload->data());
            $img = $_FILES['userfile']['name'];
 
          }

            $data = array(
                  'movie_poster' => $img,
                  'movie_title'  =>  $this->input->post('movie_title'),
                  'category_id' => $this->input->post('category_id'),
                  'movie_description'    =>   $this->input->post('movie_description'),
                  'movie_date'      =>  $this->input->post('movie_date'),
                  'movie_trailer'       =>  $this->input->post('movie_trailer')
                  
              );
       
              $id = $this->input->post('movie_id');
              $updated = $this->movies_model->update_movie($id,$data);
            
             
              $this->session->set_flashdata('success', 'Movie updated successfully' );
              redirect('admin/movies');
           
      
    }

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }


      
  }


 /* public function asdsds(){
    
          $data['title'] = 'Edit movie';
          $data['movies'] = $this->movies_model->fetch_movies();
          $this->form_validation->set_rules('movie_title', 'Title', 'required');
          $this->form_validation->set_rules('movie_date', 'Date', 'required');
       
          if($this->form_validation->run() === FALSE){
              

              $id = $this->input->get('movie_id');
              $data['movie'] = $this->movies_model->movie($id);
              $this->session->set_flashdata('incomplete','Please complete the required fields');
             
              $this->load->view('administrator/header');
              $this->load->view('administrator/movies',$data);
            
          }
          else{

              if(!IS_NULL($this->input->post('movie_poster'))){

                    $config['upload_path']   = './assets/img/posters';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']      = '2048';
          
                    $this->load->library('upload', $config);
          
                    if(!$this->upload->do_upload()){
          
                      $errors = array('error' => $this->upload->display_errors());
                      $img = 'default.png';
          
                    }
                    else{
          
                      $data = array('upload_data' => $this->upload->data());
                      $img = $_FILES['userfile']['name'];
           
                    }
          
                      $data = array(
                            'movie_poster' => $img,
                            'movie_title'  =>  $this->input->post('movie_title'),
                            'movie_genre' => $this->input->post('movie_genre'),
                            'movie_description'    =>   $this->input->post('movie_description'),
                            'movie_date'      =>  $this->input->post('movie_date'),
                            'movie_trailer'       =>  $this->input->post('movie_trailer')
                      );

                      $id = $this->input->post('movie_id');
                      $updated = $this->movies_model->update_movie($id,$data);
                    
                      if($updated){
                          $this->session->set_flashdata('success', 'Movie updated successfully' );
                          redirect('admin/movies');
                      }else{
                          $this->session->set_flashdata('error', 'Movie not updated, something went wrong.' );
                          redirect('admin/movies');
                      }

              }else{
                      $img = 'default.png'; //$this->input->post('default_poster');

                      $data = array(
                            'movie_poster' => $img,
                            'movie_title'  =>  $this->input->post('movie_title'),
                            'movie_genre' => $this->input->post('movie_genre'),
                            'movie_description'    =>   $this->input->post('movie_description'),
                            'movie_date'      =>  $this->input->post('movie_date'),
                            'movie_trailer'       =>  $this->input->post('movie_trailer')
                      );

                      $id = $this->input->post('movie_id');
                      $updated = $this->movies_model->update_movie($id,$data);
                         $json = json_encode($data);
                      if($updated){
                          $this->session->set_flashdata('success', $json. 'Movie updated successfully' );
                          redirect('admin/movies');
                      }else{

                          $json = json_encode($data);
                          $this->session->set_flashdata('error', $json . ' no image Movie not updated, something went wrong.' );
                          redirect('admin/movies');
                      }

              }

          
         
        }
      }*/


  public function remove_movie(){


    $id = $this->input->post('movie_id');

    $removed = $this->movies_model->delete_movie($id);

    if($removed){
         $this->session->set_flashdata('success', ' 1 movie succesfully removed' );
        redirect('admin/movies');
    }else{
        $this->session->set_flashdata('error', ' Movie not removed, something went wrong.' );
        redirect('admin/movies');
    }

    

  }





  /******* Rooms *******/

  public function rooms(){



      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

              $data['rooms'] = $this->rooms_model->fetch_rooms();

      $this->load->view('administrator/header');
      $this->load->view('administrator/rooms',$data);

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }

    
    

  }

   // Add new movie
  public function add_room(){



      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

              $this->form_validation->set_rules('room_no', 'Room no', 'required');
    
      if($this->form_validation->run() === FALSE){

          $this->session->set_flashdata('incomplete','Please complete the required fields');
          redirect(base_url(). 'admin/rooms');

      }
      else{
          $config['upload_path']   = './assets/img/rooms';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size']      = '2048';

          $this->load->library('upload', $config);

          if(!$this->upload->do_upload()){

            $errors = array('error' => $this->upload->display_errors());
            $img = 'no-image.png';

          }
          else{

            $data = array('upload_data' => $this->upload->data());
            $img = $_FILES['userfile']['name'];
 
          }

            $data = array(
                 
                  'room_no'  =>  $this->input->post('room_no'),
                  'room_name' => $this->input->post('room_name'),
                  'room_type' => $this->input->post('room_type'),
                  'room_img' => $img,
                  'status' => 0
                 
                  
              );
       
            $this->rooms_model->insert_room($data);
            $this->session->set_flashdata('added', 'New room added' );

            redirect(base_url(). 'admin/rooms');
      
     
    }

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }


  
     
  }

  public function edit_room(){


      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

             
      $this->form_validation->set_rules('room_no', 'Room no', 'required');
    
      if($this->form_validation->run() === FALSE){

          $this->session->set_flashdata('incomplete','Please complete the required fields');
          redirect(base_url(). 'admin/rooms');

      }
      else{
          $config['upload_path']   = './assets/img/rooms';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size']      = '2048';

          $this->load->library('upload', $config);

          if(!$this->upload->do_upload()){

            $errors = array('error' => $this->upload->display_errors());
            $img = $this->input->post('default_photo');

          }
          else{

            $data = array('upload_data' => $this->upload->data());
            $img = $_FILES['userfile']['name'];
 
          }

            $data = array(
                 
                  'room_no'  =>  $this->input->post('room_no'),
                  'room_name' => $this->input->post('room_name'),
                  'room_img' => $img,
                  'status' => 0
                 
                  
              );

            $id = $this->input->post('room_id');
            $this->rooms_model->update_room($id,$data);
            $this->session->set_flashdata('added', 'Changes saved' );

            redirect(base_url(). 'admin/rooms');
      
     
    }

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }


  
  }


   public function remove_room(){


     if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

              $id = $this->input->post('room_id');

              $removed = $this->rooms_model->delete_room($id);

              if($removed){
                   $this->session->set_flashdata('success', ' Room successfully removed' );
                  redirect('admin/rooms');
              }else{
                  $this->session->set_flashdata('error', ' Room not removed, something went wrong.' );
                  redirect('admin/rooms');
              }

    

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }



   

  }


  /**************** Reservation **************/

  public function reservations(){


       if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

            $data['reservations'] = $this->reservation_model->reservation_list();
            $data['accounts'] = $this->accounts_model->show_accounts();
            $data['rooms'] = $this->rooms_model->fetch_rooms();
            $data['movies'] = $this->movies_model->fetch_movies();

            $this->load->view('administrator/header');
            $this->load->view('administrator/reservations',$data);
            

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }



      
  }

  public function reserve(){



      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                           $request_type = $this->input->post('request_type');


        if($request_type == 'r_admin'){

              $occupied = $this->reservation_model->checkRoom($this->input->post('room_id'));


                    $movie_id = $this->input->post('movie_id');
                    $get_length = $this->reservation_model->get_length($movie_id);
                    $person_count =  $this->input->post('person_count');
                    $count = 0;
                    $total = 0;
                    $total2 = 0;

                    // ---------------------------------------------------------------------------- Walk-in
                    if($this->input->post('reservation_type') == 1){ 

                    
                      $room_type = $this->rooms_model->room_type($this->input->post('room_id'));

                      // ---------------------------------------------------------------------------- Walk-in - Regular
                      if($room_type == 1){ 

                          $fee = 450; // Fee per person
                          for($x = 1; $x<=$person_count; $x++){

                            if($x > 3){
                              $total = $count + 1;
                              $total2 += $total + 75;
                            }
                            else{
                               $total2 = 450;
                            }
                          
                          } 

                            if($get_length){

                                  $minutes = $get_length * 60;
                                  $time_in = Date('h:i A'); 
                                  $time_out = Date('h:i A', strtotime('+'.$minutes.' minutes'));
                                  $reservation_date = Date('y-m-d');

                                  $data = array(
                                      'time_in' => $time_in,
                                      'time_out' => $time_out,
                                      'account_id' => $this->input->post('account_id'),
                                      'person_count' => $this->input->post('person_count'),
                                      'room_id' => $this->input->post('room_id'),
                                      'movie_id' => $this->input->post('movie_id'),
                                      'reservation_date' => $reservation_date,
                                      'reservation_type' => $this->input->post('reservation_type'),
                                      'fee' => $total2,
                                      'reservation_status' => 1
                                  );

                                   $out = date('h:i A',$time_out);
                                   if(strtotime($reservation_date)<strtotime("today")){

                                    $this->session->set_flashdata('error', 'Invalid reservation date, date has passed already.' );
                                    redirect('admin/accounts');

                                   }else{

                                    $checkReserved = $this->reservation_model->checkConflict($reservation_date,$time_in, $out, $this->input->post('room_id'));
                                    
                                    if($checkReserved){
                                            $this->session->set_flashdata('error', 'Reservation denied, date and time selected already reserved.' );
                                            redirect('admin/accounts');
                                    }else{

                                    $reserved = $this->reservation_model->reserve($data);

                                        if($reserved){

                                            $data = array(
                                                    'status' => 1
                                            );
                                            $occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data);
                                            
                                            if($occupy){
                                                    $this->session->set_flashdata('success', 'New walk-in reservation added' );
                                                redirect('admin/accounts');
                                        
                                            }else{
                                                $this->session->set_flashdata('error', 'Something went wrong.' );
                                                redirect('admin/accounts');
                                            } 
                                            
                                            
                                        }else{
                                            $this->session->set_flashdata('error', 'Something went wrong.' );
                                                redirect('admin/accounts');
                                        }
                                    }

                             }

                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong.' );
                                          redirect('admin/accounts');
                            }

                      }


                       // ---------------------------------------------------------------------------- Walk-in - 3D
                      if($room_type == 2){

                          $fee = 500; // Fee per person
                          for($x = 1; $x<=$person_count; $x++){

                            if($x > 3){
                              $total = $count + 1;
                              $total2 += $total + 100;
                            }
                            else{
                               $total2 = 500;
                            }
                          
                          } 

                            if($get_length){

                                  $minutes = $get_length * 60;
                                  $time_in = Date('h:i A'); 
                                  $time_out = Date('h:i A', strtotime('+'.$minutes.' minutes'));
                                  $reservation_date = Date('y-m-d');

                                  $data = array(
                                      'time_in' => $time_in,
                                      'time_out' => $time_out,
                                      'account_id' => $this->input->post('account_id'),
                                      'person_count' => $this->input->post('person_count'),
                                      'room_id' => $this->input->post('room_id'),
                                      'movie_id' => $this->input->post('movie_id'),
                                      'reservation_date' => $reservation_date,
                                      'reservation_type' => $this->input->post('reservation_type'),
                                      'fee' => $total2,
                                      'reservation_status' => 1
                                  );
                                
                                $out = date('h:i A',$time_out);

                                if(strtotime($reservation_date)<strtotime("today")){

                                $this->session->set_flashdata('error', 'Invalid reservation date, date has passed already.' );
                                redirect('admin/accounts');

                                }else{

                                $checkReserved = $this->reservation_model->checkConflict($reservation_date,$time_in, $out, $this->input->post('room_id'));
                                
                                if($checkReserved){
                                        $this->session->set_flashdata('error', 'Reservation denied, date and time selected already reserved.' );
                                        redirect('admin/accounts');
                                }else{

                                $reserved = $this->reservation_model->reserve($data);

                                    if($reserved){

                                        $data = array(
                                                'status' => 1
                                        );
                                        $occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data);
                                        
                                        if($occupy){
                                                $this->session->set_flashdata('success', 'New walk-in reservation added' );
                                            redirect('admin/accounts');
                                    
                                        }else{
                                            $this->session->set_flashdata('error', 'Something went wrong.' );
                                            redirect('admin/accounts');
                                        } 
                                        
                                        
                                    }else{
                                        $this->session->set_flashdata('error', 'Something went wrong.' );
                                            redirect('admin/accounts');
                                    }
                                }

                            }

                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong.' );
                                          redirect('admin/accounts');
                            }

                      }

                  }

                  // ---------------------------------------------------------------------------- Reserve
                 else { 

                    
                      $room_type = $this->rooms_model->room_type($this->input->post('room_id'));
                      $reservation_date = $this->input->post('reservation_date');
                      $reservation_time = $this->input->post('reservation_time');

                      // ---------------------------------------------------------------------------- reserve - Regular
                      if($room_type == 1){ // Regular

                          $fee = 450; // Fee per person
                          for($x = 1; $x<=$person_count; $x++){

                            if($x > 3){
                              $total = $count + 1;
                              $total2 += $total + 75;
                            }
                            else{
                               $total2 = 450;
                            }
                          
                          } 

                            if($get_length){

                                  $minutes = $get_length * 60;
                                  $time_in = Date('h:i A',strtotime($reservation_time)); 
                                  $time_out = strtotime('+'.$minutes. ' minutes', strtotime($reservation_time));
                                  $data = array(
                                      'time_in' => $time_in,
                                      'time_out' => date('h:i A',$time_out),
                                      'account_id' => $this->input->post('account_id'),
                                      'person_count' => $this->input->post('person_count'),
                                      'room_id' => $this->input->post('room_id'),
                                      'movie_id' => $this->input->post('movie_id'),
                                      'reservation_type' => $this->input->post('reservation_type'),
                                      'reservation_date' => $this->input->post('reservation_date'),
                                      'reservation_status' => 2,
                                      'fee' => $total2
                                  );

                                  $out = date('h:i A',$time_out);
                                  if(strtotime($reservation_date)<strtotime("today")){
                                    
                                        $this->session->set_flashdata('error', 'Invalid reservation date, date has passed already.' );
                                        redirect('admin/accounts');
        
                                        }else{
        
                                        $checkReserved = $this->reservation_model->checkConflict($reservation_date,$time_in, $out, $this->input->post('room_id'));
                                        
                                        if($checkReserved){
                                                $this->session->set_flashdata('error', 'Reservation denied, date and time selected already reserved.' );
                                                redirect('admin/accounts');
                                        }else{
        
                                        $reserved = $this->reservation_model->reserve($data);
        
                                            if($reserved){
        
                                                $data = array(
                                                        'status' => 1
                                                );
                                                $occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data);
                                                
                                                if($occupy){
                                                        $this->session->set_flashdata('success', 'New reservation added' );
                                                    redirect('admin/accounts');
                                            
                                                }else{
                                                    $this->session->set_flashdata('error', 'Something went wrong.' );
                                                    redirect('admin/accounts');
                                                } 
                                                
                                                
                                            }else{
                                                $this->session->set_flashdata('error', 'Something went wrong.' );
                                                    redirect('admin/accounts');
                                            }
                                        }
        
                                    }

                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong.' );
                                          redirect('admin/accounts');
                            }

                      }


                      // ---------------------------------------------------------------------------- reserve - 3D
                      if($room_type == 2){

                          $fee = 500; // Fee per person
                          for($x = 1; $x<=$person_count; $x++){

                            if($x > 3){
                              $total = $count + 1;
                              $total2 += $total + 100;
                            }
                            else{
                               $total2 = 450;
                            }
                          
                          } 

                            if($get_length){

                                  $minutes = $get_length * 60;
                                  $time_in = Date('h:i A',strtotime($reservation_time)); 
                                  $time_out = strtotime('+'.$minutes. ' minutes', strtotime($reservation_time));
                                  $data = array(
                                      'time_in' => $time_in,
                                      'time_out' => date('h:i A',$time_out),
                                      'account_id' => $this->input->post('account_id'),
                                      'person_count' => $this->input->post('person_count'),
                                      'room_id' => $this->input->post('room_id'),
                                      'movie_id' => $this->input->post('movie_id'),
                                      'reservation_type' => $this->input->post('reservation_type'),
                                      'reservation_date' => $this->input->post('reservation_date'),
                                      'reservation_status' => 2,
                                      'fee' => $total2
                                  );
                                  $out = date('h:i A',$time_out);
                                  if(strtotime($reservation_date)<strtotime("today")){
                                    
                                    $this->session->set_flashdata('error', 'Invalid reservation date, date has passed already.' );
                                    redirect('admin/accounts');
    
                                    }else{
    
                                    $checkReserved = $this->reservation_model->checkConflict($reservation_date,$time_in, $out, $this->input->post('room_id'));
                                    
                                    if($checkReserved){
                                            $this->session->set_flashdata('error', 'Reservation denied, date and time selected already reserved.' );
                                            redirect('admin/accounts');
                                    }else{
    
                                    $reserved = $this->reservation_model->reserve($data);
    
                                        if($reserved){
    
                                            $data2 = array(
                                                    'status' => 1
                                            );
                                            //$occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data2);
                                            
                                          //  if($occupy){
                                                    $this->session->set_flashdata('success', 'New reservation added' );
                                                redirect('admin/accounts');
                                        
                                          //  }else{
                                            //    $this->session->set_flashdata('error', 'Something went wrong. ' );
                                           //     redirect('admin/accounts');
                                           // } 
                                            
                                            
                                        }else{
                                            $this->session->set_flashdata('error', 'Something went wrong. ' );
                                                redirect('admin/accounts');
                                        }
                                    }
    
                                }

                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong.' );
                                          redirect('admin/accounts');
                            }

                      }

                  

                  
              }
    
        }

    

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }



    


        //---------------------------------------------------------------------------------------------------------



}

public function reserved(){

   $data1 = array(
         'status' => 1
   );

   $data2 = array(
         'reservation_status' => 1
   );


   $occupy = $this->reservation_model->roomStatus($this->input->get('room_id'),$data1);

    if($occupy){
      

      $reserved = $this->reservation_model->checkOut($this->input->get('reservation_id'),$data2);

      if($reserved){
          redirect('admin/reservations');
      }else{

      }

       
    
   }else{
     
       redirect('admin/reservations');
   } 
 
 
  
}

public function client_reserve(){


              $account_id = $this->session->userdata('account_id');


              $occupied = $this->reservation_model->checkRoom($this->input->post('room_id'));

              if($occupied){

                 /* $this->session->set_flashdata('existed',  'Room #'. $occupied . ' already occupied.' );
                  redirect('admin/accounts');*/
                  $this->session->set_flashdata('existed',  'The room you choosen is not available' );
                  redirect('admin/accounts');

              }else{

                    $movie_id = $this->input->post('movie_id');
                    $get_length = $this->reservation_model->get_length($movie_id);
                    $person_count =  $this->input->post('person_count');
                    $count = 0;
                    $total = 0;
                    $total2 = 0;

                    $room_type = $this->rooms_model->room_type($this->input->post('room_id'));
                    $reservation_date = $this->input->post('reservation_date');
                    $reservation_time = $this->input->post('reservation_time');
                    $account_id = $this->session->userdata('account_id');

                      // ---------------------------------------------------------------------------- reserve - Regular
                      if($room_type == 1){ // Regular

                          $fee = 450; // Fee per person
                          for($x = 1; $x<=$person_count; $x++){

                            if($x > 3){
                              $total = $count + 1;
                              $total2 += $total + 75;
                            }
                            else{
                               $total2 = 450;
                            }
                          
                          } 

                            if($get_length){

                                  $minutes = $get_length * 60;
                                  $time_in = Date('h:i A',strtotime($reservation_time)); 
                                  $time_out = strtotime('+'.$minutes. ' minutes', strtotime($reservation_time));
                                  $data = array(
                                      'time_in' => $time_in,
                                      'time_out' => date('h:i A',$time_out),
                                      'account_id' =>  $account_id,
                                      'person_count' => $this->input->post('person_count'),
                                      'room_id' => $this->input->post('room_id'),
                                      'movie_id' => $this->input->post('movie_id'),
                                      'reservation_type' => 2,
                                      'reservation_date' => $this->input->post('reservation_date'),
                                      'reservation_status' => 0,
                                      'fee' => $total2
                                  );


                                  $reserved = $this->reservation_model->reserve($data);

                                  if($reserved){

                                      $data = array(
                                            'status' => 1
                                      );


                                      $occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data);

                                      if($occupy){
                                           $this->session->set_flashdata('success', 'Reservation successful!' );
                                          redirect('/');
                                      }else{
                                           $this->session->set_flashdata('error', 'Something went wrong.' );
                                          redirect('/');
                                      } 
                                       
                                      
                                  }else{
                                        $this->session->set_flashdata('error', 'Something went wrong.' );
                                         redirect('/');
                                  }

                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong.' );
                                         redirect('/');
                            }

                      }


                      // ---------------------------------------------------------------------------- reserve - 3D
                      if($room_type == 2){

                          $fee = 500; // Fee per person
                          for($x = 1; $x<=$person_count; $x++){

                            if($x > 3){
                              $total = $count + 1;
                              $total2 += $total + 100;
                            }
                            else{
                               $total2 = 450;
                            }
                          
                          } 

                            if($get_length){

                                  $minutes = $get_length * 60;
                                  $time_in = Date('h:i A',strtotime($reservation_time)); 
                                  $time_out = strtotime('+'.$minutes. ' minutes', strtotime($reservation_time));
                                  $data = array(
                                      'time_in' => $time_in,
                                      'time_out' => date('h:i A',$time_out),
                                      'account_id' =>  $account_id,
                                      'person_count' => $this->input->post('person_count'),
                                      'room_id' => $this->input->post('room_id'),
                                      'movie_id' => $this->input->post('movie_id'),
                                      'reservation_type' => 2,
                                      'reservation_date' => $this->input->post('reservation_date'),
                                      'reservation_status' => 0,
                                      'fee' => $total2
                                  );


                                  $reserved = $this->reservation_model->reserve($data);

                                  if($reserved){

                                      $data = array(
                                            'status' => 1
                                      );


                                      $occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data);

                                      if($occupy){
                                           $this->session->set_flashdata('success', 'Reservation successful!' );
                                          redirect('/');
                                      }else{
                                           $this->session->set_flashdata('error', 'Something went wrong.' );
                                          redirect('/');
                                      } 
                                       
                                      
                                  }else{
                                        $this->session->set_flashdata('error', 'Something went wrong.' );
                                          redirect('/');
                                  }

                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong.' );
                                           redirect('/');
                            }

                      }

                  

                  
              }
    
      


}


  



  public function remove_reservations(){


     if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                           $id = $this->input->get('reservation_id');
     
        $delete = $this->reservation_model->removeReservation($id);

        if($delete){ 

                $data = array(
                      'status' => 0
                );
                  
                $unoccupy = $this->reservation_model->roomStatus($this->input->get('room_id'),$data);

                if($unoccupy){
                    
                    redirect('admin/reservations');
                }
                else{

                    $this->session->set_flashdata('error', 'Something went wrong' );
                    redirect('admin/reservations');
                }
                
                
        }else{ 
              $this->session->set_flashdata('error', 'Something went wrong. ID ' );
               redirect('admin/reservations');
        }

    

          }else{

                redirect('login');
          }
      }else{

             redirect('login');
      }


       
  }




  public function slideshows(){


     if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                           
            $data['slideshows'] = $this->image_model->fetch_slideshows();

            $this->load->view('administrator/header');
            $this->load->view('administrator/slideshows',$data);
                      
                
        }else{ 
              $this->session->set_flashdata('error', 'Something went wrong. ID ' );
               redirect('admin/reservations');
        }

    

          }else{

                redirect('login');
          }
      



  }

  public function add_slideshow(){



     if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                           
          $config['upload_path']   = './assets/img/slideshows';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size']      = '2048';

          $this->load->library('upload', $config);

          if(!$this->upload->do_upload()){

            $errors = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('noimage',  $this->upload->display_errors());
            redirect(base_url(). 'admin/slideshows');

          }
          else{

            $data = array('upload_data' => $this->upload->data());
            $img = $_FILES['userfile']['name'];

            $data = array(
                    'slide_img' => $img,
                  
              );
         
              $this->image_model->insert_img($data);
              $this->session->set_flashdata('added', 'New image added to slideshow' );

              redirect(base_url(). 'admin/slideshows');
      
 
          }
                      
                
        }else{ 
              $this->session->set_flashdata('error', 'Something went wrong. ID ' );
               redirect('admin/reservations');
        }

    

          }else{

                redirect('login');
          }
      }
         

     
    

     public function verify_account(){



        if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                           
                $id = $this->input->get('account_id');

                $data = array('verified' => 1);
                $verified = $this->accounts_model->verify($id,$data);

                if($verified){
                  $this->session->set_flashdata('success', ' 1 new account verified' );
                  redirect('admin/accounts');
                }else{
                  $this->session->set_flashdata('success', ' 1 new account verified' );
                  redirect('admin/accounts');
                }
                      
                
        }else{ 
              $this->session->set_flashdata('error', 'Something went wrong. ID ' );
               redirect('admin/reservations');
        }

    

          }else{

                redirect('login');
          }
      }
    




    public function remove_slideshow(){


      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

                           
           
                $id = $this->input->get('slide_id');

                $deleted = $this->image_model->delete_img($id);

                if($deleted){
                     redirect(base_url() .'admin/slideshows');
                }else{
                      redirect(base_url() .'admin/slideshows');
                }
                      
                
        }else{ 
              $this->session->set_flashdata('error', 'Something went wrong. ID ' );
               redirect('admin/reservations');
        }

    

          }else{

                redirect('login');
          }
      }








    
  

}

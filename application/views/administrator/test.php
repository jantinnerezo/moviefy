


<?php
			// Reservation type == 1 -- Walk-in

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

                          $data = array(
                              'time_in' => $time_in,
                              'time_out' => $time_out,
                              'account_id' => $this->input->post('account_id'),
                              'person_count' => $this->input->post('person_count'),
                              'room_id' => $this->input->post('room_id'),
                              'movie_id' => $this->input->post('movie_id'),
                              'reservation_type' => $this->input->post('reservation_type'),
                              'fee' => $total2
                              'reservation_status' => 1
                          );


                          $reserved = $this->reservation_model->reserve($data);

                          if($reserved){

                              $data = array(
                                    'status' => 1
                              );


                              $occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data);

                              if($occupy){
                                   $this->session->set_flashdata('reserved', 'New walk-in reservation added' );
                                  redirect(base_url(). 'admin/accounts');
                              }else{
                                   $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                              } 
                               
                              
                          }else{
                                $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                          }

                    }else{

                         $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
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

                          $data = array(
                              'time_in' => $time_in,
                              'time_out' => $time_out,
                              'account_id' => $this->input->post('account_id'),
                              'person_count' => $this->input->post('person_count'),
                              'room_id' => $this->input->post('room_id'),
                              'movie_id' => $this->input->post('movie_id'),
                              'reservation_type' => $this->input->post('reservation_type'),
                              'fee' => $total2,
                              'reservation_status' => 1
                          );


                          $reserved = $this->reservation_model->reserve($data);

                          if($reserved){

                              $data = array(
                                    'status' => 1
                              );


                              $occupy = $this->reservation_model->roomStatus($this->input->post('room_id'),$data);

                              if($occupy){
                                   $this->session->set_flashdata('reserved', 'New walk-in reservation added' );
                                  redirect(base_url(). 'admin/accounts');
                              }else{
                                   $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                              } 
                               
                              
                          }else{
                                $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                          }

                    }else{

                         $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                    }

              }

          }

          // ---------------------------------------------------------------------------- Reserve
          else if($this->input->post('reservation_type') == 2){ 

            
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
                          $time_in = Date('h:i A'); 
                          $time_out = Date('h:i A', strtotime('+'.$minutes.' minutes'));

                          $data = array(
                              'time_in' => $time_in,
                              'time_out' => $time_out,
                              'account_id' => $this->input->post('account_id'),
                              'person_count' => $this->input->post('person_count'),
                              'room_id' => $this->input->post('room_id'),
                              'movie_id' => $this->input->post('movie_id'),
                              'reservation_type' => $this->input->post('reservation_type'),
                              'reservation_date' => $this->input->post('reservation_date'),
                              'reservation_time' => $this->input->post('reservation_time'),
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
                                   $this->session->set_flashdata('reserved', 'Reservation successful!' );
                                  redirect(base_url(). 'admin/accounts');
                              }else{
                                   $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                              } 
                               
                              
                          }else{
                                $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                          }

                    }else{

                         $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
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
                          $time_in = Date('h:i A'); 
                          $time_out = Date('h:i A', strtotime('+'.$minutes.' minutes'));

                          $data = array(
                              'time_in' => $time_in,
                              'time_out' => $time_out,
                              'account_id' => $this->input->post('account_id'),
                              'person_count' => $this->input->post('person_count'),
                              'room_id' => $this->input->post('room_id'),
                              'movie_id' => $this->input->post('movie_id'),
                              'reservation_type' => $this->input->post('reservation_type'),
                              'reservation_date' => $this->input->post('reservation_date'),
                              'reservation_time' => $this->input->post('reservation_time'),
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
                                   $this->session->set_flashdata('reserved', 'Reservation successful!' );
                                  redirect(base_url(). 'admin/accounts');
                              }else{
                                   $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                              } 
                               
                              
                          }else{
                                $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                          }

                    }else{

                         $this->session->set_flashdata('error', 'Something went wrong.' );
                                  redirect(base_url(). 'admin/accounts');
                    }

              }

          }



?>
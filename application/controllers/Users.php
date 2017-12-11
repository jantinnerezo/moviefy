<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends CI_Controller{

	 public function __construct ()
      {

          parent::__construct();

            $this->load->model('accounts_model');
           $this->load->model('movies_model');
           $this->load->model('rooms_model');
           $this->load->model('image_model');
           $this->load->model('reservation_model');
           $this->load->library('email');

      }



    public function load_views($view,$data){

        $this->load->view('includes/header');
  		$this->load->view($view, $data);
  		$this->load->view('includes/footer');

    }

     public function profile(){

      if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){
            redirect('admin');
          }else{

             $data['reservations'] = $this->reservation_model->userReservation($this->session->userdata('account_id'));
             $this->load->view('includes/header');
             $this->load->view('pages/profile',$data);
             $this->load->view('includes/footer');

          }
        }
        else{

          redirect('login');

        }

      
     
    }

     public function all_movies(){

      
        $search = $this->input->get('search');
        $category = $this->input->get('category');
        $data['movies'] = $this->movies_model->fetch_movies($search,$category);
        $data['categories'] = $this->movies_model->fetch_category();

      	$this->load->view('includes/header');
    		$this->load->view('pages/movies', $data);
    		$this->load->view('includes/footer');

       

    }

  

     public function about(){

      

      	$this->load->view('includes/header');
	 	    $this->load->view('pages/about');
		    $this->load->view('includes/footer');

     
    }


    public function reservations_view(){


       if($this->session->userdata('logged_in')){

          if($this->session->userdata('account_type') == 1){

            
                redirect('admin');

          }else{

                
                $data['reservations'] = $this->reservation_model->reservation_list();
                $this->load->view('includes/header');
                $this->load->view('pages/reservation_view',$data);
                $this->load->view('includes/footer');
          }
      }else{

             redirect('login');
      }



      
  }

    public function login(){


    	if($this->session->userdata('logged_in')){

			if($this->session->userdata('account_type') == 1){
				redirect('admin');
			}else{

				redirect('/');
			}

		}else{

			 $data['title'] = 'Login';

		        $this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');

		       	if($this->form_validation->run() === FALSE){

					$this->load->view('includes/header');
					$this->load->view('pages/login', $data);
					$this->load->view('includes/footer');


				}else{


    				if($this->session->userdata('logged_in')){
    					redirect('/');
    				}else{

    						
					$email = $this->input->post('email');
					$password = md5($this->input->post('password'));

					$logged_in = $this->accounts_model->logged_in($email, $password);

					if($logged_in){

						$empty = array();
						foreach($logged_in as $in){

							$values = array(
								'account_id' => $in['account_id'],
								'name' => $in['firstname'] .' ' . $in['lastname'],
								'email' => $in['email'],
								'account_type' => $in['account_type'],
								'logged_in' => true

							);

							$empty = $values;
						}
						
						$this->session->set_userdata($empty);
						if($this->session->userdata('account_type') == 1){
							redirect('admin');
						}else{

							redirect('profile');
						}
						

					}else{

						$this->session->set_flashdata('invalid', 'Email or password is invalid!' );
						redirect('login');
					}
    				}


			}
		}

       



    }

    public function register(){


    		$from = 'qlouelven@gmail.com';
    		$from_password = 'Wengta12345';

    		
			$request_type = $this->input->post('request_type');
    		$data['title'] = 'Register';


			// Validate user form inputs
		
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
      	
			if($this->form_validation->run() === FALSE){

				$this->load_views('pages/register',$data);

			}
			else{

				// Get user email
				$email = $this->input->post('email');

				$check_email = $this->accounts_model->check_email($email);

				if($check_email){

					if($request_type == 'r_admin'){ // Form submitted from admin

		    				$this->session->set_flashdata('existed', 'Email '.$email.' already exist' );
				 			redirect('admin/accounts');

		    			}else{ // Form submitted from client side

		    				$this->session->set_flashdata('existed', 'Email '.$email.' already exist' );
				 			redirect('register');
		    		}

				}else{

					// Get user password and encrypt it
					$encrypted = md5($this->input->post('password'));

					// Get user inputs and store it to array
					$data = array(

      		 					'firstname' => 	$this->input->post('firstname'),
      							'lastname'     => 	$this->input->post('lastname'),
      							'email'     => 	$email,
      							'password'     => 	$encrypted,
	            			'account_type'	=> 2,
                    'address' => $this->input->post('address'),
	            			'phone'  => 	$this->input->post('phone'),
	            			'verified'  => 	0

					);


					$added = $this->accounts_model->insert_account($data);

					//$name = $this->input->post('firstname'). ' ' . $this->input->post('lastname')
					//$this->sendEmail($this->input->post('firstname'),$email);
					//Email address config
		    		if($added){

		    			$name = $this->input->post('firstname');
		    			if($request_type == 'r_admin'){ // Form submitted from admin


		    			
		    				$this->session->set_flashdata('r_success_admin', ' New account added' );
				 				 redirect('admin/accounts');
		    			
		    				

		    			}else{ // Form submitted from client side

              //SMTP & mail configuration
              $config = array(
                  'protocol'  => 'smtp',
                  'smtp_host' => 'ssl://smtp.googlemail.com',
                  'smtp_port' => 465,
                  'smtp_user' => 'qlouelven@gmail.com',
                  'smtp_pass' => 'Wengta12345',
                  'mailtype'  => 'html',
                  'charset'   => 'utf-8'
              );
              $this->email->initialize($config);
              $this->email->set_mailtype("html");
              $this->email->set_newline("\r\n");  

              //Email content
              $htmlContent = '<h1>Moviefy Home Theatre</h1>';
              $htmlContent .= '<p>Please confirm you account by clicking this link </p>' . '<a href="http://localhost/moviefy/registration/confirmation/'.$email.'"> Confirm Email </a>';

              $this->email->to($email);
              $this->email->from('qlouelven@gmail.com','Moviefy Home Theatre');
              $this->email->subject('Moviefy Home Theatre - Registration Confirmation');
              $this->email->message($htmlContent);
             // $this->load->library('email', $config);
          
        

                //Send mail 
               if($this->email->send()){
                $this->session->set_flashdata('r_success_user', ' Registration successful. please check your email account to confirm registration.' );
                  redirect('register');
               }else{
                   $this->session->set_flashdata("r_error_user","Error in sending Email."); 
                   //redirect('register');
                   echo $this->email->print_debugger();
               }

               
		    				 // $this->session->set_flashdata('r_success_user', ' Registration successful' );
				 				 
		    				
		    			}
		    		}else{

		    			if($request_type == 'r_admin'){ // Form submitted from admin


		    				$this->session->set_flashdata('r_error_admin', ' Account not added, something went wrong.' );
				 			redirect('admin/accounts');

		    			}else{ // Form submitted from client side

		    				$this->session->set_flashdata('r_error_user', ' Account not added, something went wrong, please try again later.' );
				 			redirect('register');
		    			}
		    		}


				 
				}

				

			}
    }


    public function client_reservation($movie_id){


    	if($this->session->userdata('logged_in')){

    		$data['rooms'] = $this->rooms_model->fetch_rooms();
    		$data['movie_id'] = $movie_id;


    		$this->form_validation->set_rules('room_id', 'Room', 'required');
    		$this->form_validation->set_rules('reservation_date', 'Reservation date', 'required');
			  $this->form_validation->set_rules('reservation_time', 'Reservation time', 'required');

              if($this->form_validation->run() === FALSE){

                $this->load->view('includes/header');
                $this->load->view('pages/reservation', $data);
                $this->load->view('includes/footer');

              }
              else{

                $person = $this->reservation_model->personCount($this->input->post('room_id'));

                if($this->input->post('person_count') > $person){

                      $this->session->set_flashdata('error', 'The room can only occupied 8 persons' );
                     redirect('user/reservations/client_reservation/'.$movie_id);
                }
                else{
                    $account_id = $this->session->userdata('account_id');


              $occupied = $this->reservation_model->checkRoom($this->input->post('room_id'));

             

                   
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

                                  $existed = 0;
                                  $minutes = $get_length * 60;
                                  $time_in = Date('h:i A',strtotime($reservation_time)); 
                                  $time_out = strtotime('+'.$minutes. ' minutes', strtotime($reservation_time));
                                  $data = array(
                                      'time_in' => $time_in,
                                      'time_out' => date('h:i A',$time_out),
                                      'account_id' =>  $account_id,
                                      'person_count' => $this->input->post('person_count'),
                                      'room_id' => $this->input->post('room_id'),
                                      'movie_id' => $movie_id,
                                      'reservation_type' => 2,
                                      'reservation_date' => $this->input->post('reservation_date'),
                                      'reservation_status' => 2,
                                      'fee' => $total2
                                  );

                                  $out = date('h:i A',$time_out);

                                  if(strtotime($this->input->post('reservation_date'))<strtotime("today")){

                                    $this->session->set_flashdata('error', 'Invalid reservation date, date has passed.' );
                                    redirect('user/reservations/client_reservation/'.$movie_id);

                                  }else{

                                    $checkReserved = $this->reservation_model->checkConflict($this->input->post('reservation_date'),$time_in, $out, $this->input->post('room_id'));
                                    
                                        if($checkReserved){
                                            $this->session->set_flashdata('error', 'Reservation denied, date and time selected already reserved.' );
                                              redirect('user/reservations/client_reservation/'.$movie_id);
                                        }else{
      
                                              $reserved = $this->reservation_model->reserve($data);
      
                                              if($reserved){
      
                                                  
                                                        $this->session->set_flashdata('success', 'Reservation successful!' );
                                                      redirect('user/reservations/client_reservation/'.$movie_id);
                                                
                                                    
                                                  
                                              }else{
                                                    $this->session->set_flashdata('error', 'Something went wrong.' );
                                                      redirect('user/reservations/client_reservation/'.$movie_id);
                                              }
                                        }
                                  }
                                 

                               
                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong.' );
                                         redirect('user/reservations/client_reservation/'.$movie_id);
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
                                      'movie_id' => $movie_id,
                                      'reservation_type' => 2,
                                      'reservation_date' => $this->input->post('reservation_date'),
                                      'reservation_status' => 2,
                                      'fee' => $total2
                                  );
                                  $out = date('h:i A',$time_out);

                                  if(strtotime($this->input->post('reservation_date'))<strtotime("today")){

                                    $this->session->set_flashdata('error', 'Invalid reservation date, date has passed.' );
                                    redirect('user/reservations/client_reservation/'.$movie_id);

                                  }else{

                                    $checkReserved = $this->reservation_model->checkConflict($this->input->post('reservation_date'),$time_in, $out, $this->input->post('room_id'));
                                    
                                        if($checkReserved){
                                            $this->session->set_flashdata('error', 'Reservation denied, date and time selected already reserved.' );
                                              redirect('user/reservations/client_reservation/'.$movie_id);
                                        }else{
      
                                              $reserved = $this->reservation_model->reserve($data);
      
                                              if($reserved){
      
                                                  
                                                        $this->session->set_flashdata('success', 'Reservation successful!' );
                                                      redirect('user/reservations/client_reservation/'.$movie_id);
                                                
                                                    
                                                  
                                              }else{
                                                    $this->session->set_flashdata('error', 'Something went wrong.' );
                                                      redirect('user/reservations/client_reservation/'.$movie_id);
                                              }
                                        }
                                  }


                            }else{

                                 $this->session->set_flashdata('error', 'Something went wrong. Movie id: ' .$movie_id 
                                  );
                                           redirect('user/reservations/client_reservation/'.$movie_id);
                            }

                      }

                }


              }


    	}else{

             redirect('login');
    	}

        	

    }


    // Logout the user 
	public function logout(){

	
		//Unset session datas
		$this->session->unset_userdata('account_id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('account_type');


		// and then redirect to login page
		redirect('login');

	}

   

    

     public function confirm_email($email){

     	$verified = $this->accounts_model->verifyEmail($email);

        if($verified){
            $this->session->set_flashdata('success', 'Email address is confirmed. Please login to the system');
            redirect('login');
        }else{
            $this->session->set_flashdata('error', 'Email address is not confirmed. Please try to re-register.');
            redirect('login');
        }
    }

  /*  public function ($reservation_id){

          $this->email->initialize($config);
          $this->email->set_mailtype("html");
          $this->email->set_newline("\r\n");  

          //Email content
          $htmlContent = '<h1>Moviefy Home Theatre</h1>';
          $htmlContent .= '<p>You are now reserved, you reservation number is</p>' . '<a href="http://localhost/moviefy/registration/confirmation/'.$email.'"> Confirm Email </a>';

          $this->email->to($email);
          $this->email->from('qlouelven@gmail.com','Moviefy Home Theatre');
          $this->email->subject('Moviefy Home Theatre - Registration Confirmation');
          $this->email->message($htmlContent);
         // $this->load->library('email', $config);
      
    

            //Send mail 
           if($this->email->send()){
            $this->session->set_flashdata('r_success_user', ' Registration successful. please check your email account to confirm registration.' );
              redirect('register');
           }else{
               $this->session->set_flashdata("r_error_user","Error in sending Email."); 
               //redirect('register');
               echo $this->email->print_debugger();
           }
    }*/

 


}
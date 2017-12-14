<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class User extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function users_get()
    {
    	$data = array();
        // Get id parameter
	    $u_seq = $this->get('u_seq');

        // If the id parameter doesn't exist return all the users
        if ($u_seq === NULL)
        {
            // Users from a data store e.g. database
            $users = $this->usermodel->find_all_users();

            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response
	            $data['status'] = TRUE;
	            $data['message'] = 'Users found';
	            $data['data'] = $users;
            }
            else
            {
	            // Set the response
	            $data['status'] = FALSE;
	            $data['message'] = 'No users found';
            }

	        $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        // Find and return a single record for a particular user.
        else
        {
	        $u_seq = (int)$u_seq;

            // Validate the id.
            if ($u_seq <= 0)
            {
                // Invalid id, set the response and exit
	            $data['status'] = FALSE;
	            $data['message'] = 'Invalid parameter';
	            $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.
            $user = $this->usermodel->find_user_by_useq($u_seq);

            if (!empty($user))
            {
            	// Set the response
	            $data['status'] = TRUE;
	            $data['message'] = 'User found';
	            $data['data'] = $user;
            }
            else
            {
	            // Set the response
	            $data['status'] = FALSE;
	            $data['message'] = 'No user found';
            }

	        $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function users_post() {
    	// Get the parameters
	    $input['u_seq']   = $this->post( 'u_seq' );
	    $input['u_id']    = $this->post( 'u_id' );
	    $input['u_name']  = $this->post( 'u_name' );
	    $input['u_phone'] = $this->post( 'u_phone' );

	    if (empty($input['u_seq']))
	    // Create item
	    {
		    $this->create_user($input);
	    }
	    else
	    // Update item
	    {
		    $this->edit_user($input);
	    }
    }

    private function create_user($input)
    {
	    if (empty($input['u_id']))
	    {
		    // Invalid id, set the response and exit
		    $data['status'] = FALSE;
		    $data['message'] = 'Incomplete parameter';
		    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	    }

	    $user = $this->usermodel->find_user_by_uid( $input['u_id'] );
	    // Check id if exist
	    if (!empty($user))
	    {
		    // Set the response and exit
		    $data['status'] = FALSE;
		    $data['message'] = 'User exist';
		    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	    }
	    else
	    {
		    if (empty($input['u_name']) && empty($input['u_phone']))
		    {
			    // Set the response and exit
			    $data['status'] = FALSE;
			    $data['message'] = 'Incomplete parameter: u_name or u_phone';
			    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		    }
		    else
		    {
			    $result = $this->usermodel->create_user( $input );
			    if (!$result)
			    {
				    // Set the response and exit
				    $data['status'] = FALSE;
				    $data['message'] = 'User create fail';
			    }
			    else
			    {
				    // Set the response and return the id (u_seq)
				    $data['status'] = TRUE;
				    $data['message'] = 'User create successful';
				    $data['data'] = $result;
			    }

			    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		    }
	    }
    }

    private function edit_user($input)
    {
	    if (empty($input['u_name']) && empty($input['u_phone']))
	    {
		    // Set the response and exit
		    $data['status'] = FALSE;
		    $data['message'] = 'Incomplete parameter: u_name or u_phone';
		    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	    }
	    else
	    {
		    $result = $this->usermodel->edit_user( $input );
		    if ($result)
		    {
			    $data['status'] = TRUE;
			    $data['message'] = 'User update successful';
			    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		    }
		    else
		    {
			    if ($result === 0)
			    {
				    $data['status'] = FALSE;
				    $data['message'] = 'Nothing to update';
				    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			    }
			    else
			    {
				    $data['status'] = FALSE;
				    $data['message'] = 'User update fail';
				    $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			    }
		    }
	    }
    }

}
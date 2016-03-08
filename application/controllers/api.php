<?php defined('BASEPATH') or exit('No direct script allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function airport_get()
	{
		$id = $this->get('id');
		$user_id = $this->get('user_id');
		if($user_id == 1 || $user_id == 2)
		{
			$this->load->model('Model_airports');
			$airport = $this->Model_airports->get_by(array('id'=>$id));
			if(isset($airport['id']))
			{
				$this->response(array('status'=>'success','message'=>$airport));
			}
			else
			{
				$this->response(array('status'=>'failure','message'=>'The specified airport could not be found'), REST_Controller::HTTP_NOT_FOUND);
			}
		}
		else
		{
			$this->response(array('status'=>'failure','message'=>'Guest User cannot Access Airports'));
		}
	}
	
	function airport_put()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_data($this->put());
		if($this->form_validation->run('airport_put') != false)
		{
			$user_id = $this->put('user_id');
			$city = $this->put('city');
			if($user_id == 1 || $user_id == 2)
			{
				$this->load->model('Model_airports');
				$check_airport = $this->Model_airports->get_by(array('user_id'=>$user_id,'city'=>$city));
				
				if($user_id==2 && $check_airport)
				{
					$this->response(array('status'=>'failure','message'=>'Non Admin Can add only one Aiport per City'));
				}
				else
				{
					$airport = $this->put();
					$id = $this->Model_airports->insert($airport);
					if(!$id)
					{
						$this->response(array('status'=>'failure','message'=>'An unexpected error occured while creating Airport Entry'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
					}
					else
					{
						$this->response(array('status'=>'success','message'=>'Airport has been Added'));
					}
				}
			}
			else
			{
				$this->response(array('status'=>'failure','message'=>'Guest user cannot add Airports'));
			}
		}
		else
		{
			$this->response(array('status'=>'failure', 'message'=>$this->form_validation->get_errors_as_aaray()));
		}
	}
	
	function airport_post()
	{
		$id = $this->get('id');
		$this->load->model('Model_airports');
		$airport = $this->Model_airports->get_by(array('id'=>$id));
		if(isset($airport['id']))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_data($this->post());
			if($this->form_validation->run('airport_post') != false)
			{
				$user_id = $this->post('user_id');
				if($user_id == 1)
				{
					$this->load->model('Model_airports');
					$airport = $this->post();
					$updated = $this->Model_airports->update($id,$airport);
					if(!$updated)
					{
						$this->response(array('status'=>'failure','message'=>'An unexpected error occured while updating Airport Entry'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
					}
					else
					{
						$this->response(array('status'=>'success','message'=>'Airport has been Updated'));
					}
				}
				else
				{
					$this->response(array('status'=>'failure','message'=>'Only Admin user can update Airport'));
				}
			}
			else
			{
				$this->response(array('status'=>'failure', 'message'=>$this->form_validation->get_errors_as_aaray()));
			}
		}
		else
		{
			$this->response(array('status'=>'failure','message'=>'The specified airport could not be found'), REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	function airport_delete()
	{
		$id = $this->get('id');
		$user_id = $this->get('user_id');
		if($user_id == 1)
		{
			$this->load->model('Model_airports');
			$airport = $this->Model_airports->get_by(array('id'=>$id));
			if(isset($airport['id']))
			{
				$deleted = $this->Model_airports->delete($id);
				
				if(!$deleted)
				{
					$this->response(array('status'=>'failure','message'=>'An unexpected error occured while deleting Airport Entry'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'success','message'=>'Airport has been Deleted'));
				}
			}
			else
			{
				$this->response(array('status'=>'failure','message'=>'The specified airport could not be found'), REST_Controller::HTTP_NOT_FOUND);
			}
		}
		else
		{
			$this->response(array('status'=>'failure','message'=>'Only Admins can delete Airport'));
		}
	}
	
	function searchAirport_get()
	{
		$user_id = $this->get('user_id');
		
		$this->load->library('session');
		$this->load->helper('date');
		
		if(!($this->session->userdata('time')) && $user_id ==3)
		{
			$this->session->set_userdata(array('time' => date('Y-m-d H:i:s'),'hitCount'=> 1));
		}
		else if($this->session->userdata('time') && $user_id ==3)
		{
			$hitCount = $this->session->userdata('hitCount')+1;
			$this->session->set_userdata(array('hitCount'=> $hitCount));
		}
		
		$sessionTime = $this->session->userdata('time');
		$currentTime = date('Y-m-d H:i:s');
		
		$datetime1 = strtotime($this->session->userdata('time'));
		$datetime2 = strtotime(date('Y-m-d H:i:s'));
		$interval  = abs($datetime2 - $datetime1);

		if($user_id ==3 && $interval <= 60 && $this->session->userdata('hitCount') > 2)
		{
			$this->response(array('status'=>'failure','message'=>'Guest User can only hit search API 2 times in a minute'), REST_Controller::HTTP_NOT_FOUND);
		}
		
		if($user_id ==3 && $interval > 60 && $this->session->userdata('hitCount') > 2)
		{
			$this->session->set_userdata(array('time' => date('Y-m-d H:i:s'),'hitCount'=> 1));
		}
		
		$airport_code = $this->get('airport_code');
		
		$this->load->model('Model_airports');
		$searchAirports = $this->Model_airports->get_many_by(array('airport_code'=>$airport_code));
		
		if($searchAirports)
		{
			$this->response(array('status'=>'success','message'=>$searchAirports));
		}
		else
		{
			$this->response(array('status'=>'failure','message'=>'The specified airport could not be found'), REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
}
?>
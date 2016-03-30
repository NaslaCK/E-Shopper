<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegModel extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('session');
	}
	
	

	function login()
	{
		if(isset($_REQUEST['email'])&&isset($_REQUEST['password']))
		{
			if(isset($_REQUEST['email']))
			{
				$str4=$this->input->get_post('email');
				$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
				if(!(preg_match($pattern,$str4)))
				{
					$response['data']="Invalid input format for EMAIL";
	 				$response['error_code']="500";
	 				echo json_encode($response);
	 				die();
	 			}
	 			else
	 			{
	 				$dat['vchr_email']=$this->input->get_post('email');
	 				$this->db->select('*');
					$this->db->from('tbl_login');
					$where=$this->db->where($dat);
					$query=$this->db->get();
					if($query->result())
					{
						if(isset($_REQUEST['password']))
						{
							$data['vchr_email']=$this->input->get_post('email');
							$data['vchr_password']=$this->input->get_post('password');
							$this->db->select('*');
							$this->db->from('tbl_login');
							$where=$this->db->where($data);
							$query=$this->db->get();
							if($query->result())
							{
								$response['data']=$query->result();
	 							$response['error_code']="200 success";
	 							echo json_encode($response);
							}
							else
							{
								$response['data']="Incorrect password";
	 							$response['error_code']="500";
	 							echo json_encode($response);
							}
						}
					}
					else
					{
						$response['data']="Incorrect email";
	 					$response['error_code']="500";
	 					echo json_encode($response);
					}
	 			}
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}


	function register() 
	{
		if(isset($_REQUEST['fname'])&& isset($_REQUEST['lname'])&&isset($_REQUEST['email'])&&isset($_REQUEST['password']))
		{
			$str=$this->input->get_post('fname');
			$str1=$this->input->get_post('lname');
			
			$str4=$this->input->get_post('email');
			$l=strlen($this->input->get_post('password'));
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
			if(preg_match('/^[0-9]+$/', $str))
			{
				$response['data']="Invalid input format for first name";
	 			$response['error_code']="500";
	 			echo json_encode($response);
	 			die();
			}
			else if(preg_match('/^[0-9]+$/',$str1))
			{
				$response['data']="Invalid input format for last name";
	 			$response['error_code']="500";
	 			echo json_encode($response);
	 			die();
			}
			
			else if(!(preg_match($pattern,$str4)))
			{
				$response['data']="Invalid input format for EMAIL";
	 			$response['error_code']="500";
	 			echo json_encode($response);
	 			die();
	 		}
			else if($l<6)
			{
				$response['data']="Invalid input format for pasword";
	 			$response['error_code']="500";
	 			echo json_encode($response);
	 			die();
			}
			else
	 		{
				$data=array
				(
					'fnm'=>$this->input->get_post('fname'),
					'lnm'=>$this->input->get_post('lname'),
					'email'=>$this->input->get_post('email'),
					'pass'=>$this->input->get_post('password')
				);
				if($this->db->query("call csp_reg_log(?,?,?,?)",$data))
				{
					$response['data']="Data successfully inserted";
	 				$response['error_code']="200";
	 				echo json_encode($response);
				}
				else
				{
					$response['data']="Error in inserting data";
	 				$response['error_code']="500";
	 				echo json_encode($response);
				}
			}
			
		}
		else
		{
			$response['data']="insufficient data";
	 		$response['error_code']="500 ";
			echo json_encode($response);
		}
	}

	function insertcategory()
	{
		if(isset($_REQUEST['category']))
		{
			$str=$_REQUEST['category'];
			if (preg_match('/^[0-9]+$/', $str))
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);
			}
			else
			{
				$data['vchr_cat_name']=$this->input->get_post('category');
				if($this->db->query("call csp_insert_category(?)",$data))
				{
	 				$response['data']="Data successfully inserted";
	 				$response['error_code']="200";
	 			 	echo json_encode($response);
	 			}
	   			else 
	   			{
	     			$response['data']="Error in data insertion";
	 				$response['error_code']="500";
	 			 	echo json_encode($response);
	     		} 
			}
		}
		else
		{
			$response['data']="no input provided";
	 		$response['error_code']="500 ";
			echo json_encode($response);
        }
	}

	function selectcat()
	{
		$query=$this->db->query('select * from tbl_category');
		if($query->result())
		{
			$response['data']= $query->result();
			$response['error_code']="200";
			echo json_encode($response);
        }
        else
        {
          	$response['data']="error";
			$response['error_code']="500";	
        }
	}

	function insertsubcat()
	{
		if(isset($_REQUEST['subcategory_name'])&&isset($_REQUEST['category_id']))
		{
			$str =$_REQUEST['subcategory_name'];
			if (preg_match('/^[0-9]+$/', $str))
			{
				$response['data']="Invalid input format for subcategory";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$str1=$_REQUEST['category_id'];
			if (preg_match('/^[a-z]+$/', $str1))
			{
				$response['data']="Invalid input format for category_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$data=array(
				'vchr_sub_name'=>$this->input->get_post('subcategory_name'),
				'fk_int_cat_id'=>$this->input->get_post('category_id')	
			);
			if($this->db->query("call csp_insert_sub_category(?,?)",$data))
			{
				$response['data']="Data successfully inserted";
	 			$response['error_code']="200";
	 			echo json_encode($response);
			}
			else
			{
				$response['data']="Error in inserting data";
	 			$response['error_code']="500";
	 			echo json_encode($response);
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
		
	}


	function insertproduct($imgs)
	{
		if(isset($_REQUEST['productname'])&&isset($_REQUEST['price'])&&isset($_REQUEST['desc'])&&isset($_REQUEST['quan'])&&isset($_REQUEST['sel2'])&&isset($_REQUEST['selprice']))
		{
			$str=$_REQUEST['price'];
			$str1=$_REQUEST['quan'];
			$str2=$_REQUEST['sel2'];
			$str=$_REQUEST['selprice'];
			if (preg_match('/^[a-z]+$/', $str))
			{
				$response['data'] ="Invalid input format for price";
				$response['error_code']="500 error";
				echo json_encode($response);
				die();
			}
			else if (preg_match('/^[a-z]+$/', $str1))
			{
				$response['data'] ="Invalid input format for quantity";
				$response['error_code']="500 error";
				echo json_encode($response);
				die();
			}
			else if(preg_match('/^[a-z]+$/', $str2))
			{
				$response['data'] ="Invalid input format for subcategory_id";
				$response['error_code']="500 error";
				echo json_encode($response);
				die();
			}
			else if(preg_match('/^[a-z]+$/', $str3))
			{
				$response['data'] ="Invalid input format for selling price";
				$response['error_code']="500 error";
				echo json_encode($response);
				die();
			}
			else
			{
				$data=array(
					'vchr_product_name'=>$this->input->get_post('productname'),
					'int_price'=>$this->input->get_post('price'),
					'vchr_desc'=>$this->input->get_post('desc'),
					'int_quantity'=>$this->input->get_post('quan'),
					'fk_int_sub_id'=>$this->input->get_post('sel2'),
					'selling_price'=>$this->input->get_post('selprice'),
					'vchr_product_image'=>$imgs['upload_data']['file_name'],
					'vchr_product_side_view'=>'abc.jpg',
				);
				if($this->db->query("call csp_insert_product(?,?,?,?,?,?,?,?)",$data))
				{	
					$response['data']="Data successfully inserted";
	 				$response['error_code']="200";
	 				echo json_encode($response);
				}
				else
				{
					$response['data']="Error in inserting data";
	 				$response['error_code']="500";
	 				echo json_encode($response);
				}
			}
		}	
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}


	function productselectcat()
	{
		$query=$this->db->query('select * from tbl_category');
		if($query->result())
		{
			$response['data']= $query->result();
			$response['error_code']="200";
			echo json_encode($response);
        }
        else
        {
          	$response['data']="error";
			$response['error_code']="500";	
        }
	}


	function select_subc()
	{
		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['fk_int_cat_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_sub_category');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
    }


	



	function viewcategory()
	{
		$query=$this->db->query('select * from tbl_category');
		if($query->result())
		{
			$response['data']= $query->result();
			$response['error_code']="200";
			echo json_encode($response);
        }
        else
        {
          	$response['data']="error";
			$response['error_code']="500";	
        }
	}


	function viewsub()
	{
		$query=$this->db->query('select * from tbl_sub_category');
		if($query->result())
		{
			$response['data']= $query->result();
			$response['error_code']="200";
			echo json_encode($response);
        }
        else
        {
          	$response['data']="error";
			$response['error_code']="500";	
        }
	}


	function onchangesub()
	{
		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['fk_int_cat_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_sub_category');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
	}


	function viewpro()
	{
		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['fk_int_cat_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_sub_category');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
	}


	function subproviews()
	{
		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['fk_int_sub_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_product');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
	}


	function editcateg()
	{
		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['pk_int_cat_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_category');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
	}


	function editbtncat()
	{
		if(isset($_REQUEST['category_id'])&&isset($_REQUEST['category_name']))
		{
			$str =$_REQUEST['category_id'];
			if ((preg_match('/^[a-z]+$/', $str)))
			{
				$response['data']="Invalid input format for category_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$str1=$_REQUEST['category_name'];
			if (preg_match('/^[0-9]+$/', $str1))
			{
				$response['data']="Invalid input format for category_name";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$data['cat']=$this->input->get_post('category_id');
			$data['name']=$this->input->get_post('category_name'); 
			if($this->db->query('call csp_update_category(?,?)',$data))
			{
				$response['data']="Data successfully updated";
	 			$response['error_code']="200";
	 			echo json_encode($response);
			}
			else
			{
				$response['data']="Error in updating data";
	 			$response['error_code']="500";
	 			echo json_encode($response);
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}

	function delcat()
	{
		// $data['pk_int_cat_id']=$this->input->post('name');
		// $this->db->query('call csp_delete_category(?)',$data);

		if(isset($_REQUEST['category_id']))
		{
			$str =$_REQUEST['category_id'];
			if ((preg_match('/^[a-z]+$/', $str)))
			{
				$response['data']="Invalid input format for category_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$data['pk_int_cat_id']=$this->input->get_post('category_id');
			if($this->db->query('call csp_delete_category(?)',$data))
			{
				$response['data']="Data successfully deleted";
	 			$response['error_code']="200";
	 			echo json_encode($response);
			}
			else
			{
				$response['data']="Error in deleting data";
	 			$response['error_code']="500";
	 			echo json_encode($response);
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
		
	}

	function editsubcat()
	{

		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['pk_int_sub_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_sub_category');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
	}
	
	function editbtnsub()
	{
		
		if(isset($_REQUEST['category_id'])&&isset($_REQUEST['subcategory_name']))
		{
			$str =$_REQUEST['category_id'];
			if ((preg_match('/^[a-z]+$/', $str)))
			{
				$response['data']="Invalid input format for category_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$str1=$_REQUEST['subcategory_name'];
			if (preg_match('/^[0-9]+$/', $str1))
			{
				$response['data']="Invalid input format for subcategory_name";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$data['cat']=$this->input->get_post('category_id');
			$data['name']=$this->input->get_post('subcategory_name'); 
			if($this->db->query('call csp_update_sub_category(?,?)',$data))
			{
				$response['data']="Data successfully updated";
	 			$response['error_code']="200";
	 			echo json_encode($response);
			}
			else
			{
				$response['data']="Error in updating data";
	 			$response['error_code']="500";
	 			echo json_encode($response);
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}

	function m_delsubcategory()
	{
		// $data['pk_int_sub_id']=$this->input->post('name');
		// $this->db->query('call csp_delete_sub_category(?)',$data);


		if(isset($_REQUEST['subcategory_id']))
		{
			$str =$_REQUEST['subcategory_id'];
			if ((preg_match('/^[a-z]+$/', $str)))
			{
				$response['data']="Invalid input format for subcategory_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$data['pk_int_sub_id']=$this->input->get_post('subcategory_id');
			if($this->db->query('call csp_delete_sub_category(?)',$data))
			{
				$response['data']="Data successfully deleted";
	 			$response['error_code']="200";
	 			echo json_encode($response);
			}
			else
			{
				$response['data']="Error in deleting data";
	 			$response['error_code']="500";
	 			echo json_encode($response);
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}


	function editpro()
	{
		
		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['pk_int_product_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_product');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
	}

	

	function editbtnpro()
	{
		if(isset($_REQUEST['id'])&&isset($_REQUEST['pro'])&&isset($_REQUEST['price'])&&isset($_REQUEST['descr'])&&isset($_REQUEST['quan']))
		{
			$str =$_REQUEST['id'];
			if ((preg_match('/^[a-z]+$/', $str)))
			{
				$response['data']="Invalid input format for product_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$str1 =$_REQUEST['pro'];
			if ((preg_match('/^[0-9]+$/', $str1)))
			{
				$response['data']="Invalid input format for product_name";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$str2 =$_REQUEST['price'];
			if ((preg_match('/^[a-z]+$/', $str2)))
			{
				$response['data']="Invalid input format for price";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$str3 =$_REQUEST['quan'];
			if ((preg_match('/^[a-z]+$/', $str3)))
			{
				$response['data']="Invalid input format for quantity";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			else
			{
				$data=array(
					'id'=>$this->input->get_post('id'),
					'name'=>$this->input->get_post('pro'),
					'price'=>$this->input->get_post('price'), 
					'descr'=>$this->input->get_post('descr'), 
					'quantity'=>$this->input->get_post('quan')
				);
				if($this->db->query('call csp_update_product(?,?,?,?,?)',$data))
				{
					$response['data']="Data successfully updated";
	 				$response['error_code']="200";
	 				echo json_encode($response);
				}
				else
				{
					$response['data']="Error in updating data";
	 				$response['error_code']="500";
	 				echo json_encode($response);
				}
			}
			
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}
	
	function m_delproduct()
	{
		
		if(isset($_REQUEST['product_id']))
		{
			$str =$_REQUEST['product_id'];
			if ((preg_match('/^[a-z]+$/', $str)))
			{
				$response['data']="Invalid input format for product_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$data['pk_int_product_id']=$this->input->get_post('product_id');
			if($this->db->query('call csp_delete_product(?)',$data))
			{
				$response['data']="Data successfully deleted";
	 			$response['error_code']="200";
	 			echo json_encode($response);
			}
			else
			{
				$response['data']="Error in deleting data";
	 			$response['error_code']="500";
	 			echo json_encode($response);
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}

	function viewcustomer()
	{
		$query=$this->db->query('select * from tbl_registration where vchr_status="active"');
		if($query->result())
		{
			$response['data']= $query->result();
			$response['error_code']="200";
			echo json_encode($response);
        }
        else
        {
          	$response['data']="error";
			$response['error_code']="500";	
        }
	}

	function viewcus(){
		$query=$this->db->query('select * from tbl_registration');
		if($query->result())
		{
			$response['data']= $query->result();
			$response['error_code']="200";
			echo json_encode($response);
        }
        else
        {
          	$response['data']="error";
			$response['error_code']="500";	
        }
	}

	function suspendcust()
	{

		if(isset($_REQUEST['registration_id']))
		{
			$str =$_REQUEST['registration_id'];
			if ((preg_match('/^[a-z]+$/', $str)))
			{
				$response['data']="Invalid input format for product_id";
	 			$response['error_code']="200";
	 			echo json_encode($response);
	 			die();
			}
			$data['id']=$this->input->get_post('registration_id');
			if($this->db->query('call csp_suspend_customer(?)',$data))
			{
				$response['data']="customer suspended";
	 			$response['error_code']="200";
	 			echo json_encode($response);
			}
			else
			{
				$response['data']="Error in suspending";
	 			$response['error_code']="500";
	 			echo json_encode($response);
			}
		}
		else
		{
			$response['data']="Insufficient amount of data";
	 		$response['error_code']="500";
	 		echo json_encode($response);
		}
	}

	function customercat()
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$query=$this->db->get();
		return $query->result();
		// if($query->result())
		// {
		// 	$response['data']= $query->result();
		// 	$response['error_code']="200";
		// 	echo json_encode($response);
  //       }
  //       else
  //       {
  //         	$response['data']="error";
		// 	$response['error_code']="500";	
  //       }
		
		// print_r('$_query');

		
	}

	function customersub()
	{
		

		if(isset($_REQUEST['name']))
		{
			$str =$_REQUEST['name'];
			if (preg_match('/^[0-9]+$/', $str))
            {		
               $data['fk_int_cat_id']=$this->input->get_post('name');
				$this->db->select('*');
				$this->db->from('tbl_sub_category');
				$where=$this->db->where($data);
				$query=$this->db->get();
	       		if($query->result())
				{
					$response['data'] =$query->result();
					$response['error_code']="200 success";
				 	echo  json_encode($response);
				}
				else
				{
					$response['data']="No matching data found";
					$response['error_code']="500";
				 	echo json_encode($response);
				}
			}	
			else
			{
				$response['data'] ="Invalid input format";
				$response['error_code']="500 error";
				echo json_encode($response);

			}
   		}
		else 
		{
			$response['data']="no input provided";
			$response['error_code']="500 ";
			echo json_encode($response);
		}
	}

	function prodpic()
	{
		$data['fk_int_sub_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_product', 'pk_int_product_id=fk_int_product_id');
		$where=$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
		
		
	}

	function purchased()
	{
		$dd=$this->session->userdata();
		$data=array(
			'fk_int_product_id'=>$this->input->post('name'),
			'int_quantity'=>$this->input->post('quantity'),
			'int_total_amount'=>$this->input->post('price'),
			'fk_int_login_id'=>$dd['id']
			);
		
	$result=	$this->db->query('call csp_insert_purchase(?,?,?,?)',$data);
	
	}

	function purchasedet()
	{
		$data['fk_int_login_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_product', 'fk_int_product_id=pk_int_product_id');
		$where=$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
	} 


	function showallprods(){
		$this->db->select('*');
		$this->db->from('tbl_product');
		$query = $this->db->get();
		return $query->result();
	}

	function viewproductdesc()
{
		$data['pk_int_product_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_stock','pk_int_product_id=fk_int_product_id');
		$where=$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
		//print_r($query);
		
}

	






































	

	

	}
	?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegModel extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('session');
	}
	
	function insert(){
		$data = array (
			
			'fnm'=>$this->input->post('fname'),
			'lnm'=>$this->input->post('lname'),
			'email'=>$this->input->post('email'),
			'password'=>$this->input->post('password'),
			
          );
		$this->db->query("call csp_reg_log(?,?,?,?)",$data);
	}

	function login()
	{
		$data['vchr_email']=$this->input->post('email');
		$data['vchr_password']=$this->input->post('password');
		$this->db->select('*');
		$this->db->from('tbl_login');
		$where=$this->db->where($data);
		$query=$this->db->get();
		foreach($query->result() as $row)
		{
			$role=$row->fk_int_user_role_id;
			$id=$row->pk_int_login_id;
			$sess['id']=$row->pk_int_login_id;
			$sess['name']=$row->vchr_email;
			$this->session->set_userdata($sess);
		}

		if($query->result()==NULL)
		{
			echo "invalid username or password";
		}
		else if($query!=="" && $role==1)
		{
			$this->load->view('adminhome');
		}
		else if($query!=="" && $role==2) 
		{
			$dat['fk_int_login_id']=$row->pk_int_login_id;
			$this->db->select('*');
			$this->db->from('tbl_registration');
			$where=$this->db->where($dat);
			$query1=$this->db->get();
			foreach($query1->result() as $row1)
			{
				$status=$row1->vchr_status;
			}	
			if($status=='Inactive')
			{
				echo "blocked";
			}
			else if($role==2 && $status=='Active')
			{
				$this->load->view('homepage');
			}
			
		}
	}

	function insertcategory()
	{
		$data['vchr_cat_name']=$this->input->post('cat');
		$this->db->query("call csp_insert_category(?)",$data);
	}

	function selectcat()
	{
		$query=$this->db->query('select * from tbl_category');
		return $query->result();
	}

	function insertsubcat()
	{
		$data=array(
			'vchr_sub_name'=>$this->input->post('subcat'),
			'fk_int_cat_id'=>$this->input->post('fk_int_cat_id')	
		);
		$this->db->query("call csp_insert_sub_category(?,?)",$data);
	}


	function insertproduct($imgs)
	{
		$data=array(
			'vchr_product_name'=>$this->input->post('productname'),
			'int_price'=>$this->input->post('price'),
			'vchr_desc'=>$this->input->post('desc'),
			'int_quantity'=>$this->input->post('quan'),
			'fk_int_sub_id'=>$this->input->post('sel2'),
			'selling_price'=>$this->input->post('selprice'),
			'vchr_product_image'=>$imgs['upload_data']['file_name'],
			'vchr_product_side_view'=>'abc.jpg',
		);
		$this->db->query("call csp_insert_product(?,?,?,?,?,?,?,?)",$data);
	}

	function productselectcat()
	{
		$query=$this->db->query('select * from tbl_category');
		return $query->result();
		$q=$this->db->query('select * from tbl_sub_category  ');
	 	return $q->result();
	}



	function select_subc()
	{
		$data['fk_int_cat_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_sub_category');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
	}



	function viewcategory()
	{
		$query=$this->db->query('select * from tbl_category');
		return $query->result();
	}


	function viewsub()
	{
		$query=$this->db->query('select * from tbl_sub_category');
		return $query->result();
	}


	function onchangesub()
	{
		$data['fk_int_cat_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_sub_category');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
	}


	function viewpro()
	{
		$data['fk_int_cat_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_sub_category');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
	}


	function subproviews()
	{
		$data['fk_int_sub_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_product');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
	}


	function editcateg()
	{
		$data['pk_int_cat_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_category');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
	}


	function editbtncat()
	{
		$data['cat']=$this->input->post('didd');
		$data['name']=$this->input->post('cat'); 
		// echo $this->input->post('didd');

		$this->db->query('call csp_update_category(?,?)',$data);
	}

	function delcat()
	{
		$data['pk_int_cat_id']=$this->input->post('name');
		$this->db->query('call csp_delete_category(?)',$data);
		
	}

	function editsubcat()
	{
		$data['pk_int_sub_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_sub_category');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
	}
	
	function editbtnsub()
	{
		$data['cat']=$this->input->post('did');
		$data['name']=$this->input->post('subcat'); 
		// echo $this->input->post('didd');

		$this->db->query('call csp_update_sub_category(?,?)',$data);
	}

	function m_delsubcategory()
	{
		$data['pk_int_sub_id']=$this->input->post('name');
		$this->db->query('call csp_delete_sub_category(?)',$data);
	}


	function editpro()
	{
		$data['pk_int_product_id']=$this->input->post('name');
		$this->db->select('*');
		$this->db->from('tbl_product');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
	}

	

	function editbtnpro()
	{
		$data=array(
			'id'=>$this->input->post('id'),
			'name'=>$this->input->post('pro'),
			'price'=>$this->input->post('price'), 
			'descr'=>$this->input->post('descr'), 
			'quantity'=>$this->input->post('quan')
			);
		$this->db->query('call csp_update_product(?,?,?,?,?)',$data);
	}
	
	function m_delproduct()
	{
		$data['pk_int_product_id']=$this->input->post('name');
		$this->db->query('call csp_delete_product(?)',$data);
	}

	function viewcustomer()
	{
		$query=$this->db->query('select * from tbl_registration');
		return $query->result();
	}

	function viewcus(){
		$query=$this->db->query('select * from tbl_registration');
		return $query->result();
	}

	function suspendcust()
	{
		$data['id']=$this->input->post('name');
		$this->db->query('call csp_suspend_customer(?)',$data);
	}

	function customercat()
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$query=$this->db->get();
		return $query->result();
	}

	function customersub()
	{
		$data['fk_int_cat_id']=$this->input->post('name');
		
		$this->db->select('*');
		$this->db->from('tbl_sub_category');
		$where=$this->db->where($data);
		$query=$this->db->get();
		return $query->result();
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
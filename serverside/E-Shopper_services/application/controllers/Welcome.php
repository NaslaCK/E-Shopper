<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RegModel');
		$this->load->helper('url','form');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('index');
	}
	public function login()
	{
		$this->load->view('login');
	}
	public function registration()
	{
		$this->load->view('registration');
	}
	public function about()
	{
		$this->load->view('about');
	}
	public function contact()
	{
		$this->load->view('contact');
	}
	public function shop()
	{
		$this->load->view('shop');
	}
	
	public function homepage()
	{
		$this->load->view('homepage');
	}




	public function insertreg()
	{
		
		if(isset($_POST['submit'])){
			$this->load->model('RegModel');
			$this->RegModel->register($_POST);
			$this->load->view('homepage');
		}else {
			$this->load->view('registration');
		}
	}

	public function loginuser()
	{
			$this->load->model('RegModel');
			$this->RegModel->login();
		
	}

	public function admin()   
	{
		$this->load->view('adminhome');
	}

	public function addcat()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
		$this->load->view('category');
		}
		else
		{
			$this->load->view('index');
		}
	}
	
	public function addsub()
	{
		$this->load->view('addsubcategory');
	}

	

	public function aboutus()
	{
		$this->load->view('aboutus');
	}

	public function insertcat()
	{
		
		if(isset($_POST['sub']))
		{
			$this->load->model('RegModel');
			$this->RegModel->insertcategory($_POST);
			$this->load->view('category');
		}
		
	}

	public function subcop()
	{
		$this->load->model('RegModel');
		$data['subcat']=$this->RegModel->select_subc($_POST);
		$this->load->view('subcatdisp',$data);
	}

	public function selectcategory()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
		if(isset($_POST['sub']))
		{
			$this->load->model('RegModel');
			$this->RegModel->insertsubcat();
			$data['category']=$this->RegModel->selectcat();
			$this->load->view('addsubcategory',$data);
		}
		else
		{
			$data['category']=$this->RegModel->selectcat();
			$this->load->view('addsubcategory',$data);
		} 
		}
		else
		{
			$this->load->view('index');
		}

	}


	public function products()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
		$this->load->model('RegModel');
			$data['category']=$this->RegModel->productselectcat();
			//$data['subcategory']=$this->RegModel->productselectcat();
			$this->load->view('addproducts',$data);
		}
		else
		{
			$this->load->view('index');
		}
	}


	public function insertpro()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
		$config = array(
			'upload_path' => "http://files.baabtra.com/eshopper/uploads/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
		'overwrite' => TRUE,
		'max_size' => "", 
		'max_height' => "",
		'max_width' => ""
		);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$data = array('upload_data' => $this->upload->data());


		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('addproducts', $error);
		}		
	
		if(isset($_POST['submitt']))
		{
			
			$this->RegModel->insertproduct($data);
			$this->load->view('addproducts');
		}
		}
		else
	{
		$this->load->view('index');
	}
	}


	public function viewcategory()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{		
			$this->load->model('RegModel');
			$data['viewcat']=$this->RegModel->viewcategory();
			$this->load->view('viewcategory',$data);
		}
		else
		{
			$this->load->view('index');
		}			
	}


	public function viewsubcategory()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
			$this->load->model('RegModel');
			$data['category']=$this->RegModel->viewsub();
			$this->load->view('viewsub',$data);
		}
		else
		{
			$this->load->view('index');
		}					
	}

	public function viewtblsub()
	{

		$this->load->model('RegModel');
	    $data['subcategory']=$this->RegModel->onchangesub();
	    $this->load->view('viewsubselect',$data);
	}


	public function viewproducts()                    
	{
		$this->load->model('RegModel');
		$data['subcat']=$this->RegModel->viewpro($_POST);
		$this->load->view('subcatdisp',$data);
	}
	
	public function viewprod()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
			$this->load->model('RegModel');
			$data['category']=$this->RegModel->viewcategory();
			$this->load->view('viewproduct',$data);
		}
		else
		{
			$this->load->view('index');
		}	
		
		
	}

	public function viewtblpro()
	{
		$this->load->model('RegModel');
	    $data['products']=$this->RegModel->subproviews($_POST);
	    $this->load->view('productview',$data);
	}


	public function editcat()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
			$this->load->model('RegModel');
			$data['viewcat']=$this->RegModel->viewcategory();
			$this->load->view('editcategory',$data);
		}
		else
		{
			$this->load->view('index');
		}	
		
	}
	
	public function edit()
	{
		$this->load->model('RegModel');
		$data['category']=$this->RegModel->editcateg($_POST);
		$this->load->view('editbutton',$data);
	}

	public function updatecat()
	{
		$this->load->model('RegModel');
		$this->RegModel->editbtncat($_POST);
	}

	public function delete()
	{
		$this->load->model('RegModel');
		$this->RegModel->delcat();

	}


	public function editsubcat()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{		
			$this->load->model('RegModel');
			$data['category']=$this->RegModel->selectcat();
			$this->load->view('editsub',$data);
		}
		else
		{
			$this->load->view('index');
		}					
	} 

	public function editsub()
	{
		$this->load->model('RegModel');
		$data['category']=$this->RegModel->editsubcat($_POST);
		$this->load->view('editbutton',$data);

	}

	public function updatesub()
	{
		$this->load->model('RegModel');
		$this->RegModel->editbtnsub($_POST);

	}

	public function deletesubcategory()
	{
		$this->RegModel-> m_delsubcategory();
	}


	public function editproduct()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
			$this->load->model('RegModel');
			$data['category']=$this->RegModel->viewcategory();
			$this->load->view('editproducts',$data);
		}
		else
		{
			$this->load->view('index');		
		}	
		
		
	}
	
	public function productsedit()
	{
		$this->load->model('RegModel');
		$data['products']=$this->RegModel->editpro($_POST);
		$this->load->view('productview',$data);
	}

	public function updateproduct()
	{
		$this->load->model('RegModel');
		$this->RegModel->editbtnpro();

	}


	public function delproduct()
	{
		$this->RegModel-> m_delproduct();
	}

	public function viewcusto()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{		
			$this->load->model('RegModel');
			$data['viewcust']=$this->RegModel->viewcustomer();
			$this->load->view('viewcustomer',$data);
		}
		else
		{
			$this->load->view('index');
		}	
		
	}

	public function suspendcusto()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
			$this->load->model('RegModel');
			$data['suspendcust']=$this->RegModel->viewcus();
			$this->load->view('suspendcustomer',$data);
		}
		else
		{
			$this->load->view('index');
		}	
		
		
	}

	public function onclicksuspend()
	{
		$ses=$this->session->userdata();
		if(isset($ses['id']))
		{
			$this->load->model('RegModel');
			$this->RegModel->suspendcust();
			$this->load->view('suspendcustomer',$data);
		}
		else
		{
			$this->load->view('index');
		}				
	}

	public function showcustcat()
	{
		$this->load->model('RegModel');
		$data['custcat']=$this->RegModel->customercat();
		$this->load->view('showcategory',$data);

	}

	public function showcustsubs()
	{
		$this->load->model('RegModel');
		$data['subcatss']=$this->RegModel->customersub($_POST);
		$this->load->view('subcatencode',$data);
	}

	public function logout()
	{
		$this->session->unset_userdata('$sess');
		session_destroy();
		redirect();
	}

	public function blank()
	{
		$this->load->view('a');
	}

	public function showproductpic()
	{
		$this->load->model('RegModel');
		$data['picss']=$this->RegModel->prodpic($_POST);
		$this->load->view('picsencode',$data);
	}

	public function detailofproducts()
	{
		$this->load->model('RegModel');
		$data['details']=$this->RegModel->purchasedet($_POST);
		$this->load->view('purchaseddetails',$data);
	}

	public function proddisplay(){
		$this->load->model('RegModel');
		$data['detaied']=$this->RegModel->showallprods();
		$this->load->view('allprodencode',$data);
	}


	public function purchaseproduct()
	{
		$this->load->model('RegModel');
		$data['pro']=$this->RegModel->purchased($_POST);
		$this->load->view('purchaseencode',$data);
	}

	public function productdetails()
	{
		$dat['id']=$this->input->post('a');
		$dat['name']=$this->input->post('b');
		$dat['price']=$this->input->post('c');
		$dat['desc']=$this->input->post('d');
		$dat['img']=$this->input->post('e');
		$dat['quantity']=$this->input->post('f');
		
       

		$this->load->view('productdetails',$dat);
	}

	public function showdetails()
	{
		$this->load->model('RegModel');
		$data['pd']=$this->RegModel->viewproductdesc();
		$this->load->view('descencode',$data);
       //print_r($data);
	}






	

	


































































	

}

<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function dashboard()
		{
			$data['page_id'] = 1;
			$data['page_tag'] = "Dashboard";
			$data['page_title'] = "Dashboard <small>Ecommerce</small>";
			$data['page_name'] = "dashboard";
			$data['page_content'] = "";
			$this->views->getView($this,"dashboard",$data);
		}

	}
 
?>
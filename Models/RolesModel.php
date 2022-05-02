<?php 

	class RolesModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

        public function selectRoles()
        {
            $sql = "SELECT r.*
                    FROM rol r";
            $request = $this->select_all($sql);
            return $request;
        }
	}

?>
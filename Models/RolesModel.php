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
                    FROM rol r
                    WHERE estado != 0";
            $request = $this->select_all($sql);
            return $request;
        }
	}

?>
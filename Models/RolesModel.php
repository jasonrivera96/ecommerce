<?php 

	class RolesModel extends Mysql
	{
        public $intIdRol;
        public $strNombreRol;
        public $strDescripcionRol;
        public $intEstadoRol;

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

        public function insertRol(string $nombreRol, string $descripcionRol, int $estadoRol)
        {
            $return = "";
            $this->strNombreRol = $nombreRol;
            $this->strDescripcionRol = $descripcionRol;
            $this->intEstadoRol = $estadoRol;

            $sql = "SELECT r.*
                    FROM rol r
                    WHERE nombrerol = '{$this->strNombreRol}' ";
            $request = $this->select_all($sql);

            if(empty($request)){
                $query_insert = "INSERT INTO rol (nombrerol, descripcion, estado) VALUES (?,?,?)";
                $arrData = array(
                    $this->strNombreRol,
                    $this->strDescripcionRol,
                    $this->intEstadoRol
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }
	}

?>
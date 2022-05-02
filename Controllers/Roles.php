<?php 

	class Roles extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Roles()
		{
			$data['page_id'] = 3;
			$data['page_tag'] = "Roles Usuario";
			$data['page_title'] = "Roles Usuario";
			$data['page_name'] = "rol_usuario";
			$data['page_content'] = "";
			$this->views->getView($this,"roles",$data);
		}

        public function getRoles()
        {
            $arrData = $this->model->selectRoles();

            for($i = 0; $i < count($arrData); $i++) {
                if($arrData[$i]['estado'] == 1){
                    $arrData[$i]['estado'] = '<span class="badge badge-info">ACTIVO</span>';
                }else{
                    $arrData[$i]['estado'] = '<span class="badge badge-warning">INACTIVO</span>';
                }

                $arrData[$i]['acciones'] =
                    '<div class="text-center">
                        <button class="btn btn-secondary btn-sm btnPermisosRol" type="button" idRol="'.$arrData[$i]['idrol'].'" title="Permisos"><i class="fa-solid fa-key"></i></button>
                        <button class="btn btn-info btn-sm btnEditarRol" type="button" idRol="'.$arrData[$i]['idrol'].'" title="Editar"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btn-sm btnEliminarRol" type="button" idRol="'.$arrData[$i]['idrol'].'" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                    </div>';
            }


            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setRol()
        {
            imprimir($_POST);
        }

	}
 
?>
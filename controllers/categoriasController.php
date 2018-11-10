<?php

class categoriasController extends AppController
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$categoria = $this->loadmodel("categorias");
		$this->_view->categoria = $categoria->listarTodo();

		$this->_view->titulo = "Listado de tareas";
		$this->_view->renderizar("index");
	}


    public function eliminar($id){
    	$categoria = $this->loadmodel("categorias");
    	$registro = $categoria->buscarPorId($id);

    	if (!empty($registro)) {
    		$categoria->eliminarPorId($id);
    		$this->redirect(array("controller"=>"categorias"));
    	}
	}
	


	public function agregar(){

		if ($_POST) {
			$categoria = $this->loadmodel("categorias");
			$this->_view->categoria = $categoria->guardar($_POST);
            $this->redirect(array("controller"=>"categorias"));
		}

		$categorias = $this->loadmodel("categorias");
		$this->_view->categorias = $categorias->listarTodo();

		$this->_view->titulo = "Agregar tarea";
		$this->_view->renderizar("agregar");
	}

	public function editar($id=null){
        if($_POST){
            $categoria = $this->loadmodel("categorias");
            $categoria->actualizar($_POST);
            $this->redirect(array("controller"=>"categorias"));       
        }
        $categoria = $this->loadmodel("categorias");
        $this->_view->categoria = $categoria->buscarPorId($id);
        
        $categorias = $this->loadmodel("categorias");
		$this->_view->categorias = $categorias->listarTodo();
        
        $this->_view->titulo = "Editar tarea";
		$this->_view->renderizar("editar");
        
    }


}
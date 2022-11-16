<?php

require_once './Model/modelresenias.php';
require_once './View/api.view.php';

class ReseniasApiController {
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new Modelresenias();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getResenias($params = null) {
        
        if(isset($_GET['sort']) && isset($_GET['order'])){

            $sort = $_GET['sort'];
            $order = $_GET['order'];
                        
            if (($sort == 'id_resenia' || $sort == 'consulta_id' || $sort == 'comentario'|| $sort == 'mascota' || $sort == 'puntuacion') 
            && ($order == 'asc' || $order == 'desc' || $order == 'ASC' || $order == 'DESC')){

            $resenias = $this->model->getOrdenado($sort, $order );
                            
                $this->view->response($resenias);
                } else { 
                $this->view->response("No se puede ordenar", 400);
                }

        }
        else if(isset($_GET['page']) && isset($_GET['limit'])){

            $page = $_GET['page'];
            $limit = $_GET['limit'];
            $resenias = $this->model->getPaginacion($page, $limit);
           
                if ($resenias) {
                $this->view->response($resenias);
                } else {
                $this->view->response("No se encontro la pagina buscada",404);
                }             
        }
        else if (isset($_GET['filter']) && isset($_GET['value'])){
            $filter=$_GET['filter'];
            $value= $_GET['value'];
            
            if (($filter=='id_resenia')|| ($filter=='consulta_id')||($filter=='comentario')||($filter=='mascota') ||($filter=='puntuacion')) {
                
                $resenia = $this->model->getFiltrado($filter, $value);
                if ($resenia!=null)
                $this->view->response($resenia);
               } else {
                $this->view->response("No se encontro el valor buscado",404);
              } 
                      
       }
       else{
            $resenias = $this->model->getAll();
            $this->view->response($resenias);
        } 
    }

    public function getResenia($params = null) {
        
        $id = $params[':ID'];
        $resenia = $this->model->get($id);
       
        if ($resenia)
            $this->view->response($resenia);
        else 
            $this->view->response("La resenia con el id=$id no existe", 404);
    }
    
       
    public function deleteResenia($params = null) {
        $id = $params[':ID'];
        $resenia = $this->model->get($id);

        if ($resenia) {
            $this->model->delete($id);
            $this->view->response($resenia);
            $this->view->response("Se elimino con exito la resenia $id ", 200);
        } else 
            $this->view->response("La resenia con el id=$id no existe", 404);
    }

    public function insertResenia($params = null) {
        $resenia = $this->getData();
        
        if (empty($resenia->consulta_id) || empty($resenia->comentario) || empty($resenia->mascota) || empty($resenia->puntuacion)){
            $this->view->response("falta completar datos", 400);
        } 
        else {
            $id = $this->model->insertar($resenia->consulta_id, $resenia->comentario, $resenia->mascota, $resenia->puntuacion);
            $resenia = $this->model->get($id);
            $this->view->response($resenia, 201);
            $this->view->response("Se agrego con exito la resenia $id ", 200);
        }

    }
    
    public function editResenia($params = null) {
        $id = $params[':ID'];
        $consultaEdit = $this->model->get($id);
               
        if ($consultaEdit) {
        $resenia = $this->getData();
                $this->model->editar($id, $resenia->consulta_id, $resenia->comentario, $resenia->mascota, $resenia->puntuacion);
                $this->view->response("Consulta con id: $id editada con exito", 200);
                    }    
        else {
            $this->view->response("La resenia a editar no existe", 404);
        }
    
    }
    
    }


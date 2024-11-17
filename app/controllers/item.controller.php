<?php
    require_once './app/models/item.model.php';
    require_once './app/views/json.view.php';

    class PlantApiController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new GardenModel();
            $this->view = new JSONView();
        }

        public function getAll($req, $res){

            // // Verifica si se pasa el parámetro 'orden' en la URL. Si no se pasa o hay un error de sintaxis, por defecto será 'ASC'.
            $order = isset($req->query->order) ? strtoupper($req->query->order) : 'ASC';

            // // Validar que el valor de $order sea válido (ASC o DESC)
            if ($order !== 'ASC' && $order !== 'DESC'){
                return $this->view->response('El parámetro orden solo puede ser ASC o DESC', 400);
            } 

            // // Llamo al modelo para obtener las plantas con el orden correspondiente
            $plants = $this->model->getPlants($order);
            
            // mando las tareas a la vista
            return $this->view->response($plants);
        }

        public function update($req, $res) {

            if(!$res->user) {
                return $this->view->response("No autorizado", 401);
            }
            
            $id = $req->params->id;

            // verifico que exista
            $plant = $this->model->getPlant($id);
            if (!$plant) {
            return $this->view->response("La planta con el id=$id no existe", 404);
            }

            // valido los datos
            if (empty($req->body->nombre) || empty($req->body->precio) || empty($req->body->id_pedido) || empty($req->body->stock)) {
            return $this->view->response('Faltan completar datos', 400);
            }

            // obtengo los datos
            $nombre = $req->body->nombre;       
            $precio = $req->body->precio;       
            $pedido = $req->body->id_pedido;
            $stock = $req->body->stock;

            // actualiza la tarea
            $this->model->updatePlant($id, $nombre, $precio, $pedido, $stock);

            // obtengo la tarea modificada y la devuelvo en la respuesta
            $plant = $this->model->getPlant($id);
            $this->view->response($plant, 200);
        }

    }
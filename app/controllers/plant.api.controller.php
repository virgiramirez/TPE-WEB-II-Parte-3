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

        public function get($req, $res){
         
            $id = $req->params->id; //Esto viene de la ruta
            
            $plant = $this->model->getPlant($id);

            if(!$plant){
                return $this->view->response("La planta con el id=$id no existe", 404);
            }

            return $this->view->response($plant);

        }
        public function getAll($req, $res) {

            // Validar el parámetro de orden primero
            $order = isset($req->query->order) ? strtoupper($req->query->order) : 'ASC';
            if ($order !== 'ASC' && $order !== 'DESC') {
                return $this->view->response('El parámetro orden solo puede ser ASC o DESC', 400);
            }
        
            $attribute = null;
            $value = null;
            $columns = ['nombre', 'precio', 'id_pedido', 'stock'];
        
            if (isset($req->query->attribute) && isset($req->query->value)) {
                $attribute = $req->query->attribute;
                $value = $req->query->value;
        
                // Verificar que el atributo es válido
                if (!in_array($attribute, $columns)) {
                    return $this->view->response('No existe ese campo en planta', 404);
                }
            }
        
            $plants = $this->model->getPlants($attribute, $value, $order);
        
            return $this->view->response($plants, 200);
        }

        public function create($req, $res) {
            if(!$res->user) {
                return $this->view->response("No autorizado", 401);
            }
    
            $newPlant = $req->body;
            //validacion de datos
            if(empty($newPlant->nombre) || empty($newPlant->precio) || empty($newPlant->id_pedido) || empty($newPlant->stock)){
                return $this->view->response('Faltan completar datos obligatorios', 400);    
            }

            $name = $newPlant->nombre;
            $price = $newPlant->precio;
            $order = $newPlant->id_pedido;
            $stock = $newPlant->stock;
         

            // Validar si id_pedido existe en pedidos
            $order = $this->model->getOrders($newPlant->id_pedido);;
            if (!$order) {
                return $this->view->response("El id_pedido no existe - no se puede asociar a ese pedido", 404);
            }
            $orderId = $newPlant->id_pedido;
            $id = $this->model->insertPlant($name, $price, $orderId, $stock);
            if(!$id){
                return $this->view->response("Error al insertar planta", 500);
            } 

            $plant = $this->model->getPlant($id);
            return $this->view->response($plant, 201);
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
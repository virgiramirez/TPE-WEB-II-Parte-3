<?php  
    class GardenModel{
        private $db; 
        
        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=vivero;charset=utf8', 'root', '');
        }

        public function getPlants($order = null) {
            // Consulta con orden predeterminado por precio ascendente
            $query = $this->db->prepare('SELECT * FROM planta ORDER BY precio ' . $order);
            $query->execute();
        
            // Obtengo los datos en un arreglo de objetos
            $plants = $query->fetchAll(PDO::FETCH_OBJ); 
        
            return $plants;
        }

        public function getPlant($id) {    
            $query = $this->db->prepare('SELECT * FROM planta WHERE id_planta = ?');
            $query->execute([$id]);   
        
            $plant = $query->fetch(PDO::FETCH_OBJ);
        
            return $plant;
        }

        public function updatePlant($id, $nombre, $precio, $pedido, $stock) {
            $query = $this->db->prepare('UPDATE planta SET nombre = ?, precio = ?, id_pedido = ?, stock = ? WHERE id_planta = ?');
            $query->execute([$nombre, $precio, $pedido, $stock, $id]);
        }
    }   
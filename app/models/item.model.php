<?php
    require_once 'model.php';
    require_once 'config.php';
    
    class GardenModel extends Model {

        public function _deploy() {
            $query = $this->db->query('SHOW TABLES LIKE \'planta\'');
            $tables = $query->fetchAll();

            if(count($tables) == 0) {
                $plants = [
                    ['nombre' => 'Calathea', 'precio' => 100, 'stock' => 2],
                    ['nombre' => 'Menta', 'precio' => 50, 'stock' => 1]
                ];
                $sql = <<<SQL
                                CREATE TABLE `planta` (
                            `id_planta` int(11) NOT NULL AUTO_INCREMENT,
                            `nombre` varchar(20) NOT NULL,
                            `precio` int(11) NOT NULL,
                            `id_pedido` int(11) NOT NULL,
                            `stock` int(11) NOT NULL,
                            `imagen` varchar(150) NOT NULL,
                            PRIMARY KEY (`id_planta`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                SQL;
                $this->db->query($sql);

                $insertSql = "INSERT INTO planta (nombre, precio, stock) VALUES (?,?,?)";
            
                $statement = $this->db->prepare($insertSql);
            
                foreach ($plants as $plant){
                    $statement->execute([
                        $plant['nombre'],
                        $plant['precio'],
                        $plant['stock']
                    ]);
                }
        
            }
        }
        
        public function getPlants($attribute = null, $valor = null) {
            $sql = 'SELECT * FROM planta';
            $params = [];
            if($attribute) {
                $sql .= ' WHERE ';
                switch($attribute){
                    case 'nombre':
                        $sql .= 'nombre LIKE :valor';
                        $params[':valor'] = $valor . '%';
                        break;
                    case 'precio':
                    case 'stock':
                    case 'id_pedido':
                        $sql .= "$attribute LIKE :valor";
                        $params[':valor'] = '%' . $valor . '%';
                        break;
                    default:
                    return null;   
                    
                }
            }
            
            // Ejecuto la consulta
            $query = $this->db->prepare($sql);
    
        
            if(!empty($params)) {
                foreach($params as $param => $value) {
                    $query->bindValue($param, $value);
                }
            }
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

        public function insertPlant($name, $price, $orderId, $stock) { 
            $query = $this->db->prepare('INSERT INTO planta (nombre, precio, id_pedido, stock) VALUES (?, ?, ?, ?)');
            $query->execute([$name, $price, $orderId, $stock]);
        
            return $this->db->lastInsertId();
        }

        public function getOrders($id = null) {
            if ($id){
                $query = $this->db->prepare('SELECT * FROM pedidos WHERE id_pedido = ?');
                $query->execute([$id]);
                $orders = $query->fetch(PDO::FETCH_OBJ);
                return $orders;
            } else {
                $query = $this->db->prepare('SELECT * FROM pedidos');
                $query->execute();
                $orders = $query->fetchAll(PDO::FETCH_OBJ);
                return $orders;
            }  
        }
    }   
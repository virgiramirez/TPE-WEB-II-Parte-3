<?php
require_once 'model.php';
require_once 'config.php';
class UserModel extends Model{

    public function _deploy() {
        $query = $this->db->query('SHOW TABLES LIKE \'usuario\'');
        $tables = $query->fetchAll();

        if(count($tables) == 0) {
            $users = [
                ['user' => 'webadmin', 'password' => 'admin']
            ];
            $sql = <<<SQL
                        CREATE TABLE `usuario` (
                        `id` int(11) NOT NULL,
                        `user` varchar(50) NOT NULL,
                        `password` varchar(100) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

            SQL;
        $this->db->query($sql);
        $insertSql = "INSERT INTO usuario ( user, password) values (?,?)";
        $statement = $this->db->prepare($insertSql);
        
        foreach ($users as $user) {
            $statement->execute([
                $user['user'],
                password_hash($user['password'], PASSWORD_DEFAULT)
            ]);
        
        }
    }
}

   
 
    public function getUserByEmail($user) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE user = ?");
        $query->execute([$user]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }

}
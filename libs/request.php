<?php
    class Request {
        public $body = null;	  // {nombre: ‘Saludar’, descripción: ‘Saludar a todos’}
        public $params = null; // /api/tareas/:id
        public $query= null;   // ?soloFinalizadas=true

        public function __construct () { // lee el body 
        try {
            $this->body = json_decode(file_get_contents('php://input')); // file_get_contents lee el body de la request y el json_decode parsea el json y lo devuelve en body. 
        }
        catch (Exception $e) { 
            $this->body = null;
        }
        $this->query = (object) $_GET; // se parsea como objeto al $_GET para poder usarlo así: $this->query->soloFinalizadas
        }
    }

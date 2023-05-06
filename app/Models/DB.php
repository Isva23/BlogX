<?php

    namespace Models;

use mysqli;

    class DB{
        public $db_host;
        public $db_name;
        private $db_user;
        private $db_passwd;

        public $conex;

        //Atributos de control para las consultas

        public $s = " * ";
        public $j = "";
        public $w = " 1 ";
        public $o = "";
        public $l = "";

        public $r; //Resultado de la consulta

        public $table;

        public function __construct($dbh = "localhost", $dbn = "blogx", $dbu = "root", $dbp = ""){
            
            $this->db_host = $dbh;
            $this->db_name = $dbn;
            $this->db_user = $dbu;
            $this->db_passwd = $dbp;
        }
        public function db_connect(){
            $this->conex = new \mysqli($this->db_host, $this->db_user, $this->db_passwd, $this->db_name); //Poner diagonal
            $this->conex->set_charset("utf8");
            if($this->conex->connect_error){
                echo "Fallo la conexión a la base de datos";
            }else{
                return $this->conex;
            }
        }

        public function select($cc = []){
            if(count($cc) > 0){
                $this->s = implode(",", $cc);
            }
            return $this;
        }

        public function join($join = "", $on = ""){
            if($join != "" && $on != ""){
                $this->j = ' join ' . $join . ' on ' . $on;
            }
            return $this;
        }
        public function where($ww = []){
            $this->w = "";
            if(count($ww) > 0){
                foreach($ww as $wheres){
                    $this->w .= $wheres[0] . " like '" . $wheres[1] . "' " . ' and ';
                }
            }
            $this->w .= ' 1 ';
            return $this;
        }
        public function orderBy($ob = []){
            $this->o = "";
            if(count($ob) > 0){
                foreach($ob as $orderBy){
                    $this->o .= $orderBy[0] . ' ' . $orderBy[1] . ',';
                }
                $this->o = ' order by ' . trim($this->o,',');
            }
            return $this;
        }
        public function limit($l = ""){
            $this->l = "";
            if($l != ""){
                $this->l = ' limit ' . $l;
            }
            return $this;
        }
        public function get(){
            $sql = "select " . $this->s . " from " . str_replace("Models\\","",get_class($this)) . 
            ($this->j != "" ? " a " . $this->j : "") . " where " . $this->w . $this->o . $this->l;
            $this->r = $this->table->query($sql);
            $result = [];
            while ( $f = $this->r->fetch_assoc()){
                $result[] = $f;
            }
            return json_encode($result);
        }
        public function create(){
            $sql = 'insert into ' . str_replace("Models\\","",get_class($this)) . '(' . implode(",", $this->campos ) . ') values (' . trim(str_replace("&", "?,",str_pad("",count($this->campos),"&")),",") . ');';
            $stmt = $this->table->prepare($sql);
            $stmt->bind_param(str_pad("",count($this->campos),"s"),...$this->valores);
            return $stmt->execute();
        }
        public function delete($id){         
            $sql = 'delete from ' . str_replace("Models\\","",get_class($this)). ' where id = ?';
            $stmt = $this->conex->prepare($sql);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        public function update(){
            $sql = 'update into ' . str_replace("Models\\","",get_class($this)) . '(' . implode(",", $this->campos ) . ') values (' . trim(str_replace("&", "?,",str_pad("",count($this->campos),"&")),",") . ');';
            $stmt = $this->table->prepare($sql);
            $stmt->bind_param(str_pad("",count($this->campos),"s"),...$this->valores);
            return $stmt->execute();

        }
    }

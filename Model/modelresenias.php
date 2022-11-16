<?php


class Modelresenias{
    private $db;


    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tp;charset=utf8', 'root', '');
    }


    public function getAll(){
        $resenias= $this->db->prepare("SELECT resenias.*,consultas.motivo FROM resenias JOIN consultas ON resenias.consulta_id=consultas.id_consulta ");
        $resenias->execute();
        return $resenias->fetchall(PDO::FETCH_OBJ);
        
    }

    public function getOrdenado ($sort, $order){
        
        $resenias = $this->db->prepare("SELECT * FROM resenias ORDER BY $sort $order");
        $resenias->execute();
        return $resenias->fetchAll(PDO::FETCH_OBJ);

    }
     
    public function getPaginacion($page, $limit){
        $offSet = ($limit * $page) - $limit;
        $resenia= $this->db->prepare("SELECT* FROM resenias LIMIT $limit OFFSET $offSet");
        $resenia->execute();
        return $resenia->fetchAll(PDO::FETCH_OBJ);
         
    }
    
    public function getFiltrado($filter, $value){
        $resenia= $this->db->prepare("SELECT* FROM resenias WHERE $filter=?");
        $resenia->execute(array ($value));
       return $resenia->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    public function get($id){
        $resenia= $this->db->prepare("SELECT resenias.*,consultas.motivo FROM resenias JOIN consultas ON resenias.consulta_id=consultas.id_consulta WHERE id_resenia=?" );
        $resenia->execute(array($id));
        return $resenia->fetchAll(PDO::FETCH_OBJ);
        
    }

   function delete($id){
        $resenia= $this->db->prepare("DELETE FROM resenias  WHERE (id_resenia=?)");
        $resenia->execute(array($id));
    }
    
    function insertar($consulta, $comentario, $mascota,$puntuacion){
        $resenia= $this->db->prepare("INSERT INTO resenias (consulta_id, comentario, mascota,puntuacion) VALUES (?,?,?,?)");
        $resenia->execute(array($consulta, $comentario, $mascota, $puntuacion));
        return $this->db->lastInsertId();
    }
    
   function editar($id,$consulta, $comentario, $mascota,$puntuacion){
        $resenia= $this->db->prepare("UPDATE resenias  SET consulta_id=?, comentario=?,mascota=? puntuacion=? WHERE id_resenia=?");
        $resenia->execute(array($consulta, $comentario, $mascota,$puntuacion,$id));
    }
    
        
}


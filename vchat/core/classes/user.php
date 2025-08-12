<?php

namespace MyApp;
use PDO;

class User{
    public $db, $id_utilisateur, $sessionID;

    public function  __construct(){
        $db = new  \MyApp\DB;
        $this->db = $db->connect();
        $this->id_utilisateur= $this->ID();

        $this->sessionID= $this->getSessionID();
    }
    public function ID(){
        if($this->isLoggedIn()){
            return $_SESSION['id_utilisateur'];
        }
    }
    public function getSessionID(){
        return session_id();
    }

      
        public function redirect($location){
            header("location: ".BASE_URL.$location);
        }
     
        public function userData($id_utilisateur= ''){
            $id_utilisateur = ((!empty($id_utilisateur))? $id_utilisateur : $this->id_utilisateur);
            $stmt = $this->db->prepare("SELECT * FROM `utilisateurs` where `id_utilisateur` = :id_utilisateur");
            $stmt->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_STR);
            $stmt->execute();
        
            return  $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function isLoggedIn(){
            return ((isset($_SESSION['id_utilisateur'])) ? true : false);
        }

        public function logout(){
           $_SESSION =array();
           session_destroy();
           session_regenerate_id();
           $this->redirect('../index.php');
        }

        public function getUsers(){
            $stmt = $this->db->prepare("SELECT * FROM `utilisateurs` where `id_utilisateur` != :id_utilisateur");
            $stmt->bindParam(":id_utilisateur", $this->id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();
            $users=$stmt->fetchAll(PDO::FETCH_OBJ);
        
            foreach($users as $u){
        echo'
        <div class="member__wrapper" id="member__2__wrapper">
            <span class="green__icon"></span>
            <p class="member_name" > <a href=" '.BASE_URL.$u->pseudo.' " style="text-decoration: none; color:#fff;"> '.$u->nom.' '.$u->pseudo.'</a>👋:</p>
        </div>
        ';
            }

        }

        public function getUserByUsername($pseudo){

            $stmt = $this->db->prepare("SELECT * FROM `utilisateurs` where `pseudo` = :pseudo");
            $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
            $stmt->execute();
        
            return  $stmt->fetch(PDO::FETCH_OBJ);
        }
        
        public function updateSession(){
            $stmt = $this->db->prepare(" UPDATE  `utilisateurs` SET `sessionID` = :sessionID where `id_utilisateur`= :id_utilisateur");
            $stmt->bindParam(":sessionID", $this->sessionID, PDO::PARAM_STR);
            $stmt->bindParam(":id_utilisateur", $this->id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();
        }


        public function getUserBySession($sessionID){
            $stmt = $this->db->prepare("SELECT * FROM `utilisateurs` where `sessionID` = :sessionID");
            $stmt->bindParam(":sessionID", $sessionID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function updateConnection($connectionID, $id_utilisateur){
            $stmt = $this->db->prepare(" UPDATE  `utilisateurs` SET `connectionID` = :connectionID where `id_utilisateur`= :id_utilisateur");
            $stmt->bindParam(":connectionID", $connectionID, PDO::PARAM_STR);
            $stmt->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();
        }

    }

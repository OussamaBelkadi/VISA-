<?php
class User extends DataBase
{
    // Connectio  with Database
    private PDO $connection;
     public function __construct(){
        $this->connection = $this->connect();
     }

     // function to Select All User in database
    public function getAll(): array
    {
        $sql="SELECT * From user";
        $stmt= $this->connection->query($sql);
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          
            $data[] = $row;
        }
        return $data;
    }
    //Select User identifier par un "ID"
    public function selectUser($id){
        $sql="SELECT * FROM `user` WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    // Function  to create new User
    public function insertUser(array $data) : string{
        $sql = "INSERT INTO `user` (`nom`, `prenom`, `naissance`, `nationalite`, `situation`, `adresse`, `visa`, `ddepart`, `ddarriver`, `typedv`, `numdv`) VALUES (:nom, :prenom, :naissance, :natio, :situa, :adres, :visa, :ddepart, :ddarriver, :typedv, :numdv)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':naissance', $data['naissance']);
        $stmt->bindParam(':natio', $data['natio']);
        $stmt->bindParam(':situa', $data['situa']);
        $stmt->bindParam(':adres', $data['adres']);
        $stmt->bindParam(':visa', $data['visa']);
        $stmt->bindParam(':ddepart', $data['ddepart']);
        $stmt->bindParam(':ddarriver', $data['ddarriver']);
        $stmt->bindParam(':typedv', $data['typedv']);
        $stmt->bindParam(':numdv', $data['numdv']);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }




    // public function updateUser(array $data, array $user) : int{
    //          $sql = "UPDATE `user` SET `nom`=:nom,`prenom`=:prenom WHERE id=:id";
    //             $stmt = $this->connection->prepare($sql); 
    //             $stmt->bindValue(':nom', $data['nom']);
    //             $stmt->bindValue(':prenom', $data['prenom']);
    //             $stmt->bindValue(':id', $user['id']);
    //             $stmt->execute();
    //             return $stmt->rowCount();
    // }
    
  // function to UpdateUser information
      public function updateUser(array $data, array $user ) : int{
         $sql = "UPDATE `user` SET `nom`=:nom,`prenom`=:prenom,`naissance`=:naissance,`nationalite`=:natio,`situation`=:situa,`adresse`=:adres,`visa`=:visa,`ddepart`=:ddepart,`ddarriver`=:ddarriver,`typedv`=:typedv,`numdv`=:numdv WHERE id=:id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nom", $data['nom']);
            $stmt->bindValue(':prenom', $data['prenom']);
            $stmt->bindValue(':naissance', $data['naissance']);
            $stmt->bindValue(':natio', $data['nationalite']);
            $stmt->bindValue(':situa', $data['situation']);
            $stmt->bindValue(':adres', $data['adresse']);
            $stmt->bindValue(':visa', $data['visa']);
            $stmt->bindValue(':ddepart', $data['ddepart'] );
            $stmt->bindValue(':ddarriver', $data['ddarriver']);
            $stmt->bindValue(':typedv', $data['typedv'] );
            $stmt->bindValue(':numdv', $data['numdv']);
            $stmt->bindValue("id", $user['id']);
           $stmt->execute();
           return $stmt->rowCount();
        }
          //function DELETE user Form table User
    public function delete($id){
        $sql='DELETE FROM `user` WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
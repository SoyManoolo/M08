<?php

class LinkController {

    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    public function getLinks() {

        try  {
       
            $sql = "SELECT * 
                    FROM link
                    WHERE 1";
        
            $statement = $this->connection->prepare($sql);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $statement->execute();

            $result = $statement->fetchAll();

            return $result;

          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
    }

    public function getLink($token) {

        try  {
       
            $sql = "SELECT * 
                    FROM link
                    WHERE token = :token";
        
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':token', $token);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $statement->execute();

            $result = $statement->fetch();
            return $result;

          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
    }

    public function exist($token) {

        try  {
       
            $sql = "SELECT * 
                    FROM link
                    WHERE token = :token";
        
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':token', $token);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $statement->execute();

            $result = $statement->fetch();
            return !$result ? false : true;

          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
    }

    private function generateHash($size) {
        $alphabet = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $max = sizeof($alphabet) - 1;
        $word = "";
        $letter = "";
        for ($i = 0; $i < $size; $i++) {
            $letter = $alphabet[rand(0, $max)];
            $word .= $letter;
        }
    
        return $word;
    }

    public function numberOfUsages($token) {

        try  {
       
            $sql = "SELECT * 
                    FROM link
                    WHERE token = :token";
        
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':token', $token);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $statement->execute();

            $result = $statement->fetch();

            if ($result) {
                return $result->usages;
            } else {
                return false;
            }

          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
    }

    public function addUsage($token) {
      if ($link = $this->getLink($token)) {
        try  {
       
            $sql = "UPDATE link
                    SET usages = :usages
                    WHERE token = :token";                                        
        
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':token', $token);
            $statement->bindValue(':usages', $link->usages + 1);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $statement->execute();

            return true;

          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
      } else {
        return false;
      } 
    }

    public static function createLink() {
        $newHash = (new self)->generateHash(32);

        if ((new self)->exist($newHash)) {
            return createLink();
        } else {
            try  {
       
                $sql = "INSERT INTO link
                        (token, usages) VALUES
                        (:token, :usages)";
            
                $statement = (new self)->connection->prepare($sql);
                $statement->bindValue(':token', $newHash);
                $statement->bindValue(':usages', 0);
                $statement->setFetchMode(PDO::FETCH_OBJ);
                $statement->execute();
    
                return $newHash;
    
              } catch(PDOException $error) {
                  echo $sql . "<br>" . $error->getMessage();
                  return null;
              }
        }
    }
}



/*

    getLinks(): Devuelve todos los links del sistema.
    getLink($token): Devuelve el link que coincide con el $token y en caso de no existir devuelve null.
    exist($token): Devuelve true si el link existe en la Base de Datos, false en caso contrario.
    generateHash($token): Devuelve una hash de tamaño $size.
    numberOfUsages($token): Devuelve el número de usos del $link o null en caso de que el $link no exista.
    addUsage($token): Suma 1 a los usages del $link, devuelve true si todo ha ido bien, o false si se ha producido un error (o el $link no existe).
    createLink(): Crea un nuevo link en la base de datos y devuelve la hash creada o null en caso de que haya habido algún fallo.


*/
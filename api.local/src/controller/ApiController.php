<?php

class ApiController {

    const OBJECT = 1;
    const JSON = 2;

    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    public static function getLinks($mode = self::OBJECT) {
        try {
            $sql = "SELECT * FROM User WHERE 1";
            $statement = (new self)->connection->prepare($sql);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();

            $result = $statement->fetchAll();

            if ($mode == self::OBJECT) {
                return $result;
            } else if ($mode == self::JSON) {
                return json_encode($result, JSON_PRETTY_PRINT);
            }
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
}

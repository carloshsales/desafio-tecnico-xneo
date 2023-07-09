<?php
abstract class ConnectDataBase
{
    public static function connect()
    {
        try {
            $connect = new \PDO(
                'mysql:
                host=localhost;
                dbname=xneo;
                charsert=utf8',
                "root",
                ""
            );
            return $connect;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
?>
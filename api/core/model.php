<?php
require dirname(__DIR__) . '/db/connectDataBase.php';
class Model
{
    private $db;

    public function __construct()
    {
        $this->db = ConnectDataBase::connect();

    }

    public function getAll()
    {
        $query = $this->db->prepare("SELECT * FROM todo");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM todo WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();

        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($description)
    {
        $query = $this->db->prepare("INSERT INTO todo (description) VALUES (:description)");
        $query->bindValue(":description", $description['description']);
        $query->execute();

        if (!$query) {
            throw new \PDOException('Insert query failed');
        }
        return $query;
    }

    public function update($id, $description)
    {
        $query = $this->db->prepare("UPDATE todo SET description = :description WHERE id = :id");
        $query->bindValue(":id", $id);
        $query->bindValue(":description", $description);
        $query->execute();

        if (!$query) {
            throw new \PDOException('Update query failed');
        }
        return $query;
    }

    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM todo WHERE id = :id");
        $query->bindValue(":id", $id);
        return $query->execute();
    }

    public function checking($id, $check)
    {
        $query = $this->db->prepare("UPDATE todo SET checked = :check WHERE id = :id");
        $query->bindValue(":id", $id);
        $query->bindValue(":check", $check);
        return $query->execute();
    }
}
?>
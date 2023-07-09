<?php
require dirname(__DIR__) . '/core/model.php';
class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        try {
            $this->model->getAll();

            ob_start();
            include_once '../public/index.html';
            $htmlContent = ob_get_clean();

            header('Content-Type: text/html; charset=UTF-8');
            echo $htmlContent;
        } catch (\PDOException $e) {
            $errorMessage = $e->getMessage();
            echo "<script>alert($errorMessage)</script>";
        }
    }

    public function getAll()
    {
        try {
            $data = $this->model->getAll();
            echo json_encode($data);
        } catch (\PDOException $e) {
            $errorMessage = $e->getMessage();
            echo "<script>alert($errorMessage)</script>";
        }
    }

    public function create()
    {
        try {
            $this->model->create($_POST);
            header('Location: /index');
        } catch (\PDOException $e) {
            $errorMessage = $e->getMessage();
            echo "<script>alert($errorMessage)</script>";
        }
    }

    public function update()
    {
        try {
            $this->model->update($_GET['id'], $_POST['description']);
        } catch (\PDOException $e) {
            $errorMessage = $e->getMessage();
            echo "<script>alert($errorMessage)</script>";
        }
    }

    public function delete()
    {
        try {
            $this->model->delete($_GET['id']);
            header('Location: /index');
            exit();
        } catch (\PDOException $e) {
            $errorMessage = $e->getMessage();
            echo "<script>alert($errorMessage)</script>";
        }
    }

    public function check()
    {
        try {
            $this->model->checking($_GET['id'], $_POST['checked']);
        } catch (\PDOException $e) {
            $errorMessage = $e->getMessage();
            echo "<script>alert($errorMessage) = id=" . $_GET['id'] . " - POST=" . $_POST['checked'] . " </script>";
        }
    }
}
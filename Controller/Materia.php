<?php
class Materia extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();
    }
    public function Materia()
    {
        $data = $this->model->selectMateria();
        $this->views->getView($this, "listar", $data);
    }
    public function registrar()
    {
        $Materia = $_POST['nombre'];
        $insert = $this->model->insertarMateria($Materia);
        if ($insert) {
            header("location: " . base_url() . "Materia");
            die();    
        }
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editMateria($id);
        if ($data == 0) {
            $this->Materia();
        } else {
            $this->views->getView($this, "editar", $data);
        }
    }
    public function modificar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $actualizar = $this->model->actualizarMateria($nombre, $id);
        if ($actualizar) {   
            header("location: " . base_url() . "Materia");
            die();
        }
    }
    public function eliminar()
    {
        $id = $_POST['id'];
        $this->model->estadoMateria(0, $id);
        header("location: " . base_url() . "Materia");
        die();
    }
    public function reingresar()
    {
        $id = $_POST['id'];
        $this->model->estadoMateria(1, $id);
        header("location: " . base_url() . "Materia");
        die();
    }
}
?>
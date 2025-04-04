<?php
namespace App\Controllers;
use App\Models\SolicitudModel;
use App\Models\ClienteModel;
use App\Models\ServicioModel;
use App\Models\EstadoModel;

require_once "baseController.php";
require_once MAIN_APP_ROUTE."../models/SolicitudModel.php";
require_once MAIN_APP_ROUTE."../models/ClienteModel.php";
require_once MAIN_APP_ROUTE."../models/ServicioModel.php";
require_once MAIN_APP_ROUTE."../models/EstadoModel.php";

class SolicitudController extends BaseController{
    public function __construct(){
        // Se define la plantilla para este controlador
        $this->layout = "admin_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function index(){
        echo "<br>CONTROLLER> SolicitudController";
        echo "<br>ACTION> index";
    }

    public function view(){
        $solicitudObj = new SolicitudModel();
        $solicitudes = $solicitudObj->getAll();
        
        $clienteObj = new ClienteModel();
        $clientes = $clienteObj->getAll();
        
        $servicioObj = new ServicioModel();
        $servicios = $servicioObj->getAll();
        
        $estadoObj = new EstadoModel();
        $estados = $estadoObj->getAll();
        
        $data = [
            "solicitudes" => $solicitudes,
            "clientes" => $clientes,
            "servicios" => $servicios,
            "estados" => $estados
        ];
        
        $this->render('solicitud/view.php', $data);
    }

    public function newSolicitud(){
        $clienteObj = new ClienteModel();
        $clientes = $clienteObj->getAll();

        $servicioObj = new ServicioModel();
        $servicios = $servicioObj->getAll();

        $estadoObj = new EstadoModel();
        $estados = $estadoObj->getAll();

        $data = [
            "clientes" => $clientes,
            "servicios" => $servicios,
            "estados" => $estados,
            "titulo" => "Nueva solicitud"
        ];
        $this->render('solicitud/new.php', $data);
    }

    public function createSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Primero creamos el cliente si no existe
            $clienteObj = new ClienteModel();
            $documento = $_POST['documento'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];

            // Verificar si el cliente existe o crear uno nuevo
            $cliente = $clienteObj->getClienteByDocumento($documento);
            if (!$cliente) {
                $idCliente = $clienteObj->saveCliente($documento, $nombre, $correo, $telefono);
            } else {
                $idCliente = $cliente->idCliente;
            }

            // Datos de la solicitud
            $descripcion = $_POST['descripcion'];
            $fechaEvento = $_POST['fecha_evento'];
            $tipoServicio = $_POST['servicio'];
            $estado = $_POST['estado']; // Viene como 3 (Pendiente) por defecto
            
            $solicitudObj = new SolicitudModel();
            try {
                $solicitudObj->saveSolicitud(
                    $descripcion,
                    $fechaEvento,
                    $idCliente,
                    $tipoServicio,
                    $estado
                );
                $this->redirectTo("solicitud/view");
            } catch (\PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function viewSolicitud($id){
        $solicitudObj = new SolicitudModel();
        $solicitudInfo = $solicitudObj->getSolicitud($id);
        $data = [
            "solicitud" => $solicitudInfo,
            "titulo" => "Ver solicitud #" . $id
        ];
        $this->render("solicitud/viewOne.php", $data);
    }

    public function editSolicitud($id){
        $solicitudObj = new SolicitudModel();
        $solicitudInfo = $solicitudObj->getSolicitud($id);

        $clienteObj = new ClienteModel();
        $clientes = $clienteObj->getAll();

        $servicioObj = new ServicioModel();
        $servicios = $servicioObj->getAll();

        $estadoObj = new EstadoModel();
        $estados = $estadoObj->getAll();

        $data = [
            "solicitud" => $solicitudInfo,
            "clientes" => $clientes,
            "servicios" => $servicios,
            "estados" => $estados,
            "titulo" => "Editar solicitud"
        ];
        $this->render("solicitud/edit.php", $data);
    }

    public function updateSolicitud(){
        if (isset($_POST["Descripcion"])) {
            $id = $_POST["idSolicitud"] ?? null;
            $descripcion = $_POST["Descripcion"] ?? null;
            $fechaSolicitud = $_POST["FechaSolicitud"] ?? null;
            $idCliente = $_POST["IdCliente"] ?? null;
            $idServicio = $_POST["IdServicio"] ?? null;
            $idEstado = $_POST["IdEstado"] ?? null;
            
            $solicitudObj = new SolicitudModel();
            $solicitudObj->editSolicitud($id, $descripcion, $fechaSolicitud, $idCliente, $idServicio, $idEstado);
        }
        $this->redirectTo("solicitud/view");
    }

    public function deleteSolicitud($id){
        $solicitudObj = new SolicitudModel();
        $solicitudObj->deleteSolicitud($id);
        $this->redirectTo("solicitud/view");
    }
}
?>

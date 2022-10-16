<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router){
        if (!isset($_SESSION)) {
            session_start();
        }

        isAdmin();

        // $fecha = date('Y-m-d', strtotime('+1 day'));
        $fecha = $_GET['fecha'] ?? date('Y-m-d', strtotime('-1 day'));
        $fechaArgs = explode('-', $fecha);

        if(!checkdate($fechaArgs[1], $fechaArgs[2], $fechaArgs[0])){
            header('location: /404');
        }

        /* Consultar la base de daots */
        $consulta = "SELECT c.id, c.hora, CONCAT(u.nombre, ' ', u.apellido) AS cliente, u.email, u.telefono, s.nombre AS servicio, s.precio ";
        $consulta .= "FROM citas c, usuarios u, citasservicios cs, servicios s ";
        $consulta .= "WHERE c.usuarioId=u.id AND cs.citaId=c.id AND cs.servicioId=s.id ";
        $consulta .= "AND fecha = '${fecha}'";

        $cita = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $cita,
            'fecha' => $fecha
        ]);
    }

    public static function error(Router $router){
        $router->render('admin/404', []);
    }
}
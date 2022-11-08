<?php
//Creamos una funcion para cuando el usuario no este autenticado, hace el redirect al login
function usuario_autenticado() {
    if(!revisar_usuario() && $_GET["controller"] != 'Login') {
        header('Location:index.php?controller=Login&action=index');
        exit();
    }
}
// Esta funcion revisa que exista la variable de session email, si existe quiere decir que el usuario se autentico con exito
function revisar_usuario() {
    return isset($_SESSION['email']);
}
//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();
usuario_autenticado();

if (isset($_GET['exit'])) {
    $exit = $_GET['exit'];
    if ($exit) {
        session_destroy();
        header('Location:index.php?controller=Login&action=index');
    }
}
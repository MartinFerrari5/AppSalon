<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    
    return $s;
}
function login(){
    session_start();
    $auth=$_SESSION;
    return $auth;
}
// OTRA FUNCION DE AUTENTICACION 
function isAuth(){
    session_start();
  
    if(!isset($_SESSION['login'])){
        header('Location: /public');
    }
}
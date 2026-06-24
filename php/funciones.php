<?php

// Función para validar si un email es válido
function esEmailValido($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Función para escapar caracteres especiales
function escaparTexto($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// Función para validar teléfono
function esValidoTelefono($telefono) {
    return preg_match('/^[0-9\s\+\-\(\)]{7,}$/', $telefono);
}

?>

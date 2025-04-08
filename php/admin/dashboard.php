<?php
session_start();
echo "¡Hola admin " . $_SESSION['nombre'] . "! Has iniciado sesión correctamente.";

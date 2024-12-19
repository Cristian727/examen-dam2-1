<?php
// Mostrar un mensaje de Hola Mundo
echo "<h1>Hola Mundo desde PHP!</h1>";

// Mostrar la fecha y hora actual
echo "<p>Fecha y hora actual: " . date('Y-m-d H:i:s') . "</p>";

// Mostrar la versión de PHP
echo "<p>Versión de PHP: " . phpversion() . "</p>";

// Mostrar la versión de Apache
echo "<p>Versión de Apache: " . apache_get_version() . "</p>";

// Mostrar la IP del servidor
echo "<p>IP del servidor: " . getHostByName(getHostName()) . "</p>";

// Mostrar la IP del cliente
echo "<p>IP del cliente: " . $_SERVER['REMOTE_ADDR'] . "</p>";
?>

<?php
$servername = "mysql";
$username = "root";
$password = "example";
$dbname = "my_database";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}

// Cerrar la conexión
$conn->close();
?>

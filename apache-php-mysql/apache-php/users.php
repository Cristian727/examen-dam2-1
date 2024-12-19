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
}

// Consulta a la base de datos
$sql = "SELECT id, name, password FROM users";
$result = $conn->query($sql);

// Mostrar los resultados
if ($result->num_rows > 0) {
    // Salida de cada fila
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nombre: " . $row["name"]. " - Contraseña: " . $row["password"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Cerrar la conexión
$conn->close();
?>

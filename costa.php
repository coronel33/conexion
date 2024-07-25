<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la tabla si no existe
$sql_create_costa = "CREATE TABLE IF NOT EXISTS costa (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ingredientes TEXT NOT NULL,
    pasos TEXT NOT NULL,
    tiempo_coccion INT(6) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_table) === FALSE) {
    die("Error al crear la tabla: " . $conn->error);
}

// Obtener datos enviados por POST
$recipe_name = $_POST['recipe_name'];
$ingredients = $_POST['ingredients'];
$steps = $_POST['steps'];
$cooking_time = $_POST['cooking_time'];

// Insertar datos en la base de datos
$sql = "INSERT INTO recetas (nombre, ingredientes, pasos, tiempo_coccion) VALUES ('$recipe_name', '$ingredients', '$steps', '$cooking_time')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva receta registrada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

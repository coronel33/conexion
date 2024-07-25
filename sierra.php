<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la tabla si no existe
$sql_create_sierra = "CREATE TABLE IF NOT EXISTS sierra (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ingredientes TEXT NOT NULL,
    pasos TEXT NOT NULL,
    tiempo_coccion INT(6) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql_create_sierra) === FALSE) {
    die("Error al crear la tabla: " . $conn->error);
}

// Obtener datos enviados por POST
if (isset($_POST['recipe_name'], $_POST['ingredients'], $_POST['steps'], $_POST['cooking_time'])) {
    $recipe_name = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $steps = $_POST['steps'];
    $cooking_time = $_POST['cooking_time'];

    // Usar consultas preparadas para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO sierra (nombre, ingredientes, pasos, tiempo_coccion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $recipe_name, $ingredients, $steps, $cooking_time);

    if ($stmt->execute() === TRUE) {
        echo "Nueva receta registrada exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Todos los campos son obligatorios.";
}

$conn->close();
?>

<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

// Crear la tabla 'users' si no existe
$sql_create_table = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Tabla 'users' verificada o creada exitosamente.";
} else {
    echo "Error al verificar o crear la tabla 'users': " . $conn->error;
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña

    $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES ('$first_name', '$last_name', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "failure";
    }
}

$conn->close();
?>

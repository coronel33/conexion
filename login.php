<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

// Procesar el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            echo "success";
        } else {
            echo "failure";
        }
    } else {
        echo "failure";
    }

    $stmt->close();
}

$conn->close();
?>

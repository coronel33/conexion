<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña

    // Verificar si el nombre de usuario ya está registrado
    $sql_check_username = "SELECT * FROM users WHERE username = '$username'";
    $result_username = $conn->query($sql_check_username);

    if ($result_username->num_rows > 0) {
        echo "username_exists";
        exit();
    }

    // Verificar si el correo electrónico ya está registrado
    $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
    $result_email = $conn->query($sql_check_email);

    if ($result_email->num_rows > 0) {
        echo "email_exists";
        exit();
    }

    // Insertar nuevo usuario
    $sql_insert = "INSERT INTO users (first_name, last_name, email, username, password) VALUES ('$first_name', '$last_name', '$email', '$username', '$password')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "success";
    } else {
        echo "failure";
    }
}

$conn->close();
?>

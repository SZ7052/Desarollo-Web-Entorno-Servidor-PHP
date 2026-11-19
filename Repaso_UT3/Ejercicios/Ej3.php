<?php
declare(strict_types=1);
/*Nivel 3: Difícil - Reserva de Vuelo (Flujo completo, Validación y Persistencia)

Misión: Un formulario en la misma página que procesa la compra de un billete. Pide: Nombre, Email, Destino
(un <select>) y un checkbox de "Llevar maleta extra".

Lógica:

El email debe validarse con filter_input.

El destino debe comprobarse contra un array de destinos permitidos usando in_array.

Acumula los errores en un array $errores.

Requisitos: Si hay errores, muéstralos en una lista y haz que el formulario recuerde el nombre, el email
y el destino que el usuario había elegido (persistencia).
Si todo está perfecto, oculta el formulario y muestra un ticket de confirmación.*/



// Definimos los destinos permitidos según la lógica de negocio
$destinosPermitidos = ["madrid", "paris", "londres", "tokyo", "nueva_york"];

// Inicializamos variables para el formulario y la persistencia
$nombre = "";
$email = "";
$destinoSeleccionado = "";
$maletaExtra = false;
$errores = [];
$enviadoConExito = false;

// Comprobamos si la petición es POST (cuando el usuario envía el formulario)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Recuperar y normalizar los datos de entrada
    $nombre = trim($_POST["nombre"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $destinoSeleccionado = trim($_POST["destino"] ?? "");

    // Los checkboxes solo envían valor si están marcados (usamos isset)
    $maletaExtra = isset($_POST["maleta_extra"]);

    // 2. Validaciones en el servidor (independientemente del HTML)

    // Validar nombre (obligatorio y longitud mínima)
    if ($nombre === "") {
        $errores[] = "El nombre es obligatorio.";
    } elseif (mb_strlen($nombre) < 2) {
        $errores[] = "El nombre debe tener al menos 2 caracteres.";
    }

    // Validar email utilizando filter_input tal como exige el manual
    $emailFiltrado = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if ($email === "") {
        $errores[] = "El email es obligatorio.";
    } elseif ($emailFiltrado === false || $emailFiltrado === null) {
        $errores[] = "El formato del email no es válido.";
    }

    // Validar destino contra el array permitido usando in_array con comparación estricta (true)
    if ($destinoSeleccionado === "") {
        $errores[] = "Debe seleccionar un destino.";
    } elseif (!in_array($destinoSeleccionado, $destinosPermitidos, true)) {
        $errores[] = "El destino seleccionado no es válido.";
    }

    // 3. Decidir si se procesa o se devuelven los errores
    if (empty($errores)) {
        $enviadoConExito = true;
    }
}

/**
 * Función auxiliar para escapar la salida y evitar ataques XSS
 */
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Vuelo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { max-width: 500px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        .error { color: #d9534f; background: #f2dede; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .success { color: #3c763d; background: #dff0d8; padding: 15px; border-radius: 4px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #0275d8; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #025aa5; }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistema de Reserva de Vuelos</h2>

    <?php if ($enviadoConExito): ?>
        <!-- Si todo está perfecto, ocultamos el formulario y mostramos el ticket de confirmación -->
        <div class="success">
            <h3>¡Reserva completada con éxito!</h3>
            <p><strong>Nombre:</strong> <?= e($nombre) ?></p>
            <p><strong>Email:</strong> <?= e($email) ?></p>
            <p><strong>Destino:</strong> <?= e(ucstr_replace("_", " ", $destinoSeleccionado)) // o simplemente mostrar el texto ?></p>
            <p><strong>Maleta extra:</strong> <?= $maletaExtra ? "Sí" : "No" ?></p>
        </div>
    <?php else: ?>

        <!-- Si hay errores, los mostramos en una lista -->
        <?php if (!empty($errores)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulario con persistencia de datos mediante el atributo value y selected -->
        <form method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= e($nombre) ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= e($email) ?>">
            </div>

            <div class="form-group">
                <label for="destino">Destino:</label>
                <select id="destino" name="destino">
                    <option value="">-- Seleccione un destino --</option>
                    <option value="madrid" <?= $destinoSeleccionado === "madrid" ? "selected" : "" ?>>Madrid</option>
                    <option value="paris" <?= $destinoSeleccionado === "paris" ? "selected" : "" ?>>París</option>
                    <option value="londres" <?= $destinoSeleccionado === "londres" ? "selected" : "" ?>>Londres</option>
                    <option value="tokyo" <?= $destinoSeleccionado === "tokyo" ? "selected" : "" ?>>Tokio</option>
                    <option value="nueva_york" <?= $destinoSeleccionado === "nueva_york" ? "selected" : "" ?>>Nueva York</option>
                </select>
            </div>

            <div class="form-group">
                <label>
                    <!-- Persistencia del checkbox usando el operador ternario -->
                    <input type="checkbox" name="maleta_extra" value="1" <?= $maletaExtra ? "checked" : "" ?>>
                    Llevar maleta extra
                </label>
            </div>

            <button type="submit">Confirmar Reserva</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
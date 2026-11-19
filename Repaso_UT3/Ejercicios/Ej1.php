<?php
declare(strict_types=1);
/*Nivel 1: Fácil - El Portero de Discoteca (Formulario Básico y Condicionales)

Misión: Crea un archivo PHP con un formulario que pida dos datos por POST: Nombre y Edad.

Lógica: Al enviar el formulario, el PHP debe recoger los datos.
 Si la edad es 18 o mayor, debe imprimir un mensaje verde: "Bienvenido, [Nombre]".
Si es menor, un mensaje rojo: "Lo siento, debes ser mayor de edad".

Requisitos: Usa $_SERVER["REQUEST_METHOD"] para detectar el envío,
trim() para el nombre y asegúrate de escapar el nombre al imprimirlo.*/


// Definición de funciones de validación (Una responsabilidad por función - Bloque 8)
function validarNombre(string $nombre): ?string {
    if ($nombre === "") {
        return "El nombre no puede estar vacío.";
    }
    if (mb_strlen($nombre) < 2) {
        return "El nombre es demasiado corto.";
    }
    return null; // Si todo va bien, devuelve null
}

function validarEdad(string $edadInput): ?string {
    // Validar con filter_input como exige el manual (Bloque 6 y 7)
    $edadFiltrada = filter_input(INPUT_POST, "edad", FILTER_VALIDATE_INT);

    if ($edadInput === "") {
        return "La edad es obligatoria.";
    }
    if ($edadFiltrada === false || $edadFiltrada === null) {
        return "La edad debe ser un número entero válido.";
    }
    if ($edadFiltrada < 18) {
        return "Lo siento, debes ser mayor de edad.";
    }
    return null;
}

/**
 * Función auxiliar para escapar la salida HTML y prevenir XSS (Bloque 6)
 */
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

// Inicialización de variables
$nombre = "";
$edad = "";
$errores = [];
$estaperfecto = false;

// Detección de envío de formulario por POST (Bloque 5)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Recuperar y normalizar datos (Bloque 6)
    $nombre = trim($_POST["nombre"] ?? "");
    $edad = trim($_POST["edad"] ?? "");

    // 2. Aplicar funciones de validación y acumular errores (Bloque 6 y 8)
    $errorNombre = validarNombre($nombre);
    if ($errorNombre !== null) {
        $errores[] = $errorNombre;
    }

    $errorEdad = validarEdad($edad);
    if ($errorEdad !== null) {
        $errores[] = $errorEdad;
    }

    // 3. Decidir si todo está perfecto
    if (empty($errores)) {
        $estaperfecto = true;
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>El Portero de Discoteca</title>
</head>
<body>

    <?php if ($estaperfecto): ?>
        <!-- Si todo está perfecto, ocultamos el formulario y mostramos el mensaje verde -->
        <div>
            <p style="color: green; font-weight: bold;">Bienvenido, <?= e($nombre) ?></p>
        </div>
    <?php else: ?>

        <!-- Si hay errores, los mostramos en una lista (Bloque 6) -->
        <?php if (!empty($errores)): ?>
            <div style="color: red;">
                <h3>Errores:</h3>
                <ul>
                    <?php foreach ($errores as $e): ?>
                        <li><?= e($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulario con persistencia de datos y escape de seguridad (Bloque 6 y 7) -->
        <form method="post">
            <div>
                <label for="nombre">Nombre</label>
                <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="<?= e($nombre) ?>"
                        required>
            </div>
            <div>
                <label for="edad">Edad</label>
                <input
                        type="number"
                        id="edad"
                        name="edad"
                        value="<?= e($edad) ?>">
                <button type="submit">Enviar</button>
            </div>
        </form>

    <?php endif; ?>

</body>
</html>
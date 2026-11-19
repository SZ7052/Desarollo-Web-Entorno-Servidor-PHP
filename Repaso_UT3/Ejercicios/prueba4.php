<?php
declare(strict_types=1);

$juegosPermitidos = ["Catan", "Carcassonne", "Dune: Imperium", "Terraforming Mars"];
$nivelesPermitidos = ["principiante", "intermedio", "avanzado"];

$nombre = "";
$email = "";
$edad = "";
$juegoSeleccionado = "";
$nivelSeleccionado = "";
$normas = false;
$errores = [];
$enviadoConExito = false;

function validarNombre(string $nombre): ?string {
    if ($nombre === "") return "El nombre es obligatorio.";
    if (mb_strlen($nombre) < 3) return "El nombre debe tener al menos 3 caracteres.";
    return null;
}

function validarEmail(string $email): ?string {
    if ($email === "") return "El email es obligatorio.";
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) return "El formato del email no es válido.";
    return null;
}

function validarEdad(string $edadInput): ?string {
    if ($edadInput === "") return "La edad es obligatoria.";
    $edadInt = filter_var($edadInput, FILTER_VALIDATE_INT);
    if ($edadInt === false || $edadInt < 16) return "La edad debe ser un número entero y mínimo de 16 años.";
    return null;
}

function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $edad = trim($_POST["edad"] ?? "");
    $juegoSeleccionado = trim($_POST["juego"] ?? "");
    $nivelSeleccionado = trim($_POST["nivel"] ?? "");
    $normas = isset($_POST["normas"]);

    $errNombre = validarNombre($nombre);
    if ($errNombre) $errores[] = $errNombre;

    $errEmail = validarEmail($email);
    if ($errEmail) $errores[] = $errEmail;

    $errEdad = validarEdad($edad);
    if ($errEdad) $errores[] = $errEdad;

    if (!in_array($juegoSeleccionado, $juegosPermitidos, true)) {
        $errores[] = "El juego seleccionado no es válido.";
    }

    if (!in_array($nivelSeleccionado, $nivelesPermitidos, true)) {
        $errores[] = "El nivel seleccionado no es válido.";
    }

    if (!$normas) {
        $errores[] = "Es obligatorio aceptar las normas.";
    }

    if (empty($errores)) {
        $enviadoConExito = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4 - Registro en Torneo</title>
</head>
<body>
<h1>Inscripción al Torneo</h1>
<?php if ($enviadoConExito): ?>
    <div style="background: #dff0d8; padding: 15px; border-radius: 5px;">
        <h3>¡Inscripción completada con éxito!</h3>
        <p><strong>Nombre:</strong> <?= e($nombre) ?></p>
        <p><strong>Email:</strong> <?= e($email) ?></p>
        <p><strong>Juego principal:</strong> <?= e($juegoSeleccionado) ?></p>
        <p><strong>Nivel:</strong> <?= e($nivelSeleccionado) ?></p>
    </div>
<?php else: ?>
    <?php if (!empty($errores)): ?>
        <div style="background: #f2dede; color: #a94442; padding: 10px; margin-bottom: 15px;">
            <ul>
                <?php foreach ($errores as $err): ?>
                    <li><?= e($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post">
        <label>Nombre: <input type="text" name="nombre" value="<?= e($nombre) ?>"></label><br><br>
        <label>Email: <input type="email" name="email" value="<?= e($email) ?>"></label><br><br>
        <label>Edad: <input type="number" name="edad" value="<?= e($edad) ?>"></label><br><br>
        <label>Juego principal:
            <select name="juego">
                <option value="">-- Selecciona --</option>
                <?php foreach ($juegosPermitidos as $j): ?>
                    <option value="<?= e($j) ?>" <?= $juegoSeleccionado === $j ? "selected" : "" ?>><?= e($j) ?></option>
                <?php endforeach; ?>
            </select>
        </label><br><br>
        <label>Nivel:
            <select name="nivel">
                <option value="">-- Selecciona --</option>
                <?php foreach ($nivelesPermitidos as $n): ?>
                    <option value="<?= e($n) ?>" <?= $nivelSeleccionado === $n ? "selected" : "" ?>><?= e(ucfirst($n)) ?></option>
                <?php endforeach; ?>
            </select>
        </label><br><br>
        <label><input type="checkbox" name="normas" <?= $normas ? "checked" : "" ?>> Acepto las normas</label><br><br>
        <button type="submit">Enviar Inscripción</button>
    </form>
<?php endif; ?>
</body>
</html>
<?php
$resultado = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero1 = filter_input(INPUT_POST, "numero1", FILTER_VALIDATE_FLOAT);
    $numero2 = filter_input(INPUT_POST, "numero2", FILTER_VALIDATE_FLOAT);
    $operacion = $_POST["operacion"] ?? "";

    if ($numero1 === false || $numero1 === null ||
        $numero2 === false || $numero2 === null) {
        $error = "Por favor, ingresa dos números válidos.";
    } else {
        switch ($operacion) {
            case "sumar":
                $resultado = $numero1 + $numero2;
                break;
            case "restar":
                $resultado = $numero1 - $numero2;
                break;
            case "multiplicar":
                $resultado = $numero1 * $numero2;
                break;
            case "dividir":
                if ((float)$numero2 == 0.0) {
                    $error = "No se puede dividir entre cero.";
                } else {
                    $resultado = $numero1 / $numero2;
                }
                break;
            default:
                $error = "Selecciona una operación válida.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora en PHP</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Calculadora básica</h1>
        <p>Ejercicio de PHP para mi página personal</p>
    </header>

    <main>
        <section class="tarjeta">
            <h2>Realizar una operación</h2>
            <form method="post" action="calculadora.php">
                <label for="numero1">Primer número:</label><br>
                <input type="number" step="any" id="numero1" name="numero1" required><br><br>

                <label for="numero2">Segundo número:</label><br>
                <input type="number" step="any" id="numero2" name="numero2" required><br><br>

                <label for="operacion">Operación:</label><br>
                <select id="operacion" name="operacion" required>
                    <option value="sumar">Suma (+)</option>
                    <option value="restar">Resta (-)</option>
                    <option value="multiplicar">Multiplicación (×)</option>
                    <option value="dividir">División (÷)</option>
                </select><br><br>

                <button class="boton" type="submit">Calcular</button>
            </form>

            <?php if ($error !== ""): ?>
                <p role="alert"><strong><?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?></strong></p>
            <?php endif; ?>

            <?php if ($resultado !== null && $error === ""): ?>
                <h3>Resultado: <?php echo htmlspecialchars((string)$resultado, ENT_QUOTES, "UTF-8"); ?></h3>
            <?php endif; ?>

            <p><a href="index.html">Volver a mi página personal</a></p>
        </section>
    </main>

</body>
</html>

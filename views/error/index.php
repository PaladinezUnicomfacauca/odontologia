<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 | Odontología</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="error-page">

    <main class="error-viewport">
        <section class="error-card">

            <div class="error-icon" aria-hidden="true">!</div>

            <h1>
                <?= htmlspecialchars($errorTitle, ENT_QUOTES, 'UTF-8') ?>
            </h1>

            <p class="error-description">
                <?= htmlspecialchars($errorDescription, ENT_QUOTES, 'UTF-8') ?>
            </p>

            <h2 class="error-section-title">
                <?= count($availableControllers) === 1
                    ? 'Acciones disponibles'
                    : 'Controladores y acciones disponibles' ?>
            </h2>

            <div class="error-controller-list">

                <?php foreach ($availableControllers as $name => $actions): ?>

                    <article class="error-controller-item">

                        <h3>
                            <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <p>
                            <?php if (empty($actions)): ?>
                                No hay acciones públicas disponibles.
                            <?php else: ?>
                                <?= htmlspecialchars(
                                    implode(' · ', $actions),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            <?php endif; ?>
                        </p>

                    </article>

                <?php endforeach; ?>

            </div>

            <p class="error-footer">
                Sistema de gestión odontológica
            </p>

        </section>
    </main>

</body>
</html>

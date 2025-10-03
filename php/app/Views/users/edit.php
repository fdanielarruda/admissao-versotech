<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h1 class="my-4">Editar usuário</h1>

        <?php include __DIR__ . '/../errors.php'; ?>

        <form action="index.php?page=user_update&id=<?= $user->id ?>" method="POST">

            <input type="hidden" name="id" value="<?= $user->id ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user->name) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user->email) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cores</label>
                <div class="border p-3 rounded">
                    <?php foreach ($colors as $color): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="color-<?= $color->id ?>" name="colors[]" value="<?= $color->id ?>" <?= in_array($color->id, $user_colors) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="color-<?= $color->id ?>"><?= $color->name ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
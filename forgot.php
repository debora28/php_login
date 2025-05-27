<?php
session_start();
require_once('utils.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar a Senha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark bg-gradient">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="fw-bold text-secondary">Recuperar a Senha</h1>
                    </div>
                    <div class="card-body p-5">
                        <form action="action.php" method="POST">
                            <input type="hidden" name="forgot" value="1" />
                            <div class="mb-3">
                                <label for="name">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Enviar Link de Acesso" class="btn btn-primary">
                            </div>
                            <p class="text-center">Voltar para o Login? <a href="index.php" class="">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
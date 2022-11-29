<?php
require('includes/cabecalho.php');
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-4">
            <img class="rounded" src="static/perfil.png">
        </div>
        <div class="col-8">
            <h1 class="display-3">Seu Perfil</h1>
            <form action="perfil.php" method="POST">
                <div class="mb-3">
                    <label for="nomeUsuario" class="form-label">Nome:</label>
                    <input type="text" value="%nomeUsuario%" class="form-control" name="nomeUsuario" id="nomeUsuario">
                </div>
                <div class="mb-3">
                    <label for="emailUsuario" class="form-label">Email:</label>
                    <input type="text" value="%emailUsuario%" class="form-control" name="emailUsuario" id="emailUsuario">
                </div>
                <div class="mb-3">
                    <label for="senhaUsuario" class="form-label">Senha atual:</label>
                    <input type="password" class="form-control" name="senhaUsuario" id="senhaUsuario">
                </div>
                <div class="mb-3">
                    <label for="novaSenhaUsuario" class="form-label">Nova senha:</label>
                    <input type="password" class="form-control" name="novaSenhaUsuario" id="novaSenhaUsuario">
                </div>
                <div class="mb-3">
                    <label for="novaSenhaUsuario1" class="form-label">Reptir nova senha:</label>
                    <input type="password" class="form-control" name="novaSenhaUsuario1" id="novaSenhaUsuario1">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="submit">Alterar Informações</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require('includes/rodape.php');
?>
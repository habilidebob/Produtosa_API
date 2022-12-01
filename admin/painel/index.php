<?php
require_once('includes/cabecalho.php');
?>

<div class="container ">
    <div class="row mt-5">
        <div class="col">
            <h2>Olá <span id="nomeUsuario">%nome_usuario%</span>!</h2>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-3">
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalCategoria"><i class="bi bi-plus-square"></i> Categorias</button>
            </div>
        </div>
        <div class="col-4">
            <div class="d-grid gap-2">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalCadastro"><i class="bi bi-plus-square"></i> Produto</button>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preco</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <!-- O corpo da tabela deve ser preenchido dinâmicamente com JavaScript. -->
                <tbody id="corpoTabela">

                

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Aqui ficarão as modais: -->

<!-- Modal Produto -->
<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastro" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCadastro">Cadastrar Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nomeProduto" class="form-label">Nome: </label>
                        <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" aria-describedby="produtoHelp">
                        <div id="produtoHelp" class="form-text">Nome do produto que aparecerá no sistema.</div>
                    </div>
                    <div class="mb-3">
                        <label for="precoProduto" class="form-label">Preço: </label>
                        <input type="number" step=".01" class="form-control" id="precoProduto" name="precoProduto" aria-describedby="precoHelp">
                    </div>
                    <div class="mb-3">
                        <label for="descricaoProduto" class="form-label">Descricao: </label>
                        <textarea class="form-control" id="descricaoProduto" name="descricaoProduto" aria-describedby="descricaoHelp"></textarea>
                        <div id="descricaoHelp" class="form-text">A descrição do produto que será exibida logo após a imagem na página inicial.</div>
                    </div>
                    <div class="mb-3">
                        <label for="fotoProduto" class="form-label">Foto: </label>
                        <input type="file" class="form-control" id="fotoProduto" name="fotoProduto" aria-describedby="fotoHelp"></textarea>
                        <div id="fotoHelp" class="form-text">Arquivo em jpg ou png que representará o produto no sistema.</div>
                    </div>
                    <div class="mb-3">
                        <label for="categoriaProduto" class="form-label" >Categoria: </label>
                        <select class="form-select" aria-label="Default select example" id="categoriaProduto" name="categoriaProduto">
                            <option selected value="-1">Escolha a categoria</option>
                            <!-- Os campos abaixo deverão ser populados automaticamente com PHP: -->
                           
                            
                        </select>
                    </div>
                    <!-- O ID do usuário deve ser obtido automaticamente pelo controle de sessão! -->
                    
                    <!-- Campo "oculto" -->
                    <input type="hidden" name="operacao" value="2">
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- Modal Categoria-->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoria" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCategoria">Cadastrar Categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Return false impede que a página seja atualizada: -->
            <form id="formCategoria" onsubmit="return false;">
                    <div class="mb-3">
                        <label for="nomeCategoria" class="form-label">Nome da Categoria:</label>
                        <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria" aria-describedby="categoriaHelp">
                        <div id="categoriaHelp" class="form-text">A categoria deve ser única e não deve existir no sistema.</div>
                    </div>
            <!-- Campo "oculto" -->
            <input type="hidden" name="operacao" value="1">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php

require('includes/rodape.php');
?>
<?php
// Importar o arquivo sessao.php:
require('includes/sessao.php');
require('includes/cabecalho.php');
require('../../classes/Categoria.class.php');

// Verificar se o ID está vindo pela URL
if(isset($_GET['id'])){
    require_once('../../classes/Produto.class.php');
    $produto = new Produto();
    $produto->id = $_GET['id'];

    $resultado = $produto->BuscarPorID();
}else{
    // Retornar para index.php:
    header('Location: index.php');
    exit();
}


// Verificar se a página está sendo carregada por POST:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $arr_erros = [];

    // Verificar erros:
    if($_POST['nomeProduto']== ""){
        array_push($arr_erros, "O nome do produto está vazio!");
    }
    if($_POST['precoProduto']== ""){
        array_push($arr_erros, "O preco do produto está vazio!");
    }
    if($_POST['descricaoProduto']== ""){
        array_push($arr_erros, "A descrição do produto está vazia!");
    }
    if($_POST['categoriaProduto'] == "-1"){
        array_push($arr_erros, "A categoria não foi selecionada!");
    }


    // Se houveram erros, não executar!
    if(count($arr_erros) == 0){
        // Efetuar modificação:
        $produto->nome = $_POST['nomeProduto'];
        $produto->preco = $_POST['precoProduto'];
        $produto->descricao = $_POST['descricaoProduto'];
        $produto->id_categoria = $_POST['categoriaProduto'];

        // Verificar se existe a foto:
        if(file_exists($_FILES['fotoProduto']['tmp_name'])){
            $ext = substr($_FILES['fotoProduto']['name'], -4);
            $novo_nome = hash_file("sha256", $_FILES['fotoProduto']['tmp_name']).$ext;
            // Mover o arquivo:
            if(move_uploaded_file($_FILES['fotoProduto']['tmp_name'],"../../fotos/".$novo_nome)){
                $produto->caminho_foto = $novo_nome;
            }else{
                $erro = "Erro ao mover a foto";
            }

        }else{
            $produto->caminho_foto = "";
        }

        // Executar o UPDATE:
        if($produto->Modificar() == 1){
            // Redirecionar:
            header('Location: index.php?msg=3');
        }else{
            $erro = "Erro ao modificar o produto.";
        }
    
        
    }else{
        // Mostrar erros:
        $erro = "Os seguintes erros foram encontrados: \\n";
        foreach($arr_erros as $item){
            $erro .= $item . "\\n";
        }
    }

}

?>
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1 class="display-4">Modificar Produto</h1>
        </div>
    </div>
    <div class="row">
        <div class="col mw-80">
            <form action="editar.php?id=<?=$resultado[0]["ID"] ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nomeProduto" class="form-label">Nome: </label>
                    <input value="<?=$resultado[0]["Nome"] ?>" type="text" class="form-control" id="nomeProduto" name="nomeProduto" aria-describedby="produtoHelp">
                    <div id="produtoHelp" class="form-text">Nome do produto que aparecerá no sistema.</div>
                </div>
                <div class="mb-3">
                    <label for="precoProduto" class="form-label">Preço: </label>
                    <input value="<?=$resultado[0]["Preco"] ?>" type="number" step=".01" class="form-control" id="precoProduto" name="precoProduto" aria-describedby="precoHelp">
                </div>
                <div class="mb-3">
                    <label for="descricaoProduto" class="form-label">Descricao: </label>
                    <textarea class="form-control" id="descricaoProduto" name="descricaoProduto" aria-describedby="descricaoHelp"><?=$resultado[0]["Descricao"] ?></textarea>
                    <div id="descricaoHelp" class="form-text">A descrição do produto que será exibida logo após a imagem na página inicial.</div>
                </div>
                <div class="mb-3">
                    <label for="fotoProduto" class="form-label">Foto: </label>
                    <input type="file" class="form-control" id="fotoProduto" name="fotoProduto" aria-describedby="fotoHelp"></textarea>
                    <div id="fotoHelp" class="form-text">Arquivo em jpg ou png que representará o produto no sistema.</div>
                </div>
                <div class="mb-3">
                    <label for="categoriaProduto" class="form-label">Categoria: </label>
                    <select class="form-select" aria-label="Default select example" id="categoriaProduto" name="categoriaProduto">
                        <option value="-1">Escolha a categoria</option>
                        <!-- Os campos abaixo deverão ser populados automaticamente com PHP: -->
                        <?php
                                // Puxar as categorias do bd:
                                $r_categorias = Categoria::Listar();
                                // Mostrar as categorias pelo foreach:
                                foreach($r_categorias as $linha){
                                    // Verificar se o produto está na categoria corrente:
                                    if($linha['id'] == $resultado[0]["ID_Categoria"]){ ?>
                                        <option selected value="<?=$linha['id']; ?>"><?=$linha['nome_categoria']; ?></option>
                                    <?php }else{ ?>
                                        <option value="<?=$linha['id']; ?>"><?=$linha['nome_categoria']; ?></option>
                                    <?php } ?>
                            <?php } ?>
                    </select>
                </div>
    
                <button type="submit" class="btn btn-primary">Modificar</button>
            </form>
        </div>
    </div>
</div>

<?php

require('includes/rodape.php');
?>
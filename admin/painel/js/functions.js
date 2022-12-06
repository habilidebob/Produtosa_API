// Evento quando a página terminar de carregar:
$(document).ready(function(){
    $.get('/sistema_api/webapi/infosSessao.php')
    .done(function(r){
        // Verificar se o jovem tá logado:
        if(r.status != 1){
            location.href = "../index.php";
        }else{
            // Mostrar o nome do usr logado no topo do site:
            $('#nomeUsuario').text(r[0][0]['nome_completo']);
        }
    });
    atualizarTabela();
    atualizarCategorias();
    // Obter infos do jovem logado:
    
});


// Evento submit(formulário enviado):
$('#formCategoria').submit(function(){
    $.post('/sistema_api/webapi/cadastrarCategoria.php',
    {nome: nomeCategoria.value})
    .done(function(r){
        if(r.status == 1){
            swal('Sucesso!', r.msg, 'success');
            atualizarCategorias();
            // Fechar a modal:
            var myModalEl = document.getElementById('modalCategoria');
            var modal = bootstrap.Modal.getInstance(myModalEl)
            modal.hide();
        }else{
            swal('Erro!', r.msg, 'error');
        }
    });
});

function atualizarCategorias(){
    $.get('/sistema_api/webapi/listarCategorias.php').done(function(r){
        // Limpar dropdown:
        $('#categoriaProduto').html('');
        $('#categoriaProduto').append('<option selected value="-1">Escolha a categoria</option>');
        r.forEach(function(valor){
            $('#categoriaProduto').append('<option value="'+valor.id+'">'+valor.nome_categoria+'</option>');
        });
    });
}


function atualizarTabela(){
    $.get('/sistema_api/webapi/listarProdutos.php').done(function(r){
        // Percorrer o array de resultado:
        // Passar para uma função:
        r.forEach(function(valor){
            $('#corpoTabela').append('<tr>'+
            '<th scope="row">'+valor.ID+'</th>'+
            '<td><img src="/sistema_api/webapi/fotos/'+valor.Foto+'" width="50px"></td>'+
            '<td>'+valor.Nome+'</td>'+
            '<td>'+valor.Preco+'</td>'+
            '<td>'+valor.Descricao+'</td>'+
            '<td>'+valor.Categoria+'</td>'+
            '<td>'+valor.Usuario+'</td>'+
            '<td><div class="d-grid gap-2">'+
            '<a href="#" onclick="apagar(\''+valor.Nome.replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0')+'\','+valor.ID+')" class="btn btn-danger btn-sm"><i class="bi bi-x-circle-fill"></i></a>'+
            '<a href="#" class="btn btn-primary btn-sm">'+
            '<i class="bi bi-pencil-square"></i></a></div></td>'+
            '</tr>');
        });
    });
}

function apagar(nome, id){
    swal({
        title: "Tem certeza?",
        text: "Tem certeza que deseja apagar o produto "+nome+"?",
        icon: "warning",
        buttons: {
            cancel: "Não!",
            catch: {
              text: "Sim!",
              value: "sim",
            }
        },
      }).then((value)=>{
        if(value == "sim"){
            $.get('/sistema_api/webapi/apagarProduto.php?id='+id)
            .done(function(r){
                if(r.status == 1){
                    swal("Sucesso!",nome+" foi removido!", 'success');
                    // Limpar o corpoTabela:
                    $('#corpoTabela').html('');
                    atualizarTabela();
                }else{
                    swal("Erro!"," Houve um problema", 'error');
                }
            });
        }
      });
}


function sair(){
    $.get('/sistema_api/webapi/encerrarSessao.php')
    .done(function(r){
        if(r.status == 1){
            // redirecionar para o login:
            location.href = "../index.php";
        }else{
            swal('Erro!');
        }
    });
}
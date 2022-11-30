// Evento quando a página terminar de carregar:

$(document).ready(function(){
    $.get('/sistema_api/webapi/listarProdutos.php').done(function(r){
        // Percorrer o array de resultado:
        // Corrigir:
        r.forEach(function(valor){
            $('#corpoTabela').append("<tr>");
            $('#corpoTabela').append('<th scope="row">'+valor.ID+'</th>');
            $('#corpoTabela').append('<td><img src="/sistema_api/webapi/fotos/'+valor.Foto+'" width="50px"></td>');
            $('#corpoTabela').append('<td>'+valor.Nome+'</td>');
            $('#corpoTabela').append('<td>'+valor.Preco+'</td>');
            $('#corpoTabela').append('<td>'+valor.Descricao+'</td>');
            $('#corpoTabela').append('<td>'+valor.Categoria+'</td>');
            $('#corpoTabela').append('<td>'+valor.Usuario+'</td>');
            $('#corpoTabela').append('<td><div class="d-grid gap-2">');
            $('#corpoTabela').append('<a href="#" class="btn btn-danger btn-sm"><i class="bi bi-x-circle-fill"></i></a>');
            $('#corpoTabela').append('<a href="#" class="btn btn-primary btn-sm">');
            $('#corpoTabela').append('<i class="bi bi-pencil-square"></i></a></div></td>');
            $('#corpoTabela').append("</tr>");
        });
    });
});
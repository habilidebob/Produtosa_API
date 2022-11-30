// Botão entrar:
$('#btnEntrar').click(function(){
    // Mandar essas infos por POST para a API:
    $.post('/sistema_api/webapi/logar.php', 
    {email: email.value, senha: senha.value}).done(function(r){
        if(r.status == 0){
            swal("Erro!", r.msg, "error");
        }else{
            // Redirecionar:
            location.href = "painel/";
        }
    });
});

// Eventos do botão cadastrar:
$('#btnCadastrar').click(function(){
    $.post('/sistema_api/webapi/cadastrarUsuario.php',
    {nome: nomeCad.value, email: emailCad.value, senha: senhaCad.value})
    .done(function(r){
        if(r.status == 0){
            swal("Erro!", r.msg, "error");
        }else{
            swal("Sucesso!", r.msg, "success");
            // Simular o click no btnLoginToggle:
            $('#btnLoginToggle').click();
        }
    });
});
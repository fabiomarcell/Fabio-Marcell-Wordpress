function listarProdutos(admin){
  var dados = {action: 'listarProdutos', isAdmin: admin};
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
        if(resposta.status){
          $("#resultsAllProdutos").html(resposta.busca);
        }
        else{
          $("#resultsAllProdutos").html("Erro ao consultar produtos");
          console.log(resposta);
        }
    }
  });
}

function getProduto(id){
  var dados = {action: 'getProduto', id: id};
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        console.log(resposta.produto.nomeProduto);
        if(resposta.produto.nomeProduto != undefined){
          $("#produto").html(resposta.produto.nomeProduto);
          $("#descricao").html(resposta.produto.descricaoProduto);
          $("#valor").html("R$ " + resposta.produto.precoProduto);
          $("#imgproduto").attr("src", "upload/produto/"+resposta.produto.imgProduto);
          $("#link").attr("href", "pedido.php?produto="+resposta.produto.idProduto);
        }
        else{
          $("#result").html("Produto não encontrado");
        }
      }
      else{
        console.log(resposta.message);
      }
    }
  });
}

function getProdutoUpdate(id){
  var dados = {action: 'getProduto', id: id};
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        console.log(resposta.produto.nomeProduto);
        if(resposta.produto.nomeProduto != undefined){
          $("#produto").val(resposta.produto.nomeProduto);
          $("#descricao").val(resposta.produto.descricaoProduto);
          $("#preco").val(resposta.produto.precoProduto);
        }
        else{
          $("#result").html("Produto não encontrado");
        }
      }
      else{
        console.log(resposta.message);
      }
    }
  });
}

function removerProduto(id){
  var dados = {action: 'removeProduto', id: id};
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        listarProdutos(true);
      }
      else{
        console.log(resposta.message);
      }
    }
  });
}

function alterarProduto(id){
  var dados = {
                action: 'alterarProduto', 
                id: id,
                produto: $("#produto").val(),
                descricao: $("#descricao").val(),
                preco: $("#preco").val()
              };
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        window.location = "adminProdutos.php";
      }
      else{
        console.log(resposta.message);
      }
    }
  });
}

function inserirProduto(){
  var dados = {
                action: 'inserirProduto', 
                produto: $("#produto").val(),
                descricao: $("#descricao").val(),
                preco: $("#preco").val()
              };
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        window.location = "adminProdutos.php";
      }
      else{
        console.log(resposta.message);
      }
    }
  });
}


function cadastrarUsuario(){
  var dados = {
                action: 'cadastrarUsuario', 
                nome: $("#nomeCadastro").val(),
                email: $("#emailCadastro").val(),
                telefone: $("#telefoneCadastro").val()
              };
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        window.location = "index.php";
      }
      else{
        console.log(resposta.message);
      }
    }
  });
}


function login(email){
  var dados = {action: 'login', emailLogin: $("#emailLogin").val()};
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        window.location = "index.php";
      }
      else{
        $("#resLogin").html("Cliente não encontrado");
      }
    }
  });
}

function registrarPedido(cliente, produto){
  var dados = {
                action: 'registrarPedido', 
                cliente: cliente,
                produto: produto
              };
  $.ajax({
    url: 'db.php',
    type: 'POST',
    data: dados,
    dataType: "json",
    success: function(resposta) {
      if(resposta.status){
        $("#resultPedido").html("Pedido Registrado com sucesso!");
      }
      else{
        $("#resultPedido").html("Erro ao cadastrar pedido. Tente novamente mais tarde."); 
      }
    }
  });
}
<?php
require "../backend/index.php";

// Define variables and initialize with empty values
$descricao = $select_cod_produto = "";
$descricao_err = $cod_produto_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate descricao
    $input_descricao = trim($_POST["descricao"]);
    if(empty($input_descricao)){
        $descricao_err = "Digite a descrição da categoria.";
    } else {
        $descricao = $input_descricao;
    }

    // Validate id_categoria
/*
    $input_cod_produto = trim($_POST["select_cod_produto"]);
    if($input_cod_produto == 0){
        $cod_produto_err = "Selecione um Produto.";     
    } else{
        $select_cod_produto = $input_cod_produto;
    }
*/
    // Check input errors before inserting in database
    if(empty($descricao_err)){
        insereCategoria();
    }

}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Lista de Categorias</h2>
                    </div>
                    <p>Categorias padrão para mostrar Produtos: Acessórios, Roteadores, Cabos, Fones, Notebooks</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($descricao_err)) ? 'has-error' : ''; ?>">
                            <label>Descrição da Categoria</label>
                            <input type="text" name="descricao" class="form-control" value="<?php echo $descricao; ?>">
                            <span class="help-block"><?php echo $descricao_err;?></span>
                        </div>
                            <?php 
                                selecionaCategoria();
                            ?>
                        <p><input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a></p>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
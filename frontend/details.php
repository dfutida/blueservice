<?php
require "../backend/index.php";

// Define variables and initialize with empty values
$descricao = $cod_produto = $cod_categoria = "";
$descricao_err = $cod_produto_err = $cod_categoria_err = "";
 
// Processing form data when form is submitted
if(isset($_GET["cod_produto"]) && !empty($_GET["cod_produto"])){
    // Get hidden input value
    $cod_produto = $_GET["cod_produto"];
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Detalhes do Produto</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <?php selecionaPorId(); ?>
                        <input type="hidden" name="cod_produto" value="<?php echo $cod_produto; ?>"/>
                        <a href="index.php" class="btn btn-success pull-left">Produtos</a>
                        <a href="carrinho.php" class="btn btn-success pull-left">Carrinho de Compras</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
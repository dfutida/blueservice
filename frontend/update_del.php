<?php
require "../backend/index.php";

// Define variables and initialize with empty values
$descricao = $cod_produto = $cod_categoria = "";
$descricao_err = $cod_produto_err = $cod_categoria_err = "";
 
// Processing form data when form is submitted
if(isset($_GET["cod_produto"]) && !empty($_GET["cod_produto"])){
    // Get hidden input value
    $cod_produto = $_GET["cod_produto"];
    
    // Validate descricao
    $input_descricao = trim(isset($_POST["descricao"]));
    if(empty($input_descricao)){
        $descricao_err = "Digite a descrição do produto.";
    } else {
        $descricao = $input_descricao;
    }
    
    // Validate cod_categoria
    $input_cod_categoria = trim($_GET["cod_categoria"]);
    if($input_cod_categoria == 0){
        $cod_categoria_err = "Selecione uma categoria válida.";     
    } else{
        $cod_categoria = $input_cod_categoria;
    }
    
    // Check input errors before inserting in database
    if(empty($descricao_err) && empty($cod_categoria_err)) {
        // Prepare an update statement
        atualiza();
    }
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <?php selecionaPorId(); ?>
                        <input type="hidden" name="cod_produto" value="<?php echo $cod_produto; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
<?php 
    require "../backend/index.php"; 

// Define variables and initialize with empty values
$busca = "";
$busca_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate descricao
    $input_busca = trim($_POST["palavra"]);
    if(empty($input_busca)){
        $busca_err = "Digite uma palavra para Buscar";
    } else {
        $busca = $input_busca;
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
    if(empty($busca_err)){
        echo "<div class='wrapper'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='page-header clearfix'>";
                        busca();
        echo        "</div>
                </div>        
            </div>
        </div>";
    }

}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?a=buscar" method="post">
                    <div class="form-group <?php echo (!empty($busca_err)) ? 'has-error' : ''; ?>">
                            <h2 class="pull-left">Busca</h2>
                            <input type="text" name="palavra" class="form-control" value="<?php echo $busca; ?>">
                            <span class="help-block"><?php echo $busca_err;?></span>
                            <input type="submit" value="Buscar" />
                        </div>
                        <h2 class="pull-left">Lista de Produtos</h2>
                        <a href="createCat.php" class="btn btn-success pull-right">Adicionar nova categoria</a>
                        <a href="carrinho.php" class="btn btn-success pull-right">Carrinho de Compras</a>
                    </div>
                    <?php seleciona(); ?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
<?php
// Define variables and initialize with empty values
$descricao = $id_categoria = "";
$descricao_err = $cod_categoria_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate descricao
    $input_descricao = trim($_POST["descricao"]);
    if(empty($input_descricao)){
        $descricao_err = "Digite a descrição de produto.";
    } else {
        $descricao = $input_descricao;
    }
    
    // Validate id_categoria
    $input_cod_categoria = trim($_POST["cod_categoria"]);
    if($input_cod_categoria == 0){
        $cod_categoria_err = "Selecione uma categoria válida.";     
    } else{
        $cod_categoria = $input_cod_categoria;
    }

    // Check input errors before inserting in database
    if(empty($descricao_err)){
        require "../backend/index.php";
        insere();
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($descricao_err)) ? 'has-error' : ''; ?>">
                            <label>Descrição do Produto</label>
                            <input type="text" name="descricao" class="form-control" value="<?php echo $descricao; ?>">
                            <span class="help-block"><?php echo $descricao_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($cod_categoria_err)) ? 'has-error' : ''; ?>">
                            <label>Categoria</label>
<?php
    require "../backend/index.php";
    
    selecionaCategoria();
?>                            
                            <span class="help-block"><?php echo $cod_categoria_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
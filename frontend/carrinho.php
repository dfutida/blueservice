<?php
    require "../backend/index.php";

    session_start();

    if(!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    //adiciona produto
    if(isset($_GET['acao'])) {
        
        //adiciona carrinho
        if($_GET['acao'] == 'add') {
            $cod_produto = intval($_GET['cod_produto']);

            if(!isset($_SESSION['carrinho'][$cod_produto])) {
                $_SESSION['carrinho'][$cod_produto] = 1;
            } else {
                $_SESSION['carrinho'][$cod_produto] += 1;
            }
        }

        // remove produto
        if($_GET['acao'] == 'del') {
            $cod_produto = intval($_GET['cod_produto']);
            if(isset($_SESSION['carrinho'][$cod_produto])) {
                unset($_SESSION['carrinho'][$cod_produto]);
            }
        }
        
        //Alterar quantidade
        if($_GET['acao'] == 'upd' && isset($_POST['prod'])) {
            if(is_array($_POST['prod'])) {
                foreach($_POST['prod'] as $cod_produto => $qtd) {
                    $cod_produto = intval($cod_produto);
                    $qtd = intval($qtd);
                    if(!empty($qtd) || $qtd <> 0) {
                        $_SESSION['carrinho'][$cod_produto] = $qtd;
                    } else {
                        unset($_SESSION['carrinho'][$cod_produto]);
                    }
                }
            }
        }

        //Finalizar
        if($_GET['acao'] == 'finalizar') {
            insere();
        }
            
    }

    //print_r($_SESSION['carrinho']);


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
                        <h2 class="pull-left">Carrinho de Compras</h2>
                    </div>
<?php carrinho(); ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
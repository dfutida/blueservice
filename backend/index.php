<?php
    
    include_once 'conexao.php';

    function seleciona() {

        try {
            $database = new Conexao();
            $db = $database->abreConexao();

            $res = $db->query("SELECT p.cod_produto, p.nome, p.imagem, p.preco, p.descricao, c.Descricao From produto as p, categoria as c WHERE p.categoria = c.descricao ORDER BY p.descricao");
            
            echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Nome</th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Preço</th>";
                    echo "<th>Ação</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($linha = $res->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>" . $linha['nome'] . "</td>";
                    echo "<td><img src='../frontend/images/" . $linha['imagem'] . "'</td>";
                    echo "<td>" . number_format($linha['preco'], 2, ',', '.') . "</td>";
                    echo "<td>";
                        echo "<a href='details.php?cod_produto=". $linha['cod_produto'] ."' title='Product Details' data-toggle='tooltip'><span class='glyphicon glyphicon-th-list'></a>";
                        echo "<a href='carrinho.php?acao=add&cod_produto=". $linha['cod_produto'] ."' title='Add Product' data-toggle='tooltip'><span class='glyphicon glyphicon-shopping-cart'></a>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
            echo "</table>";

            $database->fechaConexao();

        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    function carrinho() {
       
        $total = $cod_produto = $nome = $preco = $prod = $sub = "";

            echo "<form method='POST' action='carrinho.php?acao=upd' id='myform'>";

            echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<td colspan='3'><a href='javascript:myform.submit()' class='btn btn-success pull-right'>Atualizar Carrinho</a></td>";
            echo "<td colspan='3'><a href='index.php' class='btn btn-success pull-right'>Continuar Comprando</a></td>";
            echo "</tr>";            
                echo "<tr>";
                    echo "<th>Produto</th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Qtde</th>";
                    echo "<th>Preço</th>";
                    echo "<th>Subtotal</th>";
                    echo "<th>Ação</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            if(count($_SESSION['carrinho']) == 0) {
                echo "<tr><td colspan='6'>Não há produtos no carrinho</td></tr>";
            } else {
                foreach($_SESSION['carrinho'] as $cod_produto => $qtd) {

                    try {
                        $database = new Conexao();
                        $db = $database->abreConexao();
            
                        $res = $db->query("SELECT * FROM produto WHERE cod_produto = $cod_produto ORDER BY nome");

                        while ($linha = $res->fetch(PDO::FETCH_ASSOC)) {

                            $nome = $linha['nome'];
                            $imagem = $linha['imagem'];
                            $preco = (float)number_format($linha['preco'],2,'.','');
                            $preco = bcdiv($preco, 1, 2);
                            $sub = (float)number_format($linha['preco'] * $qtd,2,'.','');
                            $sub = bcdiv($sub, 1, 2);
                            $total += $sub;
                            $total = (float)number_format($total, 2, '.', ''); 
                            $total = bcdiv($total, 1, 2); 

                            echo "<tr>
                                <td>".$nome."</td>
                                <td><img src='../frontend/images/".$imagem."'</td>
                                <td><input type='text' size='3' name='prod[".$cod_produto."]' value='".$qtd."'></td>
                                <td>R$ ".$preco."</td>
                                <td>R$ ".$sub."</td>
                                <td>
                                    <a href='carrinho.php?acao=del&cod_produto=".$linha['cod_produto']."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                                    <a href='details.php?cod_produto=".$linha['cod_produto']."' title='Product Details' data-toggle='tooltip'><span class='glyphicon glyphicon-th-list'></span></a>
                                    <input type='hidden' name='cod_produto[]' value='".$cod_produto."'>
                                    <input type='hidden' name='nome[]' value='".$nome."'>
                                    <input type='hidden' name='preco[]' value='".$preco."'>
                                    <input type='hidden' name='quantidade[]' value='".$qtd."'>
                                    <input type='hidden' name='subtotal[]' value='".$sub."'>
                                    <input type='hidden' name='total' value='".$total."'>
                                </td>
                            </tr>";
                        }                      
                                        
                    $database->fechaConexao();
                    
                } catch (PDOException $e) {
                    echo "There is some problem in connection: " . $e->getMessage();
                }                
            }
        }

            echo "<tr>";
            echo "<td colspan='3'><a href='javascript:myform.submit()' class='btn btn-success pull-right'>Atualizar Carrinho</a></td>";
            echo "<td colspan='3'><a href='index.php' class='btn btn-success pull-right'>Continuar Comprando</a></td>";
            echo "</tr>";

            if($total > 0) {        
                echo "<tr>
                <td colspan='6' class='text-right'>Total: R$ ".$total."</td>
                </tr>";
            }

            echo "<tr>";
            echo "<td colspan='6'><button type='submit' formaction='carrinho.php?acao=finalizar' class='btn btn-success pull-right'>Finalizar Compra</button></td>";
            echo "</tr>";

            echo "</tbody>";                            
            echo "</table>";
            echo "</form>";
    }


    function busca() {

        try {
            $database = new Conexao();
            $db = $database->abreConexao();
            
            echo "<h2 class='pull-left'>Resultados da Busca</h2>";
            echo "<table class='table table-bordered table-striped'>";

            if(isset($_GET['a'])) {
            // Verificamos se a ação é de busca
            if ($_GET['a'] == "buscar") {
                // Pegamos a palavra
                $palavra = trim($_POST['palavra']);

            $res = $db->query("SELECT * from produto WHERE nome LIKE '%".$palavra."%' ORDER BY nome");
            $numRegistros = $res->rowCount();

                // Se houver pelo menos um registro, exibe-o
                if ($numRegistros != 0) {                  

                    while ($linha = $res->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                    echo "<td>" . $linha['nome'] . "</td>";
                    echo "<td><img src='../frontend/images/" . $linha['imagem'] . "'</td>";
                    echo "<td>" . number_format($linha['preco'], 2, ',', '.') . "</td>";
                    echo "<td>";
                        echo "<a href='details.php?cod_produto=". $linha['cod_produto'] ."' title='Product Details' data-toggle='tooltip'><span class='glyphicon glyphicon-th-list'></a>";
                        echo "<a href='carrinho.php?acao=add&cod_produto=". $linha['cod_produto'] ."' title='Add Product' data-toggle='tooltip'><span class='glyphicon glyphicon-shopping-cart'></a>";
                    echo "</td>";
                echo "</tr>";
                    }
            
                // Se não houver registros
                } else {
                    echo "Nenhum produto foi encontrado com a palavra ".$palavra."";
                }
            }
            }
            echo "</tbody>";                            
            echo "</table>";

            $database->fechaConexao();

        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    function deleteCategoria() {
    if(!empty($_GET['acao']) && isset($_GET['acao'])){
        if($_GET['acao'] == 'del') {
            $cod_categoria = $_GET['cod_categoria'];

            try {
                $database = new Conexao();
                $db = $database->abreConexao();

                $stmt = $db->prepare('DELETE FROM categoria WHERE cod_categoria = :cod_categoria');
                $stmt->bindParam(':cod_categoria', $cod_categoria); 
                $stmt->execute();
                    
                echo $stmt->rowCount(); 

                $database->fechaConexao();

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Records updated successfully. Redirect to landing page
                    header("location: createCat.php");
                    exit();
                } else{
                    echo "Something went wrong. Please try again later.";
                }

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
    }

    function selecionaCategoria() {  

        $cod_produto = $cod_categoria = "";

        try {
            $database = new Conexao();
            $db = $database->abreConexao();

            $res = $db->query("SELECT * FROM categoria ORDER BY descricao");
            
            echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Cod Categoria</th>";
            echo "<th>Descrição Categoria</th>";
            echo "<th>Ação</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
 
            while ($linha = $res->fetch(PDO::FETCH_ASSOC)) {
                //$cod_produto = $linha['cod_produto'];
                $cod_categoria = $linha['cod_categoria'];
                $descricao = $linha['descricao'];
                //$nome = $linha['nome'];
                
                deleteCategoria();

                    echo "<tr>";
                    echo "<td>".$cod_categoria."</td>";
                    echo "<td>".$descricao."</td>";
                    echo "<td><a href='createCat.php?acao=del&cod_categoria=".$cod_categoria."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></a></td>";
                    echo "<td>";
                    //echo "<input type='hidden' name='cod_produto' value=".$cod_produto.">";
                    echo "<input type='hidden' name='cod_categoria' value=".$cod_categoria.">";
                    echo "</td>";
                    echo "</tr>";                        

            }

            $database->fechaConexao();

        } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    function insere() {

        $total = $stm = "";

        try {
            if(isset($_GET['acao'])) {
                if($_GET['acao'] == 'finalizar') {
                    if(!empty($_SESSION['carrinho'])) {
                        
                        $array = $_SESSION['carrinho'];

                        foreach ($array as $codProd => $qtde) {

                            $cod_produto = $_POST['cod_produto'];
                            $nome = $_POST['nome'];
                            $preco = $_POST['preco'];
                            $quantidade = $_POST['quantidade'];
                            $subtotal = $_POST['subtotal'];
                            $total = $_POST['total'];
                        }

                        $database = new Conexao();
                        $db = $database->abreConexao();

                        $i = 0;
                        while($i < count($array)) {

                            // inserting data into create table using prepare statement to prevent from sql injections
                            $stm = $db->prepare("INSERT INTO pedido (cod_produto, nome, preco, quantidade, subtotal, total) VALUES ( :cod_produto, :nome, :preco, :quantidade, :subtotal, :total)");
                
                            // inserting a record
                            $stm->execute(array('cod_produto' => $cod_produto[$i], ':nome' => $nome[$i], ':preco' => $preco[$i], ':quantidade' => $quantidade[$i], ':subtotal' => $subtotal[$i], ':total' => $total));
                            //echo "'cod_produto' => $cod_produto[$i], ':nome' => $nome[$i], ':preco' => $preco[$i], ':quantidade' => $quantidade[$i], ':subtotal' => $subtotal[$i], ':total' => $total";

                            $i++;
                        }

                    } else {
                        header("location: index.php");    
                    }
                }
            }

            if($stm) {
                echo  "<script>alert('Compra efetuada com sucesso! Dados inseridos no banco.');</script>";
                echo "<script>window.location='index.php';</script>";
                session_unset($_SESSION);
            }

            //echo "New record created successfully";
            //header("location: index.php");
            exit();
            $database->fechaConexao();

        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    function insereCategoria() {

        try {
            $database = new Conexao();
            $db = $database->abreConexao();

            // inserting data into create table using prepare statement to prevent from sql injections
            $stm = $db->prepare("INSERT INTO categoria (descricao) VALUES ( :descricao)");

            // inserting a record
            $stm->execute(array(':descricao' => $_POST['descricao']));

            //echo "New record created successfully";
            header("location: createCat.php");
            exit();

            $database->fechaConexao();

        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    function selecionaPorId() {

        // Processing form data when form is submitted
        if(isset($_GET["cod_produto"]) && !empty($_GET["cod_produto"])) {
            // Get hidden input value
            $cod_produto = $_GET["cod_produto"];
            try {
                $database = new Conexao();
                $db = $database->abreConexao();

                $res = $db->query("SELECT * FROM produto WHERE cod_produto = $cod_produto");
                
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                        echo "<th>CodProduto</th>";
                        echo "<th>Nome</th>";
                        echo "<th>Descrição</th>";
                        echo "<th>Imagem</th>";
                        echo "<th>Preço</th>";
                        echo "<th>Categoria</th>";
                        echo "<th>Ação</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($linha = $res->fetch(PDO::FETCH_ASSOC)) {
                    
                    $cod_produto = $linha['cod_produto'];
                    $nome = $linha['nome'];
                    $descricao = $linha['descricao'];
                    $imagem = $linha['imagem'];
                    $preco = $linha['preco'];
                    $categoria = $linha['categoria'];

                    echo "<tr>
                    <td>".$cod_produto."</td>
                    <td>".$nome."</td>
                    <td>".$descricao."</td>
                    <td><img src='../frontend/images/".$imagem."'</td>
                    <td>R$ ".$preco."</td>
                    <td>".$categoria."</td>
                    <td>
                        <a href='carrinho.php?acao=add&cod_produto=". $linha['cod_produto'] ."' title='Add Product' data-toggle='tooltip'><span class='glyphicon glyphicon-shopping-cart'></a>
                    </td>
                </tr>";
                }

                $database->fechaConexao();

            } catch (PDOException $e) {
                echo "There is some problem in connection: " . $e->getMessage();
            }
        }
    }

?>
//Criar banco de dados no MySQL (phpmyadmin) <br>
CREATE DATABASE blueservice;<br><br>

//Criar tabela no MySQL (phpmyadmin)<br>
CREATE TABLE IF NOT EXISTS Produto (<br>
    cod_produto int(11) NOT NULL AUTO_INCREMENT,<br>
    nome varchar(255),<br>
    descricao varchar(255),<br>
    imagem varchar(60),<br>
    preco decimal(10,2),<br>
    categoria varchar(255),<br>
    PRIMARY KEY (cod_produto)<br>
);<br><br>

CREATE TABLE IF NOT EXISTS Categoria (<br>
    cod_categoria int(11) NOT NULL AUTO_INCREMENT,<br>
    descricao varchar(255),<br>
    PRIMARY KEY (cod_categoria)<br>
);<br><br>

CREATE TABLE IF NOT EXISTS Pedido (<br>
    cod_pedido int(11) NOT NULL AUTO_INCREMENT,<br>
    cod_produto int(11),<br>
    nome varchar(255),<br>
    preco decimal(10, 2),<br>
    quantidade int(11),<br>
    subtotal decimal(10,2),<br>
    total decimal(10,2),<br>
    PRIMARY KEY (cod_pedido)<br>
);<br><br>

INSERT INTO Categoria (cod_categoria, descricao)<br>
VALUES (<br>
1, 'Acessórios'<br>
), (<br>
2, 'Notebooks'<br>
), (<br>
3, 'Roteadores'<br>
), (<br>
4, 'Cabos'<br>
), (<br>
5, 'Fones'<br>
);<br><br>

INSERT INTO Produto (cod_produto, nome, descricao, imagem, preco, categoria)<br>
VALUES (<br>
10, 'Mouse Logitech M170', 'Mouse Logitech M170 Wireless Preto', 'mouse.jpg', '61,36', 'Acessórios'<br>
), (<br>
11, 'Notebook Vaio FE15', 'Notebook Vaio FE15, Intel Core i5, 8GB RAM, HD 1TB, Tela LCD 15.6" HD, Windows 10 - Chumbo Escuro', 'vaio.jpg', '3999', 'Notebooks'<br>
), (<br>
12, 'Notebook Acer ASPIRE 3', 'Notebook Acer ASPIRE 3 A315-34-C6ZS Intel Celeron N4000 4GB RAM 1TB HD 15,6 Endless OS', 'acer.jpg', '3509', 'Notebooks'<br>
), (<br>
13, 'TP-Link AC 1350 Archer C60', 'TP-Link AC 1350 Archer C60 Roteador Wireless Dual Band', 'roteador.jpg', '279,99', 'Roteadores'<br>
), (<br>
14, 'CABO REDE CAT.5E 2.5M', 'CABO REDE CAT.5E 2.5M PC-ETHU25BL PATCH CORD, Plus Cable', 'cabo.jpg', '9,90', 'Cabos'<br>
), (<br>
15, 'WebCam Logitech C270', 'WebCam Logitech C270 HD com 3 MP para Chamadas e Gravações em Vídeo Widescreen 720p', 'cam.jpg', '404,23', 'Acessórios'<br>
), (<br>
16, 'Headset Gamer HyperX', 'Headset Gamer HyperX Cloud Stinger Core PS4/Xbox One/Nintendo Switch', 'headphone.jpg', '369', 'Fones'<br>
);<br>
<br>

// ==================================================<br>
1 - Descompactar o .ZIP na pasta wwww do servidor Apache e renomear a pasta raiz para blueservice apenas<br><br>

2 - Abrir e Configurar o arquivo em ../backend/conexao.php a conexao com Banco de dados:
Server(localhost), User(root), Password (pass), porta do MySQL(port=3306), nome do banco de dados(dbname=blueservice)<br><br>

3 - Acessar no navegador página inicial (Chrome) http://localhost:8181/blueservice/frontend/index.php (as vezes funciona sem a porta 8181)<br><br>

4 - Verificar pedidos finalizados do carrinho de compras na tabela pedido (phpmyadmin).<br><br>
// ==================================================<br>
//Criar banco de dados no MySQL 
CREATE DATABASE blueservice;

//Criar tabela no MySQL
CREATE TABLE IF NOT EXISTS Produto (
    cod_produto int(11) NOT NULL AUTO_INCREMENT,
    nome varchar(255),
    descricao varchar(255),
    imagem varchar(60),
    preco decimal(10,2),
    categoria varchar(255),
    PRIMARY KEY (cod_produto)
);

CREATE TABLE IF NOT EXISTS Categoria (
    cod_categoria int(11) NOT NULL AUTO_INCREMENT,
    descricao varchar(255),
    PRIMARY KEY (cod_categoria)
);

CREATE TABLE IF NOT EXISTS Pedido (
    cod_pedido int(11) NOT NULL AUTO_INCREMENT,
    cod_produto int(11),
    nome varchar(255),
    preco decimal(10, 2),
    quantidade int(11),
    subtotal decimal(10,2),
    total decimal(10,2),
    PRIMARY KEY (cod_pedido)
);

INSERT INTO Categoria (cod_categoria, descricao)
VALUES (
1, 'Acessórios'
), (
2, 'Notebooks'
), (
3, 'Roteadores'
), (
4, 'Cabos'
), (
5, 'Fones'
);

INSERT INTO Produto (cod_produto, nome, descricao, imagem, preco, categoria)
VALUES (
10, 'Mouse Logitech M170', 'Mouse Logitech M170 Wireless Preto', 'mouse.jpg', '61,36', 'Acessórios'
), (
11, 'Notebook Vaio FE15', 'Notebook Vaio FE15, Intel Core i5, 8GB RAM, HD 1TB, Tela LCD 15.6" HD, Windows 10 - Chumbo Escuro', 'vaio.jpg', '3999', 'Notebooks'
), (
12, 'Notebook Acer ASPIRE 3', 'Notebook Acer ASPIRE 3 A315-34-C6ZS Intel Celeron N4000 4GB RAM 1TB HD 15,6 Endless OS', 'acer.jpg', '3509', 'Notebooks'
), (
13, 'TP-Link AC 1350 Archer C60', 'TP-Link AC 1350 Archer C60 Roteador Wireless Dual Band', 'roteador.jpg', '279,99', 'Roteadores'
), (
14, 'CABO REDE CAT.5E 2.5M', 'CABO REDE CAT.5E 2.5M PC-ETHU25BL PATCH CORD, Plus Cable', 'cabo.jpg', '9,90', 'Cabos'
), (
15, 'WebCam Logitech C270', 'WebCam Logitech C270 HD com 3 MP para Chamadas e Gravações em Vídeo Widescreen 720p', 'cam.jpg', '404,23', 'Acessórios'
), (
16, 'Headset Gamer HyperX', 'Headset Gamer HyperX Cloud Stinger Core PS4/Xbox One/Nintendo Switch', 'headphone.jpg', '369', 'Fones'
);


1 - Descompactar o .ZIP na pasta wwww do servidor Apache

2 - Abrir e Configurar o arquivo em ../backend/conexao.php a conexao com Banco de dados:
Server, User, Password (pass)

CREATE TABLE administrador (
    admi_id INT AUTO_INCREMENT PRIMARY KEY,
    admi_cpf VARCHAR(20) UNIQUE,
    admi_email VARCHAR(100) UNIQUE,
    admi_nome VARCHAR(100) NOT NULL
);

CREATE TABLE categoria (
    cate_id INT AUTO_INCREMENT PRIMARY KEY,
    cate_nome VARCHAR(100) NOT NULL
);

CREATE TABLE cliente (
    cli_id INT AUTO_INCREMENT PRIMARY KEY,
    cli_nome VARCHAR(100) NOT NULL,
    cli_endereco VARCHAR(100) NOT NULL,
    cli_cpf VARCHAR(20) UNIQUE NOT NULL,
    cli_cep INT NOT NULL,
    cli_email VARCHAR(150) UNIQUE NOT NULL,
    cli_senha VARCHAR(64) NOT NULL
);

CREATE TABLE pedido (
    pedi_id INT AUTO_INCREMENT PRIMARY KEY,
    pedi_dt_hr DATETIME NOT NULL,
    cli_id INT,
    FOREIGN KEY (cli_id) REFERENCES cliente(cli_id)
);

CREATE TABLE produto (
    prod_id INT AUTO_INCREMENT PRIMARY KEY,
    prod_nome VARCHAR(100) NOT NULL,
    prod_preco DECIMAL(10,2) NOT NULL,
    prod_descricao TEXT NOT NULL,
    cate_id INT NOT NULL,
    FOREIGN KEY (cate_id) REFERENCES categoria(cate_id)
);

CREATE TABLE pedido_produto (
    pedi_id INT,
    prod_id INT,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (pedi_id, prod_id),
    FOREIGN KEY (pedi_id) REFERENCES pedido(pedi_id),
    FOREIGN KEY (prod_id) REFERENCES produto(prod_id)
);

CREATE TABLE venda (
    vend_id INT AUTO_INCREMENT PRIMARY KEY,
    pedi_id INT,
    vend_dt_hr TIMESTAMP NOT NULL,
    vend_vlr_total DECIMAL(10,2) NOT NULL,
    admi_id INT,
    FOREIGN KEY (pedi_id) REFERENCES pedido(pedi_id),
    FOREIGN KEY (admi_id) REFERENCES administrador(admi_id)
);
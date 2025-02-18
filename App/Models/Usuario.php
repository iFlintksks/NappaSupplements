<?php

class Usuario
{
    private $db; // Conexão com o banco de dados

    public function __construct()
    {
        // Inicializa a conexão com o banco de dados
        $this->db = new Database;
    }

    /**
     * Cadastra um novo cliente no banco de dados.
     *
     * @param array $dados Dados do cliente (nome, endereço, CPF, CEP, email, senha).
     * @return bool Retorna true se o cadastro for bem-sucedido, caso contrário, false.
     */

    public function armazenar($dados)
    {
        // Prepara a query SQL
        $this->db->query("
            INSERT INTO cliente (cli_nome, cli_endereco, cli_cpf, cli_cep, cli_email, cli_senha)
            VALUES (:cli_nome, :cli_endereco, :cli_cpf, :cli_cep, :cli_email, :cli_senha)
        ");

        // Vincula os valores aos parâmetros da query
        $this->db->bind(':cli_nome', $dados['cli_nome']);
        $this->db->bind(':cli_endereco', $dados['cli_endereco']);
        $this->db->bind(':cli_cpf', $dados['cli_cpf']);
        $this->db->bind(':cli_cep', $dados['cli_cep']);
        $this->db->bind(':cli_email', $dados['cli_email']);
        $this->db->bind(':cli_senha', $dados['cli_senha']);

        // Executa a query e retorna true se for bem-sucedida
        return $this->db->executa();
    }

    /**
     * Verifica se um email já está cadastrado no banco de dados.
     *
     * @param string $email Email a ser verificado.
     * @return bool Retorna true se o email já estiver cadastrado, caso contrário, false.
     */

    public function checarEmail($email)
    {
        // Prepara a query SQL
        $this->db->query("SELECT cli_id FROM cliente WHERE cli_email = :cli_email");

        // Vincula o valor do email ao parâmetro da query
        $this->db->bind(':cli_email', $email);

        // Executa a query e retorna true se encontrar um registro
        return $this->db->resultado() ? true : false;
    }

    /**
     * Verifica as credenciais de login do cliente.
     *
     * @param string $email Email do cliente.
     * @param string $senha Senha do cliente.
     * @return object|bool Retorna os dados do cliente se o login for bem-sucedido, caso contrário, false.
     */

    public function checarLogin($email, $senha)
    {
        // Prepara a query SQL
        $this->db->query("SELECT * FROM cliente WHERE cli_email = :cli_email");

        // Vincula o valor do email ao parâmetro da query
        $this->db->bind(':cli_email', $email);

        // Executa a query e obtém o resultado
        $cliente = $this->db->resultado();

        // Verifica se o cliente foi encontrado e se a senha está correta
        if ($cliente && password_verify($senha, $cliente->cli_senha)) {
            return $cliente; // Retorna os dados do cliente
        }

        return false; // Retorna false se o login falhar
    }
}
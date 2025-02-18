<?php

class Usuarios extends Controller
{
    public function __construct()
    {
        // Carrega o modelo de cliente (usuário)
        $this->clienteModel = $this->model('Usuario');
    }

    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($formulario)) :
            $dados = [
                'cli_nome' => trim($formulario['cli_nome']),
                'cli_endereco' => trim($formulario['cli_endereco']),
                'cli_cpf' => trim($formulario['cli_cpf']),
                'cli_cep' => trim($formulario['cli_cep']),
                'cli_email' => trim($formulario['cli_email']),
                'cli_senha' => trim($formulario['cli_senha']),
                'confirma_senha' => trim($formulario['confirma_senha']),
            ];

            // Verifica se algum campo está vazio
            if (in_array("", $formulario)) :
                if (empty($formulario['cli_nome'])) :
                    $dados['nome_erro'] = 'Preencha o campo nome';
                endif;

                if (empty($formulario['cli_endereco'])) :
                    $dados['endereco_erro'] = 'Preencha o campo endereço';
                endif;

                if (empty($formulario['cli_cpf'])) :
                    $dados['cpf_erro'] = 'Preencha o campo CPF';
                endif;

                if (empty($formulario['cli_cep'])) :
                    $dados['cep_erro'] = 'Preencha o campo CEP';
                endif;

                if (empty($formulario['cli_email'])) :
                    $dados['email_erro'] = 'Preencha o campo e-mail';
                endif;

                if (empty($formulario['cli_senha'])) :
                    $dados['senha_erro'] = 'Preencha o campo senha';
                endif;

                if (empty($formulario['confirma_senha'])) :
                    $dados['confirma_senha_erro'] = 'Confirme a senha';
                endif;

            else :
                // Validações adicionais
                if (Checa::checarNome($formulario['cli_nome'])) :
                    $dados['nome_erro'] = 'O nome informado é inválido';
                elseif (Checa::checarEmail($formulario['cli_email'])) :
                    $dados['email_erro'] = 'O e-mail informado é inválido';
                elseif ($this->clienteModel->checarEmail($formulario['cli_email'])) :
                    $dados['email_erro'] = 'O e-mail informado já está cadastrado';
                elseif (strlen($formulario['cli_senha']) < 6) :
                    $dados['senha_erro'] = 'A senha deve ter no mínimo 6 caracteres';
                elseif ($formulario['cli_senha'] != $formulario['confirma_senha']) :
                    $dados['confirma_senha_erro'] = 'As senhas são diferentes';
                else :
                    // Cria o hash da senha
                    $dados['cli_senha'] = password_hash($formulario['cli_senha'], PASSWORD_DEFAULT);

                    // Armazena o cliente no banco de dados
                    if ($this->clienteModel->armazenar($dados)) :
                        Sessao::mensagem('cliente', 'Cadastro realizado com sucesso');
                        URL::redirecionar('usuarios/login');
                    else :
                        die("Erro ao armazenar cliente no banco de dados");
                    endif;
                endif;
            endif;
        else :
            // Dados iniciais do formulário
            $dados = [
                'cli_nome' => '',
                'cli_endereco' => '',
                'cli_cpf' => '',
                'cli_cep' => '',
                'cli_email' => '',
                'cli_senha' => '',
                'confirma_senha' => '',
                'nome_erro' => '',
                'endereco_erro' => '',
                'cpf_erro' => '',
                'cep_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => '',
            ];
        endif;

        // Carrega a view de cadastro
        $this->view('usuarios/cadastrar', $dados);
    }

    public function login()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($formulario)) :
            $dados = [
                'cli_email' => trim($formulario['cli_email']),
                'cli_senha' => trim($formulario['cli_senha']),
                'email_erro' => '',
                'senha_erro' => '',
            ];
    
            // Verifica se algum campo está vazio
            if (in_array("", $formulario)) :
                if (empty($formulario['cli_email'])) :
                    $dados['email_erro'] = 'Preencha o campo e-mail';
                endif;
    
                if (empty($formulario['cli_senha'])) :
                    $dados['senha_erro'] = 'Preencha o campo senha';
                endif;
            else :
                // Verifica se o e-mail é válido
                if (Checa::checarEmail($formulario['cli_email'])) :
                    $dados['email_erro'] = 'O e-mail informado é inválido';
                else :
                    // Verifica o login do cliente
                    $cliente = $this->clienteModel->checarLogin($formulario['cli_email'], $formulario['cli_senha']);
    
                    if ($cliente) :
                        // Cria a sessão do usuário
                        $this->criarSessaoUsuario($cliente);
                        Sessao::mensagem('usuario', 'Login realizado com sucesso!', 'alert alert-success');
                        URL::redirecionar('posts'); // Redireciona para a página inicial
                    else :
                        Sessao::mensagem('usuario', 'E-mail ou senha inválidos', 'alert alert-danger');
                    endif;
                endif;
            endif;
        else :
            // Dados iniciais do formulário
            $dados = [
                'cli_email' => '',
                'cli_senha' => '',
                'email_erro' => '',
                'senha_erro' => '',
            ];
        endif;
    
        // Carrega a view de login
        $this->view('usuarios/login', $dados);
    }
    
    private function criarSessaoUsuario($cliente)
    {
        // Armazena os dados do usuário na sessão
        $_SESSION['usuario_id'] = $cliente->cli_id;
        $_SESSION['usuario_nome'] = $cliente->cli_nome;
        $_SESSION['usuario_email'] = $cliente->cli_email;
        // Redireciona para a página inicial
        URL::redirecionar('pagina/home');
    }

    public function sair()
    {
        // Encerra a sessão do cliente
        unset($_SESSION['cliente_id']);
        unset($_SESSION['cliente_nome']);
        unset($_SESSION['cliente_email']);

        session_destroy();

        // Redireciona para a página de login
        URL::redirecionar('usuarios/login');
    }
}
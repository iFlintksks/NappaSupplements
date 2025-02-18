<link rel="stylesheet" type="text/css" href="<?=URL?>/Public/css/cadastro.css"/>
<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Cadastre-se
        </div>
        <div class="card-body">
            <p class="card-text"><small class="text-muted">Preencha o formulário abaixo para fazer seu cadastro</small></p>

            <form name="cadastrar" method="POST" action="<?= URL ?>/usuarios/cadastrar" class="mt-4">
                <!-- Campo Nome -->
                <div class="form-group">
                    <label for="cli_nome">Nome: <sup class="text-danger">*</sup></label>
                    <input type="text" name="cli_nome" id="cli_nome" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>" value="<?= $dados['cli_nome'] ?? '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['nome_erro'] ?? '' ?>
                    </div>
                </div>

                <!-- Campo Endereço -->
                <div class="form-group">
                    <label for="cli_endereco">Endereço: <sup class="text-danger">*</sup></label>
                    <input type="text" name="cli_endereco" id="cli_endereco" class="form-control <?= $dados['endereco_erro'] ? 'is-invalid' : '' ?>" value="<?= $dados['cli_endereco'] ?? '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['endereco_erro'] ?? '' ?>
                    </div>
                </div>

                <!-- Campo CPF -->
                <div class="form-group">
                    <label for="cli_cpf">CPF: <sup class="text-danger">*</sup></label>
                    <input type="text" name="cli_cpf" id="cli_cpf" class="form-control <?= $dados['cpf_erro'] ? 'is-invalid' : '' ?>" value="<?= $dados['cli_cpf'] ?? '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['cpf_erro'] ?? '' ?>
                    </div>
                </div>

                <!-- Campo CEP -->
                <div class="form-group">
                    <label for="cli_cep">CEP: <sup class="text-danger">*</sup></label>
                    <input type="text" name="cli_cep" id="cli_cep" class="form-control <?= $dados['cep_erro'] ? 'is-invalid' : '' ?>" value="<?= $dados['cli_cep'] ?? '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['cep_erro'] ?? '' ?>
                    </div>
                </div>

                <!-- Campo E-mail -->
                <div class="form-group">
                    <label for="cli_email">E-mail: <sup class="text-danger">*</sup></label>
                    <input type="email" name="cli_email" id="cli_email" class="form-control <?= $dados['email_erro'] ? 'is-invalid' : '' ?>" value="<?= $dados['cli_email'] ?? '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['email_erro'] ?? '' ?>
                    </div>
                </div>

                <!-- Campo Senha -->
                <div class="form-group">
                    <label for="cli_senha">Senha: <sup class="text-danger">*</sup></label>
                    <input type="password" name="cli_senha" id="cli_senha" class="form-control <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['senha_erro'] ?? '' ?>
                    </div>
                </div>

                <!-- Campo Confirma Senha -->
                <div class="form-group">
                    <label for="confirma_senha">Confirme a Senha: <sup class="text-danger">*</sup></label>
                    <input type="password" name="confirma_senha" id="confirma_senha" class="form-control <?= $dados['confirma_senha_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['confirma_senha_erro'] ?? '' ?>
                    </div>
                </div>

                <!-- Botão de Cadastro e Link para Login -->
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Cadastrar" class="btn btn-info btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URL ?>/usuarios/login">Você tem uma conta? Faça login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
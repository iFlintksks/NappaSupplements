<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <!-- Exibe mensagens de erro ou sucesso -->
            <?= Sessao::mensagem('usuario') ?>
            <p class="card-text"><small class="text-muted">Faça o seu login no sistema</small></p>

            <!-- Formulário de Login -->
            <form name="logar" method="POST" action="<?= URL ?>/usuarios/login" class="mt-4">
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

                <!-- Botão de Login e Link para Cadastro -->
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Logar" class="btn btn-info btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URL ?>/usuarios/cadastrar">Você não tem uma conta? Faça o seu cadastro</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
class Database
{
    private $host = "localhost"; // Host do banco de dados
    private $usuario = "root"; // Usuário do banco de dados
    private $senha = ""; // Senha do banco de dados
    private $banco = "bd_nappa"; // Nome do banco de dados
    private $porta = "3307"; // Porta do banco de dados (verifique a porta correta)
    private $dbh; // Objeto PDO (conexão com o banco)
    private $stmt; // Statement para executar queries

    public function __construct()
    {
        // Configura a conexão com o banco de dados
        $dns = 'mysql:host=' . $this->host . ';port=' . $this->porta . ';dbname=' . $this->banco;

        $opcoes = [
            // Armazena em cache a conexão para ser reutilizada, evitando sobrecarga de uma nova conexão
            PDO::ATTR_PERSISTENT => true,
            // Lança uma PDOException se ocorrer um erro
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            // Cria a instância do PDO
            $this->dbh = new PDO($dns, $this->usuario, $this->senha, $opcoes);
        } catch (PDOException $error) {
            // Exibe uma mensagem de erro e encerra a execução
            print "Erro ao conectar ao banco de dados: " . $error->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Prepara uma query SQL para execução.
     *
     * @param string $sql Query SQL.
     */
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Vincula um valor a um parâmetro na query.
     *
     * @param string $parametro Nome do parâmetro.
     * @param mixed $valor Valor a ser vinculado.
     * @param int $tipo Tipo de dado (opcional).
     */
    public function bind($parametro, $valor, $tipo = null)
    {
        if (is_null($tipo)) {
            switch (true) {
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                default:
                    $tipo = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($parametro, $valor, $tipo);
    }

    /**
     * Executa a query preparada.
     *
     * @return bool Retorna true se a execução for bem-sucedida, caso contrário, false.
     */
    public function executa()
    {
        return $this->stmt->execute();
    }

    /**
     * Obtém um único registro como objeto.
     *
     * @return object|bool Retorna o registro ou false se não houver resultados.
     */
    public function resultado()
    {
        $this->executa();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Obtém um conjunto de registros como um array de objetos.
     *
     * @return array|bool Retorna os registros ou false se não houver resultados.
     */
    public function resultados()
    {
        $this->executa();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Retorna o número de linhas afetadas pela última instrução SQL.
     *
     * @return int Número de linhas afetadas.
     */
    public function totalResultados()
    {
        return $this->stmt->rowCount();
    }

    /**
     * Retorna o último ID inserido no banco de dados.
     *
     * @return string Último ID inserido.
     */
    public function ultimoIdInserido()
    {
        return $this->dbh->lastInsertId();
    }
}
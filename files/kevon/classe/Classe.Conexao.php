<?php

class ConexaoPDO {
    private static $instance = null; // Armazena a única instância da conexão
    private $pdo; // Objeto PDO

    // Informações de conexão (pode ser configurado via arquivo .env para produção)
    private $dbHost = 'localhost';
    private $dbName = 'estoque';
    private $dbUser = 'root';
    private $dbPass = '';
    private $dbCharset = 'utf8mb4'; // Garante suporte a emojis e caracteres especiais

    // Construtor privado para implementar o padrão Singleton
    private function __construct() {
        $dsn = "mysql:host={$this->dbHost};dbname={$this->dbName};charset={$this->dbCharset}";
        $options = [
            // Lança exceções em caso de erros no banco de dados
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // Retorna os resultados como arrays associativos por padrão
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Desabilita a emulação de prepared statements (melhor para segurança e desempenho)
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            // Em ambiente de produção, registre o erro em um log, não exiba diretamente.
            // Em desenvolvimento, você pode exibir para depuração.
            die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
        }
    }

    // Método estático público para obter a instância da conexão
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new ConexaoPDO();
        }
        return self::$instance;
    }

    // Método para obter o objeto PDO subjacente
    public function getPDO() {
        return $this->pdo;
    }

    // Impede a clonagem da instância (para Singleton)
    private function __clone() {}

    // Impede a desserialização da instância (para Singleton)
    public function __wakeup() {
        throw new Exception("Não é possível desserializar uma conexão Singleton.");
    }
}

?>
<?php
//cria classe com atributos do database
class Database{
    private $host = "localhost";
    private $db_name = "quickbuy";
    private $username = "root";
    private $password = "";
    private $connection;

    //função para criar conexão com o banco de dados
    public function getConnection(){
        $this->connection = null;
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            //caso haja falha ao conectar com o banco de dados
            echo "erro de conxão: " . $e->getMessage();
        }
        return $this->connection;
    } 
}
?>
<?php

require '..\crud_pdo\iDaoModeCrud.php';

 class Pessoa implements iDaoModeCrud {
        private $pdo;
        public function __construct($dsn, $usuario,$senha) 
        {
                try{
                        $this->pdo = new PDO("mysql:dbname=".$dsn, $usuario, $senha);

                }
                catch (PDOException $pdoexception) {
                        echo "Erro com o banco de dados: ".$pdoexception->getMessage();
                        exit();
                }
                catch (Exception $errosgenericos) {
                        echo "Erro com o banco de dados: ".$errosgenericos->getMessage();
                        exit();
                }

        }

        

        //ESSA FUNÇÃO BUSCA OS DADOS:
        public function mostraDados()
        {
                $resposta=array();
                $cmd = $this->pdo->query("SELECT * FROM contatos ORDER BY id");
                $resposta = $cmd->fetchAll(PDO::FETCH_ASSOC);
                return $resposta;
        }
              
              //FUNÇÃO DE CADASTRAR OS DADOS E ADCIONA A LISTA:

        public function create($nome, $telefone, $email)
        {
                $cmd = $this->pdo->prepare("SELECT id FROM contatos WHERE email = :e");
                $cmd->bindValue(":e",$email);
                $cmd->execute();
                if ($cmd->rowCount() > 0){
                        return false;
                } else {
                        $cmd = $this->pdo->prepare("INSERT INTO contatos (nome, telefone, email) VALUES (:n, :t, :e)");
                        $cmd->bindValue(":n",$nome);
                        $cmd->bindValue(":t",$telefone);
                        $cmd->bindValue(":e",$email);
                        $cmd->execute();
                        return true;

                }
        }

              

        public function read($id)
        {
               $resposta = array();
               $cmd = $this->pdo->prepare("SELECT * FROM contatos WHERE id = :id");
               $cmd->bindValue(":id", $id);
               $cmd->execute();
               $resposta = $cmd->fetch(PDO::FETCH_ASSOC);
               return $resposta;
        
}

        public function update($id, $nome, $telefone, $email)
        {
                //comparar emails:
                // $cmd = $this->pdo->prepare("SELECT id FROM contatos WHERE email = :e");
                // $cmd->bindValue(":e",$email);
                // $cmd->execute();
                // if ($cmd->rowCount() > 0){
                //         return false;
                // } else {

                //cadastrar:
                $cmd = $this->pdo->prepare("UPDATE contatos SET nome = :n, telefone = :t, email = :e WHERE id = :id");
                        $cmd->bindValue(":n",$nome);
                        $cmd->bindValue(":t",$telefone);
                        $cmd->bindValue(":e",$email);
                        $cmd->bindValue(":id",$id);
                        $cmd->execute();
                        return true;
                
        }

        public function delete($id)
        {
                $cmd = $this->pdo->prepare("DELETE FROM contatos WHERE id = :id");
                $cmd->bindValue(":id",$id);
                $cmd->execute();
        }


    
 }

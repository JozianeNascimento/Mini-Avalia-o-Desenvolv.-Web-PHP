<?php

class Aluno
{
    private $pdo;
    public function __construct($dbname,$host,$user,$senha)
    {
    try
    {
        $this->pdo = new PDO("mysql:dbname=".$dbname";host=".$host,$user,$senha);
    }
    catch(Exception $e)
    {
        echo "Erro: " .$e->getMessage();
        exit();
    }
    }

    public function buscarDados(){
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM alunos ORDER BY nome");
        $res = $cmd->fetchALL(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarAluno($nome, $telefone,$email,$curso){
        $cmd = $this->pdo->prepare("SELECT id FROM alunos WHERE email = :e");
        $cmd->bindValue(":e",$email);
        $cmd->execute();
        if($cmd->rowCount()>0)
        {
            return false;
        }else
        {
            $cmd = $this->pdo->prepare("INSERT INTO alunos (nome, telefone, email, curso) VALUES (:n,:t,:e, :c)");
            $cmd->bindValue(":n",$nome);
            $cmd->bindValue(":t",$telefone);
            $cmd->bindValue(":n",$email);
            $cmd->bindValue(":n",$curso);
            $cmd->exeute(); 
            return true;
        }

    }

    public function excluirAluno($id){
        $cmd =$this->pdo->prepare("DELETE FROM alunos WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->exeute();
    }



}


?>
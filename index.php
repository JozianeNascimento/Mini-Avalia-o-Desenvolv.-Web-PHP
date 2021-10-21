<?php
require_once 'classe-aluno.php';
$p = new Aluno("CRUDFATEC","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastro Aluno</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php
    if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $curso = addslashes($_POST['curso']);

        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($curso))
        {
            if(!$p->cadastrarAluno($nome, $telefone,$email,$curso)){
            echo "Aluno já cadastrado";
        }
    }
    }

    ?>
    <section id="esquerda">
        <form method="POST">
            <h2>Cadastrar Aluno</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="curso">Curso</label>
            <input type="text" name="curso" id="curso">
            <input type="submit" value="Cadastrar">
        </form>    
    </section>
    <section id="direita">
    <table>
            <tr id="titulo">
                <td>Nome</td>
                <td>Telefone</td>
                <td>Email</td>
                <td colspan="2">Curso</td>
            </tr>
            <tr>
        <?php
            $dados = $p->buscarDados();
            if(count($dados) > 0) {
                for($i=0; $i < count($dados); $i++){
                    echo "<tr>";
                    foreach($dados[$i] as $k =>$v){
                        if($k != "id")
                        {
                            echo "<td>".$v."</td>";
                        }
                    }
                    ?>
                    <td>
                        <a href="index.php?id=<?php echo $dados[$i]['id']; ?>">Excluir</a>
                    </td>
                    <?php
                    echo "</tr";
                }   
            }
        ?></tr>
                
    </table>
    </section>
</body>
</html>

<?php

    if(isset($_GET['id']))
    {
        $id_aluno = addslashes($_GET['id']);
        $p->excluirAluno($id_aluno);
        header("location: index.php");
    }

?>

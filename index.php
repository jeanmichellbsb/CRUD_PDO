<?php
header('Content-Type: text/html; charset=utf-8',true);
spl_autoload_register (function ($classe) {
if(file_exists( "$classe.php" )) {
          include_once "$classe.php";
       } else {
          echo "O arquivo $classe.php da classe $classe não foi encontrado";
       }
    }
);

$p = new Pessoa('mysql:host=localhost;dbname=exemplocrud', 'root', 'INSIRA SUA SENHA');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Cadastro Pessoal</title>
	<link rel="stylesheet" href="estilo.css">
</head>

<body>
	<div id="pagina">
	<?php
	if (isset($_POST['nome'])) //funciona se clicar em cadastrar OU editar
	{
		//botão editar clicado:
		if (isset($_GET['id_up']) && !empty($_GET['id_up'])) 
		{
			$id_upd=addslashes($_GET['id_up']);
			$nome = addslashes($_POST['nome']);
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		if (!empty($nome) && !empty($telefone) && !empty($email)) {
			//editar:
			$p->update($id_upd, $nome, $telefone, $email);   
			// {
			// 	echo "Email já cadastrado!";
			// }
		} else {
			echo "Preencha todos os campos";
		}
		} ///botão cadastrar clicado:
		else {
			$nome = addslashes($_POST['nome']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			if (!empty($nome) && !empty($telefone) && !empty($email)) {
				//cadastrar
				if (!$p->create($nome, $telefone, $email)) {
					echo "Email já cadastrado!";
				}
			} else {
				echo "Preencha todos os campos";
			}
		}
	}
	?>

	<?php
	if (isset($_GET['id_up'])) //funciona se clicar em editar!
	{
		$id_update = addslashes($_GET['id_up']);

		$resposta = $p->read($id_update);
	}
	?>
		<div id="top">
			<section id="esquerda">
				<form method="POST">
					<h2>CADASTRAR PESSOA</h2><br>

					<label for="nome">NOME</label>
					<input type="text" name="nome" id="nome" value="<?php if (isset($resposta)) {
										echo $resposta['NOME'];
									} ?>"><br>
					<label for="telefone">TELEFONE</label>
					<input type="text" name="telefone" id="telefone" value="<?php if (isset($resposta)) {
										echo $resposta['TELEFONE'];
									} ?>"><br>
					<label for="email">EMAIL</label>
					<input type="text" name="email" id="email" value="<?php if (isset($resposta)) {
										echo $resposta['EMAIL'];
									} ?>"><br>
					<input type="submit" value="<?php if (isset($resposta)) {
								echo "Atualizar";
							} else {
								echo "Cadastrar";
							} ?>">
				</form>
			</section>
		</div>
		<div id="bottom">
			<section id="direita">
				<table>
					<tr id=titulo>
						<td>Cadastro</td>
						<td>Nome</td>
						<td>Telefone</td>
						<td colspan="2">Email</td>
					</tr>

					<?php
					$dados = $p->mostraDados();
					if (count($dados) > 0) {
						for ($i = 0; $i < count($dados); $i++) {
							echo "<tr>";
							foreach ($dados[$i] as $k => $v) {
								echo "<td>" . $v . "</td>";
							}
					?><td><a href="index.php?id_up=<?php echo $dados[$i]['ID']; ?>">Editar</a>
								<a href="index.php?id=<?php echo $dados[$i]['ID']; ?>">Excluir</a>
						<?php
							echo "</tr>";
						}
					}
						?>


				</table>
			</section>
		</div>
	</div>
</body>

</html>
<?php
if (isset($_GET['id'])) {
	$id_pessoa = addslashes($_GET['id']);
	$p->delete($id_pessoa);
	header("location: index.php");
}
?>

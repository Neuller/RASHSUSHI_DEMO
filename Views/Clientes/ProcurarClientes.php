<!-- VERIFICA SESSÃO LOGADA -->
<?php
session_start();
if (isset($_SESSION['User'])) {
?>

<!DOCTYPE html>
<html>
	<body>
		<div class="tblClientes container">
			<div class="cabecalho bgGradient">
				<div class="text-center textCabecalho_White opacidade">
					<h3><strong>PROCURAR CLIENTES</strong></h3>
				</div>
			</div>
			<!-- TABELA DE CLIENTES -->
			<div class="row">
				<div class="col-sm-12" align="center">
					<div id="tabelaClientes"></div>
				</div>
			</div>
		</div>

		<!-- MODAL EDITAR CLIENTE -->
		<div id="modalEditarCliente"></div>
		<!-- MODAL VISUALIZAR CLIENTE -->
		<div id="modalVisualizarCliente"></div>

	</body>	
</html>

<script type="text/javascript">
	$(document).ready(function($) {
		$('#tabelaClientes').load('./Views/Clientes/TabelaClientes.php');
		$('#modalEditarCliente').load('./Views/Clientes/ModalEditarCliente.php');
		$('#modalVisualizarCliente').load('./Views/Clientes/ModalVisualizarCliente.php');
	});

		// PREENCHER MODAL DE EDIÇÂO
		function adicionarDadosEditar(idCliente) {
			$.ajax({
				type: "POST",
				data: "idCliente=" + idCliente,
				url: "./Procedimentos/Clientes/ObterDadosCliente.php",
				success: function(r) {
					dado = jQuery.parseJSON(r);
					$('#idclienteU').val(dado['id_cliente']);
					$('#nomeU').val(dado['nome']);
					$('#cpfU').val(dado['cpf']);
					$('#cnpjU').val(dado['cnpj']);
					$('#cepU').val(dado['cep']);
					$('#bairroU').val(dado['bairro']);
					$('#ufU').val(dado['uf']);
					$('#enderecoU').val(dado['endereco']);
					$('#numeroU').val(dado['numero']);
					$('#complementoU').val(dado['complemento']);
					$('#telefoneU').val(dado['telefone']);
					$('#telefone2U').val(dado['telefone2']);
					$('#celularU').val(dado['celular']);
					$('#celular2U').val(dado['celular2']);
					$('#emailU').val(dado['email']);
				}
			});
		}
		// PREENCHER MODAL DE VISUALIZAÇÃO
		function adicionarDadosVisualizar(idCliente) {
			$.ajax({
				type: "POST",
				data: "idCliente=" + idCliente,
				url: "./Procedimentos/Clientes/ObterDadosCliente.php",
				success: function(r) {
					dado = jQuery.parseJSON(r);
					$('#idclienteView').val(dado['ID_Cliente']);
					$('#nomeView').val(dado['Nome']);
					$('#cpfView').val(dado['CPF']);
					$('#cnpjView').val(dado['CNPJ']);
					$('#cepView').val(dado['CEP']);
					$('#bairroView').val(dado['Bairro']);
					$('#enderecoView').val(dado['Endereco']);
					$('#numeroView').val(dado['Numero']);
					$('#complementoView').val(dado['Complemento']);
					$('#telefoneView').val(dado['Telefone']);
					$('#celularView').val(dado['Celular']);
					$('#emailView').val(dado['Email']);
				}
			});
		}
		// FUNÇÃO EXCLUIR
		function excluirCliente(idCliente) {
			alertify.confirm('ATENÇÃO', 'DESEJA EXCLUIR O REGISTRO?', function() {
				$.ajax({
					type: "POST",
					data: "idCliente=" + idCliente,
					url: "./Procedimentos/Clientes/ExcluirClientes.php",
					success: function(r) {
						if (r == 1) {
							$('#tabelaClientes').load("./Views/Clientes/TabelaClientes.php");
							alertify.success("REGISTRO EXCLUÍDO");
						} else {
							alertify.error("NÃO FOI POSSÍVEL EXCLUIR");
						}
					}
				});
			}, function() {
				alertify.error('OPERAÇÃO CANCELADA')
			});
		}
	</script>

	<style>
		.mb-20px {
			margin-bottom: 20px;
		}

		.mb-15px {
			margin-bottom: 15px;
		}

		.cabecalho {
			margin-bottom: 25px;
		}
	</style>
<?php
} else {
	header("location:./index.php");
}
?>
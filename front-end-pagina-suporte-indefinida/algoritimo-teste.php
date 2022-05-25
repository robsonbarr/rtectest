		<?php

			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				if($nome == ''){
					Painel::alert('erro','O campo nome não pode ficar vázio!');
				}else{
					//Apenas cadastrar no banco de dados!
					$verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ?");
					$verificar->execute(array($_POST['nome']));
					if($verificar->rowCount() == 0){
					$slug = Painel::generateSlug($nome);

					$arr = ['nome'=>$nome,'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'tb_site.categorias'];
					Painel::insert($arr);
					Painel::alert('sucesso','O cadastro da categoria foi realizado com sucesso!');
					}else{
						Painel::alert("erro",'Já existe uma categoria com este nome!');
					}
				}
				
			}
		?>
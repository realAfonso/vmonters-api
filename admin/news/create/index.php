<head>
	<title>Admin</title>
	<meta charset="utf-8">
</head>
<body>
	<form method="POST" action="_submit.php" enctype="multipart/form-data">
		
		<label>Name</label>
		<input type="text" name="title" placeholder="Nome">
		<br><br>
		<label>Description</label><br>
		<textarea name="description" maxlength="500" rows="5" style="width: 500px;"></textarea> 
		<br><br>
		<label>Imagem da loja</label>
		<input type="file" name="simage">
		<br><br>
		<label>Imagem da tela de novidades</label>
		<input type="file" name="nimage">
		<br><br>
		<label>Cor de fundo da tela de novidades:</label>
		<input type="text" name="color" value="#FFFFFF">
		<br><br>
		<label>Data de início:</label>
		<input type="text" name="start" value="00:00 <?=date('m/d/Y')?>">
		<br><br>
		<label>Data de término:</label>
		<input type="text" name="end" value="23:59 <?=date('m/d/Y')?>">
		<br><br>
		<label>Aparecer na loja?</label>
		<select name="showOnStore">
			<option value="1">SIM</option>
			<option value="0">NÃO</option>
		</select>
		<br><br>
		<input type="submit" name="CADASTRAR">
	</form>
</body>
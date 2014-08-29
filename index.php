<?php
require_once 'app/init.php';
$itemQuery=$db->prepare("SELECT id,name,done FROM items where user= :user");

$itemQuery->execute([
	'user'=>$_SESSION['user_id']
	]);

$items=$itemQuery->rowCount() ? $itemQuery : [];

//foreach($items as $item){
//	echo $item['name'], '<br>';	
//}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charst="UTF-8">
	<title>To do Lista</title>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="list">
	<h1 class="header">To do.</h1>
	<?php if(!empty($items)){ ?>
	<ul class="items">
	<?php foreach($items as $item){ ?>
		<li>
			<span class="item<?=$item['done']?' done' : ''?>"><?=$item['name']?></span>
			<?php
			if(!$item['done']){
			?>
			<a href="#" class="done-buttom">Feito</a>
			<?php } ?>
		</li>
	<?php } ?> 
	</ul>
	<?php } else{ ?>
	<P>VOCE AINDA NAO ADICIONOU NENHUM ITEM AINDA.</P>
	<?php } ?>

	<form class="item-add" action="add.php" method="post">
		<input type="text" name="name" placeholder="Digite um novo item aqui." class="input" autocomplete="off" required />
		<input type="submit" value="Adicionar" class="submit">
	</form>
</body>
</html>

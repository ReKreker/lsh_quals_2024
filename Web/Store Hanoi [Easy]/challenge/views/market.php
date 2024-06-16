<?php include '../views/layouts/header.php' ?>
<?php include '../views/layouts/menu.php' ?>
		<div class="pure-g">
			<div class="pure-u-1-3"></div>
			<div class="pure-u-1-3 text-center">
				<h1>Market</h1>
				<p>Hello <?= $user->username ?>, your balance is $<?= $user->balance ?>.</p>				
				<div id="items">
				<?php
				include '../models/item.php';
				foreach (Item::listAll() as $item):
				?>	
					<div class="pure-u-1-4 item">
						<div class="name"><strong><?=$item->name?></strong></div>
						<div class=" price">Price: <strong>$<?=$item->price?></strong></div>
						<?php if (!in_array($item->id, $user->purchasedItems)):?>
						<a class="pure-button pure-button-primary" href="/?action=buy&id=<?= $item->id ?>">Purchase</a> 
						<?php else: ?> 
							<p class="content"><?= $item->content ?></pre> 
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
			
		</div>
<?php include '../views/layouts/footer.php' ?>
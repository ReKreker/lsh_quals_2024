<?php include '../views/layouts/header.php' ?>
<?php include '../views/layouts/menu.php' ?>
		<div class="pure-g">
			<div class="pure-u-1-3"></div>
			<div class="pure-u-1-3 text-center">				
				<h1>Transfer</h1>
				<?php if (isset($transferred)): ?>
				<p class="transfer-message"><?= $transferred ?></p>
				<?php endif ?>
				<form class="pure-form pure-form-aligned" method="POST" action="/?action=transfer">
					<fieldset>
						<div class="pure-control-group">
							<label>Amount</label>
							<input type="number" name="amount" min="0" />
						</div>
						<div class="pure-control-group">
							<label>Recipient</label>
							<input type="text" name="recipient" />
						</div>
						<div class="pure-controls">
							<button class="pure-button pure-button-primary" type="submit">Transfer</button>							
						</div>
					</fieldset>					
				</form>
			</div>
		</div>
<?php include '../views/layouts/footer.php' ?>
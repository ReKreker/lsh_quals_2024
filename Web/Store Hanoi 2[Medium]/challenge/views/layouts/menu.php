
<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Libra Dnuf</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="/" class="pure-menu-link">Market</a></li>
            <li class="pure-menu-item"><a href="/?action=transfer" class="pure-menu-link">Transfer</a></li>            
            <li class="pure-menu-item"><a href="/?action=logout" class="pure-menu-link">Logout</a></li>
            <?php if ($user->id ==1): ?>
            <li class="pure-menu-item"><a href="/?action=rollback" class="pure-menu-link" style="color: #e74c3c">Rollback</a></li>
        	<?php endif; ?>
        </ul>
    </div>
</div>
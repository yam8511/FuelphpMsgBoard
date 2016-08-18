<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "register" ); ?>'><?php echo Html::anchor('account/register','Register');?></li>
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('account/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('account/logout','Logout');?></li>

</ul>
<p>Logout</p>
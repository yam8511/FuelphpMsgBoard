<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "add" ); ?>'><?php echo Html::anchor('reply/add','Add');?></li>
	<li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('reply/edit','Edit');?></li>
	<li class='<?php echo Arr::get($subnav, "delete" ); ?>'><?php echo Html::anchor('reply/delete','Delete');?></li>

</ul>
<p>Edit</p>
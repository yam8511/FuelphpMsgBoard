<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('msgboard/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "add" ); ?>'><?php echo Html::anchor('msgboard/add','Add');?></li>
	<li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('msgboard/edit','Edit');?></li>
	<li class='<?php echo Arr::get($subnav, "delete" ); ?>'><?php echo Html::anchor('msgboard/delete','Delete');?></li>
	<li class='<?php echo Arr::get($subnav, "belong" ); ?>'><?php echo Html::anchor('msgboard/belong','Belong');?></li>
	<li class='<?php echo Arr::get($subnav, "view" ); ?>'><?php echo Html::anchor('msgboard/view','View');?></li>

</ul>
<p>View</p>
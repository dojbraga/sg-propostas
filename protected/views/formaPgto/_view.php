<?php
/* @var $this FormaPgtoController */
/* @var $data FormaPgto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pgto')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pgto); ?>
	<br />


</div>
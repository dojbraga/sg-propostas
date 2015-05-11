<?php
/* @var $this CatalogoServicoController */
/* @var $data CatalogoServico */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servico')); ?>:</b>
	<?php echo CHtml::decode($data->servico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horas')); ?>:</b>
	<?php echo CHtml::encode($data->horas); ?>
	<br />


</div>
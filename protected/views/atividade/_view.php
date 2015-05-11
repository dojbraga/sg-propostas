<?php
/* @var $this AtividadeController */
/* @var $data Atividade */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_atividade')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_atividade), array('view', 'id'=>$data->id_atividade)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proposta')); ?>:</b>
	<?php echo CHtml::encode($data->id_proposta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('atividade')); ?>:</b>
	<?php echo CHtml::encode($data->atividade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_horaria')); ?>:</b>
	<?php echo CHtml::encode($data->carga_horaria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_execucao')); ?>:</b>
	<?php echo CHtml::encode($data->data_execucao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_consultor')); ?>:</b>
	<?php echo CHtml::encode($data->id_consultor); ?>
	<br />


</div>
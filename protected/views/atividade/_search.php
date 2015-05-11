<?php
/* @var $this AtividadeController */
/* @var $model Atividade */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_atividade'); ?>
		<?php echo $form->textField($model,'id_atividade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_proposta'); ?>
		<?php echo $form->textField($model,'id_proposta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'atividade'); ?>
		<?php echo $form->textField($model,'atividade',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carga_horaria'); ?>
		<?php echo $form->textField($model,'carga_horaria',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_execucao'); ?>
		<?php echo $form->textField($model,'data_execucao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_consultor'); ?>
		<?php echo $form->textField($model,'id_consultor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
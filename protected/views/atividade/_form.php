<?php
/* @var $this AtividadeController */
/* @var $model Atividade */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atividade-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_proposta'); ?>
		<?php echo $form->textField($model,'id_proposta'); ?>
		<?php echo $form->error($model,'id_proposta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'atividade'); ?>
		<?php echo $form->textField($model,'atividade',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'atividade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_horaria'); ?>
		<?php echo $form->textField($model,'carga_horaria',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'carga_horaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_execucao'); ?>
		<?php echo $form->textField($model,'data_execucao'); ?>
		<?php echo $form->error($model,'data_execucao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_consultor'); ?>
		<?php echo $form->textField($model,'id_consultor'); ?>
		<?php echo $form->error($model,'id_consultor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
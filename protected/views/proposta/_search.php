<?php
/* @var $this PropostaController */
/* @var $model Proposta */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chamado'); ?>
		<?php echo $form->textField($model,'chamado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cliente'); ?>
		<?php echo $form->textField($model,'cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'solicitante'); ?>
		<?php echo $form->textField($model,'solicitante'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consultor_negocio'); ?>
		<?php echo $form->textField($model,'consultor_negocio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_situacao'); ?>
		<?php echo $form->textField($model,'id_situacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'objetivo_tecnico'); ?>
		<?php echo $form->textField($model,'objetivo_tecnico',array('size'=>-1,'maxlength'=>-1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vlr_investimento'); ?>
		<?php echo $form->textField($model,'vlr_investimento',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_forma_pgto'); ?>
		<?php echo $form->textField($model,'id_forma_pgto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vlr_desconto'); ?>
		<?php echo $form->textField($model,'vlr_desconto',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dt_envio'); ?>
		<?php echo $form->textField($model,'dt_envio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dt_validade'); ?>
		<?php echo $form->textField($model,'dt_validade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observacoes'); ?>
		<?php echo $form->textArea($model,'observacoes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
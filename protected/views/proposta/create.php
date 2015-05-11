<?php
/* @var $this PropostaController */
/* @var $model Proposta */

$this->breadcrumbs=array(
	'Proposta'=>array('index'),
	'Cadastrar Proposta',
);

$this->menu=array(
	array('label'=>'Listar Proposta', 'url'=>array('index')),
	array('label'=>'Gerenciar Proposta', 'url'=>array('admin')),
);
?>

<h1>Cadastro de Proposta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
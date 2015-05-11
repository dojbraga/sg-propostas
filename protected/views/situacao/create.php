<?php
/* @var $this SituacaoController */
/* @var $model Situacao */

$this->breadcrumbs=array(
	'Situacaos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Situacao', 'url'=>array('index')),
	array('label'=>'Manage Situacao', 'url'=>array('admin')),
);
?>

<h1>Create Situacao</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this AtividadeController */
/* @var $model Atividades */

$this->breadcrumbs=array(
	'Atividade'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Atividade', 'url'=>array('index')),
	array('label'=>'Manage Atividade', 'url'=>array('admin')),
);
?>

<h1>Create Atividade</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
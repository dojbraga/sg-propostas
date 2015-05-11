<?php
/* @var $this FormaPgtoController */
/* @var $model FormaPgto */

$this->breadcrumbs=array(
	'Forma Pgtos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FormaPgto', 'url'=>array('index')),
	array('label'=>'Manage FormaPgto', 'url'=>array('admin')),
);
?>

<h1>Create FormaPgto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
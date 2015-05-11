<?php
/* @var $this ConsultorController */
/* @var $model Consultor */

$this->breadcrumbs=array(
	'Consultors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Consultor', 'url'=>array('index')),
	array('label'=>'Manage Consultor', 'url'=>array('admin')),
);
?>

<h1>Create Consultor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
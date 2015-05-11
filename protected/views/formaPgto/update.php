<?php
/* @var $this FormaPgtoController */
/* @var $model FormaPgto */

$this->breadcrumbs=array(
	'Forma Pgtos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FormaPgto', 'url'=>array('index')),
	array('label'=>'Create FormaPgto', 'url'=>array('create')),
	array('label'=>'View FormaPgto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FormaPgto', 'url'=>array('admin')),
);
?>

<h1>Update FormaPgto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
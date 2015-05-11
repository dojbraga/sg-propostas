<?php
/* @var $this FormaPgtoController */
/* @var $model FormaPgto */

$this->breadcrumbs=array(
	'Forma Pgtos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FormaPgto', 'url'=>array('index')),
	array('label'=>'Create FormaPgto', 'url'=>array('create')),
	array('label'=>'Update FormaPgto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FormaPgto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FormaPgto', 'url'=>array('admin')),
);
?>

<h1>View FormaPgto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'forma_pgto',
	),
)); ?>

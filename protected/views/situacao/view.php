<?php
/* @var $this SituacaoController */
/* @var $model Situacao */

$this->breadcrumbs=array(
	'Situacaos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Situacao', 'url'=>array('index')),
	array('label'=>'Create Situacao', 'url'=>array('create')),
	array('label'=>'Update Situacao', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Situacao', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Situacao', 'url'=>array('admin')),
);
?>

<h1>View Situacao #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descricao',
	),
)); ?>

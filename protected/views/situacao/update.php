<?php
/* @var $this SituacaoController */
/* @var $model Situacao */

$this->breadcrumbs=array(
	'Situacaos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Situacao', 'url'=>array('index')),
	array('label'=>'Create Situacao', 'url'=>array('create')),
	array('label'=>'View Situacao', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Situacao', 'url'=>array('admin')),
);
?>

<h1>Update Situacao <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
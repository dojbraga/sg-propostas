<?php
/* @var $this ConsultorController */
/* @var $model Consultor */

$this->breadcrumbs=array(
	'Consultors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Consultor', 'url'=>array('index')),
	array('label'=>'Create Consultor', 'url'=>array('create')),
	array('label'=>'View Consultor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Consultor', 'url'=>array('admin')),
);
?>

<h1>Update Consultor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this AtividadeController */
/* @var $model Atividade */

$this->breadcrumbs=array(
	'Atividade'=>array('index'),
	$model->id_atividade=>array('view','id'=>$model->id_atividade),
	'Update',
);

$this->menu=array(
	array('label'=>'List Atividade', 'url'=>array('index')),
	array('label'=>'Create Atividade', 'url'=>array('create')),
	array('label'=>'View Atividade', 'url'=>array('view', 'id'=>$model->id_atividade)),
	array('label'=>'Manage Atividade', 'url'=>array('admin')),
);
?>

<h1>Update Atividade <?php echo $model->id_atividade; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
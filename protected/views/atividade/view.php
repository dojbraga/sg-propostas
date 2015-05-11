<?php
/* @var $this AtividadesController */
/* @var $model Atividades */

$this->breadcrumbs=array(
	'Atividades'=>array('index'),
	$model->id_atividade,
);

$this->menu=array(
	array('label'=>'List Atividades', 'url'=>array('index')),
	array('label'=>'Create Atividades', 'url'=>array('create')),
	array('label'=>'Update Atividades', 'url'=>array('update', 'id'=>$model->id_atividade)),
	array('label'=>'Delete Atividades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_atividade),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Atividades', 'url'=>array('admin')),
);
?>

<h1>View Atividades #<?php echo $model->id_atividade; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_atividade',
		'id_proposta',
		'atividade',
		'carga_horaria',
		'data_execucao',
		'id_consultor',
	),
)); ?>

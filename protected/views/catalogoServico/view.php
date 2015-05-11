<?php
/* @var $this CatalogoServicoController */
/* @var $model CatalogoServico */

$this->breadcrumbs=array(
	'Catalogo Servico'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CatalogoServico', 'url'=>array('index')),
	array('label'=>'Create CatalogoServico', 'url'=>array('create')),
	array('label'=>'Update CatalogoServico', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CatalogoServico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatalogoServico', 'url'=>array('admin')),
);
?>

<h1>View CatalogoServico #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'servico',
		'horas',
	),
)); ?>

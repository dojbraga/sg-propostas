<?php
/* @var $this CatalogoServicoController */
/* @var $model CatalogoServico */

$this->breadcrumbs=array(
	'Catalogo Servico'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatalogoServico', 'url'=>array('index')),
	array('label'=>'Create CatalogoServico', 'url'=>array('create')),
	array('label'=>'View CatalogoServico', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CatalogoServico', 'url'=>array('admin')),
);
?>

<h1>Update Catalogo Serviços <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
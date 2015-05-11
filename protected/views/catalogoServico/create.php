<?php
/* @var $this CatalogoServicoController */
/* @var $model CatalogoServico */

$this->breadcrumbs=array(
	'Catalogo Servico'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatalogoServico', 'url'=>array('index')),
	array('label'=>'Manage CatalogoServico', 'url'=>array('admin')),
);
?>

<h1>Create CatalogoServiços</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
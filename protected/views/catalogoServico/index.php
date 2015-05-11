<?php
/* @var $this CatalogoServicoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Catalogo Servicoes',
);

$this->menu=array(
	array('label'=>'Create CatalogoServico', 'url'=>array('create')),
	array('label'=>'Manage CatalogoServico', 'url'=>array('admin')),
);
?>

<h1>Catalogo Serviços</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

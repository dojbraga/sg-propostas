<?php
/* @var $this FormaPgtoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Forma Pgtos',
);

$this->menu=array(
	array('label'=>'Create FormaPgto', 'url'=>array('create')),
	array('label'=>'Manage FormaPgto', 'url'=>array('admin')),
);
?>

<h1>Forma Pgtos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

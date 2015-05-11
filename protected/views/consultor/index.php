<?php
/* @var $this ConsultorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Consultors',
);

$this->menu=array(
	array('label'=>'Create Consultor', 'url'=>array('create')),
	array('label'=>'Manage Consultor', 'url'=>array('admin')),
);
?>

<h1>Consultors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

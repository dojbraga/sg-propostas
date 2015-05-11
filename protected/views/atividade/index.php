<?php
/* @var $this AtividadeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Atividade',
);

$this->menu=array(
	array('label'=>'Create Atividade', 'url'=>array('create')),
	array('label'=>'Manage Atividade', 'url'=>array('admin')),
);
?>

<h1>Atividade</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

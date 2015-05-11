<?php
/* @var $this TabelaValorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tabela Valor',
);

$this->menu=array(
	array('label'=>'Create TabelaValor', 'url'=>array('create')),
	array('label'=>'Manage TabelaValor', 'url'=>array('admin')),
);
?>

<h1>Tabela Valor</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

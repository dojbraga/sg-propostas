<?php
/* @var $this PropostaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Proposta',
);

$this->menu=array(
	array('label'=>'Cadastrar Proposta', 'url'=>array('create')),
	array('label'=>'Gerenciar Proposta', 'url'=>array('admin')),
);
?>

<h1>Proposta</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

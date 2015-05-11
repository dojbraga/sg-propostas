<?php
/* @var $this TabelaValorController */
/* @var $model TabelaValor */

$this->breadcrumbs=array(
	'Tabela Valor'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TabelaValor', 'url'=>array('index')),
	array('label'=>'Create TabelaValor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tabela-valor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tabela Valor</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tabela-valor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
            'name' => 'id_cliente',
            'filter' => CHtml::listData(Cliente::model()->findAll(array('order'=>'cliente ASC')), 'id', 'cliente'), // fields from country table
            'value' => 'Cliente::Model()->FindByPk($data->id_cliente)->cliente',
        ),
		'valor',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

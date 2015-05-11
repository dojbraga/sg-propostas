<style>

input,
textarea,
select,
.uneditable-input {
   margin: 0;
   padding: 0;
}

</style>
<?php
/* @var $this PropostaController */
/* @var $model Proposta */

$this->breadcrumbs=array(
	'Proposta'=>array('index'),
	'Gerenciar Proposta',
);

$this->menu=array(
	array('label'=>'Listar Proposta', 'url'=>array('index')),
	array('label'=>'Cadastrar Proposta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#proposta-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

	function ajustaData($data){
			$dataAjustada = '';
			if($data != ''){
				$dataAjustada = date("d/m/Y", strtotime($data));
			}
			return $dataAjustada;
	
	}
?>


<h1>Gerenciar Proposta</h1>

<p>
Você pode utilizar os operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) nos critérios de pesquisa.
</p>

<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'proposta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'chamado',
      array(
            'name' => 'solicitante',
            'value' => 'ClienteContato::Model()->findContato($data->solicitante, $data->cliente)',
        ),
array(
            'name' => 'cliente',
            'filter' => CHtml::listData(Cliente::model()->findAll(array('order'=>'cliente ASC')), 'id', 'cliente'), // fields from country table
            'value' => 'Cliente::Model()->FindByPk($data->cliente)->cliente',
        ),
array(
            'name' => 'consultor_negocio',
            'filter' => CHtml::listData(Consultor::model()->findAll(array('order'=>'nome ASC')), 'id', 'nome'), // fields from country table
            'value' => 'Consultor::Model()->FindByPk($data->consultor_negocio)->nome',
        ),
        array(
            'name' => 'situacao',
            'filter' => CHtml::listData(Situacao::model()->findAll(array('order'=>'descricao ASC')), 'id', 'descricao'), // fields from country table
            'value' => 'Situacao::Model()->FindByPk($data->id_situacao)->descricao',
        ),	
        'vlr_investimento',
	array(            
            'name'=>'dt_validade',
            'value'=>'ajustaData($data->dt_validade)',
      ),
     array(            
            'name'=>'dt_envio',
            'value'=>'ajustaData($data->dt_envio)',
      ),		
           array(            
            'name'=>'prazo_entrega',
            'value'=>'ajustaData($data->prazo_entrega)',
      ),	
		/*
		'objetivo_tecnico',
		'vlr_investimento',
		'id_forma_pgto',
		'vlr_desconto',
		'dt_envio',
		'dt_validade',
		
		'observacoes',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

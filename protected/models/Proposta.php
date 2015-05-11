<?php

/**
 * This is the model class for table "propostas".
 *
 * The followings are the available columns in table 'propostas':
 * @property integer $id
 * @property integer $chamado
 * @property integer $cliente
 * @property integer $solicitante
 * @property integer $consultor_negocio
 * @property integer $id_situacao
 * @property string $objetivo_tecnico
 * @property string $vlr_investimento
 * @property integer $id_forma_pgto
 * @property string $vlr_desconto
 * @property string $dt_envio
 * @property string $dt_validade
 * @property string $observacoes
 * @property string $obs_objetivo_tecnico
 * @property string $obs_atividades
 * @property string $vlr_deslocamento
 *
 * The followings are the available model relations:
 * @property Atividades[] $atividades
 * @property Consultor $consultorNegocio
 * @property FormaPgto $idFormaPgto
 * @property Situacao $idSituacao
 */
class Proposta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proposta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cliente, solicitante, consultor_negocio, id_situacao, objetivo_tecnico, vlr_investimento, id_forma_pgto, dt_envio, dt_validade, prazo_entrega, vlr_hora_cliente', 'required'),
			array('chamado, cliente, solicitante, consultor_negocio, id_situacao, id_forma_pgto', 'numerical', 'integerOnly'=>true),
			array('vlr_investimento, vlr_desconto, vlr_deslocamento', 'length', 'max'=>15),
			array('observacoes, obs_objetivo_tecnico, obs_atividades, motivo_recusa, obs_entrega', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, chamado, cliente, solicitante, consultor_negocio, id_situacao, objetivo_tecnico, vlr_investimento,vlr_hora_cliente,chamado_servico, id_forma_pgto, vlr_desconto, dt_envio, dt_validade, prazo_entrega, observacoes, obs_objetivo_tecnico, obs_atividades,obs_entrega, vlr_deslocamento, motivo_recusa', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		   return array(
		        'consultor' => array(self::BELONGS_TO, 'Consultor', 'consultor_negocio'),
		        'clientes' => array(self::BELONGS_TO, 'Cliente', 'cliente'),
		        'solicitantes'=>array(self::BELONGS_TO, 'ClienteContato', 'solicitante'),
		        'situacao' => array(self::BELONGS_TO, 'Situacao', 'id_situacao'),
		        'formapgto' => array(self::BELONGS_TO, 'FormaPgto', 'id_forma_pgto'),
		        'atividades' => array(self::HAS_MANY, 'Atividade', 'id_proposta'),
		        'tabelavalor' => array(self::BELONGS_TO, 'TabelaValor', 'cliente'),
		    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Proposta',
			'chamado' => 'Chamado',
			'cliente' => 'Cliente',
			'solicitante' => 'Solicitante',
			'consultor_negocio' => 'Consultor Negocio',
			'id_situacao' => 'Situação',
			'objetivo_tecnico' => 'Apresentação',
			'vlr_investimento' => 'Valor do Investimento',
			'id_forma_pgto' => 'Forma de Pagamento',
			'vlr_desconto' => 'Valor Desconto',
			'dt_envio' => 'Data de Envio',
			'dt_validade' => 'Data de Validade',
			'prazo_entrega' => 'Prazo de Entrega',
			'observacoes' => 'Observações',
			'obs_objetivo_tecnico' => 'Obs Objetivo Técnico',
			'obs_atividades' => 'Obs Atividades',
			'vlr_deslocamento' => 'Vlr Deslocamento',
			'vlr_hora_cliente' => 'Valor Hora do Cliente',
			'chamado_servico' => 'Chamado de Serviço',
			'motivo_recusa' => 'Motivo recusa',
			'obs_entrega' => 'Observações para entrega'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$situacao = '';
		$dt_validade = '';
		$dt_envio = '';
		$prazo_entrega = '';
		
		if(isset($_REQUEST['Proposta'])){
			$situacao=$_REQUEST['Proposta']['situacao'];
			
			if(!empty($_REQUEST['Proposta']['dt_validade'])){
				$dt_validade = $this->ajustaData($_REQUEST['Proposta']['dt_validade'], "/","-");
			}
			
			if(!empty($_REQUEST['Proposta']['prazo_entrega'])){
				$dt_validade = $this->ajustaData($_REQUEST['Proposta']['prazo_entrega'], "/","-");
			}
			
			if(!empty($_REQUEST['Proposta']['dt_envio'])){
				$dt_envio = $this->ajustaData($_REQUEST['Proposta']['dt_envio'], "/","-");
			}
		}
		
		
		$criteria=new CDbCriteria;
		
				
		$criteria->compare('id',$this->id);
		$criteria->compare('chamado',$this->chamado);
		$criteria->compare('solicitante',$this->solicitante);
		$criteria->compare('consultor_negocio',$this->consultor_negocio);
		$criteria->compare('cliente',$this->cliente);
		$criteria->compare('id_situacao',$situacao);
		$criteria->compare('objetivo_tecnico',$this->objetivo_tecnico,true);
		$criteria->compare('vlr_investimento',$this->vlr_investimento,true);
		$criteria->compare('id_forma_pgto',$this->id_forma_pgto);
		$criteria->compare('vlr_desconto',$this->vlr_desconto,true);
		$criteria->compare('dt_envio',$dt_envio,true);
		$criteria->compare('dt_validade',$dt_validade,true);
		$criteria->compare('observacoes',$this->observacoes,true);
		$criteria->compare('obs_objetivo_tecnico',$this->obs_objetivo_tecnico,true);
		$criteria->compare('obs_entrega',$this->obs_entrega,true);
		$criteria->compare('obs_atividades',$this->obs_atividades,true);
		$criteria->compare('motivo_recusa',$this->motivo_recusa,true);
		$criteria->compare('vlr_deslocamento',$this->vlr_deslocamento,true);
		$criteria->compare('vlr_hora_cliente',$this->vlr_hora_cliente,true);
		$criteria->compare('chamado_servico',$this->chamado_servico,true);
		$criteria->order = 'id DESC';	
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Propostas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function searchAtividades() {

		$Atividades = new Atividades();

		return $Atividades->search();

	}
	
	public function ajustaData($data, $caracter,$divisor="/"){
		
		if(isset($data)){
			$data = explode($caracter, $data);
			$novaData = $data[2].$divisor.$data[1].$divisor.$data[0];
		}else{
			$novaData = $data;
		}
		
		return $novaData;
		
	}
	
	public function getDescricaoSituacao() {
		return CHtml :: listData(Situacao :: model()->findAll(array('order'=>'descricao ASC')), "id", "descricao");
	}

	public function getDescricaoConsultor() {
		return CHtml :: listData(Consultor :: model()->findAll(array('order'=>'nome ASC')), "id", "nome");
	}

	public function getDescricaoFormaPgto() {
		return CHtml :: listData(FormaPgto :: model()->findAll(array('order'=>'forma_pgto ASC')), "id", "forma_pgto");
	}
	
	public function getDescricaoClientes() {
		return CHtml :: listData(Cliente :: model()->findAll(array('order'=>'cliente ASC')), "id", "cliente");
	}
	
	public function getDescricaoClientesContato($codigoCliente = null) {
				
			$codigoCliente = (isset($codigoCliente))?($codigoCliente):(0);
		
			return CHtml::listData(ClienteContato::model()->findAll(array("condition"=>"id_cliente =  $codigoCliente","order"=>"contato")),"id","contato");
	}

	
	
		public function getDescricaoContatobyID($id) {

			$arrContatos = array();
			$qualitor = new Qualitor();

			$query = $qualitor->conexao->prepare("SELECT * FROM [dbo].[ad_contato] where cdcontato = $id");
			$query->execute();
			$arrContatos = array ();

			for ($i = 0; $row = $query->fetch(); $i++) {

				$arrContatos[$row['cdcontato']]['cdcontato'] = $row['cdcontato'];
				$arrContatos[$row['cdcontato']]['nmcontato'] = $row['nmcontato'];
			}
			
			return CHtml :: listData($arrContatos, "cdcontato", "nmcontato");
	}

	public function getDescricaoConsultores() {

		$qualitor = new Qualitor();
		
		$query = $qualitor->conexao->prepare("select distinct usu.cdusuario, nmusuario, dsemail as email from ad_usuario usu
												     inner join ad_usuariogrupo usug
														on usug.cdusuario = usu.cdusuario
											         where usu.cdcargo = 65 order by 2"); // 65 = consultor de sistemas
		$query->execute();

		$arrConsultores = array ();
		
			$objetoConsultor['id'] = 0;
			$objetoConsultor['nome'] = 'Selecione';
			$arrConsultores[] = (object) $objetoConsultor;
		
		for ($i = 0; $row = $query->fetch(); $i++) {
			
			$objetoConsultor['id'] = $row['cdusuario'];
			$objetoConsultor['nome'] = $row['nmusuario'];
			$arrConsultores[] = (object) $objetoConsultor;
		}
		
		
		return CHtml :: listData($arrConsultores, "id", "nome");
		
		

	}
	
	public function getDadosConsultorByiD($id=null) {

		$qualitor = new Qualitor();
		
		$query = $qualitor->conexao->prepare("select distinct usu.cdusuario, nmusuario, dsemail as email from ad_usuario usu
												     inner join ad_usuariogrupo usug
														on usug.cdusuario = usu.cdusuario
											         where usu.cdusuario = {$id}"); // 65 = consultor de sistemas
		$query->execute();

		for ($i = 0; $row = $query->fetch(); $i++) {
			
			$objetoConsultor['id'] = $row['cdusuario'];
			$objetoConsultor['nome'] = $row['nmusuario'];
			$objetoConsultor['email'] = $row['email'];
			$objetoConsultor = (object) $objetoConsultor;
		}
		
		
		return $objetoConsultor;
		
		

	}

	public function getDadosByChamado($chamado) {

		$qualitor = new Qualitor();

		$query = $qualitor->conexao->prepare("select cdchamado, nmcliente, cdcliente, cdcontato, nmcontato, cdresponsavel, nmresponsavel from vw_hd_chamado02 where cdchamado = {$chamado}");
		$query->execute();
		
		$query->execute();

		$arrChamado = array ();
		

		for ($i = 0; $row = $query->fetch(); $i++) {

			$arrChamado[0]['cdchamado'] = $row['cdchamado'];
			$arrChamado[0]['cdcliente'] = $row['cdcliente'];
			$arrChamado[0]['cdcontato'] = $row['cdcontato'];
			$arrChamado[0]['nmcliente'] = $row['nmcliente'];

		}

		return $arrChamado;
	}

	public function getValorHoraCliente($id) {

		$user = Yii :: app()->db->createCommand();
		$user->select('id, id_cliente, valor');
		$user->from('tabela_valor');
		$user->where('id_cliente=:id_cliente', array (
			':id_cliente' => $id
		));
		$retorno = $user->queryRow();

		$valorHora = $retorno['valor'];

		return $valorHora;

	}
}

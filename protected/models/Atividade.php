<?php

/**
 * This is the model class for table "atividade".
 *
 * The followings are the available columns in table 'atividade':
 * @property integer $id_atividade
 * @property integer $id_proposta
 * @property string $atividade
 * @property string $carga_horaria
 * @property string $data_execucao
 * @property integer $id_consultor
 * @property string $horario_inicio
 * @property string $horario_termino
 */
class Atividade extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'atividade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_proposta, id_consultor', 'numerical', 'integerOnly'=>true),
			array('atividade', 'length', 'max'=>500),
			array('carga_horaria', 'length', 'max'=>10),
			array('data_execucao, horario_inicio, horario_termino', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_atividade, id_proposta, atividade, carga_horaria, data_execucao, id_consultor, horario_inicio, horario_termino', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_atividade' => 'Id Atividade',
			'id_proposta' => 'Id Proposta',
			'atividade' => 'Atividade',
			'carga_horaria' => 'Carga Horaria',
			'data_execucao' => 'Data Execucao',
			'id_consultor' => 'Id Consultor',
			'horario_inicio' => 'Horario Inicio',
			'horario_termino' => 'Horario Termino',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id_atividade',$this->id_atividade);
		$criteria->compare('id_proposta',$this->id_proposta);
		$criteria->compare('atividade',$this->atividade,true);
		$criteria->compare('carga_horaria',$this->carga_horaria,true);
		$criteria->compare('data_execucao',$this->data_execucao,true);
		$criteria->compare('id_consultor',$this->id_consultor);
		$criteria->compare('horario_inicio',$this->horario_inicio,true);
		$criteria->compare('horario_termino',$this->horario_termino,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Atividade the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

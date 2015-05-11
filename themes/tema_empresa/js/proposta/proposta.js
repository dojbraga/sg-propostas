Ext.define('Writer.Grid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.writergrid',

    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.form.field.Text',
        'Ext.toolbar.TextItem'
    ],
    
    initComponent: function(){

         this.editing = Ext.create('Ext.grid.plugin.RowEditing');

		 Ext.define('Consultores', {
	     extend: 'Ext.data.Model',
    	 fields: [
         {name: 'id_consultor', type: 'int'},
         {name: 'nmusuario',  type: 'string'}
     ]
 });
 
	var storeConsultores = Ext.create('Ext.data.Store', {
                     					 storeId: 'consultores',
    									 autoLoad: true,
    									 autoSync: false,
    									 model:'Consultores',
    									 proxy: {
       											  type: 'ajax',
        										  url: urlGetDescricaoConsultores,
        										  reader: {
             									  type: 'json',
             									  root: 'consultores'
         										 }
     									}
 									});
 									
        Ext.apply(this, {
            iconCls: 'icon-grid',
            id: 'grid',
            frame: true,
            plugins: [this.editing],
            dockedItems: [{
                xtype: 'toolbar',
                items: [{
                    iconCls: 'icon-add',
                    text: 'Adicionar Atividade',
                    scope: this,
                    handler: this.onAddClick
                }, {
                    iconCls: 'icon-delete',
                    text: 'Remover',
                    disabled: true,
                    itemId: 'delete',
                    scope: this,
                    handler: this.onDeleteClick
                }]
            }, {
                weight: 2,
                xtype: 'toolbar',
                dock: 'bottom'
            }, {
                weight: 1,
                xtype: 'toolbar',
                dock: 'bottom',
                ui: 'footer',
                items: ['->', {
                    iconCls: 'icon-save',
                    text: 'Calcular',
                    scope: this,
                    handler: this.onCalc
                }]
            }],
            columns: [{
                text: 'ID',
                width: 40,
                sortable: true,
                resizable: false,
                draggable: false,
                hideable: false,
                menuDisabled: true,
                dataIndex: 'id_atividade'
            },
             {
                header: 'Atividade',
                flex: 1,
                sortable: true,
                dataIndex: 'atividade',
                editor: {
                    xtype: 'textfield'
                }
            }, {
                header: 'CH',
                width: 60,
                sortable: true,
                dataIndex: 'carga_horaria',
                editor: {
                    xtype: 'numberfield'
                }
            },{
                header: 'Usa',
                width: 50,
                sortable: true,
                dataIndex: 'usa_data_execucao',
                renderer: function(value){
                	if(value){
                		return "Sim";
                	}else{
                		return "Não";
                	}
                },
                editor: {
                    xtype: 'checkboxfield',
                    inputValue: true,
                    listeners: {
                    	change:function(value, newValue, oldValue, eOpts ){
                    		if(newValue){
								value.up().items.items[4].setDisabled(false);
								value.up().items.items[5].setDisabled(false);
								value.up().items.items[6].setDisabled(false);
                    		}else{
                    			value.up().items.items[4].setDisabled(true);
								value.up().items.items[5].setDisabled(true);
								value.up().items.items[6].setDisabled(true);
                    		}
                    	}
                    }
                }
            }, {
                header: 'Data',
                width: 105,
                sortable: true,
                dataIndex: 'data_execucao',
                renderer:function(value){
                	return Ext.Date.format(value, 'd/m/Y');
                },
                editor: {
                    xtype: 'datefield',
                    format: 'd/m/Y',
                    disabled: true
                }
            }, {
                header: 'Início',
                width: 72,
                sortable: true,
                dataIndex: 'horario_inicio',
                renderer:function(value){
                	return Ext.Date.format(value, 'H:i');
                },
                editor: {
                    xtype: 'timefield',
                    disabled: true,
                    format: 'H:i',
    				altFormats:'H:i'
                }
            }, {
                header: 'Termino',
                width: 72,
                sortable: true,
                dataIndex: 'horario_termino',
                renderer:function(value){
                return Ext.Date.format(value, 'H:i');
                },
                editor: {
                    xtype: 'timefield',
                    disabled: true,
                    format: 'H:i',
    				altFormats:'H:i'
                }
            },{
                header: 'Usa',
                width: 50,
                sortable: true,
                dataIndex: 'usa_consultor',
                    renderer: function(value){
                	if(value){
                		return "Sim";
                	}else{
                		return "Não";
                	}
                },
                editor: {
                    xtype: 'checkboxfield',
                    inputValue: true,
                                        listeners: {
                    	change:function(value, newValue, oldValue, eOpts ){
                    		if(newValue){
								value.up().items.items[8].setDisabled(false);
                    		}else{
                    			value.up().items.items[8].setDisabled(true);
                    		}
                    	}
                    }
                }
            },{
                header: 'Consultor',
                flex: 1,
                sortable: true,
                dataIndex: 'id_consultor',
                renderer: function(value){
                	return arrConsultores[value];
                },
                editor: {
                     xtype: 'combobox',
                     id:'id_consultor',
                     displayField: 'nmusuario',
                     valueField: 'id_consultor',
                     store: storeConsultores,
                     disabled:true
                }
            }]
        });
        this.callParent();
        this.getSelectionModel().on('select', this.onSelectChange, this);
    },
    
    onSelectChange: function(selModel, selections){
        this.down('#delete').setDisabled(selections.length === 0);
    },
    

    onCalc: function(){
    	 var total = 0;
 		 	Ext.getCmp('grid').getStore().data.each(function(rec){
 		 		var valor = parseFloat(rec.data.carga_horaria);
 		 		total += valor;
 			}
 		 )
 		 
 		var valorHora = parseFloat($("#Proposta_vlr_hora_cliente").val());
    	var valorDesconto = parseFloat($("#Proposta_vlr_desconto").val());
    	var valorDeslocamento = parseFloat($("#Proposta_vlr_deslocamento").val());
    	var vltInvestimento = (valorHora * total)+valorDeslocamento-valorDesconto;
    	$("#Proposta_vlr_investimento").val(vltInvestimento);
    	
        this.store.sync();
    },

    onDeleteClick: function(){
        var selection = this.getView().getSelectionModel().getSelection()[0];
        if (selection) {
            this.store.remove(selection);
        }
    },

    onAddClick: function(){
        var rec = new Writer.Person({
            atividade: '',
            carga_horaria: '',
            usa_data_execucao: '',
            data_execucao: '',
            horario_inicio: '',
            horario_termino: '',
            usa_consultor: '',
            id_consultor:''
        }), 
        edit = this.editing;

        //edit.cancelEdit();
        this.store.insert(0, rec);
        edit.startEdit(rec,1);
        
    }
});

Ext.define('Writer.Person', {
    extend: 'Ext.data.Model',
    fields: [{
        name: 'id_atividade',
        type: 'int',
        useNull: true
    },{
        name: 'id_proposta',
        type: 'int',
        useNull: true
    },
    {name:'atividade',
     type:'string'},
     {
      	name:'carga_horaria',
      	type:'int' 
    },{
    	name:'data_execucao',
   	 type: 'date'
   }, {name:'id_consultor',
	   type:'string'},
     {name:'usa_data_execucao',
      	type:'bool' 
    },{
      	name:'usa_consultor',
      	type:'bool' 
    },{
    	name:'horario_inicio',
    	 type: 'time'
    },{
    	name:'horario_termino',
    	 type: 'time'
    }
   ]
});

Ext.require([
    'Ext.data.*',
    'Ext.tip.QuickTipManager',
    'Ext.window.MessageBox'
]);

Ext.onReady(function(){
    Ext.tip.QuickTipManager.init();
    var store = Ext.create('Ext.data.Store', {
        model: 'Writer.Person',
        autoLoad: true,
        autoSync: true,
        proxy: {
            type: 'jsonp',            
            api: {
                read: urlGeral+'/Atividade/Read/'+idProposta,
                create: urlGeral+'/Atividade/Create',
                update: urlGeral+'/Atividade/Update',
                destroy: urlGeral+'/Atividade/Delete'
            },
            reader: {
                type: 'json',
                successProperty: 'success',
                root: 'data',
                messageProperty: 'message'
            },
            writer: {
                type: 'json',
                encode: true,
                writeAllFields: false,
                root: 'data'
            },
            listeners: {
                exception: function(proxy, response, operation){
                    Ext.MessageBox.show({
                        title: 'REMOTE EXCEPTION',
                        msg: operation.getError(),
                        icon: Ext.MessageBox.ERROR,
                        buttons: Ext.Msg.OK
                    });
                }
            }
        },
        listeners: {
            write: function(proxy, operation){
                if (operation.action == 'destroy') {
                    main.child('#form').setActiveRecord(null);
                }
                Ext.example.msg(operation.action, operation.resultSet.message);
            }
        }
    });
    
     var storeConsultores = Ext.create('Ext.data.Store', {
     autoLoad: true,
     model: "Proposta",
     proxy: {
         type: 'ajax',
         url: urlGetDescricaoConsultores,
         reader: {
             type: 'json',
             root: 'consultores'
         }
     }
 });

    var main = Ext.create('Ext.container.Container', {
        padding: '0 0 0 0',
        autowidth: true,
        height: Ext.themeName === 'neptune' ? 500 : 450,
        renderTo: atividades,
        layout: {
            type: 'vbox',
            align: 'stretch'
        },
        items: [{
            itemId: 'grid',
            xtype: 'writergrid',
            title: 'Atividades',
            flex: 1,
            store: store            
        }]
    });
});

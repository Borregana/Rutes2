<?php
App::uses('AppModel', 'Model');
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 05/04/14
 * Time: 12.32
 */
class Usuario extends AppModel {
    public $name='Usuario';

    public function beforeSave($options = array()) {
        if (isset ($this->data['User']['password']) && $this->data['User']['password'] != ''){
            App::import('Component', 'Auth');
            $this->data['Usuario']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        elseif($this->data['Usuario']['password'] == ''){
            unset($this->data['Usuario']['password']);
        }
        return true;
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'nombre' => array(
            'notempty' => array(
                'rule' => 'notempty',
                'message' => 'Required field'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Nombre de usuario ocupado.'
            ),
            'ascii' => array(
                'rule' => array('checkName'),
                'message' => 'Carácteres no permitidos'
            )
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'No valid email',
            )
        ),
        'password' => array(
            'ascii' => array(
                'rule' => array('checkPassword'),
                'message' => 'Carácteres no permitidos'
            )
        )
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Ruta' => array(
            'className' => 'Ruta',
            'foreignKey' => 'usuario_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'CyP' => array(
            'className' => 'CyP',
            'foreignKey' => 'usuario_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );


    public $actsAs = array(
        'Containable',
        'Acl' => array('type' => 'requester')
    );


    function checkPassword(){
        if(isset($this->data['Usuario']['id'])){
            $pass = $this->data['Usuario']['password'];
            $lenght = strlen($pass);
            for($i=0; $i<$lenght; $i++){
                if (ord($pass[$i])>127){
                    return FALSE;
                }
            }
            return TRUE;
        }
        elseif($this->data['Usuario']['password'] != ''){
            return TRUE;
        }
        return FALSE;
    }

    function checkName(){
        if(isset($this->data['Usuario']['nombre'])){
            $name = $this->data['Usuario']['nombre'];
            $lenght = strlen($name);
            for($i=0; $i<$lenght; $i++){
                if (ord($name[$i])==32 || ord($name[$i])>127 ){
                    return FALSE;
                }
            }
            return TRUE;
        }
        elseif($this->data['Usuario']['nombre'] != ''){
            return TRUE;
        }
        return FALSE;
    }
}

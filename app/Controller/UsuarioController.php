<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 05/04/14
 * Time: 13.05
 */

App::uses('AppController', 'Controller');

class UsuarioController extends AppController{
    public $helpers = array('Html','Form');

    Public function index(){
        $list_users=$this->Usuario->find('all');

        $list=$this->paginate(
            'Usuario'
        );
        pr($list_users);
        die;
        $this->set('usuario', $list);
    }
}
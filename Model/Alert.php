<?php
/**
 * Created by PhpStorm.
 * User: bloumy
 * Date: 04/12/2015
 * Time: 03:13
 */

class Alert
{
    private $_nom;
    private $_adresse;
    private $_effectif_total;
    private $_login;
    private $_pwd;
    private $_cnx;

    public function __construct( $nom, $add, $eff, $log, $pwd)
    {
        $bdd = new Connexiondb();
        $this->_cnx = $bdd->getcnx();

        $this->_nom = $nom;
        $this->_adresse = $add;
        $this->_effectif_total = $eff;
        $this->_login = $log;
        $this->_pwd = $pwd;
    }

    public function inscrire()
    {
        $this->_cnx->exec('INSERT INTO  VALUES(, $this->_nom, $this->_adresse, $this->_effectif_total, $this->_login, $this->_pwd,) ');

        //return $this->_cnx;
    }

}
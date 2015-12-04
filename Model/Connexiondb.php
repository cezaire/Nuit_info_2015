<?php

/**
 * Created by PhpStorm.
 * User: Sami
 * Date: 04/12/2015
 * Time: 01:49
 */
class Connexiondb
{
    private $_cnx;

    public function __construct()
    {

        try {
            $this->cnx = new PDO('mysql:host=localhost;dbname=ndi;charset=utf8', 'root', 'root');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getcnx()
    {
        return $this->_cnx;
    }
}
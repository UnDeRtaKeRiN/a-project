<?php

class Route
{
    private $_uri = array();
    private $_method = array();

    /**
     * Builds a collection of internal URL's to look for
     *@param type $uri
     */
    public function add($uri, $method = null)
    {
        $this->_uri[] = '/' . trim($uri, '/');

        if ($method != null)
        {
            $this->_method[] = $method;
        }
    }

    /**
     * Makes the thing run!
     */
    public function submit()
    {
       $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';

        foreach ($this->_uri as $key => $value)
        {
            if (preg_match("#^$value$#", $uriGetParam))
            {
                if (is_string($this->_method[$key]))
                {
                    $useMethod = $this->_method[$key];
                    new $useMethod();
                }
                else
                {
                    call_user_func($this->_method[$key]);
                }
            }
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


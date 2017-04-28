<?php
class ViewController{
/**
* Konstruktor.
* Erzeugt eine neue Smarty-Instanz und konfiguert die Smarty-Pfade
*/

    /**
     * @var Smarty durch das protected ist die smarty-Instanz immer verfügbar wenn diese
     *             Klasse extended wird.
     */
    protected $templating;

    /**
     * @var PDO
     */
    protected $database;


	function __construct(){
	    $this->templating = $this->createTemplating();
	    $this->database = $this->createConnection();
	}

	private function createTemplating()
    {
        $smarty = new Smarty();
        $smarty->setEscapeHtml(true);
        $smarty->setConfigDir('../../config');
        $smarty->setCacheDir( '../../temp/cache');
        $smarty->setCompileDir('../../temp/templates_c');
        $smarty->setTemplateDir( '../webtool/views/');

        return $smarty;
    }

    private function createConnection()
    {
        return new PDO('mysql:host=localhost;dbname=a-project', 'root', '');
    }
}
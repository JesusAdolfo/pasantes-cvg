<?php class Conexion_Intranet
{

    protected $_link = null;
    protected $_db_host = 'pzosdgstdeb3.pzo.cvg.com';
    protected $_db_nombre = 'intranetcvg';
    protected $_db_port = 5432;
    protected $_db_user = 'cintranet';
    protected $_db_pass = 'm13wrvq';
	
	 public function __construct()
    {
        $this->_link = pg_connect("host=$this->_db_host dbname=$this->_db_nombre port=$this->_db_port user=$this->_db_user password=$this->_db_pass");
    }
			
	 public function get_con ()
    {
        return ($this->_link) ? $this->_link : false;
    }
 }
?>
<?php
	class login_bll {
		private $dao;
		private $db;
		static $_instance;

		function __construct() {
			$this->dao = login_dao::getInstance();
			$this->db = db::getInstance();
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		
		public function get_register_BLL($args) {
			return $this -> dao -> select_data_register($this->db,$args[0],$args[1],$args[2]);
		}
    }
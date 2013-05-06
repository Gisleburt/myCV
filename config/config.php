<?php
	
	class config {
		
		// Development
		public $devmode = true;
		
		// Directory Structure
		public $dir = array(
				'root'       => '',
				'data'       => 'data',
				'logs'       => 'data/logs',
				'userfiles'  => 'data/userfiles',
				'mail'       => 'data/mail',
				'library'    => 'Library',
			);

		// Smarty
		public $smarty = array(
				'includeDir' => 'Library/Smarty',
				'configDirs' => array(
						'Library/Smarty/configs',
					),
				'pluginsDirs' => array(
						'Library/Smarty/plugins',
						'Library/Smarty/sysplugins',
					),
				'cacheDir'      => 'data/cache',
				'compileDir'    => 'data/templates_c',
				'templateDirs'  => array(
						'data/templates',
						'Library/Thymely/Templates',
					),
			);

		public $twig = array(
				'twigDir' => 'Library/Twig/lib/Twig',
				'templateDirs'  => array(
					//'data/templates',
					'Library/Thymely/Templates',
				),
				'compileDir'    => 'data/templates_c',
			);

		public $phpTemplates = array(
				'templateDirs' => array(
					'Library/Thymely/Templates',
				)
			);

		// MySQL
		public $mysqlUser   = 'dummyuser';
		public $mysqlPass   = 'dummypassword';
		public $mysqlHost   = '127.0.0.1';
		public $mysqlSchema = 'thymely';
		
		// Errors
		public $errorFolder    = 'data/logs/errors';
		public $errorEmail     = 'daniel@danielmason.com';
		public $errorSubject   = 'Error on DanielMason.com';
		public $errorDbServer  = '127.0.0.1';
		public $errorDbUser    = 'dummyuser';
		public $errorDbPass    = 'dummypassword';
		public $errorDbSchema  = 'thymely_errors';
		public $errorDbTable   = 'errors';

		// Cryptography
		protected $siteKey = 'somerandomstringhere';
		
		
		/**
		 * Create an setup the configuration details
		 */
		public function __construct() {
			// Lets make the paths absolute if they aren't already
			$this->dir    = $this->makeAbsolute($this->dir);
			$this->smarty = $this->makeAbsolute($this->smarty);
			$this->twig   = $this->makeAbsolute($this->twig);
			$this->phpTemplates = $this->makeAbsolute($this->phpTemplates);
			$this->twig['devmode'] = $this->devmode;
			$this->errorFolder = $this->makeAbsolute($this->errorFolder);
		}
		
		/**
		 * Attempts to make a given directory absolute based on the assumption
		 * that this file is in /config relative to the application root
		 * @param string $dir
		 * @return string
		 */
		public function makeAbsolute($dir) {
			if(is_array($dir)) {
				foreach($dir as $key => $value)
					$dir[$key] = $this->makeAbsolute($value);
			}
			else {
				if(strpos($dir, '/') !== 0 && strpos($dir, ':') !== 1)
					$dir = dirname(__DIR__).'/'.$dir;
			}
			return $dir;
		}

		public function getSiteKey() {
			return $this->siteKey;
		}
		
	}
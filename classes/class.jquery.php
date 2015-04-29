<?php

namespace ionmvc\packages\jquery\classes;

use ionmvc\classes\autoloader;
use ionmvc\classes\config;
use ionmvc\classes\response;
use ionmvc\exceptions\app as app_exception;
use ionmvc\packages\asset\classes\asset;
use ionmvc\packages\jquery as jquery_pkg;

class jquery {

	private $file;
	private $plugins = array();

	public static function __callStatic( $method,$args ) {
		$class = response::jquery();
		if ( $method === 'load' ) {
			return;
		}
		$method = "_{$method}";
		if ( !method_exists( $class,$method ) ) {
			throw new app_exception( "Method '%s' not found",$method );
		}
		return call_user_func_array( [ $class,$method ],$args );
	}

	public function __construct() {
		$this->file = config::get('jquery.path');
		response::hook()->attach('jquery',function() {
			response::jquery()->init();
		});
	}

	public function init() {
		asset::add( $this->file,8 );
	}

	public function _plugin( $name,$config=array() ) {
		if ( !isset( $this->plugins[$name] ) ) {
			$this->plugins[$name] = autoloader::class_by_type( $name,jquery_pkg::class_type_driver,array(
				'instance' => true
			) );
			if ( $this->plugins[$name] === false ) {
				throw new app_exception( 'Unable to load jquery plugin: %s',$name );
			}
		}
		return $this->plugins[$name];
	}

}

?>
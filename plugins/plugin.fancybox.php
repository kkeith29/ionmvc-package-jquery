<?php

namespace ionmvc\packages\jquery\plugins;

use ionmvc\classes\html;
use ionmvc\packages\asset\classes\asset;

class fancybox {

	public function __construct( $config=[] ) {
		if ( !isset( $config['priority'] ) ) {
			$config['priority'] = 5;
		}
		$path = 'jquery-fancybox/';
		asset::add( "{$path}source/jquery.fancybox.js",$config['priority'] );
		asset::add( "{$path}lib/jquery.mousewheel-3.0.6.pack.js",$config['priority'] );
		asset::add( "{$path}source/jquery.fancybox.css",$config['priority'] );
		if ( isset( $config['buttons'] ) && $config['buttons'] ) {
			asset::add( "{$path}source/helpers/jquery.fancybox-buttons.js",$config['priority'] );
			asset::add( "{$path}source/helpers/jquery.fancybox-buttons.css",$config['priority'] );
		}
		if ( isset( $config['thumbs'] ) && $config['thumbs'] ) {
			asset::add( "{$path}source/helpers/jquery.fancybox-thumbs.js",$config['priority'] );
			asset::add( "{$path}source/helpers/jquery.fancybox-thumbs.css",$config['priority'] );
		}
		if ( !isset( $config['initialize'] ) || $config['initialize'] ) {
			asset::add(function() {
				html::js_embed("\$(document).ready(function(){\$('.fancybox').fancybox();});");
			},$config['priority'],['type'=>'js']);
		}
	}

}

?>
<?php

namespace ionmvc\packages;

use ionmvc\classes\app;
use ionmvc\classes\hook;
use ionmvc\classes\response;

class jquery extends \ionmvc\classes\package {

	const version = '1.0.0';
	const class_type_plugin = 'ionmvc.jquery_plugin';

	public function setup() {
		app::hook()->attach('response.create',function() {
			if ( !response::hook()->exists('asset') ) {
				return;
			}
			response::hook()->add('jquery',[
				'position' => hook::position_before,
				'hook'     => 'asset'
			]);
		});
		$this->add_type('plugin',[
			'type' => self::class_type_plugin,
			'type_config' => [
				'file_prefix' => 'plugin'
			],
			'path' => 'plugins'
		]);
	}

	public static function package_info() {
		return [
			'author'      => 'Kyle Keith',
			'version'     => self::version,
			'description' => 'jQuery handler',
			'required'    => [
				'asset' => ['1.0.0','>=']
			]
		];
	}

}

?>
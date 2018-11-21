<?php
/**
 * @package da-first-plugin
 */

class DavidAragoFirstPluginActivate 
{
	public static function activate() {
		flush_rewrite_rules();
	}
}
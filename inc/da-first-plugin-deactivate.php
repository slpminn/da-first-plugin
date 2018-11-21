<?php
/**
 * @package da-first-plugin
 */

class DavidAragoFirstPluginDeactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
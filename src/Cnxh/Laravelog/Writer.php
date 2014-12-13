<?php namespace Cnxh\Laravelog;

use Illuminate\Log\Writer as BaseWriter;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Config as Config;

class Writer extends BaseWriter {

	/**
	 * register the log handler with the configurations
	 * @return void
	 */
	public function init() {
		// load the laravelog's configurations
		$configs = Config::get('laravelog::log');
		// default path of the log file store
		$defaultPath = app('path.storage').'/logs/'.date('Ymd');
		// here we register the handler by our configurations
		foreach($configs as $level => $config) {
			// only register the level who are enabled
			if (isset($config['enable']) && $config['enable'] == true) {
				$bubble = isset($config['bubble']) && $config['bubble'] == true;
				$path = rtrim(!empty($config['path']) ? $config['path'] : $defaultPath, '/\\');
				if (!file_exists($path)) {
					mkdir($path, 0644, true);
				}
				$path = $path.'/'.$level.'.log';
				$this->useFiles($path, $level, $bubble);
			}
		}
	}

	/**
	 * replace the default laravel file log handler.
	 *
	 * @param  string  $path
	 * @param  string  $level
	 * @param  bool    $bubble
	 * @return void
	 */
	public function useFiles($path, $level = 'debug', $bubble = true)
	{
		$level = $this->parseLevel($level);

		$this->monolog->pushHandler($handler = new StreamHandler($path, $level, $bubble));

		$handler->setFormatter($this->getDefaultFormatter());
	}
}
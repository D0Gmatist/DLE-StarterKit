<?PHP

namespace StarterKit\Classes;

class StarterKitClass {
	protected $logs					= array();
	public static $runs_counter		= 0;

	protected $rootDir				= FALSE;
	protected $engineDir			= FALSE;
	protected $moduleDir			= FALSE;

	protected $db					= FALSE;

	public $dle_config				= FALSE;
	public $cfg						= FALSE;

	public $error_text				= FALSE;

	function __construct() {
		self::$runs_counter++;
		$this->logs[] = __CLASS__ . ' __construct';

		// Определяем пути к папкам
		$this->rootDir		= substr( dirname(  __DIR__ ), 0, -11 );
		$this->engineDir	= $this->rootDir . '/engine';
		$this->moduleDir	= $this->engineDir . '/modules/' . $moduleName;

		// Определяем конфиги
		$this->dle_config	= $this->getDleConfig();
		$this->cfg		= $this->getConfig();

		// Внедряем класс db mysql
		$this->db		= $this->getDb();

	}

	/**
	 * @return array
	 */
	protected function getDleConfig() {
		$this->logs[] = 'getDleConfig';

		include $this->engineDir . '/data/config.php';
		/** @var array $config */
		return $config;

	}

	/**
	 * @return mixed
	 * @throws Exception
	 */
	protected function getConfig() {
		$this->logs[] = 'getConfig';

		if ( ! file_exists( $this->rootDir . '/StarterKit/install/config.php' ) ) {
			return [];
		} else {
			return include $this->rootDir . '/StarterKit/install/config.php';

		}

	}

	/**
	 * @return mixed
	 */
	protected function getDb() {
		$this->logs[] = 'getDb';

		define ( 'DATALIFEENGINE', true );

		include_once $this->engineDir . '/classes/mysql.php';
		include_once $this->engineDir . '/data/dbconfig.php';

		return $db;

	}

	/**
	 * @throws Exception
	 */
	public function checkBeforeInstall() {
		if ( isset( $this->cfg['minVersion'] ) ) {
			if ( $this->dle_config['version_id'] < $this->cfg['minVersion'] ) {
				$this->error_text = 'Установленная версия DLE слишком старая. Необходимо установить DLE не ниже ' . $this->cfg['minVersion'];

			}

			if ( $this->dle_config['version_id'] > $this->cfg['maxVersion'] ) {
				$this->error_text = 'Установленная версия DLE слишком новая. Необходимо установить DLE не выше ' . $this->cfg['maxVersion'];

			}

		} else {
			$this->error_text = 'Файл с конфигурацией установки не найден, возмжно установочные файлы модуля не скопированы.';

		}

	}

}

?>

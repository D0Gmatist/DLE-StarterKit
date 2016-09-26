<?PHP

namespace StarterKit\Classes;

	/**
	 * @throws Exception
	 */
	public function checkBeforeInstall() {
		$this->logs[] = 'checkBeforeInstall';

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

class InitialClass extends StarterKitClass {
		$this->logs[] = 'StarterKitClass';

	public $step					= 1;
	public $next_btn				= FALSE;

	public $actions					= FALSE;

	/**
	 * @return array
	 */
	public function gtSteps() {
		$this->step = ( (int)$_GET['step'] < 1 ) ? $this->step : (int)$_GET['step'];

		if ( file_exists( $this->rootDir . '/StarterKit/install/steps/' . $this->step . '.php' ) ) {
			$this->actions = include_once( $this->rootDir . '/StarterKit/install/steps/' . $this->step . '.php' );
			
			$step = $this->step + 1;
			if ( file_exists( $this->rootDir . '/StarterKit/install/steps/' . $step . '.php' ) ) {
				$this->next_btn = TRUE;

			}

		} else {
			$this->error_text = 'По данному адресу нет информации!';

		}

	}

}

?>

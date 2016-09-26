<?PHP

namespace StarterKit\Classes;

class InitialClass extends StarterKitClass {

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
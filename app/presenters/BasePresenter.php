<?php


abstract class BasePresenter extends Presenter
{
	public $oldLayoutMode = FALSE;
	
	public $oldModuleMode = FALSE;
	
	protected function beforeRender()
	{
		$this->template->viewName = $this->view;

		$a = strrpos($this->name, ':');
		if ($a === FALSE) {
			$this->template->moduleName = '';
			$this->template->presenterName = $this->name;
		} else {
			$this->template->moduleName = substr($this->name, 0, $a + 1);
			$this->template->presenterName = substr($this->name, $a + 1);
		}
	}

}

<?php

class ExtendedRenderer extends ConventionalRenderer {
	
	/**
	 * Renders 'control' part of visual row of controls.
	 * @param  IFormControl
	 * @return string
	 */
	public function renderControl(IFormControl $control)
	{
		$body = $this->getWrapper('control container');
		if ($this->counter % 2) $body->class($this->getValue('control .odd'), TRUE);

		$description = $control->getOption('description');
		if ($description instanceof Html) {
			$description = ' ' . $control->getOption('description');

		} elseif (is_string($description)) {
			$description = ' ' . $this->getWrapper('control description')->setText($control->translate($description));

		} else {
			$description = '';
		}
		
		// added predescription
		$predescription = $control->getOption('predescription');
		if ($predescription instanceof Html) {
			$predescription = $control->getOption('predescription') . ' ';
		} elseif (is_string($predescription)) {
			$predescription = $this->getWrapper('control predescription')->setText($control->translate($predescription)) . ' ';
		} else {
			$predescription = '';
		}

		if ($control->getOption('required')) {
			$description = $this->getValue('control requiredsuffix') . $description;
		}

		if ($this->getValue('control errors')) {
			$description .= $this->renderErrors($control);
		}
		
		// checkbox shows normally
		if (/*$control instanceof Checkbox ||*/ $control instanceof Button ) {
			return $body->setHtml((string) $control->getControl() . (string) $control->getLabel() . $description);
		} else if($control->getOption('oneLine') === true) {
			return $body->setHtml((string) $control->getLabel() ." &nbsp; ". (string) $control->getControl() . $description);
		} else {
			return $body->setHtml($predescription . (string)$control->getControl() . $description);
		}
	}
	
	/**
	 * Renders 'label' part of visual row of controls.
	 * @param  IFormControl
	 * @return string
	 */
	public function renderLabel(IFormControl $control)
	{
		$head = $this->getWrapper('label container');

		// checkbox shows normally
		if (/*$control instanceof Checkbox ||*/ $control instanceof Button || $control->getOption('oneLine') === true) {
			return $head->setHtml(($head->getName() === 'td' || $head->getName() === 'th') ? '&nbsp;' : '');

		} else {
			$label = $control->getLabel();
			$suffix = $this->getValue('label suffix') . ($control->getOption('required') ? $this->getValue('label requiredsuffix') : '');
			if ($label instanceof Html) {
				$label->setHtml($label->getHtml() . $suffix);
				$suffix = '';
			}
			return $head->setHtml((string) $label . $suffix);
		}
	}
	
}


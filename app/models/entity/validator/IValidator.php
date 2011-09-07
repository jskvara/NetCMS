<?php

interface IValidator {

	const ADD = "add";
	
	const EDIT = "edit";
	
	public function validate(IEntity $entity);
}


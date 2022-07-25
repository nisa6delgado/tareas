<?php

namespace App\Validations;

class TaskStoreValidation extends Validation
{
	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules(): array
	{
		return [
			'title' => 'required'
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages(): array
	{
		return [
			'title.required' => 'El campo título es obligatorio.'
		];
	}
}

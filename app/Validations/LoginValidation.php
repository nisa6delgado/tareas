<?php

namespace App\Validations;

class LoginValidation extends Validation
{
	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules(): array
	{
		return [
			'user'     => 'required',
			'password' => 'required'
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
			'user.required'    => 'El campo usuario es obligatorio',
			'passwor.required' => 'El campo contrsaeña es obligatorio'
		];
	}
}

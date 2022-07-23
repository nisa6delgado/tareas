<?php

namespace App\Validations;

class ProjectUpdateValidation extends Validation
{
	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules(): array
	{
		return [
			'name'  => [
				'required',
				Rule::unique('projects')->ignore(request('id'))
			],
			'icon'  => 'required',
			'color' => 'required'
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
			'name.required'  => 'El nombre del proyecto es obligatorio.',
			'name.unique'    => 'El nombre del proyecto ya existe.',
			'icon.required'  => 'El ícono del proyecto es obligatorio.',
			'color.required' => 'El color del proyecto es obligatorio.'
		];
	}
}

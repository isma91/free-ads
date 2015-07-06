<?php namespace freeads\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UserFormRequest extends FormRequest
{
	public function rules() {
		return [
		'username' => 'required',
		'lastname' => 'required',
		'name' => 'required',
		'birthdate' => 'required',
		'email' => 'required',
		'password' => 'required|min:8',
		];	
	}
	public function authorize()
	{
		return true;
	}
}
?>
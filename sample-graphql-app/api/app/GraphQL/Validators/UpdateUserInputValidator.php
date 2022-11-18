<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class UpdateUserInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['string', 'nullable'],
            'email' => ['string', 'email', 'unique:users'],
            'file' => ['file','mimes:jpeg,png,jpg,pdf', 'nullable']
        ];
    }
}

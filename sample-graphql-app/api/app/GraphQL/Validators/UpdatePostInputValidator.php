<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class UpdatePostInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:posts,id'],
            'title' => ['required', 'string', 'max:20'],
            'content' => ['required', 'string', 'max:50'],
        ];
    }
}

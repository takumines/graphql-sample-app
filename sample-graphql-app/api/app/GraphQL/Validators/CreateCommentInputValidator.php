<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class CreateCommentInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'reply' => ['required', 'string', 'max:50'],
            'post_id' => ['required', 'integer', 'exists:posts,id'],
        ];
    }
}

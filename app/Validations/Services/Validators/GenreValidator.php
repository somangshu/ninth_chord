<?php
 namespace Validations\Services\Validators;
 use Validations\Services\Validators\Validator;

class GenreValidator extends Validator {
 
    /**
     * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
     */
    protected $rules = [
            "name" => 'required',
    ];

}

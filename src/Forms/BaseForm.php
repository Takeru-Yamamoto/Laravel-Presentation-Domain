<?php

namespace MyCustom\Forms;

use Illuminate\Support\Facades\Validator as Validation;
use Illuminate\Validation\Validator;

use MyCustom\Forms\ValidationRule;

/**
 * Formクラスで使用する基底クラス
 * 
 * Controllerで受け取るRequestはすべてFormクラスで静的バリデーションを行う
 */
abstract class BaseForm extends ValidationRule
{
    /**
     * バリデーションに使用するvalidator
     *
     * @var Validator
     */
    protected Validator $validator;

    /**
     * Requestから抽出されたもの
     * また、バリデーションを通過したもの
     *
     * @var array
     */
    protected array $input;

    function __construct(array $input)
    {
        $this->input = $input;

        $this->prepareForValidation();

        $this->validator = Validation::make($input, $this->validationRule());

        if ($this->validator->fails()) $this->validator->validate();

        $this->input = $this->validator->validated();

        $this->bind();

        $this->afterBinding();
    }

    public function input(string|int $key): mixed
    {
        return isset($this->input[$key]) ? $this->input[$key] : null;
    }

    abstract protected function prepareForValidation(): void;
    abstract protected function bind(): void;
    abstract protected function validationRule(): array;
    abstract protected function afterBinding(): void;
}

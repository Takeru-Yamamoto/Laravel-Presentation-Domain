<?php

namespace MyCustom\Forms;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

/**
 * Validationのwrapクラス
 */
abstract class ValidationRule
{
    /* 
        field: 必須
        input: 空でない
    */
    protected function required(mixed ...$rules): array
    {
        return arrayMergeUnique(["required"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 不要
        input: 空でもよい
    */
    protected function nullable(mixed ...$rules): array
    {
        return arrayMergeUnique(["nullable"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 不要
        input: fieldあり => 空でない, fieldなし => 空でもよい
    */
    protected function filled(mixed ...$rules): array
    {
        return arrayMergeUnique(["filled"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 必須
        input: 空でもよい
    */
    protected function present(mixed ...$rules): array
    {
        return arrayMergeUnique(["present"], multiDimensionsArrayMergeUnique($rules));
    }


    // useful
    protected function id(string $tableName): array
    {
        return ["integer", $this->exists($tableName, "id")];
    }
    protected function userId(): array
    {
        return $this->id("users");
    }
    protected function email(): array
    {
        return ["string", "email", "max:255"];
    }
    protected function tel(): array
    {
        return ["string", "regex:/^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/"];
    }
    protected function password(int $min = 8, int $max = 32): array
    {
        return ["string", "min:" . $min, "max:" . $max];
    }
    protected function passwordConfirmed(int $min = 8, int $max = 32): array
    {
        return ["string", "min:" . $min, "max:" . $max, "confirmed"];
    }
    protected function passwordLetters(int $min = 8): array
    {
        return [Rules\Password::min($min)->letters()];
    }
    protected function passwordMixedCase(int $min = 8): array
    {
        return [Rules\Password::min($min)->mixedCase()];
    }
    protected function passwordNumbers(int $min = 8): array
    {
        return [Rules\Password::min($min)->numbers()];
    }
    protected function passwordSymbols(int $min = 8): array
    {
        return [Rules\Password::min($min)->symbols()];
    }
    protected function passwordUncompromised(int $min = 8): array
    {
        return [Rules\Password::min($min)->uncompromised()];
    }
    protected function postCode(): array
    {
        return ["string", "regex:/^[0-9]{3}-[0-9]{4}$/"];
    }
    protected function code(mixed $digit): array
    {
        return ["string", "regex:/^[0-9]{" . $digit . "}$/"];
    }


    /* string */
    protected function string(): array
    {
        return ["string", "max:255"];
    }
    protected function currentPassword(string $guard = "web"): array
    {
        return ["current_password:" . $guard];
    }
    protected function longtext(): array
    {
        return ["string"];
    }
    protected function lowercase(): array
    {
        return ["lowercase"];
    }
    protected function uppercase(): array
    {
        return ["uppercase"];
    }
    protected function json(): array
    {
        return ["json"];
    }
    protected function alpha(): array
    {
        return ["regex:/^[a-zA-Z]+$/"];
    }
    protected function alphaNum(): array
    {
        return ["regex:/^[a-zA-Z0-9]+$/"];
    }
    protected function alphaDash(): array
    {
        return ["regex:/^[a-zA-Z0-9\-_]+$/"];
    }
    protected function ip(): array
    {
        return ["ip"];
    }
    protected function ascii(): array
    {
        return ["ascii"];
    }
    protected function url(): array
    {
        return ["url"];
    }
    protected function activeUrl(): array
    {
        return ["active_url"];
    }
    protected function ipv4(): array
    {
        return ["ipv4"];
    }
    protected function ipv6(): array
    {
        return ["ipv6"];
    }
    protected function ulid(): array
    {
        return ["ulid"];
    }
    protected function uuid(): array
    {
        return ["uuid"];
    }
    protected function macAddress(): array
    {
        return ["mac_address"];
    }

    /* int */
    protected function integer(): array
    {
        return ["integer"];
    }
    protected function numeric(): array
    {
        return ["numeric"];
    }
    protected function tinyInteger(): array
    {
        return ["integer", "in:0,1"];
    }
    protected function multipleOf(int $num): array
    {
        return ["multiple_of" . $num];
    }
    protected function decimal(int $min, int $max = null): array
    {
        return is_null($max) ? ["decimal:" . $min] : ["decimal:" . $min . "," . $max];
    }
    protected function digits(int $min, int $max = null): array
    {
        return is_null($max) ? ["digits:" . $min] : ["digits_between:" . $min . "," . $max];
    }
    protected function maxDigits(int $digit): array
    {
        return ["max_digits:" . $digit];
    }
    protected function minDigits(int $digit): array
    {
        return ["min_digits:" . $digit];
    }

    /* bool */
    protected function boolean(): array
    {
        return ["boolean"];
    }

    /* array */
    protected function array(array $acceptKeys = []): array
    {
        return empty($acceptKeys) ? ["array"] : ["array:" . implode(",", $acceptKeys)];
    }
    protected function inArray(string $arrayField, string $key): array
    {
        return ["in_array:" . $arrayField . "." . $key];
    }
    protected function distinct(string $rule = null): array
    {
        return is_null($rule) || !in_array($rule, ["strict", "ignore_case"]) ? ["distinct"] : ["distinct:" . $rule];
    }
    protected function size(int $size): array
    {
        return ["size:" . $size];
    }

    /* datetime */
    protected function dateFormat(string $format): array
    {
        return ["date_format:" . $format];
    }
    protected function date(): array
    {
        return $this->dateFormat("Y-m-d");
    }
    protected function time(): array
    {
        return $this->dateFormat("H:i:s");
    }
    protected function datetime(): array
    {
        return $this->dateFormat("Y-m-d H:i:s");
    }
    protected function yearMonth(): array
    {
        return $this->dateFormat("Y-m");
    }
    protected function monthDay(): array
    {
        return $this->dateFormat("m-d");
    }
    protected function hourMunite(): array
    {
        return $this->dateFormat("H:i");
    }
    protected function muniteSecond(): array
    {
        return $this->dateFormat("i:s");
    }
    protected function year(): array
    {
        return $this->dateFormat("Y");
    }
    protected function month(): array
    {
        return $this->dateFormat("n");
    }
    protected function day(): array
    {
        return $this->dateFormat("j");
    }
    protected function hour(): array
    {
        return $this->dateFormat("G");
    }
    protected function minute(): array
    {
        return $this->dateFormat("i");
    }
    protected function second(): array
    {
        return $this->dateFormat("d");
    }
    protected function dateEqual(string $date): array
    {
        return ["date_equals:" . $date];
    }
    protected function after(string $dateOrField): array
    {
        return ["after:" . $dateOrField];
    }
    protected function afterOrEqual(string $dateOrField): array
    {
        return ["after_or_equal:" . $dateOrField];
    }
    protected function before(string $dateOrField): array
    {
        return ["before:" . $dateOrField];
    }
    protected function beforeOrEqual(string $dateOrField): array
    {
        return ["before_or_equal:" . $dateOrField];
    }
    protected function timezone(): array
    {
        return ["timezone"];
    }

    /* file */
    protected function file(): array
    {
        return ["file"];
    }
    protected function image(): array
    {
        return ["image"];
    }
    protected function mimes(array $mimes): array
    {
        return ["mimes:" . implode(",", $mimes)];
    }
    protected function mimetypes(array $mimetypes): array
    {
        return ["mimetypes:" . implode(",", $mimetypes)];
    }
    protected function dimensions(): Rules\Dimensions
    {
        return Rule::dimensions();
    }

    /* other */
    protected function requiredIf(string $field, array $values): array
    {
        return ["required_if:" . $field . "," . implode(",", $values)];
    }
    protected function requiredUnless(string $field, array $values): array
    {
        return ["required_unless:" . $field . "," . implode(",", $values)];
    }
    protected function requiredWith(array $fields): array
    {
        return ["required_with:" . implode(",", $fields)];
    }
    protected function requiredWithAll(array $fields): array
    {
        return ["required_with_all:" . implode(",", $fields)];
    }
    protected function requiredWithout(array $fields): array
    {
        return ["required_without:" . implode(",", $fields)];
    }
    protected function requiredWithoutAll(array $fields): array
    {
        return ["required_without_all:" . implode(",", $fields)];
    }
    protected function requiredArrayKeys(array $keys): array
    {
        return ["required_array_keys:" . implode(",", $keys)];
    }

    protected function exists(string $table, string $column): Rules\Exists
    {
        return Rule::exists($table, $column)->whereNull("deleted_at");
    }
    protected function unique(string $table, string $column): Rules\Unique
    {
        return Rule::unique($table, $column)->whereNull("deleted_at");
    }

    protected function regex(string $regex): array
    {
        return ["regex:" . $regex];
    }
    protected function notRegex(string $regex): array
    {
        return ["not_regex:" . $regex];
    }

    protected function max(string $num): array
    {
        return ["max:" . $num];
    }
    protected function min(string $num): array
    {
        return ["min:" . $num];
    }

    protected function gt(string $field): array
    {
        return ["gt:" . $field];
    }
    protected function gte(string $field): array
    {
        return ["gte:" . $field];
    }
    protected function lt(string $field): array
    {
        return ["lt:" . $field];
    }
    protected function lte(string $field): array
    {
        return ["lte:" . $field];
    }

    protected function accepted(): array
    {
        return ["accepted"];
    }
    protected function acceptedIf(string $field, mixed $value): array
    {
        return ["accepted_if:" . $field . "," . $value];
    }
    protected function declined(): array
    {
        return ["declined"];
    }
    protected function declinedIf(string $field, mixed $value): array
    {
        return ["declined_if:" . $field . "," . $value];
    }

    protected function between(int $min, int $max): array
    {
        return ["between:" . $min . "," . $max];
    }
    protected function in(array $values): Rules\In
    {
        return Rule::in($values);
    }
    protected function notIn(array $values): Rules\NotIn
    {
        return Rule::notIn($values);
    }

    protected function confirmed(): array
    {
        return ["confirmed"];
    }
    protected function different(string $field): array
    {
        return ["different:" . $field];
    }
    protected function same(string $field): array
    {
        return ["same:" . $field];
    }

    protected function startsWith(array $values): array
    {
        return ["starts_with:" . implode(",", $values)];
    }
    protected function doesntStartWith(array $values): array
    {
        return ["doesnt_start_with:" . implode(",", $values)];
    }
    protected function endsWith(array $values): array
    {
        return ["ends_with:" . implode(",", $values)];
    }
    protected function doesntEndWith(array $values): array
    {
        return ["doesnt_end_with:" . implode(",", $values)];
    }

    protected function enum(string $enumClass): Rules\Enum
    {
        return Rule::enum($enumClass);
    }
}

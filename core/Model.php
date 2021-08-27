<?php

namespace app\core;

abstract class Model
{
    public const REQUIRED_RULE = 'required';
//    public const UNIQUE_RULE = 'unique';
    public const EMAIL_RULE = 'email';
    public const MIN_RULE = 'min';
    public const MAX_RULE = 'max';
    public const MATCH_RULE = 'match';

    public function loadData($data) {
        foreach ($data as $name => $value) {
            if (property_exists($this, $name)) $this->{$name} = $value;
        }
    }

    abstract protected function rules(): array;

    public array $errors = [];

    public function validate(): bool {
        foreach ( $this->rules() as $attribute => $rules ) {
            $value = $this->{$attribute};
            foreach ( $rules as $rule ) {
                $ruleName = $rule;
                if ( is_array($rule) ) $ruleName = $rule[0];

                if ( $ruleName === self::REQUIRED_RULE && !$value ) {
                    $this->pushError($attribute, self::REQUIRED_RULE);
                }
                if ( $ruleName === self::EMAIL_RULE &&
                    !filter_var($value, FILTER_VALIDATE_EMAIL) ) {
                    $this->pushError($attribute, self::EMAIL_RULE);
                }
                if ( $ruleName === self::MIN_RULE && strlen($value) < $rule['min'] ) {
                    $this->pushError($attribute, self::MIN_RULE, $rule);
                }
                if ( $ruleName === self::MAX_RULE && strlen($value) > $rule['max'] ) {
                    $this->pushError($attribute, self::MAX_RULE, $rule);
                }
                if ( $ruleName === self::MATCH_RULE && $value !== $this->{$rule['match']} ) {
                    $this->pushError($attribute, self::MATCH_RULE, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    public function pushError(string $attribute, string $rule, array $params = []) {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ( $params as $key => $value ) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
//            TODO: State field name in error message.
            self::REQUIRED_RULE => "This field is required",
//            TODO: Add for UNIQUE_RULE.
            self::EMAIL_RULE => "This field must be a valid email address",
            self::MIN_RULE => "This field cannot have less than {min} characters",
            self::MAX_RULE => "This field cannot have more than {max} characters",
            self::MATCH_RULE => "This field must match {match} field",
        ];
    }

    public function hasError(string $attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError(string $attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

}
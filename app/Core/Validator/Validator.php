<?php

namespace App\Core\Validator;

class Validator
{
    private array $errors = [];
    private array $data = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;
        foreach ($rules as $key => $rule) {
            $value = $this->data[$key] ?? null;
            if (is_array($rule)) {
                foreach ($rule as $ruleValue) {
                    $error = $this->validateRule($value, $ruleValue);
                    if (!empty($error)) {
                        $this->errors[$key] = $error;
                    }
                }
            } else {
                $error = $this->validateRule($value, $rule);
                if (!empty($error)) {
                    $this->errors[$key] = $error;
                }
            }
        }
        return empty($this->errors);
    }

    public function validated() : array
    {
        return $this->data;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validateRule($value, $rule): string|null
    {
        $rule = explode(':', $rule);
        $ruleName = $rule[0];

        if (count($rule) > 1) {
            $ruleValue = $rule[1];
        }

        $value = trim($value);

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return 'This field is required.';
                }
                break;
            case 'min':
                if (strlen($value) < intval($ruleValue)) {
                    return 'Field is must be at least ' . $ruleValue . ' characters.';
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return 'Field is must be less than ' . $ruleValue . ' characters.';
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return 'Field is not a valid email address.';
                }
                break;
        }
        return null;
    }
}

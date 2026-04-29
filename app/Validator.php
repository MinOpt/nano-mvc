<?php
namespace App;

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $ruleSet) {
            $value = $data[$field] ?? null;
            foreach (explode('|', $ruleSet) as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $this->errors[$field][] = "Поле обязательно";
                }
                if (str_starts_with($rule, 'min:')) {
                    $min = (int) substr($rule, 4);
                    if (strlen($value) < $min) $this->errors[$field][] = "Минимум $min символов";
                }
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = "Некорректный email";
                }
            }
        }
        return empty($this->errors);
    }

    public function errors(): array { return $this->errors; }
}
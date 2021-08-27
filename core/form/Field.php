<?php

namespace app\core\form;

use app\core\Model;

class Field
{
//    TODO: Check for enums in PHP
    public const TEXT_TYPE = 'text';
    public const EMAIL_TYPE = 'email';
    public const PASSWORD_TYPE = 'password';
    public const NUMBER_TYPE = 'number';

    public Model $model;
    public string $attribute;
    public string $type;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, string $type) {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function __toString()
    {
        return sprintf('
            <div class="form-group mb-3">
                <label for="%s" class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" id="%s" class="form-control %s">
                <div class="invalid-feedback">%s</div>
            </div>
        ', $this->attribute, $this->attribute, $this->type,                 // for, label, type
            $this->attribute, $this->model->{$this->attribute}, $this->attribute,   // name, value, id
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',           // class
            $this->model->getFirstError($this->attribute)                           // errorMessage
        );

//        return <<<FIELD
//            <div class="form-group mb-3">
//                <label for="$this->attribute" class="form-label">$this->attribute</label>
//
//                <input type="text" name="$this->attribute"
//                 value="$this->model->{$this->attribute}" id="$this->attribute"
//                  class="form-control $this->model->hasError($this->attribute) ? 'is-invalid' : ''"  >
//
//                <div class="invalid-feedback">$this->model->getFirstError($this->attribute)</div>
//            </div>
//        FIELD;
    }

}
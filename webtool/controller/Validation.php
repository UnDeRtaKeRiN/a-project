<?php
/**
 * Created by PhpStorm.
 * User: oezdemir
 * Date: 03.04.2017
 * Time: 12:14
 */

class Validation{

    private $formName;
    private $fields = array();
    private $values = array();
    private $post = array();
    private $validationRules = array();
    private $errors = array();

    public function __construct($formName, $fields){
        $this->formName = $formName;
        $this->fields = $fields;
    }

    public function validate()
    {
        $this->post = $_POST[$this->formName];

        /**todo xss prevention -> done as output escape*/
        foreach ($this->post as $key => $post)
        {
            if (in_array($key, $this->fields)){
                $this->values[$key] = trim($post);
            }
        }

        foreach ($this->validationRules as $fieldName => $ruleInfo)
        {
            if(! isset($this->values[$fieldName])) {
                continue;
            }

            $value =  $this->values[$fieldName];
            foreach ($ruleInfo as $ruleName => $message)
            {
                switch ($ruleName)
                {
                    case 'salutation':
                        $this->salutationRule($fieldName, $value, $message);
                        break;
                    case 'prename':
                        $this->prenameRule($fieldName, $value, $message);
                        break;
                    case 'surname':
                        $this->surnameRule($fieldName, $value, $message);
                        break;
                    case 'email':
                        $this->emailRule($fieldName, $value, $message);
                        break;
                    case 'queue':
                        $this->queueRule($fieldName, $value, $message);
                        break;
                    case 'subject':
                        $this->subjectRule($fieldName, $value, $message);
                        break;
                    case 'ticketmessage':
                        $this->messageRule($fieldName, $value, $message);
                        break;
                    case 'username':
                        $this->usernameRule($fieldName, $value, $message);
                        break;
            }
            }
        }
    }

    public function addValidationRule($fieldName, $rule, $errorMessage ='Leider ist ein Fehler bei der Validierung aufgetreten'){
        $this->validationRules[$fieldName][$rule] = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getFormName()
    {
        return $this->formName;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    public function getSubmitValue($key){
        if (array_key_exists($key, $this->values)){
            return $this->values[$key];
        }
        return '';
    }

    private function salutationRule($fieldName, $value, $message){
        if ($value == '')
            $this->errors[$fieldName] = $message;
    }

    private function prenameRule($fieldName, $value, $message){
        if ($value == '')
            $this->errors[$fieldName] = $message;
    }
    private function surnameRule($fieldName, $value, $message){
        if ($value == '')
            $this->errors[$fieldName] = $message;
    }

    private function emailRule($fieldName, $value, $message){
        if ($value == '' OR $value != filter_var($value, FILTER_VALIDATE_EMAIL))
            $this->errors[$fieldName] = $message;
    }

    private function queueRule($fieldName, $value, $message){
        if ($value == '')
            $this->errors[$fieldName] = $message;
    }

    private function subjectRule($fieldName, $value, $message){
        if ($value == '')
            $this->errors[$fieldName] = $message;
    }

    private function messageRule($fieldName, $value, $message){
        if ($value == '')
            $this->errors[$fieldName] = $message;
    }

    private function usernameRule($fieldName, $value, $message){
        if ($value == '')
            $this->errors[$fieldName] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
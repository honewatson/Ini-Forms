<?php

namespace ini_forms;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ini_form
 *
 * @author honhon
 */
class ini_form {
    
    protected static $ini_base_folder;
    protected static $ini_conf;
    protected static $ini_templates;
    protected static $ini_base_defaults;
    protected static $field_defaults = array();
    protected static $set_up_completed = null;
    
    public $form;
    public $prepare_fields = array();

    public function __construct($ini_file){
        if(static::$set_up_completed === null)
            $this->set_ini_forms();
        $form = parse_ini_file(static::$ini_conf . $ini_file . ".ini", true);

        $this->form = $form['form'];
        unset($form['form']);
        $this->fields = $form;
    }
    
    public function prepare_fields(){
        foreach($this->fields as $field => $values)
            $this->prepare_field($field, $values);
        return $this->prepare_fields;
    }
    
    public function set_then_prepare_fields($already_values){
         foreach($this->fields as $field => $values){
             if(isset($already_values[$field]))
                $values['value'] = $already_values[$field];
             $this->prepare_field($field, $values);
         }
        return $this->prepare_fields;       
    }
    
    public function prepare_field($field, $values){
        extract(array_merge($this->get_defaults($values['type']),$values ));
        if(isset($label) && !$label)
            $label = ucwords(str_replace("_", " ", $field));
        ob_start();
        include static::$ini_templates . $values['type'] . ".php";
        $this->prepare_fields[] = ob_get_clean();
        
    }
    
    public function get_defaults($type){

        if( !isset( static::$field_defaults[$type] ) ) {
                $defaults = parse_ini_file(static::$ini_base_defaults . $type . ".ini", true);
                static::$field_defaults[$type] = $defaults[$type];
        }
        return static::$field_defaults[$type];
    }
    
    public function prepare_form($form){
        return array_merge($this->get_defaults($form), $this->form );
    }
    
    public function render_form($form = 'form'){
        $fields = implode("\n", $this->prepare_fields());
        return $this->_render_form($form, $fields);
    }
    
    public function render_form_from_values($values, $form = 'form'){
        $fields = implode("\n", $this->set_then_prepare_fields($values));
        return $this->_render_form($form, $fields);
    }
    
    public function _render_form($form, $fields){
        
        extract($this->prepare_form($form));
        ob_start();
        include static::$ini_templates . "$form.php";
        return ob_get_clean();        
    }
    
    public static function set_ini_forms($ini_folder = null, $ini_field = 'ini_forms\ini_field'){
        if($ini_folder === null)
            static::$ini_base_folder = dirname(__FILE__)."/";
        static::$ini_conf = static::$ini_base_folder. "ini/";
        static::$ini_templates = static::$ini_base_folder. "templates/";
        static::$ini_base_defaults = static::$ini_base_folder. "defaults/";
    }
    
    
}

?>

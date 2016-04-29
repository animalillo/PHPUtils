<?php
/**
 * Coppyright (C) 2016 Marcos Zuriaga Miguel
 * all rights reserved
 */
namespace AQ {
    /**
     * Interfacing methods to autofill the class public vars from any class
     * or array of stdClass (or any other valid class) instances
     *
     * @author wolfi
     */
    class CIObject {
        
        /**
         * Returns an array with instances of this object with the properties set 
         * from the properties on the array objects
         * @param \stdClass[] $array
         * @return self[]
         */
        static function fromSTDArray($array){
            $ret = [];
            foreach ($array as $value) {
                $ret[] = static::fromSTDObject($value);
            }
            return $ret;
        }
        
        /**
         * Creates an instance of the class, setting all it's public properties
         * to the ones set on the std object (json_decode or codeigniter result)
         * @param \stdClass $object
         * @return \self    A new instance of the object
         */
        static function fromSTDObject(\stdClass $object){
            $self = static::class;
            $reflect = new \ReflectionClass($self);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

            $ret = new $self();
            foreach ($props as $prop) {
                if (isset($object->{$prop->name})){
                    $ret->{$prop->name} = $object->{$prop->name};
                }
            }
            $ret->_post_init_process();
            return $ret;
        }
        
        /**
         * Executed after creating the object using the fromSTDObject method
         */
        private function _post_init_process(){
            
        }
    }
}
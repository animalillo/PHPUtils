# PHPUtils
Helpers and utilities for php projects.

This project contains some helper utilities and classes I've created while working on peojects for Aquaventur S.L. 
and that i think might be of some interest for other developers out there.

## Usage

Everything is containid withing the namespace AQ to avoid conflicts with other libraries.

### Available classes
---------------------
#### CIObject
For now I've just released the CIObject class, which i created for working with some codeigniter classes but that it's way more
useful than that.

This class has some static methods that allow any class extending this one to get it's public members filled from the accessible
ones of the class you feed the methods. You can also get an array of typed objects filled with values from some other objects.

The usage is pretty simple, you extend from it and call the inherited methods from your new created class. Example:
  ```php
  class MyClass extends \AQ\CIObject {
    public $my_property;
    public $hello;
  }
  
  $tmp = json_decode('{"my_property" : "this is my property content", "hello" : "world"}');
  
  $my_class_instance = MyClass::fromSTDObject($tmp);
  ```
This simple example would create a fully typed object from some json data, and would ignore any value we are not interested into.

Most times when you create an instance of a class you need to do some processing, don't worry, you can do this right after the values are set
by overloading the _post_init_process() method that will be called right after the values are set.

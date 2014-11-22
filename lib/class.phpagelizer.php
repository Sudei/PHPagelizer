<?php

/**
 * PHPagalizer
 *
 * An easy to use class to create pagination
 *
 * @author      Kevin WENGER <contact@kevin-wenger.ch>
 * @license     http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version     1.0
 */
class PHPagelizer{

// -------------------------------------------------------------------------------------------------
// ATTRIBUTES

  private $pagination = array();
  private $count = 0;
  private $options = array(
    'perpage' => 10,
    'page' => null,
    'total' => null,
    'adjacents' => 4,
  );

// -------------------------------------------------------------------------------------------------
// CONSTRUCTOR AND DESTRUCTOR

  /**
   * Multiple constructors with type signetures (almost overloading)
   */
  public function __construct() {
    $args = func_get_args();
    $i = func_num_args();
    if (method_exists($this,$constructor='__construct'.$i)) {
      call_user_func_array(array($this,$constructor),$args);
    }else {
      $this->_errorHandler('NO CONSTRUCTOR: ' . get_class() . $constructor, E_USER_ERROR);
    }
  }

  public function __construct1($page) {
    $this->_errorHandler('Need 2 min. parameters : page AND total', E_USER_ERROR);
  }
  public function __construct2($page, $total) {
    $this->setOption('total', $total);
    $this->setOption('page', $page);
  }
  public function __construct3($page, $total, $perpage) {
    $this->setOption('total', $total);
    $this->setOption('page', $page);
    $this->setOption('perpage', $perpage);
  }
  public function __construct4($page, $total, $perpage, $adjacents) {
    $this->setOption('total', $total);
    $this->setOption('page', $page);
    $this->setOption('perpage', $perpage);
    $this->setOption('adjacents', $adjacents);
  }


// -------------------------------------------------------------------------------------------------
// PUBLIC METHODES
  public function getPagination(){
    return $this->_pager();
  }

  /**
   * Global setter for Options
   * @param [string] $key
   * @param [int] option value
   */
  public function setOption($key, $value){
    if(!$this->_validateOption($key, $value)){
      $this->options[$key] = $value;
    }
  }

  /**
   * Global getter for Options
   * @param  [string] $key
   * @return [int]
   */
  public function getOption($key){
    return $this->options[$key];
  }

/**
 * Get number of pages
 * @return [int] [description]
 */
  public function getMaxPages(){
    return $this->count;
  }

// -------------------------------------------------------------------------------------------------
// PRIVATE METHODES

  /**
   * General function throw Exception
   * @param  [string] $message
   * @return [Exception]
   */
  private function _errorHandler($message, $type){
    trigger_error(get_class() . ' : ' . $message, $type);
  }

  /**
   * Check Options validation
   * @param  [string] $key
   * @param  [int] &$value
   * @return [boolean]
   */
  private function _validateOption($key, &$value){
    $hasError = false;
    switch($key){
      case 'perpage':
      case 'page':
      case 'total':
      case 'adjacent':
        if( !empty($this->options[$key]) AND !is_int($this->options[$key]) ) {
          $hasError = true;
        }
        break;
    }

    switch($key){
      case 'perpage':
        if( $value > $this->options['total'] ){
          $value = $this->options['total'];
          $this->_errorHandler('perpage > total', E_USER_NOTICE);
        }
      case 'page':
        if( $value <= 0 ){
          $value = 1;
          $this->_errorHandler('page <= 0 ', E_USER_NOTICE);
        }

        if( $value > $this->options['total'] ){
          $value = $this->options['total'];
          $this->_errorHandler('page > total', E_USER_NOTICE);
        }
      case 'total':
      case 'adjacent':
        break;
    }

    return $hasError;
  }


/**
 * Buisness Logic - Calculating pagination
 * @return array
 */
  private function _pager() {

    if (isset($this->options['total'], $this->options['perpage']) === true) {

      $this->count = ceil($this->options['total'] / $this->options['perpage']);
      $this->pagination = range(1, $this->count);

      if (isset($this->options['page'], $this->options['adjacents']) === true) {
          if (($this->options['adjacents'] = floor($this->options['adjacents'] / 2) * 2 + 1) >= 1) {
              $this->pagination = array_slice($this->pagination, max(0, min(count($this->pagination) - $this->options['adjacents'], intval($this->options['page']) - ceil($this->options['adjacents'] / 2))), $this->options['adjacents']);
          }
      }
    }
    return $this->pagination;
 }

}

?>

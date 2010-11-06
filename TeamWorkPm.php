<?php

/**
 *
 * @package    TeamWorkPm
 * Copyright   @ Loduis Madariaga
 * @license    LICENCE.txt
 * @version    0.0.1-dev
 */

if (!function_exists('forward_static_call_array')) {
    function forward_static_call_array($function , array $parameters = array()) {
        if (is_array($function)) {
            list ($class, $method) = $function;
            $function = $class . '::' . $method;
        }
        $c = false;
        $params = '';
        foreach ($parameters as $param) {
            if ($c) {
                $params .= ',';
            }
            $params .= var_export($param, true);
            $c = true;
        }
        $eval = 'return ' . $function . '(' . $params . ');';
        
        return eval($eval);
    }
}

class TeamWorkPm
{
    /**
     * @var string
     */
    const PROJECT = 'Project';
    /**
     * @var string
     */
    const MILESTONE = 'Milestone';

    const TODO_LIST = 'Todo_List';

    const TODO_ITEM = 'Todo_Item';

    const POST = 'Post';

    const COMPANY = 'Company';

    const REPORT = 'Report';

    const REPLY = 'Reply';

    const CATEGORY_MESSAGE = 'Category_Message';

    const CATEGORY_FILE = 'Category_File';

    const CATEGORY_NOTEBOOK = 'Category_Notebook';

    const CATEGORY_RESOURCE =  'Category_Resource';

    const COMMENT_MILESTONE = 'Comment_Milestone';
    
    const COMMENT_ITEM       = 'Comment_Item';


    private static $_COMPANY = 'phpapi';

    private static $_API_KEY = 'mess146balas';
  
    private function  __construct()
    {

    }
    /**
     *
     * @param string $class
     * @return TeamWorkPm_Model
     */
    final public static function factory($class)
    {
        $class = __CLASS__ . '_' .  $class;
        
        return forward_static_call_array(
              array($class, 'getInstance'),
              array(self::$_COMPANY, self::$_API_KEY, $class)
        );
    }

    public static function setAuth($company, $key)
    {
        self::$_COMPANY = $company;
        self::$_API_KEY = $key;
    }

    final private function __clone() {}
}
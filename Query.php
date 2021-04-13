<?php

class Query{

    public static function __callStatic($method, $arguments)
    {
       $query = new \Core\Database\QueryBuilder();
       return call_user_func_array([$query, $method],$arguments);
    }

}
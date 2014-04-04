<?php 
Validator::extend('alpha_num_spaces', function($attribute, $value)
{
    return preg_match('/^[\d\pL\s]+$/u', $value);
});
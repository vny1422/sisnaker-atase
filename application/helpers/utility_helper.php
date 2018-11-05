<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     if ( ! function_exists('assets_url()'))
     {
       function assets_url()
       {
          return base_url().'assets/';
       }
       function unaccounting($number)
		{
		    return str_replace(',', '', $number);
		}
		function date_database($date, $format = 'd-m-Y')
		{
		    try {
		        return DateTime::createFromFormat($format, $date);
		    } catch (Exception $e) {
		        return null;
		    }
		}
		function date_view($date, $format = 'd-m-Y')
		{
		    $time = strtotime($date);
		    if (!$time) {
		        return '';
		    }
		    return date($format, $time);
		}
     }
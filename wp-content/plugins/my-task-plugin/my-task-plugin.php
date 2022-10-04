<?php

/**
 * @package MyTaskPlugin
 */
/**
 Plugin Name: My Task Plugin
 Plugin URI: 
 Description: This is Task Plugin
 Version: 1.0.0
 Author:Yousuf
 */

//Security Check
defined('ABSPATH') or die('Not Allow on this page');

if (file_exists(dirname(__FILE__)) . '/vendor/autoload.php') {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}


function Activate_MyTask_plugin()
{
  inc\Base\Activate::activate();
}
function Deactivate_MyTask_plugin()
{
  inc\Base\Deactivate::deactivate();
}

//Activation
register_activation_hook(__FILE__, 'Activate_MyTask_plugin');

//Deactivation
register_deactivation_hook(__FILE__, 'Deactivate_MyTask_plugin');




if (class_exists('inc\\Init')) {
  inc\Init::register_services();
}


// configure the Google Client
$client = new \Google_Client();
$client->setApplicationName('Google Sheets API');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
// credentials.json is the key file we downloaded while setting up our Google Sheets API
$path = dirname(__FILE__) . '/asset/googleapicredentails/credentials.json';
$client->setAuthConfig($path);

// configure the Sheets Service
$service = new \Google_Service_Sheets($client);

// the spreadsheet id can be found in the url https://docs.google.com/spreadsheets/d/143xVs9lPopFSF4eJQWloDYAndMor/edit
$spreadsheetId = '1JHhiWPobfprCf09j_GIyrF-qXEqkqT_FVgCoTJjoMeA';
$spreadsheet = $service->spreadsheets->get($spreadsheetId);
// get all the rows of a sheet
$range = 'Sheet1'; // here we use the name of the Sheet to get all the rows
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
foreach ($values as $key => $value) {
    if(in_array('annualfee',$value)){
      var_dump($key);
    }
}
//print_r('<pre>');print_r($response);print_r('<pre>');
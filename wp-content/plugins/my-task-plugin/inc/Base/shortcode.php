<?php
function google_spread_sheet_api($spread_sheet_Id, $spread_sheet_name)
{
    // configure the Google Client
    $client = new \Google_Client();
    $client->setApplicationName('Google Sheets API');
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAccessType('offline');
    // credentials.json is the key file we downloaded while setting up our Google Sheets API
    $path = plugin_dir_path(dirname(__FILE__, 2)) . '/asset/googleapicredentails/credentials.json';
    $client->setAuthConfig($path);

    // configure the Sheets Service
    $service = new \Google_Service_Sheets($client);

    // the spreadsheet id can be found in the url https://docs.google.com/spreadsheets/d/143xVs9lPopFSF4eJQWloDYAndMor/edit
    $spreadsheetId = $spread_sheet_Id;
    $spreadsheet = $service->spreadsheets->get($spreadsheetId);
    // get all the rows of a sheet
    $range = $spread_sheet_name; // here we use the name of the Sheet to get all the rows
    try {
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        foreach ($values as $key => $value) {

            if (in_array('Date', $value)) {
                var_dump($key);
            }
        }
    }
    //catch exception
    catch (Exception $e) {
        echo 'Message: ' . $e->getmessage();
    }
}
add_shortcode('cm', 'shortcode_sheet_callback_function');
function shortcode_sheet_callback_function($atts)
{
    // Spread Sheet ID
    $options = get_option('my_task_sheet_field_plugin_options');
    if (isset($atts['spread_sheet_filed_id']) && !empty($atts['spread_sheet_filed_id'])) {
        $atts['spread_sheet_filed_id'] = (int)$atts['spread_sheet_filed_id'];
        if ($atts['spread_sheet_filed_id'] > 0) {
            $id = $atts['spread_sheet_filed_id'] - 1;
        } else {
            $id = 0;
        }
        $sheet_field = $options['sheet_field'][$id];
        if (!empty($sheet_field)) {
            $spread_sheet_Id = $sheet_field;
        } else {
            $spread_sheet_Id =  $options['sheet_field'][0];
        }
    } else {
        $spread_sheet_Id =  $options['sheet_field'][0];
    }
    // Spread Sheet ID

    // Spread Sheet Name
    if (isset($atts['spread_sheet_name']) && !empty($atts['spread_sheet_name'])) {
        $spread_sheet_name = $atts['spread_sheet_name'];
    } else {
        $spread_sheet_name = 'Sheet1';
    }
    // Spread Sheet Name
    extract(shortcode_atts(array(
        'spread_sheet_Id' => $spread_sheet_Id,
        'spread_sheet_name' => $spread_sheet_name,
    ), $atts));
    // var_dump($spread_sheet_name);
    google_spread_sheet_api($spread_sheet_Id, $spread_sheet_name);
}

<?php
function google_spread_sheet_api($spread_sheet_Id, $spread_sheet_name, $spread_sheet_Range)
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
    try {
        $spreadsheetId = $spread_sheet_Id;
        $spreadsheet = $service->spreadsheets->get($spreadsheetId);
    }
    //catch exception
    catch (Exception $e) {
        echo 'Message: Requested entity was not found <br>';
    }
    // get all the rows of a sheet
    if (!empty($spread_sheet_Range)) {
        $range = $spread_sheet_name . '!' . $spread_sheet_Range;
    } else {
        $range = $spread_sheet_name; // here we use the name of the Sheet to get all the rows
    }
    try {
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        echo '<table>';
        $i = 0;
        foreach ($values as $key => $valuez) {
            foreach ($valuez as $key => $value) {
                if ($i == 0) {
                    echo  '<tr><th>' . $value . '</th></tr>';
                } else {
                    echo '<tr><td>' . $value . '</td></tr>';
                }
                $i++;
            }
        }
        echo '</table>';
    }
    //catch exception
    catch (Exception $e) {
        echo 'Message: Unable to parse range';
    }
}
//ShortCode
if (!is_admin()) {
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
        // Spread Sheet Range
        if (isset($atts['spread_sheet_range']) && !empty($atts['spread_sheet_range'])) {
            $spread_sheet_Range = $atts['spread_sheet_range'];
        } else {
            $spread_sheet_Range = '';
        }

        // Spread Sheet Range
        // Spread Sheet Range
        if (isset($atts['major_dimension']) && !empty($atts['major_dimension'])) {
            $major_dimension = $atts['major_dimension'];
        } else {
            $major_dimension = 'COLUMNS';
        }

        // Spread Sheet Range
        extract(shortcode_atts(array(
            'spread_sheet_Id' => $spread_sheet_Id,
            'spread_sheet_name' => $spread_sheet_name,
            'spread_sheet_range' => $spread_sheet_Range
        ), $atts));

        google_spread_sheet_api($spread_sheet_Id, $spread_sheet_name, $spread_sheet_Range);
    }
}

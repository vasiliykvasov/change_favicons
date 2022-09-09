<?
function change_favicons() {
    $favicons = [
        "site1" => [
            "old_favicon" => "/home/bitrix/ext_www/site1/favicon.ico", // Старый фавикон
            "new_favicon" => "/home/bitrix/www/upload/favicon/site1/favicon.ico" // Новый фавикон
        ],
        "site2" => [
            "old_favicon" => "/home/bitrix/ext_www/site2/favicon.ico", // Старый фавикон
            "new_favicon" => "/home/bitrix/www/upload/favicon/site2/favicon.ico" // Новый фавикон
        ],
    ];
    foreach ($favicons as $value) {
        if (file_exists($value[new_favicon])) {
                copy($value[new_favicon], $value[old_favicon]);
    	}
    }
}
change_favicons();

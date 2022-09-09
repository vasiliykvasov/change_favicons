<? // Копировать скрипт нужно без этих символов

//title: Обновление фавиконок
function change_favicons($logs) {
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
    foreach ($favicons as $value) { // Для каждого элемента массива
        if (file_exists($value[new_favicon])) { // Если новый фавикон существует
    	    if (file_exists($value[old_favicon])) { // Если старый фавикон существует
    	        if ($logs) echo($value[old_favicon] . " существует. \n");
                unlink($value[old_favicon]); // То удалить старый фавикон
    	    };
    	    if (file_exists($value[old_favicon])) { // Если старый фавикон существует
    	        if ($logs) echo($value[old_favicon] . " не удален. \n");
    	    } else {
                if ($logs) echo($value[old_favicon] . " удален. \n");
                copy($value[new_favicon], $value[old_favicon]); // Копируем новый фавикон
                if (file_exists($value[old_favicon])) { // Если обновленный фавикон существует
                    if ($logs) echo($value[old_favicon] . " обновлен. \n");
                };
            };
    	} else {
            if ($logs) echo($value[new_favicon] . " не существует. \n");
        }
    }
}
change_favicons(true);

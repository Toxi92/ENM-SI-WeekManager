<?php
function getLangData($lang = 'fr') {
    $file = __DIR__ . "/../.RessourcesExt/lang-$lang.json";
    if (!file_exists($file)) {
        // Fallback to French if the file does not exist
        $file = __DIR__ . "/.RessourcesExt/lang-fr.json";
    }
    return json_decode(file_get_contents($file), true);
}

function t($key, $langData) {
    return isset($langData[$key]) ? $langData[$key] : $key;
}
?>
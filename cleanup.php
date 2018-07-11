<?php

require_once 'config.php';

require_once 'vendor/autoload.php';
use \Uploadcare;

$api = new Uploadcare\Api(UC_PUBLIC_KEY, UC_SECRET_KEY);


$good_files = array(
    'https://ucarecdn.com/00000000-1111-2222-3333-444444444444/',
    'https://ucarecdn.com/55555555-6666-7777-8888-999999999999/'
);


foreach ($api->getFileList(array('stored' => true, 'to'=> '-14 days')) as $file) {
    print $file . " " . $file->data['datetime_uploaded'] . "\n";
    if (in_array($file->getUrl(), $good_files)) {
        print $file->getUrl() . " is GOOD\n";
    } else {
        print $file->getUrl() . " is BAD, deleting\n";
        $file->delete();
    }
}

?>
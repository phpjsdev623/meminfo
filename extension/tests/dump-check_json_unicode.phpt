--TEST--
Check JSON proper escaping (see http://json.org)
--SKIPIF--
<?php
    if (!extension_loaded('json')) die('skip json ext not loaded');
?>
--FILE--
<?php
    $myArrayWithUnicodeKey = [
        '✈' => 'plane character'
    ];

    $dump = fopen('php://memory', 'rw');

    meminfo_dump($dump);

    rewind($dump);
    $meminfoData = json_decode(stream_get_contents($dump), true);
    fclose($dump);

    if (is_array($meminfoData)) {
        echo  "meminfo_dump JSON decode ok\n";
    } else {
        echo "meminfo_dump JSON decode fail\n";
    }

?>
--EXPECT--
meminfo_dump JSON decode ok

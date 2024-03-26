<?php
$agent = '127.0.0.1';
$community = 'public';

$udpTableOID = '1.3.6.1.2.1.7.5.1';

// Fetching the UDP table data
$udpTable = snmp2_real_walk($agent, $community, $udpTableOID);

if (!empty($udpTable)) {
    $index = 0;
    foreach ($udpTable as $oid => $value) {
        $parts = explode('.', $oid);
        $address = implode('.', array_slice($parts, -4, 4));
        $port = end($parts);
        echo " IP Address: $address, Port Number: $port" . PHP_EOL;

    }
} else {
    echo "No data available" . PHP_EOL;
}
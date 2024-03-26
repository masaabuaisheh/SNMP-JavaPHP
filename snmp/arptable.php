<?php
$agent = '127.0.0.1'; // Your SNMP agent address
$community = 'public'; // Your community string

$arpTableOID = '1.3.6.1.2.1.4.22.1'; // OID for the ARP table

// Fetching the ARP table data
$arpTable = snmp2_real_walk($agent, $community, $arpTableOID);

if (!empty($arpTable)) {
    $index = 0;
    foreach ($arpTable as $oid => $value) {
        // Extracting IP address from the OID
        $parts = explode('.', $oid);
        $ipAddress = implode('.', array_slice($parts, -4, 4));

        // Keeping the full MAC address and type strings
        preg_match('/(Hex-STRING: [0-9A-Fa-f ]+)/', $value, $macMatches);
        $macAddress = isset($macMatches[1]) ? $macMatches[1] : '""';

        preg_match('/(INTEGER: \d+)/', $value, $typeMatches);
        $type = isset($typeMatches[1]) ? $typeMatches[1] : '""';

        // Print ARP table data as plain text
        echo "Index: $index,MAC: $macAddress,IP: $ipAddress,Type: $type" . PHP_EOL;
        $index++;
    }
} else {
    echo "No data available" . PHP_EOL;
}

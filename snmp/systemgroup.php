<?php
// SNMP details
$agent = '127.0.0.1';
$readCommunity = 'public';
$writeCommunity = 'private';

$elements = [
    'sysDescr' => '.1.3.6.1.2.1.1.1.0',
    'sysObjectID' => '.1.3.6.1.2.1.1.2.0',
    'sysUpTime' => '.1.3.6.1.2.1.1.3.0',
    'sysContact' => '.1.3.6.1.2.1.1.4.0',  // editable
    'sysName' => '.1.3.6.1.2.1.1.5.0',     // editable
    'sysLocation' => '.1.3.6.1.2.1.1.6.0', // editable
    // 'sysServices' => '.1.3.6.1.2.1.1.7.0',
];

// Check for POST request to update values
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['sysContact', 'sysName', 'sysLocation'] as $item) {
        if (isset($_POST[$item])) {
            snmpset($agent, $writeCommunity, $elements[$item], 's', $_POST[$item]);
        }
    }
    // Output a success message
    echo 'Values updated successfully';
    exit; // End script execution after the update
}

// Fetch SNMP data
$snmpData = [];
foreach ($elements as $key => $elem) {
    $snmpData[$key] = snmpget($agent, $readCommunity, $elem);
}

// Output SNMP data
foreach ($snmpData as $key => $value) {
    echo "$key: $value\n";
}
?>

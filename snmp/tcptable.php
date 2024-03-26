<?php
$agent = '127.0.0.1';
$community = 'public';

$tcpTableOID = '1.3.6.1.2.1.6.13.1';

$tcpTable = snmp2_real_walk($agent, $community, $tcpTableOID);

if (!empty($tcpTable)) {
    foreach ($tcpTable as $oid => $value) {
        // Parsing the OID to extract addresses and ports
        $parts = explode('.', $oid);
        $length = count($parts);
        $localAddress = implode('.', array_slice($parts, $length - 10, 4));
        $localPort = $parts[$length - 6];
        $remoteAddress = implode('.', array_slice($parts, $length - 5, 4));
        $remotePort = end($parts);

        // Extracting the TCP state from the value
        preg_match('/INTEGER: (\d+)/', $value, $stateMatches);
        $state = isset($stateMatches[1]) ? $stateMatches[1] : 'Unknown';

        // Print TCP table data as comma-separated values
        echo "Local Address: $localAddress,Local Port: $localPort,Remote Address: $remoteAddress,Remote Port: $remotePort,State: $state" . PHP_EOL;

    }
} else {
    echo "No data available" . PHP_EOL;
}

?>

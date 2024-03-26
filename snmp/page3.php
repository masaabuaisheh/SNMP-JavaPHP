<?php
$agent = '127.0.0.1'; // Your SNMP agent address
$community = 'public';  // Your community string

$arpTableOID = '1.3.6.1.2.1.4.22.1'; // OID for the ARP table

// Fetching the ARP table data
$arpTable = snmp2_real_walk($agent, $community, $arpTableOID);
?>

<!DOCTYPE html>
<html>
<head>
    <title>SNMP Manager - ARP Table</title>
    <link rel="stylesheet" href="stylep2.css">

</head>
<body>
<h1>ARP Table '1.3.6.1.2.1.4.22.1'</h1>
<div class="table-container">
    <table>
        <tr>
            <th>Index</th>
            <th>MAC</th>
            <th>IP</th>
            <th>Type</th>
        </tr>
        <?php if (!empty($arpTable)): ?>
            <?php $index = 0; ?>
            <?php foreach ($arpTable as $oid => $value): ?>
                <?php
                // Extracting IP address from the OID
                $parts = explode('.', $oid);
                $ipAddress = implode('.', array_slice($parts, -4, 4));

                // Keeping the full MAC address and type strings
                preg_match('/(Hex-STRING: [0-9A-Fa-f ]+)/', $value, $macMatches);
                $macAddress = isset($macMatches[1]) ? $macMatches[1] : '""';

                preg_match('/(INTEGER: \d+)/', $value, $typeMatches);
                $type = isset($typeMatches[1]) ? $typeMatches[1] : '""';
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo htmlspecialchars($macAddress); ?></td>
                    <td><?php echo htmlspecialchars($ipAddress); ?></td>
                    <td><?php echo htmlspecialchars($type); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No data available</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>

<?php
$agent = '127.0.0.1';
$community = 'public';

$tcpTableOID = '1.3.6.1.2.1.6.13.1';

$tcpTable = snmp2_real_walk($agent, $community, $tcpTableOID);
?>

<!DOCTYPE html>
<html>
<head>
    <title>SNMP Manager - TCP Table</title>
    <link rel="stylesheet" href="stylep2.css">
</head>
<body>
<h1>TCP Table '1.3.6.1.2.1.6.13.1'</h1>
<div class="table-container">
    <table>
        <tr>
            <th>Local Address</th>
            <th>Local Port</th>
            <th>Remote Address</th>
            <th>Remote Port</th>
            <th>State</th>
        </tr>
        <?php if (!empty($tcpTable)): ?>
            <?php foreach ($tcpTable as $oid => $value): ?>
                <?php
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
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($localAddress); ?></td>
                    <td><?php echo htmlspecialchars($localPort); ?></td>
                    <td><?php echo htmlspecialchars($remoteAddress); ?></td>
                    <td><?php echo htmlspecialchars($remotePort); ?></td>
                    <td><?php echo htmlspecialchars($state); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No data available</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>

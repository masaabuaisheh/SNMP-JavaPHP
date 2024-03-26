<?php
$agent = '127.0.0.1';
$community = 'public';

$udpTableOID = '1.3.6.1.2.1.7.5.1';

// Fetching the UDP table data
$udpTable = snmp2_real_walk($agent, $community, $udpTableOID);
?>

<!DOCTYPE html>
<html>
<head>
    <title>SNMP Manager - UDP Table</title>
    <link rel="stylesheet" href="stylep2.css">
</head>
<body>
<h1>UDP Table '1.3.6.1.2.1.7.5.1'</h1>
<div class="table-container">
    <table>
        <tr>
            <th>Index</th>
            <th>IP</th>
            <th>Port Number</th>
        </tr>
        <?php if (!empty($udpTable)): ?>
            <?php $index = 0; ?>
            <?php foreach ($udpTable as $oid => $value): ?>
                <?php
                $parts = explode('.', $oid);
                $address = implode('.', array_slice($parts, -4, 4));
                $port = end($parts);
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td> <?php echo" IpAddress: " ?><?php echo htmlspecialchars($address); ?></td>
                    <td><?php echo htmlspecialchars($port); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No data available</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>

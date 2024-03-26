<?php
// SNMP details
$agent = '127.0.0.1';
$readCommunity = 'public';
$writeCommunity = 'private';


$elements = [
    'sysDescr' => '.1.3.6.1.2.1.1.1.0',
    'sysObjectID' => '.1.3.6.1.2.1.1.2.0',
    'sysUpTime' => '.1.3.6.1.2.1.1.3.0',
    'sysContact' => '.1.3.6.1.2.1.1.4.0',  //editable
    'sysName' => '.1.3.6.1.2.1.1.5.0',     //editable
    'sysLocation' => '.1.3.6.1.2.1.1.6.0', //editable
    // 'sysServices' => '.1.3.6.1.2.1.1.7.0',
];

// Check for POST request to update values
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['sysContact', 'sysName', 'sysLocation'] as $item) {
        if (isset($_POST[$item])) {
            snmpset($agent, $writeCommunity, $elements[$item], 's', $_POST[$item]);
        }
    }
    // Set a success message in the session
    $_SESSION['success_message'] = ' Values updated successfully';
}

// Fetch SNMP data
$snmpData = [];
foreach ($elements as $key => $elem) {
    $snmpData[$key] = snmpget($agent, $readCommunity, $elem);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>SNMP Manager - System Group</title>
    <link rel="stylesheet" href="stylep1.css">
</head>
<body>
<div class="container">
    <h1>System Group Information '1.3.6.1.2.1.1'</h1>
    <form method="post">
        <?php foreach ($snmpData as $key => $value): ?>
            <div>
                <label for="<?php echo $key; ?>"><?php echo $key; ?>:</label>
                <?php if (in_array($key, ['sysContact', 'sysName', 'sysLocation'])): ?>
                    <input class="text" type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
                <?php else: ?>
                    <span><?php echo $value; ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <input class="sub" type="submit" value="Update" />
    </form>
</div>

<?php
// Check if a success message exists in the session
if (isset($_SESSION['success_message'])) {
    echo '<p>' . $_SESSION['success_message'] . '</p>';
    // Remove the success message from the session so it won't appear on subsequent requests
    unset($_SESSION['success_message']);
}
?>
</body>
</html>

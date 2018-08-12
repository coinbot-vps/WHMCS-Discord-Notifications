<?php
//////// Configuration Information ////////

$GLOBALS['discordWebHookURL'] = "https://discordapp.com/api/webhooks/474106391028563978/uBbP3QiE12XAd5sa1ICUJGI-dRoRX3VGx-5Ym2XYbZuGKPyNqME0QVZrgCSH6hIpD_cT";
// Your Discord WebHook URL. Please be aware that the channel which you select to create the web hook is the channel which will be used for sending messages.

$GLOBALS['whmcsAdminURL'] = "https://billing.coinbotvps.com/admin/";
// Your WHMCS Admin URL. Please include the end / on your URL. An example of an accepted link would be: https://account.whmcs.com/admin/

$GLOBALS['companyName'] = "CoinBotVPS";
// Your Company Name. This will be the name of the user which sends the messages.

$GLOBALS['discordGroupID'] = "\@&474107859802652692";
// Discord Group ID Config Option. If you wished for each message which is sent to ping a specific group, please place the ID here. An example of a group ID is: @&343029528563548162

add_hook('InvoicePaid', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => '',
                'color' => '5653183',
                'author' => array(
                    'name' => 'Invoice Payment Received'
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('InvoiceRefunded', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => '',
                'color' => '5653183',
                'author' => array(
                    'name' => 'Invoice Refunded'
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('AcceptOrder', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => '',
                'color' => '5653183',
                'author' => array(
                    'name' => 'New Accepted Order'
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('CancellationRequest', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'url' => $GLOBALS['whmcsAdminURL'] . 'cancelrequests.php',
                'timestamp' => date(DateTime::ISO8601),
                'description' => $vars['reason'],
                'color' => '5653183',
                'author' => array(
                    'name' => 'New Cancellation Request'
                ),
                'fields' => array(
                    array(
                        'name' => 'Product ID',
                        'value' => $vars['relid'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Cancellation Type',
                        'value' => $vars['type'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'User ID',
                        'value' => $vars['userid'],
                        'inline' => true
                    )
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('FraudOrder', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => '',
                'color' => '5653183',
                'author' => array(
                    'name' => 'Order Marked As Fraud'
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('NetworkIssueAdd', 1, function($vars) {
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['announcementid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => $vars['reason'],
                'color' => '5653183',
                'author' => array(
                    'name' => 'New Network Issue'
                ),
                'fields' => array(
                    array(
                        'name' => 'Start Date',
                        'value' => $vars['startdate'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'End Date',
                        'value' => $vars['enddate'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Title',
                        'value' => $vars['title'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Description',
                        'value' => $vars['description'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Priority',
                        'value' => $vars['priority'],
                        'inline' => true
                    )
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('PendingOrder', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => '',
                'color' => '5653183',
                'author' => array(
                    'name' => 'New Pending Order'
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('TicketOpen', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'title' => $vars['subject'],
                'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => '',
                'color' => '5653183',
                'author' => array(
                    'name' => 'New Support Ticket'
                ),
                'fields' => array(
                    array(
                        'name' => 'Priority',
                        'value' => $vars['priority'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Department',
                        'value' => $vars['deptname'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Ticket ID',
                        'value' => $vars['ticketid'],
                        'inline' => true
                    )
                )
            )
        )
    );
    processNotification($dataPacket);
});
add_hook('TicketUserReply', 1, function($vars)	{
    $dataPacket     = array(
        'content' => $GLOBALS['discordGroupID'],
        'username' => $GLOBALS['companyName'],
        'embeds' => array(
            array(
                'title' => $vars['subject'],
                'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
                'timestamp' => date(DateTime::ISO8601),
                'description' => '',
                'color' => '5653183',
                'author' => array(
                    'name' => 'New Ticket Reply'
                ),
                'fields' => array(
                    array(
                        'name' => 'Priority',
                        'value' => $vars['priority'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Department',
                        'value' => $vars['deptname'],
                        'inline' => true
                    ),
                    array(
                        'name' => 'Ticket ID',
                        'value' => $vars['ticketid'],
                        'inline' => true
                    )
                )
            )
        )
    );
    processNotification($dataPacket);
});
function processNotification($dataPacket)	{
    $dataString        = json_encode($dataPacket);
    $curl              = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['discordWebHookURL']);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
    $output = curl_exec($curl);
    $output = json_decode($output, true);
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
        echo "Failed " . curl_getinfo($curl, CURLINFO_HTTP_CODE) . "<br><br>";
        print_r($output);
    }
    curl_close($curl);
}
?>

<?php

/* 
HOOKS INDEX:        https://developers.whmcs.com/hooks/hook-index/ 
HOOKS REFERENCE:    https://developers.whmcs.com/hooks-reference/
Google Sheet:       https://docs.google.com/spreadsheets/d/1hleyO3GW0hUQSTiv_PDU-ENYYdB05zpTzZ9p55IjcLI/edit#gid=1313996946
*/

//============================================================================
//                                                                            
//   ####   #####   ##     ##  #####  ##   ####    ##   ##  #####    #####  
//  ##     ##   ##  ####   ##  ##     ##  ##       ##   ##  ##  ##   ##     
//  ##     ##   ##  ##  ## ##  #####  ##  ##  ###  ##   ##  #####    #####  
//  ##     ##   ##  ##    ###  ##     ##  ##   ##  ##   ##  ##  ##   ##     
//   ####   #####   ##     ##  ##     ##   ####     #####   ##   ##  #####  
//                                                                            
//============================================================================

$GLOBALS['ONEEZYdiscordWebHookTicketsURL'] = "https://discordapp.com/api/webhooks/476142922929274880/zot639fSIJuHXx9shgRG86lkXzBC6xR__owqOji8L6BvPZPLQEMar3uyuMOatMs1obEg";
// Your Discord WebHook URL. Please be aware that the channel which you select to create the web hook is the channel which will be used for sending messages.

$GLOBALS['ONEEZYwhmcsAdminURL'] = "https://billing.coinbotvps.com/admin/";
// Your WHMCS Admin URL. Please include the end / on your URL. An example of an accepted link would be: https://account.whmcs.com/admin/

$GLOBALS['ONEEZYcompanyName'] = "Coinbot VPS";
// Your Company Name. This will be the name of the user which sends the messages.

$GLOBALS['ONEEZYdesignerGroupID'] = "<@&475771247893151764>";
// Discord Group ID Config Option. If you wished for each message which is sent to ping a specific group, please place the ID here. An example of a group ID is: @&343029528563548162

$GLOBALS['ONEEZYdiscordWebHookAvatar'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/tickets/";
// (OPTIONAL SETTING) Your desired Webhook Avatar. Please make sure you enter a direct link to the image (E.G. https://example.com/iownpaypal.png).

// https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/tickets/TicketSupport.png
// https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/tickets/TicketSales.png
// https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/tickets/TicketBilling.png

// Avatar Colors
$GLOBALS['ONEEZYavatarRed'] = "Red.png";
$GLOBALS['ONEEZYavatarOrange'] = "Orange.png";
$GLOBALS['ONEEZYavatarBlue'] = "Blue.png";
$GLOBALS['ONEEZYavatarGreen'] = "Green.png";

// Colors
$GLOBALS['ONEEZYblue'] = "45311";
$GLOBALS['ONEEZYyellow'] = "16776960";
$GLOBALS['ONEEZYorange'] = "16761095";
$GLOBALS['ONEEZYred'] = "16056407";
$GLOBALS['ONEEZYgreen'] = "65411";
$GLOBALS['ONEEZYgray'] = "9479342";

// Status Icons
// $GLOBALS['ONEEZYticketOpenIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-open.png";
$GLOBALS['ONEEZYticketOpenIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusOpen.png";
$GLOBALS['ONEEZYticketAnswerIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusAnswered.png";
$GLOBALS['ONEEZYticketReplyIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusCustomer-Reply.png";
$GLOBALS['ONEEZYticketCloseIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusClosed.png";
$GLOBALS['ONEEZYticketProgressIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-progress.png";
$GLOBALS['ONEEZYticketHoldIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-cancel.png";

// $GLOBALS['ONEEZYticketOpenIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-x.png";
// $GLOBALS['ONEEZYticketOpenIcon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-xx.png";


//=====================================================
//                                                     
//  ######  ##   ####  ##  ##  #####  ######   ####  
//    ##    ##  ##     ## ##   ##       ##    ##     
//    ##    ##  ##     ####    #####    ##     ###   
//    ##    ##  ##     ## ##   ##       ##       ##  
//    ##    ##   ####  ##  ##  #####    ##    ####   
//                                                     
//=====================================================


/* TICKETS: Open
****************************************************************/
add_hook('TicketOpen', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['ONEEZYdiscordWebHookAvatar'] . $vars['deptname'] . 'Red.png',
      'username' => $vars['deptname'].' Ticket #' . $vars['ticketid'],
      'content' => $GLOBALS['ONEEZYdesignerGroupID'],
      'embeds' => array(
          array(
              'author' => array(
                  'name' => 'Ticket #'. $vars['ticketid'] . ' (Open)',
                  'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
                  'icon_url' => $GLOBALS['ONEEZYticketOpenIcon']
              ),
              'title' => $vars['subject'],
              'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
              'description' => $vars['message']. '
                
                -----------------------------------------
                [Client](https://billing.coinbotvps.com/admin/clientssummary.php?userid='. $vars['userid'] .')',

              'color' => $GLOBALS['ONEEZYred'],
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
  ONEEZYprocessNotification($dataPacket);
});

/* TICKETS: Answer

($vars['status'] == "Closed") ? 'Green.png' : 

****************************************************************/
add_hook('TicketAdminReply', 1, function($vars)	{
    $dataPacket     = array(
        // 'avatar_url' => $GLOBALS['ONEEZYdiscordWebHookAvatar'] . $vars['deptname'] . 'Blue.png',
        // 'avatar_url' => $GLOBALS['ONEEZYdiscordWebHookAvatar'] . $vars['deptname'] . ($vars['status'] == "Closed") ? 'Green.png' : 'Blue.png',

        'avatar_url' => ($vars['status'] == "Closed") ? $GLOBALS['ONEEZYdiscordWebHookAvatar'] . $vars['deptname'] . 'Green.png' : $GLOBALS['ONEEZYdiscordWebHookAvatar'] . $vars['deptname'] . 'Blue.png',
        'username' => $vars['deptname'].' Ticket #' . $vars['ticketid'],
        'embeds' => array(
            array(
                'author' => array(
                    'name' => 'Ticket #'. $vars['ticketid'] . ' ('. $vars['status']. ')',
                    'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
                    'icon_url' => ($vars['status'] == "Closed") ? $GLOBALS['ONEEZYticketCloseIcon'] : $GLOBALS['ONEEZYticketAnswerIcon']
                ),
                'title' => $vars['subject'],
                'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
                'description' => $vars['message'],
                'color' => ($vars['status'] == "Closed") ? $GLOBALS['ONEEZYgreen'] : $GLOBALS['ONEEZYblue'],
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
                    ),
                    array(
                        'name' => 'Admin',
                        'value' => $vars['admin'],
                        'inline' => true
                    )
                )
            )
        )
    );
    ONEEZYprocessNotification($dataPacket);
});

/* TICKETS: New Reply
****************************************************************/
add_hook('TicketUserReply', 1, function($vars)	{
    $dataPacket     = array(
        'avatar_url' => $GLOBALS['ONEEZYdiscordWebHookAvatar'] . $vars['deptname'] . 'Orange.png',
        'username' => $vars['deptname'].' Ticket #' . $vars['ticketid'],
        'content' => $GLOBALS['ONEEZYdesignerGroupID'],
        'embeds' => array(
            array(
                'author' => array(
                    'name' => 'Ticket #'. $vars['ticketid'] . ' ('. $vars['status']. ')',
                    'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
                    'icon_url' => $GLOBALS['ONEEZYticketReplyIcon']
                ),
                'title' => $vars['subject'],
                'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
                'description' => $vars['message']. '
                
                -----------------------------------------
                [Client](https://billing.coinbotvps.com/admin/clientssummary.php?userid='. $vars['userid'] .')',
                'color' => $GLOBALS['ONEEZYorange'],
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
    ONEEZYprocessNotification($dataPacket);
});


/* TICKETS: Close
****************************************************************/
// add_hook('TicketClose', 1, function($vars)	{
//     $dataPacket     = array(
//         'avatar_url' => $GLOBALS['ONEEZYdiscordWebHookAvatar'] . $vars['deptname'] . '.png',
//         'username' => $vars['deptname'].' Ticket #' . $vars['ticketid'],
//         'embeds' => array(
//             array(
//                 'author' => array(
//                     'name' => 'Ticket #'. $vars['ticketid'] . ' ('. $vars['status']. ')',
//                     'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
//                     'icon_url' => $GLOBALS['ONEEZYticketCloseIcon']
//                 ),
//                 'title' => $vars['subject'],
//                 'url' => $GLOBALS['ONEEZYwhmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
//                 'description' => $vars['message'],
//                 'color' => $GLOBALS['ONEEZYgreen'],
//                 'fields' => array(
//                     array(
//                         'name' => 'Priority',
//                         'value' => $vars['priority'],
//                         'inline' => true
//                     ),
//                     array(
//                         'name' => 'Department',
//                         'value' => $vars['deptname'],
//                         'inline' => true
//                     ),
//                     array(
//                         'name' => 'Ticket ID',
//                         'value' => $vars['ticketid'],
//                         'inline' => true
//                     )
//                 )
//             )
//         )
//     );
//     ONEEZYprocessNotification($dataPacket);
// });

// TicketOpen
// TicketAdminReply
// TicketUserReply
// TicketClose

// TicketDelete
// TicketDeleteReply
// TicketOpenAdmin
// TicketStatusChange







function ONEEZYprocessNotification($dataPacket)	{
    $dataString        = json_encode($dataPacket);
    $curl              = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['ONEEZYdiscordWebHookTicketsURL']);
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
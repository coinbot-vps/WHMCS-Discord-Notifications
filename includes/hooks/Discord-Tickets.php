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

/* Company Name
****************************/
$GLOBALS['Discord_COMPANY_NAME'] = "Coinbot VPS";

/* Discord Webhook URL
****************************/
$GLOBALS['Discord_Webhook_TICKETS_CHANNEL_URL'] = "https://discordapp.com/api/webhooks/476142922929274880/zot639fSIJuHXx9shgRG86lkXzBC6xR__owqOji8L6BvPZPLQEMar3uyuMOatMs1obEg";
$GLOBALS['Discord_WHMCS_ADMIN_URL'] = "https://billing.coinbotvps.com/admin/";
$GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] = "https://billing.coinbotvps.com/admin/supporttickets.php?action=view&id=";
$GLOBALS['Discord_AVATAR_URL'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/tickets/";

/* Discord Role ID's
****************************/
$GLOBALS['Discord_SALES_ROLE_ID'] = "<@&476144479745605650>";
$GLOBALS['Discord_BILLING_ROLE_ID'] = "<@&478010953460482049>";
$GLOBALS['Discord_SUPPORT_ROLE_ID'] = "<@&475770910163468300>";
$GLOBALS['Discord_BUGS_ROLE_ID'] = "<@&478012634558365712>";

/* Colors
****************************/
$GLOBALS['Discord_COLOR_BLUE'] = "45311";
$GLOBALS['Discord_COLOR_YELLOW'] = "16776960";
$GLOBALS['Discord_COLOR_ORANGE'] = "16761095";
$GLOBALS['Discord_COLOR_RED'] = "16056407";
$GLOBALS['Discord_COLOR_GREEN'] = "65411";
$GLOBALS['Discord_COLOR_GRAY'] = "9479342";

/* Status Icons
****************************/
$GLOBALS['Discord_TICKET_OPEN_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusOpen.png";
$GLOBALS['Discord_TICKET_ANSWER_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusAnswered.png";
$GLOBALS['Discord_TICKET_REPLY_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusCustomer-Reply.png";
$GLOBALS['Discord_TICKET_CLOSE_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusClosed.png";
$GLOBALS['Discord_TICKET_PROGRESS_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-progress.png";
$GLOBALS['Discord_TICKET_HOLD_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-cancel.png";


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
      'avatar_url' => $GLOBALS['Discord_AVATAR_URL'] . $vars['deptname'] . 'Red.png',
      'username' => $vars['deptname'].' Ticket #' . $vars['ticketid'],
      'content' => (
        ($vars['deptname'] == "Sales") ? $GLOBALS['Discord_SALES_ROLE_ID'] :
         (($vars['deptname'] == "Billing") ? $GLOBALS['Discord_BILLING_ROLE_ID'] :
          (($vars['deptname'] == "Support") ? $GLOBALS['Discord_SUPPORT_ROLE_ID'] : 
           (($vars['deptname'] == "Bugs") ? $GLOBALS['Discord_BUGS_ROLE_ID'] : "")))
        ),
      'embeds' => array(
          array(
              'author' => array(
                  'name' => 'Ticket #'. $vars['ticketid'] . ' (Open)',
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
                  'icon_url' => $GLOBALS['Discord_TICKET_OPEN_Icon']
              ),
              'title' => $vars['subject'],
              'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
              'description' => $vars['message'],
              'color' => $GLOBALS['Discord_COLOR_RED'],
              'timestamp' => date(DateTime::ISO8601),
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
  processTicketNotification($dataPacket);
});

/* TICKETS: Answer
****************************************************************/
add_hook('TicketAdminReply', 1, function($vars)	{
    $dataPacket     = array(
        'avatar_url' => ($vars['status'] == "Closed") ? $GLOBALS['Discord_AVATAR_URL'] . $vars['deptname'] . 'Green.png' : $GLOBALS['Discord_AVATAR_URL'] . $vars['deptname'] . 'Blue.png',
        'username' => $vars['deptname'].' Ticket #' . $vars['ticketid'],
        'embeds' => array(
            array(
                'author' => array(
                    'name' => 'Ticket #'. $vars['ticketid'] . ' ('. $vars['status']. ')',
                    'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
                    'icon_url' => ($vars['status'] == "Closed") ? $GLOBALS['Discord_TICKET_CLOSE_Icon'] : $GLOBALS['Discord_TICKET_ANSWER_Icon']
                ),
                'title' => $vars['subject'],
                'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
                'description' => $vars['message'],
                'color' => ($vars['status'] == "Closed") ? $GLOBALS['Discord_COLOR_GREEN'] : $GLOBALS['Discord_COLOR_BLUE'],
                'timestamp' => date(DateTime::ISO8601),
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
    processTicketNotification($dataPacket);
});

/* TICKETS: New Reply
****************************************************************/
add_hook('TicketUserReply', 1, function($vars)	{
    $dataPacket     = array(
        'avatar_url' => $GLOBALS['Discord_AVATAR_URL'] . $vars['deptname'] . 'Orange.png',
        'username' => $vars['deptname'].' Ticket #' . $vars['ticketid'],
        'content' => (
            ($vars['deptname'] == "Sales") ? $GLOBALS['Discord_SALES_ROLE_ID'] :
             (($vars['deptname'] == "Billing") ? $GLOBALS['Discord_BILLING_ROLE_ID'] :
              (($vars['deptname'] == "Support") ? $GLOBALS['Discord_SUPPORT_ROLE_ID'] : 
               (($vars['deptname'] == "Bugs") ? $GLOBALS['Discord_BUGS_ROLE_ID'] : "")))
            ),
        'embeds' => array(
            array(
                'author' => array(
                    'name' => 'Ticket #'. $vars['ticketid'] . ' ('. $vars['status']. ')',
                    'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
                    'icon_url' => $GLOBALS['Discord_TICKET_REPLY_Icon']
                ),
                'title' => $vars['subject'],
                'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
                'description' => $vars['message'],
                'color' => $GLOBALS['Discord_COLOR_ORANGE'],
                'timestamp' => date(DateTime::ISO8601),
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
    processTicketNotification($dataPacket);
});



function processTicketNotification($dataPacket)	{
    $dataString        = json_encode($dataPacket);
    $curl              = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['Discord_Webhook_TICKETS_CHANNEL_URL']);
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
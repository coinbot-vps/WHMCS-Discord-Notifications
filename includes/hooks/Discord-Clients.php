<?php

/* 
HOOKS INDEX:        https://developers.whmcs.com/hooks/hook-index/ 
HOOKS REFERENCE:    https://developers.whmcs.com/hooks-reference/
Google Sheet:       https://docs.google.com/spreadsheets/d/1hleyO3GW0hUQSTiv_PDU-ENYYdB05zpTzZ9p55IjcLI/edit#gid=1313996946
*/

//========================================================
//                                                        
//   ####  ##      ##  #####  ##     ##  ######   ####  
//  ##     ##      ##  ##     ####   ##    ##    ##     
//  ##     ##      ##  #####  ##  ## ##    ##     ###   
//  ##     ##      ##  ##     ##    ###    ##       ##  
//   ####  ######  ##  #####  ##     ##    ##    ####   
//                                                        
//========================================================


/* Company Name
****************************/
$GLOBALS['Discord_COMPANY_NAME'] = "Coinbot VPS";

/* Discord Webhook URL
****************************/
$GLOBALS['Discord_Webhook_CLIENT_CHANNEL_URL'] = "https://discordapp.com/api/webhooks/478735562929471508/g8bE9CuPFaCrTNXBoauXOPl9_zN4nVXOEVGz9DJVxzxzJQkbAGzaXO6AwTB0qbLcPq5L";
$GLOBALS['Discord_WHMCS_ADMIN_URL'] = "https://billing.coinbotvps.com/admin/";
$GLOBALS['Discord_WHMCS_ADMIN_USER_ID_URL'] = "https://billing.coinbotvps.com/admin/clientssummary.php?userid=";

/* Client Avatars
****************************/
$GLOBALS['Discord_BLUE_AVATAR_url'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/clients/client-blue.png";
$GLOBALS['Discord_YELLOW_AVATAR_url'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/clients/client-yellow.png";
$GLOBALS['Discord_ORANGE_AVATAR_url'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/clients/client-orange.png";
$GLOBALS['Discord_RED_AVATAR_url'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/clients/client-red.png";
$GLOBALS['Discord_GREEN_AVATAR_url'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/clients/client-green.png";
$GLOBALS['Discord_GRAY_AVATAR_url'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/clients/client-gray.png";
$GLOBALS['Discord_PURPLE_AVATAR_url'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/clients/client-purple.png";

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
$GLOBALS['Discord_COLOR_PURPLE'] = "8280002";

/* Status Icons
****************************/
$GLOBALS['Discord_CLIENT_ADD_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusClosed.png";
$GLOBALS['Discord_CLIENT_EDIT_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-check-purple.png";
$GLOBALS['Discord_CLIENT_CLOSED_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-cancel.png";
$GLOBALS['Discord_CLIENT_DELETED_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-xx.png";



/* CLIENT: Add
****************************************************************/
add_hook('ClientAdd', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_GREEN_AVATAR_url'],
      'username' => 'New Client',
      'content' => $GLOBALS['Discord_SALES_ROLE_ID'],
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  $vars['firstname'] . ' ' . $vars['lastname'] . ' #' . $vars['userid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_USER_ID_URL'] . $vars['userid'],
                  'icon_url' => $GLOBALS['Discord_CLIENT_ADD_Icon']
              ),
              // 'title' => $vars['subject'],
              // 'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
              // 'description' => '
              //   **userid:** ' . $vars['userid'] .'
              //   **firstname:** ' . $vars['firstname'] .'
              //   **lastname:** ' . $vars['lastname'] .'
              //   **companyname:** ' . $vars['companyname'] .'
              //   **email:** ' . $vars['email'] .'
              //   **address1:** ' . $vars['address1'] .'
              //   **address2:** ' . $vars['address2'] .'
              //   **city:** ' . $vars['city'] .'
              //   **state:** ' . $vars['state'] .'
              //   **postcode:** ' . $vars['postcode'] .'
              //   **country:** ' . $vars['country'] .'
              //   **phonenumber:** ' . $vars['phonenumber'] .'
              //   **password:** ' . $vars['password'] .'
              //   **customFields:** ' . $vars['customFields'] .'
              //   **taxexempt:** ' . $vars['taxexempt'] .'
              //   **latefeeoveride:** ' . $vars['latefeeoveride'] .'
              //   **overideduenotices:** ' . $vars['overideduenotices'] .'
              //   **separateinvoices:** ' . $vars['separateinvoices'] .'
              //   **disableautocc:** ' . $vars['disableautocc'] .'
              //   **emailoptout:** ' . $vars['emailoptout'] .'
              //   **marketing_emails_opt_in:** ' . $vars['marketing_emails_opt_in'] .'
              //   **overrideautoclose:** ' . $vars['overrideautoclose'] .'
              //   **notes:** ' . $vars['notes'] .'
              //   **groupid:** ' . $vars['groupid'] .'',

              'color' => $GLOBALS['Discord_COLOR_GREEN'],
              'timestamp' => date(DateTime::ISO8601),
              'fields' => array(
                  array(
                      'name' => 'City',
                      'value' => $vars['city'],
                      'inline' => true
                  ),
                  array(
                    'name' => 'State',
                    'value' => $vars['state'],
                    'inline' => true
                  ),
                  array(
                    'name' => 'Country',
                    'value' => $vars['country'],
                    'inline' => true
                  ),
                  array(
                    'name' => 'Email',
                    'value' => $vars['email'],
                    'inline' => true
                  )
              )
          )
      )
  );
  processClientNotification($dataPacket);
});

/* CLIENT: Edit
****************************************************************/
add_hook('ClientEdit', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_PURPLE_AVATAR_url'],
      'username' => 'Client Updated',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  $vars['firstname'] . ' ' . $vars['lastname'] . ' #' . $vars['userid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_USER_ID_URL'] . $vars['userid'],
                  'icon_url' => $GLOBALS['Discord_CLIENT_EDIT_Icon']
              ),
              // 'title' => $vars['subject'],
              // 'url' => $GLOBALS['Discord_WHMCS_ADMIN_TICKETS_URL'] . $vars['ticketid'],
              // 'description' => '
              //     **userid:** ' . $vars['userid'] . '
              //     **uuid:** ' . $vars['uuid'] . '
              //     **firstname:** ' . $vars['firstname'] . '
              //     **lastname:** ' . $vars['lastname'] . '
              //     **companyname:** ' . $vars['companyname'] . '
              //     **email:** ' . $vars['email'] . '
              //     **address1:** ' . $vars['address1'] . '
              //     **address2:** ' . $vars['address2'] . '
              //     **city:** ' . $vars['city'] . '
              //     **state:** ' . $vars['state'] . '
              //     **postcode:** ' . $vars['postcode'] . '
              //     **country:** ' . $vars['country'] . '
              //     **phonenumber:** ' . $vars['phonenumber'] . '
              //     **password:** ' . $vars['password'] . '
              //     **currency:** ' . $vars['currency'] . '
              //     **notes:** ' . $vars['notes'] . '
              //     **status:** ' . $vars['status'] . '
              //     **taxexempt:** ' . $vars['taxexempt'] . '
              //     **latefeeoveride:** ' . $vars['latefeeoveride'] . '
              //     **overideduenotices:** ' . $vars['overideduenotices'] . '
              //     **separateinvoices:** ' . $vars['separateinvoices'] . '
              //     **disableautocc:** ' . $vars['disableautocc'] . '
              //     **emailoptout:** ' . $vars['emailoptout'] . '
              //     **marketing_emails_opt_in:** ' . $vars['marketing_emails_opt_in'] . '
              //     **overrideautoclose:** ' . $vars['overrideautoclose'] . '
              //     **language:** ' . $vars['language'] . '
              //     **billingcid:** ' . $vars['billingcid'] . '
              //     **securityqid:** ' . $vars['securityqid'] . '
              //     **securityqans:** ' . $vars['securityqans'] . '
              //     **groupid:** ' . $vars['groupid'] . '
              //     **allow_sso:** ' . $vars['allow_sso'] . '
              //     **olddata:** ' . $vars['olddata'] . '
              //     **authmodule:** ' . $vars['authmodule'] . '
              //     **authdata:** ' . $vars['authdata'] . '
              //     **email_verified:** ' . $vars['email_verified'] . '
              //     **olddata:** ' . $vars['olddata'] . '
              //     ',

              'color' => $GLOBALS['Discord_COLOR_PURPLE'],
              'timestamp' => date(DateTime::ISO8601),
              'fields' => array(
                  array(
                      'name' => 'City',
                      'value' => $vars['city'],
                      'inline' => true
                  ),
                  array(
                    'name' => 'State',
                    'value' => $vars['state'],
                    'inline' => true
                  ),
                  array(
                    'name' => 'Country',
                    'value' => $vars['country'],
                    'inline' => true
                  ),
                  array(
                    'name' => 'Email',
                    'value' => $vars['email']
                  )
              )
          )
      )
  );
  processClientNotification($dataPacket);
});

/* CLIENT: Email Verified (broke)
***************************************************************
add_hook('ClientEmailVerificationComplete', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_GREEN_AVATAR_url'],
      'username' => 'Client Verified',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Client #' . $vars['userId'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_USER_ID_URL'] . $vars['userId'],
                  'icon_url' => $GLOBALS['Discord_CLIENT_VERIFIED_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_GREEN'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processClientNotification($dataPacket);
}); */

/* CLIENT: Closed
****************************************************************/
add_hook('ClientClose', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_GRAY_AVATAR_url'],
      'username' => 'Client Closed',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Client #' . $vars['userid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_USER_ID_URL'] . $vars['userid'],
                  'icon_url' => $GLOBALS['Discord_CLIENT_CLOSED_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_GRAY'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processClientNotification($dataPacket);
});

/* CLIENT: Deleted
****************************************************************/
add_hook('ClientDelete', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_RED_AVATAR_url'],
      'username' => 'Client Deleted',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Client #' . $vars['userid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_USER_ID_URL'] . $vars['userid'],
                  'icon_url' => $GLOBALS['Discord_CLIENT_DELETED_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_RED'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processClientNotification($dataPacket);
});

function processClientNotification($dataPacket)	{
    $dataString        = json_encode($dataPacket);
    $curl              = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['Discord_Webhook_CLIENT_CHANNEL_URL']);
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
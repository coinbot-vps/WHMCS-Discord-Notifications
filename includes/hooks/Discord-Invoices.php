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
$GLOBALS['Discord_Webhook_INVOICE_CHANNEL_URL'] = "https://discordapp.com/api/webhooks/478779067689336832/cSU-a7pnz0cLv_N5D3GUaNQGH6ahLqt9Iyh5E5CFN7XdhB5tcLqgP6a3whrvDKESbzYp";
$GLOBALS['Discord_WHMCS_ADMIN_URL'] = "https://billing.coinbotvps.com/admin/";
$GLOBALS['Discord_WHMCS_ADMIN_CLIENT_URL'] = "https://billing.coinbotvps.com/admin/clientssummary.php?userid=";
$GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] = "https://billing.coinbotvps.com/admin/invoices.php?action=edit&id=";

/* Discord Role ID's
****************************/
$GLOBALS['Discord_SALES_ROLE_ID'] = "<@&476144479745605650>";
$GLOBALS['Discord_BILLING_ROLE_ID'] = "<@&478010953460482049>";
$GLOBALS['Discord_SUPPORT_ROLE_ID'] = "<@&475770910163468300>";
$GLOBALS['Discord_BUGS_ROLE_ID'] = "<@&478012634558365712>";
$GLOBALS['Discord_TEAM_ID'] = "<@&453948756115587073>";

/* Colors
****************************/
$GLOBALS['Discord_COLOR_BLUE'] = "45311";
$GLOBALS['Discord_COLOR_YELLOW'] = "16776960";
$GLOBALS['Discord_COLOR_ORANGE'] = "16761095";
$GLOBALS['Discord_COLOR_RED'] = "16056407";
$GLOBALS['Discord_COLOR_GREEN'] = "65411";
$GLOBALS['Discord_COLOR_GRAY'] = "9479342";

/* Invoice Avatars
****************************/
$GLOBALS['Discord_INVOICE_CREATED_Avatar_URL'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/invoices/invoice-blue.png";
$GLOBALS['Discord_INVOICE_UNPAID_Avatar_URL'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/invoices/invoice-yellow.png";
$GLOBALS['Discord_INVOICE_REMINDER_Avatar_URL'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/invoices/invoice-orange.png";
$GLOBALS['Discord_INVOICE_PAID_Avatar_URL'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/invoices/invoice-green.png";
$GLOBALS['Discord_INVOICE_CANCELLED_Avatar_URL'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/invoices/invoice-gray.png";
$GLOBALS['Discord_INVOICE_REFUNDED_Avatar_URL'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/invoices/invoice-orange.png";

/* Status Icons
****************************/
$GLOBALS['Discord_INVOICE_CREATED_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-add-blue.png";
$GLOBALS['Discord_INVOICE_UNPAID_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-progress.png";
$GLOBALS['Discord_INVOICE_REMINDER_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-open.png";
$GLOBALS['Discord_INVOICE_LATE_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusOpen.png";
$GLOBALS['Discord_INVOICE_PAID_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/statusClosed.png";
$GLOBALS['Discord_INVOICE_UNPAID_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-progress.png";
$GLOBALS['Discord_INVOICE_CANCELLED_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-cancel.png";
$GLOBALS['Discord_INVOICE_REFUNDED_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-open.png";
$GLOBALS['Discord_INVOICE_REMINDER_Icon'] = "https://coinbotvps.com/wp-content/themes/coinbotvps/images/discord/status/status-open.png";



//==============================================================
//                                                              
//  ##  ##     ##  ##   ##   #####   ##   ####  #####   ####  
//  ##  ####   ##  ##   ##  ##   ##  ##  ##     ##     ##     
//  ##  ##  ## ##  ##   ##  ##   ##  ##  ##     #####   ###   
//  ##  ##    ###   ## ##   ##   ##  ##  ##     ##        ##  
//  ##  ##     ##    ###     #####   ##   ####  #####  ####   
//                                                              
//==============================================================

/* INVOICE: Created
****************************************************************/
add_hook('InvoiceCreated', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_INVOICE_CREATED_Avatar_URL'],
      'username' => 'New Invoice',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Invoice #'. $vars['invoiceid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] . $vars['invoiceid'],
                  'icon_url' => $GLOBALS['Discord_INVOICE_CREATED_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_BLUE'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: Unpaid
****************************************************************/
add_hook('InvoiceUnpaid', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_INVOICE_UNPAID_Avatar_URL'],
      'username' => 'Invoice Unpaid',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Invoice #'. $vars['invoiceid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] . $vars['invoiceid'],
                  'icon_url' => $GLOBALS['Discord_INVOICE_UNPAID_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_YELLOW'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: Reminder
****************************************************************/
add_hook('InvoicePaymentReminder', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_INVOICE_REMINDER_Avatar_URL'],
      'username' => 'Invoice Reminder' . $vars['type'],
      'content' => $GLOBALS['Discord_SALES_ROLE_ID'],
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Invoice #'. $vars['invoiceid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] . $vars['invoiceid'],
                  'icon_url' => $GLOBALS['Discord_INVOICE_REMINDER_Icon']
              ),
              'description' => $vars['type'],
              'color' => $GLOBALS['Discord_COLOR_ORANGE'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: Late
****************************************************************/
add_hook('AddInvoiceLateFee', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_INVOICE_LATE_Avatar_URL'],
      'username' => 'Invoice Late',
      'content' => $GLOBALS['Discord_BILLING_ROLE_ID'],
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Invoice #'. $vars['invoiceid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] . $vars['invoiceid'],
                  'icon_url' => $GLOBALS['Discord_INVOICE_LATE_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_RED'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: Paid
****************************************************************/
add_hook('InvoicePaid', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_INVOICE_PAID_Avatar_URL'],
      'username' => 'Invoice Paid',
      'content' => $GLOBALS['Discord_TEAM_ID'],
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Invoice #'. $vars['invoiceid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] . $vars['invoiceid'],
                  'icon_url' => $GLOBALS['Discord_INVOICE_PAID_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_GREEN'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: Cancelled
****************************************************************/
add_hook('InvoiceCancelled', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_INVOICE_CANCELLED_Avatar_URL'],
      'username' => 'Invoice Cancelled',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Invoice #'. $vars['invoiceid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] . $vars['invoiceid'],
                  'icon_url' => $GLOBALS['Discord_INVOICE_CANCELLED_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_GRAY'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: Refunded
****************************************************************/
add_hook('InvoiceRefunded', 1, function($vars)	{
  $dataPacket     = array(
      'avatar_url' => $GLOBALS['Discord_INVOICE_REFUNDED_Avatar_URL'],
      'username' => 'Invoice Refunded',
      'embeds' => array(
          array(
              'author' => array(
                  'name' =>  'Invoice #'. $vars['invoiceid'],
                  'url' => $GLOBALS['Discord_WHMCS_ADMIN_INVOICE_URL'] . $vars['invoiceid'],
                  'icon_url' => $GLOBALS['Discord_INVOICE_REFUNDED_Icon']
              ),
              'color' => $GLOBALS['Discord_COLOR_ORANGE'],
              'timestamp' => date(DateTime::ISO8601)
          )
      )
  );
  processInvoiceNotification($dataPacket);
});






/* INVOICE: AddTransaction
****************************************************************/
add_hook('AddTransaction', 1, function($vars)	{
  $dataPacket     = array(
      'username' => 'AddTransaction',
      'embeds' => array(
          array(
              'description' => '

                **id:** ' . $vars['id'] . '
                **userid:** ' . $vars['userid'] . '
                **currency:** ' . $vars['currency'] . '
                **gateway:** ' . $vars['gateway'] . '
                **date:** ' . $vars['date'] . '
                **description:** ' . $vars['description'] . '
                **amountin:** ' . $vars['amountin'] . '
                **fees:** ' . $vars['fees'] . '
                **amountout:** ' . $vars['amountout'] . '
                **rate:** ' . $vars['rate'] . '
                **transid:** ' . $vars['transid'] . '
                **invocieid:** ' . $vars['invocieid'] . '
                **refundid:** ' . $vars['refundid'] . '
              
              ',
              'color' => $GLOBALS['Discord_COLOR_GRAY']
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: LogTransaction
****************************************************************/
add_hook('LogTransaction', 1, function($vars)	{
  $dataPacket     = array(
      'username' => 'LogTransaction',
      'embeds' => array(
          array(
              'description' => '

                **gateway:** ' . $vars['gateway'] . '
                **data:** ' . $vars['data'] . '
                **result:** ' . $vars['result'] . '
                
              ',
              'color' => $GLOBALS['Discord_COLOR_GRAY']
          )
      )
  );
  processInvoiceNotification($dataPacket);
});

/* INVOICE: EmailPreLog
****************************************************************/
add_hook('EmailPreLog', 1, function($vars)	{
  $dataPacket     = array(
      'username' => 'EmailPreLog',
      'embeds' => array(
          array(
              'description' => '

              **quoteid:** ' . $vars['quoteid'] . '
              **userid:** ' . $vars['userid'] . '
              **date:** ' . $vars['date'] . '
              **to:** ' . $vars['to'] . '
              **cc:** ' . $vars['cc'] . '
              **bcc:** ' . $vars['bcc'] . '
              **subject:** ' . $vars['subject'] . '
              **message:** ' . $vars['message'] . '
                             
              ',
              'color' => $GLOBALS['Discord_COLOR_BLUE']
          )
      )
  );
  processInvoiceNotification($dataPacket);
});


function processInvoiceNotification($dataPacket)	{
    $dataString        = json_encode($dataPacket);
    $curl              = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['Discord_Webhook_INVOICE_CHANNEL_URL']);
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
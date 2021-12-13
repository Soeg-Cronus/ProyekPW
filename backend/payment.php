<?php 
    namespace Midtrans;

    $jumlah = 0;
    $jumlah = $_REQUEST['nominal'];
    $idtrans = $_REQUEST['transid'];

    require_once('conn.php');
    require_once('Midtrans/examples/snap/credential.php');
    require_once('Midtrans/Midtrans.php');
    // Set Your server key
    // can find in Merchant Portal -> Settings -> Access keys
    Config::$serverKey = $myserver;
    Config::$clientKey = $myclient;

    // non-relevant function only used for demo/example purpose
    printExampleWarningMessage();

    // Uncomment for production environment
    // Config::$isProduction = true;

    // Enable sanitization
    Config::$isSanitized = true;

    // Enable 3D-Secure
    Config::$is3ds = true;

    // Uncomment for append and override notification URL
    // Config::$appendNotifUrl = "https://example.com";
    // Config::$overrideNotifUrl = "https://example.com";

    // Required
    
    $transaction_details = array(
        'order_id' => rand(),
        'gross_amount' => $jumlah, // no decimal allowed for creditcard
    );

    $orderid = $transaction_details['order_id'];
    $conn->query("update transaksi set token=$orderid where id_transaksi='$idtrans'");
    
    // Fill transaction details
    $transaction = array(
        'transaction_details' => $transaction_details,
    );

    $snap_token = '';
    try {
        $snap_token = Snap::getSnapToken($transaction);
    }
    catch (\Exception $e) {
        echo $e->getMessage();
    }

    echo $snap_token;

    function printExampleWarningMessage() {
        if (strpos(Config::$serverKey, 'your ') != false ) {
            echo "<code>";
            echo "<h4>Please set your server key from sandbox</h4>";
            echo "In file: " . __FILE__;
            echo "<br>";
            echo "<br>";
            echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
            die();
        } 
    }
?>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: xihengwang
 * Date: 8/5/18
 * Time: 15:29
 */
?>

<?php
session_start();

$email = $_POST['email'];
$subject = "Receipt";

$message = '<h1>This is your receipt</h1>
<table border="1px">
    <tr>
        <th>Name : </th>
        <th>Address: </th>
        <th>Suburb: </th>
        <th>State: </th>
        <th>Country: </th>
        <th>Post code: </th>
        <th>Email: </th>
    </tr>';
    $message .= '<tr>
    <td>'.$_POST['customer_name'].'</td>
    <td>'.$_POST['address'].'</td>
    <td>'.$_POST['suburb'].'</td>
    <td>'.$_POST['state'].'</td>
    <td>'.$_POST['country'].'</td>
    <td>'.$_POST['postcode'].'</td>
    <td>'.$_POST['email'].'</td>
    </tr></table>';

$message .= '<h2>Here is your shopping cart</h2>
<br />
<table style="width:100%">
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Unit Price</th>
        <th>Unit Quantity</th>
        <th>In Stock</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>';

$arrStr = array();
$arr = array();
$arrStr = $_SESSION['information'];

$total = 0;
for($i = 0; $i < count($arrStr); $i++){
    $arr = explode("@", $arrStr[$i]);
    $message .= '<tr>
            <td>' . $arr[0] . '</td>
            <td>' . $arr[1] . '</td>
            <td>' . $arr[2] . '</td>
            <td>' . $arr[3] . '</td>
            <td>' . $arr[4] . '</td>
            <td>' . $arr[5] . '</td>
            <td>' . ($arr[2] * $arr[5]) . '</td>
        </tr>';
    $total += ($arr[2] * $arr[5]);
}
$message .= '</table>
<label>Total Amount : $ ' . $total .' </label>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

if (mail($email,$subject,$message, $headers)) {
    echo "<h1>Thank You for purchasing with us!</h1>";
    session_destroy();
}
?>





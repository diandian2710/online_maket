<?php
/**
 * Created by IntelliJ IDEA.
 * User: xihengwang
 * Date: 7/5/18
 * Time: 23:44
 */
?>
<h1>shopping cart</h1>
<table style="width: 100%" border="1px">
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Unit Price</th>
        <th>Unit Quantity</th>
        <th>In Stock</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    <?php
    session_start();

    $arrStr = array();
    $arr = array();

    if (!isset($_SESSION['information']) || $_SESSION['information'] == null){
        $teArr = array();
        $teArr[0] = $_POST['str'];
        $_SESSION['information'] = $teArr;
        $arrStr = $_SESSION['information'];
    } else{
        $teSession = array();
        $teSession = $_SESSION['information'];
        $testr = $_POST['str'];
        $arrASDF = explode('@', $testr);
        $isThere = false;
        for($i=0; $i < count($teSession); $i++) {
            $arrFDSA = explode('@', $teSession[$i]);
            if($arrASDF[0] == $arrFDSA[0]){
                $arrFDSA[5] += $arrASDF[5];
                $teSession[$i] = $arrFDSA[0] . '@' . $arrFDSA[1] . '@' . $arrFDSA[2] . '@' . $arrFDSA[3] . '@' . $arrFDSA[4] . '@' . $arrFDSA[5];
                $isThere = true;
            }
        }
        if($isThere == false){
            array_push($teSession,$testr);
        }
        $_SESSION['information'] = $teSession;
        $arrStr = $teSession;
    }
    $total = 0;
    for($i=0; $i < count($arrStr); $i++) {
        $arr = explode('@', $arrStr[$i])
        ?>
        <tr>
            <td><?php echo $arr[0]; ?></td>
            <td><?php echo $arr[1]; ?></td>
            <td><?php echo $arr[2]; ?></td>
            <td><?php echo $arr[3]; ?></td>
            <td><?php echo $arr[4]; ?></td>
            <td><?php echo $arr[5]; ?></td>
            <td><?php echo($arr[2] * $arr[5]);?>$</td>
        </tr>
        <?php
        $total += ($arr[2] * $arr[5]);
    }
    ?>
</table>
<label>Total Amount : $<?php echo $total ?></label>
<br/>
<button class="clear" id="button_clear">Clear</button>
<button class="check" id="button_check">Check</button>
<script>
    $('#button_clear').click(function () {
        $.ajax({
            url: "rightbottomclear.php",
            type: "GET",
            context: document.body,
        }).done(function (response) {
            $('#right_bottom').html(response);

        });
    });
    $('#button_check').click(function () {
        $.ajax({
         url: "check.php",
         type: "GET",
         context: document.body,
        }).done(function (response) {
            $("#right_top").html(response);
        });
    });
</script>

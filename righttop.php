<?php
/**
 * Created by IntelliJ IDEA.
 * User: xihengwang
 * Date: 7/5/18
 * Time: 22:17
 */
?>

<?php
$servername="rerun.it.uts.edu.au";
$username="potiro";
$password="pcXZb(kL";
$dbname="poti";
//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['productid'];
//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM products WHERE product_id  = '$id'";
?>
<h1>Product information</h1>
<table id="tb_right_top" class="table" border="1px">
    <?php
    $result = $conn->query($sql);
    if($result->num_rows>0) {
    ?>
    <thead>
    <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Product Name</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Unit Quantity</th>
        <th scope="col">In Stock</th>
    </tr>
    </thead>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tbody><tr>";
            echo "<td>" . $row["product_id"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>" . $row["unit_price"] . "$</td>";
            echo "<td>" . $row["unit_quantity"] . "</td>";
            echo "<td>" . $row["in_stock"] . "</td>";
            echo "</tr></tbody>";
        }
    } else {
        echo "<tbody><tr><td>Nothing</td></tr></tbody>";
    }
    $conn->close();
    ?>
</table>
<label for="Quantity">Quantity: </label>
<input type="text" id="quantity" value="0" name="quantity" maxlength="2" min="0" max="20"
       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
<button class="add_button" name="add" id="buttonAdd">Add</button> #Click the "Add" button.
<script>
    $("#buttonAdd").click(function () {
        if($("#quantity").val() && $("#quantity").val() != "0" && $("#quantity").val() <= 20){
            var str = "";
            $("#tb_right_top").children("tbody").children().children().each(
                function (i, item) {
                    str += $(item).html() + "@";
                });
            str += $("#quantity").val();
            $.ajax({
                url: "rightbottom.php",
                data: {str: str},
                type: "POST",
                context: document.body,
            }).done(function (response) {
                $("#right_bottom").html(response);
            });
        }else {
            alert("enter quantity Please (<=20)");
        }
    });
</script>
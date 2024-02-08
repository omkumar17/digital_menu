<?php
include_once 'connection.php';
// for($i=0;$i<sizeOf($arr);$i++){
//     echo $arr[$i];
// }
// $oid=14;
// if(isset($_GET['flag'])){
//     $flag=$_GET['flag'];
//     if($flag==1){
//     ?>
       <script>
//         alert("item added");
//         </script>
    <?php
//     }
// }

$sql="SELECT * FROM `menu`";
$result=$conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalMenu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            display: grid;
            grid-template-columns: auto;
            width:900px;
            margin: auto;
        }

        .items {
            height: 100px;
            display: flex;
            flex-direction: row;
            /* background-color: red; */
            margin: 20px;
            padding: 10px;
            text-align: center;
            font-size: 30px;
            /* line-height:70px; */
        }

        .img {
            height: 100%;
            width: 20%;
            border: 2px solid black;
            object-fit: fill;
        }

        .img img {
            height: 100%;
            width: 100%;
        }

        .desc {
            height: 100%;
            width: 40%;
            border: 2px solid black;
            padding: 20px 0;
        }

        .price {
            height: 100%;
            width: 10%;
            border: 2px solid black;
            padding: 20px 0;
        }
        .size{
            height: 100%;
            width: 20%;
            border: 2px solid black;
            font-size:25px;
            padding: 10px 0;
        }
        .qnty{
            height: 100%;
            width:10%;
            border: 2px solid black;
            padding: 20px 0;
        }

        .form {
            display:none;
            height: auto;
            width: 500px;
            background-color:white;
            padding: 20px;
            border:3px solid black;
            position:absolute;
            top:0;
            left:30%;
            box-shadow: 2px 2px 40px 5px black;
        }
        .formitem{
            margin: 20px;
            /* height:50px; */
            font-size: 20px;
        }
        .btn{
            height:40px;
            width:80px;
            margin: 10px;
            font-size: 20px;
            cursor: pointer;
            /* display: block; */
        }
        .submit{
            background-color: green;
            color:white;
            height:60px;
            width:120px;
            position:fixed;
            top:30vh;
            right:10vh;
            font-size:18px;
            cursor:pointer;
        }
        .cancel{
            background-color: red;
            color:white;
        }
        .rep{
            margin: 10px;
            padding: 10px;
            font-size:20px;
            text-align:center;
        }
        .report{
            border:2px solid black;
        }
        .row{
            border:2px solid black;
        }
        .reset{
            height:50px;
            width:150px;
            background: red;
            color:white;
            border:2px solid black;
            font-weight:500;
            text-align:center;
            font-size:20px;
            cursor:pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
            if(isset($_GET['flag'])==1){
                echo <<< _END
                <table class="report">
                <thead>
                        <td class="pname rep">Product</td>
                        <td class="psize rep">size</td>
                        <td class="qntty rep">Quantity</td>
                        <td class="perprice rep">price</td>
                        <td class="total rep">Total</td>
                </thead>
                <tbody>

                
                _END;
                $order="SELECT * FROM `cart` WHERE `oid`='$oid'";
                
                $ores=$conn->query($order);
                $bill=0;
                if($ores){
                   
                    while($orow=$ores->fetch_assoc()){
                        $iid=$orow['pid'];
                        $orpr="SELECT * FROM `menu` WHERE `id`='$iid'";
                        $orres=$conn->query($orpr);
                        $or=$orres->fetch_assoc();
                        if($orow['size']=="half"){
                            $total=($or['price']/2)*$orow['qty'];
                        }
                        else if($orow['size']=="full"){
                            $total=$or['price']*$orow['qty'];
                        }
                        $bill=$bill+$total;
                        echo <<< _END
                        <tr class="row">
                        <td class="pname rep">{$or['name']}</td>
                        <td class="psize rep">{$orow['size']}</td>
                        <td class="qntty rep">{$orow['qty']}</td>
                        <td class="perprice rep">&#8377;{$or['price']}</td>
                        <td class="total rep">&#8377;$total</td>
                        </tr>
                        _END;
                    }
                }
                echo <<< _END
                </tbody>
                </table>
                <h2> Total Bill : &#8377;{$bill}</h2>
                <br>
                <br>
                _END;
                if($bill == 0){
                    echo<<<_END
                    <button class="reset" style="visibility:hidden">proceed to payment</button>
                    _END;
                }
                else{
                    echo<<<_END
                    <button class="reset" style="visibility:visible">proceed to payment</button>
                    _END;
                }
            }
        ?> 
        <div class="formcontainer">
        <form action="cart.php" class="form1" method="get" >
            <input type="hidden" name="hid" value="1">
            <?php
            if($result){
                while($row=$result->fetch_assoc()){
                    echo <<< _END
                    <div class="items">
                        <div class="img"><img src="{$row['img']}" alt=""></div>
                        <div class="desc">{$row['name']}</div>
                        <div class="price">&#8377;{$row['price']}</div>
                        <div class="size"><label for="half{$row['id']}"><input type="checkbox" name="half{$row['id']}" id="half{$row['id']}" value="half">Half</label><br>
                                            <label for="full{$row['id']}"><input type="checkbox" name="full{$row['id']}" id="full{$row['id']}" value="full">Full</label></div>
                        <div class="qnty"><input type="number" name="qty{$row['id']}" min="0" max="10" style="height:30px;text-align:center" placeholder="0"></div>
                    </div>
                    
                    _END;
                }
            }
            echo <<< _END
            <input type="submit" value="Place Order" class="submit" id="billtab">
        </form>
        </div>
        _END;
        ?>
            
    </div>
    <script>
       document.addEventListener("DOMContentLoaded", function () {
            var items = document.querySelectorAll(".items");
            var form = document.querySelector(".form1");
            var reset=document.querySelector(".reset");
            reset.addEventListener("click",()=>{
                var isConfirmed = confirm("Are you sure you want to place order?");
                if(isConfirmed){
                window.location.href="delete.php";
                alert("Thankyou for using our service!");
                window.location.reload();
                }
            });
            form.addEventListener("submit", function (e) {
                var valid = true;
                var fl=false;

                items.forEach(function (item) {
                    var halfCheckbox = item.querySelector("input[name^='half']");
                    var fullCheckbox = item.querySelector("input[name^='full']");
                    var qtyInput = item.querySelector("input[name^='qty']");

                    // if (!halfCheckbox.checked && !fullCheckbox.checked && !qtyInput.value) {
                    //     // None of the checkboxes or quantity is selected, do nothing
                    //     // fl=true;
                    // } 
                    if((halfCheckbox.checked && fullCheckbox.checked)){
                        alert("please select any one size for an item" + item);
                        e.preventDefault();
                        valid = false;
                    }
                    if ((!halfCheckbox.checked && !fullCheckbox.checked) && (qtyInput.value && qtyInput.value!=0)) {
                        // Either half or full is selected, but quantity is not entered
                        alert("Please enter size for the selected item.");
                        qtyInput.focus();
                        e.preventDefault();
                        valid = false;
                    
                    }
                    // if((halfCheckbox.checked || fullCheckbox.checked) && (qtyInput.value==null || qtyInput.value==0)){
                    //     // fl=true;
                    //     alert("Please enter quantity for the selected item.");
                    //     qtyInput.focus();
                    //     e.preventDefault();
                    //     valid = false;
                    // }
                    if((halfCheckbox.checked || fullCheckbox.checked) &&( qtyInput.value && qtyInput.value!=0)){
                        fl=true;
                    }
                });

                if (valid && fl) {
                    alert("order placed successfully!");
                    document.querySelector("#billtab").scrollIntoView({ behavior: "smooth" });
                }
                else if(fl==false){
                    // form.action="cart.php";
                    
                    alert("please select item");
                    e.preventDefault();
                    // return false;
                }
            });
        });

    </script>
</body>

</html>
<?php include('partials/menu.php'); ?>
<br><br><br><br><br><br>

<?php 
    $id =  $_GET['id'];
    $sql = "SELECT * FROM products WHERE ID = '$id';";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        $rows = mysqli_fetch_assoc($res);
            $id = $rows['ID'];
            $prod_name=$rows['Name'];
            $prod_descr=$rows['Description'];
            $image=$rows['imageFile'];
            $price=number_format($rows['Price'], 2);
            
            ?>
            <div class="center">
                <h1>ORDER ITEM</h1>
                <img src="<?php echo SITEURL;?>/images/<?php echo $image; ?>" alt="<?php echo $prod_descr; ?>" width = "20%">
                <h3>$<?php echo $price; ?></h3>

                <div id="error_feild"></div>
            </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="info-tbl">
                        <tr><td><u>CUSTOMER INFO</u></td></tr>
                        <tr>
                            <td>First Name: </td>
                            <td> 
                                <input type="text" name="fName" placeholder="First Name">
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td width = "20%";> 
                                <input type="text" name="lName" placeholder="Last Name">
                            </td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td> 
                                <input type="text" name="email" placeholder="e.g. johnsmith@gmail.com">
                            </td>
                        </tr>
                        <tr><td><u>SHIPPING INFO</u></td></tr>
                        <tr>
                            <td>Address Line 1: </td>
                            <td> 
                                <input type="text" name="line1" placeholder="Address Line 1">
                            </td>
                        </tr>
                        <tr>
                            <td>Address Line 2: </td>
                            <td> 
                                <input type="text" name="line2" placeholder="(optional)">
                            </td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td> 
                                <input type="text" name="city" placeholder="e.g. New York">
                            </td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td> 
                                <input type="text" name="state" placeholder="e.g. NY">
                            </td>
                        </tr>
                        <tr>
                            <td>Zip Code:</td>
                            <td> 
                                <input type="number" name="zip" placeholder="e.g. 12345">
                            </td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td> 
                                <input type="text" name="country" placeholder="e.g. United States">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="cancel" value="Cancel Order" class="btn-third">
                                <input type="submit" name="submit" value="Proceed to Checkout" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
            <?php
            
    }
    if (isset($_POST['cancel'])) {
        echo '<script type="text/javascript">function jsFunction(){location.href = "products.php";}</script>';
        echo '<script type="text/javascript">jsFunction();</script>';
    }
    ?>
    
    <script type="text/javascript">
        var fieldNameElement = document.getElementById('error_feild');
        <?php
            if (isset($_POST['submit'])) {
                $fname = $_POST['fName'];
                $lname = $_POST['lName'];
                $email = $_POST['email'];
                $address1 = $_POST['line1'];
                $address2 = $_POST['line2'];
                $address3 = $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip'];
                $address4 = $_POST['country'];
                if($fname == ""){
                    echo 'fieldNameElement.innerHTML = "Please enter your name";';
                }
                else if($lname == ""){
                    echo 'fieldNameElement.innerHTML = "Please enter your name"';
                }
                else if($email == ""){
                    echo 'fieldNameElement.innerHTML = "Please enter your email"';
                }
                else if($address1 == ""){
                    echo 'fieldNameElement.innerHTML = "Please enter your full address"';
                }
                else if( $_POST['city'] == "" || $_POST['state'] == "" || $_POST['zip'] == ""){
                    echo 'fieldNameElement.innerHTML = "Please enter your full address"';
                }
                else if( $address4 == ""){
                    echo 'fieldNameElement.innerHTML = "Please enter your full address"';
                }
                
                else{
                    $vars = "?prod_id=$id&fname=$fname&lname=$lname&email=$email&address1=$address1&address2=$address2&address3=$address3&address4=$address4";
                    echo 'function jsFunction(){location.href = "order2.php'.$vars.'";}';
                    echo 'jsFunction();'; //things broke so i cheated the link
                }

            }
        ?>
    </script>
   


<?php include('partials/footer.php');?>
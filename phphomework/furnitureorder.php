#!/usr/local/php5/bin/php-cgi
  
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Order Form</title>
	<link href="order.css" rel="stylesheet" />
    <script src="js/func.js" ></script>
 
</head>

<body>
    <?php
// define variables and set to empty values
$nameErr = $lnameErr = $emailErr = $addrErr = $zipErr  = "";
$fname = $lname = $email = $address = $city = $state = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $nameErr = "First Name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $nameErr = "Invalid Name (Only Characters)"; 
    }
  }
   
  if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";
  } else {
    $lname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameErr = "Invalid Name (Only Characters)"; 
    }
  }
    
     
  if (empty($_POST["address"])) {
    $addrErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
    // check if address is formatted correct
    if (!preg_match("/^(?:\\d+ [a-zA-Z ]+, ){2}[a-zA-Z ]+$/",$address)) {
      $addrErr = "Invalid Address (Ex. 1234 First St)"; 
    }
  }    
         
  if (empty($_POST["zipcode"])) {
    $zipErr = "Zipcode is required";
  } else {
    $zipcode = test_input($_POST["zipcode"]);
    // check if zipcode is 5 digits
    if (!preg_match("/^\d{5}$/",$zipcde)) {
      $Err = "Invalid Zipcode"; 
    }
  }
     

  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid Email (Ex. john@mail.com)"; 
    }
  }
    
    $city = $_POST["city"];
    $state = $_POST["state"];
    
}
   
          
    

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="title">
    <h1>Shopping Cart</h1>
</div>
    
        <div class="allsales">
            <h2>Select a Shipping Option:</h2>
            <p>Shipping is $20 to our local customers and $40 to our non-local customers.</p>
        <button type="button" id="salesbutton" onclick="showSales()">Show Sales</button>
        <div id="salesitems" style ="display:none">
            <h1 id = "heading">Sales</h1>
            <p>
               Check out our incredible savings!
            </p>

            <div class="items">
                <div class="item">
                        <div class="item-name"><h1>PaleWave Recliner</h1> </div>
                        <h2 class="strike">Regularly: $200</h2>
                        <h2>Sale: $150</h2>
                        <img id="recliner" src = "images/chair2.jpg"  alt = "PaleWave S/S 18 Recliner">
                </div>

                <div class="item">
                        <div class="item-name"><h1>PaleWave Sofa</h1> </div>
                        <h2 class="strike">Regularly: $300</h2>
                        <h2>Sale: $240</h2>
                        <img src = "images/sofa1.jpg" id="sofa" alt = "PaleWave S/S 18 Sofa">
                </div>
            </div>

        </div>
    </div>
    
    <div id="options">
        <fieldset>
            <legend>Shipping Options</legend>
            <input type="radio" id="pickupbutton" name="p1" onclick ="togglePickup()"><label for = "pickupbutton"> Pickup</label> 
            <input type="radio" id="deliverybutton" name="p1" onclick ="toggleDeliver()"><label for = "deliverybutton"> Delivery</label> 
        </fieldset>
     
    </div>
        <br>
        <form id="hide" onsubmit="return chooseSubmission()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            
            <div id="pickupinfo" style="display:none">
                <fieldset class="customerinfo">
            <legend>Customer Information</legend>
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" class="required" value ="<?php echo $fname;?>"> 
            <span class="error">* <?php echo $nameErr;?></span> <br>
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" class="required" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" value ="<?php echo $lname;?>"> 
            <span class="error">* <?php echo $lnameErr;?></span> <br>
            <label for="email">Email:</label>      
            <input type="email" id="email" name="email" class="required" value ="<?php echo $email;?>"> 
            <span class="error">* <?php echo $emailErr;?></span> 
                </fieldset>
            </div>
                                      
            <div id="deliveryinfo" style="display:none">
                <fieldset class="toggleme" >
                <legend>Shipping Information</legend>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" class="required" value ="<?php echo $address;?>">
            <span class="error">* <?php echo $addrErr;?></span>  <br>   
            <label for="city">City:</label>
            <input type="text" id="city"  name="city"> <br>
            <label for="state">State:</label>
            <input type="text" id="state" name="state"> <br> 
            <label for="zipcode">Zipcode:</label>
            <input type="text" id="zipcode" pattern="[0-9]{5}" class="required" name="zipcode" value ="<?php echo $zipcode;?>">
            <span class="error">* <?php echo $zipErr;?></span> 
                </fieldset>
             </div>    
        
              <div class ="AllStore">
            <div class="left">
         <div class="product">
             <br>
            <img id="pwchair" src="images/chair1.jpg" alt="PaleWave S/S 18 Chair">
                <p>PaleWave Chair S/S 18</p>
             <p>$199.00</p>
             <label for="chairamt"> Select Amount</label>
             <select id="chairamt" name="q1" onchange="chairamount()">
				<option value="0" selected=""> 0 </option>
				<option value="1"> 1 </option>
				<option value="2"> 2 </option>
				<option value="3"> 3 </option>
				<option value="4"> 4 </option>
			</select>
		
        </div>
            <div class="product">
                <br>
            <img id ="pwrec" src="images/chair2.jpg" alt="PaleWave S/S 18 Recliner">
                <p>PaleWave Recliner S/S 18</p>
                <p>$150.00</p>
                
                <label for="recamt"> Select Amount</label>
               <select id="recamt" name="q2" onchange="recamount()">
             	<option value="0" selected=""> 0 </option>
				<option value="1"> 1 </option>
				<option value="2"> 2 </option>
				<option value="3"> 3 </option>
				<option value="4"> 4 </option>
			</select>
        </div>
    </div>
            <div class ="right">
            <div class="product">
                <br>
            <img id ="pwbed" src="images/bed1.jpg" alt="PaleWave S/S 18 Bed">
                <p>PaleWave Bed S/S 18</p>
                <p>$240.00</p>
                <label for="bedamt">Select Amount</label>
                 <select id="bedamt" name="q3" onchange="bedamount()">
             	<option value="0" selected=""> 0 </option>
				<option value="1"> 1 </option>
				<option value="2"> 2 </option>
				<option value="3"> 3 </option>
				<option value="4"> 4 </option>
			</select>
			<br>
        </div>
             <div class="product">
                 <br>
            <img id ="pwsofa" src="images/sofa1.jpg"  alt="PaleWave S/S 18 Sofa">
                    <p>PaleWave Sofa S/S 18</p>
                 <p>$499.00</p>
                 <label for="sofaamt"> Select Amount</label>
                  <select id="sofaamt" name="q4"onchange="sofaamount()">
               	<option value="0" selected=""> 0 </option>
				<option value="1"> 1 </option>
				<option value="2"> 2 </option>
				<option value="3"> 3 </option>
				<option value="4"> 4 </option>
			</select>
			
        </div>
        
        
        </div>
    </div>
      
   
    <div id="Payment">
            <h2>Checkout</h2>
        <p id="subtotal">Subtotal = $0.00</p>
        <p id="tax">Tax = $0.00</p>
        <p id="shipping">Shipping = $0.00</p>
        <p id="total" >Total = $0.00</p>
        
    </div>
    <input type="submit" value="submit" >
   
       </form>  

    
<?php
echo "<h2>Order Summary:</h2>";
echo "<h3> Customer Info </h3>";    
echo $fname;
echo $lname;
echo "<br/>";    
echo $email;
echo "<br/>";    
echo $city;    
echo $state;
echo "<br/>";     
echo $address;
echo "<br/>";     
echo $zipcode;
echo "<br/>";
$quantity =  $_POST["q1"] + $_POST["q2"] +  $_POST["q3"] +  $_POST["q4"]; 
echo $quantity; 
echo "<br/>";    
       
?>
    <?php
    $a .= $fname;
    $a .= $lname;
    $a .= $email;
    $a .= $city;
    $a .= $state;
    $a .= $zipcode;
    $a .= $address;
    $a .= $quantity;
    $a .= "/r/n";
    file_put_contents("furnitureorder.text", $a, FILE_APPEND | LOCK_EX);
    ?>
    <br>
    <a href="furnitureorder.text">Output</a>
    <br>
    
    
    <?php
// outputs e.g. 'Last modified: March 04 1998 20:43:59.'
    echo "Jordan Lever"; 
        echo "Email:Jordan.lever@student.csulb.edu <br>";
    
echo "Last modified: " . date ("F d Y H:i:s.", getlastmod());
?>


</body>
</html>
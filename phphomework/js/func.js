var quantities = [0, 0, 0, 0];
var prices = [199, 150, 240, 499];
var grandTotal = 0;

function calculateShipping(){
    var x = document.getElementById("pickupbutton")
    var zipcode = document.getElementById("zipcode")
if(x.checked) {
     var shipping = 0;
}   
else{
      
if(zipcode.value >= 90000){
    //check for local customers
    shipping = 20;
}
    else{
        shipping = 40;
    } 
    
}
  


document.getElementById("shipping").innerHTML = "Shipping: $" + shipping.toFixed(2); 
}




function showSales(){
    var x = document.getElementById("salesitems");
    var y = document.getElementById("salesbutton")
    if (x.style.display === "none") {
        x.style.display = "block";
         y.innerHTML = "Hide Sales"
    } else {
        x.style.display = "none";
        y.innerHTML = "Show Sales"
    }
}

function toggleDeliver(){
    var y = document.getElementById("pickupinfo");
    var x = document.getElementById("deliveryinfo");
    if(x.style.display ==="none"){
        y.style.display = "block";
        x.style.display = "block";
    }
    else{
       x.style.display = "none";
        y.style.display ="none";
    }
}

function togglePickup(){
    var x = document.getElementById("pickupinfo");
    var y = document.getElementById("deliveryinfo");
    if(x.style.display ==="none"){
        x.style.display = "block";
        y.style.display ="none";
    }
    else{
        x.style.display = "none";
        y.style.display = "none";
    }
}

function updateTotal(){
    var subtotal = 0;
    var tax = 0;
    var shipping = 0;
    grandTotal = 0;
    var count = 0;
    while(count <= 3){
          subtotal= subtotal + (prices[count] * quantities[count]);
        count+=1;
    }
    calculateShipping();
    tax = .095 * subtotal;
    grandTotal = tax + subtotal + shipping;
    document.getElementById("subtotal").innerHTML = "Subtotal : $" + subtotal.toFixed(2);
	document.getElementById("tax").innerHTML = "Tax: $" + tax.toFixed(2);
	document.getElementById("total").innerHTML = "Total: $" + grandTotal.toFixed(2)
}



function chairamount(){
    var x = document.getElementById("chairamt").value;
    quantities[0] = x;
    updateTotal();
}
function recamount(){
     var x = document.getElementById("recamt").value;
    quantities[1] = x;
    updateTotal();
}
function bedamount(){
    var x = document.getElementById("bedamt").value;
    quantities[2] = x;
    updateTotal();
}
function sofaamount(){
var x = document.getElementById("sofaamt").value;
    quantities[3] = x;
    updateTotal();
}
function submitPickup(){
  var fname =  document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var email = document.getElementById("email").value;
    if(fname == null || fname == ""){
        alert("Please Enter First Name");
        event.preventDefault();
        
    }
    else if(lname == null || lname == ""){
        alert("Please Enter Last Name");
         event.preventDefault();
    }
    else if(email == null || email == ""){
        alert("Please Enter your Email");
        event.preventDefault();
    }
    calculateShipping();
    updateTotal();
    alert("Pickup Order Successful! Enjoy the wavy furniture.");
    return true;
}



function submitDelivery(){
    console.log("Method working")
    var fname =  document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var email = document.getElementById("email").value;
  var address= document.getElementById("address").value;
  var city = document.getElementById("city").value;
  var state = document.getElementById("state").value;
  var zip = document.getElementById("zip").value;
    var s = document.getElementsByClassName("select").value;
    console.log(fname)
    
 if(fname == null || fname == ""){
        alert("Please Enter First Name");
        event.preventDefault();
    }
    else if(lname == null || lname == ""){
        alert("Please Enter First Name");
         event.preventDefault();
    }
    else if(email == null || email == ""){
        alert("Please Enter your Email");
        event.preventDefault();
    }
    else if(address == null || address == ""){
        alert("Please Enter your Address");
         event.preventDefault();

    }
     else if (zip == null || zip == "" ){
        alert("Please enter the zip");
         event.preventDefault();
   
    }
    else{
        calculateShipping();
    updateTotal();
    alert("Delivery Order Succesful! Enjoy the wavy furniture.");
    }
  
    return true;
}
  
function chooseSubmission(){
    var x = document.getElementByID("p1").value;
    if(x == null){
      alert("Please Select A Shipping Option");
        event.preventDefault();
    }
    else{
          if(x == 1){
        submitPickup();
              return true;
              
    }
    else{
        submitDelivery();
        return true;
    }
    }
  
}



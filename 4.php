<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>  button.number-button, button.plu-button { width: 60px; height: 60px;  font-size: 16px; } .selected { background-color: #e6e6e6;  } .productItem { cursor: pointer; margin-bottom: 5px; } .deleteButton { cursor: pointer; color: red; margin-left: 5px; }  </style>
</head>
<body>

<h1>Product List</h1>

<form>
    <label for="productNumber">Enter Product Number:</label>
    <input type="text" id="productNumber" name="productNumber">
    <button type="button" onclick="displayProduct()">Show Product</button>
    
<button type="button" onclick="addPLU()" class="number-button" style="margin-left: 12px; margin-top: 10px" >PLU</button>


    <label for="selectedProduct">Select Product:</label>
    <select id="selectedProduct" onchange="displaySelectedProduct()">
        <option value="" selected disabled>Select a product</option>
    </select>

    <button type="button" onclick="moveCursorUp()">▲</button>
    <button type="button" onclick="moveCursorDown()">▼</button>

    <!-- Number buttons -->
    <div>
        <button type="button" onclick="appendNumber(1)" class="number-button">1</button> <button type="button" onclick="appendNumber(2)" class="number-button">2</button> <button type="button" onclick="appendNumber(3)" class="number-button">3</button> </div> <div> <button type="button" onclick="appendNumber(4)" class="number-button">4</button> <button type="button" onclick="appendNumber(5)" class="number-button">5</button> <button type="button" onclick="appendNumber(6)" class="number-button">6</button> </div> <div> <button type="button" onclick="appendNumber(7)" class="number-button">7</button> <button type="button" onclick="appendNumber(8)" class="number-button">8</button> <button type="button" onclick="appendNumber(9)" class="number-button">9</button> </div> <div> <button type="button" onclick="appendNumber(0)" class="number-button">0</button> <button type="button" onclick="clearProductNumber()" class="number-button">Delete</button> </div>

    <button type="button" onclick="clearSelectedProducts()">C</button>
</form>

<div id="productDetails"></div>


<script>
    var products = {
        "1": { name: "Gyoza", price: 4.25 },
        "2": { name: "Crab Rangoon", price: 5.25 },
        "3": { name: "Spring Rll", price: 4.25 },
        "4": { name: "Egg Roll", price: 4.25 },
        "5": { name: "Edamame", price: 4.25 },
        "6": { name: "Chk Nugget", price: 4.25 },
        "7": { name: "Sft Shell Crab", price: 7.00 },
        "8": { name: "Calamari", price: 6.25 },
        "9": { name: "S.Yum² sc", price: 0.50 },
        "10": { name: "Med Yum² sc", price: 2.99 },
        "11": { name: "32oz Yum² sc", price: 10.99 },
        "12": { name: "Egg spc Yum² sc", price: 5.99 },
        "13": { name: "H. Chicken", price: 10.29 },
        "14": { name: "H. Steak", price: 11.95 },
        "15": { name: "H. Shrimp", price: 11.95 },
        "16": { name: "H. Sukiyaki", price: 11.95 },
        "17": { name: "H. Scallop", price: 14.25 },
        "18": { name: "H. Salmon", price: 11.75 },
        "19": { name: "H Fillet", price:
14.95},
        "20": { name: "H lobster", price:
20.95},
        "21": { name: "H Vegetable", price: 9.25 },
        "22": { name: "H Teriyaki", price: 10.29 },
        "23": { name: "H Sesame", price: 10.29 },
        "24": { name: "ST/SH/CHK LOMEIN", price: 11.99 },
        "25": { name: "Steak & Chk", price: 14.99 },
        "26": { name: "Steak & SHMP", price: 14.99 },
        "27": { name: "Chicken & SHMP", price: 14.99 },
        "28": { name: "Chicken & SCLP", price: 17.95 },
        "29": { name: "Steak & SCLP", price: 17.95 },
        "30": { name: "Shrimp & SCLP", price: 17.95 },
        "31": { name: "Fillet & SCLP", price: 19.75 },
        "32": { name: "Fillet & SHMP", price: 18.75 },
        "33": { name: "Filelt & Chk", price: 18.50 },
        "34": { name: "Steak,Chk,Shmp", price: 19.95 },
        "35": { name: "Steak,Shmp,Sclp", price: 20.25 },
        "36": { name: "Steak,Chk,Sclp", price: 20.25 },
        "37": { name: "SO. Fried rice", price: 4.75 },
        "38": { name: "SO. LO MEIN", price: 5.25 },
        "39": { name: "SO. Vegetables", price: 4.75},
        "40": { name: "SO. Chicken", price: 6.25},
        "41": { name: "SO. Steak", price: 7.75 },
        "42": { name: "SO. SHRMP/SALMON", price: 7.75 },
        "43": { name: "SO. Scallop", price: 9.75 },
        "44": { name: "SO. Fillet Mignon", price: 9.75 },
        "45": { name: "Lobster", price: 15.95 },
        "46": { name: "Single Burger", price: 6.75 },
        "47": { name: "Double Burger", price: 8.50 },
        "48": { name: "Ultimate Burger", price: 9.99 },
        "49": { name: "French Fries", price: 1.99 },
        "50": { name: "Bacon", price: 0.99 },
        "51": { name: "Water/Soda", price: 1.50 },
        "52": { name: "California Roll", price: 5.25 },
        "53": { name: "Alaska Roll", price: 5.25 },
        "54": { name: "Spc.Tuna Roll", price: 5.25 },
        "55": { name: "Shmp.Tempura Roll", price: 6.50 },
        "56": { name: "Spc. Crab Roll", price: 5.25 },
        "57": { name: "Eel Avocado Roll", price: 5.25 },
        "58": { name: "DF. California", price: 8.25 },
        "59": { name: "South Cali Roll", price: 8.75},
        "60": { name: "West Cali Roll", price: 9.50},
        "61": { name: "Kamikaze Roll", price: 9.99 },
        "62": { name: "Volcano Roll", price: 10.95 },
        "63": { name: "American Dream", price: 11.25 },
        "64": { name: "Tokyo Roll", price: 8.25 },
        "65": { name: "Eel/Spc mayo sauce", price: 0.99 },
        "66": { name: "Any extra", price: 0.99 },
        "67": { name: "Gft Card $5", price: 5.00 },
        "68": { name: "Gft Card $10", price: 10.00 },
        "69": { name: "Gft Card $15", price: 15.00 },
        "70": { name: "Gft Card $25", price: 25.00 },
        "71": { name: "Kingkong Roll", price: 10.95 },
        "72": { name: "Sub. Lomein", price: 1.25 },
        "73": { name: "Snowdrop Roll", price: 10.95 },
        "74": { name: "OMG Roll", price: 10.95 },
        "75": { name: "Boba", price: 4.95 },
        "76": { name: "Poping", price: 0.75 },
        "77": { name: "Gft Card $20", price: 20.00 },
        
       // Add more products as needed
    };

    var selectedProducts = [];
    var cursorIndex = null;

    function displayProduct() {
        var productNumber = document.getElementById("productNumber").value;
        var productDetails = document.getElementById("productDetails");

        if (productNumber && products[productNumber]) {
            productDetails.innerHTML = `<p>Product: ${products[productNumber].name}</p><p>Price: $${products[productNumber].price.toFixed(2)}</p>`;
        }
    }

    function addPLU() {
        var productNumber = document.getElementById("productNumber").value;
        if (productNumber && products[productNumber]) {
            selectedProducts.push(products[productNumber]);
            updateSelectedProductsDropdown();
            updateSelectedProductsDetails();
            // Clear the input field
            document.getElementById("productNumber").value = "";
        }
    }

    function updateSelectedProductsDropdown() {
        var dropdown = document.getElementById("selectedProduct");
        dropdown.innerHTML = "<option value='' selected disabled>Select a product</option>";

        for (var i = 0; i < selectedProducts.length; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.text = selectedProducts[i].name;
            dropdown.add(option);
        }
    }

    function updateSelectedProductsDetails() {
        var productDetails = document.getElementById("productDetails");
        var subtotal = 0;

        var selectedProductsHTML = "<p>Selected Products:</p>";
        for (var i = 0; i < selectedProducts.length; i++) {
            var productClass = i === cursorIndex ? "selected" : ""; // Highlight the selected product
            selectedProductsHTML += `<p class="${productClass} productItem" id="product${i}" onclick="selectProduct(${i})">${selectedProducts[i].name} - $${selectedProducts[i].price.toFixed(2)}<span class="deleteButton" onclick="deleteProduct(${i})">Delete</span></p>`;
            subtotal += selectedProducts[i].price;
        }

        var tax = subtotal * 8.975/100; // 8.975% tax
        var total = subtotal + tax;

        selectedProductsHTML += `<p>Subtotal: $${subtotal.toFixed(2)}</p>`;
        selectedProductsHTML += `<p>Tax (8.975%): $${tax.toFixed(2)}</p>`;
        selectedProductsHTML += `<p>Total: $${total.toFixed(2)}</p>`;

        productDetails.innerHTML = selectedProductsHTML;
        cursorIndex = null; // Reset cursor position when updating the product details
    }

    function displaySelectedProduct() {
        var selectedIndex = document.getElementById("selectedProduct").value;
        cursorIndex = selectedIndex !== "" ? parseInt(selectedIndex) : null; // Update cursor position
        updateSelectedProductsDetails();
    }

    function moveCursorUp() {
        if (cursorIndex !== null && cursorIndex > 0) {
            cursorIndex--;
            document.getElementById("selectedProduct").value = cursorIndex;
            displaySelectedProduct();
        }
    }

    function moveCursorDown() {
        if (cursorIndex !== null && cursorIndex < selectedProducts.length - 1) {
            cursorIndex++;
            document.getElementById("selectedProduct").value = cursorIndex;
            displaySelectedProduct();
        }
    }

    function appendNumber(num) {
        document.getElementById("productNumber").value += num;
    }

    function clearProductNumber() {
        document.getElementById("productNumber").value = "";
    }

    function clearSelectedProducts() {
        selectedProducts = [];
        updateSelectedProductsDropdown();
        updateSelectedProductsDetails();
    }

    function selectProduct(index) {
        cursorIndex = index;
        updateSelectedProductsDetails();
    }

    function deleteProduct(index) {
        selectedProducts.splice(index, 1);
        updateSelectedProductsDropdown();
        updateSelectedProductsDetails();
    }
</script>

</body>
</html>
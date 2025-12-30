<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Room Properties</title>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
body {
    background-color: #f4f6f8;
    display: flex;
    min-height: 100vh;
    flex-direction: column;
}

header {
    background: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    border-bottom: 2px solid #e5e5e5;
    position: sticky;
    top: 0;
    z-index: 10;
}
header .logo {
    font-size: 2rem;
    font-weight: 800;
    color: #b40000;
}
nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
}
nav ul li a {
    text-decoration: none;
    color: #222;
    font-weight: 600;
}
nav ul li a:hover {
    color: #b40000;
}

.layout {
    display: flex;
    flex: 1;
    gap: 15px;
    padding: 20px;
}


aside {
    background: #11324d;
    color: white;
    padding: 15px;
    border-radius: 10px;
    width: 200px;
    min-height: calc(100vh - 70px - 50px); /* full height minus header/footer */
}
.menu-title {
    font-weight: bold;
    padding: 10px;
    background: #1d4d6d;
    border-radius: 6px;
    cursor: pointer;
}
.menu-links {
    list-style: none;
    display: none;
    padding-left: 0;
    margin-top: 10px;
}
.menu-links li a {
    display: block;
    padding: 8px;
    color: #d1d1d1;
    text-decoration: none;
    border-radius: 4px;
}
.menu-links li a:hover {
    background: #1d4d6d;
    color: #fff;
}


main {
    flex: 1;
}
.new {
    background-color:#3cc49f ;
    padding: 10px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 8px;
}
.new a {
    background-color:#11324d ;
    color: white;
    padding: 10px;
    border-radius: 8px;
    text-decoration: none;
}
.new a:hover {
    background-color: blue;
}
.new h1 {
    color: white;
    font-size: 1.8rem;
}
table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
}
th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}
th {
    background-color: #3cc49f;
    color: #fff;
}
td {
    background-color: #ffffff;
    color: #333;
}

footer {
    background: #002b43;
    color: white;
    text-align: center;
    padding: 15px;
    font-weight: bold;
    margin-top: auto;
}


@media(max-width:900px){
    .layout {
        flex-direction: column;
    }
    aside {
        width: 100%;
        min-height: auto;
    }
}
</style>
</head>
<body>

<header>
    <div class="logo">Property24ET</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="buy.php">Buy</a></li>
            <li><a href="sell.php">Sell</a></li>
            <li><a href="rental.php">Rental</a></li>
            <li><a href="register.php">Sign Up</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>

<div class="layout">
    <aside>
        <div class="menu-title" onclick="toggleMenu()">Menu ▼</div>
        <ul class="menu-links" id="menuLinks">
            <li><a href="Properties.php">Properties</a></li>
            <li><a href="Rooms.php">Rooms</a></li>
            <li><a href="sell.php">Sell</a></li>
            <li><a href="buy.php">Buy</a></li>
            <li><a href="report.php">Reports</a></li>
            <li><a href="Help.php">Help</a></li>
            <li><a href="list.php">List of Sellers</a></li>
        </ul>
    </aside>

    <main>
        <div class="new">
            <h1>Room Properties List</h1>
            <a href="rent_apartment.php">NEW</a>
        </div>

        <table>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Listing</th>
                <th>Location</th>
                <th>City</th>
                <th>Full Address</th>
                <th>Price (ETB)</th>
                <th>Price Type</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Area (m²)</th>
                <th>Floor</th>
                <th>Parking</th>
                <th>Furnished</th>
            </tr>
            <tr>
                <td>Zenith Apartment</td>
                <td>Apartment</td>
                <td>Rent</td>
                <td>Bole</td>
                <td>Addis Ababa</td>
                <td>Bole Road, Block 3</td>
                <td>8,500</td>
                <td>Monthly</td>
                <td>2</td>
                <td>1</td>
                <td>85</td>
                <td>3</td>
                <td>Yes</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Sunrise Villa</td>
                <td>House</td>
                <td>Rent</td>
                <td>Lideta</td>
                <td>Addis Ababa</td>
                <td>Lideta Street, Villa 12</td>
                <td>15,000</td>
                <td>Monthly</td>
                <td>3</td>
                <td>2</td>
                <td>120</td>
                <td>1</td>
                <td>No</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Harmony Room</td>
                <td>Room</td>
                <td>Rent</td>
                <td>Arada</td>
                <td>Addis Ababa</td>
                <td>Arada Street, Room 5</td>
                <td>3,500</td>
                <td>Monthly</td>
                <td>1</td>
                <td>1</td>
                <td>25</td>
                <td>2</td>
                <td>No</td>
                <td>No</td>
            </tr>
        </table>
    </main>
</div>

<footer>
    &copy; Developed by Group-7 — 2025
</footer>

<script>

function toggleMenu(){
    const menu = document.getElementById('menuLinks');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>

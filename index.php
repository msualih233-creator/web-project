<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Property Finder</title>
<style>
/* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: #f4f6f8;
}

/* Header */
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
    gap: 25px;
    align-items: center;
}

nav ul li a {
    text-decoration: none;
    color: #222;
    font-weight: 600;
    font-size: 1rem;
    padding: 5px 10px;
    transition: 0.3s;
}

nav ul li a:hover {
    color: #b40000;
}

/* Profile dropdown */
.profile {
    position: relative;
    cursor: pointer;
}

.profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #b40000;
}

.profile-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 50px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    min-width: 160px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    z-index: 100;
}

.profile-dropdown a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #333;
    font-size: 0.95rem;
}

.profile-dropdown a:hover {
    background: #f4f4f4;
    color: #b40000;
}

/* Layout */
.layout {
    display: flex;
    flex: 1;
    gap: 15px;
    padding: 20px;
}

/* Sidebar */
aside {
    background: #11324d;
    color: white;
    border-radius: 10px;
    padding: 15px;
    min-height: calc(100vh - 70px - 50px); /* Full height minus header & footer */
}

.menu-title {
    font-weight: bold;
    padding: 10px;
    background: #1d4d6d;
    border-radius: 6px;
    cursor: pointer;
    margin-bottom: 10px;
}

/* Dropdown menu links */
.menu-links {
    list-style: none;
    display: none; /* Hidden by default */
    padding-left: 10px;
}

.menu-links li a {
    display: block;
    color: #d1d1d1;
    padding: 8px 5px;
    text-decoration: none;
    border-radius: 4px;
}

.menu-links li a:hover {
    background: #1d4d6d;
    color: #fff;
}

/* Main content */
main {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Hero */
.hero-image {
    background: url("20230628_172155.jpg") center/cover no-repeat;
    border-radius: 10px;
    height: 18rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: 700;
    text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}

/* Search */
.search {
    background: white;
    padding: 12px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.search input {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* Filters */
.filters {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    background: #004466;
    color: white;
    padding: 20px;
    border-radius: 10px;
}

.filters select {
    padding: 10px;
    border-radius: 6px;
    border: none;
    font-size: 0.95rem;
}

.filters .search-btn a {
    background: #0d5c88;
    padding: 10px 20px;
    border-radius: 6px;
    color: white;
    font-weight: bold;
    text-decoration: none;
}

.filters .search-btn a:hover {
    background: #b40000;
}

/* Feature cards */
.feature-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 15px;
}

.feature-card {
    background: white;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.feature-card img {
    width: 100%;
    height: 140px;
    border-radius: 6px;
    object-fit: cover;
    margin-bottom: 8px;
}

.feature-card h3 {
    font-size: 1rem;
    margin-bottom: 4px;
}

.feature-card p {
    font-size: 0.85rem;
    color: #555;
}

/* Footer */
footer {
    background: #002b43;
    color: white;
    text-align: center;
    padding: 12px;
    font-weight: bold;
}

@media(max-width:900px){
    .layout {
        flex-direction: column;
    }
    aside {
        min-height: auto;
        width: 100%;
    }
}
</style>
</head>
<body>

<header>
  <div class="logo">Property</div>
  <nav>
    <ul>
      <li><a href="buy.php">Buy</a></li>
      <li><a href="sell.php">Sell</a></li>
      <li><a href="rental.php">Rental</a></li>
      <li class="profile" onclick="toggleProfile()">
        <img src="profile-icon.png" alt="Profile">
        <div class="profile-dropdown" id="profileDropdown">
          <a href="register.php">Sign Up</a>
          <a href="login.php">Login</a>
          <a href="manage-properties.php">Manage Properties</a>
        </div>
      </li>
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
    <div class="hero-image">Find Your Property</div>

    <div class="search">
      <input type="text" placeholder="Search city, area, or location">
    </div>

    <div class="filters">
      <select>
        <option value="">Property Type</option>
        <option value="house">House</option>
        <option value="apartment">Apartment</option>
        <option value="shop">Shop</option>
      </select>
      <select>
        <option value="">Min Price</option>
        <option value="100000">R100 000</option>
        <option value="200000">R200 000</option>
        <option value="300000">R300 000</option>
      </select>
      <select>
        <option value="">Max Price</option>
        <option value="200000">R200 000</option>
        <option value="450000">R450 000</option>
        <option value="800000">R800 000</option>
      </select>
      <div class="search-btn">
        <a href="search.php">Search</a>
      </div>
    </div>

    <div class="feature-cards">
      <div class="feature-card">
        <img src="" alt="">
        <h3>Beautiful House</h3>
        <p>3 Beds • 2 Baths • 120 m²</p>
      </div>
      <div class="feature-card">
        <img src="" alt="">
        <h3>Modern Apartment</h3>
        <p>2 Beds • 1 Bath • 80 m²</p>
      </div>
      <div class="feature-card">
        <img src="" alt="">
        <h3>Shop Space</h3>
        <p>Commercial shop • 60 m²</p>
      </div>
    </div>
  </main>
</div>

<footer>
  &copy; Developed by Group-7 — 2018
</footer>

<script>
// Profile dropdown
function toggleProfile(){
    const dropdown = document.getElementById('profileDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
window.onclick = function(event){
    if(!event.target.closest('.profile')){
        document.getElementById('profileDropdown').style.display = 'none';
    }
}

// Sidebar menu toggle
function toggleMenu(){
    const menu = document.getElementById('menuLinks');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>

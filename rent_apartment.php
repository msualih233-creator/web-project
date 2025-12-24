<?php
$success = "";
$owner_name = $phone = $apartment_name = $location = $rent = $bedrooms = $description = "";
$owner_error = $phone_error = $apartment_error = $location_error = "";
$rent_error = $bedroom_error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_name = trim($_POST['owner_name']);
    $phone = trim($_POST['phone']);
    $apartment_name = trim($_POST['apartment_name']);
    $location = trim($_POST['location']);
    $rent = trim($_POST['rent']);
    $bedrooms = trim($_POST['bedrooms']);
    $description = trim($_POST['description']);
    if (empty($owner_name)) {
        $owner_error = "Owner name is required";
    }
    if (empty($phone)) {
    $phone_error = "Phone number is required";
} elseif (!is_numeric($phone)) {
    $phone_error = "Phone must contain numbers only";
}
    if (empty($apartment_name)) {
        $apartment_error = "Apartment name is required";
    }
    if (empty($location)) {
        $location_error = "Location is required";
    }
    if (empty($rent)) {
        $rent_error = "Rent is required";
    }
    if (empty($bedrooms)) {
        $bedroom_error = "Bedrooms is required";
    }
    if (
        $owner_error == "" &&
        $phone_error == "" &&
        $apartment_error == "" &&
        $location_error == "" &&
        $rent_error == "" &&
        $bedroom_error == ""
    ) {
        $conn = mysqli_connect("localhost", "root", "", "rental_system");
        if (!$conn) {
            die("Database connection failed");
        }
        $sql = "INSERT INTO apartments
        (owner_name, phone, apartment_name, location, rent, bedrooms, description)
        VALUES
        ('$owner_name','$phone','$apartment_name','$location','$rent','$bedrooms','$description')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        $success = " Apartment submitted successfully!";
        $owner_name = $phone = $apartment_name = $location = $rent = $bedrooms = $description = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent Apartment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST" class="contact-card">
    <h2>🏢 Rent Out Your Apartment</h2>

    <?php if ($success != "") { ?>
        <div style="color:green; margin-bottom:15px;">
            <?php echo $success; ?>
        </div>
    <?php } ?>
    <label>👤 Owner Name</label>
    <input type="text" name="owner_name" value="<?php echo $owner_name; ?>">
    <small style="color:red;"><?php echo $owner_error; ?></small>

   <label>📞 Phone Number</label>
<input type="text" name="phone" value="<?php echo $phone; ?>">
<small style="color:red;"><?php echo $phone_error; ?></small>
    <label>🏢 Apartment Name</label>
    <input type="text" name="apartment_name" value="<?php echo $apartment_name; ?>">
    <small style="color:red;"><?php echo $apartment_error; ?></small>
    <label>📍 Location</label>
    <input type="text" name="location" value="<?php echo $location; ?>">
    <small style="color:red;"><?php echo $location_error; ?></small>
    <label>💰 Monthly Rent</label>
    <input type="number" name="rent" value="<?php echo $rent; ?>">
    <small style="color:red;"><?php echo $rent_error; ?></small>
    <label>🛏 Bedrooms</label>
    <input type="number" name="bedrooms" value="<?php echo $bedrooms; ?>">
    <small style="color:red;"><?php echo $bedroom_error; ?></small>
    <label>📝 Description</label>
    <textarea name="description"><?php echo $description; ?></textarea>
    <button class="btn-send">Submit to Broker</button>
</form>
</body>
</html>

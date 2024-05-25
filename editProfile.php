<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="editProfile.css">
</head>

<body>
    <div class="edit-container">
        <h1>Edit Profile</h1>
        <form action="updateProfile.php" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : ''; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
            <label for="telepon">Telepon:</label>
            <input type="tel" id="telepon" name="telepon" pattern="[0-9]{10,12}" value="<?php echo isset($_SESSION['telepon']) ? $_SESSION['telepon'] : ''; ?>" required>
            <label for="avatar">Avatar:</label>
            <input type="file" id="avatar" name="avatar" accept="image/*">
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <section class="contact" style="background-image: url('../images/homebackground.jpeg');">
        <div class="content"><br><br><br><br>
            <h1>Contactez-nous</h1><br>
            <form id="contactForm" action="submit_contact.php" method="POST">
                <input type="text" id="name" name="name" placeholder="Votre nom" required>
                <input type="email" id="email" name="email" placeholder="Votre e-mail" required>
                <textarea id="message" name="message" placeholder="Votre message" required></textarea>
                <button type="submit">Envoyer</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $host = 'localhost';
                $dbname = 'infovital';
                $username = 'root';
                $password = '';

                $conn = new mysqli($host, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];

                $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $name, $email, $message);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Message envoyé avec succès!</p>";
                } else {
                    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>
</html>

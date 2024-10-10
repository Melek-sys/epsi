<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="css/styles.css">
    
<script>
!(function(){const sc=document.createElement('script');sc.src="https://apps.voc.ai/api_v2/gpt/bots/livechat/embed.js?id=18466&token=6707A109E4B03D3C7736A2B8";sc.async=true;sc.defer=true;document.body.appendChild(sc);})()
</script>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <section class="forum">
        <h1>Questions</h1>
        <br>

        <form id="questionForm" action="" method="POST">
            <input type="text" id="username" name="username" placeholder="Votre nom" required>
            <textarea id="question" name="question" placeholder="Posez votre question" required></textarea>
            <button type="submit">Soumettre la question</button>
        </form>

        <?php
        $host = 'localhost';
        $dbname = 'infovital';
        $username = 'root';
        $password = '';

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
            $username = $_POST['username'];
            $question = $_POST['question'];

            $sql = "INSERT INTO questions (username, question, created_at) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $question);
            $stmt->execute();
            $stmt->close();
        }

        $sql = "SELECT * FROM questions ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $question_id = $row['id'];
                echo "<div class='question-container'>";
                echo "<div class='question'>";
                echo "<h3>{$row['username']} a posé une question:</h3>";
                echo "<p>{$row['question']}</p>";
                echo "<div class='timestamp'>Posté le: <span class='date-time'>" . date('Y-m-d H:i', strtotime($row['created_at'])) . "</span></div>";

                $reply_sql = "SELECT * FROM replies WHERE question_id = ? LIMIT 5";
                $reply_stmt = $conn->prepare($reply_sql);
                $reply_stmt->bind_param("i", $question_id);
                $reply_stmt->execute();
                $reply_result = $reply_stmt->get_result();

                echo "<div class='replies'>";
                while ($reply_row = $reply_result->fetch_assoc()) {
                    echo "<div class='reply'>";
                    echo "<strong>{$reply_row['username']}</strong>: {$reply_row['reply']}";
                    echo "<div class='timestamp'>Répondu le: <span class='date-time'>" . date('Y-m-d H:i', strtotime($reply_row['created_at'])) . "</span></div>";
                    echo "</div>";
                }
                echo "</div>";

                echo "<form class='replyForm' action='' method='POST'>
                        <input type='hidden' name='question_id' value='$question_id'>
                        <input type='text' name='reply_username' placeholder='Votre nom' required>
                        <textarea name='reply' placeholder='Votre réponse' required></textarea>
                        <button type='submit'>Répondre</button>
                      </form>";

                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Aucune question disponible.</p>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply'])) {
            $reply_username = $_POST['reply_username'];
            $reply = $_POST['reply'];
            $question_id = $_POST['question_id'];

            $sql = "INSERT INTO replies (question_id, username, reply, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $question_id, $reply_username, $reply);
            $stmt->execute();
            $stmt->close();
            header("Location: forum.php");
            exit();
        }

        $conn->close();
        ?>
    </section>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>
</html>

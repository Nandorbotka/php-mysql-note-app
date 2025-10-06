<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jegyzetek</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-600">🗒️ Jegyzeteim</h1>

        <div class="flex justify-end mb-4">
            <a href="add.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
                + Új jegyzet
            </a>
        </div>

        <?php
        try {
            $stmt = $pdo->query('SELECT * FROM notes ORDER BY created_at DESC');
            $notes = $stmt->fetchAll();

            if (count($notes) === 0) {
                echo '<p class="text-center text-gray-500">Még nincs egy jegyzet sem. Kezdd el most! 😊</p>';
            } else {
                echo '<div class="space-y-4">';
                foreach ($notes as $note) {
                    echo "
                <div class='p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50'>
                  <h2 class='text-xl font-semibold text-gray-800 mb-2'>" . htmlspecialchars($note['title']) . "</h2>
                  <p class='text-gray-600 mb-4'>" . nl2br(htmlspecialchars($note['content'])) . "</p>
                  <div class='flex justify-between text-sm'>
                    <span class='text-gray-400'>" . htmlspecialchars($note['created_at']) . "</span>
                    <div class='space-x-2'>
                      <a href='edit.php?id={$note['id']}' class='text-blue-500 hover:text-blue-700 font-medium'>Szerkesztés</a>
                      <a href='delete.php?id={$note['id']}' class='text-red-500 hover:text-red-700 font-medium'>Törlés</a>
                    </div>
                  </div>
                </div>";
                }
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "<p class='text-red-500 text-center'>Hiba történt: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>

</body>

</html>
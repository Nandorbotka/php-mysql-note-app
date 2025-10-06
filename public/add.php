<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare('INSERT INTO notes (title, content) VALUES (?, ?)');
    $stmt->execute([$title, $content]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új jegyzet hozzáadása</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-600">➕ Új jegyzet</h1>

        <form method="POST" class="space-y-4">
            <div>
                <label for="title" class="block text-gray-700 font-medium mb-1">Cím</label>
                <input type="text" name="title" id="title" required
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
            </div>

            <div>
                <label for="content" class="block text-gray-700 font-medium mb-1">Tartalom</label>
                <textarea name="content" id="content" rows="6" required
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none"></textarea>
            </div>

            <div class="flex justify-between">
                <a href="index.php" class="text-gray-500 hover:text-gray-700 font-medium">← Vissza</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
                    Mentés
                </button>
            </div>
        </form>
    </div>

</body>

</html>
<?php
session_start();
if (!$_SESSION) {
    header('Location: ./register.php');
    exit();
}

$idUser = $_SESSION['user_id'];
require __DIR__ . "/../controller/comment.php";


$comments = new Comment();
$idUser = $_SESSION['user_id'];
$idC = $_GET['id'];
$idA = $_GET['idA'];

$comment = $comments->ModiferComment($idC);
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['PostComment'])) {
    $name = htmlspecialchars($_POST['comment']);
    $idT = intval($_POST['idC']);
    $comments->Modifer($idT, $name);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="w-screen h-screen flex items-center justify-center">

    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative mt-8 ">
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Leave a Comment
            </h3>
            <form action="./" method="POST" class="space-y-6">
                <!-- Hidden Inputs -->
                
                <input type="hidden" name="idC" value="<?= $comment['id_comment'] ?>">

                <!-- Comment Input -->
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700">
                        Your Comment <span class="text-red-500">*</span>
                    </label>
                    <div class="relative mt-2">
                        <i class="fas fa-comment-dots absolute left-4 top-3 text-gray-400"></i>
                        <textarea
    id="comment"
    name="comment"
    rows="4"
    placeholder="Write your comment..."
    required
    class="border rounded-lg p-3 pl-12 w-full focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none resize-none"><?= $comment['content'] ?></textarea>

                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        name="PostComment"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-paper-plane mr-2"></i> Post Comment
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>

</html>
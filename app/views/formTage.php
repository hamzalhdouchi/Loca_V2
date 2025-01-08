<?php


require __DIR__ . "/../controller/tags.php";
$idT = $_GET['id_M'];

$tage = new Tags();
$result = $tage->Modifertage($idT);


if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['ModifierTage'])) {
    $name = htmlspecialchars($_POST['tag_name']);
    $idT = intval($_POST['idT']);
    $tage->Modifer($idT, $name);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
    <!-- Content of the modal (form) -->
    <div class="bg-gradient-to-br from-gray-100 to-gray-300 p-8 rounded-lg shadow-lg max-w-[50vw] mx-auto">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">modifier Tag</h2>
        <!-- Form -->
        <form action="#" method="POST" class="space-y-4 w-[40vw] h-[50vh] overflow-y-auto p-4 bg-gray-100 rounded-lg">
            <!-- Tag Name Input -->
            <input type="hidden" name="idT" value="<?= $idT ?>">
            <div class="relative">
                <label for="tag_name" class="text-xs font-medium text-gray-600">Tag Name</label>
                <input type="text" name="tag_name" value="<?= htmlspecialchars($result['name']) ?>" id="tag_name" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Enter tag name" required />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center items-center">
                <button type="submit" name="ModifierTage" class="w-[30vw] py-2 text-sm text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

</body>

</html>
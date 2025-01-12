<?php
require __DIR__ . "/../controller/Article.php";
require __DIR__ . "/../controller/comment.php";
require __DIR__ . "/../controller/favoriat.php";
session_start();
$idU = $_SESSION['user_id'];
$coment = new comment();

$idA = $_GET['id'];

$comment = $coment->getComment($idA);

$article = new Article();
$articles = $article->getArticleSpiciale($idA);
$SpicialArticle = $articles[0];

$favorite = new favorite();
$likes = $favorite->getLike($idA, $idU);

$favorites = $favorite->getFavorait($idA,$idU);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['PostComment'])) {
    $comment = htmlspecialchars($_POST['comment']);
    $idA = intval($_POST['idA']);
    $idU = intval($_POST['idU']);
    $coment->setComment($comment, $idU, $idA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['likeButton'])) {
    $like = intval($_POST['like']);
    $idA = intval($_POST['id_Article']);
    $idU = intval($_POST['id_user']);
    $favorite->likeSet($idU, $idA, $like);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletLike'])) {
    $like = intval($_POST['likess']);
    $idA = intval($_POST['id_Article']);
    $favorite->deleteLike($like, $idA);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['favoraitbutton'])) {
    $like = intval($_POST['favorait']);
    $idA = intval($_POST['idA']);
    $idu= intval($_POST['iduser']);
    $favorite->AddToFavourait($like ,$idu, $idA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletComent'])) {
    $idC = intval($_POST['delet']);
    $coment->DeleteComent($idC,$idA);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-50">

    <!-- Header -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center">
                        <i class="fas fa-car-side text-2xl text-blue-600 mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">AutoLoc</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="./inde.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-home mr-1"></i> Accueil
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-car mr-1"></i> Véhicules
                    </a>
                    <a href="./reservation.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bookmark mr-1"></i> Réservations
                    </a>
                    <a href="./them.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-newspaper mr-1"></i>
                        Blogs
                    </a>
                    <a href="./register.php"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                    </a>

                </div>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="relative bg-blue-900 text-white h-[70vh]">
        <div class="absolute inset-0  bg-black opacity-50"></div>
        <img src="./public/img/gallery/2.jpg" alt="Electric Car" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex items-center justify-center text-center px-6">
            <div>
                <h2 class="text-4xl font-bold mb-4">Welcome to the Future of Cars</h2>
                <p class="text-lg mb-6">Explore the latest innovations, reviews, and trends in the automotive world. Stay informed about electric vehicles, self-driving cars, and more.</p>
                <div class="flex items-center justify-center space-x-4">
                    <!-- Like Button -->
                    <form action="" method="POST">
                        <input type="hidden" name="id_user" value="<?= $idU ?>">
                        <input type="hidden" name="id_Article" value="<?= $idA ?>">
                        <?php
                        if (!$likes) {
                        ?>
                            <input type="hidden" name="like" value="1">
                            <button type="submit" name="likeButton" class="flex items-center bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition">
                                <i class="fa fa-heart mr-2"></i> Like
                            </button>
                        <?php
                        } elseif ($likes['favorite'] == 1) {
                            ?>
                            <form action="" method="POST">
                                        <input type="hidden" name="likess" value="<?= $likes['id'] ?>">
                                        <input type="hidden" name="iduser" value="<?=$idU?>">
                                        <input type="hidden" name="idA" value="<?= $idA ?>">
                                        <button type="submit" name="deletLike" class="flex items-center bg-white text-red-500 font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition">
                                            <i class="fa fa-heart mr-2"></i> this Like
                                        </button>
                                    </form>
                                    <?php
                        }
                        ?>
                    </form>


                    <?php
                        if (!$favorites) {
                        ?>
                            <form action="" method="POST">
                                <input type="hidden" name="favorait" value="1">
                                <input type="hidden" name="iduser" value="<?=$idU?>">
                                <input type="hidden" name="idA" value="<?= $idA ?>">
                                <button type="submit" name="favoraitbutton" class="flex items-center bg-white text-red-500 font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition">
                                    <i class="fa fa-heart mr-2"></i> Add to favoriat
                                </button>
                            </form>
                            <?php
                        }
                        ?>
                
                </div>
            </div>
        </div>
    </section>

    <div id="article-details" class=" bg-white rounded-lg shadow-lg mt-6 p-6">
        <h2 class="text-3xl font-semibold text-gray-900 mb-4"><?= $SpicialArticle['title'] ?></h2>
        <p class="text-gray-600 mb-4"><?= $SpicialArticle['content'] ?></p>

        <div class="flex flex-wrap gap-2 mb-4">
            <?php $tags = explode(',', $SpicialArticle['tags']);
            foreach ($tags as $tage):
            ?>
                <span class="bg-gray-500 text-white text-xs font-semibold px-3 py-1 rounded-full"><?= $tage ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Comment Section -->
        <div class="mt-6">
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Comments</h3>
            <div class="space-y-4">
                <!-- Single Comment -->
                <?php
                foreach ($comment as $row):
                ?>
                    <div class="flex items-start space-x-4">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMwAAADACAMAAAB/Pny7AAAAMFBMVEXk5ueutLeor7La3d/n6erh4+SrsbXT1ti7wMPq7O2zubzKztDHy83Bxsi4vcDd4OHJo5BXAAAFEElEQVR4nO2cXZucIAxGUQIoCv7/f1t02t35XoHXSdxyrtq9mvMAgUSIUo1Go9FoNBqNRqPRaDQajUaj0Wg0Go2GbIj7ByCghFk2jFn/w/2Dikke2k1zGDZCmCenzTl9yLh5iN5e4+MQ3Ol8aNQh+s7a7o5NyJ1Jh0a3mtyL/PPpungenVH7Fx7fRD2eQYeW4dWYXNMPywls3Mv5dTfb+on7p/4ALaHfpXKCwSHt97skm07LtaG9U+xrqnWO+ze/ZMoyuehIXTgFLgmZNmUuIm2o1EWgTVr75ThZMS3F5Lw4doMXtt9k7JWP9AP3z7/B1bgkG0nLRleprDZyJhrFigWzYaMUGaqcZNvQSIloVK2S8NwWF2iqnWQbk4yhQaikoTHcHgo2MDKGhn6uXuzCRm6TykPZLfwBjQaUiw3sMiaiZLqomV2As4x/nlEAxbKEnXldlNlVvtwpMyysLrSjrLwfz1tGq8j8n8G7aGDb/wZzEc0A1/+607Cez/Z9vtgtwxoBSFfnmDdEzgiADWYJVhmHlbGc4Qx6mOmYKwHkoEuGWwbqkmT4XA4YmV8l09YMSuZXhebftGlWfWN6hDehwR40u8iaaoJTgIG3RIuVmVll0Jkmb9qMDWfMhTONK2gy52ZqLTUD62a8JYAkM8NcuJcMNnH23LVmpXCfNJh3GQWdZzP7wNCCcmGuNF9sUPOM/8PZGgJAwZl/+av15gzExUtwSXlA/dWZFMsErJiVEXEKiCO3xj8At5q4Fb6gqdbGTmIGRqnKUoAVsvov1J7QuK8z3FJXdJZ033SlohhgA/ePv6e86MR9l+EZS+HnTRvlXAP+ZikKAlba3fkLZEpc5L7UypfxRqqLotzNM0p+SUsh4wmdFZGPvYHc7uzGRhHp2DtomXcNThoWkWHsHjc8Pp2/V7GD3BeaN5BxQ/9Ox/aDkxvF7kk6oX/hY3sbNHu5L5PFxUcf2/dxkncU2wEpF5JQ/7eBRvpXF040vR6gcVTaTStOm/EU3RneQpSUxnP3nFHKrCxXbH8w6jxe6y9NCtpd2udE/9V5xvu4ttKZnNN6ka+09TJKFmGI23p/1namX//uY1gX0SLViLZmRnOI3j6ReCbV+SEN06LE+RAlkWGbUj953Ch16xhpST40LlMSyeyfcSPklIiKJo1m8s+6MuUIpYwzOPZNiEYN+0DrZ8PpQ2buEN9m/pIO03zVDZNOxjiVi07kSXP0+5yllN67D+cHpHQ4RGXTie6jSYLel+eXknLqT9UHSM/Ya6ZPbLrPlAhITdgHQK90wvGRbdTx0Bl2peOnY085RIfPsCub7tCPHbQgLzHu0TnuOl12LzaATjimbS2pGbzf76E/5hJqTutCIEd02iMdWVy6Axo5kftcFHu0maELh2Hp39ggwwCzCzSowd8vMdoIcIHZoJ9iFQLpFkKl10jQIF4KmIFrf7kH8O6R4wzzHFt9JR38RLaKyg6VVN2GEUpf9fQB+W4JQV8x0eqv+KKpuWUra1y69QRdagO5Fo+msD4Ie0uCxA5lH3LGz1Yv9lK0daKbfYAo61Jb3x33GEoeQIo4+D+j6H469HE8koIjGvQFNpbsvQbcHw9J/ktbbD8JMJkhgATPsuyqILrVD5TsvgHizsvXZMYzZONSPHnVAHivPyx5i0bkgfmbzEUD6PR/IJk7DbQ3Dp6YIyN6y1zJyTfN0Msm68WtFs7ZHkY0Go1Go9Fo/H/8AVoJTYWJQwYkAAAAAElFTkSuQmCC" alt="Commenter" class="w-10 h-10 rounded-full">
                        <div>
                            <span class="font-semibold text-gray-900"><?= $row['nom']  ?></span>
                            <span class="font-semibold text-gray-900"><?= $row['prenom'] ?></span>
                            <p class="text-sm text-gray-600"><?= $row['created_at'] ?></p>
                            <p class="text-gray-700 mt-2"><?= $row['content'] ?></p>
                            
                        </div>
                        <?php 
                        if ($row['author_id'] == $idU) {
                            ?>
                          <div class="flex space-x-4 mt-4">
                                <!-- Delete Button -->
                                 <form action="" method="post">
                                    <input type="hidden" name="delet" value="<?= $row['id_comment'] ?>">
                                 <button name="deletComent" class="flex items-center px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors duration-300">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                </button>
                                 </form>
                                <!-- Edit Button -->
                                
                                 <a href="./formComent.php?id=<?= $row['id_comment'] ?>?idA=<?= $idA ?>" class="flex items-center px-4 py-2 text-sm font-semibold text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition-colors duration-300">
                                    <i class="fas fa-edit mr-2"></i>
                        </a>
                                 </form>
                                
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                <?php endforeach ?>
            </div>

            <!-- Comment Input Section -->
            <div class="mt-8">
                <form action="" method="POST">
                    <input type="hidden" name="idA" value="<?= $SpicialArticle['id'] ?>">
                    <input type="hidden" name="idU" value="<?= $idU ?>">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Leave a Comment</h3>
                    <textarea name="comment" class="w-full p-4 border border-gray-300 rounded-lg" rows="4" placeholder="Write your comment..."></textarea>
                    <button type="submit" name="PostComment" class="mt-4 bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                        Post Comment
                    </button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>
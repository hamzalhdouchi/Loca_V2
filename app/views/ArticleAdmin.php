<?php
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/Article.php";

$themes = new Article();

$result = $themes->getArticle();
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['stat'];
    
    $themes->Setstatus($status,$id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="./assets/css/css/dach.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>M<span>odern</span></h3>
        </div>

        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/3.jpeg)"></div>
                <h4><?= $userName ?></h4>
                <small>Director</small>
            </div>

           
            <div class="side-menu">
                <ul>
                    <li>
                        <a href="./Dach.php">
                            <span class="las la-user-alt"></span>
                            <small>users</small>
                        </a>
                    </li>
                    <li>
                        <a href="./categorei.php">
                            <span class="las la-th-large"></span>
                            <small>categorei</small>
                        </a>
                    </li>
                    <li>
                        <a href="./vehcule.php">
                            <span class="las la-car"></span>
                            <small>véhcule</small>
                        </a>
                    </li>
                    <li>
                        <a href="./reservationAdmin.php">
                            <span class="las la-clipboard-check"></span>
                            <small>reservation</small>
                        </a>
                    </li>
                    <li>
                        <a href="./evaluations.php">
                            <span class="las la-star"></span>
                            <small>Avis</small>
                        </a>
                    </li>
                    <li>
                        <a href="./themeAdmin.php">
                            <span class="las la-tasks"></span>
                            <small>Theme</small>
                        </a>
                    </li>
                    <li>
                        <a href="./ArticleAdmin.php" class="active">
                            <span class="las la-newspaper"></span> <!-- Newspaper icon -->
                            <small>Article</small>
                        </a>
                    </li>
                    <li>
                        <a href="./tagAdmiun.php">
                            <span class="las la-tag"></span> <!-- Tag icon -->
                            <small>Tag</small>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <label for="">
                        <span class="las la-search"></span>
                    </label>

                    <div class="notify-icon">
                        <span class="las la-envelope"></span>
                        <span class="notify">4</span>
                    </div>

                    <div class="notify-icon">
                        <span class="las la-bell"></span>
                        <span class="notify">3</span>
                    </div>

                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>

                        <span class="las la-power-off"></span>
                        <span><a href="./register.php">Logout</a></span>
                    </div>
                </div>
            </div>
        </header>


    <main>

        <div class="page-content">
            <div class="records table-responsive">
                <div>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><span class="las la-sort"></span> name</th>
                                <th><span class="las la-sort"></span> discrption</th>
                                <th><span class="las la-sort"></span>Date de creation</th>

                                <th><span class="las la-sort"></span> ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    foreach ($result as $row) {
    ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td>
                <div class="client">
                    <div class="client-info">
                        <h4><?= htmlspecialchars($row['title']) ?></h4>
                    </div>
                </div>
            </td>
            <td>
                <h4><?= htmlspecialchars($row['content']) ?></h4>
            </td>
            <td><?= htmlspecialchars($row['created_at']) ?></td>
            <td>
    <?php
            if ($row['status'] == 2) { ?>
                <span class="reserved-badge bg-gradient-to-r from-red-400 to-red-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md inline-block">
                    <form action="" method="POST" class="m-0 p-0">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                        <input type="hidden" value="0" name="stat">
                        <button
                            class="w-full bg-transparent text-white font-semibold cursor-pointer focus:outline-none px-0 py-0"
                            type="submit"
                            name="status">
                            <!-- Refuser icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </form>
                </span>
            <?php
            } elseif ($row['status'] == 1) {
            ?>
                <span class="reserved-badge bg-gradient-to-r from-green-400 to-green-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md inline-block">
                    <form action="" method="POST" class="m-0 p-0">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                        <input type="hidden" value="2" name="stat">
                        <button
                            class="w-full bg-transparent text-white font-semibold cursor-pointer focus:outline-none px-0 py-0"
                            type="submit"
                            name="status">
                            <!-- Accept icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </form>
                </span>
            <?php
            } elseif ($row['status'] == 0) {
            ?>
                <span class="reserved-badge bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md inline-block">
                    <form action="" method="POST" class="m-0 p-0">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                        <input type="hidden" value="1" name="stat">
                        <button
                            class="w-full bg-transparent text-white font-semibold cursor-pointer focus:outline-none px-0 py-0"
                            type="submit"
                            name="status">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h6"></path>
                            </svg>
                        </button>
                    </form>
                </span>
            </td>
        </tr>
                                    <?php
                                    }
                                    ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </main>

    </div>

    <script src="./assets/css/JS/scripte.js"></script>
    <script>
        const modal = document.getElementById('modal');

        function openModalBtn() {


            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
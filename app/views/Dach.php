<?php 
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ ."/../controller/AuthController.php";


$users = new User();

$Admin = new Admin(); 

$user = $users->readUser();
 

$statistiqueUser = $Admin->statistiqueUser();
$statistiquePrix = $Admin->statistiqueReservations() * 1255;
$statistiqueVehicules = $Admin->statistiqueVehicules();
$statistiqueReservations =$Admin->statistiqueReservations();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['block'])) {
    $users->baneUser($_POST['bane'],$_POST['id']);
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
                        <a href="./Dach.php" class="active">
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
                        <a href="./ArticleAdmin.php">
                            <span class="las la-newspaper"></span> <!-- Newspaper icon -->
                            <small>Article</small>
                        </a>
                    </li>
                    <li>
                        <a href="./tagAdmiun.php" >
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
            
            <div class="page-header">
                <h1>Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>
            
            <div class="page-content">
            
                <div class="analytics">

                    <div class="card">
                        <div class="card-head">
                            <h2><?=  $statistiqueUser ?></h2>
                            
                        </div>
                        <div class="card-progress">
                            <small>Nombre de user</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?=  $statistiqueVehicules ?></h2>
                            
                        </div>
                        <div class="card-progress">
                            <small>Nombre of Vehicule</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?=  $statistiqueReservations ?></h2>
                            
                        </div>
                        <div class="card-progress">
                            <small>Numbro of Reservations</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?=  $statistiquePrix ?>.00 DH</h2>
                            
                        </div>
                        <div class="card-progress">
                            <small>Prix Total</small>
                            <div class="card-indicator">
                                <div class="indicator four" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="records table-responsive">

                    <div class="record-header">
                        <div class="add">
                            <span>Entries</span>
                            <select name="" id="">
                                <option value="">ID</option>
                            </select>
                            <button>Add record</button>
                        </div>

                        <div class="browse">
                           <input type="search" placeholder="Search" class="record-search">
                            <select name="" id="">
                                <option value="">Status</option>
                            </select>
                        </div>
                    </div> 

                    <div>
                        <table width="100%">
                        <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><span class="las la-sort"></span> name</th>
                                        <th><span class="las la-sort"></span> Prenom</th>
                                        <th><span class="las la-sort"></span> EMAIL</th>
                                        
                                        <th><span class="las la-sort"></span> ACTIONS</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <?php 
                                foreach($user as $row){
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td>
                                        <div class="client">
                                           <div class="client-img bg-img" style="background-image: url(img/3.jpeg)"></div>
                                            <div class="client-info">
                                                <h4><?= htmlspecialchars($row['nom']) ?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td><h4><?= htmlspecialchars($row['prenom']) ?></h4></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td>
                                                    <div class="flex justify-center gap-6">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="bane" value="1" >
                                                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                                            <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" name="block">
                                                                bane
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>

                </div>
            
            </div>
            
        </main>
        
    </div>
</body>
</html>
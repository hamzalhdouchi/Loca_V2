# 🚗 Plateforme de Location de Véhicules

Bienvenue sur la **Plateforme de Location de Véhicules**. Ce projet permet aux clients de louer des véhicules, d'explorer différentes catégories, de donner des avis, et aux administrateurs de gérer les réservations, véhicules, et autres données via un tableau de bord.

---

## 🚀 Fonctionnalités Principales

### 🛠️ **Pour les Clients**
- **Connexion** : Se connecter pour accéder à la plateforme.
- **Exploration** : Parcourir les différentes catégories de véhicules disponibles.
- **Détails des véhicules** : Consulter les informations détaillées sur chaque véhicule (modèle, prix, disponibilité, etc.).
- **Réservation** : Réserver un véhicule en spécifiant les dates et lieux de prise en charge.
- **Recherche** : Trouver un véhicule spécifique par son modèle ou ses caractéristiques.
- **Filtrage dynamique** : Filtrer les véhicules par catégorie sans recharger la page.
- **Avis** : Ajouter un avis ou une évaluation sur un véhicule loué.
- **Pagination** :
  - Version 1 : Pagination classique avec PHP.
  - Version 2 : Pagination dynamique avec [DataTable](https://datatables.net/).
- **Modification/Suppression d'avis** : Modifier ou supprimer ses propres avis (Soft Delete).

### 🛠️ **Pour les Administrateurs**
- **Gestion de masse** : Ajouter plusieurs véhicules ou catégories à la fois via une insertion en masse.
- **Dashboard** : Gérer les réservations, véhicules, avis, et catégories avec des statistiques détaillées.

---

## 📊 Technologies Utilisées

### 🖥️ **Frontend**
- **HTML5** : Structure des pages web.
- **CSS3** : Stylisation et responsive design.
- **Bootstrap** : Création d'une interface utilisateur responsive.
- **JavaScript** : Interaction dynamique avec la page (recherche et filtrage dynamique).
- **DataTable** : Ajout de fonctionnalités dynamiques comme la pagination, le tri et les recherches avancées.

### ⚙️ **Backend**
- **PHP** : Gestion de la logique métier et des fonctionnalités backend.
- **MySQL** : Base de données relationnelle pour stocker les informations des véhicules, utilisateurs, réservations, etc.
- **Procédures stockées et vues SQL** : Optimisation des requêtes pour des fonctionnalités spécifiques.

### 🔒 **Sécurité**
- **Hashage des mots de passe** : Protection des données utilisateurs.
- **Protection XSS** : Sécurisation des entrées pour éviter les attaques.
- **Prévention des injections SQL** : Requêtes préparées pour éviter les accès non autorisés.

### 📱 **Responsive Design**
- **Bootstrap** : Pour un rendu optimal sur tous les écrans (mobile, tablette, desktop).

---

## 📂 Structure du Projet

```plaintext
├── index.php                # Page principale (point d'entrée du site)
├── login.php                # Page de connexion
├── dashboard.php            # Tableau de bord admin
├── assets/
│   ├── ./assets/css/
│   │   ├── style.css        # Styles principaux
│   │   ├── datatables.css   # Styles pour DataTable
│   ├── js/
│   │   ├── main.js          # Scripts principaux
│   │   ├── datatables.js    # Scripts pour DataTable
│   ├── images/              # Images des véhicules et icônes
├── app/
│   ├── config/
│   │   ├── db.php     # Configuration de la base de données
│   ├── controllers/
│   │   ├── VehiculeController.php  # Contrôleur pour les véhicules
│   │   ├── ReservationController.php # Contrôleur pour les réservations
│   │   ├── AvisController.php       # Contrôleur pour les avis
│   │   ├── AuthController.php       # Contrôleur pour l'authentification
│   ├── views/
│   │   ├── vehicules/
│   │   │   ├── liste.php     # Vue : liste des véhicules
│   │   │   ├── details.php   # Vue : détails d'un véhicule
│   │   ├── reservations/
│   │   │   ├── creer.php     # Vue : formulaire de réservation
│   │   │   ├── historique.php # Vue : historique des réservations
│   │   ├── avis/
│   │   │   ├── liste.php     # Vue : liste des avis
│   │   │   ├── creer.php     # Vue : formulaire pour laisser un avis
│   │   ├── auth/
│   │   │   ├── login.php     # Vue : formulaire de connexion
│   │   │   ├── register.php  # Vue : formulaire d'inscription
│   │   ├── dashboard.php     # Vue : tableau de bord admin
├── sql/
│   ├── vues.sql             # Vue SQL "ListeVehicules"
│   ├── procedures.sql       # Procédure "AjouterReservation"
├── README.md                # Documentation du projet
├── .htaccess                # Redirection et réécriture d'URL (mod_rewrite pour MVC)


<a name="top"></a>

<div align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" alt="jQuery">
  <img src="https://img.shields.io/badge/Azure-0089D6?style=for-the-badge&logo=microsoft-azure&logoColor=white" alt="Azure">
  <h1>Réseau Social Étudiant - INPT Rabat</h1>
  <p>Plateforme sécurisée déployée sur Azure pour les étudiants de l'INPT Rabat</p>
</div>

## Table des Matières
1. [Introduction](#introduction)
2. [Fonctionnalités Clés](#features)
3. [Technologies Utilisées](#tech)
4. [Architecture Azure](#azure-arch)
5. [Structure du Projet](#structure)
6. [Installation Locale](#installation)
7. [Déploiement Azure](#azure-deploy)
8. [Captures d'Écran](#screenshots)
9. [Améliorations Futures](#future)

---

## Introduction<a name="introduction"></a>

**INPT-SM** est une plateforme de réseau social dédiée exclusivement aux étudiants de l'INSTITUT NATIONAL DES POSTES ET TELECOMMUCIATIONS de Rabat. Déployée sur Microsoft Azure, elle offre un environnement sécurisé pour :

- 👥 Les échanges académiques et sociaux au sein de groupes de filière
- 📚 Le partage de ressources pédagogiques
- 💬 La communication en temps réel via chat et appels vidéo
- 🎨 La personnalisation de l'expérience utilisateur (thèmes, couleurs)
- 🔒 Une infrastructure cloud sécurisée et scalable

<div align="right">
  <a href="#top">⬆ Retour en haut</a>
</div>

---

## Fonctionnalités Clés<a name="features"></a>

### 🎓 Profil Étudiant
- Création de compte
- Attribution automatique au groupe de filière
- Personnalisation du profil (photo, bio, ...)
- Édition des préférences (couleurs, notifications)

### 👥 Groupes et Communautés
- Intégration automatique au groupe de filière
- Recherche et adhésion à d'autres groupes
- Création de groupes
- Gestion des membres

### 📢 Publications et Interactions
- Création/modification/suppression de posts
- Commentaires et réactions (likes)
- Partage de documents et images
- Fil d'actualités personnalisé

### 💬 Communication Temps Réel
- Messagerie instantanée entre étudiants
- Appels vidéo via WebRTC
- Gestion des contacts et amis

### 🎨 Personnalisation
- Choix des couleurs d'affichage (thème clair/sombre)
- Interface responsive adaptée à tous appareils

<div align="right">
  <a href="#top">⬆ Retour en haut</a>
</div>

---

## Technologies Utilisées<a name="tech"></a>

<div align="center">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" width="60" height="60" alt="PHP">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" width="60" height="60" alt="MySQL">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-plain-wordmark.svg" width="60" height="60" alt="Bootstrap">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/jquery/jquery-original-wordmark.svg" width="60" height="60" alt="jQuery">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" width="60" height="60" alt="JavaScript">
  <img src="https://habrastorage.org/webt/sj/cp/ns/sjcpnsa3rhy4uystxuguhu162pq.png" width="60" height="60" alt="WebRTC">
  <img src="https://www.vectorlogo.zone/logos/microsoft_azure/microsoft_azure-icon.svg" width="60" height="60" alt="Azure">
</div>

### Frontend
- **HTML** - Structure des pages
- **CSS** - Styling et animations
- **JavaScript** - Interactivité
- **Bootstrap** - Framework responsive
- **jQuery** - Manipulation DOM et AJAX

### Backend
- **PHP** - Logique métier
- **MySQL** - Base de données

### Communication
- **WebSocket** - Chat en temps réel
- **WebRTC** - Appels vidéo
- **AJAX** - Mises à jour asynchrones

### Infrastructure
- **Azure App Service** - Hébergement web


<div align="right">
  <a href="#top">⬆ Retour en haut</a>
</div>

---


## Installation<a name="installation"></a>

### Prérequis
- XAMPP (Apache, MySQL, PHP)

### Étapes d'installation
1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/Alidou26//INPT-Social-Media.git
   cd INPT-Social-Media
   ```
   
2. **Configurer la base de données**

  - Importer inpt_sm.sql dans phpMyAdmin

  - Configurer les accès dans BaseDeDonnees.php
    

 3. **Démarrer le serveur**

   - Lancer Apache et MySQL via XAMPP

   - Accéder à http://localhost/est-social


<div align="right"> <a href="#top">⬆ Retour en haut</a> </div>

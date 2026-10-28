# CS2 Strat & Exec Book Manager - Docker Cloud

## Description du Projet
Plateforme web centrale conçue pour les équipes CS2 permettant de concevoir, documenter et réviser leurs tactiques à 5 joueurs (timing, rôles IGL, Entry, Support, Lurker/AWP, et bibliothèque de lineups).

## Architecture des Conteneurs
- **web-nginx** : Serveur Web / Reverse Proxy principal (Port 80).
- **frontend-vue** : Application Frontend VueJS (Port 3000) pour l'interface de consultation des strats.
- **backend-symfony** : API Symfony / PHP 8.2 (Port 8000) gérant la logique métier et les tactiques.
- **ci-lint** : Conteneur CI/CD dédié au contrôle de qualité et linting du code.
- **ci-test** : Conteneur CI/CD dédié à l'exécution automatisée des tests de la plateforme.

---

## Justification des Choix Techniques (Exigences du TP)

### 1. Choix au Build (Dockerfiles)
- **Image de base commune** : `alpine:3.19` choisie pour des raisons de légèreté (< 10 Mo) et de sécurité. Aucune image pré-existante n'a été récupérée brute sur Docker Hub (respect de la contrainte "0 image Docker Hub").
- **`web-nginx`** : Installation explicite de `nginx` et création du dossier de runtime `/run/nginx`.
- **`frontend-vue`** : Installation de `nodejs` et `npm` pour servir l'interface VueJS.
- **`backend-symfony`** : Installation de `php82`, des extensions PHP requises par Symfony (`php82-pdo`, `php82-mbstring`, etc.) et de `php82-pcntl` pour intercepter proprement les signaux. Création d'un utilisateur non-root `symfonyuser`.
- **`ci-lint` & `ci-test`** : Outillage d'intégration continue léger (`bash`, `curl`) pour exécuter les pipelines de validation.

### 2. Forme des Entrypoints et Gestion des SIGTERM
- La syntaxe sous forme d'éléments JSON `["exécutable", "paramètre"]` est appliquée sur l'ensemble des Dockerfiles afin d'exécuter l'application sur le **PID 1**. Cela permet d'intercepter directement les signaux `SIGTERM` envoyés par `docker stop` sans passer par une sous-coquille shell.
- L'extension PHP `pcntl` dans Symfony intercepte l'évènement `SIGTERM` pour garantir une interruption propre de l'API.

### 3. Orchestration & Docker Compose
- **Ressources allouées** : Chaque conteneur possède des règles strictes `limits` et `reservations` sur la RAM et le CPU via `deploy.resources`.
- **Dépendances** : Utilisation de `depends_on` et `healthcheck` pour s'assurer que le backend est totalement opérationnel avant le déclenchement des tests CI/CD.

---

## Ordre de Démarrage
```bash
# Compiler et démarrer la stack globale
docker compose up --build

# Arrêt propre de tous les conteneurs (envoi de SIGTERM)
docker compose stop
```

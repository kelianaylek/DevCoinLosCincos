# DevCoinLosCincos

Réalisation d'un forum pour les étudiants en développement web. 
Les étudiants peuvent gérer toute la partie profil, poser et répondre à des questions.

Le projet est réalisé en symfony.

```bash
npm install 
```

```bash
composer install
```

```bash
php bin/console doctrine:database:create
```

Modifier le fichier .env.local avec les informations de la base de données

```bash
php bin/console doctrine:migrations:migrate
```

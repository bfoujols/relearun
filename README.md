<div>
    <img src="./public/assets/img/relearun-logo.svg" width="350" alt="" />
</div>

ReleaRun s'occupe de la gestion des versions applicatives. L'objectif est d'avoir une vision globale des versions deployées sur les envirronements.

## ⭐ Features

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/8e356b6e62d244c3a9e9d91269aa28a7)](https://app.codacy.com/gh/bfoujols/relearun?utm_source=github.com&utm_medium=referral&utm_content=bfoujols/relearun&utm_campaign=Badge_Grade_Settings)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/8e356b6e62d244c3a9e9d91269aa28a7)](https://app.codacy.com/gh/bfoujols/relearun?utm_source=github.com&utm_medium=referral&utm_content=bfoujols/relearun&utm_campaign=Badge_Grade_Settings)

* Push version
* Gestion des versions
* Authentification token 
* Addons chrome

## 🔧 Installation
```
# 1 - installation fichier d'envirronnement
cp _.env.exempl .env
# 2 - installation des packages
composer install
# 3 - installation de la base de donnée
# 3.1 Création des fichiers SQL (compatible sqlite/Mysql/Mariadb)
php bin/console make:migration
# 3.2 Import de la structure SQL
php bin/console doctrine:migration:migrate
```

### Author 
* Benoit Foujols
* Noa Sillam 
* Athittyan Balagowriyan

### MIT License
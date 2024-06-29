<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Facade\Merchant;

// clear the console
echo "\033[2J\033[;H";
echo "Bienvenue dans notre magasin ! Que souhaitez-vous faire ?\n";
function userInteract()
{
    $choice = null;

    while ($choice === null) {
        echo "1. Afficher tous les produits\n";
        echo "2. Consulter mon pannier\n";

        echo "- - - - - - -\n";
        echo "0. Quitter\n";
        echo "Votre choix : ";

        $choice = trim(fgets(STDIN));

        // clear the console
        echo "\033[2J\033[;H";
        switch ($choice) {
            case '1':
                Merchant::listProducts();
                userInteract();
                break;
            case '2':
                Merchant::displayCart();
                userInteract();
                break;
            case '0':
                echo "Au revoir !\n";
                exit(0);
            default:
                echo "Choix invalide. Veuillez choisir un nombre entre 1 et 4.\n";
                // relance le script 
                userInteract();
                break;
        }
    }
}


userInteract();

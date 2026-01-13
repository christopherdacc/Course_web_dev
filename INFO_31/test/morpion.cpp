#include "morpion.h"
#include <ctime>
#include <cstdlib>
#include <limits>

int main() {
    std::srand(static_cast<unsigned int>(std::time(0)));

    int choix = 0;
    bool choixValide = false;

    std::cout << "=== MENU MORPION POLYMORPHE ===\n";
    std::cout << "1. Humain vs Humain\n";
    std::cout << "2. Humain vs Robot\n";

    while (!choixValide) {
        std::cout << "Votre choix : ";
        if (!(std::cin >> choix)) {
            std::cin.clear();
            std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n');
        } else if (choix == 1 || choix == 2) {
            choixValide = true;
        }
    }

    // Le Joueur 1 est toujours un humain ici
    JoueurHumain j1("Joueur 1");

    // Préparation du pointeur pour le joueur 2
    // On utilise ici l'allocation dynamique (new) pour l'exemple,
    // ou des objets sur la pile si on gère bien la portée.
    // Pour rester simple et sûr : déclarons les objets conditionnellement.

    if (choix == 1) {
        // Cas Humain vs Humain
        JoueurHumain j2("Joueur 2");
        Partie p(&j1, &j2); // Polymorphisme : JoueurHumain* est converti en Joueur*
        p.jouer();

        // Affichage résultat
        std::cout << "\n--- FIN ---\n" << p.grille();
        if (p.gagnant() != Symbole::VIDE)
            std::cout << "Gagnant : " << (p.gagnant() == Symbole::CROIX ? j1.getNom() : j2.getNom()) << "\n";
        else
            std::cout << "Match nul.\n";

    } else {
        // Cas Humain vs Robot
        JoueurAleatoire robot("Terminator");
        Partie p(&j1, &robot); // Polymorphisme : JoueurAleatoire* est converti en Joueur*
        p.jouer();

        // Affichage résultat
        std::cout << "\n--- FIN ---\n" << p.grille();
        if (p.gagnant() != Symbole::VIDE)
            std::cout << "Gagnant : " << (p.gagnant() == Symbole::CROIX ? j1.getNom() : robot.getNom()) << "\n";
        else
            std::cout << "Match nul.\n";
    }

    return 0;
}

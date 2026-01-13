//DELAPORTE DACCACHE
#include "morpion.h"
#include <ctime>
#include <cstdlib>
#include <limits>

int main() {
    std::srand(static_cast<unsigned int>(std::time(0)));

    int choix = 0;
    bool choixValide = false;

    std::cout << "1.Humain\n";
    std::cout << "2.Aleatoire\n";

    while (!choixValide) {
        std::cout << "Votre choix : ";
        if (!(std::cin >> choix)) {
            std::cin.clear();
            std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n');
        } else if (choix == 1 || choix == 2) {
            choixValide = true;
        }
    }

    JoueurHumain j1("Joueur 1");

    if (choix == 1) {
        JoueurHumain j2("Joueur 2");
        Partie p(&j1, &j2);
        p.jouer();

        std::cout << "\n--- FIN ---\n" << p.grille();
        if (p.gagnant() != Symbole::VIDE)
            std::cout << "Gagnant : " << (p.gagnant() == Symbole::CROIX ? j1.getNom() : j2.getNom()) << "\n";
        else
            std::cout << "Match nul.\n";

    } else {
        JoueurAleatoire robot("Joueur Aleatoire");
        Partie p(&j1, &robot);
        p.jouer();

        std::cout << "\n--- FIN ---\n" << p.grille();
        if (p.gagnant() != Symbole::VIDE)
            std::cout << "Gagnant : " << (p.gagnant() == Symbole::CROIX ? j1.getNom() : robot.getNom()) << "\n";
        else
            std::cout << "Match nul.\n";
    }

    return 0;
}

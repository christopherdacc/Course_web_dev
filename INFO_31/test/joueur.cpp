#include "morpion.h"
#include <limits>
#include <cstdlib> // rand
#include <thread>  // sleep
#include <chrono>

// --- CLASSE MÈRE JOUEUR ---
Joueur::Joueur(std::string nom) : m_nom(nom) {}

std::string Joueur::getNom() const { return m_nom; }

// Pas d'implémentation pour Joueur::choisir car elle est pure (= 0)


// --- CLASSE JOUEUR HUMAIN ---

// Constructeur : appelle celui de la mère
JoueurHumain::JoueurHumain(std::string nom) : Joueur(nom) {}

Coup JoueurHumain::choisir(Grille const &g, Symbole s) {
    int choix = -1;
    bool valide = false;
    char charSymbole = (s == Symbole::CROIX ? 'X' : 'O');

    std::cout << g; // L'humain a besoin de voir la grille

    while (!valide) {
        std::cout << m_nom << " (" << charSymbole << "), votre choix (0-8) : ";

        if (!(std::cin >> choix)) {
            std::cin.clear();
            std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n');
            std::cout << "Erreur : entrez un nombre.\n";
            continue;
        }

        try {
            if (choix < 0 || choix > 8) {
                std::cout << "Erreur : entre 0 et 8.\n";
            } else if (!g.vide(choix)) {
                std::cout << "Erreur : case occupée.\n";
            } else {
                valide = true;
            }
        } catch (const std::exception& e) {
            std::cout << e.what() << "\n";
        }
    }
    return choix;
}


// --- CLASSE JOUEUR ALEATOIRE ---

// Constructeur : appelle celui de la mère
JoueurAleatoire::JoueurAleatoire(std::string nom) : Joueur(nom) {}

Coup JoueurAleatoire::choisir(Grille const &g, Symbole s) {
    std::cout << g;
    std::cout << "Le Robot (" << m_nom << ") réfléchit...\n";

    std::this_thread::sleep_for(std::chrono::milliseconds(700));

    int choix;
    do {
        choix = rand() % 9;
    } while (!g.vide(choix));

    std::cout << "Le Robot joue en " << choix << "\n";
    return choix;
}

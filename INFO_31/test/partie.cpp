#include "morpion.h"

Partie::Partie(Joueur *j1, Joueur *j2)
    : m_joueur1(j1), m_joueur2(j2), m_tour(Symbole::CROIX)
{
}

Grille Partie::grille() const {
    return m_grille;
}

Symbole Partie::gagnant() const {
    const int lignes[8][3] = {
        {0,1,2}, {3,4,5}, {6,7,8},
        {0,3,6}, {1,4,7}, {2,5,8},
        {0,4,8}, {2,4,6}
    };

    for (auto& ligne : lignes) {
        Symbole s = Symbole::VIDE;
        // Si la case est vide, on passe à la ligne suivante
        try {
            if (m_grille.vide(ligne[0])) continue;
            s = m_grille.occupant(ligne[0]);
        } catch (...) { continue; }

        // Si alignement trouvé
        try {
            if (m_grille.occupant(ligne[1]) == s &&
                m_grille.occupant(ligne[2]) == s) {
                return s;
            }
        } catch (...) { continue; }
    }
    return Symbole::VIDE;
}

bool Partie::nulle() const {
    if (gagnant() != Symbole::VIDE) return false;
    for (int i = 0; i < 9; ++i) {
        if (m_grille.vide(i)) return false;
    }
    return true;
}

bool Partie::terminee() const {
    return (gagnant() != Symbole::VIDE) || nulle();
}

// --- MODIFICATION ICI ---
void Partie::jouer() {
    while (!terminee()) {
        Joueur *joueurCourant = (m_tour == Symbole::CROIX) ? m_joueur1 : m_joueur2;

        // 1. Le joueur choisit son coup (c'est lui qui gère l'affichage intermédiaire)
        // La méthode choisir garantit un coup valide, donc pas besoin de try/catch complexe ici
        Coup c = joueurCourant->choisir(m_grille, m_tour);

        // 2. On applique le coup
        m_grille.placer(c, m_tour);

        // 3. Changement de tour si le jeu continue
        if (!terminee()) {
            m_tour = (m_tour == Symbole::CROIX) ? Symbole::ROND : Symbole::CROIX;
        }
    }
    // Plus aucun affichage de victoire ici !
}

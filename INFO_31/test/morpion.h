#ifndef MORPION_H
#define MORPION_H

#include <iostream>
#include <vector>
#include <string>
#include <stdexcept>

using Coup = int;

enum class Symbole {
    VIDE,
    CROIX,
    ROND
};

// --- Classe Grille ---
class Grille {
private:
    std::vector<Symbole> m_cases;

public:
    Grille();
    bool vide(int index) const;
    Symbole occupant(int index) const;
    void placer(int index, Symbole s);
    friend std::ostream &operator<<(std::ostream &os, Grille const &g);
};

// --- Classe Mère Abstraite ---
class Joueur {
protected:
    std::string m_nom;

public:
    Joueur(std::string nom);

    // Destructeur virtuel par défaut (indispensable pour le polymorphisme)
    virtual ~Joueur() = default;

    std::string getNom() const;

    // Méthode virtuelle pure
    virtual Coup choisir(Grille const &g, Symbole s) = 0;
};

// --- Classe Fille : JoueurHumain ---
class JoueurHumain : public Joueur {
public:
    // Constructeur (nécessaire pour initialiser le nom du parent)
    JoueurHumain(std::string nom);

    // Redéfinition de la méthode choisir
    Coup choisir(Grille const &g, Symbole s) override;
};

// --- Classe Fille : JoueurAleatoire ---
class JoueurAleatoire : public Joueur {
public:
    // Constructeur
    JoueurAleatoire(std::string nom);

    // Redéfinition de la méthode choisir
    Coup choisir(Grille const &g, Symbole s) override;
};

// --- Classe Partie ---
class Partie {
private:
    Grille m_grille;
    Joueur *m_joueur1;
    Joueur *m_joueur2;
    Symbole m_tour;

public:
    Partie(Joueur *j1, Joueur *j2);
    bool terminee() const;
    bool nulle() const;
    Symbole gagnant() const;
    void jouer();
    Grille grille() const;
};

#endif

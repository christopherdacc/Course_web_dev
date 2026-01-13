//DELAPORTE DACCACHE
#include "morpion.h"

Grille::Grille() : m_cases(9, Symbole::VIDE) {}

bool Grille::vide(int index) const {
    if (index < 0 || index > 8) {
        throw std::domain_error("Index hors de l'intervalle [0, 8]");
    }
    return m_cases[index] == Symbole::VIDE;
}

Symbole Grille::occupant(int index) const {
    if (index < 0 || index > 8) {
        throw std::domain_error("Index hors de l'intervalle [0, 8]");
    }
    if (m_cases[index] == Symbole::VIDE) {
        throw std::runtime_error("Tentative d'acces au symbole d'une case vide");
    }
    return m_cases[index];
}

void Grille::placer(int index, Symbole s) {
    if (index < 0 || index > 8) {
        throw std::domain_error("Index hors de l'intervalle [0, 8]");
    }
    if (m_cases[index] != Symbole::VIDE) {
        throw std::invalid_argument("La case n'est pas vide");
    }
    m_cases[index] = s;
}

char symboleChar(Symbole s) {
    switch(s) {
        case Symbole::CROIX: return 'X';
        case Symbole::ROND:  return 'O';
        default:             return ' ';
    }
}

std::ostream &operator<<(std::ostream &os, Grille const &g) {
    os << "\n";
    for (int i = 0; i < 9; ++i) {
        if (i % 3 == 0) os << "|";

        os << " ";
        if (g.m_cases[i] == Symbole::VIDE)
            os << i;
        else
            os << symboleChar(g.m_cases[i]);

        os << " |";

        if ((i + 1) % 3 == 0) {
            os << "\n";
            if (i < 8) os << "+---+---+---+\n";
        }
    }
    return os;
}

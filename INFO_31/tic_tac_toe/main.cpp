//Daccache Delaporte
#include <iostream>
#include <ctime>

using namespace std;


//Type énumératif kase

enum kase
{
    AUCUN,
    X,
    O
};


//Surcharge de l’opérateur << pour afficher kase

ostream& operator<<(ostream& os, const kase& k)
{
    if (k == X) os << 'X';
    else if (k == O) os << 'O';
    else os << ' ';
    return os;
}


//Classe morpion

class morpion
{
private:
    kase grille[3][3];

public:
    morpion();
    bool jouer(int ligne, int colonne, kase k);
    bool fini();
    kase gagnant();
    void afficher();
};


//Constructeur

morpion::morpion()
{
    for (int i = 0; i < 3; i++)
        for (int j = 0; j < 3; j++)
            grille[i][j] = AUCUN;
}


//Jouer un coup

bool morpion::jouer(int ligne, int colonne, kase k)
{
    if (ligne < 0 || ligne >= 3 || colonne < 0 || colonne >= 3)
        return false;

    if (grille[ligne][colonne] != AUCUN)
        return false;

    grille[ligne][colonne] = k;
    return true;
}


//Partie finie ?

bool morpion::fini()
{
    if (gagnant() != AUCUN)
        return true;

    for (int i = 0; i < 3; i++)
        for (int j = 0; j < 3; j++)
            if (grille[i][j] == AUCUN)
                return false;

    return true;
}


//Qui a gagné ?

kase morpion::gagnant()
{

    for (int i = 0; i < 3; i++)
    {
        if (grille[i][0] != AUCUN &&
                grille[i][0] == grille[i][1] &&
                grille[i][1] == grille[i][2])
            return grille[i][0];

        if (grille[0][i] != AUCUN &&
                grille[0][i] == grille[1][i] &&
                grille[1][i] == grille[2][i])
            return grille[0][i];
    }


    if (grille[0][0] != AUCUN &&
            grille[0][0] == grille[1][1] &&
            grille[1][1] == grille[2][2])
        return grille[0][0];

    if (grille[0][2] != AUCUN &&
            grille[0][2] == grille[1][1] &&
            grille[1][1] == grille[2][0])
        return grille[0][2];

    return AUCUN;
}


//Affichage du plateau

void morpion::afficher()
{
    cout << endl;
    for (int i = 0; i < 3; i++)
    {
        cout << " ";
        for (int j = 0; j < 3; j++)
        {
            cout << grille[i][j];
            if (j < 2) cout << " | ";
        }
        cout << endl;
        if (i < 2) cout << "---+---+---" << endl;
    }
    cout << endl;
}

//Programme principal

int main()
{
    morpion jeu;
    kase joueur = X;
    int choix;

    cout << "Choisissez votre type de joueur" << endl;
    cout << "1. Humain" << endl;
    cout << "2. Aleatoire" << endl;
    cin >> choix;

    srand(time(nullptr));

    while (!jeu.fini())
    {
        jeu.afficher();

        if (choix == 1)
        {
            int ligne, colonne;
            cout << "Joueur " << joueur << " (ligne colonne entre 0 et 2): ";
            cin >> ligne >> colonne;

            if (jeu.jouer(ligne, colonne, joueur))
                joueur = (joueur == X) ? O : X;
            else
                cout << "Coup invalide, recommence !" << endl;
        }
        else if (choix == 2)
        {
            if (joueur == X)
            {
                int ligne, colonne;
                cout << "Joueur " << joueur << " (ligne colonne entre 0 et 2): ";
                cin >> ligne >> colonne;

                if (jeu.jouer(ligne, colonne, joueur))
                    joueur = O;
                else
                    cout << "Coup invalide, recommence !" << endl;
            }
            else
            {
                int ligne, colonne;
                do
                {
                    ligne = rand() % 3;
                    colonne = rand() % 3;
                }
                while (!jeu.jouer(ligne, colonne, joueur));

                cout << "Le robot joue en (" << ligne << ", " << colonne << ")" << endl;
                joueur = X;
            }
        }
    }

    jeu.afficher();

    kase g = jeu.gagnant();
    if (g == AUCUN)
        cout << "Match nul !" << endl;
    else
        cout << "Le joueur " << g << " a gagne !" << endl;

    return 0;
}

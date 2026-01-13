#include <iostream>
#include <cstdlib>
#include <ctime>

using namespace std;

/* =======================
   Type énumératif
   ======================= */
enum kase
{
    AUCUN,
    X,
    O
};

/* =======================
   Affichage d'une case
   ======================= */
ostream& operator<<(ostream& os, const kase& k)
{
    if (k == X) os << 'X';
    else if (k == O) os << 'O';
    else os << ' ';
    return os;
}

/* =======================
   Classe Grille
   ======================= */
class Grille
{
private:
    kase grille[3][3];

public:
    Grille()
    {
        for (int i = 0; i < 3; i++)
            for (int j = 0; j < 3; j++)
                grille[i][j] = AUCUN;
    }

    bool estVide(int l, int c) const
    {
        return grille[l][c] == AUCUN;
    }

    kase getCase(int l, int c) const
    {
        return grille[l][c];
    }

    bool placer(int l, int c, kase k)
    {
        if (l < 0 || l >= 3 || c < 0 || c >= 3)
            return false;
        if (!estVide(l, c))
            return false;

        grille[l][c] = k;
        return true;
    }

    bool pleine() const
    {
        for (int i = 0; i < 3; i++)
            for (int j = 0; j < 3; j++)
                if (grille[i][j] == AUCUN)
                    return false;
        return true;
    }

    void afficher() const
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
};

/* =======================
   Classe abstraite Joueur
   ======================= */
class Joueur
{
protected:
    kase symbole;

public:
    Joueur(kase s) : symbole(s) {}
    virtual ~Joueur() {}

    kase getSymbole() const { return symbole; }

    virtual void choisirCoup(const Grille& g, int& ligne, int& colonne) = 0;
};

/* =======================
   Joueur Humain
   ======================= */
class JoueurHumain : public Joueur
{
public:
    JoueurHumain(kase s) : Joueur(s) {}

    void choisirCoup(const Grille&, int& ligne, int& colonne) override
    {
        cout << "Joueur " << symbole << " (ligne colonne entre 0 et 2): ";
        cin >> ligne >> colonne;
    }
};

/* =======================
   Joueur Aléatoire
   ======================= */
class JoueurAleatoire : public Joueur
{
public:
    JoueurAleatoire(kase s) : Joueur(s) {}

    void choisirCoup(const Grille& g, int& ligne, int& colonne) override
    {
        do
        {
            ligne = rand() % 3;
            colonne = rand() % 3;
        } while (!g.estVide(ligne, colonne));

        cout << "Le robot joue en (" << ligne << ", " << colonne << ")" << endl;
    }
};

/* =======================
   Classe Partie
   ======================= */
class Partie
{
private:
    Grille grille;
    Joueur* j1;
    Joueur* j2;

public:
    Partie(Joueur* a, Joueur* b) : j1(a), j2(b) {}

    kase gagnant() const
    {
        // Lignes et colonnes
        for (int i = 0; i < 3; i++)
        {
            if (grille.getCase(i,0) != AUCUN &&
                grille.getCase(i,0) == grille.getCase(i,1) &&
                grille.getCase(i,1) == grille.getCase(i,2))
                return grille.getCase(i,0);

            if (grille.getCase(0,i) != AUCUN &&
                grille.getCase(0,i) == grille.getCase(1,i) &&
                grille.getCase(1,i) == grille.getCase(2,i))
                return grille.getCase(0,i);
        }

        // Diagonales
        if (grille.getCase(0,0) != AUCUN &&
            grille.getCase(0,0) == grille.getCase(1,1) &&
            grille.getCase(1,1) == grille.getCase(2,2))
            return grille.getCase(0,0);

        if (grille.getCase(0,2) != AUCUN &&
            grille.getCase(0,2) == grille.getCase(1,1) &&
            grille.getCase(1,1) == grille.getCase(2,0))
            return grille.getCase(0,2);

        return AUCUN;
    }

    bool estFinie() const
    {
        return gagnant() != AUCUN || grille.pleine();
    }

    void jouer()
    {
        Joueur* courant = j1;

        while (!estFinie())
        {
            grille.afficher();

            int l, c;
            courant->choisirCoup(grille, l, c);

            if (grille.placer(l, c, courant->getSymbole()))
            {
                courant = (courant == j1) ? j2 : j1;
            }
            else
            {
                cout << "Coup invalide, recommence !" << endl;
            }
        }

        grille.afficher();

        kase g = gagnant();
        if (g == AUCUN)
            cout << "Match nul !" << endl;
        else
            cout << "Le joueur " << g << " a gagné !" << endl;
    }
};

/* =======================
   main
   ======================= */
int main()
{
    srand(time(nullptr));

    int choix;
    cout << "Choisissez votre type de joueur :" << endl;
    cout << "1. Humain" << endl;
    cout << "2. Aleatoire" << endl;
    cin >> choix;

    Joueur* j1 = nullptr;
    Joueur* j2 = nullptr;

    if (choix == 1)
    {
        j1 = new JoueurHumain(X);
        j2 = new JoueurHumain(O);
    }
    else if (choix == 2)
    {
        j1 = new JoueurHumain(X);
        j2 = new JoueurAleatoire(O);
    }
    else
    {
        cout << "Choix invalide" << endl;
        return 1;
    }

    Partie p(j1, j2);
    p.jouer();

    delete j1;
    delete j2;

    return 0;
}

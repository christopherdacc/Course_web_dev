//ITP: DACCACHE DELAPORTE
#include <iostream>
#include <stdexcept>
#include <limits>
#include <algorithm>

using namespace std;

class intervalle
{
public:
    /* Question 2 */
    intervalle(long a, long b) : a_(a), b_(b)
    {
        if (a > b)
        {
            throw invalid_argument("La borne inferieure de l'intervalle est superieure a la borne superieure");
        }
    }
    /* Fin de question 2 */

    /* Question 3 */
    intervalle() = delete;
    /* Fin de question 3 */


    long inf() const
    {
        /* Question 4 */
        return a_;
        /* Fin de question 4 */
    }

    /* Question 6 */
    long sup() const
    {
        return b_;
    }
    /* Fin de question 6 */

    /* Question 7 */
    long largeur()const
    {
        return b_ - a_;
    }
    /* Fin de question 7 */

    bool contient(long x) const;
    bool vide() const;

    /* Question 12: déclaration */
    void translate(long p);
    friend ostream& operator<<(ostream&, const intervalle&); //aussi pour le cas avec déclaration de la question 10
    /* Fin question 12: déclaration */
    //question 13:
    friend bool operator==(const intervalle& i1, const intervalle& i2);
    //question 14:
    friend intervalle intersection(const intervalle& i1, const intervalle& i2);
private:
    long a_, b_;
};

/* Question 8 */
bool intervalle::vide() const
{
    return a_ == b_;
}
/* Fin question 8 */

/* Question 9 */
bool intervalle::contient(long valeur_recherchee) const
{
    return valeur_recherchee > a_ && valeur_recherchee <= b_;
}
/* Fin question 9 */

/* Question 10 */
ostream& operator<<(ostream& os, const intervalle& i)
{
    if (i.vide())
    {
        os << "]]";
    }
    else
    {
        os << "]" << i.inf() << ";" << i.inf() + i.largeur() << "]";
    }
    return os;
}
//cas avec la déclaration de friend dans la classe (inclus dans la réponse de la question 12 dans la classe)
/*ostream& operator<<(ostream& os, const intervalle& i) {
    if (i.vide()) {
        os << "]]";
    } else {
        os << "]" << i.a_ << ";" << i.b_ << "]";
    }
    return os;
}*/
/* Fin de question 10 */

/* Question 12: implémentation */
void intervalle::translate(long p)
{
    a_ += p;
    b_ += p;
}
/* Fin question 12: implémentation */

/* Question 13 */
bool operator==(const intervalle& i1, const intervalle& i2)
{
    return i1.a_ == i2.a_ && i1.b_ == i2.b_;
}
/* Fin question 13 */

/* Question 14 */
intervalle intersection(const intervalle& i1, const intervalle& i2)
{
    long max_a = std::max(i1.a_, i2.a_);
    long min_b = std::min(i1.b_, i2.b_);

    if (max_a > min_b)
    {
        return intervalle(max_a, max_a);
    }
    else
    {
        return intervalle(max_a, min_b);
    }
}
/* Fin question 14 */


int main()
{
    cout << "Test question 1" << endl;
    /* Question 1 */
    long tplongmin=numeric_limits<long>::min();
    long tplongmax=numeric_limits<long>::max();
    long long tplonglongmin=numeric_limits<long long>::min();
    long long tplonglongmax=numeric_limits<long long>::max();
    unsigned long long tpunlonglongmin=numeric_limits<unsigned long long>::min();
    unsigned long long tpunlonglongmax=numeric_limits<unsigned long long>::max();
    //Pour le type long
    cout << "Type LONG" << "\n";
    cout << "Minimum : " << tplongmin << "\n";
    cout << "Maximum : " << tplongmax << "\n\n";

    //Pour le type long long
    cout << "Type LONG LONG" << "\n";
    cout << "Minimum : " << tplonglongmin << "\n";
    cout << "Maximum : " << tplonglongmax << "\n\n";

    //Pour le type unsigned long long
    cout << "Type UNSIGNED LONG LONG" << "\n";
    cout << "Minimum : " << tpunlonglongmin << "\n";
    cout << "Maximum : " << tpunlonglongmax << "\n";
    cout <<"Donc le plus grand entier de type long est de type unsigned long long et le plus petit est de type long "<<endl;
    /* Fin de Question 1 */

    cout << "\nTest question 2" << endl;
    /* Test question 2 */
    try
    {
        // Test valide
        intervalle i1(5, 10);
        cout << "Construction de i1(5, 10) reussie." << endl;

        // Test invalide
        cout << "Tentative de construction invalide (10, 5)..." << endl;
        intervalle i2(10, 5);
    }
    catch (const invalid_argument& e)
    {
        cout << "Exception attrapee : " << e.what() << endl;
    }
    /* Fin test question 2 */

    cout << "\nTest question 4" << endl;
    /* Test question 4 */
    intervalle i4(12, 20);
    cout << "Intervalle " <<i4<< endl;
    cout << "Borne inferieure : " << i4.inf() << endl;
    /* Fin test question 4 */

    cout << "\nTest question 6" << endl;
    /* Test question 6 */
    intervalle i6(17, 980);
    cout << "Intervalle " <<i6<< endl;
    cout << "Borne suppérieur : " << i6.sup() << endl;
    /* Fin test question 6 */

    cout << "\nTest question 7" << endl;
    /* Test question 7 */
    intervalle i7(25, 555);
    cout << "Intervalle " << i7 << endl;
    cout << "Largeur de l'intervalle : " << i7.largeur() << endl;
    /* Fin test question 7 */

    cout << "\nTest question 8" << endl;
    /* Test question 8 */
    intervalle i80(58, 99);
    cout << "Intervalle "<< i80 << " est vide ?" << (i80.vide() ? "\nOui l'intervalle est vide" : "\nNon l'intervalle n'est pas vide") << endl;

    intervalle i81(10, 10);
    cout << "Intervalle "<< i81 << " est vide ?"<< (i81.vide() ? "\nOui l'interalle est vide" : "\nNon l'intervalle n'est pas vide") << endl;
    /* Fin test question 8 */

    cout << "\nTest question 9" << endl;
    /* Test question 9 */
    intervalle i9(35, 65);
    long test1 = 30;
    long test2 = 38;
    long test3 = 68;
    cout <<"Intervalle " << i9 << " :"<<endl;
    cout <<"Valeur 1 = " << test1 << (i9.contient(test1) ? "\nOui 30 est dans l'intervalle" : "\nNon 30 n'est pas dans l'intervalle")<<endl;
    cout <<"Valeur 2 = " << test2 <<(i9.contient(test2) ? "\nOui 38 est dans l'intervalle" : "\nNon 38 n'est pas dans l'intervalle")<<endl;
    cout <<"Valeur 3 = " << test3 <<(i9.contient(test3) ? "\nOui 68 est dans l'intervalle" : "\nNon 68 n'est pas dans l'intervalle")<<endl;
    /* Fin test question 9 */

    cout << "\nTest question 10" << endl;
    /* Test question 10 */
    intervalle i100(2, 8);
    intervalle i101(5, 5);

    cout << "Affichage standard : " << i100 << endl;
    cout << "Affichage vide : " << i101 << endl;
    /* Fin test question 10 */

    cout << "\nTest question 12" << endl;
    /* Test question 12 */
    intervalle i12(3, 5); // ]3, 5]
    cout << "Original : " << i12 << endl;

    i12.translate(4);
    cout << "Apres translation de +4 : " << i12 << endl;

    i12.translate(-2);
    cout << "Apres translation de -2 : " << i12 << endl;
    /* Fin test question 12 */

    cout << "\nTest question 13" << endl;
    /* Test question 13 */
    intervalle i13ref(10, 20);
    intervalle i13test1(10, 20);
    intervalle i13test2(10, 21);

    intervalle i13test3(5, 5);
    intervalle i13test4(8, 8);

    cout << "Est-ce que l'intervalle " << i13ref <<" est egale a l'intervalle " << i13test1 << (i13ref == i13test1 ? "\nOUI" : "\nNON") << endl;
    cout << "Est-ce que l'intervalle " << i13ref <<" est egale a l'intervalle " << i13test2 << (i13ref == i13test2 ? "\nOUI" : "\nNON") << endl;
    cout << "Est-ce que l'intervalle ]5;5] est egale a l'intervalle ]8;8]" << (i13test3 == i13test4 ? "\nOUI" : "\nNON") << endl;
    cout << "Est-ce que l'intervalle ]5;5] est egale a l'intervalle ]5;5]" << (i13test3 == i13test3 ? "\nOUI" : "\nNON") << endl;
    /* Fin test question 13 */

    cout << "\nTest question 14" << endl;
    /* Test question 14 */
    intervalle i14test1(10, 20);
    intervalle i14test2(15, 25);
    intervalle i14test3(5, 8);
    intervalle i14test4(12, 18);

    // Si c'est complètement inclus
    cout << "Intersection A et B : " << intersection(i14test1, i14test2) << endl;
    // Si c'est vide
    cout << "Intersection A et C : " << intersection(i14test1, i14test3) << endl;
    // Si c'est partiellement inclus
    cout << "Intersection A et D : " << intersection(i14test1, i14test4) << endl;
    /* Fin test question 14 */

    cout << "\nTest question 17" << endl;
    //test question 17:
    int q17a = 109;
    int q17b = 28;
    int q17c = 0;
    for (int i=1;i<=1001;i++){
        q17c = (i+q17a)%(i+q17b);
        if (q17c == 0){
            cout <<"\nle n = "<<i<<endl;
        }
    }
}

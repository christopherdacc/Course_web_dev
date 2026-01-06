#include <iostream>
#include <string>

using namespace std;

class chiffre {
public:
    chiffre(int decalage);
    string chiffrer(string text_clair);
    string dechiffrer(string text_chiffre);

private:
    const string lettres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    int decalage;
};

// Constructeur
chiffre::chiffre(int decalage) {
    this->decalage = decalage % lettres.size();
}

// Chiffrement César
string chiffre::chiffrer(string texte_clair) {
    string resultat = texte_clair;

    for (size_t i = 0; i < texte_clair.size(); i++) {
        char c = texte_clair[i];
        size_t pos = lettres.find(c);

        if (pos != string::npos) {
            resultat[i] = lettres[(pos + decalage) % lettres.size()];
        }
    }
    return resultat;
}

// Déchiffrement César
string chiffre::dechiffrer(string texte_chiffre) {
    string resultat = texte_chiffre;

    for (size_t i = 0; i < texte_chiffre.size(); i++) {
        char c = texte_chiffre[i];
        size_t pos = lettres.find(c);

        if (pos != string::npos) {
            resultat[i] = lettres[(pos - decalage + lettres.size()) % lettres.size()];
        }
    }
    return resultat;
}

int main() {
    chiffre code(3);

    cout << "Entrer un texte: " << endl;
    string message;
    getline(cin, message);

    string cryptogramme = code.chiffrer(message);
    cout << "Texte chiffre: " << cryptogramme << endl;

    string clair = code.dechiffrer(cryptogramme);
    cout << "Texte dechiffre: " << clair << endl;

    return 0;
}

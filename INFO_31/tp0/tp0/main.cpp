#include <iostream>
using namespace std;

bool bissextile(int annee) {
    if (annee % 4 != 0) {
        return false;
    } else if (annee % 100 != 0) {
        return true;
    } else if (annee % 400 == 0) {
        return true;
    } else {
        return false;
    }
}

int main() {
    int annee;
    while (true){
    cout << "Insere une annee et verifie si elle est bissextile : ";
    cin >> annee;


        if (bissextile(annee)) {
            cout << "Cette annee est bissextile." << endl;
        } else {
            cout << "Cette annee n'est pas bissextile." << endl;
        }
    }


    return 0;
}

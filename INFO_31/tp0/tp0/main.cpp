#include <iostream>
#include <string>
#include <cctype>
#include <vector>
#include <cmath>
#include <algorithm>
using namespace std;


//Exercice 2:
//bool bissextile(int annee) {
//    if (annee % 4 != 0) {
//        return false;
//    } else if (annee % 100 != 0) {
//        return true;
//    } else if (annee % 400 == 0) {
//        return true;
//    } else {
//        return false;
//    }
//}
//
//int main() {
//    int annee;
//    while (true){
//    cout << "Insere une annee et verifie si elle est bissextile : ";
//    cin >> annee;
//
//
//        if (bissextile(annee)) {
//            cout << "Cette annee est bissextile." << endl;
//        } else {
//            cout << "Cette annee n'est pas bissextile." << endl;
//        }
//    }
//
//
//    return 0;
//}


//Exercice 2b:

//bool equilibre(string str){
//    int cpt(0);
//    for (auto c : str){
//        if (c == '(')
//                cpt++;
//        else if (c == ')'){
//            cpt--;
//            if (cpt<0)
//                return false;
//        }
//    }
//    return (cpt==0);
//}
//int main(){
//
//    string s{};
//    cout<<"Entrez un text ci-dessous"<<endl;
//    getline(cin,s);
//    cout<<"'"<<s<<"'";
//    if(equilibre(s)){
//        cout<<"est equilibrée."<<endl;
//    }
//    else
//        cout<<",'est pas equilibrée."<<endl;
//}

//Exercice 10: Javanais


//// Check if a character is a vowel
//bool isVowel(char c) {
//    c = tolower(c);
//    return (c=='a' || c=='e' || c=='i' || c=='o' || c=='u' || c=='y');
//}
//
//// Convert a word into Javanais according to the 3 rules
//string javanais(const string& txt) {
//    string result;
//    int n = txt.length();
//
//    if (n == 0) return result;
//
//    // Rule 2: If the word starts with a vowel → add "av" before the vowel
//    if (isVowel(txt[0])) {
//        result += "av";
//    }
//
//    for (int i = 0; i < n; i++) {
//
//        result += txt[i];  // always copy the character
//
//        // RULE 3: Do NOT add "av" after the final consonant(s)
//        if (i == n - 1) continue;  // skip last char
//
//        // If current char is a consonant AND next char is a vowel → add "av"
//        if (!isVowel(txt[i]) && isVowel(txt[i+1])) {
//            result += "av";
//        }
//    }
//
//    return result;
//}
//
//int main() {
//    string in;
//    cout << "Entrez un mot : ";
//    getline(cin, in);
//
//    cout << "En javanais : " << javanais(in) << endl;
//}



//exercice 17:
//vector<double> solutions(double a, double b, double c){
//    double delta, solution_1, solution_2, solution_3;
//
//    delta = b*b-4*a*c ;
//    cout<<"Delta = "<<delta;
//
//    if (delta <0 ){
//            cout<<"Pas de solution"<<endl;
//    }
//    if (delta == 0 ){
//            solution_1 = -b/2*a ;
//            cout<<"La solution est : "<<solution_1;
//    }
//    if (delta > 0 ){
//            solution_2 = (-b+sqrt(delta))/2*a ;
//            solution_3 = (-b-sqrt(delta))/2*a ;
//            cout<<"Les solutions sont : "<<solution_2<<","<<solution_3;
//    }
//}
//
//
//int main()
//{
//    double a,b,c;
//    cout<<"Entrez a, b, et c"<<endl;
//    cin >> a >> b >> c;
//    solutions(a,b,c);
//}



//Exercice 22: Sudoku


class sudoku {
private:
    std::vector<std::vector<int>> grid;

public:
    // Constructeur par défaut : grille vide
    sudoku() : grid(9, std::vector<int>(9, 0)) {}

    // ✅ 2. Constructeur avec paramètre string

sudoku(const std::string &s) : grid(9, std::vector<int>(9, 0)) {
    int idx = 0;
    for (char ch : s) {
        if (idx >= 81) break; // éviter dépassement
        if (ch == '.') {
            grid[idx / 9][idx % 9] = 0; // case vide
            idx++;
        } else if (isdigit(ch)) {
            grid[idx / 9][idx % 9] = ch - '0';
            idx++;
        } else {
            // ignorer les autres caractères (|, espaces, etc.)
        }
    }
}


    // ✅ 3. Surcharge opérateur <<
    friend std::ostream &operator<<(std::ostream &os, const sudoku &g) {
        for (int i = 0; i < 9; i++) {
            for (int j = 0; j < 9; j++) {
                os << (g.grid[i][j] == 0 ? '.' : char('0' + g.grid[i][j])) << " ";
                if ((j + 1) % 3 == 0 && j != 8) os << "| ";
            }
            os << "\n";
            if ((i + 1) % 3 == 0 && i != 8) os << "------+-------+------\n";
        }
        return os;
    }

    // ✅ 4. get par index
    int get(int idx) const {
        return grid[idx / 9][idx % 9];
    }

    // ✅ 5. get par ligne/colonne
    int get(int i, int j) const {
        return grid[i][j];
    }

    // ✅ 6. Vérifier ligne valide
    bool ligne_valide(int i) const {
        std::vector<bool> seen(10, false);
        for (int j = 0; j < 9; j++) {
            int val = grid[i][j];
            if (val != 0) {
                if (seen[val]) return false;
                seen[val] = true;
            }
        }
        return true;
    }

    // ✅ 7. Vérifier colonne valide
    bool colonne_valide(int j) const {
        std::vector<bool> seen(10, false);
        for (int i = 0; i < 9; i++) {
            int val = grid[i][j];
            if (val != 0) {
                if (seen[val]) return false;
                seen[val] = true;
            }
        }
        return true;
    }

    // ✅ Vérifier bloc valide
    bool bloc_valide(int bi, int bj) const {
        std::vector<bool> seen(10, false);
        for (int i = bi * 3; i < bi * 3 + 3; i++) {
            for (int j = bj * 3; j < bj * 3 + 3; j++) {
                int val = grid[i][j];
                if (val != 0) {
                    if (seen[val]) return false;
                    seen[val] = true;
                }
            }
        }
        return true;
    }

    // ✅ 8. Grille valide
    bool valide() const {
        for (int i = 0; i < 9; i++) {
            if (!ligne_valide(i) || !colonne_valide(i)) return false;
        }
        for (int bi = 0; bi < 3; bi++) {
            for (int bj = 0; bj < 3; bj++) {
                if (!bloc_valide(bi, bj)) return false;
            }
        }
        return true;
    }

    // ✅ 9. set par index
    bool set(int idx, int c) {
        int i = idx / 9, j = idx % 9;
        return set(i, j, c);
    }

    // ✅ 10. set par ligne/colonne
    bool set(int i, int j, int c) {
        int old = grid[i][j];
        grid[i][j] = c;
        if (valide()) return true;
        grid[i][j] = old;
        return false;
    }

    // ✅ 11. Résolution par backtracking
    bool solve() {
        for (int i = 0; i < 9; i++) {
            for (int j = 0; j < 9; j++) {
                if (grid[i][j] == 0) {
                    for (int num = 1; num <= 9; num++) {
                        if (set(i, j, num)) {
                            if (solve()) return true;
                            grid[i][j] = 0; // backtrack
                        }
                    }
                    return false; // aucun chiffre possible
                }
            }
        }
        true; // grille complète
    }
};


int main() {

 sudoku g(".6......9.........5824.329....6.3..5.9..7.18..6.1...9.3..2.1.3......2....8.1.7.4.7.4.5....8.6");

    std::cout << "Grille initiale:\n" << g << "\n";

    if (g.solve()) {
        std::cout << "Grille résolue:\n" << g << "\n";
    } else {
        std::cout << "Impossible de résoudre la grille.\n";
    }
    return 0;
}








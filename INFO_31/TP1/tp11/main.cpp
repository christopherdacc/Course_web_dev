#include <iostream>
#include <string>
#include <vector>
#include <cctype>
#include <stack>

using namespace std;
//Question 19
//vector<string> tokenizer(const string& txt) {
//    vector<string> tokens;
//    string currentWord;
//
//    for (char c : txt) {
//        if (isalpha(c)) {
//            currentWord += c;
//        }
//        else {
//            // On termine le mot en cours
//            if (!currentWord.empty()) {
//                tokens.push_back(currentWord);
//                currentWord.clear();
//            }
//
//            // Si c'est ! ou ?, on l'ajoute comme token
//            if (c == '!' || c == '?') {
//                tokens.push_back(string(1, c));
//            }
//        }
//    }
//
//    // Dernier mot s'il existe
//    if (!currentWord.empty()) {
//        tokens.push_back(currentWord);
//    }
//
//    return tokens;
//}
//
//int main() {
//    string input;
//    cout << "Enter text: " << endl;
//    getline(cin, input);
//
//    auto tokens = tokenizer(input);
//
//    for (const auto& tok : tokens)
//        cout << "'" << tok << "' ";
//
//    cout << endl;
//    return 0;
//}

//Question 20
bool equlibre(string texte){
    stack<char> pile{};
    try{
        for (auto c:texte){
        switch (c){
            case '(': pile.push(')'); break;
            case '[': pile.push(']'); break;
            case '{': pile.push('}'); break;

            case ')': case ']': case '}':
                if (pile.top() == c) pile.pop();
                else return false;

            break;
        }

    }

    } catch (exception &e){
        return false;
    }

    return pile.empty();

}


int main(){






}

#ifndef CHIFFRE_H
#define CHIFFRE_H

#include <string>

class chiffre {
public:
    chiffre(std::string clef);
    std::string chiffrer(std::string texte_clair);
    std::string dechiffrer(std::string texte_chiffre);

private:
    std::string clef;
};

#endif


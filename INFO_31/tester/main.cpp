#include <iostream>
#include <string>
class Mere
{
protected:
    std::string nom;
public:
    Mere(std::string n) : nom{ n }
    {
        std::cout << "Mere::Mere " << nom << std::endl;
    }
    virtual ~Mere()
    {
        std::cout << "Mere::~Mere " << nom << std::endl;
    }
    virtual void foo()
    {
        std::cout << "Mere::foo " << nom << std::endl;
    }
    void bar()
    {
        std::cout << "Mere::bar " << nom << std::endl;
    }
};
class Fille : public Mere
{
public:
    Fille(std::string n) : Mere(n)
    {
        std::cout << "Fille::Fille " << nom << std::endl;
    }
    ~Fille() override
    {
        std::cout << "Fille::~Fille " << nom << std::endl;
    }
    void foo() override
    {
        std::cout << "Fille::foo " << nom << std::endl;
    }
    void bar()
    {
        std::cout << "Fille::bar " << nom << std::endl;
    }
};
int main()
{
    std::cout << "Création de m" << std::endl;
    Mere m{ "m" };
    std::cout << "\nCréation de f" << std::endl;
    Fille f{ "f" };
    std::cout << "\nCréation de p" << std::endl;
    Mere *p = new Mere{"p"};
    std::cout << "\nCréation de q" << std::endl;
    Fille *q = new Fille{"q"};
    std::cout << "\nCréation de r" << std::endl;
    Mere *r = new Fille{"r"};
    std::cout << "\nCréation de z" << std::endl;
    Mere z { Fille { "z" } };
    std::cout << "\nPartie de foo!" << std::endl;
    m.foo();
    f.foo();
    p->foo();
    q->foo();
    r->foo();
    z.foo();
    std::cout << "\nPartie de bar!" << std::endl;
    m.bar();
    f.bar();
    p->bar();
    q->bar();
    r->bar();
    z.foo();
    std::cout << "\nFin de partie!" << std::endl;
    delete r;
    delete q;
    delete p;
    return 0;
}

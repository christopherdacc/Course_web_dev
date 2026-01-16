import matplotlib.pyplot as plt
#Question 1.2
import pandas.plotting
import scipy.stats
import numpy as np
import statistics as stats
import seaborn as sns

%matplotlib inline



satisfaction = pandas.read_csv("satisfaction_clients.csv",header = 0, sep = ",")


satisfaction.describe()

# Question 1.3

for x in range(5):
    print('Id_CLient: ',satisfaction.ID_Client[x],'\n')
    print('Age: ',satisfaction.Age[x],'\n')
    print('Genre: ',satisfaction.Genre[x],'\n')
    print('Note_Produit: ',satisfaction.Note_Produit[x],'\n')
    print('Note_Service: ',satisfaction.Note_Service[x],'\n')
    print('Expérience_achat: ',satisfaction.Expérience_Achat[x],'\n')
    print('Recommande: ',satisfaction.Recommande[x],'\n')
    print('------------------------------------------------\n')

#Question 1.4

for id_c in range(1000):
    if satisfaction.ID_Client[id_c] == '':
        print('Le client ',satisfaction.ID_Client[id_c], 'n''a pas d''ID\n')
for age in range(1000):
    if satisfaction.Age[age] == '':
        print('Le client ',satisfaction.ID_Client[age], 'n''a pas d''age\n')
for genre in range(1000):
    if satisfaction.Genre[genre] == '':
        print('Le client ',satisfaction.ID_Client[genre], 'n''a pas de genre\n')
for note in range(1000):
    if satisfaction.Note_Produit[note] == '':
        print('Le client ',satisfaction.ID_Client[note], 'n''a pas de note de produit\n')
for serv in range(1000):
    if satisfaction.Note_Service[serv] == '':
        print('Le client ',satisfaction.ID_Client[serv], 'n''a pas de note de service\n')
for exp in range(1000):
    if satisfaction.Expérience_Achat[exp] == '':
        print('Le client ',satisfaction.ID_Client[exp], 'n''a pas d''expérience d''achat\n')
for rec in range(1000):
    if satisfaction.Recommande[rec] == '':
        print('Le client ',satisfaction.ID_Client[rec], 'n''a pas recommander\n')
        
#Question 2.1 Moyenne, Médianne, Variance, Ecart-type, Quartiles
#Moyenne
print("Moyenne de Note de produit: ", np.mean(satisfaction.Note_Produit).round(2))
print("Moyenne de Note de service: ", np.mean(satisfaction.Note_Service).round(2))
print("Moyenne de l'expériance d'achat: ", np.mean(satisfaction.Expérience_Achat).round(2))
#Médiane
print('------------------------------------------------')
print("Médiane de Note de produit: ", np.median(satisfaction.Note_Produit).round(2))
print("Médiane de Note de service: ", np.median(satisfaction.Note_Service).round(2))
print("Médiane de l'expériance d'achat: ", np.median(satisfaction.Expérience_Achat).round(2))
#Variance
print('------------------------------------------------')
print("Variance de Note de produit: ", stats.variance(satisfaction.Note_Produit))
print("Variance de Note de service: ", stats.variance(satisfaction.Note_Service))
print("Variance de l'expériance d'achat: ", stats.variance(satisfaction.Expérience_Achat))
#Ecart-type
print('------------------------------------------------')
print("Ecart-type de Note de produit: ", np.std(satisfaction.Note_Produit))
print("Ecart-type de Note de service: ", np.std(satisfaction.Note_Service))
print("Ecart-type de l'expériance d'achat: ", np.std(satisfaction.Expérience_Achat))
#Quartiles
print('------------------------------------------------')
print("Quartiles de Note de produit: ", stats.quantiles(satisfaction.Note_Produit))
print("Quartiles de Note de service: ", stats.quantiles(satisfaction.Note_Service))
print("Quartiles de l'expériance d'achat: ", stats.quantiles(satisfaction.Expérience_Achat))

#Question 2.2
#Histogramme pour chaque variable
#Note produit
histo_note_prod = satisfaction.Note_Produit.plot(kind = "hist", color = "red")
satisfaction.Note_Produit.plot()
plt.figure()
#Note service
histo_note_serv = satisfaction.Note_Service.plot(kind = "hist", color = "green")
satisfaction.Note_Service.plot()
plt.figure()
#Expérience achat
histo_exp_achat = satisfaction.Expérience_Achat.plot(kind = "hist", color = "blue")
satisfaction.Expérience_Achat.plot()
plt.figure()

#Boite a moustache
#Note produit par genre
satisfaction.boxplot(column="Note_Produit",by="Genre")
plt.show()
#Note service par genre
satisfaction.boxplot(column="Note_Service",by="Genre")
plt.show()
#Expérience achat par genre
satisfaction.boxplot(column="Expérience_Achat",by="Genre")
plt.show()

#Question 3.1
#calcule de corrélation
new_table = pandas.read_csv("satisfaction_clients.csv",header = 0, sep = ",")
new_table.describe()
new_table = new_table.drop('Genre', axis=1)
print('------------------------------------------------')
cor_ser = new_table.corr().Note_Service
print(cor_ser)
print('------------------------------------------------')
cor_prod = new_table.corr().Note_Produit
print(cor_prod)
print('------------------------------------------------')
cor_ach = new_table.corr().Expérience_Achat
print(cor_ach)
print('------------------------------------------------')

#question 3.2
#Nuage de point Entre Note_Produit et Expérience_Achat
npoint1 = plt.scatter(new_table.Note_Produit, new_table.Expérience_Achat)
plt.show()
#Nuage de point Entre Note_Service et Expérience_Achat
npoint2 = plt.scatter(new_table.Note_Service, new_table.Expérience_Achat)
plt.show()

#question 5.1
def  calculer_statistiques(table, check):#nom de la fonction avec les arguments
    if check != 1:  #si argument different de 1 on affiche pas les histogrammes
        print("Moyenne: ", np.mean(table).round(2))
        print("Médiane: ", np.median(table).round(2))
        print("Variance: ", stats.variance(table))
        print("Ecart-type: ", np.std(table))
        print('------------------------------------------------')
    else:   #sinon on affiche les histogrammes
        print("Moyenne: ", np.mean(table).round(2))
        print("Médiane: ", np.median(table).round(2))
        print("Variance: ", stats.variance(table))
        print("Ecart-type: ", np.std(table))
        print('------------------------------------------------')
        histo_note_prod = table.plot(kind = "hist", color = "red")
        table.plot()
        plt.figure()
    
        
    

#exemple
table_test= [10,15,58,96,0,1,2,3,4]
calculer_statistiques(table_test,0)

#question 5.2 et 5.3 et 5.4
calculer_statistiques(satisfaction.Note_Produit, 1)
calculer_statistiques(satisfaction.Note_Service,0)
calculer_statistiques(satisfaction.Expérience_Achat,0)


















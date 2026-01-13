# -*- coding: utf-8 -*-
"""
Created on Tue Dec  2 16:52:00 2025

@author: dacc0001
"""
import numpy as np
#Exercice 8

"""
Ecrivez une programme qui demande à l’utilisateur d’entrer des notes d’élèves. Si l’utilisateur
entre une valeur négative, le programme s’arrête. En revanche, pour chaque note saisie, le programme construit
progressivement une liste. Après chaque entrée d’une nouvelle note (et donc à chaque itération de la boucle), 
il affiche le nombre de notes entrées, la note la plus élevée, la note la plus basse, la moyenne de toutes les notes.
Astuce : Pour créer une liste vide, il suffit de taper la commande list = [].
"""


notes_input=[]
moyenne = 0
for i in range(20):
    print("\nSaisisser les notes des élèves: ")
    notes = input()
    notes2 = float(notes)
    notes_input.append(notes2)
    if notes2 < 0:
        print("\nLa note doit etre suppérieur a  0\n")
    else:
        for k in range(i+1):
            print("\nLa note ",k," est: ",notes_input[k])
        print ("\nLe nombre total de notes saisie est: ",i+1)
        print("\nLa note la plus élevé est: ",max(notes_input))
        print("\nLa note la plus basse est: ",min(notes_input))
        print("\nLa moyenne des notes est: ",  np.mean(notes_input))
        
        
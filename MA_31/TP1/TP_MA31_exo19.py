# -*- coding: utf-8 -*-
"""
Created on Tue Dec  2 17:38:53 2025

@author: dacc0001
"""
#Exercice 19:
"""
 Ecrire une focntion qui calcule la somme des entiers passés en paramètres.
"""

def addition(*nombres):
    print("La sommes des nombres donné en argument est: ", sum(nombres))
    
    
addition(10,20,30,51,45)

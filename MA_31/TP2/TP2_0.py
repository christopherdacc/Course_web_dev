import matplotlib.pyplot as plt
import pandas
import scipy.stats
import numpy as np



diamonds = pandas.read_csv("diamonds.csv",header = 0, sep = ",")


diamonds.describe()

x1 = diamonds.price
y1= diamonds.depth
y2= diamonds.table
y3= diamonds.x
y4= diamonds.y
y5= diamonds.z


plt.plot(x1,y1,'r')
plt.grid()
plt.show()
plt.plot(x1,y2,'g')
plt.grid()
plt.show()
plt.plot(x1,y3,'b')
plt.grid()
plt.show()
plt.plot(x1,y4,'k')
plt.grid()
plt.show()
plt.plot(x1,y5,'m')
plt.grid()
plt.show()


pandas.plotting.scatter_matrix(diamonds)



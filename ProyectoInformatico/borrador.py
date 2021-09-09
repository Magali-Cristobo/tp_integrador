from tkinter import *
from tkinter.ttk import *
from pymongo import MongoClient
from PIL import Image
from ttkthemes import *


ventana=Tk()
s = Style()
s.configure('TButton', bg='red')
boton = Label(ventana, style='BW.TLabel', text="hola")
boton.place(x=0,y=0)

# label6 = Label(ventana, background="black", anchor="e", width=20, text="hola",foreground="yellow")
# label6.place(x=15, y=10)
ventana.geometry("440x440")
button = Button(ventana, text = 'Submit', style="TButton")
button.place(x=100,y=100)
ventana.mainloop()

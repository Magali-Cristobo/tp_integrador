from tkinter import *
from tkinter.ttk import *
import pymongo
from pymongo import MongoClient


conexion = MongoClient('localhost',27017)
nombreBase=conexion.proyectoIntegrador
producto=nombreBase.producto

def verificarProducto(id):
    query = {'id': id}
    doc = producto.find_one(query)
    if(doc==None):
        return False
    return True

def  armarDiccionario(id):
    query = {'id': id}
    doc = producto.find_one(query)
    diccionario= {"nombre": doc["nombre"], "marca": doc["marca"], "categoria": doc["categoria"],
                  "imagen": doc["imagen"]}
    return diccionario


ventana = Tk()
ventana.title("Mi despensa")
ventana.geometry("440x440")
ventana.configure(bg="#FEEEB3") # Poner fondo torcido
ventana.resizable(0, 0)
style = Style()
style.theme_use('default')
linea = Separator(ventana)
linea.place(x=7, y=393, relwidth=0.9)
inputCodigoDeBarra = Entry(ventana)
labelCodigoDeBarra = Label(ventana, background="#FEEEB3", state="normal", text="Codigo de barra:")
labelCodigoDeBarra.place(x=5,y=30)
inputCodigoDeBarra.place(x=50, y=50)
def escanearProducto():
    if inputCodigoDeBarra.get()!="" and len(inputCodigoDeBarra.get())==13:
        codigoObtenido=int(inputCodigoDeBarra.get())
        inputCodigoDeBarra.place_forget()
        labelCodigoDeBarra.place_forget()
        if (verificarProducto(codigoObtenido)):
            datosProducto=armarDiccionario(codigoObtenido)
            # logo = PhotoImage(file="productoTraido["imagen"]")
            # labelImagen = Label(ventana, background="gray85", image=logo, state="normal").place(x=26,y=10)  # puede ser x=27 tambien si le sacamos el borde
        # else
            # logo = PhotoImage(file="Imagen no existe producto.png")
            # labelImagen = Label(ventana, background="gray85", image=logo, state="normal").place(x=26,y=10)  # puede ser x=27 tambien si le sacamos el borde

            nombreProducto = Label(ventana, background="#FEEEB3", text="Nombre: "+datosProducto["nombre"])
            nombreProducto.place(x=5, y=75)
            marcaProducto = Label(ventana, background="#FEEEB3", text="Marca: "+datosProducto["marca"])
            marcaProducto.place(x=5, y=93)

            categoriaProducto = Label(ventana, background="#FEEEB3", text="Categoria: "+datosProducto['categoria'])
            categoriaProducto.place(x=5, y=110)

            # parte Agregar cantidad Producto
            cantidadProducto = Label(ventana, background="#FEEEB3", text="Cantidad")
            cantidadProducto.place(x=5, y=130)
            cantidad = Spinbox(ventana, from_=1, to=10, command="clicked")
            cantidad.place(x=13, y=150)
        else:
            labelNombre = Label(ventana, background="#FEEEB3", state="normal", text="Nombre:" ).place(x=5,y=20)
            inputNombre = Entry(ventana)
            inputNombre.place(x=70, y=20)
            labelMarca = Label(ventana, background="#FEEEB3", state="normal", text="Marca:").place(x=5,y=50)
            inputMarca = Entry(ventana)
            inputMarca.place(x=70, y=50)
            labelCategoria = Label(ventana, background="#FEEEB3", state="normal", text="Categoria:").place(x=5,y=80)
            inputCategoria=Combobox(ventana)
            inputCategoria["values"]=["Lacteos","Harinas y leudantes","Galletitas y cereales", "Bebidas gasificadas","Quesos untables","Infusiones"]
            inputCategoria.place(x=70, y=80)
    else:
        ventana.after(100,escanearProducto)

botonAgregarProducto = Button(ventana, command=ventana.destroy, text="Agregar Producto", width="19")
botonAgregarProducto.place(x=15, y=400)


ventana.after(100,escanearProducto)
ventana.mainloop()

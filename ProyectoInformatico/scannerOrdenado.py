from tkinter import *
import tkinter as tk
from tkinter.ttk import *
from pymongo import MongoClient
from PIL import Image
from ttkthemes import *



class scanner:
    def __init__(self):
        self.conexion = MongoClient('localhost', 27017)
        self.nombreBase = self.conexion.proyectoIntegrador
        self.producto = self.nombreBase.producto
        self.usuario = self.nombreBase.usuario
        self.idUsuario=None
        self.agregar=1
        self.ultimoCodigoIngresado=0

        self.ventana = tk.Tk()
        self.ventana.eval('tk::PlaceWindow . center')
        self.style = Style()
        self.estiloLabel = Style()
        self.estiloLabel.configure('BW.TLabel', background='#FEEEB3', font=("RIGHT",11), foreground="#F2AF5C")
        self.estiloBoton=Style()
        self.estiloBoton.configure('TButton', font=('RIGHT', 10),foreground='#FEEEB3', background="#F2AF5C")
        self.inputCodigoDeBarra = Entry(self.ventana)
        self.labelCodigoDeBarra = Label(self.ventana,style="BW.TLabel", state="normal", text="Código de barra")
        self.botonAgregarProducto = tk.Button(self.ventana, font=('RIGHT', 10),foreground='#FEEEB3', background="#F2AF5C", command=self.ingresarProducto, text="Agregar Producto",width="19")
        self.botonVolver = tk.Button(self.ventana, font=('RIGHT', 10),foreground='#FEEEB3', background="#F2AF5C",command=self.volverAInicio, text="Volver a inicio", width="19")
        self.nombreProducto = Label(self.ventana)
        self.marcaProducto = Label(self.ventana)
        self.categoriaProducto = Label(self.ventana)
        self.cantidadProducto = Label(self.ventana)
        self.cantidad = Spinbox(self.ventana)
        self.labelNombre = Label(self.ventana)
        self.labelMarca = Label(self.ventana)
        self.labelCategoria = Label(self.ventana)
        self.inputNombre = Entry(self.ventana)
        self.inputMarca = Entry(self.ventana)
        self.inputCategoria = Combobox(self.ventana)
        self.labelMail=Label(self.ventana, style='BW.TLabel')
        self.labelClave=Label(self.ventana, style='BW.TLabel')
        self.mail = Entry(self.ventana,width=40)
        self.clave = Entry(self.ventana, show="*",width=40)
        self.logo=PhotoImage()
        self.labelImagen=Label()
        self.botonIniciarSesion = tk.Button(self.ventana,font=('RIGHT', 10),foreground='#FEEEB3', background="#F2AF5C", text="Iniciar sesion",command=self.iniciarSesion)
        self.mensajeAutenticacion=Label(self.ventana, style="BW.TLabel")
        self.botonEliminar=tk.Button(self.ventana,font=('RIGHT', 10),foreground='#FEEEB3', background="#F2AF5C")
        self.botonAgregar=tk.Button(self.ventana,font=('RIGHT', 10),foreground='#FEEEB3', background="#F2AF5C")
        self.ventana.title("Mi despensa")
        self.ventana.geometry("440x440")
        self.ventana.configure(bg="#FEEEB3")  # Poner fondo torcido
        self.ventana.resizable(0, 0)
        self.armarInicioSesion()

    def vaciarVentana(self):
        for widget in self.ventana.winfo_children():
            widget.place_forget()

    def existeElProducto(self):
        query = {'idUsuario': self.idUsuario}
        doc = self.usuario.find_one(query,{"despensa": {"$elemMatch": {"producto": {"$eq": self.ultimoCodigoIngresado}}}})
        try:
            despensa = doc["despensa"]
            return despensa
        except:
            return False

    def elegirOpcion(self):
        self.agregar=None
        self.vaciarVentana()
        self.botonEliminar.configure(text="Eliminar producto", command=self.elegirEliminar)
        self.botonEliminar.place(x=85,y=195)
        self.botonAgregar.configure(text="Agregar producto", command=self.elegirAgregar)
        self.botonAgregar.place(x=235,y=195)

    def ingresarProducto(self):
        productoObtenido = self.existeElProducto()
        cantidadNueva=0
        cantidad=0
        if self.agregar==1:
            if productoObtenido!=False:
                for cantidad1 in productoObtenido:
                    cantidad=cantidad1["cantidad"]

                cantidadNueva=cantidad+int(self.cantidad.get())
                self.usuario.update_one({"despensa.producto": self.ultimoCodigoIngresado, "idUsuario": self.idUsuario},{"$set": {"despensa.$.cantidad": cantidadNueva}})
            else:
                self.usuario.update_one({"idUsuario":self.idUsuario},{"$push": {"despensa": {"producto": int(self.inputCodigoDeBarra.get()), "cantidad": int(self.cantidad.get())}}})
            self.elegirOpcion()
        else:
            if productoObtenido != False:
                for cantidad1 in productoObtenido:
                    cantidad = cantidad1["cantidad"]

                print("cantidad ",cantidad)
                cantidadNueva = cantidad - int(self.cantidad.get())
                print("cantidad nueva",cantidadNueva)
                if cantidadNueva<=0:
                    self.usuario.update_one({"despensa.producto": self.ultimoCodigoIngresado, "idUsuario": self.idUsuario},{"$pull": {"despensa": {"producto": self.ultimoCodigoIngresado}}})
                else:
                    self.usuario.update_one({"despensa.producto": self.ultimoCodigoIngresado, "idUsuario": self.idUsuario},{"$set": {"despensa.$.cantidad": cantidadNueva}})
                self.elegirOpcion()
            else:
                print("No existe el producto")

    def armarInicioSesion(self):
        self.labelMail.configure(text="Ingrese el mail")
        self.labelMail.place(x=170,y=140)
        self.mail.place(x=100,y=160)
        self.labelClave.configure(text="Ingrese la clave")
        self.labelClave.place(x=170, y=190)
        self.clave.place(x=100,y=210)
        self.botonIniciarSesion.place(x=180,y=260)

    def iniciarSesion(self):
        mail = self.mail.get()
        clave = self.clave.get()
        query = {'mail': mail, "clave":clave}
        doc = self.usuario.find_one(query)
        if (doc!=None):
            self.idUsuario=doc["idUsuario"]
            if(self.idUsuario!=None):
                self.elegirOpcion()
        else:
            self.mensajeAutenticacion.configure(text="Mail y/o clave incorrectos")  # agregar el color rojo
            self.mensajeAutenticacion.place(x=100,y=235)

    def armarPaginaEscaneo(self, estaElProducto):
        self.ventana.after(100, self.escanearProducto)
        self.vaciarVentana()
        if(self.agregar==0):
            self.botonAgregarProducto.configure(text="Eliminar producto")
        else:
            self.botonAgregarProducto.configure(text="Agregar producto")
        if not estaElProducto:
            self.mensajeAutenticacion.configure(text="El producto no existe")
            self.mensajeAutenticacion.place(x=150, y=230)

        self.inputCodigoDeBarra.delete(0, "end")
        self.botonVolver.place(x=20,y=400)
        self.botonVolver.configure(command=self.elegirOpcion)
        self.labelCodigoDeBarra.place(x=156,y=177)
        self.inputCodigoDeBarra.place(x=150, y=200)
        self.botonAgregarProducto.place(x=278, y=400)
        self.botonAgregarProducto.configure(command=self.escanearProducto)

    def elegirEliminar(self):
        self.agregar=0
        self.armarPaginaEscaneo(True)

    def elegirAgregar(self):
        self.agregar=1
        self.armarPaginaEscaneo(True)

    def volverAInicio(self):
        self.vaciarVentana()
        self.inputCodigoDeBarra.delete(0,"end")
        self.ventana.after(100, self.escanearProducto)
        self.armarPaginaEscaneo(True)

    def armarVentanaProductoExistente(self):
        datosProducto = self.armarDiccionario()
        ruta=datosProducto["imagen"]
        try:
            self.logo = PhotoImage(file=ruta)
        except:
            ruta="productoInexistente.png"
            self.logo = PhotoImage(file=ruta)
        self.logo = Image.open(ruta)
        self.logo = self.logo.resize((160, 300), Image.ANTIALIAS)
        self.logo.save(ruta, quality=95)
        self.logo = PhotoImage(file=ruta)

        self.labelImagen = Label(self.ventana, background="gray85", image=self.logo, state="normal")
        self.labelImagen.place(x=250,y=50)  # puede ser x=27 tambien si le sacamos el borde

        self.nombreProducto = Label(self.ventana, style="BW.TLabel", text="Nombre: " + datosProducto["nombre"])
        self.nombreProducto.place(x=50, y=140)
        self.marcaProducto = Label(self.ventana, style="BW.TLabel", text="Marca: " + datosProducto["marca"])
        self.marcaProducto.place(x=50, y=180)

        self.categoriaProducto = Label(self.ventana, style="BW.TLabel",text="Categoria: " + datosProducto['categoria'])
        self.categoriaProducto.place(x=50, y=220)

        # parte Agregar cantidad Producto
        self.cantidadProducto = Label(self.ventana, style="BW.TLabel", text="Cantidad:")
        self.cantidadProducto.place(x=50, y=260)
        self.cantidad = Spinbox(self.ventana, from_=1, to=10, command="clicked", width=5)
        self.cantidad.place(x=130, y=260)
        self.botonVolver.place(x=20,y=400)
        self.botonVolver.configure(command=self.volverAInicio)
        self.botonAgregarProducto.place(x=278, y=400)
        self.botonAgregarProducto.configure(command=self.ingresarProducto)

    def armarDiccionario(self):
        id = str(self.inputCodigoDeBarra.get())
        query = {'id': id}
        doc = self.producto.find_one(query)
        diccionario = {"nombre": doc["nombre"], "marca": doc["marca"], "categoria": doc["categoria"],
                       "imagen": doc["imagen"]}
        return diccionario

    def verificarProducto(self, id):
        query = {'id': str(id)}
        doc = self.producto.find_one(query)
        if doc == None:
            return False
        return True

    def escanearProducto(self):
        if self.inputCodigoDeBarra.get() != "" and len(self.inputCodigoDeBarra.get()) == 13:
            self.vaciarVentana()
            self.botonAgregarProducto.configure(command=self.ingresarProducto)
            self.ultimoCodigoIngresado=int(self.inputCodigoDeBarra.get())
            if self.verificarProducto(self.ultimoCodigoIngresado):
                self.armarVentanaProductoExistente()
            else:
                self.armarPaginaEscaneo(False)
        else:
            self.ventana.after(100, self.escanearProducto)


if __name__ == '__main__':
    x = scanner()
    x.ventana.after(100, x.escanearProducto)
    x.ventana.mainloop()

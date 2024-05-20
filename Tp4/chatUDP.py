import socket
import threading
def enviar(usuario):

    global exit
    ip = "192.168.0.14"
    buffer_salida = usuario + ":" + input(f"{usuario}: ")
    socketUDP = socket.socket(socket.AF_INET , socket.SOCK_DGRAM) #IPv4 y compatible con UDP

    if (buffer_salida.find("exit") == -1):
        socketUDP.sendto(buffer_salida.encode() , (ip , 60000))
        socketUDP.sendto(buffer_salida.encode() , (ip , 60001))
        exit = False
    else:
        socketUDP.sendto(buffer_salida.encode() , (ip , 60000))
        socketUDP.sendto(buffer_salida.encode() , (ip , 60001))
        exit = True


def recibir(puerto):
    global exit
    ip = "192.168.0.14"
    socketUDP = socket.socket(socket.AF_INET , socket.SOCK_DGRAM)
    socketUDP.bind((ip,puerto))
    datos , direccion = socketUDP.recvfrom(200) #Recibo el mensaje con tamaño de 200 caracteres
    usuario , mensaje = usuario_mensaje(datos.decode())

    if mensaje != "exit":
        print(f"{usuario} ({direccion[0]}) dice: {mensaje}")
        exit = False
    else:
        print(f"El usuario {usuario} ({direccion[0]}) ha abandonado la conversación")
        exit = True

def usuario_mensaje(datos):
    
    index = datos.find(":") #Hasta donde llega el nombre de usuario
    usuario = datos[:index]
    mensaje = datos[index+1:]
    return usuario,mensaje



usuario = input("Ingrese un nombre de usuario: ")
global exit 
exit = False

while exit == False:
    hilo1 = threading.Thread(name="enviar", target=enviar, args=(usuario,))
    hilo2 = threading.Thread(name="recibir", target=recibir, args=(60000,))
    hilo3 = threading.Thread(name="recibir", target=recibir, args=(60001,))

    hilo1.start()
    hilo2.start()
    hilo3.start()
    hilo1.join()
    hilo2.join()
    hilo3.join()

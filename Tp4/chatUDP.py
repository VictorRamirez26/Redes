import socket
import threading

# Configuración de red y buffer
PORT = 60000
BUFFER_SIZE = 1024
BROADCAST_IP = '192.168.0.255' # Broadcast

usuario = input("Ingrese un nombre de usuario: ")

# Variable global para controlar cuando un usuario se desconecta
exit_flag = threading.Event()

def enviar():
    global exit_flag
    while not exit_flag.is_set():

        mensaje = input(f"{usuario}: \n")
        
        mensaje_completo = f"{usuario}: {mensaje}"
        
        # Crear un socket UDP
        with socket.socket(socket.AF_INET, socket.SOCK_DGRAM) as sock:
            # Habilitar la opción de broadcast en el socket
            sock.setsockopt(socket.SOL_SOCKET, socket.SO_BROADCAST, 1)
            
            # Enviar el mensaje a la dirección de broadcast y al puerto especificado
            sock.sendto(mensaje_completo.encode(), (BROADCAST_IP, PORT))
            
            # Si el mensaje es "exit", activar la bandera de salida
            if mensaje.strip().lower() == "exit":
                exit_flag.set()

def recibir():
    global exit_flag

    # Crear un socket UDP
    with socket.socket(socket.AF_INET, socket.SOCK_DGRAM) as sock:
        # Permitir la reutilización de la dirección y puerto
        sock.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1) 
        
        # Vincular el socket a todas las interfaces de red en el puerto especificado
        sock.bind(('192.168.0.255', PORT))
        
        while not exit_flag.is_set():
            try:
                # Recibir datos del socket
                datos, direccion = sock.recvfrom(BUFFER_SIZE)
                
                mensaje_completo = datos.decode()
                
                usuario_recibido, mensaje = usuario_mensaje(mensaje_completo)
                
                if mensaje.strip().lower() == "nuevo":
                    print(f"El usuario {usuario_recibido} ({direccion[0]}) se ha unido a la conversación")
                elif mensaje.strip().lower() == "exit":
                    print(f"El usuario {usuario_recibido} ({direccion[0]}) ha abandonado la conversación")
                else:
                    print(f"{usuario_recibido} ({direccion[0]}) dice: {mensaje}")
            except:
                pass

def usuario_mensaje(datos):
    index = datos.find(":")
    usuario = datos[:index]
    mensaje = datos[index + 1:]
    return usuario, mensaje


hilo_envio = threading.Thread(target=enviar)
hilo_recepcion = threading.Thread(target=recibir)
hilo_envio.start()
hilo_recepcion.start()


hilo_envio.join()
hilo_recepcion.join()

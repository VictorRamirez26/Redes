import socket   
import threading


host = '192.168.0.15'
port = 60000

socket_server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

socket_server.bind((host, port))
socket_server.listen()
print(f"Server running on {host}:{port}")


clientes_conectados = []
lista_nombres = []

def broadcast(message):
    for cliente in clientes_conectados:
        cliente.send(message)

def desconectar_usuarios():
    clientes_conectados.clear()
    lista_nombres.clear()

def handle_messages(cliente):

    index = clientes_conectados.index(cliente)
    username = lista_nombres[index]

    while True:
        try:
            message = cliente.recv(1024)

            if message.decode() == f"{username}: exit":
                broadcast(message)
                desconectar_usuarios()
                break

            broadcast(message)
        except:
            broadcast(f"Error: {username} disconnected".encode())
            clientes_conectados.remove(cliente)
            lista_nombres.remove(username)
            cliente.close()
            break



def receive_connections():
    while True:
        socket_cliente, direccion = socket_server.accept()

        socket_cliente.send("@username".encode())
        nombre_usuario = socket_cliente.recv(1024).decode()

        clientes_conectados.append(socket_cliente)
        lista_nombres.append(nombre_usuario)

        print(f"{nombre_usuario} is connected with ({direccion[0]})")

        message = f"El usuario {nombre_usuario} ({direccion[0]}) se ha unido a la conversación".encode()
        broadcast(message) 

        thread = threading.Thread(target=handle_messages, args=(socket_cliente,))
        thread.start() #Arreglar la forma de cerrar este bucle

receive_connections()
import socket   
import threading

host = '10.0.0.105'
port = 60002

socket_server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

socket_server.bind((host, port))
socket_server.listen()
print(f"Server running on {host}:{port}")

clientes_conectados = []
lista_nombres = []

def broadcast(message, exclude_client=None):
    for cliente in clientes_conectados:
        if cliente != exclude_client:
            try:
                cliente.send(message)
            except Exception as e:
                print(f"Error al enviar mensaje a un cliente: {e}")

def desconectar_usuarios():
    for cliente in clientes_conectados:
        try:
            broadcast("el servidor esta cerrando")
            cliente.close()
        except Exception as e:
            print(f"Error al cerrar la conexión de un cliente: {e}")
    clientes_conectados.clear()
    lista_nombres.clear()

def handle_messages(cliente):
    index = clientes_conectados.index(cliente)
    username = lista_nombres[index]

    while True:
        try:
            message = cliente.recv(1024)
            decoded_message = message.decode()
            if decoded_message == f"{username}: exit":
                broadcast(f"{username} has left the chat.".encode(), exclude_client=cliente)
                desconectar_usuarios()
                break
            broadcast(message, exclude_client=cliente)
        except Exception as e:
            print(f"Error con {username}: {e}")
            if cliente in clientes_conectados:
                clientes_conectados.remove(cliente)
                lista_nombres.remove(username)
            cliente.close()
            break

def receive_connections():
    print("Esperando conexiones...")
    while True:
        try:
            socket_cliente, direccion = socket_server.accept()
            print(f"Conexión aceptada de {direccion}")

            socket_cliente.send("@username".encode())
            nombre_usuario = socket_cliente.recv(1024).decode()

            clientes_conectados.append(socket_cliente)
            lista_nombres.append(nombre_usuario)

            print(f"{nombre_usuario} está conectado desde ({direccion[0]})")

            message = f"El usuario {nombre_usuario} ({direccion[0]}) se ha unido a la conversación".encode()
            broadcast(message, exclude_client=socket_cliente)

            thread = threading.Thread(target=handle_messages, args=(socket_cliente,))
            thread.start()
        except Exception as e:
            print(f"Error al aceptar conexiones: {e}")

receive_connections()

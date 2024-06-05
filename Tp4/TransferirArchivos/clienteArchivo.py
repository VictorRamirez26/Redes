import socket

def receive_file(filename, conn):
    with open(filename, 'wb') as f:
        while True:
            bytes_read = conn.recv(1024*1024) # 1MB
            if not bytes_read:
                break
            f.write(bytes_read)

def main():
    host = '192.168.0.15'  # Aca tiene que ir la ip del servidor
    port = 60000 

    client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client_socket.connect((host, port))
    print(f"Conectado a {host}:{port}")

    filename = input("Ingrese el nombre para guardar el archivo recibido: ")
    receive_file(filename, client_socket)

    client_socket.close()
    print("Archivo recibido y conexión cerrada")

if __name__ == "__main__":
    main()


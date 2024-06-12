import socket
import os

def send_file(filename, conn):
    if os.path.exists(filename):
        with open(filename, 'rb') as f:
            while True:
                bytes_read = f.read(1024*1024) # 1MB
                if not bytes_read:
                    break
                conn.sendall(bytes_read)
    else:
        print("El archivo no existe")

def main():
    host = '25.41.37.118'
    port = 60000

    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server_socket.bind((host, port))
    server_socket.listen(1)
    print(f"Servidor escuchando en {host}:{port}")

    while True:
        conn, addr = server_socket.accept()
        print(f"Conexión aceptada de {addr}")

        filename = input("Ingrese el nombre del archivo a transferir: ")
        send_file(filename, conn)

        conn.close()
        print("Conexión cerrada")

if __name__ == "__main__":
    main()


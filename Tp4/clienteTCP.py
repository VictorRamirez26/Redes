import socket   
import threading
username = input("Enter your username: ")
host = '10.0.0.105'
port = 60002
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client.connect((host, port))
# Crear un evento para notificar a los hilos que deben terminar
exit_event = threading.Event()
def receive_messages():
    while not exit_event.is_set():
        try:
            message = client.recv(1024).decode()
            if message == "@username":
                client.send(username.encode())
            elif message.find("exit") != -1:
                print("Ocurrió un error")
                exit_event.set()
                client.close()
                break
            else:
                print(message)
        except:
            print("Ocurrió un error")
            exit_event.set()
            client.close()
            break
def write_messages():
    while not exit_event.is_set():
        message = f"{username}: {input('')}"
        client.send(message.encode())
        if "exit" in message:
            exit_event.set()
            client.close()
            break
receive_thread = threading.Thread(target=receive_messages)
receive_thread.start()
write_thread = threading.Thread(target=write_messages)
write_thread.start()
# Esperar a que ambos hilos terminen
receive_thread.join()
write_thread.join()
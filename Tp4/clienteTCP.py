import socket   
import threading

username = input("Enter your username: ")

host = '192.168.0.15'
port = 60000

client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client.connect((host, port))


def receive_messages():
    while True:
        try:
            message = client.recv(1024).decode()

            if message == "@username":
                client.send(username.encode())
            elif message.find("exit") != -1:
                client.close()
                break
            else:
                print(message)
        except:
            print("Ocurrio un error")
            client.close
            break

def write_messages():
    while True:
        message = f"{username}: {input('')}"
        client.send(message.encode())

receive_thread = threading.Thread(target=receive_messages)
receive_thread.start()

write_thread = threading.Thread(target=write_messages)
write_thread.start()
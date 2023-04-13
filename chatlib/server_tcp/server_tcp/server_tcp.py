import socket
import time
import random
s_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s_socket.bind(("0.0.0.0", 8820))
s_socket.listen()
print("server is up and running")
(client_socket, client_address) = s_socket.accept()
print("Client connected")
data= ""
while True:
    data = client_socket.recv(1024).decode()
    print("Client sent: " + data)
    if data == "Quit":
        print("closing client socket now...")
        client_socket.send("Quit".encode())
        break
    if data == "NAME":
        client_socket.send("serveroni".encode())
    if data == "TIME":
        client_socket.send(str(time.ctime()).encode())
    if data == "RAND":
        client_socket.send(str(random.randint(1,10)).encode())

client_socket.close()
s_socket.close()
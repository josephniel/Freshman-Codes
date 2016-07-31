#! /usr/bin/env python
'''
UDP Ping Server where randomized lost packets are generated
'''

from socket import *
import random


port = 12000
serverSocket = socket(AF_INET, SOCK_DGRAM)
serverSocket.bind(('', port))

while True:
    # Generate random number in the range 0 to 10
    rand = random.randint(0, 10)
        
    # Receive the client packet along with the address it is coming from
    message, address = serverSocket.recvfrom(1024)
    # Capitalize the message from the client
    message = str(message).encode("utf-8").upper()
        
    # If rand is less than 4, we consider the packet lost and do not respond
    if rand < 4:
        continue
    # Otherwise, the server responds
    serverSocket.sendto(bytes(message).encode("utf-8"), address)

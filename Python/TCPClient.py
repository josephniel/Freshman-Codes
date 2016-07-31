#!/usr/bin/env python2

'''
Illustrating a TCP client
'''

from socket import *
import sys

serverName = '172.16.128.42'
serverPort = 12354

clientSocket = socket(AF_INET, SOCK_STREAM)
clientSocket.connect((serverName, serverPort))

sentence = raw_input("Input file URL:  ")
clientSocket.send(bytes(sentence).encode("utf-8"))
modifiedSentence = clientSocket.recv(1024)
print "From server:", modifiedSentence
clientSocket.close()


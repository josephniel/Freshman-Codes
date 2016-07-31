#!/usr/bin/env python2

'''
Illustrating a TCP server
'''

from socket import *
import sys

serverPort = 12364

serverSocket = socket(AF_INET, SOCK_STREAM)
serverSocket.bind(('', serverPort))
serverSocket.listen(1)

print("The server is ready to receive\n")

while True:
	connectionSocket, addr = serverSocket.accept()
	try:
		page = connectionSocket.recv(1024)
		page = page.split(' ')[1]
		f = open(page[1:])
		outputHTML = f.read()
		print ("Status: 200 OK\n")
		connectionSocket.send("\nHTTP/1.1 200 OK\n\n")
		connectionSocket.send(outputHTML)
		connectionSocket.close()		
	except IOError:
		filee = open('404.html')
		output = filee.read()
		print ("Status: 404 FILE NOT FOUND\n")
		connectionSocket.send("\nHTTP/1.1 404 Not Found\n\n")
		connectionSocket.send(output)
		connectionSocket.close()


#! /usr/bin/env python
'''
UDP Ping Client
'''

from socket import *
from datetime import datetime

serverName = "127.0.0.1"
serverPort = 12000

clientSocket = socket(AF_INET, SOCK_DGRAM)

sequenceNumber = 10
currentPingNumber = 1

print "\n"

while currentPingNumber <= sequenceNumber:
	print "Ping", currentPingNumber, "is in progress"

	sent = datetime.now()
	message = str("PING " + str(sequenceNumber) + " " + str(sent))

	clientSocket.sendto(bytes(message).encode("utf-8"),(serverName, serverPort))
	clientSocket.settimeout(1)

	try:
		modifiedMessage, serverAddress = clientSocket.recvfrom(1024)
		
		print "SERVER RESPONSE: " + modifiedMessage.encode("utf-8")
		
		received = datetime.now()
		RTT = received - sent

		print "RTT: " + str(RTT)
	except timeout:
		print "Request timed out"

	currentPingNumber += 1	

clientSocket.close()

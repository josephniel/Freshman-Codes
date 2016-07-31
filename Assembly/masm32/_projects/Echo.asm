.model small
.stack 100h
.data
.code

    main    proc
   
	mov ax, @data
    mov ds, ax
	
		mov ah, 01h ; gets the value of a character on the keyboard and stores it to the AL register
		int 21h 
	
		mov bl, al ; temporarily stores the input character into BL
	
		mov dl, 0AH ; moves 0AH (new line character) to DL for printing
		mov ah, 02h ; prints the character on the DL register 
		int 21h
	
		mov dl, bl ; moves the character from the BL register to DL for printing
		mov ah, 02h ; prints the character on the DL register 
		int 21h
	
	mov ax, 4c00h
    int 21h

    main    endp
    end main
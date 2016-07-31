.model small
.stack
.data
.code

	main proc

	mov ax, @data
	mov ds, ax
	
		mov ax, 0A000h 		; The offset to video memory
		mov es, ax 			; We load it to ES through AX, because immediate operation is not allowed on ES
		mov ax, 13h 		; 320 x 200 (TEXT: 40 x 25)
		int 10h

		mov ax, 20
		
		mov di, ax
		
		mov dl, 00001111b
		mov es:[di], dl

	mov ax, 4c00h
    int 21h
	
	main endp
	end main
	
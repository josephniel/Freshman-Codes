.model small 
.data
	rand db 0
.stack 100h
.code

	main    proc
	
	mov ax, @data
	mov ds, ax
	
		xor dx, dx
	
		mov ah, 00h
		int 1Ah
		
		xor ax, ax
		
		mov ax, dx
		mov bl, 10
		div bl
		
		add ah, 48
		mov rand, ah
		
		xor dx, dx
		xor ax, ax
		
		mov dl, rand
		mov ah, 02h
		int 21h
		
	mov ax, 4c00h
    int 21h
	
	main    endp
    end main
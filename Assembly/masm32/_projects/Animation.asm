.model small 
.stack 100h
.data
	delaytime db 18
	
	row db 12,11,13,12,12,10,14,12,12,11,13,11,13,12,12,9,15,10,10,14,14,9,9,15,15,8,16,12,12,7,17,12,12,8,8,16,16
	column db 40,40,40,38,42,40,40,36,44,37,37,43,43,34,46,40,40,35,45,35,45,33,47,33,47,40,40,32,48,40,40,30,50,31,49,31,49
	color db 0Fh,0Eh,0Eh,0Eh,0Eh,0Fh,0Fh,0Fh,0Fh,0Fh,0Fh,0Fh,0Fh,0Eh,0Eh,0Eh,0Eh,0Eh,0Eh,0Eh,0Eh,0Fh,0Fh,0Fh,0Fh,0Fh,0Fh,0Fh,0Fh,0Eh,0Eh,0Eh,0Eh,0Eh,0Eh,0Eh,0Eh
	character db 4
	
	first db 1,5,13,21,29,37,37,37
	second db 0,0,0,1,5,13,21,29
	
	index dw 0
	cap db 0
	
	mainindex dw 0
	
.code

	reset proc
		xor ax,ax
		xor bx,bx
		xor cx,cx
		xor dx,dx
		xor si,si
		xor di,di
		ret
	reset endp

	delay proc
		mov ah, 00
		int 1Ah
		mov bx, dx

		jmp_delay:
			int 1Ah
			sub dx, bx
			cmp dl, delaytime
		jl jmp_delay
		ret
	delay endp

	refresh proc
		mov ax, 0600h
		mov bh, 07h
		xor cx, cx
		mov dx, 184fh
		int 10h
		ret
	refresh endp
	
	printer proc
		
		createLoop:
			mov si, bx
			
			mov dh, row[bx] 
			mov dl, column[bx]
			xor bh, bh
			mov ah, 02h
			int 10h
			
			mov bx, si
			
			mov al, character
			mov dl, color[bx]
			mov bl, dl
			xor bh, bh
			mov cx, 1
			mov ah, 09h
			int 10h
			
			mov bx, si
			mov cl, cap
			
			inc bx
			cmp bl, cl
		jne createLoop
	
		ret
	printer endp
	
	main    proc
	
	mov ax, @data
	mov ds, ax
	
		mov cx, 3200h
		mov ah, 01h
		int 10h
	
		mov si, 10
		timer:
			call refresh
		
			mov dh, 12
			mov dl, 40
			xor bh, bh
			mov ah, 02h
			int 10h
	
			mov bx, si
			add bx, 47
			
			mov al, bl
			mov dl, 0Fh
			mov bl, dl
			xor bh, bh
			mov cx, 1
			mov ah, 09h
			int 10h
			
			call delay
		
			dec si
			cmp si, 1
		jne timer
		
		mov delaytime, 5
		
		mov bx, 0
		mainiterate:
			mov mainindex, bx
			mov bx, 0
			iterate:

				mov index, bx
					call refresh
					call reset
				mov bx, index
				mov cl, first[bx]
				mov cap, cl
				mov cl, second[bx]
				mov bx, cx
					call printer
					call reset
					call delay
				
				mov bx, index
				
				inc bx
				cmp bx, 8
			jne iterate
		
			call refresh
			
			mov bx, mainindex
			inc bx
			cmp bx, 5
		jne mainiterate
	
	mov ax, 4c00h
    int 21h
	
	main    endp
    end main
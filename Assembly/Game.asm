title Game

.model small
.data 
	row db 12
	column db 39
	bulletrow db 12
	bulletcolumn db 39
	rowStorage db 12
	columnStorage db 39
	colorhead db 07h
	movement db 0
	input db 0
	previnput db 0
	character db 1
	delaytime db 3
	
.stack 100h
.code
	cls proc
		;clear screen
		mov ax, 0600h
		mov bh, 07h
		xor cx,cx
		mov dx, 184fh
		int 10h
	ret
	cls endp
	
	spn proc ;set position of cursor 
		mov dh, row
		mov dl, column
		xor bh, bh
		mov ah, 02h
		int 10h
	ret 
	spn endp
			
	ph proc 
		;prints character at cursor position
		;ah=0ah prints character on cursor position
		;al=character; bh=page#; cx= number of times to print character
		mov al, character
		xor bh,bh
		mov bl, colorhead
		mov cx, 1
		mov ah, 09h
		int 10h
	ret
	ph endp
	
	bullet proc
		
		;this block saves original coordinates of hero
		mov dh, row
		mov dl, column
		mov rowStorage, dh
		mov columnStorage, dl
		mov bulletrow, dh
		mov bulletcolumn, dl
		
		bulletloop:
			
			call cls
			
			;saves bullet coordinates
			mov dh, row
			mov dl, column
			mov bulletrow, dh
			mov bulletcolumn, dl
			
			;block prints hero
			mov character, 1
			mov dh, rowStorage
			mov dl, columnStorage
			mov row, dh
			mov column, dl
			call spn
			call ph
			
			;block puts bullet coordinates back.
			mov dh, bulletrow
			mov dl, bulletcolumn
			mov row, dh
			mov column, dl
			
			;block prints bullet
			mov colorhead, 07h
			mov character, 'o'
			call spn
			call ph
			mov delaytime, 1
			call delay
			dec row
			cmp row, 0
			
		jg bulletloop
		
		;block prints hero
		mov character, 1
		mov dh, rowStorage
		mov dl, columnStorage
		mov row, dh
		mov column, dl
		call spn
		call ph	
		
	ret
	bullet endp
	
	delay proc
	;sets a delay according to delaytime.
		mov ah, 00h
		int 1ah
		mov bx, dx

		jmp_delay:
		int 1Ah
		sub dx, bx
		cmp dl, delaytime
		jl jmp_delay
		ret

	delay endp
	
	main proc ;int main
	
		mov ax, @data ;initialization
		mov ds, ax		
		
		mov al, 03h
		mov ah, 00h
		int 10h
		
		;start - this block of code prints the hero at the center
		call cls
		call spn
		mov cx, 3200h ;vanishes cursor
		mov ah, 01h
		int 10h
		call ph	
		;end
		
		il:
			
			mov ah, 01h
			int 16h
			jnz gotKey
			jmp noKey
		
			gotKey:
				
				mov ah,00h
				int 16h
				mov bl, input
				mov previnput, bl
				mov input, al
				
				cmp al, 0
				jne nasaAL
					mov input, ah
				nasaAL:
					
				cmp input, 'w'
				jne notUp
					mov character, 1
					mov movement, 'u'
					dec row
					cmp row, -1
					jne dgbw
						mov row, 24
					dgbw:
				notUp:
					
				cmp input, 'a'
				jne notLeft
					mov character, 1
					mov movement, 'l'
					dec column
					cmp column, -1
					jne dgba
						mov column, 79
					dgba:
				notLeft:
				
				cmp input, 's'
				jne notDown
					mov character, 1
					mov movement, 'd'
					inc row
					cmp row, 25
					jne dgbs
						mov row, 0
					dgbs:
				notDown:
				
				cmp input, 'd'
				jne notRight
					mov character, 1
					mov movement, 'r'
					inc column
					cmp column, 80
					jne dgbd
						mov column, 0
					dgbd:
				notRight:
				
				cmp input, 72
				jne notBulletUp
					call bullet
				notBulletUp:
				
				call cls
				call spn
				call ph
					
			noKey:
					
		cmp input, 27
		jne il
		
		gameOver:
		
		mov ax, 4c00h ;return 0
		int 21h
		
	main endp ;closing curly brace of main
	end main
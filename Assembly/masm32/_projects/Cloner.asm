.model small 
.stack 100h
.data
	handle 			dw 	?  
	filename		db 	100	dup(?)
	cloneFilename	db 	"C_", 100 dup(?) 
	buffer 			db 	1000 dup('$')
	
	characterStatistics	db 37 dup(0)
	
	offsetCharacters	db 100 dup('$')
	offsetCharacterSize db 0
	isMiddle			db 0
	
	filenameLength 	dw 	0
	bufferSize		dw	0
	
	tempIndex			dw	0
	
	otherString		db "Others", '$'
	whiteSpaces		db "     ", '$'
	headerString	db "Character Statistics:",'$'
	noteString		db "Note: Uppercase and lowercase count have been combined to one character",'$'
	inputString		db "Input filename here: ",'$'
	errorString		db "An error occured. Please check your input and your file.",'$'
	
	number			db	4 dup(0)
	rawNumber 		db	0
	rowNumber		db 	0
	columnNumber	db 	0
.code

	reset proc
		xor ax,ax
		xor bx,bx
		xor cx,cx
		xor dx,dx
		ret
	reset endp

	refreshPage proc
		mov ax, 0600h
		mov bh, 07h
		xor cx, cx
		mov dx, 184fh
		int 10h
		ret
	refreshPage endp
	
	inputFilename proc
		
		mov bx, 0
		filenameLoop:
			
			mov ah, 00h        	
			int 16h 
			
			cmp al, 13
			jne doNotReturn
				mov filename[bx], 0
				mov cloneFilename[bx+2], 0
				ret
			doNotReturn:
			
			cmp al, 8
			jne isNotBackspaced
				cmp filenameLength, 0
				je filenameLoop
					dec bx
					dec filenameLength
					
					mov ah, 03h
					int 10h
					
					dec dl
					
					mov rowNumber, dh
					mov columnNumber, dl
					call cursorMover
					
					mov dl, ' '
					mov ah, 02h 
					int 21h
					
					mov ah, 03h
					int 10h
					
					dec dl
					
					mov rowNumber, dh
					mov columnNumber, dl
					call cursorMover
				
				jmp filenameLoop
			isNotBackspaced:
			
			mov filename[bx], al
			mov cloneFilename[bx+2], al
			
			inc filenameLength
			
			mov dl, al
			mov ah, 02h
			int 21h
			
			inc bx
		jmp filenameLoop
	inputFilename endp

	createFile proc
		mov dx, offset cloneFilename   	; put offset of filename in dx
		xor cx, cx                		; clear cx - make ordinary file
		mov ah, 3ch               		; function 3ch - create a file
		int 21h                  		; call dos service
		ret
	createFile endp
	
	readFile proc
		mov dx, offset buffer     ; address of buffer in dx
		mov bx, handle            ; handle in bx
		mov cx, 1000              ; amount of bytes to be read
		mov ah, 3fh               ; function 3fh - read from file
		int 21h    
		ret
	readFile endp
	
	writeFile proc
		mov dx, offset buffer     ; address of information to write
		mov bx, handle            ; file handle for file
		mov cx, bufferSize        ; 38 bytes to be written
		mov ah, 40h               ; function 40h - write to file
		int 21h      
		ret
	writeFile endp
	
	openFile proc
		mov dx, offset cloneFilename   	; put address of filename in dx
		mov al, 2                 		; access mode - read and write
		mov ah, 3dh               		; function 3DH - open a file
		int 21h      
		ret
	openFile endp
	
	closeFile proc
		mov bx, handle            ; put file handle in bx
		mov ah, 3eh               ; function 3eh - close a file
		int 21h                   ; call dos service
		ret
	closeFile endp
	
	numberPrinter proc
				
		call reset
				
		mov al, rawNumber
		mov bx, 4
		mov cl, 10
				
			createNumber:
				dec bx
					
				mov ah, 0
				div cl
					
				add ah, 48
				mov number[bx], ah
					
				cmp bx, 0
			jne createNumber
				
			call cursorMover
				
			displayNumber:
				
				mov dl, number[bx]
				
				cmp bx, 3
				jne skipThis
					mov ah, 02h 
					int 21h
					jmp skipThisToo
				skipThis:
				cmp dl, 48
				je skipThisToo
					mov ah, 02h 
					int 21h
				skipThisToo:
				
				inc bx
				cmp bx, 4
			jne displayNumber
		ret 
	numberPrinter endp
	
		cursorMover proc
			mov dh, rowNumber
			mov dl, columnNumber
			xor bh, bh
			mov ah, 02h
			int 10h
			ret
		cursorMover endp
	
	main    proc
	
	mov ax, @data
	mov ds, ax
	
		mov ax, 0300h
		int 10h
			
		call refreshPage
		call cursorMover
	
		lea dx, offset inputString
		mov ah, 09h
		int 21h
			
		call inputFilename
		mov dx, offset filename   		; put address of filename in dx
		mov al, 2                 		; access mode - read and write
		mov ah, 3dh               		; function 3DH - open a file
		int 21h                	
		
		mov handle, ax            	; save file handle for later
		jc erroropening          	; jump if carry flag set - error!
			
			call readFile
			call reset
			call closeFile
			call reset
			
			mov bx, 0
			bufferSizeCheck:
				mov bufferSize, bx
				inc bx
				cmp buffer[bx-1], '$'
			jne bufferSizeCheck
			
			call createFile
			call reset
			call openFile
			call reset
			call writeFile
			call reset
			
			mov bx, 0
			characterStatisticsCheck:
				mov tempIndex, bx
				
				mov cl, buffer[bx]
				cmp cl, 48
				jl otherCharacters
					cmp cl, 57
					jg notANumber
						sub cl, 22 ; 26 - 35
						mov bx, cx
						inc characterStatistics[bx]
						jmp moveOn
				notANumber:
				cmp cl, 65
				jl otherCharacters
					cmp cl, 90
					jg possibleUppercase
						sub cl, 65 ; 65 - 90
						mov bx, cx
						inc characterStatistics[bx]
						jmp moveOn
				possibleUppercase:
				cmp cl, 97
				jl otherCharacters
					cmp cl, 122
					jg otherCharacters
						sub cl, 97 ; 97 - 122
						mov bx, cx
						inc characterStatistics[bx]
						jmp moveOn	
				otherCharacters:
					inc characterStatistics[36]
				moveOn:
					mov bx, tempIndex
					
				inc bx
				cmp bx, bufferSize
			jne characterStatisticsCheck
			
			call reset
			
			call refreshPage
			
			mov rowNumber, 0
			mov columnNumber, 0
			call cursorMover
			
			lea dx, offset headerString
			mov ah, 09h
			int 21h
			
			mov bx, 0
			printStatictics:
				mov tempIndex, bx
			
				mov cl, characterStatistics[bx]
				mov rawNumber, cl
				
				mov ax, bx
				mov cl, 2
				
				div cl
				
				add al, 2
				mov rowNumber, al
				
				cmp ah, 0
				je firstColumn
					mov columnNumber, 50
					jmp printNumber
				firstColumn:
					mov columnNumber, 10
				printNumber:
					call numberPrinter
			
				mov bx, tempIndex
			
				inc bx
				cmp bx, 37
			jne printStatictics
		
			mov bx, 0
			printLabels:
				
				mov tempIndex, bx
				
				mov ax, bx
				mov cl, 2
					
				div cl
					
				add al, 2
				mov rowNumber, al
				
				cmp ah, 0
				je firstColumnLabel
					mov columnNumber, 40
					jmp printLabel
				firstColumnLabel:
					mov columnNumber, 0
				printLabel:
				
					call cursorMover
					
				mov bx, tempIndex
				
				cmp bx, 25
				jg notAnAlphabet
				
					lea dx, offset whiteSpaces
					mov ah, 09h
					int 21h
				
					mov dx, bx
					add dl, 65
					mov ah, 02h
					int 21h
					
					jmp finishPrintLabel
				notAnAlphabet:
					
				cmp bx, 35
				jg anotherCharacter
					
					lea dx, offset whiteSpaces
					mov ah, 09h
					int 21h
					
					mov dx, bx
					add dl, 22
					mov ah, 02h
					int 21h
					
					jmp finishPrintLabel
					
				anotherCharacter:
					
					lea dx, offset otherString
					mov ah, 09h
					int 21h
					
				finishPrintLabel:
				
				inc bx
				cmp bx, 37
			jne printLabels
		
			mov bx, 0
			printEqualSign:
				
				mov tempIndex, bx
				
				mov ax, bx
				mov cl, 2
					
				div cl
					
				add al, 2
				mov rowNumber, al
				
				cmp ah, 0
				je firstColumnEquals
					mov columnNumber, 47
					jmp printEquals
				firstColumnEquals:
					mov columnNumber, 7
				printEquals:
				
					call cursorMover
				
					mov dl, '='
					mov ah, 02h
					int 21h
				
				inc bx
				cmp bx, 37
			jne printEqualSign
	
			mov rowNumber, 22
			mov columnNumber, 0
			call cursorMover
	
			lea dx, offset noteString
			mov ah, 09h
			int 21h
			
			mov rowNumber, 23
			mov columnNumber, 0
			call cursorMover
			
			lea dx, offset whiteSpaces
			mov ah, 09h
			int 21h
	
		jmp noError
	
		erroropening:	
	
			mov rowNumber, 2
			mov columnNumber, 0
			call cursorMover
		
			lea dx, offset errorString
			mov ah, 09h
			int 21h
		
		noError:
	
	mov ax, 4c00h
    int 21h
	
	main    endp
    end main
/*
8 Queens program
    // Coded by Joseph Niel Tuazon and Krizia Faith Ilaga
    // Algorithm gotten and based from http://techmyway.wordpress.com/
    // Created on March 13, 2013
    // Added other features like the specific queen's position locator
*/

#include<iostream>
#include<iomanip>

using namespace std;

#define coordinatex 9
#define coordinatey 9

char board[coordinatex][coordinatey];

void defaulter(){

    int x, y;

    for(x=1;x<9;++x){
        for(y=1;y<9;++y){
            board[x][y] = '_';
        }
    }
}

bool checker(int x, int y){

    int i, j;

//checks column
for(i=1; i<9; i++){
    if(board[x][i]=='Q')
    return false;
    }
//checks row
for(i=1; i<9; i++){
    if (board[i][y]=='Q')
    return false;}
//checks upper left diagonal
for(i = x, j = y; i >= 1 && j >= 1; i--, j--){
    if(board[i][j]=='Q')
    return false;
}
//checks lower left diagonal
for(i = x, j = y; i < 9 && j >= 1; i++, j--){
    if(board[i][j]=='Q')
    return false;
}
//checks upper right diagonal
for(i = x, j = y; i >= 1 && j < 9; i--, j++){
    if(board[i][j]=='Q')
    return false;
}
//checks the lower right diagonal
for(i = x, j = y; i < 9 && j < 9; i++, j++){
    if(board[i][j]=='Q')
    return false;
}

//Else, return true
return true;
}

void solver(int x, int y, int z){

    // IF ALL THE QUEENS WERE PLACED
    if(x == 9){

        int a, b, c;

        if(board[y][z]=='Q'){
            c++;
            cout << "Solution Number " << c << ":\n\n" << setw(2);

            for(a=1; a<9; a++){
                for(b=1; b<9; b++){
                    cout << board[a][b] << setw(2);
                    }
                cout<<endl;
                }
            cout<<"\n"<<endl;

        }
    }

    //QUEENS PLACED ON ALL POSSIBLE POSITIONS UNTIL ALL POSSIBLE COMBINATIONS WERE FOUND
    for(int i=1; i<9; i++){

        if(checker(x,i)==true){
            board[x][i] = 'Q';
            int c = 0; // THIS IS FOR THE VALUE OF C TO NOT RETURN TO 0 BECAUSE OF ITERATION.
            solver(x+1,y,z);
        }
        board[x][i] = '_';
    }

}

int main(){

    int a,b;

    cout << "This program shows possible queen positions given one position of a queen on an 8x8 chessboard.\n\n"
         << "Enter one position of any queen:\n\n"
         << "Enter row number (1-8): ";
    cin >> a;
    cout << "Enter column number (1-8): ";
    cin >> b;
    cout << endl;
    defaulter();
    solver(1,a,b);

return 0;
}

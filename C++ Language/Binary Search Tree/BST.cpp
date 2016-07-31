/*
//BINARY SEARCH TREE CREATED BY JOSEPH NIEL TUAZON
//CREATED ON MARCH 30, 2013
//P.S.: Sorry ma'am if this work is (a little) very late.
//      It was because the time I made this was my only free time.
//      I hope you understand. Thank you :)
*/
#include<iostream>
#include <cstdlib>

using namespace std;

struct node{
    node* left;
    node* right;
    node* parent;
    int key;
};

node *root;

void insertnum(int num){

    //NEWLY CREATED NODE IS NOT YET INCLUDED ON THE TREE
    node *newnode = new node;
    newnode->key = num;
    newnode->left = NULL;
    newnode->right = NULL;
    newnode->parent = NULL;

    if(root==NULL)
        root = newnode;
    else{
        node *x = root;
        node *y = NULL;

        while(x!=NULL){
            y = x;
            if(newnode->key > x->key)
                x = x->right;
            else
                x = x->left;
         }

         newnode->parent = y;

         if(newnode->key > y->key)
            y->right = newnode;
         else
            y->left = newnode;
    }
}

void searchtodelete(int num){

    node *x = root;
    int locator=0;

    if(x==NULL)
        cout << "\n\nThere is no node to delete. Please Insert nodes first to make a tree. \n";
    else{
        while(x!=NULL){
            if(num == x->key){
                locator = 1;
                //START OF DELETE CODE*********************************************************

                node *y, *z;
                y = x->parent;

                //IF NODE HAS NO CHILDREN
                if(x->left == NULL && x->right == NULL){
                    if(y==NULL){
                        root = NULL;
                    }
                    else if(x == y->left){
                        y->left = NULL;
                    }
                    else{
                        y->right = NULL;
                    }
                    x = NULL;
                    cout << "\nNode with no child deleted!";
                    return;
                }
                //IF NODE HAS 2 CHILDREN
                else if(x->left != NULL && x->right != NULL){
                    z = x->right;

                        if(z->left==NULL){
                            x->key = z->key;
                            x->right = NULL;
                        }
                        else{
                            while(z->left!=NULL){
                                y = z;
                                z = z->left;
                                z = NULL;
                            }
                            x->key = z->key;
                            x->left = NULL;
                        }

                    cout << "\nNode with two child deleted!";
                    return;
                }
                //IF NODE HAS 1 CHILD
                else{
                    if(x->left !=NULL && x->right == NULL){
                        z = x->left;
                        if(y==NULL){
                            root->left = z->left;
                            root->right = z->right;
                            root->key = z->key;
                            x = NULL;
                        }
                        else if(x == y->right){
                            x->left = y->right;
                        }
                        else{
                            x->left = y->left;
                        }
                    cout << "\nNode with one child deleted!";
                    return;
                    }
                    if(x->right !=NULL && x->left == NULL){
                        z = x->right;
                        if(y==NULL){
                            root->left = z->left;
                            root->right = z->right;
                            root->key = z->key;
                            x = NULL;
                        }
                        else if(x == y->right){
                            x->right = y->right;
                        }
                        else{
                            x->right = y->left;
                        }
                    cout << "\nNode with one child deleted!";
                    return;
                    }

                }
            }
            else if(num > x->key) x=x->right;
            else x=x->left;
        }
        if(locator<=0)
            cout << "\n\nNode entered not found on the tree.\n";
    }
}

void inorder(node *a){

    if(a!=NULL){
        inorder(a->left);
        cout << a->key << "  ";
        inorder(a->right);
    }
}

void preorder(node *a){

    if(a!=NULL){
        cout << a->key << "  ";
        if(a->left!=NULL)
            preorder(a->left);
        if(a->right!=NULL)
            preorder(a->right);
    }
}

void postorder(node *a){

    if(a!=NULL){
        if(a->left!=NULL)
            postorder(a->left);
        if(a->right!=NULL)
            postorder(a->right);
        cout << a->key << "  ";
    }
}

void menu(){

    cout << "\n\nMENU\n\n"
         << "[1] Insert\n"
         << "[2] Delete\n"
         << "[3] Inorder Tree Walk\n"
         << "[4] Preorder Tree Walk\n"
         << "[5] Post-order Tree Walk\n"
         << "[6] Exit\n\n"
         << "Your choice: ";

}

int main(){

    int choice, input;
    root = NULL;

    do{

        menu();
        cin >> choice;

        switch(choice){

        case 1: cout << "Input number to insert on the tree: ";
                cin >> input;
                insertnum(input);
                break;
        case 2: cout << "Input number to delete on the tree: ";
                cin >> input;
                searchtodelete(input);
                break;
        case 3: inorder(root);break;
        case 4: preorder(root);break;
        case 5: postorder(root);break;
        case 6: break;
        default: cout << "Input not on the list. Please enter again.\n\n"; break;
        }

    }
    while(choice!=6);

return 0;
}

Program 3:
Design, Develop and Implement a menu driven Program in C for the following operations on STACK of Integers (Array Implementation of Stack with maximum size MAX) 
A)	Push an Element on to Stack
B)	Pop an Element from Stack
C)	Demonstrate how Stack can be used to check Palindrome
D)	Demonstrate Overflow and Underflow situations on Stack
E)	Display the status of Stack
F)	Exit.
Support the program with appropriate functions for each of the above operations.

Source Code:
#include<stdio.h>
#define MAX 4
int stack[MAX], top = -1;

void push(){
    	int item;
    	if (top == MAX - 1) {
        		printf("\nStack Overflow");
    	} else {
        		printf("\nEnter element: ");
        		scanf("%d", &item);
        		stack[++top] = item;
    	}
}

void pop(){
    	if (top == -1) {
        		printf("\nStack Underflow");
    	} else {
        		printf("\nPopped: %d", stack[top--]);
    	}
}

void palindrome(){
    	int i, flag = 1;
    	for (i = 0; i <= top / 2; i++) {
        		if (stack[i] != stack[top - i]) {
            		flag = 0;
            		break;
        		}
}
printf(flag ? "\nStack is Palindrome" : "\nStack is not Palindrome");
}

void display(){
    	if (top == -1){
        		printf("\nStack is Empty");
    	} else {
        		for (int i = top; i >= 0; i--){
            			printf("\n| %d |", stack[i]);
       		}
    	}
}

int main(){
    	int ch;
    	do {
        		printf("\n\n1. Push\n2. Pop\n3. Check Palindrome\n4. Exit\nChoice: ");
        		scanf("%d", &ch);
        		switch (ch) {
        			case 1:
            			push();
            			display();
            			break;
        			case 2:
            			pop();
            			display();
            			break;
        			case 3:
            			palindrome();
            			break;
        			case 4:
            			break;
        			default:
            			printf("\nInvalid choice");
        		}
    	}
while (ch != 4);
    	return 0;
}

Program 4:
Design, develop and Implement a Program in C for converting an Infix Expression to Postfix
Expression. Program should support for both parenthesized and free parenthesized expressions
with the operators: +, -, *, /, % (Remainder), ^ (Power) and alphanumeric operands. 

Source Code:
#include <stdio.h>
#include <ctype.h>
#define MAX 30

char infix[MAX], postfix[MAX], stack[MAX];
int top = -1;

void push(char c) {
    	stack[++top] = c;
}

char pop() {
    	return stack[top--];
}

int priority(char c) {
    	switch (c) {
        		case '+':
        		case '-':
            			return 1;
        		case '*':
        		case '/':
        		case '%':
            			return 2;
        		case '^':
            			return 3;
        		case '(':
            			return 0;
        		default:
            			return -1;
    	}
}

void infix_to_postfix() {
    	int i = 0, j = 0;
    	char c, temp;
    	push('#');

    	while ((c = infix[i++]) != '\0') {
        		if (isalnum(c)) {
            		postfix[j++] = c;
        		} else if (c == '(') {
            		push(c);
        		} else if (c == ')') {
            		while ((temp = pop()) != '(') {
                			postfix[j++] = temp;
            		}
        		} else {
            		while (priority(stack[top]) > priority(c) || (priority(stack[top]) == priority(c) && c != '^')) {
                			postfix[j++] = pop();
            		}
            		push(c);
        		}
    	}

    	while (top > 0) {
        		postfix[j++] = pop();
    	}
    	postfix[j] = '\0';
}

int main() {
    	printf("Enter infix expression (without spaces): ");
    	scanf("%29s", infix);
    	infix_to_postfix();
    	printf("\nPostfix Expression: %s\n", postfix);
    	return 0;
}

Program 8: 
Design, Develop and Implement a menu driven Program in C for the following operations on Circular QUEUE of Characters (Array Implementation of Queue with maximum size MAX) 
A)	Insert an Element on to Circular QUEUE
B)	Delete an Element from Circular QUEUE
C)	Demonstrate Overflow and Underflow situations on Circular QUEUE
D)	Display the status of Circular QUEUE
E)	Exit
Support the program with appropriate functions for each of the above operations.

Source Code:
#include <stdio.h>
#define MAX 10

int front = 0, rear = -1, count = 0;
char q[MAX], item;

void insert() {
    	if (count == MAX){
       		printf("\nQueue Overflow");
    	} else {
        		rear = (rear + 1) % MAX;
        		q[rear] = item;
        		count++;
    	}
}

void del() {
    	if (count == 0) {
        		printf("\nQueue Underflow");
    	} else {
        		printf("\nDeleted: %c", q[front]);
        		front = (front + 1) % MAX;
        		count--;
    	}
}

void display() {
    	if (count == 0) {
        		printf("\nQueue is Empty");
    	} else {
        		printf("\nQueue: ");
        		for (int i = 0, idx = front; i < count; i++, idx = (idx + 1) % MAX) {
            			printf("%c ", q[idx]);
		}
    	}
}

int main() {
    	int ch;
    	do {
        		printf("\n\n1. Insert\n2. Delete\n3. Display\n4. Exit\nEnter choice: ");
        		scanf("%d", &ch);
        		if (ch == 1) {
            			printf("Enter item: ");
            			scanf(" %c", &item);
            			insert();
        		} else if (ch == 2) {
            			del();
        		} else if (ch == 3) {
            			display();
        		}
    	}
while (ch != 4);
    	return 0;
}

Program 11: Program to implement Binary Search

#include <stdio.h>
int binarySearch(int a[], int n, int key){
    int low = 0, high = n - 1, mid;
    while (low <= high){
        mid = (low + high) / 2;
        if (a[mid] == key){
            return mid;
        }if (a[mid] < key){
            low = mid + 1;
        }else{
            high = mid - 1;
        }
    }
    return -1;
}
int main(){
    int n, key;
    printf("Enter size: ");
    scanf("%d", &n);
    int a[n];
    printf("Enter sorted elements: ");
    for (int i = 0; i < n; i++){
        scanf("%d", &a[i]);
    }
    printf("Enter key: ");
    scanf("%d", &key);
    int search = binarySearch(a, n, key);
    printf(search == -1 ? "Not found\n" : "Found at index %d\n", search);
}


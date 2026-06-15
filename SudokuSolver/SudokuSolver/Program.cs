using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;

class Sudoku
{
    private int[,] board;

    public Sudoku(int[,] initialBoard)
    {
        board = initialBoard;
    }

    public bool IsSolved()
    {
        for (int row = 0; row < 9; row++)
        {
            for (int col = 0; col < 9; col++)
            {
                if (board[row, col] == 0)
                {
                    return false;
                }
            }
        }
        return true;
    }

    public void PrintBoard()
    {
        for (int row = 0; row < 9; row++)
        {
            for (int col = 0; col < 9; col++)
            {
                Console.Write(board[row, col] + " ");
            }
            Console.WriteLine();
        }
        Console.WriteLine();
    }

    public List<Sudoku> GeneratePossibleMoves()
    {
        List<Sudoku> possibleMoves = new List<Sudoku>();

        for (int row = 0; row < 9; row++)
        {
            for (int col = 0; col < 9; col++)
            {
                if (board[row, col] == 0)
                {
                    for (int num = 1; num <= 9; num++)
                    {
                        if (IsValidMove(row, col, num))
                        {
                            int[,] newBoard = CloneBoard();
                            newBoard[row, col] = num;
                            possibleMoves.Add(new Sudoku(newBoard));
                        }
                    }
                    return possibleMoves;
                }
            }
        }

        return possibleMoves;
    }

    private int[,] CloneBoard()
    {
        int[,] newBoard = new int[9, 9];
        for (int row = 0; row < 9; row++)
        {
            for (int col = 0; col < 9; col++)
            {
                newBoard[row, col] = board[row, col];
            }
        }
        return newBoard;
    }

    private bool IsValidMove(int row, int col, int num)
    {
        return !UsedInRow(row, num) && !UsedInCol(col, num) && !UsedInBox(row - row % 3, col - col % 3, num);
    }

    private bool UsedInRow(int row, int num)
    {
        for (int col = 0; col < 9; col++)
        {
            if (board[row, col] == num)
            {
                return true;
            }
        }
        return false;
    }

    private bool UsedInCol(int col, int num)
    {
        for (int row = 0; row < 9; row++)
        {
            if (board[row, col] == num)
            {
                return true;
            }
        }
        return false;
    }

    private bool UsedInBox(int startRow, int startCol, int num)
    {
        for (int row = 0; row < 3; row++)
        {
            for (int col = 0; col < 3; col++)
            {
                if (board[row + startRow, col + startCol] == num)
                {
                    return true;
                }
            }
        }
        return false;
    }
}

class Solver
{
    public static bool SolveSudokuUsingStack(ArrayList stack)
    {
        while (stack.Count > 0)
        {
            Sudoku currentSudoku = (Sudoku)stack[stack.Count - 1];
            stack.RemoveAt(stack.Count - 1);

            if (currentSudoku.IsSolved())
            {
                Console.WriteLine("Sudoku solved successfully using Stack (ArrayList):");
                currentSudoku.PrintBoard();
                return true;
            }

            List<Sudoku> possibleMoves = currentSudoku.GeneratePossibleMoves();
            foreach (Sudoku move in possibleMoves)
            {
                stack.Add(move);
            }
        }

        return false;
    }

    public static bool SolveSudokuUsingQueue(ArrayList queue)
    {
        while (queue.Count > 0)
        {
            Sudoku currentSudoku = (Sudoku)queue[0];
            queue.RemoveAt(0);

            if (currentSudoku.IsSolved())
            {
                Console.WriteLine("Sudoku solved successfully using Queue (ArrayList):");
                currentSudoku.PrintBoard();
                return true;
            }

            List<Sudoku> possibleMoves = currentSudoku.GeneratePossibleMoves();
            foreach (Sudoku move in possibleMoves)
            {
                queue.Add(move);
            }
        }

        return false;
    }

    public static bool SolveSudokuUsingStackWithStackClass(Stack<Sudoku> stack)
    {
        while (stack.Count > 0)
        {
            Sudoku currentSudoku = stack.Pop();

            if (currentSudoku.IsSolved())
            {
                Console.WriteLine("Sudoku solved successfully using Stack (Stack class):");
                currentSudoku.PrintBoard();
                return true;
            }

            List<Sudoku> possibleMoves = currentSudoku.GeneratePossibleMoves();
            foreach (Sudoku move in possibleMoves)
            {
                stack.Push(move);
            }
        }

        return false;
    }

    public static bool SolveSudokuUsingQueueWithLinkedList(LinkedList<Sudoku> queue)
    {
        while (queue.Count > 0)
        {
            Sudoku currentSudoku = queue.First.Value;
            queue.RemoveFirst();

            if (currentSudoku.IsSolved())
            {
                Console.WriteLine("Sudoku solved successfully using Queue (LinkedList class):");
                currentSudoku.PrintBoard();
                return true;
            }

            List<Sudoku> possibleMoves = currentSudoku.GeneratePossibleMoves();
            foreach (Sudoku move in possibleMoves)
            {
                queue.AddLast(move);
            }
        }

        return false;
    }

    static void Main()
    {
        // Load Sudoku puzzle from a file (change the file path accordingly)
        int[,] initialBoard = ReadSudokuFromFile("p10.txt");

        // Solve Sudoku using Stack with ArrayList
        ArrayList stackArrayList = new ArrayList();
        stackArrayList.Add(new Sudoku(initialBoard));
        SolveSudokuUsingStack(stackArrayList);

        // Solve Sudoku using Queue with ArrayList
        ArrayList queueArrayList = new ArrayList();
        queueArrayList.Add(new Sudoku(initialBoard));
        SolveSudokuUsingQueue(queueArrayList);

        // Solve Sudoku using Stack with Stack class
        Stack<Sudoku> stackClass = new Stack<Sudoku>();
        stackClass.Push(new Sudoku(initialBoard));
        SolveSudokuUsingStackWithStackClass(stackClass);

        // Solve Sudoku using Queue with LinkedList class
        LinkedList<Sudoku> queueLinkedList = new LinkedList<Sudoku>();
        queueLinkedList.AddLast(new Sudoku(initialBoard));
        SolveSudokuUsingQueueWithLinkedList(queueLinkedList);
    }

    static int[,] ReadSudokuFromFile(string filePath)
    {
        int[,] sudoku = new int[9, 9];

        try
        {
            using (StreamReader sr = new StreamReader(filePath))
            {
                for (int i = 0; i < 9; i++)
                {
                    string line = sr.ReadLine();
                    string[] numbers = line.Split(' ');

                    for (int j = 0; j < 9; j++)
                    {
                        sudoku[i, j] = int.Parse(numbers[j]);
                    }
                }
            }
        }
        catch (Exception e)
        {
            Console.WriteLine("Error reading Sudoku file: " + e.Message);
        }

        return sudoku;
    }
}

# -*- coding: utf-8 -*-
"""
Created on Mon Sep 11 13:37:49 2023

@author: gudav
"""
# Import the SparseMatrix class from the sparse_recommender module
from sparse_recommender import SparseMatrix

# Test for setting and getting a value in the matrix
def test_set_value():
    # Create a SparseMatrix with 3 rows and 4 columns
    matrix = SparseMatrix(3, 4)
    
    # Set a value at row 0, column 0
    matrix.set(0, 0, 1)
    
    # Check if the value at row 0, column 0 is correctly set to 1
    assert matrix.get(0, 0) == 1

# Test for getting a value from the matrix
def test_get_value():
    # Create a SparseMatrix with 3 rows and 4 columns
    matrix = SparseMatrix(3, 4)
    
    # Set a value at row 1, column 1
    matrix.set(1, 1, 2)
    
    # Check if the value at row 1, column 1 is correctly retrieved as 2
    assert matrix.get(1, 1) == 2

# Test for matrix-vector recommendation
def test_recommend():
    # Create a SparseMatrix with 3 rows and 4 columns and set some values
    matrix = SparseMatrix(3, 4)
    matrix.set(0, 0, 1)
    matrix.set(1, 1, 2)
    
    # Define a user vector
    vector = [1, 2, 0, 0]
    
    # Calculate recommendations based on the user vector
    recommendations = matrix.recommend(vector)
    
    # Check if the recommendations are as expected
    assert recommendations == [1, 4, 0]

# Test for adding two matrices
def test_add_movie():
    # Create two SparseMatrices with 3 rows and 4 columns and set some values
    matrix1 = SparseMatrix(3, 4)
    matrix1.set(0, 0, 1)
    
    matrix2 = SparseMatrix(3, 4)
    matrix2.set(1, 1, 2)
    
    # Add matrix2 to matrix1
    result_matrix = matrix1.add_movie(matrix2)
    
    # Check if the values in the result_matrix are as expected
    assert result_matrix.get(0, 0) == 1
    assert result_matrix.get(1, 1) == 2

# Test for converting a sparse matrix to a dense matrix
def test_to_dense():
    # Create a SparseMatrix with 2 rows and 3 columns and set some values
    matrix = SparseMatrix(2, 3)
    matrix.set(0, 0, 1)
    matrix.set(1, 1, 2)
    
    # Convert the sparse matrix to a dense matrix
    dense_matrix = matrix.to_dense()
    
    # Check if the dense matrix is as expected
    assert dense_matrix == [[1, 0, 0], [0, 2, 0]]

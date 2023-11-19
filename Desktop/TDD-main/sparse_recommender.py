# -*- coding: utf-8 -*-
"""
Created on Mon Sep 11 13:45:05 2023

@author: gudav
"""
class SparseMatrix:
    def __init__(self, rows, cols):
        # Initialize a SparseMatrix with the specified number of rows and columns
        self.rows = rows
        self.cols = cols
        # Create an empty dictionary to store non-zero elements 
        self.data = {}

    def set(self, row, col, value):
        # Set a value at the specified row and column in the matrix
        if self._is_valid_index(row, col):
            self.data[(row, col)] = value
        else:
            # Raise a ValueError if the indices are out of bounds
            raise ValueError

    def get(self, row, col):
        # Retrieve a value at the specified row and column in the matrix
        if self._is_valid_index(row, col):
            # Use the dictionary's get method to retrieve the value; default to 0 if not found
            return self.data.get((row, col), 0)
        else:
            # Raise a ValueError if the indices are out of bounds
            raise ValueError

    def recommend(self, user_vector):
        # Generate recommendations based on a user vector
        if len(user_vector) != self.cols:
            # Raise a ValueError if the dimensions do not match
            raise ValueError
        
        # Initialize a list to store recommendations, initially filled with zeros
        recommendations = [0] * self.rows
        
        # Iterate over rows and columns to calculate recommendations
        for (row, col), value in self.data.items():
            recommendations[row] += value * user_vector[col]
        
        # Return the list of recommendations
        return recommendations

    def add_movie(self, other_matrix):
        # Add another matrix to the current matrix
        if self.rows != other_matrix.rows or self.cols != other_matrix.cols:
            # Raise a ValueError if the dimensions do not match
            raise ValueError

        # Iterate over the elements of the other matrix and add them to the current matrix
        for (row, col), value in other_matrix.data.items():
            self.set(row, col, self.get(row, col) + value)
            
        # Return the updated matrix
        return self

    def to_dense(self):
        # Convert the sparse matrix to a dense matrix
        dense_matrix = [[0] * self.cols for _ in range(self.rows)]
        
        # Iterate over the elements in the data dictionary and fill in the dense matrix
        for (row, col), value in self.data.items():
            dense_matrix[row][col] = value
        
        # Return the dense matrix
        return dense_matrix
    
    def _is_valid_index(self, row, col):
        # Check if the provided row and column indices are within valid bounds
        return 0 <= row < self.rows and 0 <= col < self.cols

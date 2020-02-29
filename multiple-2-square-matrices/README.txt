Description:
 - This is project which implements 2 algorithms for multiple 2 square matrices
  + Simple device and conquer algorithm
  + Strassen algorithm
Require:
 - PHP >= 7.0
 - Some common extensions for php: bcmath, common, cli, ...
Process:
 - Firstly, run create_data.php with input is matrix's size to create 2 source matrices. For example: php create_data.php 64
 - Then, run algorithms.php to calculate: php algorithms.php
Notice:
 - Algorithms can be run only with square matrix and matrix's size is an exact power of 2
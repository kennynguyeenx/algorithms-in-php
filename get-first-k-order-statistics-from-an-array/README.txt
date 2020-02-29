Description:
 - This is project which implements 4 algorithms for get first k order statistics from an array:
  + Algorithm uses heapsort
  + Algorithm uses randomized-select algorithm
  + Algorithm uses select algorithm with linear running time in worst case
  + My algorithm which uses heap
Require:
 - PHP >= 7.0
 - Some common extensions for php: bcmath, common, cli, ...
Process:
 - Firstly, run create_data.php with input is array's size to create source array. For example: php create_data.php 10000
 - Then, run algorithms.php to exec: php algorithms.php
Notice:
 - My algorithm is described in doc/My_Algorithm.txt
<?php
/**
 * Batterie de tests pour la fonction AGE
 */
require_once('functions.php');
echo '<p>Test 1 : ' . age('11/05/1996', '2021-01-27');
echo '<p>Test 2 : ' . age(123456, 789456);
echo '<p>Test 3 : ' . age('Toto', 'aime les gâteaux');


/**
 * Batterie de tests pour la fonction IS_DATE
 */
echo '<p>Test 4 : ' . is_date('2021-01-27');
echo '<p>Test 5 : ' . is_date('Toto aime le coco');
echo '<p>Test 6 : ' . is_date(778845667);


/**
 * Batterie de tests pour la fonction TTC
 */
echo '<p>Test 7 : ' . ttc(420);

?>
<?php
include_once('animal.class.php');
include_once('human.class.php');

echo '<h2>Test 1 : Instanciation</h2>';
$obj1 = new Animal();
echo '<h3>Nombre d\'instances : ' . Animal::getNb() . '</h3>';
$obj1->name = 'Milou'; // valorisation attribut
// $obj1->color = 'Blanc';
echo '<p>' . $obj1->move(); // appel méthode
var_dump($obj1);

echo '<h2>Test 2 : Utilisation des accesseurs</h2>';
$obj2 = new Animal();
echo '<h3>Nombre d\'instances : ' . Animal::getNb() . '</h3>';
$obj2->name = 'Snoopy';
$obj2->setType('Terrestre');
echo '<p>' . $obj2->getType();
$obj2->setWeight(5.4);
$obj2->setColor('Noir et blanc');
// $obj2->setWeight(1500);
var_dump($obj2);

echo '<h2>Test 3 : Utilisation des constantes</h2>';
echo '<p>' . Animal::TYPE_WATER;

echo '<h2>Test 4 : Utilisation du constructeur</h2>';
$obj4 = new Animal('Garfield', Animal::TYPE_GROUND, 'Orange', 7.8);
echo '<h3>Nombre d\'instances : ' . Animal::getNb() . '</h3>';
var_dump($obj4);

echo '<h2>Test 5 : Appel des méthodes</h2>';
$obj5 = new Animal('Titi', Animal::TYPE_AIR, 'Jaune', .3);
echo '<h3>Nombre d\'instances : ' . Animal::getNb() . '</h3>';
$obj6 = new Animal('Sylvestre', Animal::TYPE_GROUND, 'Noir et blanc', 5.25);
echo '<h3>Nombre d\'instances : ' . Animal::getNb() . '</h3>';
echo '<p>' . $obj5->move();
echo '<p>' . $obj6->move();
var_dump($obj5);
var_dump($obj6);
$obj6->eat($obj5);
unset($obj5);
echo '<h3>Nombre d\'instances : ' . Animal::getNb() . '</h3>';
// var_dump($obj5);
var_dump($obj6);

echo '<h2>Test 6 : Valeur par défaut vs Mutateur</h2>';
$obj7 = new Animal('Jolly Jumper', 'extraordinaire', 'Blanc', 895.6, '1956-02-25');
var_dump($obj7);
$obj7->setDob('1970-01-01 00:00:01'); // 1970-01-01 renvoie une erreur
echo '<p>' . $obj7->getAge() . ' ans';
var_dump($obj7);

echo '<h2>Test 7 : Héritage</h2>';
$obj8 = new Human('Lesly', '1967-11-11');
$obj8->setWeight(70);
var_dump($obj8);
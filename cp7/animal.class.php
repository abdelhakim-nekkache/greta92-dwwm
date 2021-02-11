<?php
class Animal
{
    // Propriétés publiques
    public $name = '';

    // Propriétés privées
    private $type = '';
    private $color = '';
    protected $weight = 0.0;
    private $dob = '';

    // Propriétés statiques
    protected static $nb = 0;

    // Constantes de classe
    const TYPE_AIR = 'aérien';
    const TYPE_WATER = 'marin';
    const TYPE_GROUND = 'terrestre';
    const TYPE_ELSE = 'autre';

    // Constructeur de la classe
    public function __construct(string $newName = '', string $newType = self::TYPE_ELSE, string $newColor = 'blanc', float $newWeight = 0.02, string $newDob = '1970-01-02')
    {
        // Assigne les valeurs des arguments aux attributs
        $this->name = $newName;
        $this->setType($newType);
        $this->setColor($newColor);
        $this->setWeight($newWeight);
        $this->setDob($newDob);
        // Incrémente le compteur d'instances
        self::$nb++;
    }

    // Méthode statique qui affiche le nombre d'instances
    public static function getNb(): int
    {
        return self::$nb;
    }

    // Fonctions privées pour usage interne
    private function isDate($arg): bool
    {
        return (bool) strtotime($arg);
    }

    // Accesseurs/Mutateurs (Getters/Setters)
    public function getAge(): int
    {
        $d1 = strtotime($this->getDob());
        $d2 = strtotime(date('Y-m-d'));
        $diff = $d2 - $d1;
        return floor($diff / 60 / 60 / 24 / 365.25);
    }

    public function getDob(): string
    {
        return $this->dob;
    }

    public function setDob(string $newDob)
    {
        if ($this->isDate($newDob)) {
            $this->dob = $newDob;
        } else {
            throw new Exception('L\'argument passé en paramètre n\'est pas une date.');
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $newType)
    {
        // Le type ne peut être que : terrestre, marin ou aérien
        $newType = strtolower($newType);
        if ($newType === self::TYPE_GROUND || $newType === self::TYPE_AIR || $newType === self::TYPE_WATER) {
            $this->type = $newType;
        } else {
            $this->type = self::TYPE_ELSE;
        }
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $newColor)
    {
        $this->color = $newColor;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $newWeight)
    {
        // Le poids doit être compris entre 20g (souris) et 1100kg (cheval)
        if ($newWeight >= 0.02 && $newWeight <= 1100) {
            $this->weight = $newWeight;
        } else {
            throw new Exception('Le poids doit être compris entre 20g (souris) et 1100kg (cheval).');
        }
    }

    // Méthode publique pour se déplacer
    public function move(): string
    {
        // Selon l'environnement de l'animal
        // afficher le mode de déplacement
        $type = $this->getType();
        switch ($type) {
            case self::TYPE_WATER:
                return 'Je nage';
                // break;
            case self::TYPE_GROUND:
                return 'Je marche';
            case self::TYPE_AIR:
                return 'Je vole';
            default:
                return 'Je me déplace';
        }
    }

    public function eat(Animal $prey)
    {
        // Un animal mange un autre animal :
        // le prédateur gagne le poids de la proie
        $this->weight += $prey->getWeight();
        // la proie perd son poids
        $prey->weight = 0;
    }

    public function __destruct()
    {
        // RAZ des propriétés privées de l'animal
        $this->type = self::TYPE_ELSE;
        $this->color = '';
        $this->weight = .0;
        // Décrémente le nombre d'instances
        self::$nb--;
    }
}
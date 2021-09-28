<?php

class Poker
{
    /**
     * @prepare $bones int[]
     */
    private $bones = [];

    public function __construct()
    {
        $this->setNewBones();
    }

    public function getBones(): array
    {
        return $this->bones;
    }

    public function setNewBones(){
        $this->bones = [];
        for ($i = 1; $i <= 5; $i++) {
            $this->bones[] = random_int(1, 6);
        }
    }

    private function getCountValue(): array
    {
        $rez = [];
        foreach ($this->bones as $item) {
            if (array_key_exists($item, $rez)) {
                $rez[$item]++;
            } else {
                $rez[$item] = 1;
            }
        }
        return $rez;
    }

    private function getUnique(): array
    {
        $rez = [];
        foreach ($this->bones as $item) {
            $rez[$item] = 1;
        }
        return array_keys($rez);
    }

    public function getCombination(): string
    {
        $_bones = $this->bones;
        sort($_bones);
        $str_bonus = implode('', $_bones);

        $count_value = $this->getCountValue();

        if (count($this->getUnique()) === 1) {
            return 'Покер.';
        } elseif (in_array(4, $count_value)) {
            return 'Каре.';
        } elseif (in_array(2, $count_value) && in_array(3, $count_value)) {
            return 'Фул-хаус.';
        } elseif ($str_bonus === '12345' || $str_bonus === '23456') {
            return 'Большой стрит.';
        } elseif ((strpos($str_bonus, '1234') !== false) || (strpos($str_bonus, '2345') !== false) || (strpos($str_bonus, '3456') !== false)) {
            return 'Малый стрит.';
        } elseif (in_array(3, $count_value)) {
            return 'Сэт.';
        } elseif (in_array(2, $count_value) && (count($count_value) === 3)) {
            return 'Две пары.';
        } elseif (in_array(2, $count_value)) {
            return 'Пара.';
        }
        return 'Шанс';
    }

    public function printBones(): string
    {
        return implode(' ', $this->getBones());
    }
}

$newPoker = new Poker();
echo $newPoker->getCombination();
echo '<br>';
echo $newPoker->printBones();

unset($newPoker);

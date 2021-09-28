<?php


namespace App\Repositories;

use App\Card;

class CardRepository
{

    protected $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    private function save(Card $card, Array $inputs)
    {
        $card->name = $inputs['name'];
        $card->email = $inputs['email'];
        $card->admin = isset($inputs['admin']);

        $card->save();
    }

    public function getPaginate($n)
    {
        return $this->card->paginate($n);
    }

    public function store(Array $inputs)
    {
        $card = new $this->card;
        $card->password = bcrypt($inputs['password']);

        $this->save($card, $inputs);

        return $card;
    }

    public function getById($id)
    {
        return $this->card->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        $this->save($this->getById($id), $inputs);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }


}

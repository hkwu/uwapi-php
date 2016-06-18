<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Notes;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\FoodServices\Notes\Components\NoteComponent;

class NotesModel extends BaseModel
{
    private $numNotes;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->numNotes = count($this->getData());
    }

    /**
     * @return int
     */
    public function getNumNotes()
    {
        return $this->numNotes;
    }

    public function getNotes()
    {
        return array_map(function ($element) {
            return new NoteComponent($element);
        }, $this->getData());
    }

    public function getNoteByIndex($index)
    {
        return new NoteComponent($this->getData()[$index]);
    }
}

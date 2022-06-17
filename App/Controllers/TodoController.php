<?php

namespace App\Controllers;

class TodoController
{
    public function list()
    {
        /** INSTANSLY: Get Data from DB */       
        $data = [
            'tasks' => [
                'First Task',
                'Do Planning',
                'Design Resume Template',
                'Read Book',
                'Do PHP Exercise'
            ],
            'title' => 'لیست کارها'
        ];
        
        view('todo.list', $data);
    }
}
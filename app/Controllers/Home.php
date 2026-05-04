<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function results(): string|ResponseInterface
    {
        if (strtolower($this->request->getMethod()) === 'post') {
            $userInput = $this->request->getPost('user_input');

            return view('test_results', [
                'submitted_text' => $userInput
            ]);
        }

        return view('test_results');
    }
}

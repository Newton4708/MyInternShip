<?php
// namespace App\Controllers;
require_once __DIR__ . '/../../core/Controller.php';
// use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $this->render('home/index');
    }
}

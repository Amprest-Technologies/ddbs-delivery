<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get the deliveries from the three tables.
     */
    public function index()
    {
        try {
            $payload['status'] = 200;
            $payload['data'] = 'Message';
        } catch (\Exception $e) {
            $payload['status'] = 401;
            $payload['data'] = $e->getMessage();
        } finally {
            return view('admin.index', ['payload' => $payload['data']]);
        }
    }
}

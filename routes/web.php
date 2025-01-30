<?php

use App\Livewire\WhoisChecker;
use Illuminate\Support\Facades\Route;

Route::get('/', WhoisChecker::class);

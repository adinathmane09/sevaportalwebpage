<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OpenTicketsController;
use App\Http\Controllers\ClosedTicketController;
use App\Http\Controllers\ManageTicketController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/admin/login'); // or any default page you want
});

// Admin login routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate']);


// Admin dashboard route
Route::get('/dashboard', [AdminAuthController::class, 'showDashboard'])->name('admin.dashboard');

// Route for All Tickets
Route::get('/dashboard/all_tickets', [AdminAuthController::class, 'showAllTickets'])->name('dashboard.all_tickets');

// Route for Open Tickets
Route::get('/open_tickets', [AdminAuthController::class, 'showOpenTickets'])->name('dashboard.open_tickets');

// Route for Closed Tickets
Route::get('/closed_tickets', [AdminAuthController::class, 'showClosedTickets'])->name('dashboard.closed_tickets');

Route::get('/Managetickets', [AdminAuthController::class, 'showManagetickets'])->name('dashboard.Managetickets');

// Route for Add User
Route::get('/add_user', [AdminAuthController::class, 'showAddUser'])->name('dashboard.add_user');
 
// Route for logout
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');



Route::get('/admin/dashboard', [TicketController::class, 'index'])->name('admin.dashboard');
Route::get('/tickets', [TicketController::class, 'fetch'])->name('tickets.fetch');
Route::post('/tickets/update', [TicketController::class, 'update'])->name('tickets.update');
Route::post('/tickets/delete', [TicketController::class, 'delete'])->name('tickets.delete');

// Open Tickets Controller
Route::get('/admin/open-tickets', [OpenTicketsController::class, 'index'])->name('dashboard.open_tickets');
Route::get('/admin/open-tickets/fetch', [OpenTicketsController::class, 'fetch'])->name('open_tickets.fetch');
Route::post('/admin/open-tickets/update', [OpenTicketsController::class, 'update'])->name('open_tickets.update');

//close tickets controller
Route::get('/admin/closed-tickets', [ClosedTicketController::class, 'index'])->name('dashboard.closed_tickets');
Route::get('/admin/closed-tickets/fetch', [ClosedTicketController::class, 'fetch'])->name('closed_tickets.fetch');
 //add user
 Route::post('/dashboard/store-user', [AdminAuthController::class, 'storeUser'])->name('dashboard.store_user');


Route::get('/admin/managetickets', [TicketController::class, 'manageTickets'])->name('dashboard.Managetickets');
Route::post('/admin/raise-ticket', [TicketController::class, 'raiseTicket'])->name('tickets.raise');

Route::get('/dashboard/raise-ticket/{id}', [TicketController::class, 'show'])->name('dashboard.raise_ticket');
Route::post('/dashboard/raise-ticket/store', [TicketController::class, 'raiseTicket'])->name('dashboard.raise_ticket_store');

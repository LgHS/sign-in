<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Request;

class NotificationsController extends AppBaseController {
	public function index(Request $request) {
		$notifications = DatabaseNotification::orderBy('created_at', 'desc')->get();
		return view('admin.notifications.index', [
			'notifications' => $notifications
		]);
	}
}
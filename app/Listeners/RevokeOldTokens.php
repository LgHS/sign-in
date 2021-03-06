<?php
namespace app\Listeners;

use DB;
use Laravel\Passport\Events\AccessTokenCreated;

class RevokeOldTokens {
	public function handle(AccessTokenCreated $event) {
		DB::table('oauth_access_tokens')
		  ->where('id', '<>', $event->tokenId)
		  ->where('user_id', '=', $event->userId)
		  ->where('client_id', '=', $event->clientId)
		  ->update([
			  'revoked' => true,
		  ]);
	}
}

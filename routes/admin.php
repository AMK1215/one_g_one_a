<?php

use App\Http\Controllers\Admin\Agent\AgentController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BannerAds\BannerAdsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BannerTextController;
use App\Http\Controllers\Admin\Bonu\BonusController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PaymentTypeController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\GetBetDetailController;
use App\Http\Controllers\Admin\Player\PlayerController;
use App\Http\Controllers\Admin\GameTypeProductController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\Deposit\DepositRequestController;
use App\Http\Controllers\Admin\GameListController;
use App\Http\Controllers\Admin\GSCReportController;
use App\Http\Controllers\Admin\Owner\OwnerController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TransferLog\TransferLogController;
use App\Http\Controllers\Admin\WithDraw\WithDrawRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Shan\ShanReportController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'checkBanned'],
], function () {

    Route::post('balance-up', [HomeController::class, 'balanceUp'])->name('balanceUp');
    Route::get('logs/{id}', [HomeController::class, 'logs'])
        ->name('logs');
    Route::get('/changePassword/{user}', [HomeController::class, 'changePassword'])->name('changePassword');
    Route::post('/updatePassword/{user}', [HomeController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/player-list', [HomeController::class, 'playerList'])->name('playerList');

    // Permissions
    Route::resource('permissions', PermissionController::class);
    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);
    // Players
    Route::delete('user/destroy', [PlayerController::class, 'massDestroy'])->name('user.massDestroy');

    Route::put('player/{id}/ban', [PlayerController::class, 'banUser'])->name('player.ban');
    Route::resource('player', PlayerController::class);
    Route::get('player-cash-in/{player}', [PlayerController::class, 'getCashIn'])->name('player.getCashIn');
    Route::post('player-cash-in/{player}', [PlayerController::class, 'makeCashIn'])->name('player.makeCashIn');
    Route::get('player/cash-out/{player}', [PlayerController::class, 'getCashOut'])->name('player.getCashOut');
    Route::post('player/cash-out/update/{player}', [PlayerController::class, 'makeCashOut'])
        ->name('player.makeCashOut');
    Route::get('player-changepassword/{id}', [PlayerController::class, 'getChangePassword'])->name('player.getChangePassword');
    Route::post('player-changepassword/{id}', [PlayerController::class, 'makeChangePassword'])->name('player.makeChangePassword');

    Route::get('/players-list', [PlayerController::class, 'player_with_agent'])->name('playerListForAdmin');

    Route::resource('banners', BannerController::class);
    Route::resource('adsbanners', BannerAdsController::class);
    Route::resource('text', BannerTextController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('/promotions', PromotionController::class);
    Route::resource('paymentTypes', PaymentTypeController::class);
    Route::resource('bank', BankController::class);
    Route::get('gametypes', [GameTypeProductController::class, 'index'])->name('gametypes.index');
    Route::get('gametypes/{game_type_id}/product/{product_id}', [GameTypeProductController::class, 'edit'])->name('gametypes.edit');
    Route::post('gametypes/{game_type_id}/product/{product_id}', [GameTypeProductController::class, 'update'])->name('gametypes.update');

    Route::get('transaction-list', [TransactionController::class, 'index'])->name('transaction');
    // game list start
    Route::get('all-game-lists', [GameListController::class, 'index'])->name('gameLists.index');
    Route::get('all-game-lists/{id}', [GameListController::class, 'edit'])->name('gameLists.edit');
    Route::post('all-game-lists/{id}', [GameListController::class, 'update'])->name('gameLists.update');

    Route::patch('gameLists/{id}/toggleStatus', [GameListController::class, 'toggleStatus'])->name('gameLists.toggleStatus');

    Route::patch('hotgameLists/{id}/toggleStatus', [GameListController::class, 'HotGameStatus'])->name('HotGame.toggleStatus');
    // game list end
    Route::resource('agent', AgentController::class);
    Route::get('agent-cash-in/{id}', [AgentController::class, 'getCashIn'])->name('agent.getCashIn');
    Route::post('agent-cash-in/{id}', [AgentController::class, 'makeCashIn'])->name('agent.makeCashIn');
    Route::get('agent/cash-out/{id}', [AgentController::class, 'getCashOut'])->name('agent.getCashOut');
    Route::post('agent/cash-out/update/{id}', [AgentController::class, 'makeCashOut'])
        ->name('agent.makeCashOut');
    Route::put('agent/{id}/ban', [AgentController::class, 'banAgent'])->name('agent.ban');
    Route::get('agent-changepassword/{id}', [AgentController::class, 'getChangePassword'])->name('agent.getChangePassword');
    Route::post('agent-changepassword/{id}', [AgentController::class, 'makeChangePassword'])->name('agent.makeChangePassword');

    Route::get('agent-to-player-deplogs', [AgentController::class, 'AgentToPlayerDepositLog'])->name('agent.AgentToPlayerDepLog');

    Route::get('agent-win-lose-report', [AgentController::class, 'AgentWinLoseReport'])->name('agent.AgentWinLose');

    Route::get('/agent/wldetails/{agent_id}/{month}', [AgentController::class, 'AgentWinLoseDetails'])->name('agent_winLdetails');

    Route::get('auth-agent-win-lose-report', [AgentController::class, 'AuthAgentWinLoseReport'])->name('AuthAgentWinLose');

    Route::get('/authagent/wldetails/{agent_id}/{month}', [AgentController::class, 'AuthAgentWinLoseDetails'])->name('authagent_winLdetails');

    Route::get('/agent-to-player-detail/{agent_id}/{player_id}', [AgentController::class, 'AgentToPlayerDetail'])->name('agent.to.player.detail');


    Route::resource('owner', OwnerController::class);
    Route::get('owner-cash-in/{id}', [OwnerController::class, 'getCashIn'])->name('owner.getCashIn');
    Route::post('owner-cash-in/{id}', [OwnerController::class, 'makeCashIn'])->name('owner.makeCashIn');
    Route::get('mastownerer/cash-out/{id}', [OwnerController::class, 'getCashOut'])->name('owner.getCashOut');
    Route::post('owner/cash-out/update/{id}', [OwnerController::class, 'makeCashOut'])
        ->name('owner.makeCashOut');
    Route::put('owner/{id}/ban', [OwnerController::class, 'banOwner'])->name('owner.ban');
    Route::get('owner-changepassword/{id}', [OwnerController::class, 'getChangePassword'])->name('owner.getChangePassword');
    Route::post('owner-changepassword/{id}', [OwnerController::class, 'makeChangePassword'])->name('owner.makeChangePassword');

    Route::get('withdraw', [WithDrawRequestController::class, 'index'])->name('agent.withdraw');
    Route::post('withdraw/{withdraw}', [WithDrawRequestController::class, 'statusChangeIndex'])->name('agent.withdrawStatusUpdate');
    Route::post('withdraw/reject/{withdraw}', [WithDrawRequestController::class, 'statusChangeReject'])->name('agent.withdrawStatusreject');

    //Route::group(['prefix' => 'report'], function () {
    Route::get('slot-win-lose', [GSCReportController::class, 'index'])->name('GscReport.index');

    Route::get('/win-lose/details/{product_name}', [GSCReportController::class, 'ReportDetails'])->name('Reportproduct.details');

    Route::get('agent-slot-win-lose', [GSCReportController::class, 'AgentWinLoseindex'])->name('GscReport.AgentWLindex');

    //Route::get('view/{user_id}', [ReportController::class, 'view'])->name('report.view');
    //Route::get('show/{proudct_code}', [ReportController::class, 'show'])->name('report.show');
    // Route::get('detail/{user_id}', [ReportController::class, 'detail'])->name('report.detail');

    // });

    Route::get('shan-report', [ShanReportController::class, 'index'])->name('shan.reports.index');
    Route::get('shan-reports/{user_id}', [ShanReportController::class, 'show'])->name('shanreport.show');
    // for agent shan report
    Route::get('agent-shan-report', [ShanReportController::class, 'ShanAgentReportIndex'])->name('shanreports_index');

    Route::get('deposit', [DepositRequestController::class, 'index'])->name('agent.deposit');
    Route::get('deposit/{deposit}', [DepositRequestController::class, 'view'])->name('agent.depositView');
    Route::post('deposit/{deposit}', [DepositRequestController::class, 'statusChangeIndex'])->name('agent.depositStatusUpdate');
    Route::post('deposit/reject/{deposit}', [DepositRequestController::class, 'statusChangeReject'])->name('agent.depositStatusreject');

    Route::get('transer-log', [TransferLogController::class, 'index'])->name('transferLog');
    Route::get('transferlog/{id}', [TransferLogController::class, 'transferLog'])->name('transferLogDetail');

    // Route::group(['prefix' => 'report'], function () {
    //     Route::get('index', [ReportController::class, 'index'])->name('report.index');
    //     Route::get('view/{user_id}', [ReportController::class, 'view'])->name('report.view');
    //     Route::get('show/{proudct_code}', [ReportController::class, 'show'])->name('report.show');
    //     Route::get('detail/{user_id}', [ReportController::class, 'detail'])->name('report.detail');

    // });

    Route::group(['prefix' => 'bonu'], function () {
        Route::get('countindex', [BonusController::class, 'index'])->name('bonu_count.index');
        // Route::get('view/{user_id}', [ReportController::class, 'view'])->name('report.view');
        // Route::get('show/{proudct_code}', [ReportController::class, 'show'])->name('report.show');
        // Route::get('detail/{user_id}/{product_code}', [ReportController::class, 'detail'])->name('report.detail');
    });

    // get bet deatil
    Route::get('get-bet-detail', [GetBetDetailController::class, 'index'])->name('getBetDetail');
    Route::get('get-bet-detail/{wagerId}', [GetBetDetailController::class, 'getBetDetail'])->name('getBetDetail.show');

    Route::resource('/product_code', App\Http\Controllers\Admin\ProductCodeController::class);
});

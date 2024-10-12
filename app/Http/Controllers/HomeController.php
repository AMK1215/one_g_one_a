<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use Carbon\Carbon;
use Exception;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Settings\AppSetting;
use Illuminate\Http\Request;
use App\Models\Admin\UserLog;
use App\Enums\TransactionName;
use App\Services\WalletService;
use Illuminate\Support\Facades\DB;
use App\Models\SeamlessTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->roles->pluck('title');

        $agent_count = User::where('type', UserType::Agent)->when($role[0] != 'Admin', function ($query) use ($user) {
            $query->where('agent_id', $user->id);
        })->count();

        $player_count = User::where('type', UserType::Player)
            ->when($role[0] === 'Master', function ($query) use ($user) {
                $agentIds = User::where('type', UserType::Agent)
                    ->where('agent_id', $user->id)
                    ->pluck('id');

                return $query->whereIn('agent_id', $agentIds);
            })->when($role[0] === 'Agent', function ($query) use ($user) {
                return $query->where('agent_id', $user->id);
            })
            ->count();

        $totalBalance = $user->balanceFloat;

        return view('admin.dashboard', compact(
            'agent_count',
            'player_count',
            'user',
            'totalBalance',
            'role'
        ));
    }

    public function balanceUp(Request $request)
    {
        abort_if(
            Gate::denies('admin_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot Access this page because you do not have permission'
        );

        $request->validate([
            'balance' => 'required|numeric',
        ]);

        // Get the current user (admin)
        $admin = Auth::user();

        // Get the current balance before the update
        $openingBalance = $admin->wallet->balanceFloat;

        // Update the balance using the WalletService
        app(WalletService::class)->deposit($admin, $request->balance, TransactionName::CapitalDeposit);

        // Record the transaction in the transactions table
        Transaction::create([
            'payable_type' => get_class($admin),
            'payable_id' => $admin->id,
            'wallet_id' => $admin->wallet->id,
            'type' => 'deposit',
            'amount' => $request->balance,
            'confirmed' => true,
            'meta' => json_encode([
                'name' => TransactionName::CapitalDeposit,
                'opening_balance' => $openingBalance,
                'new_balance' => $admin->wallet->balanceFloat,
                'target_user_id' => $admin->id,
            ]),
            'uuid' => Str::uuid()->toString(),
        ]);

        return back()->with('success', 'Add New Balance Successfully.');
    }


    public function logs($id)
    {
        $logs = UserLog::with('user')->where('user_id', $id)->get();

        return view('admin.logs', compact('logs'));
    }
}

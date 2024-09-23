<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class GSCReportController extends Controller
{
     public function index()
    {
        // Call the private function to get the joined table data
        $data = $this->makeJoinTable();

        // Pass the data to the view
        return view('report.index', compact('data'));
    }

    // The private function from your code to generate the data
    private function makeJoinTable()
    {
        $query = User::query()->roleLimited();

        $query->select([
            'products.name as product_name',
            DB::raw('COUNT(reports.id) as total_record'), // Total Record
            DB::raw('SUM(reports.bet_amount) as total_bet'), // Total Bet
            DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet'), // Total Valid Bet
            DB::raw('SUM(reports.jp_bet) as total_prog_jp'), // Total Prog JP
            DB::raw('SUM(reports.payout_amount) as total_payout'), // Total Payout
            DB::raw('SUM(reports.payout_amount - reports.valid_bet_amount) as total_win_lose'), // Total Win/Loss

            // Member-related columns
            DB::raw('SUM(reports.agent_commission) as member_comm'), // Member Commission
            DB::raw('0 as member_total'), // Total for Member (change as per your logic)

            // Upline-related columns
            DB::raw('SUM(reports.agent_commission) as upline_comm'), // Upline Commission
            DB::raw('SUM(reports.payout_amount - reports.valid_bet_amount) as upline_total'), // Total for Upline (adjust if necessary)
        ])
        ->join('reports', 'reports.member_name', '=', 'users.user_name')
        ->join('products', 'reports.product_code', '=', 'products.code')
        ->where('reports.status', '101') // Status filter
        ->groupBy('products.name');

        return $query->get();
    }
}
<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Bank;
use App\Models\Lead;
=======
use App\Models\Article;
>>>>>>> 0023d8cc7e91667d0dc8c6f56aa46ab09d9e2e51
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
<<<<<<< HEAD
        // Administrator

        if (auth()->user()->is_admin) {

            $leadsCount['this_week'] = Lead::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();

            $leadsCount['this_month'] = Lead::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->count();

            $leadsCount['last_month'] = Lead::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();

            $leadsCount['this_year'] = Lead::whereYear('created_at', date('Y'))->count();



        } else {
            $leadsCount['this_week'] = Lead::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->where('user_id', auth()->user()->id)->count();

            $leadsCount['this_week'] = Lead::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->where('user_id', auth()->user()->id)->count();

            $leadsCount['this_month'] = Lead::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->where('user_id', auth()->user()->id)->count();

            $leadsCount['last_month'] = Lead::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->where('user_id', auth()->user()->id)->count();

            $leadsCount['this_year'] = Lead::whereYear('created_at', date('Y'))->where('user_id', auth()->user()->id)->count();
        }


        // User


        return view('home', compact('leadsCount'));
    }

    function getLoanSanctionedOfMonth()
    {
        // Get Bank details Types
        $banks = Bank::orderby('bank_name')->get();
        $report = [];
        $all_report = [];
        foreach ($banks as $bank) {

            $report['bank_name'] = $bank->bank_name;
            $report['monthly_cycle'] = $bank->monthly_cycle;
            if ($bank->monthly_cycle == 1)
            {
                $report['sanctioned_amount'] = Lead::whereMonth('created_at', date('m'))
                                                        ->where('bank', $bank->id)
                                                        ->sum('disbused_amount');
            }
            else {
                if ($bank->monthly_cycle > date('d'))
                {
                    $month_type = 'prev';
                    $date = Carbon::create(date('Y'), date('m') -1, $bank->monthly_cycle, 0);
                    $report['sanctioned_amount'] = Lead::whereDate('created_at', $date)
                                                        ->where('bank', $bank->id)
                                                        ->sum('disbused_amount');
                }
                else
                {

                    $date = Carbon::create(date('Y'), date('m'), $bank->monthly_cycle, 0);
                   $month_type = 'current';
                   $report['sanctioned_amount'] = Lead::whereDate('created_at', $date)
                                                        ->where('bank', $bank->id)
                                                        ->sum('disbused_amount');
                }
            }

            $all_report[]   = $report;
        }

        return view('sanctioned-report', compact('all_report'));
=======
        $articles = Article::with(['category', 'tags'])->latest()->paginate(2);
        return view('articles', compact('articles'));
    }

    public function article($id)
    {
        $article = Article::findOrFail($id);
        return view('article_detail', compact('article'));
>>>>>>> 0023d8cc7e91667d0dc8c6f56aa46ab09d9e2e51
    }
}

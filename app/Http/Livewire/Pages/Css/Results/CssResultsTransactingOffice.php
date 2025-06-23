<?php

namespace App\Http\Livewire\Pages\Css\Results;
use Illuminate\Support\Facades\DB;
use App\Models\CssResponse;
use NumberToWords\NumberToWords;

use Livewire\Component;

class CssResultsTransactingOffice extends Component
{
    public $firstLargestClientTypeName;
    public $firstLargestClientTypeCount;
    public $secondLargestClientTypeName;
    public $secondLargestClientTypeCount;
    public $thirdLargestClientTypeName;
    public $thirdLargestClientTypeCount;

    public $firstLargestTransactingOfficeName;
    public $firstLargestTransactingOfficeCount;
    public $secondLargestTransactingOfficeName;
    public $secondLargestTransactingOfficeCount;
    public $thirdLargestTransactingOfficeName;
    public $thirdLargestTransactingOfficeCount;
    
    public $firstLowestTransactingOfficeName;
    public $firstLowestTransactingOfficeCount;
    public $secondLowestTransactingOfficeName;
    public $secondLowestTransactingOfficeCount;
    public $thirdLowestTransactingOfficeName;
    public $thirdLowestTransactingOfficeCount;
    public $PITAHCOverallRating;

    public $transacting_office_id;
    public $param1;
    public $param2;
    public $year;
    public $office;
    public $report_type_id;

    public $client_type;
    
    public function  mount($param1, $param2)
    {
        $this->year = $param1;
        $this->office = $param2;
        if( $this->office > 0 )
        {
            $client_type = DB::table('v_css_responses_detailed')->select('client_type_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('client_type_id')->orderBy('count', 'DESC')->take(3)->get();
            $transacting_office_desc = DB::table('v_css_responses_detailed')->select('transacting_office_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('transacting_office_id')->orderBy('count', 'DESC')->take(3)->get();
            $transacting_office_asc = DB::table('v_css_responses_detailed')->select('transacting_office_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('transacting_office_id')->orderBy('count', 'ASC')->take(3)->get();
            $pitahc_overall_rating = DB::table('v_average')->select(DB::raw('DISTINCT ROUND(overall_rating, 2) AS `overall_rating`'))->where('year_transacted', $this->year)->get();
        } else {
            $client_type = DB::table('v_css_responses_detailed')->select('client_type_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('client_type_id')->orderBy('count', 'DESC')->take(3)->get();
            $transacting_office_desc = DB::table('v_css_responses_detailed')->select('transacting_office_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('transacting_office_id')->orderBy('count', 'DESC')->take(3)->get();
            $transacting_office_asc = DB::table('v_css_responses_detailed')->select('transacting_office_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('transacting_office_id')->orderBy('count', 'ASC')->take(3)->get();
            $pitahc_overall_rating = DB::table('v_average')->select(DB::raw('DISTINCT ROUND(overall_rating, 2) AS `overall_rating`'))->where('year_transacted', $this->year)->get();
        }
       
        $this->firstLargestClientTypeName = $client_type[0]->client_type_name;
        $this->firstLargestClientTypeCount = $client_type[0]->count;
        $this->secondLargestClientTypeName = empty($client_type[1]->client_type_name) ? 0 : $client_type[1]->client_type_name;
        $this->secondLargestClientTypeCount = empty($client_type[1]->count) ? 0 : $client_type[1]->count;
        $this->thirdLargestClientTypeName = empty($client_type[2]->client_type_name) ? 0 : $client_type[2]->client_type_name;
        $this->thirdLargestClientTypeCount = empty($client_type[2]->count) ? 0 : $client_type[2]->count;
        
        $this->PITAHCOverallRating = $pitahc_overall_rating[0]->overall_rating;
    }


    public function convertNumberToWords($number)
    {
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en'); // Choose the desired locale
        $words = $numberTransformer->toWords($number);
        return $words;
    }
    
    public function respondents_sex_transacting_office($year, $office)
    {

        if( $office > 0 )
        {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'sex_type_name',
                DB::raw('count(*) as `count`')
            )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('sex_type_id')
            ->orderBy('sex_type_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'sex_type_name',
                DB::raw('count(*) as `count`')
            )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('sex_type_id')
            ->orderBy('sex_type_id', 'ASC')
            ->get();
        }
        
        return response()->json(['respondents_sex_transacting_office'=>$result], 200);
    }

    public function respondents_client_group_transacting_office($year, $office)
    {
        if( $office > 0 )
        {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'client_group_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('client_group_id')
            ->orderBy('client_group_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'client_group_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('client_group_id')
            ->orderBy('client_group_id', 'ASC')
            ->get(); 
        }
        
        return response()->json(['respondents_client_group_transacting_office'=>$result], 200);
    }

    public function respondents_client_type_transacting_office($year, $office)
    {
        if( $office > 0 )
        {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'client_type_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('client_type_id')
            ->orderBy('client_type_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'client_type_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('client_type_id')
            ->orderBy('client_type_id', 'ASC')
            ->get(); 
        }
        
        return response()->json(['respondents_client_type_transacting_office'=>$result], 200);
    }

    public function respondents_region_transacting_office($year, $office)
    {
        if( $office > 0 )
        {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'region_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('region_id')
            ->orderBy('region_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'region_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('region_id')
            ->orderBy('region_id', 'ASC')
            ->get(); 
        }
        
        return response()->json(['respondents_region_transacting_office'=>$result], 200);
    }

    public function respondents_awareness_response_transacting_office($year, $office)
    {
        if( $office > 0 )
        {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'awareness_response_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('awareness_response_id')
            ->orderBy('awareness_response_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'awareness_response_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('awareness_response_id')
            ->orderBy('awareness_response_id', 'ASC')
            ->get(); 
        }
        
        return response()->json(['respondents_awareness_response_transacting_office'=>$result], 200);
    }

    public function respondents_visibility_response_transacting_office($year, $office)
    {
        if( $office > 0 )
        {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'visibility_response_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('visibility_response_id')
            ->orderBy('visibility_response_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'visibility_response_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('visibility_response_id')
            ->orderBy('visibility_response_id', 'ASC')
            ->get(); 
        }
        
        return response()->json(['respondents_visibility_response_transacting_office'=>$result], 200);
    }

    public function respondents_helpfulness_response_transacting_office($year, $office)
    {
        if( $office > 0 )
        {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'helpfulness_response_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('helpfulness_response_id')
            ->orderBy('helpfulness_response_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'helpfulness_response_name',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('helpfulness_response_id')
            ->orderBy('helpfulness_response_id', 'ASC')
            ->get(); 
        }
        
        return response()->json(['respondents_helpfulness_response_transacting_office'=>$result], 200);
    }

    public function respondents_availed_service_transacting_office($year, $office)
    {
        if( $office > 0 ) {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'availed_service_name_short',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('availed_service_id')
            ->orderBy('availed_service_id', 'ASC')
            ->get();
        } else {
            $result = DB::table('v_css_responses_detailed')
            ->select(
                'availed_service_name_short',
                DB::raw('count(*) as `count`')
                )
            ->whereYear('date_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('availed_service_id')
            ->orderBy('availed_service_id', 'ASC')
            ->get();
        }        
        return response()->json(['respondents_availed_service_transacting_office'=>$result], 200);
    }

    public function ratings_transacting_office($year, $office)
    {
        if( $office )
        {
            $result = DB::table('v_ratings')
            ->select(
                'criteria',
                'year_transacted',
                DB::raw('ROUND(SUM(rating_6)/SUM(total_responses)*100, 2) AS `rating_6`'),
                DB::raw('ROUND(SUM(rating_5)/SUM(total_responses)*100, 2) AS `rating_5`'),
                DB::raw('ROUND(SUM(rating_4)/SUM(total_responses)*100, 2) AS `rating_4`'),
                DB::raw('ROUND(SUM(rating_3)/SUM(total_responses)*100, 2) AS `rating_3`'),
                DB::raw('ROUND(SUM(rating_2)/SUM(total_responses)*100, 2) AS `rating_2`'),
                DB::raw('ROUND(SUM(rating_1)/SUM(total_responses)*100, 2) AS `rating_1`')
                )
            ->where('year_transacted', $year)
            ->where('transacting_office_id', $office)
            ->groupBy('criteria', 'year_transacted')
            ->get();
        }else {
            $result = DB::table('v_ratings')
            ->select(
                'criteria',
                'year_transacted',
                DB::raw('ROUND(SUM(rating_6)/SUM(total_responses)*100, 2) AS `rating_6`'),
                DB::raw('ROUND(SUM(rating_5)/SUM(total_responses)*100, 2) AS `rating_5`'),
                DB::raw('ROUND(SUM(rating_4)/SUM(total_responses)*100, 2) AS `rating_4`'),
                DB::raw('ROUND(SUM(rating_3)/SUM(total_responses)*100, 2) AS `rating_3`'),
                DB::raw('ROUND(SUM(rating_2)/SUM(total_responses)*100, 2) AS `rating_2`'),
                DB::raw('ROUND(SUM(rating_1)/SUM(total_responses)*100, 2) AS `rating_1`')
                )
            ->where('year_transacted', $year)
            ->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])
            ->groupBy('criteria', 'year_transacted')
            ->get();
        }
        return response()->json(['ratings_transacting_office'=>$result], 200);
    }

    public function average_transacting_office($year, $office)
    {
        $pitahc_overall_rating = DB::table('v_average')->select(DB::raw('DISTINCT ROUND(overall_rating, 2) AS `overall_rating`'))->where('year_transacted', $year)->get();
        $a = $pitahc_overall_rating[0]->overall_rating;
        
        if( $office > 0 )
        {
            $result = DB::table('v_average_transacting_office')
            ->select(
                'criteria',
                'year_transacted',
                DB::raw('ROUND(average_rating, 2) AS `average_rating`'),
                DB::raw($a.' AS `overall_rating`')
                )
            ->where('year_transacted', $year)
            ->where('transacting_office_id', $office)
            ->get();
        }else {
            $result = DB::table('v_average_pitahc_alone')
            ->select(
                'criteria',
                'year_transacted',
                DB::raw('ROUND(average_rating, 2) AS `average_rating`'),
                DB::raw($a.' AS `overall_rating`')
                )
            ->where('year_transacted', $year)
            ->get();
        }
        
        return response()->json(['average_transacting_office'=>$result], 200);
    }
    
    public function render()
    {
        if( $this->office > 0 )
        {
            return view('livewire.pages.css.results.css-results-transacting-office', [
                'sex_types' => DB::table('v_css_responses_detailed')->select('sex_type_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('sex_type_id')->orderBy('sex_type_id', 'ASC')->get(),
                'client_groups' => DB::table('v_css_responses_detailed')->select('client_group_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('client_group_id')->orderBy('client_group_id', 'ASC')->get(),
                'client_types' => DB::table('v_css_responses_detailed')->select('client_type_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('client_type_id')->orderBy('client_type_id', 'ASC')->get(),
                'regions' => DB::table('v_css_responses_detailed')->select('region_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('region_id')->orderBy('region_id', 'ASC')->get(),
                'awareness_responses' => DB::table('v_css_responses_detailed')->select('awareness_response_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('awareness_response_id')->orderBy('awareness_response_id', 'ASC')->get(),
                'visibility_responses' => DB::table('v_css_responses_detailed')->select('visibility_response_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('visibility_response_id')->orderBy('visibility_response_id', 'ASC')->get(),
                'helpfulness_responses' => DB::table('v_css_responses_detailed')->select('helpfulness_response_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('helpfulness_response_id')->orderBy('helpfulness_response_id', 'ASC')->get(),
                'availed_services' => DB::table('v_css_responses_detailed')->select('availed_service_name_short', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('availed_service_id')->orderBy('availed_service_id', 'ASC')->get(),
                'services' => DB::table('v_ratings')->select('criteria', 'year_transacted', DB::raw('SUM(rating_6)/SUM(total_responses)*100 AS `rating_6`'), DB::raw('SUM(rating_5)/SUM(total_responses)*100 AS `rating_5`'), DB::raw('SUM(rating_4)/SUM(total_responses)*100 AS `rating_4`'), DB::raw('SUM(rating_3)/SUM(total_responses)*100 AS `rating_3`'), DB::raw('SUM(rating_2)/SUM(total_responses)*100 AS `rating_2`'), DB::raw('SUM(rating_1)/SUM(total_responses)*100 AS `rating_1`'))->where('year_transacted', $this->year)->where('transacting_office_id', $this->office)->groupBy('criteria', 'year_transacted')->get(),
                'averages' => DB::table('v_average_transacting_office')->select('criteria', 'year_transacted', DB::raw('ROUND(average_rating, 2) AS `average_rating`'), DB::raw('ROUND(overall_rating, 2) AS `overall_rating`'))->where('year_transacted', $this->year)->where('transacting_office_id', $this->office)->get(),
                'total_css_responses' => CssResponse::whereYear('date_transacted', $this->year)->where('status_type_id', 1)->where('transacting_office_id', $this->office)->count(),
                'total_male_css_responses' => CssResponse::whereYear('date_transacted', $this->year)->where('status_type_id', 1)->where('sex_type_id', '1')->where('transacting_office_id', $this->office)->count(),
                'total_female_css_responses' => CssResponse::whereYear('date_transacted', $this->year)->where('status_type_id', 1)->where('sex_type_id', '2')->where('transacting_office_id', $this->office)->count(),
            ]);
        }else{
            return view('livewire.pages.css.results.css-results-transacting-office', [
                'sex_types' => DB::table('v_css_responses_detailed')->select('sex_type_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('sex_type_id')->orderBy('sex_type_id', 'ASC')->get(),
                'client_groups' => DB::table('v_css_responses_detailed')->select('client_group_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('client_group_id')->orderBy('client_group_id', 'ASC')->get(),
                'client_types' => DB::table('v_css_responses_detailed')->select('client_type_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('client_type_id')->orderBy('client_type_id', 'ASC')->get(),
                'regions' => DB::table('v_css_responses_detailed')->select('region_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('region_id')->orderBy('region_id', 'ASC')->get(),
                'awareness_responses' => DB::table('v_css_responses_detailed')->select('awareness_response_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('awareness_response_id')->orderBy('awareness_response_id', 'ASC')->get(),
                'visibility_responses' => DB::table('v_css_responses_detailed')->select('visibility_response_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('visibility_response_id')->orderBy('visibility_response_id', 'ASC')->get(),
                'helpfulness_responses' => DB::table('v_css_responses_detailed')->select('helpfulness_response_name', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('helpfulness_response_id')->orderBy('helpfulness_response_id', 'ASC')->get(),
                'availed_services' => DB::table('v_css_responses_detailed')->select('availed_service_name_short', DB::raw('count(*) as `count`'))->whereYear('date_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('availed_service_id')->orderBy('availed_service_id', 'ASC')->get(),
                'services' => DB::table('v_ratings')->select('criteria', 'year_transacted', DB::raw('SUM(rating_6)/SUM(total_responses)*100 AS `rating_6`'), DB::raw('SUM(rating_5)/SUM(total_responses)*100 AS `rating_5`'), DB::raw('SUM(rating_4)/SUM(total_responses)*100 AS `rating_4`'), DB::raw('SUM(rating_3)/SUM(total_responses)*100 AS `rating_3`'), DB::raw('SUM(rating_2)/SUM(total_responses)*100 AS `rating_2`'), DB::raw('SUM(rating_1)/SUM(total_responses)*100 AS `rating_1`'))->where('year_transacted', $this->year)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->groupBy('criteria', 'year_transacted')->get(),
                'averages' => DB::table('v_average_pitahc_alone')->select('criteria', 'year_transacted', DB::raw('ROUND(average_rating, 2) AS `average_rating`'), DB::raw('ROUND(overall_rating, 2) AS `overall_rating`'))->where('year_transacted', $this->year)->get(),
                'total_css_responses' => CssResponse::whereYear('date_transacted', $this->year)->where('status_type_id', 1)->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->count(),
                'total_male_css_responses' => CssResponse::whereYear('date_transacted', $this->year)->where('status_type_id', 1)->where('sex_type_id', '1')->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->count(),
                'total_female_css_responses' => CssResponse::whereYear('date_transacted', $this->year)->where('status_type_id', 1)->where('sex_type_id', '2')->whereIn('transacting_office_id', [1, 2, 3, 4, 5, 6, 10, 11])->count(),
            ]);
        }
        
        
    }
}

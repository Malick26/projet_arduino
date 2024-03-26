<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Luminosite;
use DB;

class HomeController extends Controller
{
    // Méthode pour récupérer les valeurs de la colonne 'value' de la table 'luminosites'
    public function getValues()
    {
        return Luminosite::pluck('value')->toArray();
    }

    // Méthode pour récupérer les données pour le graphique
    public function getChartData()
    {
        $visitor = Luminosite::select(
                        DB::raw("SECOND(created_at) as second"),
                        DB::raw("SUM(value) as total_click"))
                      ->orderBy(DB::raw("SECOND(created_at) "))
                      ->groupBy(DB::raw("SECOND(created_at) "))
                      ->get();

        $result[] = ['Second','value'];
        foreach ($visitor as $key => $value) {
            $result[++$key] = [(int)$value->second, (int)$value->total_click];
        }

        return json_encode($result);
    }

    // Méthode pour afficher la page avec le graphique et les valeurs
    public function index()
    {
        $visitor = $this->getChartData();
        $values = $this->getValues();

        return view('google-line-chart', compact('visitor', 'values'));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unidade;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidade::create( [
            'sigla'=>'BCCL'
            ] );

            Unidade::create( [
            'sigla'=>'CAISM'
            ] );

            Unidade::create( [
            'sigla'=>'CC'
            ] );

            Unidade::create( [
            'sigla'=>'CEMIB'
            ] );

            Unidade::create( [
            'sigla'=>'CESET'
            ] );

            Unidade::create( [
            'sigla'=>'CLE'
            ] );

            Unidade::create( [
            'sigla'=>'COTIL'
            ] );

            Unidade::create( [
            'sigla'=>'COTUCA'
            ] );

            Unidade::create( [
            'sigla'=>'CPQBA'
            ] );

            Unidade::create( [
            'sigla'=>'CSS'
            ] );

            Unidade::create( [
            'sigla'=>'CT'
            ] );

            Unidade::create( [
            'sigla'=>'DEDIC'
            ] );

            Unidade::create( [
            'sigla'=>'FCA'
            ] );

            Unidade::create( [
            'sigla'=>'FCF'
            ] );

            Unidade::create( [
            'sigla'=>'FCM'
            ] );

            Unidade::create( [
            'sigla'=>'FE'
            ] );

            Unidade::create( [
            'sigla'=>'FEA'
            ] );

            Unidade::create( [
            'sigla'=>'FEAGRI'
            ] );

            Unidade::create( [
            'sigla'=>'FECFAU'
            ] );

            Unidade::create( [
            'sigla'=>'FEEC'
            ] );

            Unidade::create( [
            'sigla'=>'FEF'
            ] );

            Unidade::create( [
            'sigla'=>'FEM'
            ] );

            Unidade::create( [
            'sigla'=>'FENF'
            ] );

            Unidade::create( [
            'sigla'=>'FEQ'
            ] );

            Unidade::create( [
            'sigla'=>'FOP'
            ] );

            Unidade::create( [
            'sigla'=>'FT'
            ] );

            Unidade::create( [
            'sigla'=>'HC'
            ] );

            Unidade::create( [
            'sigla'=>'HEMO'
            ] );

            Unidade::create( [
            'sigla'=>'IA'
            ] );

            Unidade::create( [
            'sigla'=>'IB'
            ] );

            Unidade::create( [
            'sigla'=>'IC'
            ] );

            Unidade::create( [
            'sigla'=>'IE'
            ] );

            Unidade::create( [
            'sigla'=>'IEL'
            ] );

            Unidade::create( [
            'sigla'=>'IFCH'
            ] );

            Unidade::create( [
            'sigla'=>'IFGW'
            ] );

            Unidade::create( [
            'sigla'=>'IG'
            ] );

            Unidade::create( [
            'sigla'=>'IMECC'
            ] );

            Unidade::create( [
            'sigla'=>'IQ'
            ] );

            Unidade::create( [
            'sigla'=>'REIT'
            ] );

            Unidade::create( [
            'sigla'=>'RTV'
            ] );

            Unidade::create( [
            'sigla'=>'PROEC'
            ] );

            Unidade::create( [
            'sigla'=>'DTIC'
            ] );

            Unidade::create( [
            'sigla'=>'COCEN'
            ] );

            Unidade::query()->update([
                'nome' => Unidade::raw('sigla'), // SQL: UPDATE unidades SET nome = sigla;
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}

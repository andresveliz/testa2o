<?php

namespace App\Custom;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class Exercises
{
    public function problem_one(Request $request){
       
        $teams = array();
        $matchs = array();
        $collection = collect($request->array);
        $home = array();
        $visit = array();
        $names = array();
       // $txc = array();
        //formatting array
        
        foreach( $collection as $co){
            
            $names[] = explode(' ',$co); //array partition
        }
        $category =  $names[0];
        
        for($i=1; $i< count($names); $i++)
        {
            
            if($names[$i] == ["FIN"]){
                $category = $names[$i+1];
                $i=$i+2; 
               
            }
            //formatting every match with results 
            $matchs[] = array('category'=>$category[0],'team1'=>$names[$i][0], 'res1'=>$names[$i][1], 'team2'=>$names[$i][2], 'res2' =>$names[$i][3]); //cambiando el termino team por matchs
            $home[] = array('category'=> $category[0], 'team'=>$names[$i][0]);
            $visit[] = array('category'=> $category[0], 'team'=>$names[$i][2]);
        }
        
        $teams = array_merge($home, $visit);
        $txc = collect($teams)->unique('team')->values();
        $tsxc = $txc->countBy('category');
        $win = 0;
        $lose = 0;
        $tie = 0;
        $sum = array();
        $table = array();
        
    
        //selecting winners and loosers

        for($i=0; $i< count($txc); $i++)
        {
            foreach($matchs as $tm)
            {
                if( $txc[$i]['team'] == $tm['team1'] || $txc[$i]['team'] == $tm['team2'])
                {
                    if($txc[$i]['team'] == $tm['team1'])
                    {
                        if($tm['res1'] > $tm['res2'])
                        {
                            $win++;
                        }
                        else {
                            $lose++;
                        }
                    }

                    if($txc[$i]['team'] == $tm['team2'])
                    {
                        if($tm['res2'] > $tm['res1'])
                        {
                            $win++;
                        }
                        else{
                            $lose++;
                        }
                    }
                    $table[] =array('team'=>$txc[$i]['team'],'category'=>$tm['category'] ,'win'=>$win, 'lose'=>$lose);  
                    $win = 0;
                    $lose = 0;
                    
                }
            }
        }
        
        $collection2 = collect($table);
        $collection3 = collect($sum);
        foreach($collection2 as $coll )
        {
        $filtered = $collection2->where('team', $coll['team']);
        $collection3->push(['team'=>$coll['team'], 
                            'category'=> $coll['category'], 
                            'points'=> ($filtered->sum('win')*2) + ($filtered->sum('lose')),
                            'tie'=>(( ( ($tsxc[$coll['category']] *2) -2) - ($filtered->sum('win')) - ($filtered->sum('lose')) )),
                            'noMatch' => ($tsxc[$coll['category']] * ($tsxc[$coll['category']]-1)) - collect($matchs)->countBy('category')[$coll['category']]  ]);
        }
               
        $result = $collection3->keyBy('team')->sortByDesc('points')->groupBy('category');
         
       return response()->json($result);
       
    }

    public function queensAttack(Request $request)
    {
        
        $obstacles = ($request->obstacles);
        $rq = $request->rq;
        $cq = $request->cq;
        $x = $rq - $cq;
        $y = $rq + $cq;
        $board =$request->n;
        $obs = $request->k;
        $n = 1;
        $i = 0;
        $state = 0;   
        
        $vu = 0; $vd = 0; $vl = 0; $vr = 0;
        $vesd = 0; $vesi = 0; $veid = 0 ; $veii = 0;
        $values = array();

        //up options
        for($n=$rq+1; $n<=$board; $n++)
        {
            $up = array($n, $cq);
            if($state == 0)
            {
                if(in_array($up, $obstacles))
                {
                    $state = 1;
                }
                else{
                    $vu++;
                    $values = Arr::prepend($values, $up);
                }
            }
        }
        $state = 0; 
        
        //down options
        for($n =$rq-1; $n>0; $n--)
        {
            $down = array($n, $cq);
            if($state == 0)
            {
                if(in_array($down, $obstacles))
                {
                    $state = 1;
                }
                else {
                    $vd++;
                    $values = Arr::prepend($values, $down);
                }  
            }
        }
        $state = 0;
        //right options
        for($n =$cq+1; $n <= $board; $n++)
        {
            $right = array($rq, $n);
            if($state == 0)
            {
                if(in_array($right,$obstacles))
                {
                    $state = 1;
                }
                else {
                    $vr++;
                    $values = Arr::prepend($values, $right);
                }
            }
        }
        $state = 0;
        //left options
        for($n= $cq-1; $n > 0; $n--)
        {
            $left = array($rq, $n);
            if( $state == 0)
            {
                if(in_array($left,$obstacles))
                {
                    $state = 1;
                }  
                else {
                    $vl++;
                    $values = Arr::prepend($values, $left);
                }
            }    
        }
        $state = 0;
        //right upper corner options
        for($n=$rq+1; $n<=$board; $n++)
        {
            for($k=$cq+1; $k<=$board; $k++)
            {
                if( ($n - $k) == $x)
                {
                    $esd = array($n, $k); 
                    if($state == 0)
                    {
                        if(in_array($esd, $obstacles))
                        {
                            $state = 1;
                        }
                        else {
                            $vesd++;
                            $values = Arr::prepend($values, $esd);
                        }
                    }
                }
            }  
                 
        }
        $state = 0;
        //left  upper corner options
        for($n = $rq+1; $n<=$board; $n++)
        {
            for($k=$cq-1; $k> 0; $k--)
            {
                if( ($n + $k) == $y)
                {
                    $esi = array($n, $k);
                    if($state == 0)
                    { 
                        if(in_array($esi, $obstacles))
                        {
                            $state = 1;   
                        }
                        else{
                            $vesi++;
                            $values = Arr::prepend($values, $esi);
                        }
                        
                    }      
                    
                };
            }
        }
        $state = 0;
        //lower right corner options
        for($n=$rq-1; $n>0; $n--)
        {
            for($k=$cq+1; $k<=$board; $k++)
            {
                if( ($n + $k) == $y)
                {
                    $eid = array($n, $k);
                    if($state == 0)
                    {
                        if(in_array($eid, $obstacles))
                        {
                            $state = 1;
                        }
                        else {
                            $veid++;
                            $values = Arr::prepend($values, $eid);
                        }
                    }
                }
            }
        }
        $state = 0;
        //lower left corner options
        for($n =$rq-1; $n > 0 ; $n--)
        {
            for($k=$cq-1; $k > 0; $k--)
            {
                if( ($n - $k) == $x)
                {
                    $eii = array($n, $k);
                    if($state == 0)
                    {
                        if(in_array($eii, $obstacles))
                        {
                            $state = 1;
                        }
                        else {
                            $veii++;
                            $values = Arr::prepend($values,$eii);
                        }
                    }
                }    
            }
        
        
        }
        
        $total = $vu+$vd+$vr+$vl+$vesd+$vesi+$veid+$veii;
        return response()->json(($total));

    }


    function stringValue(Request $request)
    {
        $t = $request->t;
        $s;
        $arrComb = array();
        
        for($i=1; $i<= strlen($t); $i++)
        {
            for($j=0; $j<strlen($t); $j++)
            {
               $s = substr($t, $j, $i); 
               if(strlen($s) == $i)
               {
               $arrComb[] = array('s'=>$s); 
               }
            }
        }
        $collection = collect($arrComb);
        $counted = $collection->countBy();
        $final = $counted->map(function ($item, $key){
           return ($item* strlen($key));
        });

        return response()->json($final->max());

    }
} 
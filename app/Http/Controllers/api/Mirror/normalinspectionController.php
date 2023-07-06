<?php

namespace App\Http\Controllers\api\Mirror;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeautyMirror\NormalInspection;
use App\Models\BeautyMirror\Standard;
use App\Models\Beauty\Tag;
use DB;

class normalinspectionController extends Controller
{
    public $collect;
    public $data20230214;
    public $data20230215;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function searchInR($min,$max)
    {
        $collect=$this->collect->where('bmni_result_rating','>',$min)->where('bmni_result_rating','<=',$max)->count();
        return $collect;
    }

    public function searchWithDate($min,$max)
    {
        $collect=$this->collect->where('created_at','>',$min)->where('created_at','<=',$max);
        return $collect;
    }


    public function index()
    {
        $normalinspections=NormalInspection::orderBy('bmni_id','desc')->get();
        $normalinspections_limit=$normalinspections;
        $inspections=count($normalinspections);
        if($inspections>=2)
        {
            $data=NormalInspection::orderBy('bmni_result_rating','asc')->get();
            $this->collect=collect($data);

            $mid=$this->collect->avg('bmni_result_rating');
            $min=$this->collect->min('bmni_result_rating');
            $max=$this->collect->max('bmni_result_rating');

            $worst=$this->collect->where('bmni_result_rating','>=','100')->count();
            $best=$this->collect->where('bmni_result_rating','<=','50')->count();

            $dataIn10to30=$this->searchInR(10,30);
            $dataIn31to50=$this->searchInR(30,50);
            $dataIn51to70=$this->searchInR(50,70);
            $dataIn71to90=$this->searchInR(70,90);
            $dataMoreThan91=$this->searchInR(90,200);
            //$total=$collect->count();

            $this->data20230214=$this->searchWithDate('2023-02-14 00:00:00','2023-02-14 23:59:59');
            $data20230214_mid=$this->data20230214->avg('bmni_result_rating');//->count();

            $this->data20230215=$this->searchWithDate('2023-02-15 00:00:00','2023-02-15 23:59:59');
            $data20230215_mid=$this->data20230215->avg('bmni_result_rating');//->count();

            $this->data20230216=$this->searchWithDate('2023-02-16 00:00:00','2023-02-16 23:59:59');
            $data20230216_mid=$this->data20230216->avg('bmni_result_rating');//->count();

            $this->data20230217=$this->searchWithDate('2023-02-17 00:00:00','2023-02-17 23:59:59');
            $data20230217_mid=$this->data20230217->avg('bmni_result_rating');//->count();

            $this->data20230220=$this->searchWithDate('2023-02-20 00:00:00','2023-02-20 23:59:59');
            $data20230220_mid=$this->data20230220->avg('bmni_result_rating');//->count();
        }




        return response()->json(['result'=>$normalinspections_limit,
                                'data_all'=>['min'=>$min,
                                            'mid'=>$mid,
                                            'max'=>$max,
                                            'counts'=>$inspections,
                                            'worst'=>$worst,
                                            'best'=>$best,
                                            'dataIn10to30'=>$dataIn10to30,
                                            'dataIn31to50'=>$dataIn31to50,
                                            'dataIn51to70'=>$dataIn51to70,
                                            'dataIn71to90'=>$dataIn71to90,
                                            'dataMoreThan91'=>$dataMoreThan91,
                                            'data20230214_mid'=>$data20230214_mid,
                                            'data20230215_mid'=>$data20230215_mid,
                                            'data20230216_mid'=>$data20230216_mid,
                                            'data20230217_mid'=>$data20230217_mid,
                                            'data20230220_mid'=>$data20230220_mid,
                                ]
                                        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inspection=new NormalInspection;
        $inspection->bmni_head=$request->bmni_head;

        $inspection->bmni_eyebrow=$request->bmni_eyebrow;

        $inspection->bmni_fishtail_b=$request->bmni_fishtail_b;
        $inspection->bmni_fishtail_c=$request->bmni_fishtail_c;

        $inspection->bmni_tears_b=$request->bmni_tears_b;
        $inspection->bmni_tears_c=$request->bmni_tears_c;

        $inspection->bmni_nasolabial_d=$request->bmni_nasolabial_d;
        $inspection->bmni_nasolabial_e=$request->bmni_nasolabial_e;

        $inspection->bmni_mouth=$request->bmni_mouth;

        $inspection->bmni_skin_a=$request->bmni_skin_a;
        $inspection->bmni_skin_b=$request->bmni_skin_b;
        $inspection->bmni_skin_e=$request->bmni_skin_e;
        $inspection->bmni_skin_f=$request->bmni_skin_f;

        $inspection->bmni_pigmentation_a=$request->bmni_pigmentation_a;
        $inspection->bmni_pigmentation_b=$request->bmni_pigmentation_b;

        $inspection->bmni_pandaeye_b=$request->bmni_pandaeye_b;
        $inspection->bmni_pandaeye_c=$request->bmni_pandaeye_c;

        $inspection->bmni_acne_a=$request->bmni_acne_a;
        $inspection->bmni_acne_b=$request->bmni_acne_b;
        $inspection->bmni_acne_c=$request->bmni_acne_c;
        $inspection->bmni_acne_d=$request->bmni_acne_d;

        $inspection->bmni_waterOil_d=$request->bmni_waterOil_d;
        $inspection->bmni_waterOil_e=$request->bmni_waterOil_e;

        $inspection->created_at=date('Y-m-d H:i:s');
        //$kid_can_rand=['14','23','25','27','28','29','30','31','32'];
        $rand=rand(8,314);
        $inspection->k_id=$rand;
        $inspection->save();

        $inspection_id=$inspection->bmni_id;
        $result=$this->transferToApi($inspection_id);

        //結算所有排名分數
        $simple_result=NormalInspection::where('bmni_id',$inspection_id)->first();

        $finalresult=(($result['finalresult_acne']+$result['finalresult_pandaeye']+$result['finalresult_pigmentation']
        +$result['finalresult_skin']+$result['finalresult_waterOil']+$result['finalresult_wrinkle'])/6)*2;

        $searching_underUserCount=NormalInspection::where('bmni_result_rating','<',$finalresult)->count();
        $AllUserCount=NormalInspection::all()->count();
        $current_ranking=round($searching_underUserCount/$AllUserCount *100,10);
        $current_ranking=round(100-$current_ranking,2);

        $simple_result->bmni_result_rating=$finalresult;
        $simple_result->bmni_result_ranking=$current_ranking;
        $simple_result->updated_at=date('Y-m-d H:i:s');
        $simple_result->save();


        return response()->json(['result'=>$simple_result]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $result=$this->transferToApi($id);
        //dd($test);
        return response()->json([

            'wrinkle'=>[
                'id'=>$result['waterOil_id'],
                'name'=>$result['wrinkle_name'],
                'level'=>$result['wrinkle_data'],
                'data'=>$result['wrinkle_data'],
            ],

            'skin'=>[
                'id'=>$result['skin_id'],
                'name'=>$result['skin_name'],
                'level'=>$result['skin_level'],
                'data'=>$result['skin_data'],
            ],

            'pigmentation'=>[
                'id'=>$result['pigmentation_id'],
                'name'=>$result['pigmentation_name'],
                'level'=>$result['pigmentation_level'],
                'data'=>$result['pigmentation_data'],
            ],

            'pandaeye'=>[
                'id'=>$result['pandaeye_id'],
                'name'=>$result['pandaeye_name'],
                'level'=>$result['pandaeye_level'],
                'data'=>$result['pandaeye_data'],
            ],

            'acne'=>[
                'id'=>$result['acne_id'],
                'name'=>$result['acne_name'],
                'level'=>$result['acne_level'],
                'data'=>$result['acne_data'],
            ],

            'waterOil'=>[
                'id'=>$result['waterOil_id'],
                'name'=>$result['waterOil_name'],
                'level'=>$result['waterOil_level'],
                'data'=>$result['waterOil_data'],
            ],
            'finalresult'=>[
                'rating'=>$result['finalresult'],
                'ranking'=>$result['ranking'],
            ],
            'rawdata' =>$result['raw']], 200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete()
    {

    }

    public function transferToApi($id)
    {
        $wrinkle_id=129;
        $skin_id=124;
        $pigmentation_id=125;
        $pandaeye_id=91;
        $acne_id=53;
        $waterOil_id=126;


        $simple_result=NormalInspection::where('bmni_id',$id)->first();

        //皺紋
        $wrinkle_data=($simple_result->bmni_head
                +$simple_result->bmni_eyebrow
                +$simple_result->bmni_fishtail
                +$simple_result->bmni_tears
                +$simple_result->bmni_nasolabial
                +$simple_result->bmni_mouth)/6;
        $finalresult_wrinkle=$wrinkle_data*10;
        $wrinkle=Tag::where('bp_tag_id',$wrinkle_id)->first();
        $wrinkle_name=$wrinkle->bp_hashtag;


        //膚色
        $skin_data=round(($simple_result->bmni_skin_a
                    +$simple_result->bmni_skin_b
                    +$simple_result->bmni_skin_e
                    +$simple_result->bmni_skin_f)/4);
        $skin=Standard::where('bp_tag_id','124')
        ->where(function($query) use ($skin_data){
            $query->where('bms_lower','<=',$skin_data);
            $query->where('bms_upper','>=',$skin_data);
        })
        ->with('Tag')
        ->first();
        $skin_level=$skin->bms_lv;
        $skin_name=$skin->tag->bp_hashtag;
        //計算排名分數
        switch($skin_level)
        {
            case(1):
                $finalresult_skin=$skin_data -10;
                break;
            case(2):
                $finalresult_skin=$skin_data-10;
                break;
            case(3):
                $finalresult_skin=$skin_data+121;
                break;
        }


        //色斑
        $pigmentation_data=round(($simple_result->bmni_pigmentation_a
                        +$simple_result->bmni_pigmentation_b)/2) ;
        $pigmentation=Standard::where('bp_tag_id','125')
        ->where(function($query) use ($pigmentation_data){
            $query->where('bms_lower','<=',$pigmentation_data);
            $query->where('bms_upper','>=',$pigmentation_data);
        })
        ->with('Tag')
        ->first();
        $pigmentation_level=$pigmentation->bms_lv;
        $pigmentation_name=$pigmentation->tag->bp_hashtag;
        //計算排名分數
        $finalresult_pigmentation=100-$pigmentation_data;


        //黑眼圈
        $pandaeye_data=round(($simple_result->bmni_pandaeye_b
                    +$simple_result->bmni_pandaeye_c)/2);
        $pandaeye=Standard::where('bp_tag_id','91')
        ->where(function($query) use ($pandaeye_data){
            $query->where('bms_lower','<=',$pandaeye_data);
            $query->where('bms_upper','>=',$pandaeye_data);
        })
        ->with('Tag')
        ->first();
        $pandaeye_level=$pandaeye->bms_lv;
        $pandaeye_name=$pandaeye->tag->bp_hashtag;
        //計算排名分數
        $finalresult_pandaeye=$pandaeye_data*10;


        //青春痘
        $acne_data=round(($simple_result->bmni_acne_a + $simple_result->bmni_acne_b
                    +$simple_result->bmni_acne_c+ $simple_result->bmni_acne_d)/4);
        $acne=Standard::where('bp_tag_id','53')
        ->where(function($query) use ($acne_data){
            $query->where('bms_lower','<=',$acne_data);
            $query->where('bms_upper','>=',$acne_data);
        })
        ->with('Tag')
        ->first();
        $acne_level=$acne->bms_lv;
        $acne_name=$acne->tag->bp_hashtag;
        //計算排名分數
        $finalresult_acne=$acne_data*10;


        //水油平衡
        if($simple_result->bmni_waterOil_d == $simple_result->bmni_waterOil_e)
        {
            $waterOil_data=$simple_result->bmni_waterOil_d;
            $waterOil=Standard::where('bp_tag_id','126')
            ->where(function($query) use ($waterOil_data){
                $query->where('bms_lower','<=',$waterOil_data);
                $query->where('bms_upper','>=',$waterOil_data);
            })
            ->with('Tag')
            ->first();
            $waterOil_level=$waterOil->bms_lv;
            $waterOil_name=$waterOil->tag->bp_hashtag;
        }
        else
        {
            $waterOil_data=$simple_result->bmni_waterOil_d;
            $waterOil=Tag::where('bp_tag_id',$waterOil_id)->first();
            $waterOil=Standard::where('bp_tag_id','126')->with('Tag')->first();
            $waterOil_name=$waterOil->tag->bp_hashtag;
            $waterOil_level=2;
        }

        //計算排名分數
        switch($waterOil_level)
        {
            case(1):
                $finalresult_waterOil=$waterOil_data-8;
                break;
            case(2):
                $finalresult_waterOil=rand(10,11);
                break;
            case(3):
                $finalresult_waterOil=$waterOil_data+12;
            case(4):
                $finalresult_waterOil=$waterOil_data+8;
        }

/*         //結算所有排名分數
        $finalresult=(($finalresult_acne+$finalresult_pandaeye+$finalresult_pigmentation
        +$finalresult_skin+$finalresult_waterOil+$finalresult_wrinkle)/6)*2;
 */

        $result=[

            'wrinkle_id'=>$wrinkle_id,
            'skin_id'=>$skin_id,
            'pigmentation_id'=>$pigmentation_id,
            'pandaeye_id'=>$pandaeye_id,
            'acne_id'=>$acne_id,
            'waterOil_id'=>$waterOil_id,

            'wrinkle_name'=>  $wrinkle_name,
            'skin_name'=> $skin_name,
            'pigmentation_name'=> $pigmentation_name,
            'pandaeye_name'=> $pandaeye_name,
            'acne_name'=> $acne_name,
            'waterOil_name'=> $waterOil_name,


            'skin_level'=> $skin_level,
            'pigmentation_level'=> $pigmentation_level,
            'pandaeye_level'=> $pandaeye_level,
            'acne_level'=> $acne_level,
            'waterOil_level'=> $waterOil_level,

            'wrinkle_data'=>$wrinkle_data,
            'skin_data'=>$skin_data,
            'pigmentation_data'=>$pigmentation_data,
            'pandaeye_data'=>$pandaeye_data,
            'acne_data'=>$acne_data,
            'waterOil_data'=>$waterOil_data,

            'finalresult'=>$simple_result->bmni_result_rating,
            'ranking'=>$simple_result->bmni_result_ranking,

            'finalresult_acne'=>$finalresult_acne,
            'finalresult_pandaeye'=>$finalresult_pandaeye,
            'finalresult_pigmentation'=>$finalresult_pigmentation,
            'finalresult_skin'=>$finalresult_skin,
            'finalresult_waterOil'=>$finalresult_waterOil,
            'finalresult_wrinkle'=>$finalresult_wrinkle,

            'raw'=>$simple_result,
        ];
        return $result;
    }

}

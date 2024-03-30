<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Helpers\Helper;
use Auth;
use yajra\Datatables\Datatables;
use App\Traits\ImageTrait;
use DB;
//use OpenAI;
use GuzzleHttp\Client;
use OpenAI\Laravel\Facades\OpenAI;
use Config;



class HomeController extends Controller
{
   public function __construct()
    {
        //$this->middleware('auth');
    }


    public function generateAiContent(Request $request)
    {
    	 //$OPENAI_API_KEY=Config::get('openai.api_key');
         //$client = OpenAI::client($OPENAI_API_KEY);

        $course=$request->course_title;

        if($course)
        {

            $result = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                    ['role' => 'user', 'content' => $course],
                ],
                   // 'prompt' => 'computer science',
                ]);

             // $result = OpenAI::completions()->create([
             //        'model' => 'gpt-3.5-turbo-instruct',
                   
             //        'prompt' => 'computer science',
             //    ]);

            // print_r($result);
            // dd();

            $content=$result->choices[0]->message->content;
            $description=explode(".",$content);
            $content_array=[];

            if($description)
            {
                 foreach ($description as $key => $value) {
                     // code...

                    if($key==0)
                    {
                        $content_array['short_description']=$string = str_replace('   ', '', $value);
                    }

                    if($key==1)
                    {
                        $content_array['out_comes']=str_replace('   ','', $value);
                    }

                    if($key==2)
                    {
                        $content_array['requirments']=str_replace('   ', '', $value);
                    }

                    if($key==3)
                    { 
                        $content_array['course_description']=str_replace('  ', '', $value);
                    }
                      

                 }

            }


         //   print_r($content_array);
          //  dd();

        
             //echo $result['choices'][0]['text'];


               return response()->json(['status'=>true,'errorCode'=>-1,'result' =>$content_array], 200); 

        }
        else
        {
              return response()->json(['status'=>false,'errorCode'=>-1,'message' => 'Please enter course title'], 200); 
        }


     

        //print_r($result);

       // dd();
        //echo $result->choices[0]->message->content;

        //echo $result['choices'][0]['text'];

        // dd();  


       
              

        
	

	





















    }
   

}
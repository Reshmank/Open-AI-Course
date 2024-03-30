@extends('layouts.app_test')


@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Course Title</label>
    <input type="text" class="form-control" id="course_title"  placeholder="Enter Course Title">
   
  </div><a href="#" class="btn btn-success" id="generateAi">Generate AI Content</a>
  <br>
  <div class="form-group">
    <label for="exampleInputPassword1">Short Description</label>
    <textarea class="form-control" id="short_description"></textarea>
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">OutComes</label>
    <textarea class="form-control" id="outcomes"></textarea>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Requirements</label>
    <textarea class="form-control" id="requirments"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Course Description</label>
    <textarea class="form-control" id="course_description"></textarea>
  </div>
  
 
</form>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')

<script type="text/javascript">
    
// alert('kk');

     $(document).ready(function(){

         $("#course_title").keyup(function () {  
                $('#course_title').css('textTransform', 'capitalize');  
            });  


           $('#course_title').on('keydown', function () {

                if($('#course_title').val()=='')
                {
                     $('#short_description').html(''); 
                     $('#outcomes').html('');
                     $('#requirments').html('');
                     $('#course_description').html('');
                }

              

           });

        
        $('#generateAi').on('click', function () {

                 var course_title=$('#course_title').val();

                 if(course_title)
                 {
                         $.ajax({
                             
                             url: '/generate-ai-content',
                             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                           
                            data: {
                                course_title:course_title,
                               
                            },
                            success: function (output) { 

                                if(output.status==true)
                                {
                                     data=output.result;

                                     $('#short_description').html(data['short_description']);
                                     $('#outcomes').html(data['out_comes']);
                                     $('#requirments').html(data['requirments']);
                                     $('#course_description').html(data['course_description']);



                                      
                                     // alert(data['short_description']);

                                     // var i;
                                     //    for (i = 0; i < output.result.length; ++i) {
                                     //        // do something with `substr[i]`
                                     //    }
                                }
                                else
                                {
                                      alert('Please enter course title');
                                }

                                 

                            }

                        });



                 }
                 else
                 {
                      alert('Please enter course title');
                 }


              });


     });


</script>




@endsection

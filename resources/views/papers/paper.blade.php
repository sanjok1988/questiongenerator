<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ asset('cms/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <style>
        table {
            border-spacing: 32px;
            }
        </style>
  </head>
  <body>

			
<div class="row">
<div class="col-md-12" style="text-align:center">
<h1>UCSI</h1>
    <h4><u>UNIVERSITY</u></h4>
<h3>FACULTY OF BUSINESS AND INIFORMATION CENTER</h3>
  
  <h3>{{$examDetails->exam_type }}</h3>
  <h3>Course Code And Name: {{ $course_code }}{{ " ".$subject}}</h3>
  <H3>Semester : {{$examDetails->semester}}</H3>
  <h5>Full Mark: {{$examDetails->fm}}</h5>
  <h5>Pass Mark: {{$examDetails->pm}}</h5>
  <h5>Exam Date: {{$examDetails->date}}</h5>

  <hr>
  <br>
</div>
    
</div>

   
		
<div class="row">

    <div class="container">

<h4>Attempt <u>All</u> Questions</h4>
 
     <table width="100%">
             <?php $i=1;?>
            @foreach($q as $post)         
     
             <tr>
                <td width="2%"><?php echo $i++;?>)</td>
	        <td><?php echo $post->text;?></td>                
            </tr>
                @endforeach
        
        </table>
        
    </div>
</div>
           
		
  </body>
</html>
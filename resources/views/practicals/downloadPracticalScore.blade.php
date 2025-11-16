
<!DOCTYPE html>
<html>
    <head>
        <title>Scholarship Letter</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                 text-align: left;
               
            }
            thead {
                background-color: #000033;
                color: white;
                 text-align: left;
            }
            th, td {
                border: 1px solid #000033;
                 text-align: left;
            }
            *{
                 font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                 font-weight: 600;
            }
            ol li{
                list-style-type: none;
            }
            td,th{
                padding:5px;
            }
        </style>
    </head>
    <body>
               <center>
                     <img src="{{ $imageSrc }}" width="120px">
                     <h1 style="color:#07294d">TECHSPHERE TRAINING INSTITUTE</h1>
                     <p style="font-size:17px; border-bottom:4px solid #07294d">
                        View Park Towers 17th Floor, University way | P. O. Box 1334-00618, Nairobi<br>
                        Web:   <b style="color:blue;"><u>https://www.techsphereinstitute.co.ke</u></b>   |Email: <b style="color:blue;"><u>Info@techsphereinstitute.co.ke </u></b>|<br>
                        Phone: <b style="color:#33d6ff">+254768919307</b>

                     </p>
                </center>

                <table>
                    <tr>
                        <td>Exam : {{$exam->name ?? ''}}</td>
                        <td>Class: {{$exam->clas->clas_name ?? ''}}</td>
                    </tr>
                </table>


             
               
               <table style="width:100%" style="border:1px solid black !important">

                  <thead style="background-color:#07294d !important;color:white">
                       <th>No</th>
                       <th>Name</th>
                       <th>Course/Program</th>
                       <th>Score/{{$ovaral_score ?? ''}}</th>
                  </thead>

                  <tbody>
                    @foreach($students as $key=>$student)
                    <tr style="border:1px solid black !important">
                        <td><b>{{$key+1}}</b></td>
                        <td>{{$student->user->firstname ?? '' }} {{$student->user->secondname ?? '' }} {{$student->user->lastname ?? '' }}</td>
                        <td><b>{{$student->user->course->course_name ?? ''}}</b></td>
                        <td>{{$student->student_score}}/{{$ovaral_score ?? ''}}</td>
                    </tr>
                  @endforeach
                 </tbody>


               </table>

                 



     
    </body>
</html>










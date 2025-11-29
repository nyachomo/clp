<?php
use App\Models\User;
use App\Models\Fee;
Use App\Models\Course;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Short Course</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }
            thead {
                background-color: #000033;
                color: white;
            }
            th, td {
                border: 1px solid #ddd;
            }
            *{
                font-family: "Tw Cen MT", "Century Gothic", "Arial", sans-serif;
            }
            ol li{
                list-style-type: none;
            }
            td{
                padding:5px;
            }
        </style>
    </head>
    <body>
       <center>
             <img src="{{ $imageSrc }}"  style="max-width: 200px; height: 150px">
            
        </center>
        <center> <h2 style="color:#000033">TECHSPHERE TRAINING INSTITUTE</h2></center>
       
        <center>
        <p style="border-bottom:3px solid #000033">
            <b>
            View Park Towers 17th Floor, University way | P. O. Box 1334-00618, Nairobi<br>
            Web: <a href="https://techsphereinstitute.co.ke" style="color:blue">https://techsphereinstitute.co.ke</a>  Email: <span style="color:blue">Info@techsphereinstitute.co.ke </span>| <br>
            Phone: <span style="color:#3ccccc">+254768919307</span>
            </b>
        </p>

        </center>

      
      
       

        <center><p><u> FEE BALANCES  <u></b></p></center>
        <br><br>
        <table class="table" style="width:100%;margin-top:-35px">
            <tr style="border:1px solid white">
                <td style="border:1px solid white">
                <p style="font-size:11"> 
                             <b>Total Students:</b>  {{$total_students ?? 'NA'}} 
                    </p>
                </td>
            </tr>
        </table>

        <br><br>

        <table class="table" style="width:100%;margin-top:-35px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Student Phone</th>
                    <th>Parent Phone</th>
                     <th>Email</th>
                    <th>Class</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($trainees))
                @foreach($trainees as $key=>$trainee)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$trainee->firstname ?? 'NA'}} {{$trainee->lastname ?? 'NA'}}</td>
                        <td>{{$trainee->phonenumber ?? 'NA'}}</td>
                        <td>{{$trainee->parent_phone ?? 'NA'}}</td>
                        <td>{{$trainee->email}}</td>
                        <td>{{$trainee->clas->clas_name}}</td>
                        <td>{{$trainee->course->course_price}}</td>
                        <td>
                            <?php
                            
                                $total_debit = Course::where('id', $trainee->course_id)->value('course_price');
                                $total_credit = Fee::where('user_id',$trainee->id)->sum('amount_paid');
                                $balance= $total_debit-$total_credit ?? '';
                                echo$total_credit;
                            ?>
                        </td>
                        <td>
                            <?php
                            
                                $total_debit = Course::where('id', $trainee->course_id)->value('course_price');
                                $total_credit = Fee::where('user_id',$trainee->id)->sum('amount_paid');
                                $balance= $total_debit-$total_credit ?? '';
                                echo$balance;
                            ?>
                        </td>
                       
                    </tr>
                    @endforeach
                @endif
            </tbody>
        
        </table>  


     
    </body>
</html>





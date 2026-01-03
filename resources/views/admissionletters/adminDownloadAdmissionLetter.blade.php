
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
            }
            th, td {
                border: 1px solid #ffffff;
            }
            *{
                font-family: Tahoma, sans-serif;
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
                     <img src="{{ $imageSrc }}" width="120px">
                     <h1 style="color:#07294d">TECHSPHERE TRAINING INSTITUTE</h1>
                     <p style="font-size:17px; border-bottom:4px solid #07294d">
                        View Park Towers 17th Floor, University way | P. O. Box 1334-00618, Nairobi<br>
                        Web:   <b style="color:blue;"><u>https://www.techsphereinstitute.co.ke</u></b>   |Email: <b style="color:blue;"><u>Info@techsphereinstitute.co.ke </u></b>|<br>
                        Phone: <b style="color:#33d6ff">+254768919307</b>

                     </p>
                </center>

                <table style="width:100%">
                  <tr>
                      <td><b>{{$student->firstname ?? ''}} {{$student->lastname ?? ''}}</b></td>
                      <td style="text-align:right;padding-right:20px"><b>AdmNo: TTI/<?php echo strtoupper(date('Y'));?>/{{$student->id ?? 'NA'}}</b></td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <p>
                            <b>{{$student->email ?? 'NA'}}</b><br>
                            <b>{{$student->phonenumber ?? 'NA'}}</b><br>
                            <b>{{$formFourLetter->date ?? 'NA'}}</b>
                        </p>
                     </td>
                     
                  </tr>
                  
                  <tr>
                      <p><b>Dear {{$student->firstname ?? ''}}</b></p>
                  </tr>
                   <tr>
                         <td  colspan="2">

                            <h5 style="text-transform: uppercase; text-decoration: underline;">
                                RE: ADMISSION INTO {{$student->course->course_name }} COURSE !
                            </h5>
                        </td>
                     </tr>


                      <tr>
                        <td colspan="2">
                            <p>
                            Congratulations on being awarded a scholarship to join Techsphere Training Institute and  
                            For expressing interest in our  <b style="text-transform: uppercase;">{{ $student->course->course_name }} COURSE ! </b> . 
                            We are excited about the possibility of having you in our learning community and commend  
                            your enthusiasm to gain valuable programming  skills.
                            </p>
                            <p><b>Action Required: Complete Your Enrollment (Only those who have not enrolled)</b> </p>
                            <p>
                                To secure your place in this course, please complete your enrollment by the end of ,January 12, 
                                2026. This will ensure that you are ready to start along with your classmates. 
                            </p>
                            <p><b>Orientation and Class Start Dates</b></p>
                            <p>
                                <ul>
                                   <li> 
                                        <b>Orientation:</b>Scheduled for January 12 <sup>th</sup> 2026, at 10:00 a.m for January intake and February 2 <sup>nd</sup> 2026, at 10:00 a.m for february intake.  (attendance is highly 
                                         encouraged to get familiar with course logistics and expectations).
                                    </li>

                                    <li> 
                                        <b>Orientation Link (January Intake):</b>   <a href="https://meet.google.com/ajy-wnoe-hbo"><span style="color:blue;">https://meet.google.com/ajy-wnoe-hbo</span></a>

                                    </li>

                                    <li> 
                                        <b>Orientation Link (February Intake):</b> <a href="https://meet.google.com/dqd-ezxa-poi"><span style="color:blue;">https://meet.google.com/dqd-ezxa-poi</span></a>

                                    </li>


                                    <li><b>Classes Begin:</b>January 12 <sup>th</sup> 2026, (January Intake) And  </b>February 2 <sup>nd</sup> 2026,  (February Intake)</li>
                                </ul>
                            </p>

                            
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">

                        <p><b>Class Information</b></p>
                                <ul>
                                    <li> 
                                        The course will be conducted online. Please find the access link to the virtual 
                                        classroom below:  
                                    </li>
                                </ul>

                            <p><b>Class Link</b></p>
                                <ul>
                                    <li>
                                         <b>January Intake: </b> <a href="https://meet.google.com/ajy-wnoe-hbo"><span style="color:blue;font-size:27px;">https://meet.google.com/ajy-wnoe-hbo</span></a>
                                    </li>
                                     <li>
                                         <b>February Intake: </b> <a href="https://meet.google.com/dqd-ezxa-poi"><span style="color:blue;font-size:27px;">https://meet.google.com/dqd-ezxa-poi</span></a>
                                    </li>
                                </ul>
                            
                            <p><b>Course Duration</b></p>
                                <ul>
                                    <li>
                                          <b>Weeks: </b>16 Weeks 
                                    </li>
                                  
                                </ul>

                            <p><b>Class Schedule</b></p>
                                <ul>
                                    <li>
                                          Monday-Friday 
                                    </li>
                                </ul>
                           
                                
                        </td>
                    </tr>
                   <tr>
                        <td colspan="2">
                             <p>We look forward to having you on board and wish you success in your programming journey! </p>
                        </td>
                    </tr>


                  
                 

                 

                 

               </table>

                  

               <table>
              

                   <tr>
                        <td>
                        <p>
                            Yours Faithfully<br>
                                    <img src="{{ $imageSrc2 }}" width="100px"><br>
                            Director Techsphere Training Institute
                        </p>
                        </td>
                        <td>
                        <p style="float:right;">
                                <img src="{{ $imageSrc3 }}" width="270px" height="100px">
                        </p>
                        </td>
                   </tr>

               </table>




     
    </body>
</html>










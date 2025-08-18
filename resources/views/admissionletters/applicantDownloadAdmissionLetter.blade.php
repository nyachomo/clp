@extends('layouts.master')
@section('content')
<br>
<div class="row">
    <div class="col-sm-2"></div>
     <div class="col-sm-8">
          <div class="card">
                <div class="card-header">
                     <a href="#" class="btn btn-sm" style="float:right"><i class="fa fa-download"></i> Download Admission Letter</a>
                </div>
                <div class="card-body">
                <center>
                     <img src="{{asset('images/logo/logo.jpeg')}}" width="120px">
                     <h1 style="color:#07294d">TECHSPHERE TRAINING INSTITUTE</h1>
                     <p style="font-size:20px; border-bottom:4px solid #07294d">
                        View Park Towers 17th Floor, University way | P. O. Box 1334-00618, Nairobi<br>
                        Web:   <b style="color:blue;"><u>https://www.techsphereinstitute.co.ke</u></b>   |Email: <b style="color:blue;"><u>Info@techsphereinstitute.co.ke </u></b>|<br>
                        Phone: <b style="color:#33d6ff">+254768919307</b>

                     </p>
                </center>
                <table style="width:100%">
                    <tr>
                        <td>
                            <p style="font-size:16px">
                                <b>
                                
                                 {{Auth::user()->firstname}} {{Auth::user()->lastname ?? ''}}<br>
                               </b>
                            </p>
                        </td>
                        <td style="float:right">
                            <b>AdmNo: TTI/FEB/2025/{{Auth::user()->id}}</b>
                        </td>
                    </tr>
                   
                    <tr>
                        <td>
                            <p style="font-size:16px">
                                 <b>
                                {{Auth::user()->phonenumber ?? ''}}<br>
                                {{Auth::user()->email ?? ''}}<br>
                                <?php echo strtoupper(date('d M Y'));?> <br>
                                 Dear {{Auth::user()->firstname}}
                                 </b>
                            </p>
                        </td>
                        
                       
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>
                            Congratulations on being awarded a scholarship to join Techsphere Training Institute and  
                            For expressing interest in our  CIT 202 CYBERSECURITY AND ETHICAL HACKING COURSE ! . 
                            We are excited about the possibility of having you in our learning community and commend  
                            your enthusiasm to gain valuable programming  skills.
                            </p>
                            <p><b>Action Required: Complete Your Enrollment (Only those who have not enrolled)</b> </p>
                            <p>
                                To secure your place in this course, please complete your enrollment by the end of ,February 3, 
                                2025. This will ensure that you are ready to start along with your classmates. 
                            </p>
                            <p><b>Orientation and Class Start Dates</b></p>
                            <p>
                                <ul>
                                    <li>Orientation: Scheduled for February 3rd , 2025, at 10:00 a.m. (attendance is highly 
                                    encouraged to get familiar with course logistics and expectations).
                                    </li>

                                    <li>Classes Begin: February 04, 2025. </li>
                                </ul>
                            </p>

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
                                          https://us05web.zoom.us/j/81771001961?pwd=tkGjawzek6cjK4qIn1GCNX0rJKLffr.1 
                                    </li>
                                    <li>
                                          Meeting ID: 817 7100 1961 
                                    </li>
                                    <li>
                                          Passcode: 5aVq7J
                                    </li>
                                </ul>
                            
                            <p><b>Course Duration</b></p>
                                <ul>
                                    <li>
                                          16 Weeks
                                    </li>
                                </ul>

                            <p><b>Class Schedule</b></p>
                                <ul>
                                    <li>
                                          Monday-Friday 2:30pm– 4:30pm 
                                    </li>
                                </ul>
                            <p><b>Fee Payment</b></p>
                            <ul>
                                 <li>
                                    <p>
                                    While you have received a scholarship covering most of the course fee, a registration fee 
                                    of KSH 1000 and administrative fee of KSH 30,500 is required.  Here’s the breakdown of the total program fee: 
                                        <ul>
                                             <li>Total Fee: KES 30,500 </li>
                                             <li>Modules: 4 modules at KES 7,625 each</li>
                                             <li>Course duration: 18Weeks.</li>
                                        </ul>
                                    </p>
                                 </li>
                                 
                                 <li>
                                    <p>
                                         You can pay the program fee in the following ways (Choose one of the options):
                                         <ol>
                                             <li>
                                                 <p>
                                                      Three Installments:
                                                      <ul>
                                                          <li>First Installment (50%): KES 15,250</li>
                                                          <li>Second Installment (25%): KES 7,625 </li>
                                                          <li>Third Installment (25%): KES 7,625 </li>
                                                      </ul>
                                                 </p>
                                             </li>

                                             <li>
                                                 <p>Per Month: </p>
                                                 <ul>
                                                      <li>
                                                        Pay KES 7,625 for each month as you progress through the 
                                                        program. 
                                                    </li>
                                                 </ul>
                                             </li>
                                         </ol>
                                    </p>
                                 </li>
                                 <p>Payment can be made through <b>Mpesa</b> OR <b>Bank</b> Deposit.</p>
                                 <table style="width:100%">
                                      <tr>
                                          <th>
                                              Mpesa
                                          </th>
                                          <th>Bank</th>
                                      </tr>
                                      <tr>
                                          <td>
                                              <ul>
                                                  <li>
                                                         <b>Business Name:</b> Techsphere Training Institute 
                                                  </li>

                                                  <li> <b>Paybill:</b> 522533</li>
                                                  <li>Acc No: <b>7855887</b>  </li>
                                              </ul>
                                          </td>

                                          <td>
                                              <ul>
                                                  <li>
                                                    Bank: <b>Kenya Comercial Bank</b> 
                                                  </li>
                                                  <li>
                                                     Acc Name: <b>Techsphere Training Institute</b>   
                                                  </li>
                                                  <li>
                                                      Acc No: <b>1327338564</b>
                                                  </li>
                                              </ul>
                                          </td>
                                      </tr>
                                 </table>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                             <center><h2>Course Outline</h2></center>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                           
                        </td>
                    </tr>
                    <tr>
                         <td>
                            <p>
                                Yours Faithfully<br>
                                     <img src="{{asset('images/signature/hibrahim_signature.jpeg')}}" width="100px"><br>
                                Director Techsphere Training Institute
                            </p>
                         </td>
                         <td>
                            <p style="float:right;">
                                 <img src="{{asset('images/stamp/official_stamp.png')}}" width="270px" height="100px">
                            </p>
                         </td>
                    </tr>
                   
                </table>
                
            </div>

          </div>
     </div>
     <div class="col-sm-2"></div>
</div>
@endsection
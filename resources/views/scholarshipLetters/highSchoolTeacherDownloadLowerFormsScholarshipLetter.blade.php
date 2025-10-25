
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
                      <td style="text-align:right;padding-right:20px"><b>{{$formFourLetter->letter_id ?? ''}}/{{$student->id ?? 'NA'}}</b></td>
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
                     <td colspan="2">
                         <h4><b><u>RE: Partial Scholarship Award - Techsphere 2025 Skill Pathfinding Program  - {{$formFourLetter->letter_id ?? ''}}<u></b></h4>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2" style="text-align: justify;">
                         <p>
                              Techsphere Training Institute is pleased to award you a partial scholarship for the 2025 Annual Skill 
                              Pathfinding Training Program. This initiative nurtures young talent by equipping them with globally 
                              in-demand ICT skills through specialized training, mentorship, and project-based learning.
                         </p>
                      </td>
                  </tr>

                  <tr>
                    <td colspan="2" style="text-align: justify;">
                        <p>
                            The Skill Pathfinding Training Program is an ICT talent-nurturing initiative that mentors over 500 youth 
                            annually, equipping them with globally in-demand tech skills. It addresses the growing ICT skills gap by 
                            fostering lifelong learning, future-readiness, youth employability, and innovation. Techsphere has evolved 
                            into a multi-stakeholder alliance bridging academia and the ICT sector, with a mission to reskill the nation 
                            through a forward-looking approach.
                        </p>
                      </td>
                  </tr>

                  <tr>
                      <td colspan="2" style="text-align: justify;">
                         <p>
                            Having qualified for the program, you will receive training, mentorship, and project-based learning to build 
                            industry-recognized skills and gain guidance into the tech industry. The 2025/2026 program features high-demand, 
                            up-to-date courses designed to give you a competitive edge, with fees reduced by nearly 60% to make this 
                            opportunity more accessible.Attached below is the payable fee structure.
                         </p>
                      </td>
                  </tr>

               </table>

               <br>
               <br></br><br>
               <table style="width:100%" style="border:1px solid black !important">
                  <thead style="background-color:#07294d !important;color:white">
                       <th>CODE</th>
                       <th>COURSE</th>
                       <th>DURATION</th>
                       <th>COURSE FEE (KSH)</th>
                       <th>SCHOLARSHIP AMOUNT (KSH)</th>
                       <th>AMOUNT TO PAY (KSH)</th>
                  </thead>
                  <tr style="border:1px solid black !important">
                       <td><b>CIT 101</b></td>
                       <td>FULL-STACK SOFTWARE ENGINEERING</td>
                       <td>7 WEEKS</td>
                       <td>30,500</td>
                       <td>22,000</td>
                       <td><b>8,500</b></td>
                  </tr>

                  <tr style="border:1px solid black !important">
                      <td><b>CIT 102</b></td>
                       <td>CYBERSECURITY AND ETHICAL HACKING</td>
                       <td>7 WEEKS</td>
                       <td>30,500</td>
                       <td>22,000</td>
                       <td><b>8,500</b></td>
                  </tr>

                 
                  <tr>
                      <td><b>CIT 103</b></td>
                       <td>DATASCIENCE MACHINE LEARNING AND AI</td>
                       <td>7 WEEKS</td>
                       <td>30,500</td>
                       <td>22,000</td>
                       <td><b>8,500</b></td>
                  </tr>
                  <tr>
                      <td><b>CIT 104</b></td>
                       <td>ROBOTICS AND IOT</td>
                       <td>7 WEEKS</td>
                       <td>30,500</td>
                       <td>22,000</td>
                       <td><b>8,500</b></td>
                  </tr>

                   <tr>
                      <td><b>CIT 105</b></td>
                       <td>DIGITAL MARKETING</td>
                       <td>7 WEEKS</td>
                       <td>30,500</td>
                       <td>22,000</td>
                       <td><b>8,500</b></td>
                  </tr>

                  

               </table>

                   <center><h3>Time-table</h3></center>
                     <table style="width:100%" class="table table-bordered table-striped">
                        <thead style="background-color:#07294d !important;color:white">
                            <th>CODE</th>
                            <th>COURSE</th>
                            <th>TIME</th>
                           
                        </thead>
                        <tr>
                            <td>CIT 101</td>
                            <td>FULL-STACK SOFTWARE ENGINEERING</td>
                            <td>8:00am-10:00am</td>
                           
                        </tr>

                        <tr>
                            <td>CIT 102</td>
                            <td>CYBERSECURITY AND ETHICAL HACKING</td>
                            <td>10:00am-12:00pm</td>
                           
                        </tr>

                      
                        <tr>
                            <td>CIT 103</td>
                            <td>DATASCIENCE MACHINE LEARNING AND AI</td>
                            <td>12:00pm-2:00pm</td>
                            
                        </tr>
                        <tr>
                            <td>CIT 104</td>
                            <td>ROBOTICS AND IOT</td>
                            <td>9:00am-11:00am</td>
                            
                        </tr>

                        <tr>
                            <td>CIT 105</td>
                            <td>DIGITAL MARKETING</td>
                            <td>4:00pm-5:30pm</td>
                            
                        </tr>

                    </table>

                     
                       

                   

               <table>
                  <tr>
                     <td colspan="2" style="text-align: justify;">
                         <p>
                              For this program, select one course from the list above. The program will run for a period of 7 weeks, 
                              2hrs per day (MON-FRI) and a certificate will be issued upon completion. To accept this partial scholarship,
                               you are required to visit <a href="https://techsphereinstitute.co.ke">https://techsphereinstitute.co.ke </a> and select <b>Enroll</b> to register before the 
                               deadline <b>{{$formFourLetter->registration_deadline ?? 'NA'}}</b> . A non-refundable registration fee of KES. 1000 is required to secure a spot on 
                               the program but students who have attended the program before will not be required to pay this fee. 
                               The starting date for the program is on <b>{{$formFourLetter->start_date ?? 'NA'}}</b>. Please note, the program will be run 
                               PURELY ONLINE. This will enable students to put focus to both the program and other activities.
                         </p>
                     </td>
                  </tr>

                  <tr>
                     <td colspan="2" style="text-align: justify;">
                        
                          <p><b>Orientation and Class Start Dates</b></p>
                            <p>
                                <ul>
                                    <li> <b>Orientation:</b> Scheduled for November 3rd , 2025, at 10:00 a.m. (attendance is highly 
                                            encouraged to get familiar with course logistics and expectations).
                                    </li>
                                    <li> <b>Orientation Link:</b>  <a href="https://meet.google.com/ajy-wnoe-hbo"><span style="color:blue;">https://meet.google.com/ajy-wnoe-hbo</span></a></li>

                                    <li><b>Classes Begin:</b> November 04, 2025. </li>
                                </ul>
                            </p>

                            <p><b>Class Link</b></p>
                            <ul>
                                <li>
                                        <a href="https://meet.google.com/ajy-wnoe-hbo"><span style="color:blue;font-size:27px;">https://meet.google.com/ajy-wnoe-hbo</span></a>
                                </li>
                            </ul>

                     </td>
                  </tr>

                   <tr>
                        <td colspan="2">
                            <h3>Benefit of the program</h3>
                            <ol>
                                <li>Certificate awarded upon successful completion.</li>
                                <!--<li> Top 5 students will each receive a laptop for further studies.</li>-->
                                <li>Career coaching for all participants.</li>
                            </ol>  
                        </td>
                    </tr>

                  <tr>
                      <td colspan="2" style="text-align: justify;">
                           
                             <p>
                             <b>For payment :</b> 
                                 This scholarship covers part of the training fee, leaving <b>a student contribution of Ksh 8,500</b> for the entire <b>7-week training program.</b>
                                 <br>
                                 To make it flexible and affordable, students may choose from the following <b>payment options:</b>
                                 <ol>
                                    <li>
                                        <b>Two Installments:</b>
                                        <ul>
                                              <li><b>First installment:</b> 50% (Ksh 4,250)</li>
                                              <li><b>Second installment:</b> 50% (Ksh 4,250)</li>
                                        </ul>
                                    </li>

                                    <li>
                                        <b>Weekly Payment Option:</b>
                                        <ul>
                                            <li>Ksh 1,215 per week for 7 weeks</li>
                                        </ul>
                                    </li>
                                 </ol>
                               

                                You can make payment either through direct transfer or through mpesa paybill option. The following are the payment option
                             </p>
                      </td>
                  </tr>
                  

                  <tr style="border:1px solid black">
                     <td style="border-right:1px solid black;padding-left:20px">

                            <p>
                               <b>MPESA</b><br>
                                BUSINESS NAME : <b>TECHSPHRE TRAINING INSTITUTE</b><br>
                                PAYBILL: <b>522533</b><br>

                                ACC NO: <b>7855887</b>
                            </p>

                     </td>

                     <td style="padding-left:20px">
                            <p>
                                <b>BANK TRANSFER</b><br>

                                BANK: <b>KENYA COMMERCIAL BANK</b><br>

                                ACC NAME: <b>TECHSPHERE INSTITUTE</b><br>

                                ACC NO: <b>1327338564</b>
                            </p>
                     </td>
                  </tr>

                  <tr>
                     <td colspan="2">
                            <p>
                                    Kindly call <b>+254768919307</b> or send an email to <b style="color:blue">info@techsphereinstitute.co.ke</b> for any queries or clarifications regarding the program. We look forward to having you join us
                            </p>
                     </td>
                  </tr>
                  

                  <tr>
                        <td colspan="2">
                             <p>We look forward to having you on board and wish you success in your programming journey! </p>
                        </td>
                    </tr>

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










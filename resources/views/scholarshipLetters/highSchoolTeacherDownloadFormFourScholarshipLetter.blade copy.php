
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
                      <td><b>{{$student->firstname ?? 'NA'}} {{$student->lastname ?? 'NA'}}</b></td>
                      <td style="text-align:right;padding-right:20px"><b>{{$formFourLetter->letter_id ?? 'NA'}}/{{$student->id ?? 'NA'}}</b></td>
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
                     <td colspan="2"><p><b>Dear {{$student->firstname ?? ''}}</b></p></td>
                  </tr>


               </table>

               <p>
               
                Techsphere Training Institute is pleased to announce the launch of our new Skill Pathfinding Training Program, offering specialized training in:
                <ul>
                    <li>Full-Stack Software Engineering with AI</li>
                    <li>Graphic Design & Animation With AI</li>
                    <li>Digital Marketing & SEO with AI</li>
                    <li>Datascience Machine Learning & AI</li>
                    <li>Cybersecurity & Ethical Hacking with AI</li>
                 </ul>
                </p>

               
                In recognition of your excellent performance in the internal examinations, Techsphere Training Institute is pleased to award you a partial scholarship for the 2025/2026 training.
                You will be taken through a series of trainings, mentorship programs, and project-based learning,
                equiping you with hands-on skills and the confidence to develop digital solutions using Artificial Intelligence (AI) tools.
                
                Attached below is the payable fee structure.

               </p>

               <br>
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
                       <td><b>CIT 201</b></td>
                       <td>FULL-STACK SOFTWARE ENGINEERING WITH AI</td>
                       <td>16 WEEKS</td>
                       <td>90,500</td>
                       <td>60,000</td>
                       <td><b>30,500</b></td>
                  </tr>

                  <tr style="border:1px solid black !important">
                      <td><b>CIT 202</b></td>
                       <td>CYBERSECURITY AND ETHICAL HACKING  WITH AI</td>
                       <td>16 WEEKS</td>
                       <td>90,500</td>
                       <td>60,000</td>
                       <td><b>30,500</b></td>
                  </tr>

                 
                  <tr>
                      <td><b>CIT 203</b></td>
                       <td>GRAPHIC DESIGN AND ANIMATION WITH AI</td>
                       <td>16 WEEKS</td>
                       <td>90,500</td>
                       <td>60,000</td>
                       <td><b>30,500</b></td>
                  </tr>

                   <tr>
                      <td><b>CIT 204</b></td>
                       <td>DIGITAL MARKETTING & SEO WITH AI</td>
                       <td>16 WEEKS</td>
                       <td>90,500</td>
                       <td>60,000</td>
                       <td><b>30,500</b></td>
                  </tr>

                  <tr>
                      <td><b>CIT 205</b></td>
                       <td>DATASCIENCE MACHINE LEARNING AND AI</td>
                       <td>16 WEEKS</td>
                       <td>90,500</td>
                       <td>60,000</td>
                       <td><b>30,500</b></td>
                  </tr>


                 

               </table>


                <p>
                    For this program, select one course from the list above. The program will run for a period of 16 weeks, 
                    2hrs per day (MON-FRI). To accept this partial scholarship,
                    you are required to visit <a href="https://techsphereinstitute.co.ke ">https://techsphereinstitute.co.ke </a> and select <b>Enroll</b> to register before the 
                    deadline <b>{{$formFourLetter->registration_deadline ?? 'NA'}}</b> . A non-refundable registration fee of KES. 1000 is required to secure a spot on 
                    the program but students who have attended the program before will not be required to pay this fee. 
                    The starting date for the program is on <b>{{$formFourLetter->start_date ?? 'NA'}}</b>. All courses will be delivered online, giving you
                    the flexibility to learn from any location.  Attached below is the time-table.
                </p>

                <center><h3>Time-table</h3></center>
                <table style="width:100%" style="border:1px solid black !important">
                  <thead style="background-color:#07294d !important;color:white">
                       <th>CODE</th>
                       <th>COURSE</th>
                       <th>TIME</th>
                      
                  </thead>
                  <tr style="border:1px solid black !important">
                       <td><b>CIT 201</b></td>
                       <td>FULL-STACK SOFTWARE ENGINEERING WITH AI</td>
                       <td>8:00am-10:00am</td>
                       
                  </tr>
                   <tr>
                      <td><b>CIT 204</b></td>
                       <td>DIGITAL MARKETTING & SEO WITH AI</td>
                       <td>8:00pm-10:00am</td>
                      
                  </tr>


                  <tr style="border:1px solid black !important">
                      <td><b>CIT 202</b></td>
                       <td>CYBERSECURITY AND ETHICAL HACKING  WITH AI</td>
                       <td>10:00am-12:00pm</td>
                  </tr>

                 
                  <tr>
                      <td><b>CIT 203</b></td>
                       <td>GRAPHIC DESIGN AND ANIMATION WITH AI</td>
                       <td>11:00am-1:00pm</td>
                       
                  </tr>

                  
                  <tr>
                      <td><b>CIT 205</b></td>
                       <td>DATASCIENCE MACHINE LEARNING AND AI</td>
                       <td>12:00pm-2:00pm</td>
                      
                  </tr>

                </table>
                 

               </table>
                    <p>
                     Upon successful completion of your training, you will receive a Certificate of Completion from Techsphere, confirming your competence and achievement in your chosen field of study.
                    
                   </p>

               <table>
                
                  <tr>
                     <td colspan="2" style="text-align: justify;">
                        
                          <p><b>Orientation and Class Start Dates</b></p>
                            <p>
                                <ul>
                                    <li> <b>Orientation:</b> Scheduled for {{$formFourLetter->start_date ?? 'NA'}} at 10:00 a.m. (attendance is highly 
                                            encouraged to get familiar with course logistics and expectations).
                                    </li>
                                    <li> <b>Orientation Link:</b>  <a href="https://meet.google.com/ajy-wnoe-hbo"><span style="color:blue;">https://meet.google.com/ajy-wnoe-hbo</span></a></li>

                                    <li><b>Classes Begin:</b> {{$formFourLetter->start_date ?? 'NA'}} </li>
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
                      <td colspan="2" style="text-align: justify;">
                           
                             <p>
                             <b>For payment :</b> 
                                 This scholarship covers part of the training fee, leaving <b>a student contribution of Ksh 30,500</b> for the entire <b>16-weeks training program.</b>
                                 <br>
                                 To make it flexible and affordable, students may choose from the following <b>payment options:</b>
                                 <ol>
                                    <li>
                                        <b>Two Installments:</b>
                                        <ul>
                                              <li><b>First installment:</b> 50% (Ksh 15,250)</li>
                                              <li><b>Second installment:</b> 50% (Ksh 15,250)</li>
                                        </ul>
                                    </li>

                                    <li>
                                        <b>Monthly Payment Option:</b>
                                        <ul>
                                            <li>Ksh 7,625 per month for 4 months</li>
                                        </ul>
                                    </li>
                                 </ol>
                               

                                You can make payment either through direct transfer or through mpesa paybill option. The following are the payment option
                             </p>
                      </td>
                  </tr>
               </table>

                <table>
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
                </table>



               <table>
                  <tr>
                      <td colspan="2" style="text-align: justify;">
                            <p>
                              Call us <b>+254768919307</b> or send an email to <b style="color:blue">info@techsphereinstitute.co.ke</b> for any queries or clarifications regarding the program. We look forward to welcoming you to Techsphere and supporting you as you advance your digital skills and career goals.
                             </p>   
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










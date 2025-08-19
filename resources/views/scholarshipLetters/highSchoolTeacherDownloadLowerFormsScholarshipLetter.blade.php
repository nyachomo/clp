
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
                     <td colspan="2">
                         <h4><b><u>RE: Admission into Techsphere’s 2025 Skill Pathfinding Program – {{$formFourLetter->letter_id}}<u></b></h4>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2" style="text-align: justify;">
                         <p>
                         Techsphere Training Institute congratulates you for being shortlisted to be admitted into 
                         this year’s 2025 Annual <b>“Skill Pathfinding”</b> training program having passed our assessment.
                         </p>
                      </td>
                  </tr>

                  <tr>
                    <td colspan="2" style="text-align: justify;">
                        <p>
                            The <b>“Skill Pathfinding”</b> Training Program is an ICT skill nurturing program for the youth, which is targeting to 
                            identify and mentor close to more than 500 talented youth annually, to acquire and develop specialized tech skills 
                            that are high in demand globally today. This is an effort to be part of the solution to the widening skill gap in 
                            the global ICT industry. Consequently, Techspshere is set out to develop a futuristic approach to reskilling the 
                            nation. Over time, we have grown to become a multi-stakeholder alliance representing both the academia and the ICT
                            sector. Our focus is on three areas: <b>lifelong learning and upskilling, future-readiness and youth employability as
                            well as innovation.</b>
                        </p>
                      </td>
                  </tr>

                  <tr>
                      <td colspan="2" style="text-align: justify;">
                         <p>
                             Having successfully qualified for the program, you will be taken through a series of trainings, mentorship 
                             programs, and project-based learning. This will culminate in developing industry recognized skillsets in 
                             your area of specialization as well as proper mentorship into the tech industry. For the 2025 program, 
                             we have selected key courses that are in high demand, up-to-date and guaranteed to give participants 
                             a cutting edge in the ICT industry. To make this dream come true, we have reduced down our fee charges 
                             by almost 60% from the standard charges in order to impact more lives as cost can be a greater barrier 
                             to such a predominant milestone. Attached below is the payable fee structure.
                         </p>
                      </td>
                  </tr>

               </table>

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
                       <td><b>CIT 101</b></td>
                       <td>FULL-STACK SOFTWARE ENGINEERING</td>
                       <td>6 WEEKS</td>
                       <td>30,500</td>
                       <td>23,000</td>
                       <td><b>7,500</b></td>
                  </tr>

                  <tr style="border:1px solid black !important">
                      <td><b>CIT 102</b></td>
                       <td>CYBERSECURITY AND ETHICAL HACKING</td>
                       <td>6 WEEKS</td>
                       <td>30,500</td>
                       <td>23,000</td>
                       <td><b>7,500</b></td>
                  </tr>

                  <tr>
                       <td><b>CIT 103</b></td>
                       <td>DIGITAL MARKETING AND SEO</td>
                       <td>6 WEEKS</td>
                       <td>30,500</td>
                       <td>23,000</td>
                       <td><b>7,500</b></td>
                  </tr>
                  <tr>
                      <td><b>CIT 104</b></td>
                       <td>DATASCIENCE MACHINE LEARNING AND AI</td>
                       <td>6 WEEKS</td>
                       <td>30,500</td>
                       <td>23,000</td>
                       <td><b>7,500</b></td>
                  </tr>

                  <tr>
                      <td><b>CIT 105</b></td>
                       <td>GRAPHIC DESIGN</td>
                       <td>6 WEEKS</td>
                       <td>30,500</td>
                       <td>23,000</td>
                       <td><b>7,500</b></td>
                  </tr>

               </table>

               <table>
                  <tr>
                     <td colspan="2" style="text-align: justify;">
                         <p>
                              For this program, select one course from the list above. The program will run for a period of 6 weeks, 
                              2hrs per day (MON-FRI) and a certificate will be issued upon completion. To accept this partial scholarship,
                               you are required to visit https://techsphereinstitute.co.ke and select “Enroll” to register before the 
                               deadline <b>{{$formFourLetter->registration_deadline ?? 'NA'}}</b> . A non-refundable registration fee of KES. 1000 is required to secure a spot on 
                               the program but students who have attended the program before will not be required to pay this fee. 
                               The starting date for the program is on <b>{{$formFourLetter->start_date ?? 'NA'}}</b>. Please note, the program will be run 
                               PURELY ONLINE. This will enable students to put focus to both the program and other activities.
                         </p>
                     </td>
                  </tr>

                  <tr>
                      <td colspan="2" style="text-align: justify;">
                            <p>
                             Kindly call <b>+254768919307</b> or send an email to info@techsphereinstitute.co.ke for any queries or clarifications regarding the program. We look forward to having you join us
                             </p>
                             <p>
                             <b>For payment :</b> You can make payment either through direct transfer or through mpesa paybill option. The following are the payment option
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










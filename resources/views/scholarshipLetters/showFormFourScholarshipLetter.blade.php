@extends('layouts.master')
@section('content')
<br>
<div class="row">
   
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                 <a href="{{route('studentDownloadFormFourScholarshipLetter',['id'=>Auth::user()->id])}}" class="btn btn-sm btn-success" style="float:right" ><i class="fa fa-download"></i>Download Scholarship Letter</a>
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

                @auth
                    @if(Auth::user()->clas_category !='Form Four')
                    <table style="width:100%">
                        <tr>
                            <td><b>{{Auth::user()->firstname ?? ''}} {{Auth::user()->lastname ?? ''}}</b></td>
                            <td style="float:right;padding-right:80px;"><b>{{$lowerFormsLetter->letter_id ?? 'NA'}}/{{Auth::user()->id ?? 'NA'}}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                    <b>{{Auth::user()->email ?? 'NA'}}</b><br>
                                    <b>{{Auth::user()->phonenumber ?? 'NA'}}</b><br>
                                    <b>{{$lowerFormsLetter->date ?? 'NA'}}</b>
                                </p>
                            </td>
                        
                        </tr>

                        <tr>
                            <td colspan="2">
                                <p><b>Dear {{Auth::user()->firstname ?? ''}}</b></p>
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                                <center><h3><b><u>RE: Partial Scholarship Award – Techsphere 2025 Skill Pathfinding Program {{$lowerFormsLetter->letter_id}}<u></b></h3></center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                               
                                <p>
                                     Techsphere Training Institute is pleased to award you a partial scholarship for the 2025 Annual Skill 
                                     Pathfinding Training Program. This initiative nurtures young talent by equipping them with globally 
                                     in-demand ICT skills through specialized training, mentorship, and project-based learning.
                                </p>
                                
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                               <!-- <p>
                                    The <b>“Skill Pathfinding”</b> Training Program is an ICT skill nurturing program for the youth, which is targeting to 
                                    identify and mentor close to more than 500 talented youth annually, to acquire and develop specialized tech skills 
                                    that are high in demand globally today. This is an effort to be part of the solution to the widening skill gap in 
                                    the global ICT industry. Consequently, Techspshere is set out to develop a futuristic approach to reskilling the 
                                    nation. Over time, we have grown to become a multi-stakeholder alliance representing both the academia and the ICT
                                    sector. Our focus is on three areas: <b>lifelong learning and upskilling, future-readiness and youth employability as
                                    well as innovation.</b>
                                </p>-->

                                <p>
                                    The Skill Pathfinding Training Program is an ICT talent-nurturing initiative that mentors over 500 youth 
                                    annually, equipping them with globally in-demand tech skills. It addresses the growing ICT skills gap by 
                                    fostering lifelong learning, future-readiness, youth employability, and innovation. Techsphere has evolved 
                                    into a multi-stakeholder alliance bridging academia and the ICT sector, with a mission to reskill the 
                                    nation through a forward-looking approach.
                                </p>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <!--<p>
                                    Having successfully qualified for the program, you will be taken through a series of trainings, mentorship 
                                    programs, and project-based learning. This will culminate in developing industry recognized skillsets in 
                                    your area of specialization as well as proper mentorship into the tech industry. For the 2025 program, 
                                    we have selected key courses that are in high demand, up-to-date and guaranteed to give participants 
                                    a cutting edge in the ICT industry. To make this dream come true, we have reduced down our fee charges 
                                    by almost 60% from the standard charges in order to impact more lives as cost can be a greater barrier 
                                    to such a predominant milestone. Attached below is the payable fee structure.
                                </p>-->

                                <p>
                                    Having qualified for the program, you will receive training, mentorship, and project-based learning to 
                                    build industry-recognized skills and gain guidance into the tech industry. The 2025 program features 
                                    high-demand, up-to-date courses designed to give you a competitive edge, with fees reduced by nearly 
                                    60% to make this opportunity more accessible.
                                </p>
                            </td>
                        </tr>

                    </table>

                    <table style="width:100%" class="table table-bordered table-striped">
                        <thead style="background-color:#07294d !important;color:white">
                            <th>CODE</th>
                            <th>COURSE</th>
                            <th>DURATION</th>
                            <th>COURSE FEE (KSH)</th>
                            <th>SCHOLARSHIP AMOUNT (KSH)</th>
                            <th>AMOUNT TO PAY (KSH)</th>
                        </thead>
                        <tr>
                            <td>CIT 101</td>
                            <td>FULL-STACK SOFTWARE ENGINEERING</td>
                            <td>6 WEEKS</td>
                            <td>30,500</td>
                            <td>22,000</td>
                            <td>8,500</td>
                        </tr>

                        <tr>
                            <td>CIT 102</td>
                            <td>CYBERSECURITY AND ETHICAL HACKING</td>
                            <td>6 WEEKS</td>
                            <td>30,500</td>
                            <td>22,000</td>
                            <td>8,500</td>
                        </tr>

                        <tr>
                            <td>CIT 103</td>
                            <td>DIGITAL MARKETING AND SEO</td>
                            <td>6 WEEKS</td>
                            <td>30,500</td>
                            <td>22,000</td>
                            <td>8,500</td>
                        </tr>
                        <tr>
                            <td>CIT 104</td>
                            <td>DATASCIENCE MACHINE LEARNING AND AI</td>
                            <td>6 WEEKS</td>
                            <td>30,500</td>
                            <td>22,000</td>
                            <td>8,500</td>
                        </tr>

                    </table>

                    <table>
                        <tr>
                            <td colspan="2">
                                <p>
                                    For this program, select one course from the list above. The program will run for a period of 6 weeks, 
                                    2hrs per day (MON-FRI) and a certificate will be issued upon completion. To accept this partial scholarship,
                                    you are required to visit <a href="https://techsphereinstitute.co.ke ">https://techsphereinstitute.co.ke </a> and select “Enroll” to register before the 
                                    deadline <b>{{$lowerFormsLetter->registration_deadline ?? 'NA'}}</b> . A non-refundable registration fee of KES. 1000 is required to secure a spot on 
                                    the program but students who have attended the program before will not be required to pay this fee. 
                                    The starting date for the program is on <b>{{$lowerFormsLetter->start_date ?? 'NA'}}</b>. Please note, the program will be run 
                                    PURELY ONLINE. This will enable students to put focus to both the program and other activities.
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                    <p>
                                    Kindly call <b>+254768919307</b> or send an email to <b style="color:blue">info@techsphereinstitute.co.ke</b> for any queries or clarifications regarding the program. We look forward to having you join us
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
                    </table>
                    @endif
                @endauth

               @auth
                    @if(Auth::user()->clas_category =='Form Four')
                    <table style="width:100%">
                        <tr>
                            <td><b>{{Auth::user()->firstname ?? ''}} {{Auth::user()->lastname ?? ''}}</b></td>
                            <td style="float:right;padding-right:80px;"><b>{{$formFourLetterormsLetter->letter_id ?? 'NA'}}/{{Auth::user()->id ?? 'NA'}}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                    <b>{{Auth::user()->email ?? 'NA'}}</b><br>
                                    <b>{{Auth::user()->phonenumber ?? 'NA'}}</b><br>
                                    <b>{{$lowerFormsLetter->date ?? 'NA'}}</b>
                                </p>
                            </td>
                        
                        </tr>

                        <tr>
                            <td colspan="2">
                                <p><b>Dear {{Auth::user()->firstname ?? ''}}</b></p>
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                                <center><h3><b><u>RE: Partial Scholarship Award – Techsphere 2026 Skill Pathfinding Program ({{$lowerFormsLetter->letter_id}})<u></b></h3></center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <!--<p>
                                    Techsphere Training Institute congratulates you for being shortlisted to be admitted into 
                                    this year's 2025 Annual <b>"Skill Pathfinding"</b> training program having passed our assessment.
                                </p>-->
                                <p>
                                     Techsphere Training Institute is pleased to award you a partial scholarship for the 2026 Annual Skill 
                                     Pathfinding Training Program. This initiative nurtures young talent by equipping them with globally 
                                     in-demand ICT skills through specialized training, mentorship, and project-based learning.
                                </p>
                                
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                               <!-- <p>
                                    The <b>“Skill Pathfinding”</b> Training Program is an ICT skill nurturing program for the youth, which is targeting to 
                                    identify and mentor close to more than 500 talented youth annually, to acquire and develop specialized tech skills 
                                    that are high in demand globally today. This is an effort to be part of the solution to the widening skill gap in 
                                    the global ICT industry. Consequently, Techspshere is set out to develop a futuristic approach to reskilling the 
                                    nation. Over time, we have grown to become a multi-stakeholder alliance representing both the academia and the ICT
                                    sector. Our focus is on three areas: <b>lifelong learning and upskilling, future-readiness and youth employability as
                                    well as innovation.</b>
                                </p>-->

                                <p>
                                    The Skill Pathfinding Training Program is an ICT talent-nurturing initiative that mentors over 500 youth 
                                    annually, equipping them with globally in-demand tech skills. It addresses the growing ICT skills gap by 
                                    fostering lifelong learning, future-readiness, youth employability, and innovation. Techsphere has evolved 
                                    into a multi-stakeholder alliance bridging academia and the ICT sector, with a mission to reskill the 
                                    nation through a forward-looking approach.
                                </p>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <!--<p>
                                    Having successfully qualified for the program, you will be taken through a series of trainings, mentorship 
                                    programs, and project-based learning. This will culminate in developing industry recognized skillsets in 
                                    your area of specialization as well as proper mentorship into the tech industry. For the 2025 program, 
                                    we have selected key courses that are in high demand, up-to-date and guaranteed to give participants 
                                    a cutting edge in the ICT industry. To make this dream come true, we have reduced down our fee charges 
                                    by almost 60% from the standard charges in order to impact more lives as cost can be a greater barrier 
                                    to such a predominant milestone. Attached below is the payable fee structure.
                                </p>-->

                                <p>
                                    Having qualified for the program, you will receive training, mentorship, and project-based learning to 
                                    build industry-recognized skills and gain guidance into the tech industry. The 2026 program features 
                                    high-demand, up-to-date courses designed to give you a competitive edge, with fees reduced by nearly 
                                    60% to make this opportunity more accessible.
                                </p>
                            </td>
                        </tr>

                    </table>

                    <table style="width:100%" class="table table-bordered table-striped">
                        <thead style="background-color:#07294d !important;color:white">
                            <th>CODE</th>
                            <th>COURSE</th>
                            <th>DURATION</th>
                            <th>COURSE FEE (KSH)</th>
                            <th>SCHOLARSHIP AMOUNT (KSH)</th>
                            <th>AMOUNT TO PAY (KSH)</th>
                        </thead>
                        <tr>
                            <td>CIT 201</td>
                            <td>FULL-STACK SOFTWARE ENGINEERING</td>
                            <td>16 WEEKS</td>
                            <td>90,500</td>
                            <td>60,000</td>
                            <td>30,500</td>
                        </tr>

                        <tr>
                            <td>CIT 202</td>
                            <td>CYBERSECURITY AND ETHICAL HACKING</td>
                            <td>16 WEEKS</td>
                            <td>90,500</td>
                            <td>60,000</td>
                            <td>30,500</td>
                        </tr>

                        <tr>
                            <td>CIT 203</td>
                            <td>DIGITAL MARKETING AND SEO</td>
                            <td>16 WEEKS</td>
                            <td>90,500</td>
                            <td>60,000</td>
                            <td>30,500</td>
                        </tr>
                        <tr>
                            <td>CIT 204</td>
                            <td>DATASCIENCE MACHINE LEARNING AND AI</td>
                            <td>16 WEEKS</td>
                            <td>90,500</td>
                            <td>60,000</td>
                            <td>30,500</td>
                        </tr>

                        <tr>
                            <td>CIT 205</td>
                            <td>GRAPHIC DESIGN AND ANIMATION</td>
                            <td>16 WEEKS</td>
                            <td>90,500</td>
                            <td>60,000</td>
                            <td>30,500</td>
                        </tr>

                    </table>

                    <table>
                        <tr>
                            <td colspan="2">
                                <p>
                                    For this program, select one course from the list above. The program will run for a period of 16 weeks, 
                                    2hrs per day (MON-FRI) and a certificate will be issued upon completion. To accept this partial scholarship,
                                    you are required to visit <a href="https://techsphereinstitute.co.ke ">https://techsphereinstitute.co.ke </a> and select “Enroll” to register before the 
                                    deadline <b>{{$formFourLetter->registration_deadline ?? 'NA'}}</b> . A non-refundable registration fee of KES. 1000 is required to secure a spot on 
                                    the program but students who have attended the program before will not be required to pay this fee. 
                                    The starting date for the program is on <b>{{$formFourLetter->start_date ?? 'NA'}}</b>. 
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                    <p>
                                    Kindly call <b>+254768919307</b> or send an email to <b>info@techsphereinstitute.co.ke</b> for any queries or clarifications regarding the program. We look forward to having you join us
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
                    </table>
                    @endif
                @endauth



            </div>
        </div>
    </div>
   
</div>
@endsection
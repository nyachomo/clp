
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
                        <td>
                            <p style="font-size:16px">
                                <b>
                                 {{$letter->date ?? 'NA'}}<br>
                                 {{$letter->letter_id ?? 'NA'}}/ {{Auth::user()->id}}<br>
                                 Dear {{Auth::user()->firstname}} {{Auth::user()->lastname}}
                                </b>
                            </p>
                        </td>
                       
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                          
                            <p style="text-align:justify"><?php echo$letter->form_four?></p>
                            
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





@extends('layouts.website')
@section('content')

@if (session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div id="error-alert"  class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
@endif
<!--====== PAGE BANNER PART START ======-->

   <div class="row" style="max-width:100%; width:100%; margin:0;">
        <div class="col-sm-12" style="background-color:#07294d;padding-top:20px;padding-bottom:20px;">
            <center><h1 style="color:white">Contact Us</h1></center>
        </div>
    </div>

    


    <section id="contact-page" class="pt-20 pb-120 gray-bg">
        <div class="container-fliud">
            <div class="row">
                 <div class="col-sm-12">
                    
                      <p>
                       We value open communication and are always ready to assist you. Whether you have questions about our courses, scholarship opportunities, or career programs, our team is here to guide you every step of the way.

                        Reach out to us today and let’s help you start your journey into the world of digital skills and opportunities.

                        We’d love to hear from you!

                      </p>
                 </div>
            </div>
            
            <div class="row">
               
                <div class="col-lg-6">





                <div class="card mission-card" style="background-color:#00cc99">
                      
                      <div class="card-body">
                           


                                <div class="contact-from">
                                
                                    <div class="main-form pt-10">
                                        <form  action="{{route('sendContactMessage')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="singel-form form-group">
                                                        <input name="fullname" type="text" placeholder="Your name" required>
                                                    
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="singel-form form-group">
                                                        <input name="email" type="email" placeholder="Email"  required="required">
                                                    
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="singel-form form-group">
                                                        <input name="subject" type="text" placeholder="Subject"  required="required">
                                                        
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="singel-form form-group">
                                                        <input name="phonenumber" type="text" placeholder="Phone"  required="required">
                                                        
                                                    </div> 
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="singel-form form-group">
                                                        <textarea name="message" placeholder="Messege" required="required"></textarea>
                                                    
                                                    </div> 
                                                </div>
                                            
                                                <div class="col-md-12">
                                                    <div class="singel-form">
                                                        <button type="submit" class="main-btn" style="width:100%">Send</button>
                                                    </div> <!-- singel form -->
                                                </div> 
                                            </div> <!-- row -->
                                        </form>
                                    </div> <!-- main form -->
                                </div> <!--  contact from -->





                      </div>
                     
                 </div>




                    
                </div>
                <div class="col-lg-6">



                <div class="card vision-card" style="background-color:#1fd1ff">
                      
                      <div class="card-body">
                              

                               

                            <div class="contact-address">
                                <ul>
                                    <li>
                                        <div class="singel-address">
                                            <div class="icon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <div class="cont">
                                                <p style="color:#07294d">View Park Towers, University Way , Nairobi</p>
                                            </div>
                                        </div> <!-- singel address -->
                                    </li>
                                    <li>
                                        <div class="singel-address">
                                            <div class="icon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="cont">
                                                <p style="color:#07294d">0768919307</p>
                                                <!--<p style="color:#07294d">+1 222 345 342</p>-->
                                            </div>
                                        </div> <!-- singel address -->
                                    </li>
                                    <li>
                                        <div class="singel-address">
                                            <div class="icon">
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                            <div class="cont">
                                                <p style="color:#07294d">info@techsphereinstitute.co.ke</p>
                                                <p style="color:#07294d">admission@techsphereinstitute.co.ke</p>
                                            </div>
                                        </div> <!-- singel address -->
                                    </li>
                                </ul>
                            </div> <!-- contact address -->







                      </div>
                     
                 </div>


                </div>
              
            </div> <!-- row -->
        </div> <!-- container -->

    </section>



@endsection

	
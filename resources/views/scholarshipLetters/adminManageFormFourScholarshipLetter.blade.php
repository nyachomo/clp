@extends('layouts.master')
@section('content')

<br>
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


<div class="row">
    <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addLetter" style="float:right">Add New Letter</button>
            </div>
            
                

             <div class="card-body">

                <div class="row">
                    <div class="col-sm-1" style="padding-top:4px">
                        <label for="example-select" class="form-label" style="float:right;">Show</label>
                    </div>
                    <div class="col-sm-2">
                    
                    
                    <select class="form-select" id="select">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>



                    </div>

                    <div class="col-sm-6"></div>

                    <div class="col-sm-1" style="padding-top:6px">
                        <label for="example-select" class="form-label" style="float:right;">Search</label>
                    </div>

                    <div class="col-sm-2">
                        <input type="text" id="search" name="search" class="form-control" placeholder="Search users...">
                    </div>

                </div>
                <br>
                <div class="tab-content">
                    <div class="table-responsive">
                        <table id="table1" class="table table-sm table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <td>Letter Id</td>
                                    <th>Letter</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($letter->form_four))
                                 <tr>
                                    <td>{{$letter->letter_id}}</td>
                                    <td>
                                        <?php echo$letter->form_four ??'NA'?>
                                        
                                    </td>
                                    <td>{{$letter->date ?? 'NA'}}</td>
                                    <td>
                                        <!-- Active Item -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a data-bs-toggle="modal" data-bs-target="#updateLetter{{$letter->id ?? ''}}" class="dropdown-item" href="#">Update Letter</a>
                                                <a class="dropdown-item active" data-bs-toggle="modal"  data-bs-target="#deleteLetter{{$letter->id ?? ''}}" href="#">Delete Letter</a>
                                               
                                            </div>
                                        </div>

                                         <!--<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateLetter{{$letter->id ?? ''}}">Update</button>-->
                                    </td>

                                    <!-- Add User modal -->
                                        <div id="updateLetter{{$letter->id ?? ''}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Update Letter</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <form method="POST" action="{{route('adminUpdateFormFourScholarshipLetters')}}">
                                                        @csrf
                                                    

                                                        <!-- /.card-header -->
                                                        <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Date</label>
                                                                        <input type="text" name="date" class="form-control" value="{{$letter->date}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Letter Id</label>
                                                                        <input type="text" name="letter_id" class="form-control" value="{{$letter->letter_id}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <!-- text input -->
                                                                    <div class="form-group">
                                                                        <label>Content of the letter <sup>*</sup></label>
                                                                        <input type="text" class="form-control" name="id" value="{{$letter->id ?? ''}}" hidden="true">
                                                                        <textarea id="editor2" name="form_four" rows="10" cols="80"> {{$letter->form_four ?? ''}}</textarea>
                                                                                
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- /.card-body -->


                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  class="btn btn-success rounded-pill">Save</button>
                                                    </div>
                                                </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    <!--end of modal-->

                                    <!-- Add User modal -->
                                    <div id="deleteLetter{{$letter->id ?? ''}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="border:1px solid white;">
                                                        <h4 class="modal-title" id="standard-modalLabel">Are you sure you want to delete this record ?</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <form method="POST" action="{{route('adminDeleteFormFourScholarshipLetters')}}">
                                                        @csrf
                                                    

                                                        <!-- /.card-header -->
                                                        <div class="card-body" style="border:1px solid white;">
                                                        
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <!-- text input -->
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="delete_id" value="{{$letter->id ?? ''}}" hidden="true">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- /.card-body -->


                                                    <div class="modal-footer justify-content-between" style="border:1px solid white;">
                                                        <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  class="btn btn-success rounded-pill">Delete</button>
                                                    </div>
                                                </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    <!--end of modal-->

                                 </tr>
                                 @endif
                            </tbody>
                        
                        </table>                                           
                    </div> <!-- end preview-->

                </div> <!-- end tab-content-->

            </div> <!-- end card body-->






         </div>
    </div>
</div>

<!--MODEL FOR SCHOLARSHIP LETTER-->

<!-- Add User modal -->
<div id="addLetter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"><i class="uil-user-plus"></i> Add New Letter</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{route('adminAddFormFourScholarshipLetters')}}">
                @csrf
               

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Letter Id</label>
                                <input type="text" name="letter_id" class="form-control">
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Content of the letter <sup>*</sup></label>
                                <!--<input type="text" class="form-control" name="question_name">-->
                                <textarea id="editor1" name="form_four" rows="10" cols="80"> </textarea>
                            </div>
                        </div>
                    </div>

                </div>
                 <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill"  data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success rounded-pill">Save</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end of modal-->




<!--END OF SCHOLARSHI LETTER-->
@endsection
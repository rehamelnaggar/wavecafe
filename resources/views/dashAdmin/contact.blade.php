@extends('layouts.mainDash')

@section('content')
 <!-- page content -->
 <div class="right_col" role="main">
   <div class="">
     <div class="page-title">
       <div class="title_left">
         <h3>Manage Messages</h3>
       </div>

       <div class="title_right">
         <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
           <div class="input-group">
             <input type="text" class="form-control" placeholder="Search for...">
             <span class="input-group-btn">
               <button class="btn btn-secondary" type="button">Go!</button>
             </span>
           </div>
         </div>
       </div>
     </div>

     <div class="clearfix"></div>

     <div class="row">
       <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
           <div class="x_title">
             <h2>List of Messages</h2>
             <ul class="nav navbar-right panel_toolbox">
               <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
               <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <a class="dropdown-item" href="#">Settings 1</a>
                   <a class="dropdown-item" href="#">Settings 2</a>
                 </div>
               </li>
               <li><a class="close-link"><i class="fa fa-close"></i></a></li>
             </ul>
             <div class="clearfix"></div>
           </div>
           <div class="x_content">
             <div class="row">
               <div class="col-sm-12">
                 <div class="card-box table-responsive">
                   <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                     <thead>
                       <tr>
                         <th>Full Name</th>
                         <th>Email</th>
                         <th>Show</th>
                         <th>Delete</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach($messages as $message)
                         <tr>
                           <td>{{ $message->name }}</td>
                           <td>{{ $message->email }}</td>
                           <td>
                             <a href="{{ route('admin.showEmail', $message->id) }}" onclick="return confirm('Read?')">
                               <img src="{{ asset('dashAssets/images/edit.png') }}" alt="Edit">
                             </a>
                           </td>
                           <td>
                             <form action="{{ route('admin.deleteEmail', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this email?');">
                               @csrf
                               @method('DELETE')
                               <button type="submit" style="background: none; border: none;">
                                 <img src="{{ asset('dashAssets/images/delete.png') }}" alt="Delete">
                               </button>
                             </form>
                           </td>
                         </tr>
                       @endforeach
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- /page content -->
@endsection
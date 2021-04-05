
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>laravel & ajax crud application</title>
  </head>
  <body>

   <header class="mt-5 mb-5">
       <div class="container">
           <div class="row">
               <div class="col-12 text-center text-warning">
                   <h1>Laravel & Ajax Crud Application</h1>
               </div>
           </div>
       </div>
   </header>
   {{-- section.body>.container>.row>.col-12>.card>.card-header+.card-body>   --}}
   <section class="body">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="card">
                       <div class="card-header d-flex justify-content-between align-items-center">
                           <h3 class="mb-0">All Taks</h3>
                         <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createTask">
                           Create Task
                         </button>
                       </div>
                       <div class="card-body">
                        <table class="table table-bordered">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th class="task-name">Task Name</th>
                                   <th class="text-center" style="width:150px">Action</th>
                               </tr>
                           </thead>

                           <tbody id="taskTableBody">
                            @foreach($tasks as $task)
                               <tr data-id="{{ $task->id }}">
                                   <td>{{$task->id}}</td>
                                   <td class="task-name">{{$task->name}}</td>
                                   <td class="text-center" style="width:150px">
                                       <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#editTask">Edit</a>
                                       <a href="#" class="btn btn-sm btn-danger delete" data-bs-toggle="modal" data-bs-target="#deleteTask">Delete</a>
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                        </table>
                   </div>
               </div>
           </div>
       </div>
   </section>
<!---End Section--->

    <!-- Create Task Modal -->
    <div class="modal fade" id="createTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" id="createTaskForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTaskLabel">Create Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="CreateTaskMsg"></div>
                            <div class="form-group">
                                <label for="">Enter Task Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Task Name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create Task</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!---End Modal-->

    <!---Edit Task Modal-->
    <div class="modal fade" id="editTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" id="editTaskForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTaskLabel">Edit Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="editTaskMsg"></div>
                            <div class="form-group">
                                <label for="">Edit Task Name</label>
                                <input type="text" id="edit_input" class="form-control" name="name" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Task</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!---End Modal-->


     <!---Delete Task Modal-->
     <div class="modal fade" id="deleteTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" id="deleteTaskForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteTaskLabel">Delete Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="deleteTaskMsg"></div>
                            <h3>Are you sure, You want to delete this item?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!---End Modal-->













    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/min.js')}}"></script>

  </body>
</html>

// connect ajax meta tag
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// create Task script
$('#createTaskForm').submit(function(e){
    e.preventDefault();

    //define message variable
    let msg = $('#CreateTaskMsg');
    // form input field data
    let input = $('#createTaskForm input[name="name"]');

    //from input data
    let FormData = {
        name: $(input).val()
    }

    $.ajax({
        type : 'post',
        url : 'task/store',
        data : FormData,
        success : function(data){
            //request message value
            $(msg).html('');

            // show success message
            $(msg).append('<div class="alert alert-success">Task Created Successfully!</div>')

            //input value area
            $(input).val('');

            // append transmit
            $('#taskTableBody').prepend(`<tr data-id="`+data.id+`">
            <td>`+ data.id +`</td>
            <td>`+ data.name +`</td>
            <td class="text-center" style="width:150px">
            <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#editTask">Edit</a>
            <a href="#" class="btn btn-sm btn-danger delete" data-bs-toggle="modal" data-bs-target="#deleteTask">Delete</a>
            </td>
        </tr>`);

        },
        //show error message area
        error: function(error){
            //request message value
            $(msg).html('');

            //error message
            $(msg).append('<ul id="errorMessage" class="alert alert-danger"></ul>');

            //get error message in Json formate
            $.each(error.responseJSON.errors, function(index, value){
                console.log(value[0]);
                $(msg).find('#errorMessage').append(`
                    <li> `+ value[0] +` </li>
                `);
            });

        }
    })
})

//Eidt Task script
$(document).on('click', '.edit', function(){

    let task = $(this).closest('tr').data('id');
    let EditModal = $('#editTaskForm');

    $.ajax({
        type:'GET',
        url: 'task/edit/'+task,
        success: function(data){
           $(EditModal).find('#edit_input').val(data.name);
           $(EditModal).attr('data-id', data.id)
        },
        error: function(error){
            console.log(error);
        }
    })
});

// update task
$('#editTaskForm').submit(function(e){
    e.preventDefault();

    //define message variable
    let msg = $('#editTaskMsg');
    let id = $('#editTaskForm').data('id');
    // Form data
    let input = $('#editTaskForm #edit_input');
    let FormData  = {
        name: $(input).val()
    }

    console.log(id);
    console.log($('#editTaskForm').data('id'));

    $.ajax({
        type : 'POST',
        url : 'task/update/'+id,
        data : FormData,
        success : function(data){
            //request message value
            $(msg).html('');

            // show success message
            $(msg).append('<div class="alert alert-success">Task Update Successfully!</div>')

            //input value area
            $(input).val('');

        // append result

         let taskRow = $('#taskTableBody').find('tr[data-id="'+id+'"]');
         $(taskRow).find('td.task-name').text(data.name);

        },
        //show error message area
        error: function(error){
            //request message value
            $(msg).html('');

            //error message
            $(msg).append('<ul id="errorMessage" class="alert alert-danger"></ul>');

            //get error message in Json formate
            $.each(error.responseJSON.errors, function(index, value){
                console.log(value[0]);
                $(msg).find('#errorMessage').append(`
                    <li> `+ value[0] +` </li>
                `);
            });

        }
    })

})

//Delete popup
$(document).on('click', '.delete', function(){

    let task = $(this).closest('tr').data('id');
    let EditModal = $('#deleteTaskForm');
    $(EditModal).attr('data-id', task)

});

// delete task
$('#deleteTaskForm').submit(function(e){
    e.preventDefault();

    //define message variable
    let msg = $('#deleteTaskMsg');
    let id = $('#deleteTaskForm').data('id');
    // Form data

    // let FormData  = {
    //     name: $(input).val()
    // }

    // console.log(id);
    // console.log($('#deleteTaskForm').data('id'));

    $.ajax({
        type : 'post',
        url : 'task/delete/'+id,
        data : FormData,
        success : function(data){
            //request message value
            $(msg).html('');

            $('#deleteTaskForm').find('h3').remove();
            $('#deleteTaskForm').find('button[type="submit"]').remove();

            // show success message
            $(msg).append('<div class="alert alert-success">Task Deleted Successfully!</div>')

            let taskRow = $('#taskTableBody').find('tr[data-id="'+id+'"]');
            $(taskRow).remove();
        },
        //show error message area
        error: function(error){


        }
    })

})

//data set to default

//create modal
$('#createTaskForm').on('hidden.bs.modal', function (e) {
    $('createTaskForm').find('CreateTaskMsg').html('');
})

//edit modal
$('#editTaskForm').on('hidden.bs.modal', function (e) {
    $('editTaskForm').find('editTaskMsg').html('');
})

//delete modal
$('#deleteTaskForm').on('hidden.bs.modal', function (e) {
     modal = $('deleteTaskForm');
     $(modal).find('#deleteTaskMsg').html('');
     $(modal).find('.modal-body').html('').append(`<div id="deleteTaskMsg"></div>
     <h3>Are you sure, You want to delete this item?</h3>`);
     $(modal).find('.modal-footer').html('').append(` <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
     <button type="submit" class="btn btn-danger">Yes, Delete</button>`);
})


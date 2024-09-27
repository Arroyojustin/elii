$(document).ready(function() {
    $('#showAddStudentModal').click(function() {
        $('#addStudentModal').modal('show');
    });

    $('#addStudentBtn').click(function(event) {
        event.preventDefault();
        
        const name = $('#studentName').val().trim();
        const position = $('#studentPosition').val().trim();
    
        if (!name || !position) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Input',
                text: 'Please fill in all fields.',
            });
            return;
        }

        // AJAX request to add student
        $.ajax({
            url: 'controller/create_student.php',
            type: 'POST',
            data: { names: name, position: position },
            success: function(res) {
                console.log('Server response:', res);  // Log the response for debugging
                
                if (res.success) {
                    // Append new student row to table
                    const newRow = `<tr data-id="${res.id}">
                                        <td class="editable" data-field="names">${name}</td>
                                        <td class="editable" data-field="position">${position}</td>
                                        <td class="editable" data-field="status">Active</td>
                                        <td>
                                            <button class='btn btn-light editStudent' data-id="${res.id}">Edit</button>
                                            <button class='btn btn-danger deleteStudent' data-id="${res.id}">Delete</button>
                                        </td>
                                    </tr>`;
                    
                    $('#studentData').append(newRow);
                    $('#studentName').val('');
                    $('#studentPosition').val('');
                    $('#addStudentModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Student Added',
                        text: 'The student has been added successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    console.error('Error from server:', res.message);  // Log the error message from the server
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Add Student',
                        text: res.message,
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);  // Log the error details
                Swal.fire({
                    icon: 'error',
                    title: 'Error Occurred',
                    text: 'An error occurred while adding the student. Please try again.',
                });
            }
        });
    });
});

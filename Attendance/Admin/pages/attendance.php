<?php
include 'dbconn.php';

// Fetch students
$students_query = "SELECT id, names FROM students";
$students_result = $conn->query($students_query);

// Check for query execution errors
if (!$students_result) {
    die("Query failed: " . $conn->error);
}

// Close the database connection
$conn->close();
?>

<div class="container-fluid">
    <h2>Attendance</h2>

    <div class="row">
        <div class="col-md-6">
            <h5>Students</h5>
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-light table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody id="studentData">
                        <?php
                        if ($students_result->num_rows > 0) {
                            while ($row = $students_result->fetch_assoc()) {
                                echo "<tr data-id='{$row['id']}'>";
                                echo "<td class='editable'>" . ucfirst($row['names']) . "</td>";
                                echo "<td>
                                    <button class='btn btn-success btn-sm attendance-button' data-id='{$row['id']}' data-status='present'>Present</button>
                                    <button class='btn btn-danger btn-sm attendance-button' data-id='{$row['id']}' data-status='absent'>Absent</button>
                                    <button class='btn btn-warning btn-sm attendance-button' data-id='{$row['id']}' data-status='excuse'>Excuse</button>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No students found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <h5>Attendance Today</h5>
            <p>Click to change date: <span id="attendanceDate" style="cursor:pointer; color:blue;">Today</span></p>
            <!-- You can implement a date picker here if needed -->
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.attendance-button').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.getAttribute('data-id');
            const status = this.getAttribute('data-status');

            // Perform your AJAX call here to record the attendance
            console.log(`Student ID: ${studentId}, Status: ${status}`);

            // Example AJAX call (replace with actual implementation)
            /*
            $.ajax({
                url: 'record_attendance.php',
                type: 'POST',
                data: { student_id: studentId, status: status },
                success: function(response) {
                    // Handle success response
                },
                error: function(error) {
                    // Handle error response
                }
            });
            */
        });
    });

    // Change the date of attendance
    document.getElementById('attendanceDate').addEventListener('click', function() {
        // Implement the functionality to change the date
        console.log('Change the date functionality goes here.');
    });
</script>

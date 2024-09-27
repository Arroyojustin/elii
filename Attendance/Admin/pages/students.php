<?php
include 'dbconn.php';
?>

<div class="container-fluid">
    <h2></h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="#" class="btn btn-primary" id="showAddStudentModal">
            <i class="fas fa-plus me-2"></i>Add Student
        </a>

        <div class="input-group" style="max-width: 300px;">
            <input type="text" class="form-control" id="searchInput" placeholder="Search students...">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
        </div>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-light table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="sticky-top bg-light">Name</th>
                    <th scope="col" class="sticky-top bg-light">Position</th>
                    <th scope="col" class="sticky-top bg-light">Status</th>
                    <th scope="col" class="sticky-top bg-light">Actions</th>
                </tr>
            </thead>
            <tbody id="studentData">
    <?php
    $result = $conn->query("SELECT id, names, position, status FROM students");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr data-id='{$row['id']}'>";
            echo "<td class='editable' data-field='names'><a href='javascript:void(0);' onclick='loadStudentInfo({$row['id']})'>" . ucfirst($row['names']) . "</a></td>";
            echo "<td class='editable' data-field='position'>" . ucfirst($row['position']) . "</td>";
            echo "<td class='editable' data-field='status'>" . ucfirst($row['status']) . "</td>";
            echo "<td>
                  <button class='btn btn-light editStudent' data-id='{$row['id']}'>Edit</button>
                  <button class='btn btn-danger deleteStudent' data-id='{$row['id']}'>Delete</button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No students found</td></tr>";
    }
    ?>
</tbody>
        </table>
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    <div class="mb-3">
                        <label for="studentName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="studentName" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentPosition" class="form-label">Position</label>
                        <input type="text" class="form-control" id="studentPosition" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addStudentBtn">Add Student</button>
            </div>
        </div>
    </div>
</div>

<script src="../Ajax/students_add.js"></script>
<script src="../Ajax/student_delete.js"></script>

<script>
    // Event listener for search input
    document.getElementById('searchInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#studentData tr');

        rows.forEach(row => {
            const nameCell = row.querySelector('td.editable[data-field="names"]');
            if (nameCell) {
                const name = nameCell.textContent.toLowerCase();
                row.style.display = name.includes(query) ? '' : 'none';
            }
        });
    });

    function loadStudentInfo(studentId) {
    window.location.href = 'admin.php?page=pages/student_info.php&id=' + studentId;
}
</script>

</body>
</html>

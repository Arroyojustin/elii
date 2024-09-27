<!-- Page Content -->
<div class="container-fluid">
    <h2></h2>
    <div class="table-responsive border bg-light shadow rounded p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Estimation Date</th>
                    <th>Duration</th>
                    <th>Permission Details</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($result) && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['estimation_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['duration']); ?></td>
                            <td><?php echo htmlspecialchars($row['permission_details']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <?php if ($row['status'] === 'Pending'): ?>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="decline" class="btn btn-danger btn-sm">Decline</button>
                                    </form>
                                <?php else: ?>
                                    <span><?php echo $row['status']; ?></span>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="cancel" class="btn btn-warning btn-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
/**
 * @var string $activeRole
 * @var DentalClinicUser[] $dentalUsers
 */
$activeRole = $activeRole ?? 'all';
$dentalUsers = $dentalUsers ?? [];
?>

<section class="page-header">
    <h1>Clinic Personnel &amp; Patients Directory</h1>
    <p>Demonstrating Polymorphism and Inheritance through unified base objects with specialized behaviors.</p>
</section>

<!-- Filter Navigation & Reset -->
<div class="filter-bar">
    <a href="index.php?role=all" class="filter-btn <?= ($activeRole === 'all') ? 'active' : '' ?>">All Users</a>
    <a href="index.php?role=dentist" class="filter-btn <?= ($activeRole === 'dentist') ? 'active' : '' ?>">Dentists</a>
    <a href="index.php?role=patient" class="filter-btn <?= ($activeRole === 'patient') ? 'active' : '' ?>">Patients</a>
    <a href="index.php?role=receptionist" class="filter-btn <?= ($activeRole === 'receptionist') ? 'active' : '' ?>">Receptionists</a>
    <a href="index.php?action=reset" class="filter-btn" style="margin-left: auto; color: #ef4444; border-color: #fca5a5;">Reset Sample Data</a>
</div>

<!-- Users Grid -->
<div class="grid">
    <?php if (empty($dentalUsers)): ?>
        <p style="color: #64748b;">No users found for this category.</p>
    <?php else: ?>
        <?php foreach ($dentalUsers as $user): ?>
            <div class="card">
                <div>
                    <div class="card-top">
                        <span class="badge badge-<?= strtolower($user->getRoleBadge()) ?>">
                            <?= htmlspecialchars($user->getRoleBadge()) ?>
                        </span>
                        <small style="color: #94a3b8;"><?= htmlspecialchars($user->getUserId()) ?></small>
                    </div>

                    <!-- Inherited Methods -->
                    <h3><?= htmlspecialchars($user->getName()) ?></h3>
                    
                    <!-- Contact Information -->
                    <p style="font-size: 0.85rem; color: #475569; margin-bottom: 8px;">
                        <strong>Contact:</strong> <?= htmlspecialchars($user->getContactNumber()) ?>
                    </p>

                    <!-- Polymorphic Method -->
                    <p class="role-desc">
                        <?= htmlspecialchars($user->getRoleDescription()) ?>
                    </p>
                </div>

                <!-- Polymorphic Role-Specific Details -->
                <div class="details-box">
                    <?php foreach ($user->getAdditionalDetails() as $label => $value): ?>
                        <div class="details-row">
                            <span class="details-label"><?= htmlspecialchars($label) ?>:</span>
                            <span class="details-value"><?= htmlspecialchars($value) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Add Member Form -->
<section class="form-section">
    <h2>Add Clinic Member (In-Memory)</h2>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="create_user">

        <div class="form-grid">
            <div class="form-group">
                <label for="role">User Role</label>
                <select name="role" id="role" required onchange="toggleRoleFields(this.value)">
                    <option value="patient">Patient</option>
                    <option value="dentist">Dentist</option>
                    <option value="receptionist">Receptionist</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" required placeholder="e.g. Maria Santos">
            </div>

            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" name="contact" id="contact" required placeholder="e.g. 0917-555-1234">
            </div>
        </div>

        <!-- Dynamic Role-Specific Fields -->
        <div class="form-grid" id="patient-fields">
            <div class="form-group">
                <label>Patient Record No.</label>
                <input type="text" name="patient_no" placeholder="e.g. P-205">
            </div>
            <div class="form-group">
                <label>Dental Concern</label>
                <input type="text" name="concern" placeholder="e.g. Root Canal Treatment">
            </div>
        </div>

        <div class="form-grid" id="dentist-fields" style="display: none;">
            <div class="form-group">
                <label>Specialization</label>
                <input type="text" name="specialization" placeholder="e.g. Pediatric Dentistry">
            </div>
            <div class="form-group">
                <label>License No.</label>
                <input type="text" name="license_no" placeholder="e.g. DMD-7732">
            </div>
        </div>

        <div class="form-grid" id="receptionist-fields" style="display: none;">
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" name="employee_no" placeholder="e.g. EMP-105">
            </div>
            <div class="form-group">
                <label>Shift Schedule</label>
                <input type="text" name="shift" placeholder="e.g. Afternoon (1:00 PM - 9:00 PM)">
            </div>
        </div>

        <button type="submit" class="btn-submit">Create Member</button>
    </form>
</section>

<script>
function toggleRoleFields(role) {
    document.getElementById('patient-fields').style.display = (role === 'patient') ? 'grid' : 'none';
    document.getElementById('dentist-fields').style.display = (role === 'dentist') ? 'grid' : 'none';
    document.getElementById('receptionist-fields').style.display = (role === 'receptionist') ? 'grid' : 'none';
}
</script>
<?php
/**
 * @var string $activeTab
 * @var string $activeRole
 * @var array|null $alert
 * @var DentalClinicUser[] $dentalUsers
 * @var Patient[] $allPatients
 * @var Dentist[] $allDentists
 * @var Appointment[] $appointments
 * @var array $servicesList
 */
$activeTab = $activeTab ?? 'users';
$activeRole = $activeRole ?? 'all';
?>

<!-- Alert Feedback for Figure 10 (Validation / Error Output) -->
<?php if (!empty($alert)): ?>
    <div class="alert alert-<?= htmlspecialchars($alert['type']) ?>">
        <?= htmlspecialchars($alert['message']) ?>
    </div>
<?php endif; ?>

<!-- TAB 1: USERS DIRECTORY (Figures 3, 4, 5, 8) -->
<?php if ($activeTab === 'users'): ?>
    <section class="page-header">
        <h1>Clinic Directory &amp; Records</h1>
        <p>PHP OOP Implementation: Parent DentalClinicUser with Patient, Dentist, and Receptionist subclasses.</p>
    </section>

    <!-- Filter Navigation & Reset -->
    <div class="filter-bar">
        <a href="index.php?tab=users&role=all" class="filter-btn <?= ($activeRole === 'all') ? 'active' : '' ?>">All Users</a>
        <a href="index.php?tab=users&role=dentist" class="filter-btn <?= ($activeRole === 'dentist') ? 'active' : '' ?>">Dentists</a>
        <a href="index.php?tab=users&role=patient" class="filter-btn <?= ($activeRole === 'patient') ? 'active' : '' ?>">Patients</a>
        <a href="index.php?tab=users&role=receptionist" class="filter-btn <?= ($activeRole === 'receptionist') ? 'active' : '' ?>">Receptionists</a>
        <a href="index.php?action=reset" class="filter-btn" style="margin-left: auto; color: #ef4444; border-color: #fca5a5;">Reset Sample Data</a>
    </div>

    <!-- User Cards (Figure 8 - System Output / Records) -->
    <div class="grid">
        <?php foreach ($dentalUsers as $user): ?>
            <div class="card">
                <div>
                    <div class="card-top">
                        <span class="badge badge-<?= strtolower($user->getRoleBadge()) ?>">
                            <?= htmlspecialchars($user->getRoleBadge()) ?>
                        </span>
                        <small style="color: #94a3b8;"><?= htmlspecialchars($user->getUserId()) ?></small>
                    </div>

                    <h3><?= htmlspecialchars($user->getName()) ?></h3>
                    <p style="font-size: 0.85rem; color: #475569; margin-bottom: 8px;">
                        <strong>Contact:</strong> <?= htmlspecialchars($user->getContactNumber()) ?>
                    </p>

                    <!-- Polymorphic Method: getRoleDescription() -->
                    <p class="role-desc">
                        <?= htmlspecialchars($user->getRoleDescription()) ?>
                    </p>
                </div>

                <!-- Subclass-specific properties demonstrated via getters -->
                <div class="details-box">
                    <?php if ($user instanceof Patient): ?>
                        <div class="details-row">
                            <span class="details-label">Patient No:</span>
                            <span class="details-value"><?= htmlspecialchars($user->getPatientNo()) ?></span>
                        </div>
                        <div class="details-row">
                            <span class="details-label">Dental Concern:</span>
                            <span class="details-value"><?= htmlspecialchars($user->getDentalConcern()) ?></span>
                        </div>
                    <?php elseif ($user instanceof Dentist): ?>
                        <div class="details-row">
                            <span class="details-label">Specialization:</span>
                            <span class="details-value"><?= htmlspecialchars($user->getSpecialization()) ?></span>
                        </div>
                        <div class="details-row">
                            <span class="details-label">License No:</span>
                            <span class="details-value"><?= htmlspecialchars($user->getLicenseNo()) ?></span>
                        </div>
                    <?php elseif ($user instanceof Receptionist): ?>
                        <div class="details-row">
                            <span class="details-label">Employee No:</span>
                            <span class="details-value"><?= htmlspecialchars($user->getEmployeeNo()) ?></span>
                        </div>
                        <div class="details-row">
                            <span class="details-label">Shift:</span>
                            <span class="details-value"><?= htmlspecialchars($user->getShift()) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Registration Forms (Figures 4 & 5) -->
    <section class="form-section">
        <h2>Register Clinic Member</h2>
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
                    <input type="text" name="name" id="name" required placeholder="e.g. Maria Clara">
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" name="contact" id="contact" required placeholder="e.g. 0917-123-4567">
                </div>
            </div>

            <!-- Figure 4: Patient Input Form Fields -->
            <div class="form-grid" id="patient-fields">
                <div class="form-group">
                    <label>Patient Number</label>
                    <input type="text" name="patient_no" placeholder="e.g. P002">
                </div>
                <div class="form-group">
                    <label>Dental Concern</label>
                    <input type="text" name="concern" placeholder="e.g. Toothache / Cavity">
                </div>
            </div>

            <!-- Figure 5: Dentist Input Form Fields -->
            <div class="form-grid" id="dentist-fields" style="display: none;">
                <div class="form-group">
                    <label>Specialization</label>
                    <input type="text" name="specialization" placeholder="e.g. Orthodontics">
                </div>
                <div class="form-group">
                    <label>License Number</label>
                    <input type="text" name="license_no" placeholder="e.g. DMD-002">
                </div>
            </div>

            <!-- Receptionist Input Form Fields -->
            <div class="form-grid" id="receptionist-fields" style="display: none;">
                <div class="form-group">
                    <label>Employee Number</label>
                    <input type="text" name="employee_no" placeholder="e.g. EMP-002">
                </div>
                <div class="form-group">
                    <label>Assigned Shift</label>
                    <input type="text" name="shift" placeholder="e.g. Afternoon Shift">
                </div>
            </div>

            <button type="submit" class="btn-submit">Add Record</button>
        </form>
    </section>

<!-- TAB 2: DENTAL APPOINTMENT MANAGEMENT (Figure 6 & Test Case 5) -->
<?php elseif ($activeTab === 'appointments'): ?>
    <section class="page-header">
        <h1>Dental Appointment Management</h1>
        <p>Processes appointments between registered Patients and Dentists (Demonstrating Object Association).</p>
    </section>

    <!-- Appointments Table (Figure 8 - Processed Records) -->
    <table class="data-table">
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Patient</th>
                <th>Dentist</th>
                <th>Date &amp; Time</th>
                <th>Dental Service</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($appointments)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #64748b;">No scheduled appointments yet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($appointments as $apt): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($apt->getAppointmentId()) ?></strong></td>
                        <td><?= htmlspecialchars($apt->getPatient()->getName()) ?> (<?= htmlspecialchars($apt->getPatient()->getPatientNo()) ?>)</td>
                        <td><?= htmlspecialchars($apt->getDentist()->getName()) ?></td>
                        <td><?= htmlspecialchars($apt->getAppointmentDate()) ?> at <?= htmlspecialchars($apt->getAppointmentTime()) ?></td>
                        <td><span class="badge" style="background: #e0f2fe; color: #0369a1;"><?= htmlspecialchars($apt->getDentalService()) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Figure 6: Dental Appointment Form -->
    <section class="form-section">
        <h2>Schedule an Appointment</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="create_appointment">

            <div class="form-grid">
                <div class="form-group">
                    <label for="patient_id">Select Patient</label>
                    <select name="patient_id" id="patient_id" required>
                        <option value="">-- Choose Registered Patient --</option>
                        <?php foreach ($allPatients as $pat): ?>
                            <option value="<?= htmlspecialchars($pat->getUserId()) ?>">
                                <?= htmlspecialchars($pat->getName()) ?> (<?= htmlspecialchars($pat->getPatientNo()) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dentist_id">Select Dentist</label>
                    <select name="dentist_id" id="dentist_id" required>
                        <option value="">-- Choose Available Dentist --</option>
                        <?php foreach ($allDentists as $den): ?>
                            <option value="<?= htmlspecialchars($den->getUserId()) ?>">
                                <?= htmlspecialchars($den->getName()) ?> - <?= htmlspecialchars($den->getSpecialization()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="service">Select Dental Service</label>
                    <select name="service" id="service" required>
                        <option value="">-- Choose Service --</option>
                        <?php foreach ($servicesList as $srv): ?>
                            <option value="<?= htmlspecialchars($srv['name']) ?>">
                                <?= htmlspecialchars($srv['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Appointment Date</label>
                    <input type="date" name="date" id="date" required value="<?= date('Y-m-d') ?>">
                </div>

                <div class="form-group">
                    <label for="time">Appointment Time</label>
                    <input type="time" name="time" id="time" required value="09:00">
                </div>
            </div>

            <button type="submit" class="btn-submit">Confirm Appointment</button>
        </form>
    </section>

<!-- TAB 3: DENTAL SERVICE MANAGEMENT (Figure 7) -->
<?php elseif ($activeTab === 'services'): ?>
    <section class="page-header">
        <h1>Dental Service Catalog</h1>
        <p>Available clinical procedures and services offered by Cordova Dental Clinic.</p>
    </section>

    <div class="grid">
        <?php foreach ($servicesList as $srv): ?>
            <div class="card">
                <div>
                    <span class="badge" style="background: #e0f2fe; color: #0284c7; margin-bottom: 12px; display: inline-block;">
                        Standard Service
                    </span>
                    <h3><?= htmlspecialchars($srv['name']) ?></h3>
                    <p class="role-desc"><?= htmlspecialchars($srv['desc']) ?></p>
                </div>
                <div class="details-box">
                    <div class="details-row">
                        <span class="details-label">Standard Fee:</span>
                        <span class="details-value" style="color: #0284c7;"><?= htmlspecialchars($srv['fee']) ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<!-- TAB 4: POLYMORPHISM TEST OUTPUT (Figure 2 & Figure 9) -->
<?php elseif ($activeTab === 'polymorphism'): ?>
    <section class="page-header">
        <h1>Polymorphism Demonstration Output</h1>
        <p>Direct execution of <code>$user->getRoleDescription()</code> inside a polymorphic loop (Document Section 9 &amp; 11.5).</p>
    </section>

    <div class="card" style="margin-bottom: 24px;">
        <h3 style="margin-bottom: 12px;">Live Execution Result</h3>
        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 16px;">
            The same method call <code>getRoleDescription()</code> produces different role-specific behaviors at runtime based on the actual object:
        </p>

        <div style="background: #0f172a; color: #38bdf8; padding: 20px; border-radius: 8px; font-family: monospace; font-size: 0.95rem; line-height: 1.8;">
            <?php foreach ($dentalUsers as $user): ?>
                <div>
                    <span style="color: #94a3b8;">[<?= htmlspecialchars(get_class($user)) ?>]</span>
                    <span style="color: #f8fafc; font-weight: bold;"><?= htmlspecialchars($user->getName()) ?></span>:
                    <span style="color: #34d399;">"<?= htmlspecialchars($user->getRoleDescription()) ?>"</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<script>
function toggleRoleFields(role) {
    var p = document.getElementById('patient-fields');
    var d = document.getElementById('dentist-fields');
    var r = document.getElementById('receptionist-fields');

    if (p && d && r) {
        p.style.display = (role === 'patient') ? 'grid' : 'none';
        d.style.display = (role === 'dentist') ? 'grid' : 'none';
        r.style.display = (role === 'receptionist') ? 'grid' : 'none';
    }
}
</script>
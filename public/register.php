<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<style>
body {
  background: #0a0e1a;
  color: #f8fafc;
  font-family: 'Segoe UI', sans-serif;
}
h2 {
  font-weight: bold;
  color: #f8fafc;
  text-align: center;
  margin-bottom: 30px;
}
.card-register {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.4);
  max-width: 700px;
  margin: auto;
}
.form-control {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.2);
  color: #fff;
  border-radius: 12px;
  padding: 12px;
}
.form-control::placeholder {
  color: #94a3b8;
}
.form-control:focus {
  border-color: #818cf8;
  box-shadow: 0 0 10px #6366f1;
}
.btn-primary {
  background: linear-gradient(135deg,#4facfe,#00f2fe);
  border: none;
  font-weight: bold;
  padding: 12px;
  border-radius: 25px;
  transition: 0.3s;
  width: 100%;
}
.btn-primary:hover {
  background: linear-gradient(135deg,#f093fb,#f5576c);
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.4);
}
</style>

<div class="container mt-5">
  <div class="card-register">
    <h2>📝 Register</h2>
    <form action="../backend/auth/register.php" method="POST">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Create Password" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Date of Birth</label>
          <input type="date" name="dob" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Time of Birth</label>
          <input type="time" name="tob" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Birth Place</label>
          <input type="text" name="birth_place" class="form-control" placeholder="City / Village">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Latitude</label>
          <input type="number" step="0.000001" name="latitude" class="form-control" placeholder="e.g. 28.7041">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Longitude</label>
          <input type="number" step="0.000001" name="longitude" class="form-control" placeholder="e.g. 77.1025">
        </div>
      </div>

      <button type="submit" class="btn btn-primary mt-3">Register</button>
    </form>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

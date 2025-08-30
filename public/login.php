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
.card-login {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.4);
  max-width: 420px;
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
a {
  color: #00f2fe;
  text-decoration: none;
}
a:hover {
  color: #f093fb;
  text-decoration: underline;
}
</style>

<div class="container mt-5">
  <div class="card-login">
    <h2>🔐 Login</h2>
    <form action="../backend/auth/login.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
      </div>

      <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p class="mt-4 text-center">
      Don’t have an account?  
      <a href="register.php">Register here</a>
    </p>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

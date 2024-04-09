<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collapsible Sidebar</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons (Optional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    /* Adjust sidebar width and transition */
    .sidebar {
      width: 250px;
      transition: all 0.3s;
    }
    /* Hide sidebar when collapsed */
    .sidebar.collapsed {
      width: 80px;
    }
  </style>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar bg-dark text-light">
    <div class="p-4">
      <h4>Sidebar</h4>
      <!-- Sidebar content goes here -->
    </div>
  </div>
  
  <!-- Page content -->
  <div class="content p-4">
    <h1>Page Content</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <button class="btn btn-primary toggle-sidebar">Toggle Sidebar</button>
  </div>
</div>

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Toggle sidebar functionality
  document.querySelector('.toggle-sidebar').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('collapsed');
  });
</script>

</body>
</html>

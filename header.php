<?php 
require_once __DIR__ . '/api/session_handler.php';
$current_user = get_session_user();
$cart_count = get_cart_count();
$flash_message = get_flash_message();
?>
<?php if ($flash_message): ?>
<div class="alert alert-<?php echo $flash_message['type']; ?> alert-dismissible fade show m-0" role="alert">
    <?php echo htmlspecialchars($flash_message['message']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Neth shopping</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php">🛒 Cart <?php if ($cart_count > 0): ?><span class="badge bg-danger"><?php echo $cart_count; ?></span><?php endif; ?></a></li>
        <?php if (is_logged_in()): ?>
          <li class="nav-item d-flex align-items-center me-2">
            <span class="navbar-text small">Hello, <?php echo htmlspecialchars($current_user['name']); ?></span>
          </li>
          <?php if (is_admin()): ?>
          <li class="nav-item">
            <a class="nav-link" href="admin/dashboard.php">Admin Panel</a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-light nav-link px-3" href="api/logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <button class="btn btn-sm btn-outline-light nav-link" id="navLoginBtn" data-bs-toggle="modal" data-bs-target="#loginModal">LOGIN</button>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  
</nav>


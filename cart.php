<?php
require_once __DIR__ . '/api/session_handler.php';
$current_user = get_session_user();
$cart_count = get_cart_count();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart — NETH SHOP</title>
  <link href="./dist/styles.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <?php include 'header.php'; ?>

  <!-- Cart content -->
  <main class="container py-5 content-with-footer">
    <div class="row">

      <!-- Items list -->
      <div class="col-lg-8 mb-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Shopping Cart</h4>
            <p class="text-muted">Review your items.</p>

            <div id="cartItems" class="list-group">
            </div>

            <div class="d-flex justify-content-start align-items-center mt-4">
              <a id="continueShoppingBtn" href="index.php" class="btn btn-sm btn-outline-secondary btn-continue">← Continue shopping</a>
            </div>

          </div>
        </div>
      </div>

      <!-- Summary -->
      <div class="col-lg-4">
        <div class="card card-summary">
          <div class="card-body">
            <h5 class="card-title">Order Summary</h5>
            <ul id="summaryList" class="list-unstyled mb-3">
            </ul>
            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal</span>
              <strong id="cartSubtotal">₱0</strong>
            </div>
            <div class="d-flex justify-content-between mb-3">
              <span>Shipping</span>
              <span class="muted">Calculated at checkout</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
              <span class="h6">Total</span>
              <strong id="cartTotal" class="h5">₱0</strong>
            </div>

            <a id="checkoutSummaryBtn" href="checkout.php" class="btn btn-success w-100">Checkout</a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <?php include 'footer.php'; ?>

  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="loginModalLabel">Sign in to NETH SHOP</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm">
            <div class="mb-3">
              <label for="loginUsername" class="form-label">Username</label>
              <input type="text" class="form-control" id="loginUsername" name="username" autocomplete="username" required>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="loginPassword" name="password" autocomplete="current-password" required>
            </div>
          </form>
        </div>
        <div class="modal-footer border-0 d-flex justify-content-between align-items-center">
          <div>
            <a href="#" class="small modal-note" data-bs-toggle="modal" data-bs-target="#signupModal">No account yet?</a>
          </div>
          <div>
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="loginForm" class="btn btn-primary">Login</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="loginSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content text-center p-3">
        <div class="modal-body">
          <div class="mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-success">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <h5 id="loginSuccessModalLabel" class="mb-1">Signed in successfully</h5>
          <p class="small text-muted mb-0">Redirecting to homepage...</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="signupModalLabel">Create an account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="signupForm">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="signupFirstName" class="form-label">First name</label>
                <input type="text" class="form-control" id="signupFirstName" name="firstName" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="signupLastName" class="form-label">Last name</label>
                <input type="text" class="form-control" id="signupLastName" name="lastName" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="signupAddress" class="form-label">Address (City / Province / Barangay)</label>
              <input type="text" class="form-control" id="signupAddress" name="address" placeholder="City / Barangay / Province" required>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="signupEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="signupEmail" name="email" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="signupContact" class="form-label">Contact</label>
                <input type="tel" class="form-control" id="signupContact" name="contact" placeholder="0917-xxx-xxxx" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="signupPassword" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="signupPassword" name="password" required>
                  <button class="btn btn-outline-secondary password-toggle" type="button" data-target="signupPassword">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  </button>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="signupPasswordConfirm" class="form-label">Confirm password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="signupPasswordConfirm" name="passwordConfirm" required>
                  <button class="btn btn-outline-secondary password-toggle" type="button" data-target="signupPasswordConfirm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  </button>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="passwordStrength" class="form-label">Password Strength</label>
              <div id="passwordStrength" class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="signupForm" class="btn btn-primary">Create Account</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="signupSuccessModal" tabindex="-1" aria-labelledby="signupSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content text-center p-3">
        <div class="modal-body">
          <div class="mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-success">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <h5 id="signupSuccessModalLabel" class="mb-1">Account created successfully</h5>
          <p class="small text-muted mb-0">Redirecting to homepage...</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="./javascript/toast.js"></script>
  <script src="./javascript/cart.js"></script>
  <script src="./javascript/login-ui.js"></script>

  <script>
    (function(){
      var btn = document.getElementById('continueShoppingBtn');
      if (!btn) return;
      btn.addEventListener('click', function(e){
        if (window.history && window.history.length > 1) { e.preventDefault(); window.history.back(); }
      });

      var checkout = document.getElementById('checkoutSummaryBtn');
      if (checkout) {
        checkout.addEventListener('click', function(e){ 
          if (!window.Cart || !window.Cart._read || !window.Cart._read().length) {
            e.preventDefault();
            if (window.Toast && window.Toast.show) window.Toast.show('Your cart is empty.');
            else try{ alert('Your cart is empty.'); }catch(e){}
          }
          if (!document.cookie.includes('PHPSESSID')) {
            e.preventDefault();
            window.location.href = 'index.php?loginRequired=1';
          }
        });
      }
    })();
  </script>

</body>
</html>



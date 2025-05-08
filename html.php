<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">


  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-blue-600"><a href="page1.html">SmartPark</a></h1>
    </div>
  </header>


  <div class="flex flex-col items-center justify-center min-h-screen px-4">
 
    <div id="signup" class="w-full max-w-md bg-white p-6 rounded-lg shadow-md space-y-4 hidden">
      <h2 class="text-2xl font-semibold text-center">Sign Up</h2>
      <form method="post" action="register.php" class="space-y-4">
        <div class="relative">
          <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
          <input type="text" name="fName" placeholder="First Name" required
                 class="pl-10 w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <div class="relative">
          <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
          <input type="text" name="lName" placeholder="Last Name" required
                 class="pl-10 w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <div class="relative">
          <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
          <input type="email" name="email" placeholder="Email" required
                 class="pl-10 w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <div class="relative">
          <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
          <input type="password" name="password" placeholder="Password" required
                 class="pl-10 w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <input type="submit" value="Sign Up" name="signUp" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 cursor-pointer"/>
      </form>
      <div class="text-center text-sm text-gray-500">or sign up with</div>
      <div class="flex justify-center space-x-4">
        <i class="fab fa-google text-xl cursor-pointer"></i>
        <i class="fab fa-facebook text-xl cursor-pointer"></i>
      </div>
      <p class="text-sm text-center">Already have an account? <button id="signInButton" class="text-blue-600 underline">Log In</button></p>
    </div>

    
    <div id="signIn" class="w-full max-w-md bg-white p-6 rounded-lg shadow-md space-y-4">
      <h2 class="text-2xl font-semibold text-center">Log In</h2>
      <form method="post" action="register.php" class="space-y-4">
        <div class="relative">
          <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
          <input type="email" name="email" placeholder="Email" required
                 class="pl-10 w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <div class="relative">
          <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
          <input type="password" name="password" placeholder="Password" required
                 class="pl-10 w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <div class="text-right text-sm">
          <a href="#" class="text-blue-600 hover:underline">Recover Password</a>
        </div>
        <input type="submit" value="Sign In" name="signIn" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 cursor-pointer"/>
      </form>
      <div class="text-center text-sm text-gray-500">or log in with</div>
      <div class="flex justify-center space-x-4">
        <i class="fab fa-google text-xl cursor-pointer"></i>
        <i class="fab fa-facebook text-xl cursor-pointer"></i>
      </div>
      <p class="text-sm text-center">Don't have an account? <button id="signUpButton" class="text-blue-600 underline">Sign Up</button></p>
    </div>
  </div>


  <script>
    const signIn = document.getElementById('signIn');
    const signUp = document.getElementById('signup');
    const signInBtn = document.getElementById('signInButton');
    const signUpBtn = document.getElementById('signUpButton');

    signUpBtn.addEventListener('click', () => {
      signIn.classList.add('hidden');
      signUp.classList.remove('hidden');
    });

    signInBtn.addEventListener('click', () => {
      signUp.classList.add('hidden');
      signIn.classList.remove('hidden');
    });
  </script>
</body>
</html>

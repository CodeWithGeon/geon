<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-indigo-600">Create Account</h1>

        <div id="error" class="hidden mb-4 text-red-500 text-sm text-center"></div>

        <form id="registerForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" required
                    class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" required
                    class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" required
                    class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                Register
            </button>
        </form>

        <p class="text-center text-sm mt-4 text-gray-500">
            Already have an account?
            <a href="/login" class="text-indigo-600 hover:underline">Login</a>
        </p>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", async (e) => {
            e.preventDefault();

            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const errorBox = document.getElementById("error");

            try {
                await axios.post("/api/auth/register", { name, email, password });
                window.location.href = "/login"; // redirect after registration
            } catch (err) {
                errorBox.textContent = "Registration failed. Email might already be used.";
                errorBox.classList.remove("hidden");
            }
        });
    </script>

</body>
</html>
